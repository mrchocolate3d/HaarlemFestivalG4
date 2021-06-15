<?php ?>

<main>
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/header.php';
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>

    <section class="main-history-container">
        <section class="main-confirm-container">
        <h1 id="account-orders">Account orders</h1>

        <table id="confirm-table">
            <thead>
            <th>Order ID</th>
            <th>total price</th>
            <th>status</th>
            <th>Select</th>
            </thead>
            <?php
            foreach ($data as $datum){ ?>
                <tr id="tr-confirm">

                    <td><?php echo $datum['orderID']?></td>
                    <td><?php echo $datum['totalPrice']?></td>
                    <td><?php echo $datum['status']?></td>
                    <td>
                        <a id="view-order-btn"href="<?php echo URLROOT; ?>/users/orderItems?orderID=<?php echo $datum['orderID'];?>">View order</a>
                    </td>
                </tr>
            <?php }?>
        </table>
        </section>
    </section>
</main>

