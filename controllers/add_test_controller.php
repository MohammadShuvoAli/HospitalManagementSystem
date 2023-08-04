<?php
include 'sanitize.php';
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $patient_id = sanitize($_POST['patient_id']);
    $test_name = sanitize($_POST['test_name']);
    $test_date = sanitize($_POST['test_date']);
    // Validate inputs
    $errors = array();
    if (empty($patient_id)) {
        $errors[] = 'Select a patient';
    }
    if (empty($test_name)) {
        $errors[] = 'Test Name is required';
    }
    if (empty($test_date)) {
        $errors[] = 'Test Date is required';
    }
    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        try {
            addTestResult($patient_id, $test_name, $test_date);
        } catch (PDOException $e) {
            $message = 'Error adding Test for patient: ' . $e->getMessage();
        }
    }
}
?>