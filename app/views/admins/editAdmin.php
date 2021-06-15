
<html>
<?php
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/adminNav.php';
?>

<body>
<section>
    <form action="<?php echo URLROOT; ?>/admins/editAdmin" method="post">
        <?php
        if(isset($_GET['id'])) {
            ?>
            <h2>Edit Admin</h2>
        <?php } else { ?>
            <h2>New Admin</h2>
        <?php }  ?>
        <label>Admin Email</label>
        <?php if(isset($_GET['id'])){?>
            <input type="text" name="id" value='<?php echo $_REQUEST['id']?>'>
        <?php } ?>
        <input type="text" name="email" value='<?php echo $data['email']?>'>

        <aside>
            <label>Admin Password</label>
            <input type="password" name="password" value='<?php echo $data['password']?>'>
        </aside>
        <?php
        if(isset($_GET['id'])) {
        ?>
        <button id="update" type="submit" name="action" value="update">Update Admin</button>
        <?php } else { ?>
        <button id="insert" type="submit" name="action" value="insert">Create New Admin</button>
        <?php }  ?>

    </form>
</section>
</body>
</html>