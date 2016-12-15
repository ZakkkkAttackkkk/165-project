<?php
    include "conn.php";
    if(isset($_SESSION["login"])){
        include "home.php";
    }
    else{
        include "login.php";
    }
?>