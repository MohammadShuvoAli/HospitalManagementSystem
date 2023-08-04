<?php
include 'sanitize.php';
// Check if user is already logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['role'])) {
    // Redirect to dashboard based on role
    if ($_SESSION['role'] == 'admin') {
        header('Location: admin_dashboard.php');
        exit();
    } else if ($_SESSION['role'] == 'doctor') {
        header('Location: doctor_dashboard.php');
        exit();
    } else if ($_SESSION['role'] == 'receptionist') {
        header('Location: receptionist_dashboard.php');
        exit();
    }
}
if (isset($_POST['submit'])) {
    require_once '../models/config.php';
    // Sanitize input
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    // Check username and password against database
    $query = "SELECT * FROM User WHERE username=:username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch();

    if ($row && $password == $row['password']) {
        // Set session variables
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        // Set cookie if remember me is checked
        if (isset($_POST['remember_me'])) {
            setcookie('username', $row['username'], time() + (86400 * 30), "/"); // Cookie lasts for 30 days
            setcookie('password', $row['password'], time() + (86400 * 30), "/"); // Cookie lasts for 30 days
        }
        // Redirect to dashboard
        if ($row['role'] == 'admin') {
            header('Location: admin_dashboard.php');
            exit();
        } else if ($row['role'] == 'doctor') {
            header('Location: doctor_dashboard.php');
            exit();
        } else if ($row['role'] == 'receptionist') {
            header('Location: receptionist_dashboard.php');
            exit();
        } else {
            $error_msg = "Unknown user role";
        }
    } else {
        $error_msg = "Incorrect username or password";
    }
}

if (empty($_POST['username']) && empty($_POST['password']) && isset($_POST['submit'])) {
    $error_msg = "Please fill in both username and password fields";
} else if (empty($_POST['username']) && isset($_POST['submit'])) {
    $error_msg = "Please fill in the username field";
} else if (empty($_POST['password']) && isset($_POST['submit'])) {
    $error_msg = "Please fill in the password field";
}

if (isset($error_msg)) {
    $_SESSION['error_msg'] = $error_msg;
}
?>