<?php
function updatePrescription($prescription_id, $appointment_id, $patient_id, $medicine_name, $dosage, $duration) {
    require '../models/config.php';
    $stmt = $pdo->prepare("UPDATE prescription SET prescription_id = :prescription_id, appointment_id = :appointment_id, 
    patient_id = :patient_id, medicine_name = :medicine_name, dosage = :dosage, duration = :duration 
    WHERE prescription_id = :prescription_id");
    $stmt->bindParam(':prescription_id', $prescription_id);
    $stmt->bindParam(':appointment_id', $appointment_id);
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->bindParam(':medicine_name', $medicine_name);
    $stmt->bindParam(':dosage', $dosage);
    $stmt->bindParam(':duration', $duration);
    $stmt->execute();
    $pdo = null;
}

function deletePrescription($prescription_id) {
    require '../models/config.php';
    $stmt = $pdo->prepare("DELETE FROM prescription WHERE prescription_id = :prescription_id");
    $stmt->bindParam(':prescription_id', $prescription_id);
    $stmt->execute();
    $pdo = null;
}

function getPrescription($prescription_id) {
    require '../models/config.php';
    $stmt = $pdo->prepare("SELECT * FROM prescription WHERE prescription_id = :prescription_id");
    $stmt->bindParam(':prescription_id', $prescription_id);
    $stmt->execute();
    $prescription = $stmt->fetch(PDO::FETCH_ASSOC);
    $pdo = null;
    return $prescription;
}

function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>