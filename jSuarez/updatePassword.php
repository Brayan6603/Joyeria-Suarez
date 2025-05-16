<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Cambiar Contraseña</title>
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
        if($rol == 0){
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
        if(!isset($_SESSION['username'])){
            header("Location: index.php");
            exit();
        }

            if(!isset($_POST['newpassword']) && !isset($_POST['confpassword']) && !isset($_POST['oldpassword'])){
                
                
               
        ?>      
        <section class="seccion-form">
            <h2>Cambiar Contraseña</h2>
            <form action="updatePassword.php" method="POST" class="formulario" onsubmit="return validarRegistrar()">
                
                <div class="campo">
                    <label for="oldpassword">Actual Contraseña</label>
                    <input type="password" id="oldpassword" name="oldpassword" placeholder="Tu contraseña actual" required>
                </div>
                <div class="campo">
                    <label for="newpassword">Nueva Contraseña</label>
                    <input type="password" id="newpassword" name="newpassword" placeholder="Tu contraseña nueva" required>
                </div>
                <div class="campo">
                    <label style="margin-right: 1rem;" for="confpassword">Confirmar Contraseña</label>
                    <input type="password" id="confpassword" name="confpassword" placeholder="Confirma contraseña" required>
                </div>
                
                <input type="submit" value="Cambiar" class="boton" id="signin">
            </form>
        </section>
        <?php
            } else {
                    include_once 'Usuario.php';
                    include_once 'SQLUsuario.php';
                    $oldpassword = $_POST['oldpassword'];
                    $newpassword = $_POST['newpassword'];
                    $confpassword = $_POST['confpassword'];
                    
                    $sqlUsuario = new SQLUsuario();
                    $usuario = new Usuario();
                    $usuario->setNombreUsuario($username);
                    $usuario->setPassword($oldpassword);

                    $result = $sqlUsuario->signIn($usuario);

                    if($result){
                        if($newpassword == $confpassword){
                            $id = $sqlUsuario->getIdByUsername($username);
                            $id = mysqli_fetch_array($id);
                            $id = $id['idCliente'];
                            $usuario->setId($id);
                            $usuario->setPassword($newpassword);
                            if($sqlUsuario->updatePassword($usuario)){
                                echo "<p>Contraseña actualizada correctamente</p>";
                            } else {
                                echo "<p>Error al actualizar la contraseña</p>";
                            }

                        } else {
                            echo "<p>Las contraseñas no coinciden</p>";
                        }
                        echo "<a href='updatePassword.php' class='boton'>Regresar</a>";
                    } else {
                        echo "<p>La contraseña actual es incorrecta</p>";
                        echo "<a href='updatePassword.php' class='boton'>Regresar</a>";
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