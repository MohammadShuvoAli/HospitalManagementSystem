<?php
// Include database connection and configuration
include_once "config.php";
session_start();
// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Query the doctor table to get the doctor ID
$stmt = $pdo->prepare('SELECT doctor_id FROM doctor WHERE user_id = :user_id');
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$doctor = $stmt->fetch(PDO::FETCH_ASSOC);

// Get the doctor ID from the query result
$doctor_id = $doctor['doctor_id'];
// Get search input from AJAX request
$search = $_POST["search"];

// Prepare and execute the SQL query to search prescription by patient's name and medicine name
$stmt = $pdo->prepare("SELECT p.first_name, p.last_name, pr.prescription_id, pr.medicine_name, pr.dosage, pr.duration
                      FROM prescription AS pr
                      INNER JOIN patient AS p ON pr.patient_id = p.patient_id
                      WHERE pr.doctor_id = :doctor_id
                      AND (CONCAT(p.first_name, ' ', p.last_name) LIKE :search
                      OR pr.medicine_name LIKE :search)");

// Bind the parameter values
$stmt->bindValue(':doctor_id', $doctor_id); // Replace with the actual doctor_id value
$stmt->bindValue(':search', '%' . $search . '%');
$stmt->execute();
$prescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return results as JSON
echo json_encode($prescriptions);
?>
