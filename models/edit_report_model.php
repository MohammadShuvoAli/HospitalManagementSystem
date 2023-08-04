<?php
require 'config.php';
function update_report($report_id, $report_date, $report_details) {
    require 'config.php';
    $stmt = $pdo->prepare("UPDATE medical_reports SET report_date = :report_date, report_details = :report_details WHERE report_id = :report_id");
    $stmt->bindParam(':report_id', $report_id);
    $stmt->bindParam(':report_date', $report_date);
    $stmt->bindParam(':report_details', $report_details);
    $stmt->execute();
}

function delete_report($report_id) {
    require 'config.php';
    $stmt = $pdo->prepare("DELETE FROM medical_reports WHERE report_id = :report_id");
    $stmt->bindParam(':report_id', $report_id);
    $stmt->execute();
    return $stmt->rowCount();
}

function get_report_details($report_id) {
    require 'config.php';
    $stmt = $pdo->prepare("SELECT * FROM medical_reports WHERE report_id = :report_id");
    $stmt->bindParam(':report_id', $report_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
