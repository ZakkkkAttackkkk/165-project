<?php
    include "conn.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = $_POST["uname"];
        $pword = $_POST["pword"];
        if ($loginstmt = $conn->prepare("SELECT ID FROM Users WHERE ID=? AND Pword=PASSWORD(?)")){
            $loginstmt->bind_param("ss",$uname,$pword);
            $loginstmt->execute();
            $loginstmt->bind_result($uid);
            $loginstmt->fetch();
            if(isset($uid)){
                $_SESSION["login"] = $uname;
                header("Location: .",true,302);
                exit();
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
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <form id="loginform" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <input type="text" name="uname" required></input>
            <input type="password" name="pword" required></input>
            <input type="submit" value="Go"></input>
        </form>
        <a href="signup.php">Signup</a>
    </body>
</html>
