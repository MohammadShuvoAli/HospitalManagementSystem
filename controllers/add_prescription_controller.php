<?php
include 'sanitize.php';
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $appointment_id = sanitize($_POST['appointment_id']);
    $patient_id = sanitize($_POST['patient_id']);
    $medicine_name = sanitize($_POST['medicine_name']);
    $dosage = sanitize($_POST['dosage']);
    $duration = sanitize($_POST['duration']);
    // Validate inputs
    $errors = array();
    if (empty($appointment_id)) {
        $errors[] = 'Select an Appointment';
    }
    if (empty($patient_id)) {
        $errors[] = 'Select a Patient';
    }
    if (empty($medicine_name)) {
        $errors[] = 'Medicine name is required';
    }
    if (empty($dosage)) {
        $errors[] = 'Dosage is required';
    }
    if (empty($duration)) {
        $errors[] = 'Duration is required';
    }

    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        try {
            addPrescription($doctor_id, $appointment_id, $patient_id, $medicine_name, $dosage, $duration);
        } catch (PDOException $e) {
            $message = 'Error adding Prescription: ' . $e->getMessage();
        }
    }
}

?>
