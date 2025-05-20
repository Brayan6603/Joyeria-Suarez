<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Iniciar Sesión</title>
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
        <a href="nuestrosproductos.php" class="navegacion__enlace">Nuestros Productos</a>
        <?php
        if($rol == "root"){
        ?>
             <a href="gestionar-usuarios.php" class="navegacion__enlace">Gestionar Usuarios</a>
            <a href="resumenes-estados.php" class="navegacion__enlace">Resumenes y Estados</a>
    <?php
        }
        $front->navClose();
        
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
    <main>
        <?php
        if($rol == "root"){

            if(!isset($_POST['nombre']) && !isset($_POST['apellidos']) && !isset($_POST['email']) && !isset($_POST['direccion']) && !isset($_POST['colonia']) && !isset($_POST['ciudad']) && !isset($_POST['estado']) && !isset($_POST['pais']) && !isset($_POST['cp']) && !isset($_POST['nombre_usuario']) && !isset($_POST['password'])){
        ?>      
        <section class="seccion-form">
            <h2>Crear Cuenta de Administrador</h2>
            <form action="addAdmin.php" method="POST" class="formulario" onsubmit="return validarRegistrar()">
                <div class="campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
                </div>
                <div class="campo">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Tus apellidos" required>
                </div>
                <div class="campo">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Tu email" required>
                </div>
                <div class="campo">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" placeholder="Tu dirección" required>
                </div>
                <div class="campo">
                    <label for="colonia">Colonia</label>
                    <input type="text" id="colonia" name="colonia" placeholder="Tu colonia" required>
                </div>
                <div class="campo">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" id="ciudad" name="ciudad" placeholder="Tu ciudad" required>
                </div>
                <div class="campo">
                    <label for="estado">Estado</label>
                    <input type="text" id="estado" name="estado" placeholder="Tu estado" required>
                </div>
                <div class="campo">
                    <label for="pais">Pais</label>
                    <input type="text" id="pais" name="pais" placeholder="Tu pais" required>
                </div>
                <div class="campo">
                    <label for="c.p">C.P</label>
                    <input type="number" max="99999" maxlength="5" id="cp" name="cp" placeholder="Tu c.p" required>
                </div>
                <div class="campo">
                    <label for="nombre_usuario">Nombre Usuario</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Tu usuario" required>
                </div>
                <div class="campo">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Tu contraseña" required>
                </div>
                <input type="submit" value="Registrarse" class="boton" id="signin">
            </form>
        </section>
        <?php
            } else {
               
                if($_POST['nombre_usuario']=== "root"){
                    echo "<h2>Error en el registro</h2>";
                    echo "<p>El nombre de usuario no puede ser root</p>";
                    echo "<a href='addAdmin.php' class='boton'>Regresar</a>";
                }else{
                    include_once 'Usuario.php';
                    include_once 'SQLUsuario.php';

                    $usuario = new Usuario(0);
                    $usuario->setNombre($_POST['nombre']);
                    $usuario->setApellidos($_POST['apellidos']);
                    $usuario->setEmail($_POST['email']);
                    $usuario->setDireccion($_POST['direccion']);
                    $usuario->setColonia($_POST['colonia']);
                    $usuario->setCiudad($_POST['ciudad']);
                    $usuario->setEstado($_POST['estado']);
                    $usuario->setPais($_POST['pais']);
                    $usuario->setCp($_POST['cp']);
                    $usuario->setNombreUsuario($_POST['nombre_usuario']);
                    $usuario->setPassword($_POST['password']);

                    $sqlUsuario = new SQLUsuario();
                    
                    if($sqlUsuario->signUp($usuario)){
                        echo "<p>Registro Exitoso</p>";
                        //session_start();
                        //$_SESSION['username'] = $usuario->getNombreUsuario();
                        //header("Location: index.php");
                        echo "<a href='configUser.php' class='boton'>Salir</a>";
                    } else {
                        echo "<h2>Error en el registro</h2>";
                        echo "<p>Por favor intenta nuevamente</p>";
                        echo "<a href='addAdmin.php' class='boton'>Regresar</a>";
                    }
                }
            }
        } else {
            echo "<h2>Error de acceso</h2>";
            echo "<p>Por favor inicia sesión como root para acceder a esta sección</p>";
            echo "<a href='signIn.php' class='boton'>Iniciar Sesion</a>";
        }
        ?>
        </main>
    <?php
        $front->footer();
    ?>
    <script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>