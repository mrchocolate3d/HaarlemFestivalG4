<nav id="navbar-hf">
    <ul>
        <li> <img src="" alt="Haarlem Festival Logo"> </li>
        <li> <a href="<?php echo URLROOT . "/pages/index" ?>">Home</a> </li>
        <li> <a href="<?php echo URLROOT . "/jazz/home" ?>">Haarlem Jazz</a> </li>
        <li> <a href="<?php echo URLROOT . "/histories/detail" ?>">Haarlem History</a> </li>
        <li> <a href="<?php echo URLROOT . "/pages/dance" ?>">Haarlem Dance</a> </li>
        <li>
            <?php
            if (isset($_SESSION['user_id'])) {
                //Show User Menu Drop down
                // <li><a href="<?php echo URLROOT; ? >/users/account">Your Account</a></li>
                // <li><a href="<?php echo URLROOT; ? >/users/logout">Log out</a></li>
            } else {
                //Show Login Button
            ?> 
            <a class="btn-login" href="<?php echo URLROOT; }?>/users/login">Log&nbsp;In</a>
        </li>

        <li>
            <a href="/cart/view"> <i class="bi bi-basket3-fill"></i></a>
        </li>
</nav>
