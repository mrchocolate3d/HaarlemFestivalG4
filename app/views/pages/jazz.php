<?php include APPROOT . '/views/includes/header.php'; ?>

<main id="home">
    <?php //var_dump($data); 
    ?>

    <section class="title-screen">
        <section id="jazz-title">
            <h1>Haarlem Festival Jazz</h1>
            <h2>The Haarlem Festival brings you the best jazz acts, both local and from around the world.
                Performing in Haarlem's very own Patronaat as well as the Grote Markt, this is an event you won't want to miss!</h2>
            <a href="#jazz-info-page" class="button transparent">Show more</a>
        </section>

    </section>

    <section id="jazz-info-page">
        <section id="jazz-info" class="card">

            <img src="img/placeholder.png" alt="Haarlem festival jazz stage">
            <p>
                Haarlem has a rich history dating back to pre-medieval times. It is also one
                of the most exciting and fun cities in the Netherlands featuring many museums,
                art galleries, café shops, restaurants, and various other exciting things.
            </p>

            <img src="img/placeholder.png" alt="Patronaat">
            <p>
                Patronaat is one of the top 10 music venues in the Netherlands.
                The Haarlemsezaal has existed since 1984 and nowadays presents a distinctive program of bands and electronic music.
                It is located at the Zijlsingel in Haarlem, near the city centre.

                In 2003 the old building was replaced with a brand new concert hall, which was used for the first time in 2005.
            </p>
            <img src="img/placeholder.png" alt="Grote Markt">
            <p>
                The Grote Markt is the central market square of Haarlem.
                With the Grote of St.-Bavokerk towering over it make a fitting venue for the final day of the Jazz celebrations.
                During this final day a select few acts will take to the stage and perform in Haarlems main square for everyone. Free of charge!
            </p>

            <a href="#jazz-timetable-page" class="button transparent">See What's On</a>

        </section>

        <aside id="jazz-artists">
            <img src="../img/placeholder.png" alt="Dance Image">
            <img src="../img/placeholder.png" alt="History Image">
            <img src="../img/placeholder.png" alt="Jazz Image">
        </aside>

    </section>

    <section id=jazz-timetable-page>
        <section class="timetable card" id="jazz-timetable">
            <p>This is the jazz timetable</p>
        </section>
    </section>

</main>


<?php include APPROOT . '/views/includes/footer.php'; ?>