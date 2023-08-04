<?php
include 'sanitize.php';

if (isset($_POST['update'])) {
    $report_id = sanitize($_POST['report_id']);
    $report_date = sanitize($_POST['report_date']);
    $report_details = sanitize($_POST['report_details']);

    update_report($report_id, $report_date, $report_details);

    header('Location: medical_reports.php');
    exit();
}

if (isset($_POST['delete'])) {
    $report_id = sanitize($_POST['report_id']);

    $rows_deleted = delete_report($report_id);

    if ($rows_deleted > 0) {
        header('Location: medical_reports.php');
        exit();
    } else {
        echo "Error deleting patient record.";
    }
}

if (!isset($_GET['report_id'])) {
    header('Location: medical_reports.php');
    exit();
}

$medical_reports = get_report_details($_GET['report_id']);
?>
