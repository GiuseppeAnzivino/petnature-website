<?php
    session_start();
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();


    $location = $_SERVER['HTTP_REFERER'];
    // redirect verso pagina interna
    header("location: $location");
?>