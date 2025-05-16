<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Inicio</title>
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
        <a href="index.php" class="navegacion__enlace enlace-activo">Inicio</a>
        <a href="nuestrahistoria.php" class="navegacion__enlace">Nuestra Historia</a>
        <a href="nuestrastiendas.php" class="navegacion__enlace">Nuestras Tiendas</a>
        <a href="nuestrosproductos.php" class="navegacion__enlace">Nuestros Productos</a>
        <?php
        if($rol == "root" && isset($username)){
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

    <section class="imagenes">

        <div class="imagenes__primera imagen">
            <div class="transparencia imagenes__contenido">
                <img src="images/suarezjoyeria/Group1881-removebg.png" alt="logo">
            </div>

        </div>

    </section>

    
    <main class="contenido-principal container">
        <section class="jew-collection">
            <div class="jew-collection__head">
                <h1>Jewelry Collection</h1>
                <h3>summer, 2025</h3>
                <a href="nuestrosproductos.php">Ver Todo</a>
            </div>
            <div class="jew-collection__body">
                <img src="images/suarezjoyeria/summer.jpg" alt="imagen">
                <div>
                    <h2>Sobre Nuestra Colección</h2>
                    <h3>Objeto de Deseo</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla tenetur, deserunt excepturi deleniti consectetur dicta, quas officia porro nisi accusamus ab! Minima excepturi quia velit. Placeat suscipit quia eveniet culpa?</p>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dignissimos provident ad at, minus earum vero mollitia! Incidunt, aut dicta ab veniam pariatur repellendus, sequi distinctio voluptas ipsum molestias et expedita.</p>
                    <button onclick="">Leer Más</button>
                </div>
            </div>
            
        </section>

        <section class="elegancia">
            <div class="elegancia__contenido-uno">
                <img src="images/suarezjoyeria/16182.webp" alt="imagen">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est dolore assumenda, sapiente perspiciatis beatae saepe dolores placeat dicta dolor. Eveniet corrupti commodi est saepe ipsam eos atque dolorum mollitia neque.</p>
            </div>
            <div class="elegancia__contenido-dos" >
                <h2>Elegancia y Estilo Cercas de Tí</h2>
                <img src="images/suarezjoyeria/1618.webp" alt="imagen">
            </div>
        </section>

        <section>
            <h1>Ofrecemos</h2>
            
            <div class="ventajas">

                <section class="ventaja"> 
                    <h3>Atención personalizada</h3>
                    <p> Le invitamos a contactar con nuestro equipo de expertos para ayudarle a escoger la joya perfecta.</p>
                </section>

                <section class="ventaja"> 
                    <h3>Localice su pedido</h3>
                    <p>Solo necesita el mail con el que realizó la compra y su número de pedido.</p>
                </section>

                <section class="ventaja"> 
                    <h3>Grabado en anillos</h3>
                    <p>La garantía del anillo incluye, si lo desea, un primer grabado gratuito.</p>
                </section>

                <section class="ventaja"> 
                    <h3>Talla estándar anillos</h3>
                    <p>Recomendamos comprar nuestra talla estándar, la 13, ya que la garantía le incluye la primera modificación de talla (a excepción de anillos de plata).</p>
                </section>

                <section class="ventaja"> 
                    <h3>Pago y financiación</h3>
                    <p>Los métodos de pago en Suarez son 100% seguros e incluyen servicios de financiación.</p>
                </section>

            </div>
        </section>
        

    </main>

    <?php
        $front->footer();
    ?>     
</body>
</html>