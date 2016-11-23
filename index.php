<?php
    session_start();
    include "login.php";
    if (isset($_SESSION["login"])){
        include "home.php";
    }
    session_destroy();
?>