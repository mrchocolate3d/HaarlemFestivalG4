<!DOCTYPE html>
<html lang="en">


<head class="container-fluid">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/style.css" ?>">

</head>

<?php
// $_SESSION['user_id'] = 'test_user_id';
?>

<body>

    <nav class="nav">
        <a class="btn-login" href="<?php echo URLROOT; ?>/app/index.php">
            <?php echo isset($_SESSION['user_id']) ?  "Log out" :  "Log In" ?>
        </a>
    </nav>