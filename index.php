<?php
    #session_start();
    include "login.php";
    #include "conn.php";
    if (isset($_SESSION["login"])){
        include "home.php";
    }
    else{
        include "login.php";
    }
    var_dump($_SESSION);
    var_dump($_SERVER["PHP_SELF"]);
    session_destroy();
?>