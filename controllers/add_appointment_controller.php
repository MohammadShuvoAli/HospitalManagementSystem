<?php
include 'sanitize.php';
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $patient_id = sanitize($_POST['patient_id']);
    $appointment_date = sanitize($_POST['appointment_date']);
    $appointment_time = sanitize($_POST['appointment_time']);
    $appointment_status = sanitize($_POST['appointment_status']);
    // Validate inputs
    $errors = array();
    if (empty($patient_id)) {
        $errors[] = 'Select a patient';
    }
    if (empty($appointment_date)) {
        $errors[] = 'Appointment Date is required';
    }
    if (empty($appointment_time)) {
        $errors[] = 'Appointment Time is required';
    }
    if (empty($appointment_status)) {
        $errors[] = 'Appointment status is required';
    }
    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        try {
            addAppointment($appointment_id, $patient_id, $doctor_id, $appointment_date, $appointment_time, $appointment_status);
        } catch (PDOException $e) {
            echo 'Error adding Appointment: ' . $e->getMessage();
        }
    }
}
?>