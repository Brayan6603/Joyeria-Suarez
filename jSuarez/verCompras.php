<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: signIn.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Carrito</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    
    <?php
        $front->navClose();
        session_start();
        $username = $_SESSION['username'];
        $rol = $_SESSION['rol'];
        if($rol == 0){
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
    <main class="container contenido-principal flex">
        <h2>Mis compras</h2>
        <div class="compras">
            <?php
               include_once 'SQLUsuario.php';
               include_once 'Venta.php';
               include_once 'SQLVenta.php';
                include_once 'SQLArticulo.php';
                include_once 'Articulo.php';

               $sqlUsuario = new SQLUsuario();
               $idCliente = $sqlUsuario->getIdByUsername($username);
               $idCliente = mysqli_fetch_assoc($idCliente);
               $idCliente = $idCliente['idCliente'];
                $sqlVenta = new SQLVenta();
                $ventas = $sqlVenta->getVentasByIdClienteAndOrderDesc($idCliente);
                $sqlArticulo = new SQLArticulo();
                
                if($ventas){
                    foreach($ventas as $venta){
                        $v = new Venta();
                        $v->setIdCliente($venta['idCliente']);
                        $v->setFolio($venta['folio']);
                        $v->setFecha($venta['fecha']);
                        $v->setTotal($venta['total']);
                        $v->setIdArticulo($venta['idArticulo']);
                        $v->setCantidad($venta['cantidad']);

                        $rowArticulo = $sqlArticulo->getArticuloById($v->getIdArticulo());
                        $rowArticulo = mysqli_fetch_assoc($rowArticulo);
                       
                        $a = new Articulo();
                        $a->setDescripcion($rowArticulo['descripcion']);
                        $a->setImagen($rowArticulo['img']);
                        
                        echo "<div class='compra'>";
                        echo '<div class="compra__img">';
                        echo '<img src="'.$a->getImagen().'" alt="imagen">';
                        echo "</div>";
                        echo '<div class="compra__info">';
                        echo "<p>Folio: ".$v->getFolio()."</p>";
                        echo "<p>Articulo: ".$a->getDescripcion()."</p>";
                        echo "<p>Fecha: ".$v->getFecha()."</p>";
                        echo "<p>Cantidad: ".$v->getCantidad()."</p>";
                        echo "<p>Total: $".$v->getTotal()."</p>";
                        echo '</div>';
                        echo "</div>";
                    }
                } else {
                    echo "<p>No tienes compras registradas.</p>";
                }
            ?>
    </main>
    <?php $front->footer(); ?>
</body>
</html>