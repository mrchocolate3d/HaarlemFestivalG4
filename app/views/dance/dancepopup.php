<?php 

 // if user clicks on an event on the table cell this will be evaluated
 if(isset($data['event_id']) && !empty(trim($data['event_id']))) {
    $event_details = $data["artist_data"];
    if (is_array($event_details)) {
        
        // $price = $event_details["price"];
        // $vat = 0.21 * $price;
        // $totalprice = $price;
        $popup1 = '<section id="Modal" class="modal">
                        <section class="row modal-content">
                            <span class="close" style="float: right;">&times;</span>
                                <section class="col-sm-8" style="border: #F07913 3px solid;">
                                        <section class="row">
                                                <section class="col-sm-12">
                                                        
                                                        <section class="row">
                                                                <section class="col-sm-4">
                                                                        <section class="row">
                                                                              <section class="col-sm-12">
                                                                                    <img id="modal-artist-image" src="'.$event_details["image"].'" alt="artist image">
                                                                              </section>
                                                                        </section>

                                                                        <section class="row">
                                                                                <section class="col">
                                                                                        <a class="dance-social-media" href="' . $event_details["facebook"] . '"> <i class="fab fa-facebook-square" style="font-size:36px; color: black;"></i> </a>
                                                                                        <a class="dance-social-media" href="' . $event_details["instagram"]. '"> <i class="fab fa-instagram" style="font-size:36px; color: black;"></i></a>
                                                                                        <a class="dance-social-media" href="' . $event_details["twitter"]  . '"> <i class="fab fa-twitter-square" style="font-size:36px; color: black;"></i> </a>
                                                                                </section>
                                                                                
                                                                        </section>
                                                                </section>

                                                                <section class="col-sm-8">
                                                                        <h2 class="dance-title" id="modal-artist-title">'.$event_details["name"].'</h2>

                                                                        <p id="modal-artist-description">'.$event_details["description"].'</p>
                                                                </section>
                                                        </section>
                                                </section>
                                        </section>

                                        <section class="row" style="border-top: #F07913 3px dashed; margin-top: 2%;">
                                                <section class="col-sm-12" style="margin-top: 2%;">
                                                        <section class="row dance-title">
                                                               <section class="col-sm-4">
                                                                        <h4> Event Details </h4>
                                                               </section>
                                                               
                                                               <section class="col-sm-4">
                                                                        <h4 class="text-center"> Price </h4>
                                                               </section> 

                                                               <section class="col-sm-4">
                                                                        <h4> Amount </h4>
                                                               </section> 
                                                        </section>

                                                        <section class="row dance-title">
                                                                <section class="col-sm-4">
                                                                        <p>'.$event_details["name"].'</p>
                                                                </section>
                                                                
                                                                <section class="col-sm-4">
                                                                        <!--<p>€'.$price.'</p>-->
                                                                        <p class="text-center">€110</p>
                                                                </section> 

                                                                <section class="col-sm-4 form-group">
                                                                
                                                                <!-- <select name="ticket-count" id="modal-event-ticket-count" onchange="oc"> -->
                                                                     <select name="ticket-count" id="modal-event-ticket-count" class="form-control dance-select">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
                                                                </section> 
                                                        </section>

                                                        <section class="row dance-title">
                                                                <section class="col-sm-12">
                                                                        <p>'.$event_details["time_place"].'</p>
                                                                </section>
                                                        </section>

                                                        <section class="row">
                                                                <section class="col-sm-6">
                                                                        <form action="' . URLROOT . '/cart/multipass" method="POST" >
                                                                                <input type="hidden" name="event_id" value="dance_3_days_pass" />
                                                                                <button type="submit"><img src="" alt="Dance Freak - 3 Days Pass @250"></button>
                                                                        </form>
                                                                </section>

                                                                <section class="col-sm-6">
                                                                        <form action="' . URLROOT . '/cart/daypass" method="POST" >
                                                                                <input type="hidden" name="event_id" value="dance_1_day_pass" />
                                                                                <button type="submit"><img src="" alt="Party All Night - Full Day Pass @150"></button>
                                                                        </form>
                                                                </section>
                                                        </section>
                                                </section>
                                        </section>
                                </section>

                                <section class="col-sm-4" style="border: #F07913 3px solid;">

                                </section>
                        </section>
                   </section>';
        // $popup = '<section id="Modal" class="modal">
        //             <!-- Modal content -->
        //             <section class="modal-content">
        //                 <span class="close" style="float: right;">&times;</span>
        //                 <article id="modal-artist">
        //                         <h3 id="modal-artist-title">'.$event_details["name"].'</h3>
        //                         <img id="modal-artist-image" src="'.$event_details["image"].'" alt="artist image">
        //                        <a href="' . $event_details["facebook"] . '"> <img id="modal-artist-fb" src="" alt="Facebook"> </a>
        //                        <a href="' . $event_details["instagram"]. '"> <img id="modal-artist-insta" src="" alt="Instagram"> </a>
        //                        <a href="' . $event_details["twitter"]  . '"> <img id="modal-artist-twitter" src="" alt="Twitter"> </a>

        //                         <p id="modal-artist-description">
        //                             '.$event_details["description"].'
        //                         </p>
        //                 </article>

        //                 <article id="modal-event-details">
        //                         <h3>Event Details</h3>
        //                         <h4 id="modal-event-title">'.$event_details["name"].'</h4>
        //                         <p id="modal-event-time-place">'.$event_details["time_place"].'</p>

        //                         <form action="' . URLROOT . '/cart/daypass" method="POST" >
        //                             <input type="hidden" name="event_id" value="dance_1_day_pass" />
        //                             <button type="submit"><img src="" alt="Party All Night - Full Day Pass @150"></button>
        //                         </form>

        //                         <h3 id="modal-price-label">Price</h3>
        //                         <h4 id="modal-event-price">€</h4>
        //                         <h3>Amount</h3>
        //                         <select name="ticket-count" id="modal-event-ticket-count" onchange="oc">
        //                                 <option value="1">1</option>
        //                                 <option value="2">2</option>
        //                                 <option value="3">3</option>
        //                                 <option value="4">4</option>
        //                                 <option value="5">5</option>
        //                         </select>

        //                         <form action="' . URLROOT . '/cart/multipass" method="POST" >
        //                             <input type="hidden" name="event_id" value="dance_3_days_pass" />
        //                             <button type="submit"><img src="" alt="Dance Freak - 3 Days Pass @250"></button>
        //                         </form>

        //                 </article>

        //                 <aside id="modal-ticket-details">
        //                         <h2>Total</h2>
        //                         <h3 id="modal-ticket-price">€'.$totalprice.'</h3>
        //                         <hr />
        //                         <table>
        //                                 <tr>
        //                                     <td>Sub-total</td>
        //                                     <td id="modal-ticket-subtotal">€'.$price.'</td>
        //                                 </tr>

        //                                 <tr>
        //                                     <td>VAT@21%</td>
        //                                     <td id="modal-ticket-vat">€'.$vat.'</td>
        //                                 </tr>

        //                                 <tr>
        //                                     <td>Total</td>
        //                                     <td id="modal-ticket-total">€'.$totalprice.'</td>
        //                                 </tr>

        //                                 <tr>
        //                                     <td>
        //                                         <form action="' . URLROOT . '/cart/checkout" method="POST" >
        //                                             <input type="hidden" name="event_id" value="' . $data["event_id"] . '" />
        //                                             <input type="hidden" name="checkout_count" value=1 />
        //                                             <button id="checkoutbutton" type="submit">Checkout</button>
        //                                         </form>
        //                                     </td>
        //                                     <td>
        //                                         <form action="' . URLROOT . '/cart/add_to_cart" method="POST" >
        //                                             <input type="hidden" name="event_id" value="' . $data["event_id"] . '" />
        //                                             <input type="hidden" name="atc_count" value=1 />
        //                                             <button id="addcartbutton"type="submit">Add To Cart</button>
        //                                         </form>
        //                                     </td>
        //                                 </tr>
        //                         </table>
        //                 </aside>

        //             </section>
        //         </section>';
                
                echo $popup1;
                
    }
    
    
}
// if user clicks add to cart this will be evaluated 
else if(isset($_POST['add_to_cart'])) {
    
}
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
