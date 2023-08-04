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

// Retrieve appointment records from database and display
$stmt = $pdo->prepare("SELECT appointment.appointment_id, appointment.patient_id, appointment.doctor_id, appointment.appointment_date, appointment.appointment_time, appointment.appointment_status, patient.first_name, patient.last_name
FROM appointment
LEFT JOIN patient ON appointment.patient_id = patient.patient_id
WHERE appointment.doctor_id = :doctor_id");
$stmt->bindParam(':doctor_id', $doctor_id);
$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Close database connection
$pdo = null;
?>