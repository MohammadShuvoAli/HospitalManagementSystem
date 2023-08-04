<?php
require 'config.php';
// Initialize variables
$patient_id = '';
$test_name = '';

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
$stmt = $pdo->prepare('SELECT test_results.patient_id, test_results.test_name
FROM test_results, patient
WHERE test_results.patient_id=patient.patient_id
AND patient.doctor_id = :doctor_id');
$stmt->bindParam(':doctor_id', $doctor_id);
$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

function addTestResult($patient_id, $test_name, $test_date) {
    require 'config.php';
    $stmt = $pdo->prepare('INSERT INTO test_results (patient_id, test_name, test_date) VALUES (?, ?, ?)');
    $stmt->bindParam(1, $patient_id);
    $stmt->bindParam(2, $test_name);
    $stmt->bindParam(3, $test_date);
    $stmt->execute();
    // Redirect to a different page to prevent the form from being submitted again
    header('Location: test_results.php');
    exit();
}


?>