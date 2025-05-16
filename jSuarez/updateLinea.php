<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Update Lineas</title>
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

include_once 'Linea.php';
include_once 'SQLLinea.php';

$sqlLinea = new SQLLinea();




if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idlinea'])) {
    $lineaRow = $sqlLinea->getLineaById($_POST['idlinea']);
    foreach($lineaRow as $row){
        $linea = new Linea();
        $linea->setIdLinea($row['idLinea']);
        $linea->setNombreLinea($row['descripcion']);
        $linea->setActivo($row['activo']);
    }
   
    echo '<form action="updateLinea.php" method="POST" class="formulario">';
    echo '<h3>Actualizar Linea de Artículos</h3>';
    echo '<div class="campo">';
    echo '<label for="nombrelinea">Nombre de linea</label>';
    echo '<input type="text" id="nombrelinea" name="nombrelinea" value ="'.$linea->getNombreLinea().'" required>';
    echo '</div>';
    echo '<div class="campo">';
    echo '<label for="activa">Activa</label>';
    echo '<input type="checkbox" id="activa" name="activa" value="1" '.($linea->getActivo() == 1 ? 'checked' : '').'>';
    echo '</div>';
    echo '<input class="boton" type="submit" value="Actualizar" name="update" id="update">';
    echo '<input type="hidden" name="id" value="'.$linea->getIdLinea().'">';
    echo '</form>';
   
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['nombrelinea']) && isset($_POST['update'])) {
    $linea = new Linea();
    $linea->setIdLinea($_POST['id']);
    $linea->setNombreLinea($_POST['nombrelinea']);
    $linea->setActivo(isset($_POST['activa']) ? 1 : 0);
    if ($sqlLinea->updateLinea($linea)) {
        echo '<div><p>Linea de artículos actualizada correctamente</p>';
    } else {
        echo '<div><p>Error al actualizar la linea de artículos</p>';
    }
    echo '<a href="addLineas.php" class="boton">Volver</a></div>';
} else {
    echo '<div><p>Error: No se ha enviado el ID de la línea de artículos</p>';
    echo '<a href="addLineas.php" class="boton">Volver</a></div>';
}


?>
</main>
<?php
$front->footer();
?>