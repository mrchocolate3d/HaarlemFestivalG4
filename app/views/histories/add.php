
<main role ="main" id="history-main">
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/header.php';
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>

    <section class="main-history-container">
        <h1 id="add-ticket-title">Tour Detail</h1>
        <section class="tour-history-container">
            <form id="history-tickets-form" method="post" action="<?php echo URLROOT; ?>/histories/add">

                <input type="hidden" name="history_event_id" value="<?php echo $data[$data['id']]['event_id']?>">
                <ul id="ul-content">
                    <label for="guide_lbl">Guide name</label>
                    <li><input id="guide_lbl" type="text"  name="tour_guide" value="<?php echo $data[$data['id']]['tour_guide']?>" readonly></li>
                    <label for="time_lbl">time</label>
                    <li><input id="time_lbl" type="text"  name="starting_time" value="<?php echo $data[$data['id']]['starting_time']?>" readonly></li>
                    <label for="lang_lbl">Language</label>
                    <li><input id="lang_lbl" type="text"  name="lang" value="<?php echo $data[$data['id']]['lang']?>" readonly></li>
                    <label for="date_lbl">Date</label>
                    <li><input id="date_lbl" type="text"  name="date" value="<?php echo $data[$data['id']]['date']?>" readonly></li>
                    <label for="price_lbl">Price</label>
                    <li><input id="price_lbl" type="text"  name="price" value="<?php echo $data[$data['id']]['price']?>" readonly></li>
                </ul>

                <button class="add-ticket-history" id="add-ticket-history" type="submit" value="Add to cart">Add ticket to cart</button>
                <a href="<?php echo URLROOT; ?>/histories/tickets" name="add-history-ticket" type="button" id="back-tickets">Back</a>
                <?php echo $data['status']?>
            </form>
        </section>
    </section>
    <?php //print_r($data);
        print_r($_SESSION["shopping_cart"]);
    //print_r($data);
            //print_r(count(array_keys($_SESSION["shopping_cart"])));
    //<input type="number" name="ticket-quantity" id="history-quantity" min="1" max="<?php echo $data['quantity']">
    ?>

</main>
