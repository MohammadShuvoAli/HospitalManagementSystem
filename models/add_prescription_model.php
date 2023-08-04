<?php
require 'config.php';
// Initialize variables
$appointment_id = '';
$patient_id = '';
$medicine_name = '';
$dosage = '';
$duration = '';

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
$stmt = $pdo->prepare('SELECT patient.patient_id, patient.first_name, patient.last_name
FROM patient
JOIN (
  SELECT patient_id
  FROM appointment
  WHERE doctor_id = :doctor_id AND appointment_status = "Completed" AND appointment_id NOT IN (
  SELECT appointment_id FROM prescription
  )
) appointment ON patient.patient_id = appointment.patient_id');
$stmt->bindParam(':doctor_id', $doctor_id);
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the list of appointment for the doctor
$stmt = $pdo->prepare('SELECT * FROM appointment WHERE doctor_id = :doctor_id AND appointment_status = "Completed" AND appointment_id NOT IN (SELECT appointment_id FROM prescription)');
$stmt->bindParam(':doctor_id', $doctor_id);
$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
function addPrescription($doctor_id, $appointment_id, $patient_id, $medicine_name, $dosage, $duration) {
    require 'config.php';
    $stmt = $pdo->prepare('INSERT INTO prescription (doctor_id, appointment_id, patient_id, medicine_name, dosage, duration) 
            VALUES (:doctor_id, :appointment_id, :patient_id, :medicine_name, :dosage, :duration)');
    $stmt->bindParam(':doctor_id', $doctor_id);
    $stmt->bindParam(':appointment_id', $appointment_id);
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->bindParam(':medicine_name', $medicine_name);
    $stmt->bindParam(':dosage', $dosage);
    $stmt->bindParam(':duration', $duration);
    $stmt->execute();

    // Redirect to a different page to prevent the form from being submitted again
    header('Location: prescriptions.php');
    exit();
}
?>