<?php
include 'sanitize.php';

if (isset($_POST['update'])) {
  // Get form data and sanitize
  $test_result_id = sanitize($_POST['test_result_id']);
  $patient_id = sanitize($_POST['patient_id']);
  $test_name = sanitize($_POST['test_name']);
  $test_date = sanitize($_POST['test_date']);

  // Update patient details in database
  $result = update_test_result($pdo, $test_result_id, $patient_id, $test_name, $test_date);

  if ($result) {
    // Redirect to test_results page
    header('Location: test_results.php');
    exit();
  } else {
    echo "Error updating test result.";
  }
}

if (isset($_POST['delete'])) {
  // Get the test_result_id from the form and sanitize
  $test_result_id = sanitize($_POST['test_result_id']);

  // Delete the test result from the database
  $result = delete_test_result($pdo, $test_result_id);

  if ($result) {
    // Redirect back to the test result list page
    header('Location: test_results.php');
    exit();
  } else {
    // Display an error message
    echo "Error deleting test result.";
  }
}

if (!isset($_GET['test_result_id'])) {
  // If test_result ID is not set, redirect to test_result page
  header('Location: test_results.php');
  exit();
}

$test_result_id = sanitize($_GET['test_result_id']);

// Retrieve test result details from database
$test_results = get_test_result($pdo, $test_result_id);

// Close database connection
$pdo = null;

?>
