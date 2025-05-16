<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idArticulo = intval($_POST['idArticulo']);
    $cantidad = intval($_POST['cantidad']);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$idArticulo])) {
        $_SESSION['cart'][$idArticulo] += $cantidad;
    } else {
        $_SESSION['cart'][$idArticulo] = $cantidad;
    }
}

header("Location: verCarrito.php?id=".$_GET['id']);
exit;
?>
