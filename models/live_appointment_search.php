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

// Prepare and execute the SQL query to search appointments by patient's name
$stmt = $pdo->prepare("SELECT p.first_name, p.last_name, a.appointment_id, a.appointment_date, a.appointment_time, a.appointment_status
                      FROM appointment AS a
                      INNER JOIN Patient AS p ON a.patient_id = p.patient_id
                      WHERE a.doctor_id = :doctor_id
                      AND CONCAT(p.first_name, ' ', p.last_name) LIKE :search");

$stmt->bindValue(':doctor_id', $doctor_id); // Replace 3 with the actual doctor_id value
$stmt->bindValue(':search', '%' . $search . '%');
$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return results as JSON
echo json_encode($appointments);
