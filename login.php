<?php
    #session_start();
    include "conn.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = $_POST["uname"];
        $pword = $_POST["pword"];
        if ($loginstmt = $conn->prepare("SELECT UID FROM Users WHERE Uname=? AND Pword=?")){
            $loginstmt->bind_param("ss",$uname,$pword);
            $loginstmt->execute();
            $loginstmt->bind_result($uid);
            $loginstmt->fetch();
            if(isset($uid)){
                $_SESSION["login"] = $uid;
                session_destroy();
                header("localhost/165",true,302);
            }
            $loginstmt->close();
        }
        else{
            echo 'no $loginstmt<br>';
            var_dump($conn);
            echo '<br>';
            $q = $conn->query("SELECT UID FROM Users WHERE Uname='hello' AND Pword='hi'");
            var_dump($q);
            echo '<br>';
            $q = $conn->query("show tables;");
            var_dump($q);
        }
    }
    else{
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    </head>
    <body>
        login.php
        <form name="loginform" action="" method="POST">
            <input type="text" name="uname" placeholder="Username" />
            <input type="password" name="pword" placeholder="Password" />
            <input type="submit" name="login" value="Login" />
            <a href="signup.php">Create</a>
            <a href="#">Can't Login</a>
            <a href="#">Help</a>
        </form>
    </body>
</html>
<?php } ?>