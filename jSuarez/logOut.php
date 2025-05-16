<?php
    session_start();
    session_unset();
    session_destroy();
    
    // También evitar que la página quede en caché
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Location: signIn.php");

?>