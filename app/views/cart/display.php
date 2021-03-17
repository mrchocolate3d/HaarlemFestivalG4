<?php include APPROOT . '/views/includes/header.php'; ?>

<main>

    <?php
    if (isset($data['tickets']))
    {
        
        //print_r($data['tickets']);
        
    }
    echo '<pre>';
    print_r($_SESSION['cart']);
    echo '</pre>';
    ?>



</main>

<?php include APPROOT . '/views/includes/footer.php'; ?>