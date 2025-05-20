<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Update Existencias</title>
    <link rel="stylesheet" href="css/normalize.css">
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
        if(isset($rol) && $rol == 0){
            $rol = "root";
        }
    ?>
            <a href="index.php" class="navegacion__enlace">Inicio</a>
            <a href="nuestrahistoria.php" class="navegacion__enlace">Nuestra Historia</a>
            <a href="nuestrastiendas.php" class="navegacion__enlace">Nuestras Tiendas</a>
            <a href="nuestrosproductos.php" class="navegacion__enlace enlace-activo">Nuestros Productos</a>
    <?php
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
    <main class="contenido-principal container">
        <?php
            if($rol != "root"){
                echo "<p>Acceso denegado</p>";
                echo '<a href="index.php" class="boton">Volver a Inicio</a>';
                exit();
            }
                include_once 'SQLExistencia.php';
                include_once 'Existencia.php';
                if (isset($_POST['action']) && $_POST['action'] === 'update') {
                    include_once 'SQLExistencia.php';
                    include_once 'Existencia.php';
                    $sqlExistencia = new SQLExistencia();
                    $e = new Existencia();
                    $e->setIdArticulo((int)$_POST['idarticulo']);
                    $e->setIdTienda((int)$_POST['idtienda']);
                    $e->setCantidad((int)$_POST['cantidad']);
                    if ($sqlExistencia->updateExistencia($e)) {
                        echo "<p>Existencia actualizada correctamente.</p>";
                    } else {
                        echo "<p>Error al actualizar la existencia.</p>";
                    }
                    echo '<a href="addExistencias.php" class="boton">Volver</a>';
                }
        
        ?>


    </main>
    <?php
        $front->footer();
    ?>

</body>
</html>
        