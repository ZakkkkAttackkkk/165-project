<?php
# Pic
# @
# Logo
# Notifs
# Settings Drop-down
include "conn.php";
$notifs = array();
?>
header.php
<header id="hdr-main">
    <a href="home.php">
        <h1 id="hdr-logo">Rainbow</h1>
    </a>
    <img id="hdr-icon"></img>
    <span id="hdr-name">
        <i>@</i>
        <span><?php echo "ZakkkkAttackkkk" ?></span>
    </span>
    <span id="hdr-notifs">Notifs</span>
    <ul id="hdr-notiflist">
        <?php
            foreach ($notifs as $notif){
                echo "<li>";
                    echo $notif;
                echo "</li>";
            }
        ?>
    </ul>
    <span id="hdr-menu">Menu</span>
    <ul id="hdr-menudrop">
        <li><a href="#">Settings</a></li>
        <li><a href="#">Edit Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="#">Help</a></li>
    </ul>
</header>