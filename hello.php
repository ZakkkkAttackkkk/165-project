<!DOCTYPE html>
<html>
<body>

hello world
<?php
    for ($i = 0; $i < 5; $i++){
        echo "bla-bla<br>";
    }
    $queries = array("show databases;","use classicmodels;","show tables;");
    $mysqli = new mysqli("localhost","zbjimenez","Kikoeteirunoyo");
    echo $mysqli->host_info . "<br>";
    $q = $mysqli->query("source C:\\Users\\Apol.auj-PC\\Desktop\\Zak\\165\\classicmodels\\birt-database-windows\\create_classicmodels.sql;source C:\\Users\\Apol.auj-PC\\Desktop\\Zak\\165\\classicmodels\\birt-database-windows\\create_classicmodels.sql;");
    $mysqli->query($q);
    foreach ($queries as $q){
        echo "<textarea style=\"height:40em;width:30em;\">";
        $res = $mysqli->query($q);
        echo "==== ".$q." ====\n";
        if($res){
            try{
                if ($res !== true)
                    do{
                        $row = $res->fetch_assoc();
                        var_dump($row);
                    }
                    while ($row);
            }
            catch(Exception $e){
                echo "woop\n";
            }
        }
        else{
            echo "Failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        echo "</textarea>";
    }

?>

</body>
</html>