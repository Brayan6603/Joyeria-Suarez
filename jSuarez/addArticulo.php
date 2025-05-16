<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Add Articulo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
        include "Front.php";
        include_once 'SQLLinea.php';
        include_once 'Linea.php';
        $front = new Front();
        $front->header();
        $front->navOpen();
        
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
        session_start();
        $username = $_SESSION['username'];
        $rol = $_SESSION['rol'];
        if(isset($rol) && $rol == 0){
            $rol = "root";
        }
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
            if(isset($_POST['descripcion']) && isset($_POST['idlinea']) && isset($_POST['caracteristicas']) && isset($_POST['precio']) && isset($_POST['imagen'])) {
                include_once 'SQLArticulo.php';
                include_once 'Articulo.php';
                $sqlArticulo = new SQLArticulo();
                $a = new Articulo();
                $a->setDescripcion($_POST['descripcion']);
                $a->setLinea($_POST['idlinea']);
                $a->setCaracteristicas($_POST['caracteristicas']);
                $a->setPrecio($_POST['precio']);
                $a->setImagen($_POST['imagen']);
                
                
                if($sqlArticulo->addArticulo($a)) {
                    echo "<p>Artículo agregado correctamente</p>";
                } else {
                    echo "<p>Error al agregar la artículo</p>";
                }
                echo '<a href="addArticulo.php?id='.$_GET['id'].'" class="boton">Volver</a>';
                
            } else {?>

    
        <h2>Agregar Artículo</h2>
        
       <?php echo '<form action="addArticulo.php?id='.$_GET['id'].'" method="POST" class="formulario">'; ?>
                
                <div class="campo">
                    <label for="descripcion">Descripción</label>
                    <input type="text" id="descripcion" name="descripcion" required>
                </div>
                <div class="campo">
                        <label  style="margin: 0 0 0 7.5rem;" for="linea">Linea</label>
                        <select id="idlinea" name="idlinea" required>
                         <!-- <option   value="0" selected disabled>-selecciona-</option> -->
                         <?php
                        $sqlLineas = new SQLLinea();
                        $lineas = $sqlLineas->getLineas();
                        foreach ($lineas as $linea) {
                            $l = new Linea();
                            $l->setIdLinea($linea['idLinea']);
                            $l->setNombreLinea($linea['descripcion']);
                            $l->setActivo($linea['activo']);
                            if($l->getActivo()==1) {
                                if($l->getIdLinea() == $_GET['id']) {
                                    echo '<option value="'.$l->getIdLinea().'" selected>'.$l->getNombreLinea().'</option>';
                                } else {
                                    echo '<option value="'.$l->getIdLinea().'">'.$l->getNombreLinea().'</option>';
                                }
                            }
                        }
                        ?>
                        </select>
                </div>
                <div class="campo">
                    <label for="caracteristicas">Características</label>
                    <input type="text" id="caracteristicas" name="caracteristicas" required>
                </div>
                <div class="campo">
                    <label for="precio">Precio</label>
                    <input type="number" step="0.1" id="precio" name="precio" required>
                </div>
                <div class="campo">
                    <label for="imagen">URL Imagen</label>
                    <input type="text" id="imagen" name="imagen" required>
                </div>

            <input class="boton" type="submit" value="Agregar" id= "add">

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