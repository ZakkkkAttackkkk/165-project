<?php
include "header.php";
$groups = array();
$events = array();
?>
home.php
<?php
# list{
#   <list of groups>
#   <li>Create a group</li>
# }
?>

<ul id="hom-groups">
    <?php
        foreach ($groups as $group){
            echo "<li>".$group->name."</li>";
        }
    ?>
    <li><a href="creategroup.php">Create a group</a></li>
</ul>

<?php
# list{
#   <list of event>
#   <li>Create an event</li>
# }
?>

<ul id="hom-events">
    <?php
        foreach ($events as $event){
            echo "<li>".$event->name."</li>";
        }
    ?>
    <li><a href="createevent.php">Create a event</a></li>
</ul>