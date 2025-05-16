<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Gestionar Usuarios</title>
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
    <a href="nuestrosproductos.php" class="navegacion__enlace">Nuestros Productos</a>
    <?php
if($rol == "root"){
    echo '<a href="gestionar-usuarios.php" class="navegacion__enlace  enlace-activo">Gestionar Usuarios</a>';
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

include_once 'Usuario.php';
include_once 'SQLUsuario.php';

$sqlUsuario = new SQLUsuario();






    $rows = $sqlUsuario->getAllUsers();
    if ($rows) {
        echo "<div class='divLineas'><h2>Usuarios</h2><table class='tablaLineas' style='width: 100%; margin: 0 auto; font-size: 1rem;'>";
        echo "<tr><th>Id Usuario</th><th>Nombre</th><th>Username</th><th>Email</th><th>Dirección</th><th>Colonia</th><th>Ciudad</th><th>Estado</th><th>País</th><th>Código Postal</th><th>Rol</th><th>Acción</th></tr>";
        foreach ($rows as $row) {
            $usuario = new Usuario();
            $usuario->setId($row['idCliente']);
            $usuario->setNombre($row['nombre']);
            $usuario->setApellidos($row['apellidos']);
            $usuario->setEmail($row['correo']);
            $usuario->setDireccion($row['direccionPostal']);
            $usuario->setColonia($row['colonia']);
            $usuario->setCiudad($row['ciudad']);
            $usuario->setEstado($row['estado']);
            $usuario->setPais($row['pais']);
            $usuario->setCp($row['cp']);
            $usuario->setNombreUsuario($row['usuario']);
            $usuario->setRol($row['rol']);
            
            echo '<tr><form action="updateUser.php" method="POST">';
            echo '<td>' . $usuario->getId() . '</td>';
            echo '<td>' . $usuario->getNombre() ." ".$usuario->getApellidos(). '</td>';
            echo '<td>' . $usuario->getNombreUsuario() . '</td>';
            echo '<td>' . $usuario->getEmail() . '</td>';
            echo '<td>' . $usuario->getDireccion() . '</td>';
            echo '<td>' . $usuario->getColonia() . '</td>';
            echo '<td>' . $usuario->getCiudad() . '</td>';
            echo '<td>' . $usuario->getEstado() . '</td>';
            echo '<td>' . $usuario->getPais() . '</td>';
            echo '<td>' . $usuario->getCp() . '</td>';
            echo '<td>' . $usuario->getRol() . '</td>';
            echo '<td>';
            echo '<input type="hidden" name="idusuario" value="' . $usuario->getId() . '">';
            echo '<input type="submit" class="boton" name="boton" value="modificar"></td>';
            echo '</td>';
            echo '</form>';
            echo '</tr>';
        }
        echo '</table></div>';
    } else {
        echo '<p>No hay usuarios disponibles.</p>';
    }
   



?>
</main>
<?php
$front->footer();
?>