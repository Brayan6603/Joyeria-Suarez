<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Usuario</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
        include "Front.php";
        $front = new Front();
        $front->header();
        $front->navOpen();
        session_start();
        $username = $_SESSION['username'];
        $rol = $_SESSION['rol'];
        if($rol == 0){
            $rol = "root";
        }
    ?>
        <a href="index.php" class="navegacion__enlace">Inicio</a>
        <a href="nuestrahistoria.php" class="navegacion__enlace">Nuestra Historia</a>
        <a href="nuestrastiendas.php" class="navegacion__enlace">Nuestras Tiendas</a>
        <a href="nuestrosproductos.php" class="navegacion__enlace">Nuestros Productos</a>
    <?php
        if($rol == "root"){
        ?>
             <a href="gestionar-usuarios.php" class="navegacion__enlace">Gestionar Usuarios</a>
            <a href="resumenes-estados.php" class="navegacion__enlace">Resumenes y Estados</a>
    <?php
        }
        $front->navClose();
        
        if(isset($username)){
    ?>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script>
        mostrarUsername("<?php echo $username; ?>", "<?php echo $rol; ?>");
        mostrarBotonLogOut();
        //mostrarSVGUsuario();
    </script>
    <?php
        } 
    ?>
    <main class="contenido-principal flex">
        <?php
        if ($rol !== "root") {
            echo '<div><p>Acceso denegado</p><a href="index.php" class="boton">Volver a Inicio</a></div>';
            exit();
        }
        ?>

        <h2>BackUp de la Base de Datos</h2>
        <form method="post">
            <button type="submit" name="backup" class="boton">Generar Backup</button>
        </form>
        <?php
        if (isset($_POST['backup'])) {
            include_once 'MysqlConnector.php';
            $mysql = new MysqlConnector();
            $backupFile = 'backup_' . date('Ymd_His') . '.sql';
            if ($mysql->backupDatabase($backupFile)) {
                echo '<p>Backup generado correctamente. <a href="' . $backupFile . '" download>Descargar respaldo</a></p>';
            } else {
                echo '<p>Error al generar el backup.</p>';
            }
        }
        ?>
    </main>
    <?php
        $front->footer();
    ?>
    <script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>