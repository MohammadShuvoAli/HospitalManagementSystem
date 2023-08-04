<?php
require 'config.php';
// Initialize variables
$appointment_id = '';
$patient_id = '';
$appointment_date = '';
$appointment_time = '';
$appointment_status = 'Scheduled';

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Query the doctor table to get the doctor ID
$stmt = $pdo->prepare('SELECT doctor_id FROM doctor WHERE user_id = :user_id');
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$doctor = $stmt->fetch(PDO::FETCH_ASSOC);

// Get the doctor ID from the query result
$doctor_id = $doctor['doctor_id'];

// Get the list of patient for the doctor
$stmt = $pdo->prepare('SELECT * FROM patient WHERE doctor_id = :doctor_id');
$stmt->bindParam(':doctor_id', $doctor_id);
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the list of appointment for the doctor
$stmt = $pdo->prepare('SELECT * FROM appointment WHERE doctor_id = :doctor_id');
$stmt->bindParam(':doctor_id', $doctor_id);
$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

function addAppointment($appointment_id, $patient_id, $doctor_id, $appointment_date, $appointment_time, $appointment_status) {
    require 'config.php';
    $stmt = $pdo->prepare('INSERT INTO appointment (appointment_id, patient_id, doctor_id, appointment_date, appointment_time, appointment_status) 
    VALUES (:appointment_id, :patient_id, :doctor_id, :appointment_date, :appointment_time, :appointment_status)');
    $stmt->bindParam(':appointment_id', $appointment_id);
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->bindParam(':doctor_id', $doctor_id);
    $stmt->bindParam(':appointment_date', $appointment_date);
    $stmt->bindParam(':appointment_time', $appointment_time);
    $stmt->bindParam(':appointment_status', $appointment_status);
    $stmt->execute();

    header('Location: appointments.php');
    exit();
}

?>