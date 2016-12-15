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
        <h1>Search - "<?php echo $_GET["q"]; ?>"</h1>
        <h2>Groups</h2>
        <ul id="groups">
            <?php
                $query = "%".$_GET["q"]."%";
                if($getgrps = $conn->prepare("SELECT * FROM Groups WHERE ID LIKE ?;")){
                    $getgrps->bind_param("s",$query);
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
        <h2>Users</h2>
        <ul id="users">
            <?php
                $query = "%".$_GET["q"]."%";
                if($getgrps = $conn->prepare("SELECT ID,Name,Location,Gender FROM Users WHERE ID LIKE ?;")){
                    $getgrps->bind_param("s",$query);
                    $getgrps->execute();
                    $getgrps->bind_result($id,$name,$loc,$gender);
                    while ($getgrps->fetch()){
                        echo "<li><a href=\"profile.php?id=".$id."\">";
                            echo "<span class=\"grpid\">@".$id."</span> <i>-</i> <span class=\"grpname\">".$name."</span>";
                        echo "</a></li>";
                    }
                    $getgrps->close();
                }
                else{
                    echo "Server error, please try again :( [GET error]";
                }
            ?>
        </ul>
    </body>
</html>
