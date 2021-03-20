<?php include APPROOT . '/views/includes/header.php'; ?>

<main class='container'>
    <pre>

        <?php
        if (isset($data['tickets'])) {

            var_dump($data['tickets']);

        }
        ?>

    </pre>


</main>

<?php include APPROOT . '/views/includes/footer.php'; ?>