<?php
session_start();
include_once 'SQLArticulo.php';
include_once 'Articulo.php';

if (!isset($_POST['cart']) || empty($_POST['cart'])) {
    header('Location: verCarrito.php');
    exit;
}

$cart = $_POST['cart'];
$sql = new SQLArticulo();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proceder al Pago</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <h2>Resumen de tu Pedido</h2>
    <table class="carrito-table">
        <thead>
            <tr>
                <th>Artículo</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $total = 0;
            foreach ($cart as $id => $cantidad):
                $res = $sql->getArticuloById($id);
                if ($row = $res->fetch_assoc()):
                    $subtotal = $row['precio'] * $cantidad;
                    $total += $subtotal;
        ?>
            <tr>
                <td><?= htmlspecialchars($row['descripcion']) ?></td>
                <td><?= intval($cantidad) ?></td>
                <td>$<?= number_format($row['precio'], 2) ?></td>
                <td>$<?= number_format($subtotal, 2) ?></td>
            </tr>
        <?php
                endif;
            endforeach;
        ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                <td><strong>$<?= number_format($total, 2) ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top: 2rem;">
        <form action="finalizarCompra.php?id=<?= $_GET['id'] ?>" method="POST">
            <?php foreach ($cart as $id => $cantidad): ?>
                <input type="hidden" name="cart[<?= $id ?>]" value="<?= $cantidad ?>">
            <?php endforeach; ?>
            <button type="submit" class="boton verde" id="confirm">Confirmar Pedido</button>
        </form>
        <a href="verCarrito.php?id=<?= $_GET['id'] ?>" class="boton">Volver al carrito</a>
    </div>
</main>
<?php $front->footer(); ?>
</body>
</html>