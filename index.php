<?php
session_start();
if (!isset($_SESSION['loginbs'])) {
    header('location:login.php');
    exit();
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('location:login.php');
    exit();
}
?>

