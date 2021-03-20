<?php include APPROOT . '/views/includes/header.php'; ?>

<?php 
    // if user clicks on an event this will be evaluated
    if(isset($data['event_id']) && !empty(trim($data['event_id']))) {
        $event_details = $data["artist_data"];

        if (is_array($event_details)) {

            $price = $event_details["price"];
            $vat = 0.21 * $price;
            $totalprice = $price;
            
            $popup = '<section id="Modal" class="modal">
                        <!-- Modal content -->
                        <section class="modal-content">
                            <span class="close" style="float: right;">&times;</span>
                            <article id="modal-artist">
                                    <h3 id="modal-artist-title">'.$event_details["name"].'</h3>
                                    <img id="modal-artist-image" src="'.$event_details["image"].'" alt="artist image">
                                   <a href="' . $event_details["facebook"] . '"> <img id="modal-artist-fb" src="" alt="Facebook"> </a>
                                   <a href="' . $event_details["instagram"]. '"> <img id="modal-artist-insta" src="" alt="Instagram"> </a>
                                   <a href="' . $event_details["twitter"]  . '"> <img id="modal-artist-twitter" src="" alt="Twitter"> </a>

                                    <p id="modal-artist-description">
                                        '.$event_details["description"].'
                                    </p>
                            </article>

                            <article id="modal-event-details">
                                    <h3>Event Details</h3>
                                    <h4 id="modal-event-title">'.$event_details["name"].'</h4>
                                    <p id="modal-event-time-place">'.$event_details["time_place"].'</p>

                                    <form action="' . URLROOT . '/cart/daypass" method="POST" >
                                        <input type="hidden" name="event_id" value="dance_1_day_pass" />
                                        <button type="submit"><img src="" alt="Party All Night - Full Day Pass @150"></button>
                                    </form>

                                    <h3 id="modal-price-label">Price</h3>
                                    <h4 id="modal-event-price">€'.$price.'</h4>
                                    <h3>Amount</h3>
                                    <select name="ticket-count" id="modal-event-ticket-count" onchange="oc">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                    </select>

                                    <form action="' . URLROOT . '/cart/multipass" method="POST" >
                                        <input type="hidden" name="event_id" value="dance_3_days_pass" />
                                        <button type="submit"><img src="" alt="Dance Freak - 3 Days Pass @250"></button>
                                    </form>

                            </article>

                            <aside id="modal-ticket-details">
                                    <h2>Total</h2>
                                    <h3 id="modal-ticket-price">€'.$totalprice.'</h3>
                                    <hr />
                                    <table>
                                            <tr>
                                                <td>Sub-total</td>
                                                <td id="modal-ticket-subtotal">€'.$price.'</td>
                                            </tr>

                                            <tr>
                                                <td>VAT@21%</td>
                                                <td id="modal-ticket-vat">€'.$vat.'</td>
                                            </tr>

                                            <tr>
                                                <td>Total</td>
                                                <td id="modal-ticket-total">€'.$totalprice.'</td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <form action="' . URLROOT . '/cart/checkout" method="POST" >
                                                        <input type="hidden" name="event_id" value="' . $data["event_id"] . '" />
                                                        <input type="hidden" name="checkout_count" value=1 />
                                                        <button id="checkoutbutton" type="submit">Checkout</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="' . URLROOT . '/cart/add_to_cart" method="POST" >
                                                        <input type="hidden" name="event_id" value="' . $data["event_id"] . '" />
                                                        <input type="hidden" name="atc_count" value=1 />
                                                        <button id="addcartbutton"type="submit">Add To Cart</button>
                                                    </form>
                                                </td>
                                            </tr>
                                    </table>
                            </aside>

                        </section>
                    </section>';
                    
                    echo $popup;
        }
    }
    // if user clicks add to cart this will be evaluated 
    else if(isset($_POST['add_to_cart'])) {
        
    }
?>
  
