<?php
    if(!isset($_SESSION))
        session_start();
    $conn = new mysqli("localhost","clientlogin","clientw3w");
    $q = $conn->query("use rainbow;");
?>