
<main role ="main" id="history-main">
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/header.php';
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>
    <?php var_dump($ticketstest);?>

    <section class="main-history-container">
        <h1>Tour Detail</h1>
        <section class="add-history-container">
            <form method="post" action="<?php echo URLROOT; ?>/histories/tickets">
                <ul>
                    <li><?php echo $data['tour_date']?></li>
                    <li><?php echo $data['starting_time']?></li>
                    <li><?php echo $data['lang']?></li>
                    <li><?php echo $data['tour_guide']?></li>
                </ul>
                <input type="number" name="ticket-quantity" id="history-quantity" min="1" max="<?php echo $data['quantity']?>">
                <a href="<?php echo URLROOT; ?>/histories/tickets" name="add-history-ticket" type="button">Add ticket</a>
                <a href="<?php echo URLROOT; ?>/histories/confirmation?ticket=<?php echo $ticketstest['history_event_id']?>" name="add-test" type="button">Add test</a>
            </form>
        </section>
    </section>
</main>