<main>
    <section class="title-screen">
       
        <section id="dance-title" class="content">
                <h1 style="float: center;">Haarlem Dance</h1>
                <p>
                    The festival bringing you to the best dance acts from, both local and all around the world, performing at haarlem's very own 
                    caprera openluchttheather, and other exciting theathers <br> in haarlem, a enjoyable
                    and fun event you dont wanna miss. 
                </p>
                <a href="#dance-info-page" class="buttonTransparent">Show More</a>
        </section>
    </section>

    <section id="dance-info-page">
            <section id="dance-info" class="card">
                    <table>
                    <tr>
                    <td>
                        <img src="../img/dance_in_haarlem.png" alt="Haarlem festival dance stage" id="dance-in-haarlem-image">
                    </td>

                    <td colspan = "2">
                    <section id="dance-in-haarlem">
                        <h3>Dance In Haarlem</h3>
                        <p>
                            Haarlem is no stranger to dance with many localities and venues embracing it.
                        </p>
                    <p>
                        The event's sheer size impressive lineups and unbeatable party atomosphere will make your experience in dance like never before. 
                    </p>
                    </section>
                    </td>

                    </tr>
                    <tr>
                    <td colspan = "2">
                    <section id="caprera">
                        <h3>Caprera Openluchttheather</h3>
                    <p>
                        Caprera openluchttheather prounanced as (caprera open air theather in English) is the most popular and amazing location to experience any kind of performances.
                    </p>
                    <p>
                        Located between the dunes and forest, here you can enjoy all kinds of dance events experiencing the enchanting evening under the stars giving you unforgettable experieces
                    </p>
                    </section>
                        <td> <img src="../img/caprera.png" alt="Caprera openluchtheather" id="caprera-image"> </td>
                    </tr>

                    <tr>
                    <td>
                        <img src="../img/xotheclub.png" alt="XO the club" id="xothclub-image">
                    </td>
                    <td colspan = "2">
                        <section id="xotheclub">
                        <h3>XO the club</h3>
                    <p>
                        The second most popular club in the netherlands known for hosting incrediable performances 
                        and want to dance the night away then you should definiately go to this club.

                        the doors are open from 9pm at night to 4 am in the morning!
                    </p>
                    </section>
                    </td>
                    </table>
                    <a href="#dance-timetable-page" class="button">See What's On</a>
                    
            </section>
    </section>
    
            <aside id="dance-artists" class="justify-content-end">
                <h3 style="text-align: center;">Spotlight</h3>
                <section id="image1" class="frame">
                     <img src="../img/vip all access.png" alt="vip ticket" width="300px" >
                </section>

                <section class="frame">
                    <h4 id="image-header">Martin Garrix</h4>
                    <img src="../img/martin_garrix.png" alt="artist1">
                </section>

                <section class="frame">
                    <h4 id="image-header">Hardwell</h4>
                    <img src="../img/hardwell.png" alt="artist2">
                </section>

                <section class="frame">
                    <h4 id="image-header">Armin van Burren</h4>
                    <img src="../img/armin_van_buuren.png" alt="artist3">
                </section>

                <section class="frame">
                    <h4 id="image-header">Tiesto</h4>
                    <img src="../img/tiesto.png" alt="artist4">
                </section> 
            </aside> 

    <section id="dance-timetable-page">
        <section class="timetable card" id="dance-timetable">
        <?php
               $table =  '<table border = 1>
               <tr><th>Venue</th>
               <th>Friday-27th July</th>
               <th>Saturday-28th July</th>
               <th>Sunday-29th July</th></tr>';

               foreach($data['venues'] as $venue) {
                    $table.= '<tr>';
                    $table.= '<th id="table-venue">'.$venue.'</th>';
                    foreach($data['dates'] as $dt) {
                        $table .= '<td id="table-content" class="popup">';
                        
                            if($data['timetable'][$dt][$venue]["text"] == "NO EVENTS") {
                                 $table .= "<b>NO EVENTS</b>";
                            }
                            else {
                                $table .=   '<form action="' . URLROOT . '/dance/event" method="POST">
                                                <input type="hidden" name="event_id" value="' . $data['timetable'][$dt][$venue]["id"] . '" />
                                                <button id="event-button" type="submit">'.'<b>' . $data['timetable'][$dt][$venue]["text"] .'</b>'. '</button>
                                            </form>';
                            }
                        $table .= '</td>';      
                                        
                    }
                    $table.= '</tr>';
               }

               $table.= '</table>';
               echo $table;
        ?>
        <style>
	 /* The Modal (background) */
	.modal {
        display: none; /* Hidden by default */
	  position: fixed; /* Stay in place */
	  z-index: 1; /* Sit on top */
	  left: 50%;
	  top: 50%;
	  width: 100%; /* Full width */
	  height: 100%; /* Full height */
	  overflow: auto; /* Enable scroll if needed */
	  background-color: rgb(0,0,0); /* Fallback color */
	  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      
	}

	/* Modal Content/Box */
	.modal-content {
        background-color: #fefefe;
	    margin: 15% auto; /* 15% from the top and centered */
	    padding: 20px;
	    width: 80%; /* Could be more or less, depending on screen size */
        border: 4px solid orange;
	}

	/* The Close Button */
	.close {
	  color: #aaa;
	  float: right;
	  font-size: 50px;
	  font-weight: bold;
      position: absolute;
      top: 5;
      right: 5;
	}

	.close:hover,
	.close:focus {

        color: black;
	    text-decoration: none;
	    cursor: pointer;
	}
</style>
        <script>
	// Get the modal
	var modal = document.getElementById("Modal");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on the button, open the modal
	var display_popup = function() {
	  modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
</script>
        <script>
            // dropdown ticket count on change
            var ticket_Count = document.getElementById("modal-event-ticket-count");

            var price = document.getElementById("modal-ticket-price");
            var subtotal = document.getElementById("modal-ticket-subtotal");
            var vat = document.getElementById("modal-ticket-vat");
            var total = document.getElementById("modal-ticket-total");
            var checkout_count = document.getElementsByName("checkout_count")[0];
            var add_to_cart = document.getElementsByName("atc_count")[0];

                ticket_Count.addEventListener("change", function() {
                var count = parseInt(ticket_Count.value);
                var price_value = parseFloat(subtotal.slice(1));
                var new_subtotal = price_value * count;
                var new_vat = 0.21 * new_subtotal;
                var new_total = new_vat + new_total;

                price.innerText = "€" + new_total;
                total.innerText = "€" + new_total;
                vat.innerText = "€" + new_vat;
                subtotal.innerText = "€" + new_subtotal;

                checkout_count.value = count;
                atc_count.value = count;
            });

            oc=function() {
                var count = parseInt(ticket_Count.value);
                var price_value = parseFloat(subtotal.slice(1));
                var new_subtotal = price_value * count;
                var new_vat = 0.21 * new_subtotal;
                var new_total = new_vat + new_total;

                price.innerText = "€" + new_total;
                total.innerText = "€" + new_total;
                vat.innerText = "€" + new_vat;
                subtotal.innerText = "€" + new_subtotal;

                checkout_count.value = count;
                atc_count.value = count;
            };
            
        </script>
        </section>
    </section>
</main>
<?php
    if(isset($data['event_id']) && !empty(trim($data['event_id']))) {
        $event_details = $data["artist_data"];

        if (is_array($event_details)) {
            echo "<script type='text/javascript'> window.onload=display_popup; </script>";
        }
    }
?>