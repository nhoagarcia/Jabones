<?php
    session_start();
    Unset($_SESSION['autentificado']);
    // $_SESSION=array();   para borrar todas las vars de sesión
    Setcookie(session_name(),time()-3600);
    Session_destroy();
    header("Location: ./jabonescarlatti.php");

?>