<?php ?>
<header>
    (header.php)
    <a href="home.php">Home</a>
    <a href="logout.php">Logout</a>
    <a href="profile.php?u=<?php echo $_SESSION["login"];?>">Profile</a>
</header>