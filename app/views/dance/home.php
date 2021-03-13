<?php include APPROOT . '/views/includes/header.php'; ?>

<?php 
    // if user clicks on an event this will be evaluated
    if(isset($data['event_id']) && !empty(trim($data['event_id']))) {
        $event_details = $data["artist_data"];

        if (is_array($event_details)) {
            $price = $event_details["price"];
            $vat = 0.21 * $price;
            $totalprice = $price + $vat;
            $popup = '<section id="Modal" class="modal">
                        <!-- Modal content -->
                        <section class="modal-content">
                            <span class="close">&times;</span>
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
                                    <h4 id="modal-event-time-place">'.$event_details["time_place"].'</h4>

                                    <form action="' . URLROOT . '/cart/daypass" method="POST" >
                                        <input type="hidden" name="event_id" value="dance_1_day_pass" />
                                        <button type="submit"><img src="" alt="Party All Night - Full Day Pass @150"></button>
                                    </form>

                                    <h3>Price</h3>
                                    <h4 id="modal-event-price">€'.$price.'</h4>
                                    <h3>Amount</h3>
                                    <select name="ticket-count" id="modal-event-ticket-count">
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
                                                        <button type="submit">Checkout</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="' . URLROOT . '/cart/add_to_cart" method="POST" >
                                                        <input type="hidden" name="event_id" value="' . $data["event_id"] . '" />
                                                        <input type="hidden" name="atc_count" value=1 />
                                                        <button type="submit">Add To Cart</button>
                                                    </form>
                                                </td>
                                            </tr>
                                    </table>
                            </aside>

                        </section>
                    </section>';
                    $popup_script = "<script>
                    $(function() {
                        // CODE TO CLOSE THE POPUP
                        // USE THE .on METHOD IN CASE WE
                        // WANT TO MODIFY THIS TO LOAD POPUP
                        // CONTENT VIA AJAX
                        $('body').on('click','.closePopup', function() {
                            $('.modal').remove()
                        });
                        // HANDLE THE WINDOW RESIZE.
                        // WHEN WINDO IS RESIZED - MAKE SURE
                        // POPUP STAYS CENTERED.
                        $(window).resize(function() {
                            // FIND THE POPUP
                            var popup = $('#Modal');
                        // IF IT EXISTS CENTRE IT
                            if (popup.length > 0) {
                            centerPopup();
                            }
                        });
                        
                        $('document').ready(function(e) {
                            var popup = '".$popup."';
                            $('body').append(popup);
                            centerPopup();
                        });
                        });
                        
                        function centerPopup()
                        {
                        var popup = $('#Modal');
                        // LEFT AND TOP VALUES IS HALF THE DIFFERENCE 
                        // BETWEEN THE WINDOW AND POPUP METRICS.
                        // USE THE SHIFT RIGHT OPERATOR TO DO DIV BY 2
                        var left = ($(window).width() - popup.width()) >> 1;
                        var top = ($(window).height() - popup.height()) >> 1;
                        // SET LEFT AND TOP STYLES TO CALCULATED VALUES
                        popup.css({left: left + 'px', top: top + 'px'});
                        }";

                    echo $popup_script;
            }
    }
    // if user clicks add to cart this will be evaluated 
    else if(isset($_POST['add_to_cart'])) {
        
    }
?>
    <script type="text/javascript">
            $(function() {
            // CODE TO CLOSE THE POPUP
            // USE THE .on METHOD IN CASE WE
            // WANT TO MODIFY THIS TO LOAD POPUP
            // CONTENT VIA AJAX
            $('body').on('click','.closePopup', function() {
                // CHANGE BACKGROUND TO GREEN 
            // FOLLOWED BY A FADEOUT TO GIVE
            // A DELAY TO SHOW CHANGE IN COLOUR
                $('.action input').css({backgroundColor: 'green'}).fadeOut(300, function() {
                // REMOVE ALL ELEMENTS WITH THE 
                // popupElement STYLE - INCLUDES OVERLAY
                // AND POUP
                $('.popupElement').remove()
                });
            });
            // HANDLE THE WINDOW RESIZE.
            // WHEN WINDO IS RESIZED - MAKE SURE
            // POPUP STAYS CENTERED.
            $(window).resize(function() {
                // FIND THE POPUP
                var popup = $('#popupWindow');
            // IF IT EXISTS CENTRE IT
                if (popup.length > 0) {
                centerPopup();
                }
            });
            // TRIGER DISPLAY OF POPUP
            $('a').click(function(e) {
                // DISABLE DEFAULT CLICK FUNCTIONALITY FOR <a>
                e.preventDefault();
            // CREATE OUR OVERLAY AND APPEND TO BODY
                var overlay = $('<div/>').addClass('overlay').addClass('popupElement');
                $('body').append(overlay);
            // CREATE OUR POPUP AND POSITION OFFSCREEN.
            // WE DO THIS SO WE CAN DISPLAY IT AND CALCULATE
            // ITS WIDTH AND HEIGHT SO WE CAN CENTRE IT
                var popup = $('<div/>').attr('id','popupWindow').addClass('popup').addClass('popupElement').css({left: '-999px'});
            // CREATE THE HTML FOR THE POPUP
                var html = '<img src="' + $(this).attr('href') + '" /><div class="action"><input type="button" value="Continue" class="closePopup"/></div>';
                popup.html(html);
            // APPEND THE POPUP TO THE BODY
                $('body').append(popup);
            // AND CENTER IT
                centerPopup();
            });
            });
            // FUNCTION TO CENTER THE POPUP
            function centerPopup()
            {
            var popup = $('#popupWindow');
            // LEFT AND TOP VALUES IS HALF THE DIFFERENCE 
            // BETWEEN THE WINDOW AND POPUP METRICS.
            // USE THE SHIFT RIGHT OPERATOR TO DO DIV BY 2
            var left = ($(window).width() - popup.width()) >> 1;
            var top = ($(window).height() - popup.height()) >> 1;
            // SET LEFT AND TOP STYLES TO CALCULATED VALUES
            popup.css({left: left + 'px', top: top + 'px'});
            }
