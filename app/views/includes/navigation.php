<nav id="navbar-hf">
    <nav class="top-nav">
        <ul>
            <li>
                <a href="<?php echo URLROOT; ?>/pages/index">Home</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/pages/jazz">Jazz</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/pages/history">History</a>
                <a href="<?php echo URLROOT; ?>/histories/detail">History</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/pages/dance">Dance</a>
            </li>
        </ul>
    </nav>

    <nav class="right-nav">
        <ul>

            <li> <img src="" alt="Haarlem Festival Logo"> </li>
            <li> <a href="<?php echo URLROOT . "/pages/index" ?>">Home</a> </li>
            <li> <a href="<?php echo URLROOT . "/jazz/home" ?>">Haarlem Jazz</a> </li>
            <li> <a href="<?php echo URLROOT . "/histories/detail" ?>">Haarlem History</a> </li>
            <li> <a href="<?php echo URLROOT . "/pages/dance" ?>">Haarlem Dance</a> </li>
            <li class="btn-login">
                <?php if (isset($_SESSION['user_id'])) : ?>

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