<?php
include 'config.php';
function update_test_result($pdo, $test_result_id, $patient_id, $test_name, $test_date) {
  // Update test result details in database using parameterized statement and bindParam
  $stmt = $pdo->prepare("UPDATE test_results SET patient_id = :patient_id, test_name = :test_name, test_date = :test_date 
      WHERE test_result_id = :test_result_id");
  $stmt->bindParam(':patient_id', $patient_id);
  $stmt->bindParam(':test_name', $test_name);
  $stmt->bindParam(':test_date', $test_date);
  $stmt->bindParam(':test_result_id', $test_result_id);
  return $stmt->execute();
}

function delete_test_result($pdo, $test_result_id) {
  // Prepare and execute the SQL query to delete the test result using parameterized statement and bindParam
  $stmt = $pdo->prepare("DELETE FROM test_results WHERE test_result_id = :test_result_id");
  $stmt->bindParam(':test_result_id', $test_result_id);
  $stmt->execute();

  // Check if the query was successful
  return ($stmt->rowCount() > 0);
}

function get_test_result($pdo, $test_result_id) {
  // Retrieve test result details from
  $stmt = $pdo->prepare("SELECT * FROM test_results WHERE test_result_id = :test_result_id");
  $stmt->bindParam(':test_result_id', $test_result_id);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  
  ?>