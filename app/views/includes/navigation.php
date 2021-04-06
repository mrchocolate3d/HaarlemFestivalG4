<nav id="navbar-hf">
    <ul>
        <li> <img src="" alt="Haarlem Festival Logo"> </li>
        <li> <a href="<?php echo URLROOT . "/pages/index" ?>">Home</a> </li>
        <li> <a href="<?php echo URLROOT . "/jazz/home" ?>">Haarlem Jazz</a> </li>
        <li> <a href="<?php echo URLROOT . "/histories/detail" ?>">Haarlem History</a> </li>
        <li> <a href="<?php echo URLROOT . "/dance/home" ?>">Haarlem Dance</a> </li>
        <li>
            <?php if (isset($_SESSION['email'])) : ?>
                <a href="<?php echo URLROOT; ?>/users/account">Your Account</a>
                <a href="<?php echo URLROOT; ?>/users/logout">Log out</a>
            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/users/login">Log In</a>
            <?php endif; ?>
        </li>

        <li>
            <?php
            if(!empty($_SESSION["shopping_cart"])) {
            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
            ?>
            <a href="<?php echo URLROOT . "/carts/cart" ?>"><img src="../img/cart-icon.png" /> Cart<span><?php echo $cart_count; ?></span></a>
            <?php } ?>
        </li>
    </ul>
</nav>
