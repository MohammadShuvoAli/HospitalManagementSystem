<?php
include 'sanitize.php';
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $patient_id = sanitize($_POST['patient_id']);
    $report_date = sanitize($_POST['report_date']);
    $report_details = sanitize($_POST['report_details']);

    // Validate inputs
    $errors = array();
    if (empty($patient_id)) {
        $errors[] = 'Select a Patient';
    }
    if (empty($report_date)) {
        $errors[] = 'Report date is required';
    }
    if (empty($report_details)) {
        $errors[] = 'Report details is required';
    }
    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        try {
            addMedicalReport($patient_id, $report_date, $report_details);
        } catch (PDOException $e) {
            $message = 'Error adding Report: ' . $e->getMessage();
        }
    }
}

?>