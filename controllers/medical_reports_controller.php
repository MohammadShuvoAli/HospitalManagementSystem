<?php
include 'sanitize.php';
$user_id = sanitize($_SESSION['user_id']);
$doctor_id = getDoctorId($pdo, $user_id);

if (!$doctor_id) {
  header('Location: login.php');
  exit();
}
$medical_reports = getMedicalReports($pdo, $doctor_id);
$pdo = null;
?>
