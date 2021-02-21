<!DOCTYPE html>
<html lang="en">


<head class="container-fluid">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Mb don't want to use Bootstrap -->
    <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/style.css" ?>">

</head>

<?php
// $_SESSION['user_id'] = 'test_user_id';
?>

<body>

    <nav id="navbar-hf">

        <ul>
            <li> <img src="" alt="Haarlem Festival Logo"> </li>
            <li> <a href="/pages/index">Home</a> </li>
            <li> <a href="/pages/jazz">Haarlem Jazz</a> </li>
            <li> <a href="/pages/history">Haarlem History</a> </li>
            <li> <a href="/pages/dance">Haarlem Dance</a> </li>
            <li> <a class="btn-login" href="<?php echo URLROOT; ?>/app/index.php"> <?php echo isset($_SESSION['user_id']) ?  "Log out" :  "Log In" ?> </a></li>
            <li> <a href="/cart/view"> <i class="bi bi-basket3-fill"></i></a></li>
        </ul>
    </nav>