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