<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Nuestros Productos</title>
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

    <main class="main-productos container">

        <h2>Nuestros Nuevos Productos</h2>
        <?php
            if($rol === "root"){
        ?>
        <div class="botones">
            <a href="addExistencias.php" class="boton verde"> Gestionar Existencias</a>
            <a href="addLineas.php" class="boton verde"> Gestionar Lineas Artículos</a>
        </div>
        <?php
            }
        ?>
        <section class="nuevo-producto">
            <h3>Nueva Colección</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati totam aperiam nam perspiciatis.</p>
            <div class="nuevo-producto__grid">
                <!-- imagenes -->
                <div class="nuevo-producto__imagen">
                    <img src="images/colecciones/co2040-00cr.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/colecciones/pe13078-or.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/colecciones/pe15007-ortrrd.png" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/colecciones/pe15008-obagd.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/colecciones/pe15019-oronpa.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/colecciones/pe15046-ztrv.jpg" alt="imagen">
                </div>

            </div>

            <a href="productos.php?id=1" class="boton">Ver Más</a>

        </section>
        
        <section class="nuevo-producto">
            <h3>Nuevas Joyas</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati totam aperiam nam perspiciatis. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis sit alias ipsum nostrum deserunt nobis hic? Aliquid similique nam explicabo, minima, deleniti placeat consequatur voluptas quisquam nesciunt laborum ad vel?</p>
            <div class="nuevo-producto__grid">
                <!-- imagenes -->
                <div class="nuevo-producto__imagen">
                    <img src="images/joyas/GE11001-00AG.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/joyas/pe12060-pb6mm.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/joyas/pe12060-tq5mm.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/joyas/pe13044-agqzci.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/joyas/pe13078-ag.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/joyas/pe13083-agamv.jpg" alt="imagen">
                </div>

            </div>
            <a href="productos.php?id=2" class="boton">Ver Más</a>
        </section>
        
        <section class="nuevo-producto">
            <h3>Nuevos Relojes</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati totam aperiam nam perspiciatis. Lorem ipsum dolor sit amet consectetur adipisicing elit. In iure eum at illum! Veritatis corrupti minus, minima unde id ipsam maxime quia. Quos quia alias perferendis! Omnis minima maxime architecto.</p>
            <div class="nuevo-producto__grid">
                <!-- imagenes -->
                <div class="nuevo-producto__imagen">
                    <img src="images/relojeria/franck_muller.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/relojeria/relojes280x280_0000_ulysse-nardin1.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/relojeria/relojes280x280_0002_panerai1.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/relojeria/relojes280x280_0003_nomos1.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/relojeria/relojes280x280_0004_iwc1.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/relojeria/relojes280x280_0005_hublot1.jpg" alt="imagen">
                </div>

            </div>
            <a href="productos.php?id=3" class="boton">Ver Más</a>
        </section>

        <section class="nuevo-producto">
            <h3>Nuevos Solitarios y Alianzas</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque ipsa quasi odio culpa deleniti impedit enim libero perspiciatis soluta quis quidem quos iure repellendus saepe facilis esse, quaerat placeat et?</p>
            <div class="nuevo-producto__grid">
                <!-- imagenes -->
                <div class="nuevo-producto__imagen">
                    <img src="images/solitariosyalianzas/al-9825-obdc-st.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/solitariosyalianzas/al12003-0bd.png" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/solitariosyalianzas/al12010-obd-t.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/solitariosyalianzas/al12014-obd110b.png" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/solitariosyalianzas/al8016-obt-st-.jpg" alt="imagen">
                </div>
                <div class="nuevo-producto__imagen">
                    <img src="images/solitariosyalianzas/AL9915-00D.jpg" alt="imagen">
                </div>

            </div>
            <a href="productos.php?id=4" class="boton">Ver Más</a>
        </section>

    </main>

    <?php
        $front->footer();
    ?>  

</body>
</html>