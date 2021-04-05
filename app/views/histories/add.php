
<main role ="main" id="history-main">
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/header.php';
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>

    <section class="main-history-container">
        <h1>Tour Detail</h1>
        <section class="add-history-container">
            <form method="post" action="<?php echo URLROOT; ?>/histories/add">
                <input type="hidden" name="history_event_id" value="<?php echo $data[$data['id']]['event_id']?>">
                <ul>
                    <li><input type="text"  name="tour_guide" value="<?php echo $data[$data['id']]['tour_guide']?>" readonly></li>
                    <li><input type="text"  name="starting_time" value="<?php echo $data[$data['id']]['starting_time']?>" readonly></li>
                    <li><input type="text"  name="lang" value="<?php echo $data[$data['id']]['lang']?>" readonly></li>
                    <li><input type="text"  name="tour_date" value="<?php echo $data[$data['id']]['tour_date']?>" readonly></li>
                    <li><input type="text"  name="price" value="<?php echo $data[$data['id']]['price']?>" readonly></li>
                </ul>
                <input type="number" name="ticket-quantity" id="history-quantity" min="1" max="<?php echo $data['quantity']?>">
                <button id="submit" type="submit" value="Add to cart">Submit</button>
                <a href="<?php echo URLROOT; ?>/histories/tickets" name="add-history-ticket" type="button">Back</a>
                <?php echo $data['status']?>
            </form>

        </section>
    </section>
    <?php //print_r($data);
        print_r($_SESSION["shopping_cart"]);
    //print_r($data);
            //print_r(count(array_keys($_SESSION["shopping_cart"])));
    ?>

</main>
