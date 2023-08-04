<?php
include 'sanitize.php';

// Check if form is submitted
if (isset($_POST['update'])) {
    // Get form data
    $appointment_id = sanitize($_POST['appointment_id']);
    $patient_id = sanitize($_POST['patient_id']);
    $doctor_id = sanitize($_POST['doctor_id']);
    $appointment_date = sanitize($_POST['appointment_date']);
    $appointment_time = sanitize($_POST['appointment_time']);
    $appointment_status = sanitize($_POST['appointment_status']);

    updateAppointment($pdo, $appointment_id, $patient_id, $doctor_id, $appointment_date, $appointment_time);
    
    // Redirect to patient records page
    header('Location: appointments.php');
    exit();
}
if (isset($_POST['cancel'])) {
    // Get form data
    $appointment_id = sanitize($_POST['appointment_id']);
    $appointment_status = 'Cancelled';
    // Update appointment details in database
    cancelAppointment($pdo, $appointment_id, $appointment_status);
    // Redirect to patient records page
    header('Location: appointments.php');
    exit();
}
if (isset($_POST['complete'])) {
    // Get form data
    $appointment_id = sanitize($_POST['appointment_id']);
    // Update appointment details in database
    completeAppointmentStatus($pdo, $appointment_id);
    // Redirect to patient records page
    header('Location: appointments.php');
    exit();
}
if (isset($_POST['delete'])) {
    // Get the appointment id from the form
    $appointment_id = sanitize($_POST['appointment_id']);
    deleteAppointment($pdo, $appointment_id);

}
if (!isset($_GET['appointment_id'])) {
    // If appointment id is not set, redirect to appointments page
    header('Location: appointments.php');
    exit();
}
// Retrieve patient details from database
$stmt = $pdo->prepare("SELECT * FROM appointment WHERE appointment_id = :appointment_id");
$stmt->bindParam(':appointment_id', $_GET['appointment_id']);
$stmt->execute();
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

// Close database connection
$pdo = null;
?>