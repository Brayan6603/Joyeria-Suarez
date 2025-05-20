<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Add Existencias</title>
    <link rel="stylesheet" href="css/normalize.css">
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
    <a href="nuestrastiendas.php" class="navegacion__enlace">Nuestras Tiendas</a>
    <a href="nuestrosproductos.php" class="navegacion__enlace enlace-activo">Nuestros Productos</a>
    <?php
if($rol == "root"){
    echo '<a href="gestionar-usuarios.php" class="navegacion__enlace">Gestionar Usuarios</a>';
    echo '<a href="resumenes-estados.php" class="navegacion__enlace">Resumenes y Estados</a>';
}
$front->navClose();

if(isset($username)){
    echo '<script type="text/javascript" src="js/scripts.js"></script>';
    echo '<script>mostrarUsername("' . $username . '", "' . $rol . '");mostrarBotonLogOut();</script>';
}
?>

<main class="contenido-principal container grid-2 gapC">
<?php
if ($rol !== "root") {
    echo '<div><p>Acceso denegado</p><a href="index.php" class="boton">Volver a Inicio</a></div>';
    exit();
}

include_once 'SQLExistencia.php';
include_once 'Existencia.php';
include_once 'SQLArticulo.php';
include_once 'SQLTienda.php';
include_once 'Articulo.php';
include_once 'Tienda.php';

$sqlExistencia = new SQLExistencia();
$sqlArticulos  = new SQLArticulo();
$sqlTiendas    = new SQLTienda();

$listaArticulos = [];
$resultArticulos = $sqlArticulos->getAllArticulos();
while ($row = mysqli_fetch_array($resultArticulos)) {
    $listaArticulos[] = $row;
}
$primerArticulo = count($listaArticulos) > 0 ? $listaArticulos[0] : null;
$listaTiendas   = $sqlTiendas->getAllTiendas();


$filtroArticulo = isset($_GET['filtro_articulo']) && $_GET['filtro_articulo'] !== ''
    ? (int)$_GET['filtro_articulo']
    : ($primerArticulo ? (int)$primerArticulo['idArticulo'] : null);
$filtroTienda   = isset($_GET['filtro_tienda']) && $_GET['filtro_tienda'] !== ''
    ? (int)$_GET['filtro_tienda']
    : null;


