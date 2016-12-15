<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $u = $_POST["uname"];
        $p = $_POST["pword"];
        $nm = $_POST["name"];
        $nc = $_POST["nick"];
        $l = $_POST["loc"];
        $b = $_POST["bday"];
        $g = $_POST["gender"];
        $conn = new mysqli("localhost","clientlogin","clientw3w");
        $q = $conn->query("use rainbow;");
        if(($ent = $conn->prepare("INSERT INTO Entities VALUES(?);")) && ($users = $conn->prepare("INSERT INTO Users VALUES(?,PASSWORD(?),?,?,?,?,?);"))){
            $ent->bind_param("s",$u);
            $users->bind_param("sssssss",$u,$p,$nm,$nc,$l,$b,$g);
            $ent->execute();
            $users->execute();
            $ent->close();
            $users->close();
            $conn->query("COMMIT;");
            $_SESSION["login"]=$u;
            header("Location: home.php",true,302);
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
        <form id="signupform" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <label for="uname">Username <span class="inputerror"></span></label>
            <input type="text" name="uname" required></input>
            <label for="pword">Password <span class="inputerror"></span></label>
            <input type="password" name="pword" required></input>
            <label for="name">Name <span class="inputerror"></span></label>
            <input type="text" name="name" required></input>
            <label for="nick">Nickname</label>
            <input type="text" name="nick"></input>
            <label for="loc">Location</label>
            <input type="text" name="loc"></input>
            <label for="bday" required>Birthday</label>
            <input type="date" name="bday"></input>
            <label for="gender" required>Gender <span class="inputerror"></span></label>
            <select name="gender">
                <option value="-" selected>--</option>
                <option value="m">Male</option>
                <option value="f">Female</option>
                <option value="x">Other</option>
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
                    $('label[for="uname"]>.inputerror').text("(username taken)");
                else if(isvalid){
                    $("#signupform").submit();
                }
            }
            $("#signupform").submit(function(ev){
                isvalid = true;
                if(taken===null){
                    uname=$(':text[name="uname"]').val();
                    
                    if(!/[A-Za-z0-9]{3,24}/.test(uname)){
                        isvalid = false;
                        $('label[for="uname"]>.inputerror').text("(must be alphanumeric and only 3-24 characters long)")
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
                        $('label[for="uname"]>.inputerror').text("")
                    }
                    if(!(8<=$(':password').val().length<=24)){
                        isvalid = false;
                        $('label[for="uname"]>.inputerror').text("(must be 8-24 characters long)")
                    }
                    else{
                        $('label[for="uname"]>.inputerror').text("")
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
