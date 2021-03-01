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

    <section class="main-container">
        <aside class="info-container">
            <h2>Haarlem History</h2>
            <p>Haarlem history gives you a unique experience of Haarlem,
                it is something you do not want to miss.
                Join one of our tours on Thursday, Friday, Saturday
                or Sunday.</p>
            <button type="button">Join us</button>
        </aside>
    </section>

    <section class="detail-container">
        <section class="info-container">
            <h2>Tour Information</h2>
            <p>Our tours are for anyone to enjoy, it is especially a way for some quality family time.
                It is available in Chinese, Dutch and English on Thursday, Friday, Saturday and Sunday.</p>
            <p>All our tours start at the location "De Grote of St.-Bavokerk", the guides will make sure you're experiencing the best of Haarlem.
            </p>
            <p>We only have 12 seats per tour so make sure you book your tickets on time.
            </p>
            <p>Standard tickets: 17,50 euros
                <br>Family tickets for groups of four: 60,00 euros. </p>

            <button type="button">Order tickets</button>

        </section>
        <aside>
            <button onclick="showPopUp()" id = popup>Show locations</button>
        </aside>


    </section>
</main>

<script>
    //popup
    function showPopUp(){
        var btn = confirm("Pick");
        var a;
        if(btn == true){
            a = "true";
        }
        else{
            a ="false";
        }
        document.getElementById("popup").innerHTML = x;
    }
</script>