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
    <a href="<?php echo URLROOT . '/cart/clear' ?>" class="button"><i class="bi bi-trash"></i>Clear Cart</a>

</main>

<?php include APPROOT . '/views/includes/footer.php'; ?>