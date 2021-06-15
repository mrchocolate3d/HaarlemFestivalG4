<?php ?>
<main>
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/header.php';
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>
    <section class="main-history-container">

        <h1 id="confirm-title">Order Confirmation</h1>
        <section class="confirmation-container">

            <h2 id="confirm-detail">Your order has been placed!</h2>

            <table id="order-table">
                <thead>
                <th>Order ID</th>
                <th>Ticket</th>
                <th>Quantity</th>
                </thead>
                <?php
                foreach ($data as $datum){ ?>
                        <tr>

                            <td><?php echo $datum['orderID']?></td>
                            <td><?php echo $datum['ticketID']?></td>
                            <td><?php echo $datum['quantity']?></td>
                        </tr>
                <?php }?>
            </table>
    </section>
</main>