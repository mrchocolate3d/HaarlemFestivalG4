
<main role ="main" id="history-main">
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/header.php';
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>

    <section class="main-history-container">
        <section class="main-add-history">
            <h1 id="add-ticket-title">Tour Detail</h1>
            <section class="add-history-container">
                <h2>Add ticket:</h2>
                <form method="post" action="<?php echo URLROOT; ?>/histories/add">
                    <input type="hidden" name="history_event_id" value="<?php echo $data[$data['id']]['event_id']?>">
                    <ul id="ul-headers">
                        <li>Tour guide</li>
                        <li>Starting time</li>
                        <li>Language</li>
                        <li>Date of tour</li>
                        <li>Price of ticket</li>
                    </ul>
                    <ul id="ul-content">
                        <li><input type="text"  name="tour_guide" value="<?php echo $data[$data['id']]['tour_guide']?>" readonly></li>
                        <li><input type="text"  name="starting_time" value="<?php echo $data[$data['id']]['starting_time']?>" readonly></li>
                        <li><input type="text"  name="lang" value="<?php echo $data[$data['id']]['lang']?>" readonly></li>
                        <li><input type="text"  name="date" value="<?php echo $data[$data['id']]['date']?>" readonly></li>
                        <li><input type="text"  name="price" value="<?php echo $data[$data['id']]['price']?>" readonly></li>
                    </ul>

                    <button id="submit" type="submit" value="Add to cart">Submit</button>
                    <a href="<?php echo URLROOT; ?>/histories/tickets" name="add-history-ticket" type="button">Back</a>
                    <?php echo $data['status']?>
                </form>

            </section>
        </section>

    </section>
    <?php //print_r($data);
        print_r($_SESSION["shopping_cart"]);
    //print_r($data);
            //print_r(count(array_keys($_SESSION["shopping_cart"])));
    //<input type="number" name="ticket-quantity" id="history-quantity" min="1" max="<?php echo $data['quantity']">
    ?>

</main>
