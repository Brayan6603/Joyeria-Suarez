<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumenes y Estados</title>
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
        <a href="index.php" class="navegacion__enlace">Inicio</a>
        <a href="nuestrahistoria.php" class="navegacion__enlace">Nuestra Historia</a>
        <a href="nuestrastiendas.php" class="navegacion__enlace">Nuestras Tiendas</a>
        <a href="nuestrosproductos.php" class="navegacion__enlace">Nuestros Productos</a>
        <a href="gestionar-usuarios.php" class="navegacion__enlace">Gestionar Usuarios</a>
        <a href="resumenes-estados.php" class="navegacion__enlace enlace-activo">Resumenes y Estados</a>
    <?php
        $front->navClose();
        session_start();
        $username = $_SESSION['username'];
        $rol = $_SESSION['rol'];
        if($rol == 0){
            $rol = "root";
        }
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
        <h2>Resumenes y Estados</h2>
        <section class="seccion-config">
            <a href ="estadoCuenta.php" class="opcion-config">
                <div class="opcion-config__img">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="75"  height="75"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-invoice"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 7l1 0" /><path d="M9 13l6 0" /><path d="M13 17l2 0" /></svg>
                </div>
                <div class ="opcion-config__texto">
                    <h3>Estado de Cuenta</h3>
                    <p>Aquí puedes ver el estado de cuenta.</p>
                </div>
            </a>
            <a href ="resumenArticulos.php" class="opcion-config">
                <div class="opcion-config__img">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="75"  height="75"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-barcode"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                </div>
                <div class ="opcion-config__texto">
                    <h3>Resumen de Artículos Vendidos</h3>
                    <p>Aquí puedes ver el resumen de artículos vendidos.</p>
                </div>
            </a>
            <?php
            if($rol == "root"){
            ?>
            <a href ="resumenArticulosDes.php" class="opcion-config">
                <div class="opcion-config__img">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="75"  height="75"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-barcode-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1c0 -.552 .224 -1.052 .586 -1.414" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2c.551 0 1.05 -.223 1.412 -.584" /><path d="M5 11h1v2h-1z" /><path d="M10 11v2" /><path d="M15 11v.01" /><path d="M19 11v2" /><path d="M3 3l18 18" /></svg>
                </div>
                <div class ="opcion-config__texto">
                <h3>Resumen de Artículos Deshabilitados</h3>
                <p>Aquí puedes ver el resumen de artículos deshabilitados.</p>
                </div>
            </a>
            <?php
            }
            ?>

       </section>
        </main>
    <?php
        $front->footer();
    ?>
    <script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>