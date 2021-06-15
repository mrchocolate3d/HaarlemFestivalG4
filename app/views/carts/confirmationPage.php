<?php ?>
<main role="main" id="cart-main">
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/header.php';
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>
    <section class="main-history-container">
        <section class="main-confirm-container">
            <h1 id="confirm-title">Order Confirmation</h1>

            <h2 id="confirm-detail">Your order has been placed!</h2>

            <table id="confirm-table">
                <thead>
                <th>Order ID</th>
                <th>Ticket</th>
                <th>Quantity</th>
                </thead>
                <?php
                foreach ($data as $datum){ ?>
                    <tr id="tr-confirm">

                        <td><?php echo $datum['orderID']?></td>
                        <td><?php echo $datum['ticketID']?></td>
                        <td><?php echo $datum['quantity']?></td>
                    </tr>
                <?php }?>
            </table>

            <form action="<?php echo URLROOT; ?>/Invoice/generatePdf">
                <button id="generate-invoice-btn" type="submit">Generate Invoice</button>
            </form>

        </section>
    </section>


</main>