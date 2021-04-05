<?php ?>

<main>
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/header.php';
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>

    <section class="history-container">
        <h1 id="history-intro-h">Tour locations</h1>
        <img src="../img/history_map_locations.jpg" id="location_image">
        <a id="history-show-more" href="<?php echo URLROOT; ?>/histories/detail" type="button">Go back</a>
    </section>

</main>
