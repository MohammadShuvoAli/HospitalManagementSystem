<?php
session_start(); // Start session

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'doctor') {
    // If user is not logged in or not a doctor, redirect to login page
    header('Location: login.php');
    exit();
}
?>