<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros Productos - Productos</title>
    <link rel="stylesheet" href="css/normalize.css">
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
                if($l->getIdLinea() == $_GET['id']) {
                    echo '<a href="productos.php?id='.$l->getIdLinea().'" class="navegacion__enlace enlace-activo">'.$l->getNombreLinea().'</a>';
                } else {
                echo '<a href="productos.php?id='.$l->getIdLinea().'" class="navegacion__enlace">'.$l->getNombreLinea().'</a>';
            }}
        }


    ?>
            
            <!-- <a href="compras.php" class="navegacion__enlace">Compras</a> -->
    <?php
        $front->navClose();
        session_start();
        unset($_SESSION['article_cart']);
        unset($_SESSION['totalGeneral']);
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
            $sqlLineaActual = new SQLLinea();
            $rows = $sqlLineaActual->getLineaById($_GET['id']);
            foreach ($rows as $row) {
                $lineaActual = new Linea();
                $lineaActual->setIdLinea($row['idLinea']);
                $lineaActual->setNombreLinea($row['descripcion']);
                $lineaActual->setActivo($row['activo']);
            }

            
            if($lineaActual->getActivo()==0) {
                echo '<div class="alerta alerta-error">';
                echo '<p>La línea de productos no está activa</p>';
                echo '<a href="nuestrosproductos.php" class="boton">Salir</a>';
            } else {
               
            

            
            if($rol == "root") {
                if(!($_POST['boton-ud'])) {
                   echo '<div class="producto-type-title">';
                   echo '<h2 style="margin-bottom: 0;">New '.$lineaActual->getNombreLinea().'</h2>';
                   echo '<h3 style="font-size: 1.8rem;"> summer 2025</h3>';
                   echo '<a href="addArticulo.php?id='.$lineaActual->getIdLinea().'" class="boton verde">Agregar</a>';
                   echo '</div>';

                    // echo '<div class="main-box">';
                    // echo '<h2>Todas Las Tiendas</h2>';
                    // echo '<a href="addTienda.php" class="boton verde">Agregar Tienda</a>';
                    // echo '</div>';
                } 
                
            } else {
                if(!($_POST['boton-ud'])) {
                    echo '<div class="producto-type-title">';
                    echo '<h2 style="margin-bottom: 0;">New '.$lineaActual->getNombreLinea().'</h2>';
                    echo '<h3 style="font-size: 1.8rem;"> summer 2025</h3>';
                    if (isset($_SESSION['username']) && $_SESSION['username'] != "root") {
               
               
                        if(!isset($_SESSION['cart'])) {
                            $total = 0;
                        } else{
                            $total = count($_SESSION['cart']);
                        }
                        echo '<a href="verCarrito.php?id='.$lineaActual->getIdLinea().'" class="boton boton-car"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg> ('.$total.')</a>';
                        echo '<a id="compra-boton" href="verCompras.php" class="boton">Mis Compras</a>';  
                    }
                    echo '</div>';
                    
                } /*else{
                    echo '<h2>Modificar Articulo</h2>';
                }*/
                
            }
        ?>

        <!-- <div class="producto-type-title">
            <h2 style="margin-bottom: 0;">Nuevas Colecciones</h2>
            <h3 style="font-size: 1.8rem;"> summer 2025</h3>
        </div> -->
        <div class="productos">
            <?php

            if(!($_POST['id'])){

                if($rol != "root") {
                    include_once 'SQLArticulo.php';
                    include_once 'Articulo.php';
                    $sqlArticulo = new SQLArticulo();
                    $articulos = $sqlArticulo->getArticulosByLineaAndEnable($_GET['id']); 
                    foreach ($articulos as $articulo) {
                        $a = new Articulo();
                        $a->setId($articulo['idArticulo']);
                        $a->setLinea($articulo['idLinea']);
                        $a->setDescripcion($articulo['descripcion']);
                        $a->setCaracteristicas($articulo['caracteristicas']);
                        $a->setPrecio($articulo['precio']);
                        $a->setImagen($articulo['img']);

                        echo '<div class="producto">';
                        echo '<div class="producto__imagen">';
                        echo '<img src="'.$a->getImagen().'" alt="imagenproducto">';
                        echo '</div>';
                        echo '<div class="producto__informacion">';
                        echo '<h4>'.$a->getDescripcion().'</h4>';
                        echo '<p>'.$a->getCaracteristicas().'</p>';
                        echo '<p>$'.$a->getPrecio().'</p>';
                        echo '<form class="formulario" method="POST" action="agregarAlCarrito.php?id='.$lineaActual->getIdLinea().'">';
                        echo '<div class="formulario__carrito">';
                        echo '<input type="hidden" name="idArticulo" value="'.$a->getId().'">';
                        echo '<input name="cantidad" type="number" placeholder="Cantidad" min="1" required>';
                        echo '<input class="boton" type="submit" value="Agregar al Carrito">';
                        echo '</div>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }
            }//if $user != root
                else {
                    include_once 'SQLArticulo.php';
                    include_once 'Articulo.php';
                    $sqlArticulo = new SQLArticulo();
                    $articulos = $sqlArticulo->getArticulosByLinea($_GET['id']); 
                    foreach ($articulos as $articulo) {
                        $a = new Articulo();
                        $a->setId($articulo['idArticulo']);
                        $a->setLinea($articulo['idLinea']);
                        $a->setDescripcion($articulo['descripcion']);
                        $a->setCaracteristicas($articulo['caracteristicas']);
                        $a->setPrecio($articulo['precio']);
                        $a->setImagen($articulo['img']);

                        echo '<div class="producto">';
                        echo '<div class="producto__imagen">';
                        echo '<img src="'.$a->getImagen().'" alt="imagenproducto">';
                        echo '</div>';
                        echo '<div class="producto__informacion">';
                        echo '<h4>'.$a->getDescripcion().'</h4>';
                        echo '<p>'.$a->getCaracteristicas().'</p>';
                        echo '<p>$'.$a->getPrecio().'</p>';
                        echo '</div>';
                        echo '<form action="productos.php?id='.$lineaActual->getIdLinea().'" method="POST" id="form-ud">';
                        echo '<div>';
                        echo '<input style="font-size:1.2rem;" id="input-id" type="number" name="id" value="'.$a->getId().'"readonly>';
                        echo '</div>';
                        echo '<input type="submit" class="boton azul" name = "boton-ud" style="padding-left: 1.5rem; padding-right: 1.5rem;" value="modificar">';
                        $estado = $sqlArticulo->getEstadoArticulo($a->getId());
                        if($estado == 1) {
                            echo '<input type="submit" class="boton rojo" style="padding-left: 1rem; padding-right: 1rem;" name = "boton-ud" value="desactivar">';
                        } else {
                            echo '<input type="submit" class="boton morado" name = "boton-ud" value="activar">';
                        }
                        //echo '<input type="submit" class="boton rojo" name = "boton-ud" value="eliminar">';
                        echo '</form>';
                        echo '</div>';
                    }
                }//else $user != root
        } //if ! post id
        else {
            include_once 'SQLArticulo.php';
            include_once 'Articulo.php';

            $id = $_POST['id'];
            $boton = $_POST['boton-ud'];

            if($boton == "modificar") {
                $sqlArticulo = new SQLArticulo();
                $articulo = $sqlArticulo->getArticuloById($id);

                if(mysqli_num_rows($articulo) > 0) {
                    
                    while($articuloRow = mysqli_fetch_array($articulo)) {
                        $a = new Articulo();
                        $a->setId($articuloRow['idArticulo']);
                        $a->setLinea($articuloRow['idLinea']);
                        $a->setDescripcion($articuloRow['descripcion']);
                        $a->setCaracteristicas($articuloRow['caracteristicas']);
                        $a->setPrecio($articuloRow['precio']);
                        $a->setImagen($articuloRow['img']);

                        echo '<form action="updateArticulo.php?id='.$lineaActual->getIdLinea().'" method="POST" class="formulario" style="grid-column: 2/4;">';
                        echo '<h2>Modificar Artículo</h2>';
                        echo '<div class="campo">';
                        echo '<label for="id">Id</label>';
                        echo '<input type="number" id="id" name="id" value="'.$a->getId().'" readonly>';
                        echo '</div>';
                        echo '<div class="campo">';
                        echo '<label for="descripcion">Descripción</label>';
                        echo '<input type="text" id="descripcion" name="descripcion" value="'.$a->getDescripcion().'" required>';
                        echo '</div>';
                        echo '<div class="campo">';
                        echo '<label style="margin: 0 0 0 9rem;" for="linea">Linea</label>';
                        echo '<select id="idlinea" name="idlinea" required>';
                        $sqlLineas = new SQLLinea();
                        $lineas = $sqlLineas->getLineas();
                        foreach ($lineas as $linea) {
                            $l = new Linea();
                            $l->setIdLinea($linea['idLinea']);
                            $l->setNombreLinea($linea['descripcion']);
                            $l->setActivo($linea['activo']);
                            if($l->getActivo()==1) {
                                if($l->getIdLinea() == $a->getLinea()) {
                                    echo '<option value="'.$l->getIdLinea().'" selected>'.$l->getNombreLinea().'</option>';
                                } else {
                                    echo '<option value="'.$l->getIdLinea().'">'.$l->getNombreLinea().'</option>';
                                }
                            }
                        }
                        
                        echo '</select>';
                        echo '</div>';
                        echo '<div class="campo">';
                        echo '<label for="caracteristicas">Características</label>';
                        echo '<input type="text" id="caracteristicas" name="caracteristicas" value="'.$a->getCaracteristicas().'" required>';
                        echo '</div>';
                        echo '<div class="campo">';
                        echo '<label for="precio">Precio</label>';
                        echo '<input type="number" step="0.1" id="precio" name="precio" value="'.$a->getPrecio().'" required>';
                        echo '</div>';
                        echo '<div class="campo">';
                        echo '<label for="imagen">URL Imagen</label>';
                        echo '<input type="text" id="imagen" name="imagen" value="'.$a->getImagen().'" required>';
                        echo '</div>';
                        echo '<input type="submit" class="boton" name="update" id="update" value="Modificar">';
                        echo '</form>';
                    }
                    
                }
            } else if ($boton == "desactivar") {
                $sqlArticulo = new SQLArticulo();
                if($sqlArticulo->disableArticulo($id)) {
                    echo '<div class="alerta alerta-exito">';
                    echo '<p>Artículo deshabilitado correctamente</p>';
                    echo '<a href="productos.php?id='.$lineaActual->getIdLinea().'" class="boton">Volver</a>';
                    echo '</div>';
                } else {
                    echo '<div class="alerta alerta-error">';
                    echo '<p>Error al deshabilitar el artículo</p>';
                    echo '<a href="productos.php?id='.$lineaActual->getIdLinea().'" class="boton">Volver</a>';
                    echo '</div>';
                }
            } else if ($boton == "activar") {
                $sqlArticulo = new SQLArticulo();
                if($sqlArticulo->enableArticulo($id)) {
                    echo '<div class="alerta alerta-exito">';
                    echo '<p>Artículo habilitado correctamente</p>';
                    echo '<a href="productos.php?id='.$lineaActual->getIdLinea().'" class="boton">Volver</a>';
                    echo '</div>';
                } else {
                    echo '<div class="alerta alerta-error">';
                    echo '<p>Error al habilitar el artículo</p>';
                    echo '<a href="productos.php?id='.$lineaActual->getIdLinea().'" class="boton">Volver</a>';
                    echo '</div>';
                }
            }
            


        }//else ! post id


            ?>

        </div>
        <?php
            }
        ?>
    </main>

    <?php
        $front->footer();
    ?>  

</body>
</html>