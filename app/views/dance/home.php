<?php require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navigation.php'; ?>

<?php
     if(isset($data['artist_data'])) {
        include APPROOT . '/views/dance/dancepopup.php';
     }
     else if(isset($data['status']) && !empty(trim($data['status']))) {
        echo '<script>alert("'.$data['status'].'")</script>';
    }
?>
<!--The main static page for spotlighting artists and dance venues-->
<main>
    <section class="title-screen container-fluid" style="padding-left: 0;">
       
        <section id="dance-title" class="content">
                <h1 class="text-center">Haarlem Dance</h1>
                <p style="font-size: 20px; width: 60%; margin: auto;" class="text-center">
                    The festival bringing you to the best dance acts from, both local and all around the world, performing at haarlem's very own 
                    caprera openluchttheather, and other exciting theathers in haarlem, a enjoyable
                    and fun event you dont wanna miss. 
                </p>
                <br>
                <section class="text-center">
                    <a href="#dance-info-page" style="opacity: 0.7; border-radius: 0; background: grey; color: white;" class="btn btn-light btn-sm">SHOW MORE</a>
                </section>
        </section>
    </section>

    <section class="dance-info-class" id="dance-info-page">
            <section class="row">
                <section class="col-sm-8 d-flex flex-lg-column align-content-stretch mb-3" style="border: 4px solid #B204FF; padding-top: 10px; padding-bottom: 20px; background-color: #F6F6F6; padding-left: 2%; padding-right: 4%; height: 900px;">

                        <section class="row p-2">
                                <section class="col-sm-4">
                                        <img src="../img/dance_in_haarlem.png" alt="Haarlem festival dance stage" class="dance-title-image">
                                </section>

                                <section class="col-sm-8">
                                    <h2 class="dance-title">Dance In Haarlem</h2>
                                    <p class="dance-title">
                                        Haarlem is no stranger to dance with many localities and venues embracing it.
                                    </p>

                                    <p class="dance-title">
                                        The event's sheer size impressive lineups and unbeatable party atomosphere will make your experience in dance like never before. 
                                    </p>
                                </section>
                        </section>

                        <section class="row p-2">
                                <section class="col-sm-8">
                                        <h2 class="dance-title">Caprera Openluchttheather</h2>
                                        <p class="dance-title">
                                                Caprera openluchttheather prounanced as (caprera open air theather in English) is the most popular and amazing location to experience any kind of performances.
                                        </p>
                                        <p class="dance-title">
                                                Located between the dunes and forest, here you can enjoy all kinds of dance events experiencing the enchanting evening under the stars giving you unforgettable experieces
                                        </p>
                                </section>

                                <section class="col-sm-4">
                                        <img src="../img/caprera.png" alt="Caprera openluchtheather" id="caprera-image" class="dance-title-image"> 
                                </section>
                        </section>

                        <section class="row p-2">
                                <section class="col-sm-4">
                                        <img src="../img/xotheclub.png" alt="XO the club" id="xothclub-image" class="dance-title-image">
                                </section>

                                <section class="col-sm-8">
                                <h2 class="dance-title">XO the club</h2>
                                    <p class="dance-title">
                                        The second most popular club in the netherlands known for hosting incrediable performances 
                                        and want to dance the night away then you should definiately go to this club.
                                        <br>
                                        <br>
                                        the doors are open from 9pm at night to 4 am in the morning!
                                    </p>
                                        <br>
                                        
                                    <section class="text-center">
                                        <a href="#dance-timetable-page" class="dance-button" >See What's On</a>
                                    </section>
                                </section>
                        </section>
                </section>

                <section class="col-sm-4 d-flex flex-lg-column align-content-stretch mb-3 dance-title" style="padding-left: 60px;">
                        <section class="row" style="border: 3px solid #FE8115; margin-top: 10px; height: 150px; width: 368.11px;">
                            <section class="col-sm-12 text-center">
                                <img src="../img/vip all access.png" alt="vip ticket">
                            </section>
                        </section>

                        <section class="row">
                                <section class="col-sm-12" style="padding-top: 5px;">
                                    <h1 class="dance-title">Spotlight</h1>
                                </section>
                        </section>

                        <section class="row" style="border: 3px solid #FE8115; margin-top: 20px; height: 150px;">
                                <section class="col-sm-6">
                                    <img src="../img/martin_garrix.png" alt="artist1">
                                </section>

                                <section class="col-sm-6 text-center dance-parent">
                                    <h4 id="image-header" class="dance-child" style="width: 100%;">Martin Garrix</h4>
                                </section>
                        </section>

                        <section class="row" style="border: 3px solid #FE8115; margin-top: 20px; height: 150px;">
                            <section class="col-sm-6">
                                <img src="../img/hardwell.png" alt="artist2">
                            </section>

                            <section class="col-sm-6 text-center dance-parent">
                                <h4 id="image-header" class="dance-child" style="width: 100%;">Hardwell</h4>
                            </section>
                        </section>

                        <section class="row" style="border: 3px solid #FE8115; margin-top: 20px; height: 150px;">
                                <section class="col-sm-5">
                                        <img src="../img/armin_van_buuren.png" alt="artist3">
                                </section>

                                <section class="col-sm-7 text-center dance-parent">
                                        <h4 id="image-header" class="dance-child">Armin van Buuren</h4>
                                </section>
                        </section>

                        <section class="row" style="border: 3px solid #FE8115; margin-top: 20px; height: 151px;">
                                <section class="col-sm-5">
                                        <img src="../img/tiesto.png" alt="artist4">
                                </section>

                                <section class="col-sm-7 text-center dance-parent">
                                    <h4 id="image-header" class="dance-child" style="width: 100%;">Tiesto</h4>
                                </section>
                        </section>
                </section>
                

            </section>


    </section>

    <!--The table page rendering it down with html and php-->
    <section id="dance-timetable-page">
        <section class="timetable card" id="dance-timetable">
        <?php
                
            $table = '<table border = 1 class="text-center">
                    <tr><th>Venue</th>
                    <th>Friday-27th July</th>
                    <th>Saturday-28th July</th>
                    <th>Sunday-29th July</th></tr>';
               foreach($data['venues'] as $venue) {
                    $table.= '<tr>';
                    $table.= '<th id="table-venue">'.$venue.'</th>';
                    foreach($data['dates'] as $dt) {
                        $table .= '<td id="table-content" class="popup">';
                            $emptystring = "";
                            '<tr>'.$emptystring.'</tr>';
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
               echo "Click on the event you want to select!";
        ?>

        <script>
	// Getting the modal
	var modal = document.getElementById("Modal");

	// using  the <span> element which will close the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on the button, open the modal
	var display_popup = function() {
	  modal.style.display = "block";
	}

	// When the user clicks on <span> which is (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal popup then close the modal popup
	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
</script>
        <script>
            // dropdown ticket count on change
            var finalPrice = document.getElementsByName("total-price")[0]; // return elements array

            var ticket_Count = document.getElementById("modal-event-ticket-count"); 
            var total = document.getElementById("total");
            var checkoutTotal = document.getElementById("checkoutTotal");
            var price = document.getElementById("modal-ticket-price");
            var add_to_cart = document.getElementsByName("quantity")[0];
            ticket_Count.addEventListener("change", function() {
                finalPrice.value = (parseInt(ticket_Count.value) * parseFloat((price.innerHTML).slice(1)));
                total.innerHTML = '€' + finalPrice.value;
                checkoutTotal.innerHTML = '€' + finalPrice.value;
                add_to_cart.value = ticket_Count.value;
            });
        </script>
        </section>
    </section>
</main>
<?php
    if(isset($data['artist_data'])) {
        $event_details = $data["artist_data"];

        if (is_array($event_details)) {
            echo "<script type='text/javascript'> window.onload=display_popup; </script>";
        }
    }
?>