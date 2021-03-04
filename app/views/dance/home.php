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
               echo "<table>
               <tr><th>Venue</th>
               <th>Friday-27th July</th>
               <th>Saturday-28th July</th>
               <th>Sunday-29th July</th></tr>";

               $dancetable = new DanceModel();
               $schedule = $dancetable->getTimeTable();

               foreach($dancetable->$venues as $venue) {
                    echo '<tr>';
                    echo '<th>'.$venue.'</th>';
                    foreach($this->$dancetable->$dates as $dt) {
                        echo '<td>' . $schedule[$dt][$venue].'</td>';
                    }
                    echo '</tr>';
               }
        ?>
        </section>
    </section>
</main>
