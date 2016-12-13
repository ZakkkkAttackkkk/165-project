<?php #################################### FIX THIS SHIT ####################################
    include "conn.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = $_POST["uname"];
        $pword = $_POST["pword"];
        $given = $_POST["given"];
        $surn = $_POST["surn"];
        $bday = $_POST["bday"];
        $addr = $_POST["addr"];
        if ($loginstmt = $conn->prepare("INSERT INTO Users(uname,pword) VALUES (?,?)")){
            $loginstmt->bind_param("ss",$uname,$pword);
            $loginstmt->execute();
            $loginstmt->fetch();
            $loginstmt = $conn->prepare("SELECT UID FROM Users WHERE uname=? AND pword=?");
            $loginstmt->bind_param("ss",$uname,$pword);
            $loginstmt->execute();
            $loginstmt->bind_result($uid);
            $loginstmt->fetch();
            if(isset($uid)){
                $_SESSION["login"] = $uid;
                header("Location: .",True,302);
            }
            else{
                var_dump($uid);
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
    include "header.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
        <script src="jquery-3.1.1.min.js"></script>
    </head>
    <body>
        <p>signup.php</p>
        <form name="signupform" method="POST">
            <section>
                <input type="email" name="email" placeholder="Email" />
                <input type="text" name="uname" placeholder="Username" />
                <input type="password" name="pword" placeholder="Password" />
                <button id="nextbut" onclick="$('section:first').hide();$('section:nth(1)').show();return false;">Next</button>
            </section>
            <section style="display:none;">
                <input type="text" name="given" placeholder="Given Name" />
                <input type="text" name="surn" placeholder="Surname" />
                <input type="date" name="bday" placeholder="Birthday" />
                <input type="text" name="addr" placeholder="Address" />
                <input type="text" name="sogie" placeholder="SOGIE" />
                <input type="file" name="icon" value="Icon" placeholder="Icon" />
                <button id="prevbut" onclick="$('section:nth(1)').hide();$('section:first').show();return false;">Back</button>
                <input type="submit" name="submit" value="Go" />
            </section>
            <a href="#">Back</a>
            <a href="#">Help</a>
        </form>
    </body>
</html>
<?php }?>