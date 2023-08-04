<?php
require 'config.php';
function updateAppointment($pdo, $appointment_id, $patient_id, $doctor_id, $appointment_date, $appointment_time) {
    $stmt = $pdo->prepare("UPDATE appointment SET appointment_id = :appointment_id, patient_id = :patient_id, 
    doctor_id = :doctor_id, appointment_date = :appointment_date, appointment_time = :appointment_time
    WHERE appointment_id = :appointment_id");
    $stmt->bindParam(':appointment_id', $appointment_id);
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->bindParam(':doctor_id', $doctor_id);
    $stmt->bindParam(':appointment_date', $appointment_date);
    $stmt->bindParam(':appointment_time', $appointment_time);
    //$stmt->bindParam(':appointment_status', $appointment_status);
    $stmt->execute();

    // Redirect to patient records page
    header('Location: appointments.php');
    exit();
}
function cancelAppointment($pdo, $appointment_id, $appointment_status) {
    $stmt = $pdo->prepare("UPDATE appointment SET appointment_status = :appointment_status 
    WHERE appointment_id = :appointment_id");
    $stmt->bindParam(':appointment_id', $appointment_id);
    $stmt->bindParam(':appointment_status', $appointment_status);
    $stmt->execute();
}
function completeAppointmentStatus($pdo, $appointment_id) {
    $appointment_status = 'Completed';
    // Update appointment details in database
    $stmt = $pdo->prepare("UPDATE appointment SET appointment_status = :appointment_status 
                           WHERE appointment_id = :appointment_id");
    $stmt->bindParam(':appointment_id', $appointment_id);
    $stmt->bindParam(':appointment_status', $appointment_status);
    $stmt->execute();

    // Redirect to appointments page
    header('Location: appointments.php');
    exit();
}
function deleteAppointment($pdo, $appointment_id) {
    $stmt = $pdo->prepare("DELETE FROM appointment WHERE appointment_id = :appointment_id");
    $stmt->bindParam(':appointment_id', $appointment_id);
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->rowCount() > 0) {
        // Redirect back to the patient list page
        header('Location: appointments.php');
        exit;
    } else {
        // Display an error message
        echo "Error deleting appointment.";
    }
}
?>