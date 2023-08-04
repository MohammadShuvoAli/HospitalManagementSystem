<?php
include 'sanitize.php';
$user_id = sanitize($_SESSION['user_id']);

$doctor_id = getDoctorId($user_id);

if (!$doctor_id) {
    header('Location: login.php');
    exit();
}

$total_patients = getTotalPatients($doctor_id);
$total_appointments = getTotalAppointments($doctor_id);
$pending_appointments = getPendingAppointments($doctor_id);
$total_doctors = getTotalDoctors();
?>
