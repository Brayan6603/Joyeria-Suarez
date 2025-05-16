<?php
session_start();
include_once 'SQLArticulo.php';
include_once 'Articulo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove_item'])) {
        $removeId = intval($_POST['remove_item']);
        if (isset($_SESSION['cart'][$removeId])) {
            unset($_SESSION['cart'][$removeId]);
        }
        header('Location: verCarrito.php?id='.$_GET['id']);
        exit;
    }

    if (isset($_POST['proceed_payment'])) {
        echo '<form id="toPayment" action="procederPago.php?id='.$_GET['id'].'" method="POST">';
        foreach ($_SESSION['cart'] as $id => $qty) {
            echo '<input type="hidden" name="cart['.$id.']" value="'.$qty.'">';
        }
        echo '</form>';
        echo '<script>document.getElementById("toPayment").submit();</script>';
        exit;
    }
}

$sql = new SQLArticulo();
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
        <h2>Tu Carrito</h2>
        <?php if (empty($_SESSION['cart'])): ?>
            <p>El carrito está vacío.</p>
        <?php else: ?>
            <table class="carrito-table">
                <thead>
                    <tr>
                        <th>Artículo</th>
                        <th>Cantidad</th>
                        <th>Precio unit.</th>
                        <th>Subtotal</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $qty):
                    $res = $sql->getArticuloById($id);
                    if ($row = $res->fetch_assoc()):
                        $sub = $row['precio'] * $qty;
                        $total += $sub;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($row['descripcion']) ?></td>
                        <td><?= $qty ?></td>
                        <td>$<?= number_format($row['precio'], 2) ?></td>
                        <td>$<?= number_format($sub, 2) ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <button type="submit" name="remove_item" value="<?= $id ?>" class="boton-rojo small">
                                    &times;
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php 
                    endif;
                endforeach;
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align:right;"><strong>Total:</strong></td>
                        <td colspan="2"><strong>$<?= number_format($total, 2) ?></strong></td>
                    </tr>
                </tfoot>
            </table>
            <form method="POST">
                <button type="submit" name="proceed_payment" class="boton verde" id="proceed_payment">
                    Proceder al pago
                </button>
            </form>
        <?php endif; ?>
        <a href="productos.php?id=<?= $_GET['id'] ?>" class="boton boton-seguir-comprando">Seguir comprando</a>
    </main>
    <?php $front->footer(); ?>
</body>
</html>