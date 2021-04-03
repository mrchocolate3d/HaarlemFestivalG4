<nav id="navbar-hf">
    <ul>
        <li> <img src="" alt="Haarlem Festival Logo"> </li>
        <li> <a href="<?php echo URLROOT . "/pages/index" ?>">Home</a> </li>
        <li> <a href="<?php echo URLROOT . "/jazz/home" ?>">Haarlem Jazz</a> </li>
        <li> <a href="<?php echo URLROOT . "/histories/detail" ?>">Haarlem History</a> </li>
        <li> <a href="<?php echo URLROOT . "/pages/dance" ?>">Haarlem Dance</a> </li>
        <li>
            <?php if (isset($_SESSION['firstname'])) : ?>
                <a href="<?php echo URLROOT; ?>/users/account">Your Account</a>
                <a href="<?php echo URLROOT; ?>/users/logout">Log out</a>
            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/users/login">Log In</a>
            <?php endif; ?>
        </li>

        <li>
            <a href="/cart/view"> <i class="bi bi-basket3-fill"></i></a>
        </li>
    </ul>
</nav>
