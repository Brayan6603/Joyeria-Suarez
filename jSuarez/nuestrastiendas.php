<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Nuestras Tiendas</title>
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
        if($rol == "root" && isset($username)){
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
        if(!($_POST['boton-ud'])){
    ?>

    <section>
        <div class="imagenes__segunda imagen">
            <div class="imagenes__contenido transparencia_alter">
                <h2>UN NUEVO CONCEPTO DE TIENDAS</h2>
                <p class="alcenter">"Encuentre su tienda más cercana y descubra nuestra historia, nuestras colecciones y nuestra esencia."</p>
            </div>
        </div>
    </section>
    <?php
        }
    ?>

    <main class="contenido-principal container">
        
        
        <?php
            
            if($rol == "root") {
                if(!($_POST['boton-ud'])) {
                    echo '<div class="main-box">';
                    echo '<h2>Todas Las Tiendas</h2>';
                    echo '<a href="addTienda.php" class="boton verde">Agregar Tienda</a>';
                    echo '</div>';
                } 
                
            } else {
                if(!($_POST['boton-ud'])) {
                    echo '<h2>Todas Las Tiendas</h2>';
                } else{
                    echo '<h2>Modificar Tienda</h2>';
                }
                
            }
        ?>
        
        
        
        <div class="tiendas">
            <?php
                
                if(!($_POST['id'])){

                include_once 'SQLTienda.php';
                include_once 'Tienda.php';
                $sqlTienda = new SQLTienda();
                $tiendas = $sqlTienda->getAllTiendas();
                $tiendasEnabled = $sqlTienda->getEnableTiendas();

                if($rol == "root") {
                    foreach ($tiendas as $tienda) {
                        $t = new Tienda();
                        $t->setId($tienda['idTienda']);
                        $t->setDescripcion($tienda['descripcion']);
                        $t->setCiudad($tienda['ciudad']);
                        $t->setDireccion($tienda['direccion']);
                        $t->setCp($tienda['cp']);
                        $t->setHorario($tienda['horario']);
                        $t->setUrl($tienda['imagen']);
    
                        echo '<div class="tienda">';
                        echo '<div class="tienda__imagen">';
                        echo '<img src="'.$t->getUrl().'" alt="tienda">';
                        echo '</div>';
                        echo '<div class="tienda__informacion">';
                        echo '<h4>'.$t->getDescripcion().'</h4>';
                        echo '<p>'.$t->getDireccion().'</p>';
                        echo '<p>'.$t->getCp().' '.$t->getCiudad().'</p>';
                        echo '<p>HORARIO</p>';
                        echo '<p>'.$t->getHorario().'</p>';
                        echo '</div>';
                        echo '<form action="nuestrastiendas.php" method="POST" id="form-ud">';
                        echo '<input type="hidden" name="id" value="'.$t->getId().'">';
                        echo '<input type="submit" class="boton azul" name = "boton-ud" value="modificar">';
                        include_once 'SQLTienda.php';
                        $slqT = new SQLTienda();
                        $activo = $slqT->getIfTiendaEnable($t->getId());
                        if($activo == 1){
                            echo '<input type="submit" class="boton rojo" name = "boton-ud" value="desactivar">';
                        } else{
                            echo '<input type="submit" class="boton morado" name = "boton-ud" value="activar">';
                        }
                        //echo '<input type="submit" class="boton rojo" name = "boton-ud" value="eliminar">';
                        echo '</form>';
                        echo '</div>';
                        }
                
                
                } else{
                    foreach ($tiendasEnabled as $tienda) {
                        $t = new Tienda();
                        $t->setId($tienda['id']);
                        $t->setDescripcion($tienda['descripcion']);
                        $t->setCiudad($tienda['ciudad']);
                        $t->setDireccion($tienda['direccion']);
                        $t->setCp($tienda['cp']);
                        $t->setHorario($tienda['horario']);
                        $t->setUrl($tienda['imagen']);
    
                        echo '<div class="tienda">';
                        echo '<div class="tienda__imagen">';
                        echo '<img src="'.$t->getUrl().'" alt="tienda">';
                        echo '</div>';
                        echo '<div class="tienda__informacion">';
                        echo '<h4>'.$t->getDescripcion().'</h4>';
                        echo '<p>'.$t->getDireccion().'</p>';
                        echo '<p>'.$t->getCp().' '.$t->getCiudad().'</p>';
                        echo '<p>HORARIO</p>';
                        echo '<p>'.$t->getHorario().'</p>';
                        echo '</div>';
                        echo '</div>';
                        }
                }
            } else{
                include_once 'SQLTienda.php';
                include_once 'Tienda.php';
                $id = $_POST['id'];
                $boton = $_POST['boton-ud'];
               
                
                if($boton == "modificar"){
                    
                    $sqlTienda = new SQLTienda();
                    $tienda = $sqlTienda->getTiendaById($id);
                
                    if(mysqli_num_rows($tienda) > 0){
                        
                    while($tiendaRow = mysqli_fetch_array($tienda)){

                    $t = new Tienda();
                    $t->setId($tiendaRow['idTienda']);
                    $t->setDescripcion($tiendaRow['descripcion']);
                    $t->setCiudad($tiendaRow['ciudad']);
                    $t->setDireccion($tiendaRow['direccion']);
                    $t->setCp($tiendaRow['cp']);
                    $t->setHorario($tiendaRow['horario']);
                    $t->setUrl($tiendaRow['imagen']);

                    
                    
                    echo '<form action="updateTienda.php" method="POST" class="formulario" style="grid-column: 2/3;">';
                    echo '<h2>Modificar Tienda</h2>';
                    echo '<div class="campo">';
                    echo '<label for="id">Id</label>';
                    echo '<input type="text" id="id" name="id" value="'.$t->getId().'" readonly>';
                    echo '</div>';
                    echo '<div class="campo">';
                    echo '<label for="descripcion">Descripción</label>';
                    echo '<input type="text" id="descripcion" name="descripcion" value="'.$t->getDescripcion().'" required>';
                    echo '</div>';
                    echo '<div class="campo">';
                    echo '<label for="ciudad">Ciudad</label>';
                    echo '<input type="text" id="ciudad" name="ciudad" value="'.$t->getCiudad().'" required>';
                    echo '</div>';
                    echo '<div class="campo">';
                    echo '<label for="direccion">Dirección</label>';
                    echo '<input type="text" id="direccion" name="direccion" value="'.$t->getDireccion().'" required>';
                    echo '</div>';
                    echo '<div class="campo">';
                    echo '<label for="cp">Código Postal</label>';
                    echo '<input type="text" id="cp" name="cp" value="'.$t->getCp().'" required>';
                    echo '</div>';
                    echo '<div class="campo">';
                    echo '<label for="horario">Horario</label>';
                    echo '<input type="text" id="horario" name="horario" value="'.$t->getHorario().'" required>';
                    echo '</div>';
                    echo '<div class="campo">';
                    echo '<label for="url">URL Imagen</label>';
                    echo '<input type="text" id="url" name="url" value="'.$t->getUrl().'" required>';
                    echo '</div>';
                    echo '<input type="submit" class="boton" name="update" id="update" value="Modificar">';
                    echo '</form>';
                    
                    
                 }
                }
                   
                    
                }

                if($boton == "desactivar"){
                    $sqlTienda = new SQLTienda();
                    $sqlTienda->disableTienda($id);
                    echo '<div>';
                    echo '<p>Tienda Deshabilitada correctamente</p>';
                    echo '<a href="nuestrastiendas.php" class="boton">Volver</a>';
                    echo '</div>';
                }
                if($boton == "activar"){
                    $sqlTienda = new SQLTienda();
                    $sqlTienda->enableTienda($id);
                    echo '<div>';
                    echo '<p>Tienda Habilitada correctamente</p>';
                    echo '<a href="nuestrastiendas.php" class="boton">Volver</a>';
                    echo '</div>';
                }
            }

            ?>


        </div>
        <!-- fin div de tiendas -->
            
        

    </main>

    <?php
        $front->footer();
    ?> 

    
</body>
</html>