<?php
require 'config.php';
function updatePatient($first_name, $last_name, $email, $date_of_birth, $gender, $address, $phone, $patient_id) {
    require 'config.php';
    $stmt = $pdo->prepare("UPDATE patient SET first_name = :first_name, last_name = :last_name, email = :email,
        date_of_birth = :date_of_birth, gender = :gender, address = :address, phone = :phone 
        WHERE patient_id = :patient_id");
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':date_of_birth', $date_of_birth);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->execute();

    // Redirect to patient records page
    header('Location: patient_records.php');
    exit();
}
function deletePatient($patient_id) {
    require 'config.php';
    $stmt = $pdo->prepare("DELETE FROM patient WHERE patient_id = :patient_id");
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->execute();
}

// Prepare and execute parameterized SQL query to retrieve patient details from database
$stmt = $pdo->prepare("SELECT * FROM patient WHERE patient_id = :patient_id");
$stmt->bindParam(':patient_id', $patient_id);
$stmt->execute();
$patient = $stmt->fetch(PDO::FETCH_ASSOC);

// Close database connection
$pdo = null;
?>