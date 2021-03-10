<?php

?>

<head>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style.css">
</head>

<main role ="main">
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>
    <section class="history-tickets-container">
        <section class="history-tickets-calender">
            <section class="history-calender-days">
                <ul id="history-calendar-days-lbl">
                    <li>Thursday</li>
                    <li>Friday</li>
                    <li>Saturday</li>
                    <li>Sunday</li>
                </ul>
            </section>

            <aside class="history-calender-timestamps">

            </aside>

        </section>
    </section>
</main>