<?php
include 'config.php';
function get_doctor_id($pdo, $user_id) {
  // Query the doctor table to get the doctor ID
  $stmt = $pdo->prepare('SELECT doctor_id FROM doctor WHERE user_id = :user_id');
  $stmt->bindParam(':user_id', $user_id);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}
function get_test_results($pdo, $doctor_id) {
  // Retrieve test_result records from database
  $stmt = $pdo->prepare("SELECT patient.first_name, patient.last_name, test_results.test_result_id, test_results.test_name, test_results.test_date, test_results.test_result
    FROM patient
    LEFT JOIN test_results ON patient.patient_id = test_results.patient_id
    WHERE patient.doctor_id = :doctor_id
    ORDER BY test_results.test_result_id ASC;");
  $stmt->bindParam(':doctor_id', $doctor_id);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
