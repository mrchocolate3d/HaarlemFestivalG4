<nav id="navbar-hf">
    <ul>
        <li> <img src="" alt="Haarlem Festival Logo"> </li>
        <li> <a href="<?php echo URLROOT . "/admins/homepage" ?>">Homepage</a> </li>
        <li> <a href="<?php echo URLROOT . "/historyAdmins/viewHistories" ?>">Haarlem History</a> </li>
        <li> <a href="<?php echo URLROOT . "/admins/danceAdmin" ?>">Haarlem Dance</a></li>
        <li> <a href="<?php echo URLROOT . "/danceAdmins/viewArtist" ?>">Dance Artists</a></li>
        <li> <a href="<?php echo URLROOT . "/users/viewAllUsers" ?>">View Users</a></li>
        <li>
            <?php if (isset($_SESSION['adminEmail'])) : ?>

                <?php if ($_SESSION['AdminType'] == 'SuperAdministrator') {?>
                    <a href="<?php echo URLROOT; ?>/admins/allAdminList">All Admins</a>
            <?php } ?>
        <a href="<?php echo URLROOT; ?>/admins/adminAccount">Your Account</a>
        <a href="<?php echo URLROOT; ?>/admins/adminLogout">Log out</a>
            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/admins/loginAdmin">Log In</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>
