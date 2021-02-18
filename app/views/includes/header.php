<nav class="nav">
    <ul>
        <li class="btn-login">
            <?php if(isset($_SESSION['user_id'])) : ?>
                <a href="<?php echo URLROOT; ?>/app/index.php">Log out</a>
            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/app/index.php">Login</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>