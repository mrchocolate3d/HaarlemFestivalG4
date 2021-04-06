<?php
require APPROOT . '/views/includes/header.php';
        require APPROOT . '/views/includes/navigation.php';


$event_details = $data["artist_data"];
if (is_array($event_details)) {

    $price = $event_details["price"];
    $vat = 0.21 * $price;
    $subtotal = $price - $vat;
    $totalprice = $price;
    $popup1 = '<section id="Modal" class="modal">
                <section class="modal-content">
                        <section class="row">
                            <span class="close" style="float: right;">&times;</span>
                                <section class="col-sm-8" style="border: #F07913 3px solid;">
                                        <section class="row">
                                                <section class="col-sm-12">
                                                        
                                                        <section class="row">
                                                                <section class="col-sm-4">
                                                                        <section class="row">
                                                                              <section class="col-sm-12">
                                                                                    <img id="modal-artist-image" src="' . $event_details["image"] . '" alt="artist image">
                                                                              </section>
                                                                        </section>

                                                                        <section class="row">
                                                                                <section class="col">
                                                                                        <a class="dance-social-media" href="' . $event_details["facebook"] . '"> <i class="fab fa-facebook-square" style="font-size:36px; color: black;"></i> </a>
                                                                                        <a class="dance-social-media" href="' . $event_details["instagram"] . '"> <i class="fab fa-instagram" style="font-size:36px; color: black;"></i></a>
                                                                                        <a class="dance-social-media" href="' . $event_details["twitter"] . '"> <i class="fab fa-twitter-square" style="font-size:36px; color: black;"></i> </a>
                                                                                </section>
                                                                                
                                                                        </section>
                                                                </section>

                                                                <section class="col-sm-8">
                                                                        <h2 class="dance-title" id="modal-artist-title">' . $event_details["name"] . '</h2>

                                                                        <p id="modal-artist-description">' . $event_details["description"] . '</p>
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
                                                                        <p>' . $event_details["name"] . '</p>
                                                                </section>
                                                                
                                                                <section class="col-sm-4">
                                                                        <p id="modal-ticket-price" class="text-center">€' . $price . '</p>
                                                                        
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
                                                                        <p>' . $event_details["time_place"] . '</p>
                                                                </section>
                                                        </section>

                                                        <section class="row">
                                                                <section class="col-sm-6">
                                                                        <form action="' . URLROOT . '/cart/daypass" method="POST" >
                                                                                <input type="hidden" name="event_id" value="dance_1_day_pass" />
                                                                                <button type="submit"><img src="" alt="Party All Night - Full Day Pass @150"></button>
                                                                        </form>
                                                                </section>

                                                                <section class="col-sm-6">
                                                                        <form action="' . URLROOT . '/cart/multipass" method="POST" >
                                                                                <input type="hidden" name="event_id" value="dance_3_days_pass" />
                                                                                <button type="submit"><img src="" alt="Dance Freak - 3 Days Pass @250"></button>
                                                                        </form>
                                                                </section>
                                                        </section>
                                                </section>
                                        </section>
                                </section>

                                <section class="col-sm-4" style="border: #F07913 3px solid;">
                                <section class="row" style="height: 60%;">
                                        <h2 class="dance-title text-center" style="width: 100%; height: 80%;">Total</h2>

                                        <h3 id="checkoutTotal" class="dance-title text-center" style="width: 100%; height: 20%;">€' . $totalprice . '</h3>

                                </section>
                                        <section class="row dance-title" style="height: 38%; border-top: #F07913 3px dashed; margin-top: 1%;">
                                        <section class="col-sm-12">
                                        <section class="row" style="width: 100%; margin-top: 1%">
                                                <section class="col-sm-6">
                                                        <p>Subtotal</p>
                                                </section>

                                                <section class="col-sm-6 text-right">
                                                        <p>€' . $subtotal . '</p>
                                                </section>
                                        </section>

                                        <section class="row" style="width: 100%">
                                                <section class="col-sm-6">
                                                        <p>Vat @21%:</p>
                                                </section>

                                                <section class="col-sm-6 text-right">
                                                        <p>€' . $vat . '</p>
                                                </section>
                                        </section>

                                        <section class="row" style="width: 100%;">
                                                <section class="col-sm-6">
                                                        <p>Total:</p>
                                                </section>

                                                <section class="col-sm-6 text-right">
                                                        <p id="total">€' . $price . '</p>
                                                </section>
                                        </section>

                                        <section class="row" style="width: 100%">
                                                <section class="col-sm-6">
                                                        <form action="' . URLROOT . '/dance/add_to_cart" method="POST" >
                                                                <input type="hidden" name="event_id" value="' . $data["event_id"] . '" />
                                                                <input type="hidden" name="atc_count" value=1 />
                                                                <input type="hidden" name="total-price" value=' . $price . ' />
                                                                <input type="hidden" name="name" value=' . $event_details["name"] . '/>
                                                                <input type="hidden" name="location" value=' . $event_details["time_place"] . '/>
                                                                <button id="addcartbutton" class="dance-button" type="submit" style="height: 80%; width: 80%; margin: auto;">Add To Cart</button>
                                                        </form>
                                                </section>

                                                <section class="col-sm-6 text-right">
                                                        <form action="' . URLROOT . '/cart/checkout" method="POST" >
                                                        <input type="hidden" name="event_id" value="' . $data["event_id"] . '" />
                                                        <input type="hidden" name="checkout_count" value=1 />
                                                        <button id="checkoutbutton" class="dance-button" type="submit" style="height: 80%; width: 80%; margin: auto;">Checkout</button>
                                                </form>
                                                </section>
                                        </section>
                                </section>

                                        
                                                <section class="col-sm-12">
                                                        <h2 id="total" style="float: right; "></h2>
                                                        
                                                </section>
                                        </section>
                                </section>
                        </section>
                </section>
                </section>';


    echo $popup1;


}
?>

<style>
    /* The Modal (background) */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 50%;
        top: 50%;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);

    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        width: 80%;
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
