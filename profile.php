<?php
    include "conn.php";
    $usrat=$_GET["id"];
    $usr=Array("ID"=>"","Name"=>"","Location"=>"","Gender"=>"","Bio"=>"");
    if($getusrs = $conn->prepare("SELECT ID,Name,Location,Gender,Bio FROM Users WHERE ID LIKE ?;")){
        $getusrs->bind_param("s",$query);
        $getusrs->execute();
        $getusrs->bind_result($usr["ID"],$usr["Name"],$usr["Location"],$usr["Gender"],$usr["Bio"]);
        $getusrs->fetch();
        $getusrs->close();
    }
    else{
        echo "Server error, please try again :( [GET error]";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <script src="jquery-3.1.1.min.js"></script>
        <style>
            
        </style>
    </head>
    <body>
        <?php
            include "header.php"; 
            echo "<h1>@".$usrat."</h1>";
            echo "<h2>".$usr["Name"]."</h2>";
            echo "<p>".$usr["Bio"]."</p>";
        ?>
    </body>
</html>
