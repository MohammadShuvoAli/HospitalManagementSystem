<?php
function addLeaveApplication($user_id, $reason_for_leave, $start_date, $end_date, $medical_document) {
    require_once '../models/config.php';

    // Insert the data into the Leave table
    $stmt = $pdo->prepare('INSERT INTO `Leave` (user_id, reason_for_leave, start_date, end_date, medical_document, leave_status) VALUES (:user_id, :reason_for_leave, :start_date, :end_date, :medical_document, :leave_status)');
    $leave_status = 'Pending';
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':reason_for_leave', $reason_for_leave);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    if (!empty($medical_document)) {
      $stmt->bindParam(':medical_document', $medical_document);
    } else {
      $stmt->bindValue(':medical_document', null, PDO::PARAM_NULL);
    }
    $stmt->bindParam(':leave_status', $leave_status);
    $stmt->execute();
}
?>