</script>
<style type="text/css">
.modal {
  background: #999;
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  top: 0;
  opacity: 0.95;
  filter: alpha(opacity=95);
  z-index: 1;
}
</style>

<main>
    <a href="images/a3.jpg">Click me</a>
    <section class="title-screen">
       
        <section id="dance-title">
                <h1>Haarlem Dance</h1>
                <h2>
                    The festival bringing you to the best dance acts from, both local and all around the world, performing at haarlem's very own 
                    caprera openluchttheather, and other exciting theathers in haarlem, a enjoyable
                    and fun event you dont wanna miss. 
                </h2>
                <a href="#dance-info-page" class="button transparent">Show More</a>
        </section>
    </section>

    <section id="dance-info-page">
            <section id="dance-info" class="card">

                    <img src="../img/dance_in_haarlem.png" alt="Haarlem festival dance stage" id="dance-in-haarlem-image">
                    <section id="dance-in-haarlem">
                        <h3>Dance In Haarlem</h3>
                        <p>
                        Haarlem is no stranger to dance with many localities and venues embracing it.
                        </p>
                    <p>
                        The event's sheer size impressive lineups and unbeatable party atomosphere will make your experience in dance like never before. 
                    </p>
                    </section>

                    <img src="../img/caprera.png" alt="Caprera openluchtheather" id="caprera-image">
                    <section id="caprera">
                        <h3>Caprera Openluchttheather</h3>
                    <p>
                        Caprera openluchttheather prounanced as (caprera open air theather in English) is the most popular and amazing location to experience any kind of performances.
                    </p>
                    <p>
                        Located between the dunes and forest, here you can enjoy all kinds of dance events experiencing the enchanting evening under the stars giving you unforgettable experieces
                    </p>
                    </section>

                    <img src="../img/xotheclub.png" alt="XO the club" id="xothclub-image">
                    <section id="xotheclub">
                        <h3>XO the club</h3>
                    <p>
                        The second most popular club in the netherlands known for hosting incrediable performances 
                        and want to dance the night away then you should definiately go to this club.

                        the doors are open from 9pm at night to 4 am in the morning!
                    </p>
                    </section>
                    <a href="#dance-timetable-page" class="button transparent">See What's On</a>
            </section>

            <!-- <aside id="dance-artists">
                <img src="../img/martin_garrix.png" alt="artist1">
                <img src="../img/hardwell.png" alt="artist2">
                <img src="../img/armin_van_buuren.png" alt="artist3">
                <img src="../img/tiesto.png" alt="artist4"> 
            </aside> -->

    </section>

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
                    $table.= '<th>'.$venue.'</th>';
                    foreach($data['dates'] as $dt) {
                        $table .= '<td class="popup">';
                        
                            if($data['timetable'][$dt][$venue]["text"] == "NO EVENTS") {
                                 $table .= "NO EVENTS";
                            }
                            else {
                                $table .=   '<form action="' . URLROOT . '/dance/event" method="POST">
                                                <input type="hidden" name="event_id" value="' . $data['timetable'][$dt][$venue]["id"] . '" />
                                                <button type="submit">' . $data['timetable'][$dt][$venue]["text"] . '</button>
                                            </form>';
                            }
                        $table .= '</td>';      
                                        
                    }
                    $table.= '</tr>';
               }

               $table.= '</table>';
               echo $table;
        ?>
        
        <script>
            // Get the modal
            var modal = document.getElementById("Modal");
            
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.remove();
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.remove();
                }
            
            }
            // dropdown ticket count on change
            var ticket_Count = document.getElementById("modal-event-ticket-count");

            var price = document.getElementById("modal-ticket-price");
            var subtotal = document.getElementById("modal-ticket-subtotal");
            var vat = document.getElementById("modal-ticket-vat");
            var total = document.getElementById("modal-ticket-total");
            var checkout_count = document.getElementByName("checkout_count");
            var add_to_cart = document.getElementByName("atc_count");

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

        </script>
        </section>
    </section>
</main>



