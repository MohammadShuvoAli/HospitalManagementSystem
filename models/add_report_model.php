<?php
require 'config.php';
// Initialize variables
$patient_id = '';
$report_date = '';
$report_details = '';

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
$stmt = $pdo->prepare('SELECT DISTINCT Patient.patient_id, Patient.first_name, Patient.last_name
FROM Patient
INNER JOIN Prescription ON Prescription.patient_id = Patient.patient_id
WHERE Patient.doctor_id = :doctor_id');
$stmt->bindParam(':doctor_id', $doctor_id);
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

function addMedicalReport($patient_id, $report_date, $report_details) {
    require 'config.php';
    $stmt = $pdo->prepare('INSERT INTO medical_reports (patient_id, report_date, report_details) 
            VALUES (:patient_id, :report_date, :report_details)');
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->bindParam(':report_date', $report_date);
    $stmt->bindParam(':report_details', $report_details);
    $stmt->execute();
    //$message = 'Report added successfully';
    // Redirect to a different page to prevent the form from being submitted again
    header('Location: medical_reports.php');
    exit();
}
?>