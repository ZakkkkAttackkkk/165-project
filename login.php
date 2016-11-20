<?php
include "header.php";

$conn = new mysqli("localhost","clientlogin","clientw3w");
$q = $conn->query("");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
    </head>
    <body>
        <form name="loginform">
            <input type="text" name="uname" placeholder="Username" />
            <input type="password" name="pword" placeholder="Password" />
            <input type="submit" name="login" value="Login" />
            <a href="#">Create</a>
            <a href="#">Can't Login</a>
            <a href="#">Help</a>
        </form>
    </body>
</html>