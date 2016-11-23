<?php #################################### FIX THIS SHIT ####################################
    include "header.php";
    include "conn.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = $_POST["uname"];
        $pword = $_POST["pword"];
        if ($loginstmt = $conn->prepare("INSERT INTO Users VALUES (?,?,?)")){
            $loginstmt->bind_param("dss",2,$uname,$pword);
            $loginstmt->execute();
            $loginstmt->bind_result($uid);
            $loginstmt->fetch();
            if(isset($uid)){
                $_SESSION["login"] = $uid;
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
signup.php
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
    </head>
    <body>
        <p>signup.php</p>
        <form name="signupform">
            <section>
                <input type="email" name="email" placeholder="Email" />
                <input type="text" name="uname" placeholder="Username" />
                <input type="password" name="pword" placeholder="Password" />
                <button id="nextbut">Next</button>
            </section>
            <section>
                <input type="text" name="given" placeholder="Given Name" />
                <input type="text" name="surn" placeholder="Surname" />
                <input type="date" name="bday" placeholder="Birthday" />
                <input type="text" name="addr" placeholder="Address" />
                <input type="text" name="sogie" placeholder="SOGIE" />
                <input type="file" name="icon" value="Icon" placeholder="Icon" />
                <input type="submit" name="submit" value="Go" />
            </section>
            <a href="#">Back</a>
            <a href="#">Help</a>
        </form>
    </body>
</html>
<?php }?>