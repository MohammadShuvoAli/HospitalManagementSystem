<?php
session_start(); // Start session

// Unset session variables
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['role']);

// Destroy session
session_destroy();

// Destroy remember me cookies
setcookie('username', '', time() - 3600, '/');
setcookie('password', '', time() - 3600, '/');

// Redirect to login page
header('Location: ../index.php');
exit();
?>
