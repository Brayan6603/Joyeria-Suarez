<?php

// DEBUG
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
           
require_once 'lib/tcpdf/tcpdf.php';

require_once 'SQLUsuario.php';
require_once 'SQLVenta.php';
require_once 'SQLArticulo.php';


$cart = $_SESSION['article_cart'];
$totalGeneral = $_SESSION['totalGeneral'];
// unset($_SESSION['article_cart']);
// unset($_SESSION['totalGeneral']);
// $folio = intval($_SESSION['last_purchase_folio']);

// // Obtener ventas de este folio
// $sqlV = new SQLVenta();
// // Asumimos que tienes un método que devuelve por folio, si no, filtra manualmente
// $ventasDb = $sqlV->getVentasByFolio($folio);

$sqlArticulo = new SQLArticulo();

// GENERAR PDF CON TCPDF
$pdf = new \TCPDF('P', 'mm', [80, 200], true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(5, 5, 5);
$pdf->AddPage();

// Título y fecha
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 6, 'Joyeria Suarez', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 5, 'Fecha: ' . date('d/m/Y H:i:s'), 0, 1, 'C');
$pdf->Ln(2);

// Encabezados de columnas
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(40, 5, 'Artículo', 0);
$pdf->Cell(15, 5, 'Cant.', 0, 0, 'R');
$pdf->Cell(20, 5, 'Subtotal', 0, 1, 'R');
$pdf->Ln(1);

// Detalle completo del carrito
$pdf->SetFont('helvetica', '', 9);
foreach ($cart as $idArticulo => $cantidad) {
    $artRow = $sqlArticulo->getArticuloById($idArticulo)->fetch_assoc();
    $subtotal = $artRow['precio'] * intval($cantidad);
    // Limitar longitud de descripción
    $desc = strlen($artRow['descripcion']) > 20 ? substr($artRow['descripcion'], 0, 17) . '...' : $artRow['descripcion'];
    $pdf->Cell(40, 5, $desc, 0);
    $pdf->Cell(15, 5, intval($cantidad), 0, 0, 'R');
    $pdf->Cell(20, 5, '$' . number_format($subtotal, 2), 0, 1, 'R');
}

$pdf->Ln(2);
// Total general
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(55, 6, 'Total', 0);
$pdf->Cell(20, 6, '$' . number_format($totalGeneral, 2), 0, 1, 'R');

$pdf->Ln(4);
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 4, '¡Gracias por su compra!', 0, 1, 'C');


// Enviar PDF al navegador
$pdf->Output('ticket.pdf', 'I');

//exit;
