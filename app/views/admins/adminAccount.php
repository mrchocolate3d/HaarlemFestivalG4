<?php
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/adminNav.php';
?>

<main role="main">
    <section class="login-container">
        <aside class="wrapper-login">
            <h2>Account Information</h2>
            <form action="<?php echo URLROOT; ?>/admins/adminAccount" method="post">
                <input type="text" placeholder="Email *" name="email" value="<?php echo $_SESSION['email'] ?>">
                <input type="password" placeholder="Password *" name="password">

                <input type="text" placeholder="Email *" name="email" value="<?php echo $_SESSION['AdminType'] ?>">

                <button id="submit" type="submit" value="submit">Submit</button>
            </form>
            <?php
            if ($_SESSION['AdminType'] == 'SuperAdministrator'){ ?>
                <a href="<?php echo URLROOT; ?>/admins/allAdminList">All admins</a>
            <?php }
            ?>
        </aside>
    </section>

</main>


