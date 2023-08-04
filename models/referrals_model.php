<?php
include 'config.php';
// Initialize variables
$patient_id = '';
$doctor_id = '';
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

// Get the list of doctor without current doctor
$stmt = $pdo->prepare('SELECT * FROM doctor WHERE doctor_id != :doctor_id');
$stmt->bindParam(':doctor_id', $doctor_id);
$stmt->execute();
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
function referPatient($doctor_id, $patient_id) {
    require 'config.php';
    $stmt = $pdo->prepare('UPDATE patient SET doctor_id = :doctor_id WHERE patient_id = :patient_id');
    $stmt->bindParam(':doctor_id', $doctor_id);
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->execute();
    $message = 'Patient Referred Successfully!';
    return $message;
}

?>