<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Update Articulo</title>
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
        include_once 'SQLLinea.php';
        include_once 'Linea.php';
        
        $sqlLineas = new SQLLinea();
        $lineas = $sqlLineas->getLineas();
        foreach ($lineas as $linea) {
            $l = new Linea();
            $l->setIdLinea($linea['idLinea']);
            $l->setNombreLinea($linea['descripcion']);
            $l->setActivo($linea['activo']);
            if($l->getActivo()==1) {
                echo '<a href="productos.php?id='.$l->getIdLinea().'" class="navegacion__enlace">'.$l->getNombreLinea().'</a>';
            }
        }
    ?>
            
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
            include_once 'SQLArticulo.php';
            include_once 'Articulo.php';

            $id = $_POST['id'];
            $descripcion = $_POST['descripcion'];
            $linea = $_POST['idlinea'];
            $caracteristicas = $_POST['caracteristicas'];
            $precio = $_POST['precio'];
            $img = $_POST['imagen'];

            $sqlArticulo = new SQLArticulo();
            $articulo = new Articulo();
            $articulo->setId($id);
            $articulo->setDescripcion($descripcion);
            $articulo->setLinea($linea);
            $articulo->setCaracteristicas($caracteristicas);
            $articulo->setPrecio($precio);
            $articulo->setImagen($img);
            if($sqlArticulo->updateArticulo($articulo)) {
                echo "<p>Articulo actualizado correctamente</p>";
            } else {
                echo "<p>Error al actualizar el articulo</p>";
            }
            
            echo '<a href="productos.php?id='.$_GET['id'].'" class="boton">Volver</a>';
        
        ?>


    </main>
    <?php
        $front->footer();
    ?>

</body>
</html>
        