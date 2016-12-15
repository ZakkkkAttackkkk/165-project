<?php 
    include "conn.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
//        echo "<textarea style=\"width:100%;height:100%;\">";
//        var_dump($_POST);
//        var_dump($_SERVER);
//        echo "</textarea>";
//        exit();
        try {
            $stamp = date_format(date_create_from_format("M d Y H:i:s",$_POST["stamp"]),"Y-m-d H:i:s");
            $content = $_POST["content"];
            if( ($postins = $conn->prepare("INSERT INTO Posts(Timestamp,Text,Author) VALUES(Timestamp(?),?,?);")) &&
                ($grpposts = $conn->prepare("INSERT INTO GrpPosts VALUES(?,?);")) &&
                ($newpost = $conn->prepare("SELECT ID FROM Posts WHERE Timestamp=Timestamp(?) AND Author=? AND Text=?;")) ){
                $postins->bind_param("sss",$stamp,$content,$_SESSION["login"]);
                $postins->execute();
                $postins->close();
                $newpost->bind_param("sss",$stamp,$_SESSION["login"],$content);
                $newpost->execute();
                $newpost->bind_result($id);
                $newpost->fetch();
                $newpost->close();
                $grpposts->bind_param("ss",$id,$_GET["id"]);
                $grpposts->execute();
                $grpposts->close();
                $conn->query("COMMIT;");
                header("Location: group.php?id=".$_GET["id"],true,302);
                exit();
            }//*/
            else{
                echo "Server error, please try again :( [POST error]";
            }
        }
        catch(Exception $e){
            echo "Server error, please try again :( [POST error: ".$e->getMessage()."]";
        }
    }
    $grpat = $_GET["id"];
    if($getgrps = $conn->prepare("SELECT * FROM Groups WHERE ID=?;")){
        $getgrps->bind_param("s",$grpat);
        $getgrps->execute();
        $getgrps->bind_result($id,$name,$desc,$priv);
        $getgrps->fetch();
        $getgrps->close();
        $grp=Array("ID"=>$id,"Name"=>$name,"Descr"=>$desc,"Privacy"=>$priv);
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
            echo "<h1>@".$grpat."</h1>";
            echo "<h2>".$grp["Name"]."</h2>";
            echo "<p>".$grp["Descr"]."</p>";
            echo "<span id=\"privacy\">".$grp["Privacy"]."</span>";
        ?>
        <form id="postform" method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?id=".$grpat;?>">
            <input type="hidden" name="stamp"></input>
            <input type="textarea" name="content" placeholder="Write a post..."></input>
            <input type="submit" value="Go"></input>
        </form>
        <ol id="timeline">
            <?php
                if ($getposts = $conn->prepare(
                    "SELECT Posts.ID,Timestamp,Text,Author,Name
                     FROM Posts 
                        NATURAL JOIN GrpPosts 
                        JOIN Users ON (
                            Posts.Author=Users.ID
                        )
                     WHERE GrpID=?
                     ORDER BY Timestamp DESC;")){
                    $getposts->bind_param("s",$grpat);
                    $getposts->execute();
                    $getposts->bind_result($id,$stamp,$text,$auth,$name);
                    while($getposts->fetch()){ ?>
                        <li>
                            <div>
                                <span class="postauthorat">@<?php echo $auth;?></span> <i>-</i>
                                <span class=\"postauthorname\"><?php echo $name;?></span>
                            </div>
                            <div>
                                <time class=\"posttimestamp\"><?php echo $stamp;?></time>
                            </div>
                            <p class=\"postcontent\"><?php echo $text;?></p>
                        </li>
                    <?php }
                    $getposts->close();
                }
            ?>
        </ol>
        <script>
            $(':input[name="content"]').on("input",function(ev){
                var d = new Date();
                $(':hidden[name="stamp"]').val(
                    d.toDateString().substr(4)+" "+d.toTimeString().substr(0,8)
                );
            });
        </script>
    </body>
</html>
