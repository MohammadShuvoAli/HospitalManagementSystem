<?php
include 'sanitize.php';
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $patient_id = sanitize($_POST['patient_id']);
    $doctor_id = sanitize($_POST['doctor_id']);

    // Validate inputs
    $errors = array();
    if (empty($patient_id)) {
        $errors[] = 'Select a patient';
    }
    if (empty($doctor_id)) {
        $errors[] = 'Select a doctor';
    }
    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        try {
            referPatient($doctor_id, $patient_id);
        } catch (PDOException $e) {
            $message = 'Error referring patient: ' . $e->getMessage();
        }
    }
}

?>