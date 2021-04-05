<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navigation.php';
?>


<main role="main">
    <section >
        <aside >
            <h2>Basket</h2>
                <?php
                if (isset($_SESSION["shopping_cart"])){
                    $total_price = 0;
                    $count = 1;
                ?>
            <table>
                <tbody>
                <tr>
                    <td>Event</td>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Price</td>
                    <td>Item Total</td>
                </tr>

                <?php
                foreach($_SESSION["shopping_cart"] as $item){
                ?>
                <tr>
                    <td><?php echo $count; ?><br />
                    <form method="post" action="<?php echo URLROOT; ?>/carts/cart">
                        <input type='hidden' name='idItem' value="<?php echo $item["idItem"]; ?>" />
                        <input type='hidden' name='action' value="remove" />
                        <button type='submit' class='remove'>Remove Item</button>
                    </form>
                    </td>

                    <td>
                        <form method="post" action="<?php echo URLROOT; ?>/carts/cart">
                            <input type='hidden' name='event_id' value="<?php echo $item["event_id"]; ?>" />
                            <input type='hidden' name='action' value="change" />
                            <select name="quantity" class="quantity" onchange="this.form.submit()">
                                <option <?php if($item["quantity"]==1) echo "selected";?> value="1">1</option>
                                <option <?php if($item["quantity"]==2) echo "selected";?> value="2">2</option>
                                <option <?php if($item["quantity"]==3) echo "selected";?> value="3">3</option>
                                <option <?php if($item["quantity"]==4) echo "selected";?> value="4">4</option>
                                <option <?php if($item["quantity"]==5) echo "selected";?> value="5">5</option>
                            </select>
                        </form>
                    </td>
                    <td><?php echo $item["tour_date"]; ?></td>
                    <td><?php echo $item["starting_time"]; ?></td>
                    <td><?php echo "€".$item["price"]; ?></td>
                    <td><?php echo "€".$item["price"]*$item["quantity"]; ?></td>

                </tr>
                    <?php $total_price += ($item["price"]*$item["quantity"]);
                    $count++;
                }
                ?>
                <tr>
                    <td colspan="5" align="right">
                        <strong>TOTAL: <?php echo "$".$total_price; ?></strong>
                    </td>
                </tr>
                </tbody>
            </table>
            <?php
                } else {
                    echo"<h3>Your cart is empty</h3>";
                }?>
        </aside>

        <aside>
            <form method="post" action="<?php echo URLROOT; ?>/carts/cart">
                <input type='hidden' name='action' value="confirm" />
                <a href="<?php echo URLROOT; ?>/payments/payment?cart=<?php echo $_SESSION["shopping_cart"];?>&total=<?php echo $total_price?>" name="pay"type="button">Continue to payment</a>

            </form>
        </aside>
    </section>

</main>