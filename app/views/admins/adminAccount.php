<?php
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/adminNav.php';
if ($_SESSION['AdminType'] == 'Administrator') {
}

?>

<main role="main">
    <section class="login-container">
        <aside class="wrapper-login">
            <h2>Account Information</h2>
            <form action="<?php echo URLROOT; ?>/admins/adminAccount" method="post">
                <input type="text" placeholder="Email *" name="email" value="<?php echo $_SESSION['adminEmail'] ?>">
                <input type="password" placeholder="Password *" name="password">

                <input type="text" placeholder="Email *" name="admin" value="<?php echo $_SESSION['AdminType'] ?>">

                <button id="submit" type="submit" value="submit">Submit</button>
            </form>
        </aside>
    </section>

</main>


