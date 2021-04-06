
<html>
<?php
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/adminNav.php';
?>

<body>
<section>
    <form action="<?php echo URLROOT; ?>/admins/editAdmin" method="post">
        <h2>Edit Admin</h2>
        <label>Admin Email</label>
        <?php if(isset($_GET['id'])){?>
            <input type="hidden" name="id" value='<?php echo $_REQUEST['id']?>'>
        <?php } ?>
        <input type="text" name="email" value='<?php echo $data['email']?>'>

        <aside>
            <label>Event Date</label>
            <input type="text" name="password" value='<?php echo $data['password']?>'>
        </aside>

        <button id="update" type="submit" value="update">Update Admin</button>
        <button id="insert" type="submit" value="insert">Create New Admin</button>

    </form>
</section>
</body>
</html>