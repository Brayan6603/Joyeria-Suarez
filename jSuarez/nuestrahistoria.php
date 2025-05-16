<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria Suarez - Nuestra Historia</title>
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
            <a href="nuestrahistoria.php" class="navegacion__enlace enlace-activo">Nuestra Historia</a>
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


    
    <main class="contenido-principal container">

        <h2>Nuestra Historia</h2>

        <section class="intro">

            <h3>Introducción</h3>

            <div class="intro__contenido">
                <h4>EMILIANO SUÁREZ FAFFIÁN</h4>
                <p>D. Emiliano Suárez Faffián introdujo un gran avance en el gremio de joyeros fundando en Bilbao la primera tienda-taller de joyería, origen de lo que es hoy Grupo Suárez.</p>
            </div>

            <div class="intro__imagen">
                <img src="images/suarezjoyeria/intro.jpg" alt="intro">

            </div>
            

        </section>
        
        
        <section class="hechos-historicos">

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/1943.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>1943</h3>
                    <h4>Fundación de Joyería Suárez (Bilbao, Calle Jardines 11)</h4>
                    <p>Era una pequeña tienda de unos 20 metros cuadrados que puso en marcha el proyecto de la familia Suárez.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/1974.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>1974</h3>
                    <h4>Fallecen en accidente el señor Suárez y su esposa Sara.</h4>
                    <p>Los jóvenes hermanos Benito y Emiliano adquieren toda la responsabilidad del negocio familiar.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/1975.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>1975</h3>
                    <h4>Inauguración de la segunda tienda (Bilbao, Calle Ercilla 25)</h4>
                    <p>Los hermanos Suárez comienzan su expansión en Bilbao inaugurando la nueva tienda en la calle Ercilla 25.</p>
                </div>
            </div>
            
            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/1978.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>1978</h3>
                    <h4>Inauguración tienda (Bilbao, Calle Correo, 21)</h4>
                    <p>Los hermanos Suárez deciden cerrar la primera tienda que fundó su padre para poner en marcha un nuevo proyecto.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/1982.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>1982</h3>
                    <h4>Apertura de la primera tienda en Madrid. (Madrid, Calle Serrano, 63).</h4>
                    <p>Los hermanos Suárez extienden su proyecto a Madrid inaugurando una tienda en la calle Serrano 63.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/1983.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>1983</h3>
                    <h4>Inundaciones en Bilbao.</h4>
                    <p>Las inundaciones en Bilbao causaron graves e irreparables daños en las tiendas, que se pudieron superar gracias a la capacidad de trabajo y superación de todo el equipo Suárez.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/1985.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>1985</h3>
                    <h4>Apertura tienda Bilbao (Bilbao, Calle Gran Vía 43)</h4>
                    <p>Se decide cerrar las tiendas de Ercilla y Correo para trasladarse a una gran tienda localizada en los bajos del emblemático edificio Sota, en la Gran Vía 43 de Bilbao.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/1992.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>1992</h3>
                    <h4>Sofía de Habsburgo</h4>
                    <p>Archiduquesa de Austria y amiga de la familia Suárez, Sofía de Habsburgo fue una de las primera embajadoras de Suárez.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/1997.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>1997</h3>
                    <h4>Ampliación de la tienda Serrano 63 (Madrid, Calle Serrano 63)</h4>
                    <p>Se reforma la tienda de Serrano 63 y la firma Patek Philippe la escoge para montar su primer ‘Shop in Shop’ en el mundo.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/1999.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>1999</h3>
                    <h4>Ampliación de la tienda Serrano 62 (Madrid, Calle Serrano 62)</h4>
                    <p>El grupo Suárez amplía de una forma espectacular sus instalaciones de la calle Serrano 62, convirtiéndose en una de las joyerías más grandes de Europa.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/2000.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>2000</h3>
                    <h4>Sautoirs de Perlas</h4>
                    <p>Suárez introduce en el mercado los sautoirs de perlas, collares maxis de perlas australianas, Tahití y Golden que dan un giro a la forma de lucir las perlas hasta el momento.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/2003.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>2003</h3>
                    <h4>Apertura en Barcelona (Barcelona, Paseo de Gracia 82)</h4>
                    <p>Su fachada de más de 34 metros de largo y sus más de 800 metros cuadrados exponen las mejores marcas de relojería y las colecciones de joyas creadas por la firma.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/2004.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>2004</h3>
                    <h4>Príncipes de Asturias</h4>
                    <p>Suárez tuyo el honor de ser la joyería elegida por SS.AA.RR los Príncipes de Asturias para comprar sus joyas de compromiso.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/2008.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>2008</h3>
                    <h4>Colección ONE</h4>
                    <p>Suárez crea la Colección ONE, su proyecto solidario. Una colaboración muy especial con la Fundación Aladina, que tiene como objetivo apoyar a los niños y adolescentes con cáncer destinando un porcentaje de las ventas de esta pulsera con un diseño único.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/2010.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>2010</h3>
                    <h4>El Corte Inglés (Madrid, Calle Serrano 47 y Castellana, Raimundo Fernández Villaverde 79).</h4>
                    <p>Apertura de puntos de venta en el Corte Inglés de Serrano y Castellana.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/2011.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>2011</h3>
                    <h4>El Corte Inglés (Barcelona, Valencia, Zaragoza, Murcia, Bilbao, Madrid Pozuelo y Sevilla)</h4>
                    <p>Apertura de varios puntos de venta en El Corte Inglés en diferentes ciudades.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/2012.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>2012</h3>
                    <h4>Campaña Mario Testino Laetitia Casta</h4>
                    <p>Mario Testino se convierte en el fotógrafo de la nueva campaña de Suárez protagonizada por la actriz y modelo Laetitia Casta.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/2013.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>2013</h3>
                    <h4>Celebración del X Aniversario de la boutique de Barcelona.</h4>
                    <p>La boutique de Paseo de Gracia de Barcelona celebró su X Aniversario en compañía de sus clientes.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/2014.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>2014</h3>
                    <h4>Lanzamiento del reloj IMANTE. La joya del tiempo.</h4>
                    <p>Presentación de IMANTE, el primer reloj femenino de Suárez.</p>
                </div>

            </div>

            <div class="hecho">
                <div class="hecho__imagen">
                    <img src="images/suarezjoyeria/2015.jpg" alt="imagen">
                </div>
                <div class="hecho__contenido">
                    <h3>2015</h3>
                    <h4>Nuevo concepto tienda</h4>
                    <p>Tras la presentación del proyecto en un concurso entre varios arquitectos internacionales del más alto nivel, Suárez selecciona el proyecto de un prestigioso estudio parisino y comienza su ejecución bajo la dirección del estudio G4 basado en Barcelona y liderado por el arquitecto Ernest Boronat. Un nuevo concepto de tienda basado en espacios abiertos donde la luz y materiales como la rafia, el cuero y latón son los protagonistas.</p>
                </div>

            </div>


            
            

        </section>

        
        

    </main>

    <?php
        $front->footer();
    ?> 
</body>
</html>