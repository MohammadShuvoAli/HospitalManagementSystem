<?php
require 'config.php';
function sanitize($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// Get the user ID from the session
$user_id = sanitize($_SESSION['user_id']);

// Query the doctor table to get the doctor ID
$stmt = $pdo->prepare('SELECT doctor_id FROM doctor WHERE user_id = :user_id');
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$doctor = $stmt->fetch(PDO::FETCH_ASSOC);

// Get the doctor ID from the query result
$doctor_id = sanitize($doctor['doctor_id']);
// Retrieve patient records from database and display
$stmt = $pdo->prepare("SELECT * FROM patient WHERE doctor_id = :doctor_id");
$stmt->bindParam(':doctor_id', $doctor_id);
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Close database connection
$pdo = null;
?>