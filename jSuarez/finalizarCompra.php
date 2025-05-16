<?php
session_start();

include_once 'SQLArticulo.php';
include_once 'Articulo.php';
include_once 'Venta.php';
include_once 'SQLVenta.php';
include_once 'Existencia.php';
include_once 'SQLExistencia.php';
include_once 'Usuario.php';
include_once 'SQLUsuario.php';

// Validar carrito
if (!isset($_POST['cart']) || empty($_POST['cart'])) {
    header('Location: verCarrito.php?id='.$_GET['id']);
    exit;
}

//  Obtener idCliente a partir de el username en sesión
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$sqlUsuario = new SQLUsuario();
$resultUsuario = $sqlUsuario->getIdByUsername($username);
if ($rowUser = mysqli_fetch_assoc($resultUsuario)) {
    $idCliente = intval($rowUser['idCliente']);
} else {
    // Usuario no encontrado, redirigir
    header('Location: verCarrito.php?id='.$_GET['id']);
    exit;
}

//  SQL instancias
$sqlArticulo   = new SQLArticulo();
$sqlVenta      = new SQLVenta();
$sqlExistencia = new SQLExistencia();

$errores = [];

//  Procesar cada ítem tomar de tienda con más stock primero
foreach ($_POST['cart'] as $idArticulo => $cantidadTotal) {
    $cantidadRestante = $cantidadTotal;
    // Obtener existencias ordenadas por cantidad DESC(decendente)
    $exiQuery = new Existencia();
    $exiQuery->setIdArticulo($idArticulo);
    $existencias = $sqlExistencia->getExistenciasByArticulo($exiQuery);

    while ($cantidadRestante > 0 && $rowEx = mysqli_fetch_assoc($existencias) ) {
        $tiendaId = intval($rowEx['idTienda']);
        $stock    = intval($rowEx['cantidad']);
        if ($stock <= 0) continue;
        $toSubtract = min($stock, $cantidadRestante);

        // Registrar venta parcial
        $venta = new Venta();
        $venta->setIdArticulo($idArticulo);
        $venta->setIdCliente($idCliente);
        $venta->setIdTienda($tiendaId);
        $venta->setFecha(date('Y-m-d H:i:s'));
        $venta->setCantidad($toSubtract);
        // Obtener precio actual
        $artRow = $sqlArticulo->getArticuloById($idArticulo)->fetch_assoc();
        $venta->setTotal($artRow['precio'] * $toSubtract);

        $_SESSION['totalGeneral'] += $venta->getTotal();
        // Insertar venta
        $folioVenta = $sqlVenta->insertVenta($venta);
        if ($folioVenta === false) {
            $errores[] = "Error al registrar la venta.";
            } 

        // Descontar existencia
        $exiDec = new Existencia();
        $exiDec->setIdArticulo($idArticulo);
        $exiDec->setIdTienda($tiendaId);
        $exiDec->setCantidad($toSubtract);
        if (!$sqlExistencia->substractExistencia($exiDec)) {
            $errores[] = "Error al descontar stock artículo $idArticulo en tienda $tiendaId.";
        }

        $cantidadRestante -= $toSubtract;
    }

    if ($cantidadRestante > 0) {
        $errores[] = "No hay stock suficiente para artículo ID $idArticulo. Quedaron $cantidadRestante sin surtir.";
    }
}

$_SESSION['article_cart'] = $_POST['cart'];
//  Limpiar carrito
unset($_SESSION['cart']);


//exit;


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra Finalizada</title>
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
<main class="container contenido-principal">
    <h2>Resultado de la Compra</h2>

    <?php if (empty($errores)): ?>
        <p>¡Tu compra se ha registrado correctamente!</p>
        <a href="ticketTCPDF.php" class="boton boton-seguir-comprando" target="_blank">Ticket de Compra</a>
        <a href="productos.php?id=<?= $_GET['id'] ?>" class="boton boton-seguir-comprando">Seguir Comprando</a>
    <?php else: ?>
        <div class="alerta alerta-error">
            <h3>Se encontraron errores:</h3>
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <a href="verCarrito.php?id=<?= $_GET['id'] ?>" class="boton">Volver al Carrito</a>
    <?php endif; ?>

</main>
<?php $front->footer(); ?>
</body>
</html>