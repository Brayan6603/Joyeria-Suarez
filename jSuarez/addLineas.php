<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Add Lineas</title>
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

include_once 'Linea.php';
include_once 'SQLLinea.php';

$sqlLinea = new SQLLinea();




if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombrelinea'])) {
    $linea = new Linea();
    $linea->setNombreLinea($_POST['nombrelinea']);
    $linea->setActivo(1);
    if ($sqlLinea->addLinea($linea)) {
        echo '<div><p>Linea de artículos agregada correctamente</p>';
    } else {
        echo '<div><p>Error al agregar la linea de artículos</p>';
    }
    echo '<a href="addLineas.php" class="boton">Volver</a></div>';
} else {
    echo '<form action="addLineas.php" method="POST" class="formulario">';
    echo '<h3>Agregar Nueva Linea de Artículos</h3>';
    echo '<div class="campo">';
    echo '<label for="nombrelinea">Nombre de linea</label>';
    echo '<input type="text" id="nombrelinea" name="nombrelinea" required>';
    echo '</div>';
    echo '<input class="boton" type="submit" value="Agregar" id="add">';
    echo '</form>';

    $rows = $sqlLinea->getLineas();
    if ($rows) {
        echo "<div class='divLineas'><h2>Lineas de Artículos</h2><table class='tablaLineas'>";
        echo "<tr><th>Id Linea</th><th>Nombre Linea</th><th>Activo</th><th>Acción</th></tr>";
        foreach ($rows as $row) {
            $linea = new Linea();
            $linea->setIdLinea($row['idLinea']);
            $linea->setNombreLinea($row['descripcion']);
            $linea->setActivo($row['activo']);
            echo '<tr><form action="updateLinea.php" method="POST">';
            echo '<td>' . $linea->getIdLinea() . '</td>';
            echo '<td>' . $linea->getNombreLinea() . '</td>';
            echo '<td>' . ($linea->getActivo() ? 'Sí' : 'No') . '</td>';
            echo '<td><input type="hidden" name="idlinea" value="' . $linea->getIdLinea() . '">';
            echo '<input type="submit" class="boton" name="boton" value="modificar"></td>';
            echo '</form>';
            echo '</tr>';
        }
        echo '</table></div>';
    } else {
        echo '<p>No hay lineas de artículos disponibles.</p>';
    }
   
}


?>
</main>
<?php
$front->footer();
?>