<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros Productos - Iniciar Sesión</title>
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
    ?>
        <a href="index.php" class="navegacion__enlace enlace-activo">Inicio</a>
        <a href="nuestrahistoria.php" class="navegacion__enlace">Nuestra Historia</a>
        <a href="nuestrastiendas.php" class="navegacion__enlace">Nuestras Tiendas</a>
        <a href="nuestrosproductos.php" class="navegacion__enlace">Nuestros Productos</a>
    <?php
        $front->navClose();
    ?>
    <main>
        <?php
        if(!isset($_POST['usuario']) && !isset($_POST['password'])){
        ?>
        <section class="seccion-form" id="seccion-form">
            <h2>Iniciar Sesión</h2>
            <form action="signIn.php" method="POST" class="formulario" onsubmit="return validarSignIn()">
                <div class="campo">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Tu usuario">
                </div>
                <div class="campo">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Tu contraseña">
                    </div>
                    <input type="submit" value="Iniciar Sesión" class="boton" id="signin">
            </form>
        </section>
        <section class="seccion-nueva-cuenta contenedor">
            <h4>¿No tienes cuenta?</>
            <p>Crea una cuenta para disfrutar de nuestros productos.</p>
            <a href="registrar.php">Crear Cuenta</a>
        </section>
        <?php
        } else {
            include_once 'SQLUsuario.php';
            include_once 'Usuario.php';
            $usuario = new Usuario();
            $usuario->setNombreUsuario($_POST['usuario']);
            $usuario->setPassword($_POST['password']);
            
            $sqlUsuario = new SQLUsuario();
            if($sqlUsuario->signIn($usuario)){
                //echo "<p>Bienvenido ".$_POST['usuario']."</p>";
                $id = $sqlUsuario->getIdByUsername($usuario->getNombreUsuario());
                $id = mysqli_fetch_array($id);
                $id = $id['idCliente'];
                $rol = $sqlUsuario->getRolbyId($id);
                $rol = mysqli_fetch_array($rol);
                $rol = $rol['rol'];
                session_start();
                $_SESSION['username'] = $usuario->getNombreUsuario();
                $_SESSION['rol'] = $rol;
                header("Location: index.php");
            } else {
                echo "<p>Usuario o contraseña incorrectos<p>";
                echo "<p>Por favor, intenta nuevamente.</p>";
                echo "<a href='signIn.php'>Volver a Iniciar Sesión</a>";
            }
        }
        ?>
    </main>
    <?php
        $front->footer();
    ?>
    <script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>