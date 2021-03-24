<?php include APPROOT . '/views/includes/header.php'; ?>
<?php include APPROOT . '/views/includes/navigation.php'; ?>

<main class='container'>
    <pre>

        <?php
        if (isset($data['tickets']) || true) {
            var_dump($data['tickets']);
        } else {
            echo "Shopping card is empty";
        }
        ?>

    </pre>


</main>

<?php include APPROOT . '/views/includes/footer.php'; ?>