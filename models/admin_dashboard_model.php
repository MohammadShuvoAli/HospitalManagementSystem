<?php
include 'config.php';
function approveLeave($pdo, $leave_id) {
    $stmt = $pdo->prepare('UPDATE `Leave` SET `leave_status` = "approved" WHERE `leave_id` = :leave_id');
    $stmt->execute(['leave_id' => $leave_id]);
}

function rejectLeave($pdo, $leave_id) {
    $stmt = $pdo->prepare('UPDATE `Leave` SET `leave_status` = "rejected" WHERE `leave_id` = :leave_id');
    $stmt->execute(['leave_id' => $leave_id]);
}

function getAllLeaves($pdo) {
    $stmt = $pdo->prepare('SELECT * FROM `Leave`');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
