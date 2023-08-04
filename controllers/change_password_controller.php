<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include 'sanitize.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify current password
    $current_password = sanitize($_POST['current_password']);
    $currentPassword = getPasswordByUsername($_SESSION['username']);
    if ($current_password === $currentPassword) {
        // Verify new and confirm passwords match
        $new_password = sanitize($_POST['new_password']);
        $confirm_password = sanitize($_POST['confirm_password']);
        if ($new_password === $confirm_password) {
            // Verify password strength
            $password_regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
            if (preg_match($password_regex, $new_password)) {
                // Update user's password in database
                updatePasswordByUsername($_SESSION['username'], $new_password);
                $message = 'Password Changed Successfully!';
            } else {
                $message = '<b> Password must contain at least 
                <br> one uppercase & lowercase letter, 
                <br> one number, one special character
                <br> and be at least 8 characters long </b>';
            }
        } else {
            $message = 'New password and confirm password do not match';
        }
    } else {
        if (empty($current_password)) {
            $message = 'Enter Current password.';
        } else {
            $message = 'Current password is incorrect';
        }

    }
}
?>