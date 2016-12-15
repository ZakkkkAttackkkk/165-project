<?php
    include "conn.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST["id"];
        $nm = $_POST["name"];
        $d = $_POST["desc"];
        $p = $_POST["privacy"];
        if(($ent = $conn->prepare("INSERT INTO Entities VALUES(?);")) && ($groups = $conn->prepare("INSERT INTO Groups VALUES(?,?,?,?);"))){
            $ent->bind_param("s",$id);
            $groups->bind_param("ssss",$id,$nm,$d,$p);
            $ent->execute();
            $groups->execute();
            $ent->close();
            $groups->close();
            $conn->query("COMMIT;");
            header("Location: group.php?id=".$id,true,302);
            exit();
        }//*/
        else{
            echo "Server error, please try again :(";
        }
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
        <?php include "header.php" ?>
        <form id="createform" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <label for="id">Group ID <span class="inputerror"></span></label>
            <input type="text" name="id" required></input>
            <label for="name">Name</label>
            <input type="text" name="name" required></input>
            <label for="desc">Description</label>
            <input type="text" name="desc"></input>
            <label for="privacy" required>Privacy <span class="inputerror"></span></label>
            <select name="privacy">
                <option value="-" selected>--</option>
                <option value="Public">Public</option>
                <option value="Private">Private</option>
                <option value="Hidden">Hidden</option>
            </select>
            <label for="icon">Icon</label>
            <input type="file" accept="image/*" name="icon"></input>
            <input type="submit">Go</input>
        </form>
        <script>
            var isvalid = true, taken = null;
            function setTaken(val){
                taken = val!="";
                if(taken==true)
                    $('label[for="id"]>.inputerror').text("(username taken)");
                else if(isvalid){
                    $("#signupform").submit();
                }
            }
            $("#signupform").submit(function(ev){
                isvalid = true;
                if(taken===null){
                    id=$(':text[name="id"]').val();
                    
                    if(!/[A-Za-z0-9]{3,24}/.test(id)){
                        isvalid = false;
                        $('label[for="id"]>.inputerror').text("(must be alphanumeric and only 3-24 characters long)")
                    }
                    else{
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200){
                                setTaken(this.responseText);
                            }
                        };
                        xmlhttp.open("GET", "checkuname.php?u=" + uname, true);
                        xmlhttp.send();
                        $('label[for="id"]>.inputerror').text("")
                    }
                    if($('select[name="gender"] option[value="-"]:selected').length){
                        isvalid = false;
                        $('label[for="gender"]>.inputerror').text("(please select a gender)")
                    }
                    else{
                        $('label[for="gender"]>.inputerror').text("")
                    }
                }
                if(!isvalid||taken)
                    ev.preventDefault();
            })
        </script>
    </body>
</html>
