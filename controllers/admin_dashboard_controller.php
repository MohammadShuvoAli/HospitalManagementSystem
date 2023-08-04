<?php
require '../models/admin_dashboard_model.php';
if (isset($_POST['approve'])) {
    // Call the model function to update the leave status to "approved"

    approveLeave($pdo, $_POST['leave_id']);
}

if (isset($_POST['reject'])) {
    // Call the model function to update the leave status to "rejected"

    rejectLeave($pdo, $_POST['leave_id']);
}

// Call the model function to fetch all the leave applications for the admin

$leave_applications = getAllLeaves($pdo);
?>
