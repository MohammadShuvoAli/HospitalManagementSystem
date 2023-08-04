<?php
require '../models/config.php';

function getDoctorId($user_id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT doctor_id FROM doctor WHERE user_id = :user_id');
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
    return $doctor ? $doctor['doctor_id'] : null;
}

function getTotalPatients($doctor_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_patients FROM Patient 
        WHERE doctor_id = :doctor_id");
    $stmt->bindParam('doctor_id', $doctor_id);
    $stmt->execute();
    $total_patients = $stmt->fetch(PDO::FETCH_ASSOC);
    return $total_patients['total_patients'];
}

function getTotalAppointments($doctor_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_appointments FROM Appointment 
        WHERE doctor_id = :doctor_id");
    $stmt->bindParam('doctor_id', $doctor_id);
    $stmt->execute();
    $total_appointments = $stmt->fetch(PDO::FETCH_ASSOC);
    return $total_appointments['total_appointments'];
}

function getPendingAppointments($doctor_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) AS pending_appointments FROM Appointment 
        WHERE doctor_id = :doctor_id AND appointment_status = 'Scheduled'");
    $stmt->bindParam('doctor_id', $doctor_id);
    $stmt->execute();
    $pending_appointments = $stmt->fetch(PDO::FETCH_ASSOC);
    return $pending_appointments['pending_appointments'];
}

function getTotalDoctors() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_doctors FROM Doctor");
    $stmt->execute();
    $total_doctors = $stmt->fetch(PDO::FETCH_ASSOC);
    return $total_doctors['total_doctors'];
}
?>
