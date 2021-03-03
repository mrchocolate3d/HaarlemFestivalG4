<<<<<<< HEAD
<<<<<<< HEAD
<nav id="navbar-hf">
=======
=======
>>>>>>> parent of 0d49b12 (Merge pull request #2 from mrchocolate3d/Home-Page)
<nav class="top-nav">
    <ul>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/index">Home</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/jazz">Jazz</a>
        </li>
        <li>
<<<<<<< HEAD
            <a href="<?php echo URLROOT; ?>/pages/history">History</a>
=======
            <a href="<?php echo URLROOT; ?>/histories/detail">History</a>
>>>>>>> parent of 0d49b12 (Merge pull request #2 from mrchocolate3d/Home-Page)
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/dance">Dance</a>
        </li>
    </ul>
</nav>


<<<<<<< HEAD
>>>>>>> parent of 4112a2a (DetailPage connection fixed)
=======
>>>>>>> parent of 0d49b12 (Merge pull request #2 from mrchocolate3d/Home-Page)

<nav class="right-nav">
    <ul>
        <li class="btn-login">
            <?php if(isset($_SESSION['user_id'])) : ?>

        <li>
            <a href="<?php echo URLROOT; ?>/users/account">Your Account</a>
        </li>

        <li>
            <a href="<?php echo URLROOT; ?>/users/logout">Log out</a>
        </li>
            <?php else : ?>
                <li>
                    <a href="<?php echo URLROOT; ?>/users/login">Login</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/users/register">Register</a>
                </li>
            <?php endif; ?>
    </ul>
</nav>
