<?php

if (isset($_POST['update'])) {
    updatePrescription($_POST['prescription_id'], $_POST['appointment_id'], $_POST['patient_id'], $_POST['medicine_name'], $_POST['dosage'], $_POST['duration']);
    header('Location: prescriptions.php');
    exit();
}

if (isset($_POST['delete'])) {
    deletePrescription($_POST['prescription_id']);
}

if (!isset($_GET['prescription_id'])) {
    header('Location: prescriptions.php');
    exit();
}

$prescription = getPrescription($_GET['prescription_id']);
?>