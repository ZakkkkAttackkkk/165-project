<?php 
    include "conn.php";
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
        <?php include "header.php"; ?>
        <form id="searchform" action="search.php">
            <input type="text" name="q" placeholder="Search..."></input>
            <input type="submit" value="&gt;"></input>
        </form>
        <ul id="groups">
            <?php
                if($getgrps = $conn->prepare("SELECT * FROM Groups WHERE ID IN (SELECT Grp FROM Members WHERE User=?);")){
                    $getgrps->bind_param("s",$_SESSION["login"]);
                    $getgrps->execute();
                    $getgrps->bind_result($id,$name,$desc,$priv);
                    while ($getgrps->fetch()){
                        echo "<li><a href=\"group.php?id=".$id."\">";
                            echo "<span class=\"grpid\">@".$id."</span> <i>-</i> <span class=\"grpname\">".$name."</span>";
                        echo "</a></li>";
                    }
                    $getgrps->close();
                }
                else{
                    echo "Server error, please try again :( [GET error]";
                }
                echo "<li><a href=\"create.php\"> Add Group</a></li>";
            ?>
        </ul>
    </body>
</html>
