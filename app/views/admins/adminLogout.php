<?php
session_start();
unset($_SESSION['userID']);
unset($_SESSION['email']);
header('location:' . URLROOT . '/admins/loginAdmin');
?>