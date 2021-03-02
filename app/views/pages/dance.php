<?php include APPROOT . '/views/includes/header.php'; ?>

<main>
    <section class="title-screen">
        <?php require APPROOT . 'views/includes/navigation.php'?>
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

                    <img src="img/placeholder.png" alt="Haarlem festival dance stage">
                    <p>
                        Haarlem is no stranger to dance with many localities and venues embracing it.
                        the event's sheer size impressive lineups and unbeatable party atomosphere will make your experience in dance like never before. 
                    </p>

                    <img src="img/placeholder.png" alt="Caprera openluchtheather">
                    <p>
                    caprera openluchttheather prounanced as (caprera open air theather in English) is the most popular and amazing location to experience any kind of performances.
                    
                    Located between the dunes and forest, here you can enjoy all kinds of dance events experiencing the enchanting evening under the stars giving you unforgettable experieces
                    </p>

                    <img src="img/placeholder.png" alt="XO the club">
                    <p>
                        The second most popular club in the netherlands known for hosting incrediable performances 
                        and want to dance the night away then you should definiately go to this club.

                        the doors are open from 9pm at night to 4 am in the morning!
                    </p>

                    <a href="#dance-timetable-page" class="button transparent">See What's On</a>
            </section>

            <aside id="dance-artists">
                <img src="../img/placeholder.png" alt="artist1">
                <img src="../img/placeholder.png" alt="artist2">
                <img src="../img/placeholder.png" alt="artist3">
            </aside>

    </section>

    <section id="dance-timetable-page">
        <section class="timetable card" id="dance-timetable">
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
    </section>
</main>

<?php include APPROOT . '/views/includes/footer.php'; ?>
