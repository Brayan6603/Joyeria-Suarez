<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Add Tienda</title>
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

    <main class="contenido-principal container">
        <?php
             if($rol != "root"){
                echo "<p>Acceso denegado</p>";
                echo '<a href="index.php" class="boton">Volver a Inicio</a>';
                exit();
            }
            if(isset($_POST['descripcion']) && isset($_POST['ciudad']) && isset($_POST['direccion']) && isset($_POST['cp']) && isset($_POST['horario']) && isset($_POST['url'])) {
                include_once 'SQLTienda.php';
                include_once 'Tienda.php';
                $sqlTienda = new SQLTienda();
                $t = new Tienda();
                $t->setDescripcion($_POST['descripcion']);
                $t->setCiudad($_POST['ciudad']);
                $t->setDireccion($_POST['direccion']);
                $t->setCp($_POST['cp']);
                $t->setHorario($_POST['horario']);
                $t->setUrl($_POST['url']);
                
                if($sqlTienda->addTienda($t)) {
                    echo "<p>Tienda agregada correctamente</p>";
                } else {
                    echo "<p>Error al agregar la tienda</p>";
                }
                echo '<a href="addTienda.php" class="boton">Volver</a>';
                
            } else {?>

        <h2>Agregar Tienda</h2>
        <form action="addTienda.php" method="POST" class="formulario">
                
                <div class="campo">
                    <label for="descripcion">Descripción</label>
                    <input type="text" id="descripcion" name="descripcion" required>
                </div>
                <div class="campo">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" id="ciudad" name="ciudad" required>
                </div>
                <div class="campo">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" required>
                </div>
                <div class="campo">
                    <label for="cp">Código Postal</label>
                    <input type="text" id="cp" name="cp" required>
                </div>
                <div class="campo">
                    <label for="horario">Horario</label>
                    <input type="text" id="horario" name="horario" required>
                </div>
                <div class="campo">
                    <label for="url">URL Imagen</label>
                    <input type="text" id="url" name="url" required>
                </div>

            <input class="boton" type="submit" value="Agregar Tienda" id= "add">

       </form>
        <?php
            }
        ?>
        

    </main>

    <?php
        $front->footer();
    ?> 

    
</body>
</html>