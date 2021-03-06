<?php include APPROOT . '/views/includes/header.php'; ?>

<main>
    <section class="title-screen">
       
        <section id="dance-title">
                <h1>Haarlem Dance</h1>
                <h2>
                    The festival bringing you to the best dance acts from, both local and all around the world.performing at haarlem's very own 
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

               $dancetable = new DanceModel();
               $schedule = $dancetable->getTimeTable();
               $dates =  array("Friday-27th July", "Saturday-28th July", "Sunday-29th July");
               $venues = array("Lichtfabriek", "Jopenkerk", "XO the Club", "Club Ruis", "Caprera Openluchttheater", "Club Stalker");

               foreach($venues as $venue) {
                    $table.= '<tr>';
                    $table.= '<th>'.$venue.'</th>';
                    foreach($dates as $dt) {
                        //$table.=' <td>'.$schedule[$dt][$venue].'</td>';

                        $table .= '<td class="popup" onClick=>
                                <button id="myBtn"> <input type="hidden" value="'.$schedule[$dt][$venue]["id"].'" name="id"/>'.$schedule[$dt][$venue]["text"].'</button></td>';
                                        
                    }
                    $table.= '</tr>';
               }

               $table.= '</table>';
               echo $table;
        ?>
            <section id="myModal" class="modal">
            <!-- Modal content -->
            <section class="modal-content">
            <span class="close">&times;</span>
            <p>Some text in the Modal..</p>
            </section>
        <script>
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal 
            btn.onclick = function() {
            modal.style.display = "block";
            // fetchartistData and echo it.
              <?php 
              $dancetable = new DanceModel();
              $schedule = $dancetable->getArtist();
              echo $schedule;
              ?>
                var event_id = this.firstElementChild.value;
                jQuery.ajax({
                    type: "POST",
                    url: 'DanceModel.php',
                    dataType: 'json',
                    data: {functionname: 'getArtist', arguments: [event_id]},

                    success: function (obj, textstatus) {
                                if( !('error' in obj) ) {
                                    yourVariable = obj.result;
                                }
                                else {
                                    console.log(obj.error);
                                }
                            }
                });

                function displayArtist(event_id) {
                        window.open(
                            "artist.php?event_id="+encodeURI(event_id);
                        )
                }
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
            /*
                https://stackoverflow.com/questions/36676552/add-onclick-event-on-a-php-generated-table-cell

                follow answer from this link first answer such that the redirect URL is home.php with parameter 
                event_id, on top of the home.php if home.php has a parameter display popup for given artist else
                dont display.  
            */
        </script>
        </section>
    </section>
</main>

