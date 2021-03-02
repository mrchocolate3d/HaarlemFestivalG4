<?php
require APPROOT . '/views/includes/header.php';
 ?>

<!-- <section id="section-landing">
    <?php
        require APPROOT . '/views/includes/navigation.php';
    ?> 

    <section class="wrapper-landing">
        <h1>One man's crappy software</h1>
        <h2>is another man's full-time job.</h2>
    </section>
</section> -->

<main id="Dancehome">
    <img src="../../../public/img/festival.jpg">
    <section id="Dance-title">
            <h1>Haarlem Dance</h1>
            <p>
                The festival bringing you to the best dance acts from, both local and all around the world.performing at haarlem's very own 
                caprera openluchttheather, and other exciting theathers in haarlem, a enjoyable
                and fun event you dont wanna miss. 
            </p>
            <button class="transparent" href="#">Show More</button>
    </section>

    <section id="home-info-page">
            <section id="dance-info">
                <h3>Dance in Haarlem</h3>
                <p>
                    Haarlem is no stranger to dance with many localities and venues embracing it. 
                </p>
                <p>
                    the event's sheer size impressive lineups and unbeatable party atomosphere will make your experience in dance like never before. 
                </p>
            </section>

            <section id="theather-info">
                    <h3>Caprera openluchttheather</h3>
                    <p>
                        caprera openluchttheather prounanced as (caprera open air theather in English) is the most popular and amazing location to experience any kind of performances. 
                    </p>
                    <p>
                        Located between the dunes and forest, here you can enjoy all kinds of dance events experiencing the enchanting evening under the stars giving you unforgettable experieces
                    </p>
            </section>

            <section id="theather2">
                    <h3>XO the club</h3>
                    <p>
                        The second most popular club in the netherlands known for hosting incrediable performances 
                        and want to dance the night away then you should definiately go to this club.
                    </p>
                    <p>
                        the doors are open from 9pm at night to 4 am in the morning!
                    </p>
            </section>
    </section>
    <section id="table">
            <?php
                //$schedule = array("Friday-27th July"=>
                //array("LichtFabriek"=> array("artists"=>
                //array("Nicky Romero ID", "Afrojack ID"), "start"=>"20.00", 
                //"end"=>"02.00"), "Jopen Kerk"=>...), "Saturday-28th July"=>array
                //("LichtFabriek"=>..), "Sunday, 29th July"=>array("LichtFabriek"=>...);

                echo "<table>
                <tr><th>Venue</th>
                <th>Friday-27th July</th>
                <th>Saturday-28th July</th>
                <th>Sunday-29th July</th></tr>";

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "haarlemfestival";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }

                
                $event_results = $conn->query("SELECT * FROM Event WHERE cateagory='Dance'");

                if ($event_results->num_rows > 0) {
                    $dates = array("Friday-27th July", "Saturday-28th July", "Sunday-29th July");
                    $venues = array("LichtFabriek", "Jopen Kerk", "XO the Club", "Club Ruis", "Caprera openluchtheather", "Club Stalker");
                    $schedule = array();

                    foreach($dates as $dt) {
                        $schedule[$dt] = array();
                        foreach($venues as $ven) {
                            // if(array_key_exists($ven, $schedule[$dt])){
                            // }
                            $schedule[$dt][$ven] = "NO EVENTS";
                        }
                    }
                    while($row = $event_results->fetch_assoc()) {
                        $schedule[$row["date"]][$row["location_id"]] = $row["name"]."<br><pre>".$row["start_time"]." to ".$row["end_time"]."</pre>";
                    }
                echo "</table>";
                } else {
                echo "0 results";
                }
                $conn->close();
            ?>
    </section>
</main>


