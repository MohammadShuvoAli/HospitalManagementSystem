<?php
require 'config.php';
function getDoctorId($pdo, $user_id)
{
  $stmt = $pdo->prepare('SELECT doctor_id FROM doctor WHERE user_id = :user_id');
  $stmt->bindParam(':user_id', $user_id);
  $stmt->execute();
  $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

  return sanitize($doctor['doctor_id']);
}

function getMedicalReports($pdo, $doctor_id)
{
  $stmt = $pdo->prepare("SELECT patient.first_name, patient.last_name, medical_reports.report_id, medical_reports.report_date, medical_reports.report_details
  FROM patient
  INNER JOIN medical_reports ON patient.patient_id = medical_reports.patient_id
  WHERE patient.doctor_id = :doctor_id ");
  $stmt->bindParam(':doctor_id', $doctor_id);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
