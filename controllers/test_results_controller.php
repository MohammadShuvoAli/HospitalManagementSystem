<?php
// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Query the doctor table to get the doctor ID
$doctor = get_doctor_id($pdo, $user_id);

// If the doctor ID is not found, redirect to login page
if (!$doctor) {
  header('Location: login.php');
  exit();
}

// Get the doctor ID from the query result
$doctor_id = $doctor['doctor_id'];

// Retrieve test_result records from database and display
$test_results = get_test_results($pdo, $doctor_id);

// Close database connection
$pdo = null;
?>
