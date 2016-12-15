<?php
    include "conn.php";
    $u=$_GET["u"];
    if($prep = $conn->prepare("SELECT ? IN ENTITY")){
        $prep->bind_param("s",$u);
        $prep->execute();
        $prep->bind_result($uid);
        $prep->fetch();
        if(isset($uid)){
            echo "taken";
        }
        $prep->close();
    }
?>