echo '<form method="GET" class="formulario filtros">';
echo '<h2>Existencias</h2>';
echo '<h3>Filtrar Existencias</h3>';
echo '<div class="campo">';
echo '<label style="margin-left: 0rem" for="filtro_articulo">Artículo</label>';
echo '<select style="margin-right: 2rem" name="filtro_articulo" id="filtro_articulo">';
foreach ($listaArticulos as $art) {
    $a = new Articulo();
    $a->setId($art['idArticulo']);
    $a->setDescripcion($art['descripcion']);
    $selected = ($filtroArticulo == $a->getId()) ? 'selected' : '';
    echo '<option value="' . $a->getId() . '" ' . $selected . '>' . htmlspecialchars($a->getDescripcion()) . '</option>';
}
echo '</select>';
echo '</div>';
echo '<div class="campo">';
echo '<label for="filtro_tienda">Tienda</label>';
echo '<select name="filtro_tienda" id="filtro_tienda">';
echo '<option value="">Todas</option>';
foreach ($listaTiendas as $tienda) {
    $t = new Tienda();
    $t->setId($tienda['idTienda']);
    $t->setDescripcion($tienda['descripcion']);
    $selected = $filtroTienda === (int)$t->getId() ? 'selected' : '';
    echo '<option value="' . $t->getId() . '" ' . $selected . '>' . htmlspecialchars($t->getDescripcion()) . '</option>';
}
echo '</select>';
echo '</div>';
echo '<button type="submit" class="boton" style="margin-top:1rem;">Aplicar filtros</button>';
echo '<a href="addExistencias.php" class="boton min-boton">Limpiar filtros</a>';
echo '</form>';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idarticulo'], $_POST['idtienda'], $_POST['cantidad']) && !isset($_POST['action'])) {
    $e = new Existencia();
    $e->setIdArticulo((int)$_POST['idarticulo']);
    $e->setIdTienda((int)$_POST['idtienda']);
    $e->setCantidad((int)$_POST['cantidad']);

    if ($sqlExistencia->addExistencia($e)) {
        echo '<div><p>Existencia agregada correctamente</p>';
    } else {
        echo '<div><p>Error al agregar la existencia</p>';
    }
    echo '<a href="addExistencias.php" class="boton">Volver</a></div>';
} else {
    echo '<form action="addExistencias.php" method="POST" class="formulario">';
    echo '<h3>Agregar Nueva Existencia</h3>';
    echo '<div class="campo">';
    echo '<label for="idarticulo">Id Artículo</label>';
    echo '<select name="idarticulo" id="idarticulo" required>';
    foreach ($listaArticulos as $art) {
        $a = new Articulo();
        $a->setId($art['idArticulo']);
        $a->setDescripcion($art['descripcion']);
        echo '<option value="' . $a->getId() . '">'.$a->getDescripcion(). '</option>';
    }
    echo '</select>';
    echo '</div>';
    echo '<div class="campo">';
    echo '<label for="idtienda">Id Tienda</label>';
    echo '<select name="idtienda" id="idtienda" required>';
    foreach ($listaTiendas as $tienda) {
        $t = new Tienda();
        $t->setId($tienda['idTienda']);
        $t->setDescripcion($tienda['descripcion']);
        echo '<option value="' . $t->getId() . '">'.$t->getDescripcion(). '</option>';
    }
    echo '</select>';
    echo '</div>';
    echo '<div class="campo">';
    echo '<label style="padding-right: 2rem;" for="cantidad">Cantidad</label>';
    echo '<input style="margin-right: 12rem;" type="number" step="1" id="cantidad" name="cantidad" required>';
    echo '</div>';
    echo '<input class="boton" type="submit" value="Agregar" id="add">';
    echo '</form>';

    $rows = $sqlExistencia->getExistenciasFiltered($filtroArticulo, $filtroTienda);
    if ($rows) {
        echo "<div class='divExistencias'><h2>Existencias</h2><table class='tablaExistencias'>";
        echo "<tr><th>Id Artículo</th><th>Artículo</th><th>Id Tienda</th><th>Tienda</th><th>Cantidad</th><th>Acción</th></tr>";
        foreach ($rows as $row) {
            $exi = new Existencia();
            $exi->setIdArticulo($row['idArticulo']);
            $exi->setIdTienda($row['idTienda']);
            $exi->setCantidad($row['cantidad']);
            $exi->setNombreArticulo($row['articulo']);
            $exi->setNombreTienda($row['tienda']);
            echo '<tr><form action="updateExistencias.php" method="POST">';
            echo '<td><input type="hidden" name="idarticulo" value="' . $exi->getIdArticulo() . '" />' . $exi->getIdArticulo() . '</td>';
            echo '<td>' . $exi->getNombreArticulo() . '</td>';
            echo '<td><input type="hidden" name="idtienda" value="' . $exi->getIdTienda() . '" />' . $exi->getIdTienda() . '</td>';
            echo '<td>' . $exi->getNombreTienda() . '</td>';
            echo '<td><input type="number" name="cantidad" value="' . $exi->getCantidad() . '" step="1" required /></td>';
            echo '<td><input type="hidden" name="action" value="update" /><button type="submit" class="boton azul">Actualizar</button></td>';
            echo '</form></tr>';
            $totalCantidad += $exi->getCantidad();
        }
        echo '<tr><td colspan="4" style="text-align: right;"><strong>Recuento Total:</strong></td>';
        echo '<td colspan="2"><strong>' . $totalCantidad . '</strong></td>';
        echo '</table></div>';
    } else {
        echo '<p>No hay existencias para esos criterios.</p>';
    }
}
?>
</main>
<?php
$front->footer();
?>