<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Update Tienda</title>
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
            <a href="nuestrastiendas.php" class="navegacion__enlace enlace-activo">Nuestras Tiendas</a>
            <a href="nuestrosproductos.php" class="navegacion__enlace">Nuestros Productos</a>
    <?php
        if($rol == "root"){
        echo '<a href="resumenes-estados.php" class="navegacion__enlace">Resumenes y Estados</a>';
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
    <main class="contenido-principal container">
        <?php
            if($rol != "root"){
                echo "<p>Acceso denegado</p>";
                echo '<a href="index.php" class="boton">Volver a Inicio</a>';
                exit();
            }
            include_once 'SQLTienda.php';
            include_once 'Tienda.php';

            $id = $_POST['id'];
            $descripcion = $_POST['descripcion'];
            $ciudad = $_POST['ciudad'];
            $direccion = $_POST['direccion'];
            $cp = $_POST['cp'];
            $horario = $_POST['horario'];
            $url = $_POST['url'];
            $sqlTienda = new SQLTienda();
            $t = new Tienda();
            $t->setId($id);
            $t->setDescripcion($descripcion);
            $t->setDireccion($direccion);
            $t->setCiudad($ciudad);
            $t->setCp($cp);
            $t->setHorario($horario);
            $t->setUrl($url);
            if($sqlTienda->updateTienda($t)) {
                echo "<p>Tienda actualizada correctamente</p>";
            } else {
                echo "<p>Error al actualizar la tienda</p>";
            }
            echo '<a href="nuestrastiendas.php" class="boton">Volver</a>';
        
        ?>


    </main>
    <?php
        $front->footer();
    ?>

</body>
</html>
        