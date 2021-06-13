<?php
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/adminNav.php';
?>

<form method="post">
    <?php
    if(isset($_REQUEST['id']))
    {
        ?>
        <input type="submit" name="confirm" value="Yes"><br/>
        <input type="submit" name="confirm" value="No"><br/>
        <?php
    }
    ?>
</form>