
<html>
<?php
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/navigation.php';
?>

<body>
<section>
    <form action="<?php echo URLROOT; ?>/users/account" method="post">
        <h2>Edit Account</h2>
        <aside>
            <label>Firstname *</label>
            <input type="text" name="firstname" value='<?php echo $data['firstname']?>'>
        </aside>
        <aside>
            <label>Lastname *</label>
            <input type="text" name="lastname" value='<?php echo $data['lastname']?>'>
        </aside>
        <aside>
            <label>Email *</label>
            <input type="text" name="email" value='<?php echo $data['email']?>'>
        </aside>

        <aside>
            <label>Password</label>
            <input type="password" name="password" '>
        </aside>
        <aside>
            <label>Confirm Password</label>
            <input type="password" name="confirmPassword" '>
            <span class="invalidFeedback">
                    <?php echo $data['error']; ?>
                </span>
        </aside>
        <button id="update" type="submit" name="action" value="update">Update Account Info</button>

    </form>
</section>
</body>
</html>