<?php
Class Front{
    public function __construct(){
       
    }

    public function header(){
        echo "<header class='header'>";
        echo "<h1><a href='index.php' class='titulo'>Joyeria <span><img src='images/logo-black.svg' alt='suarez'></span></a></h1>";
        echo "<div class='session'>";
        echo "<a href='signIn.php' class='boton'>Iniciar Sesión</a>";
        echo "</div>";
        echo "</header>";
    }

    public function navOpen(){
        echo '<div class="nav-bg">';
        echo '<nav class="navegacion container">';
    }

    public function navClose(){
        echo '</nav>';
        echo '</div>';
    }

    public function footer(){
        echo '<footer class="footer">';
        echo '<p>2025</p>';
        echo '<p>Únase a la comunidad Selected Suarez y reciba acceso novedades y ventajas exclusivas en su mail.</p>';
        echo '</footer>';
    }

}

?>