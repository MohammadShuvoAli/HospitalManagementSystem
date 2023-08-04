<?php
include 'config.php';
// Initialize variables
$first_name = '';
$last_name = '';
$date_of_birth = '';
$gender = '';
$address = '';
$phone = '';
$email = '';
function checkEmailExists($pdo, $email) {
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email=:email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return true;
    }
    return false;
}

    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Query the doctor table to get the doctor ID
    $stmt = $pdo->prepare('SELECT doctor_id FROM doctor WHERE user_id = :user_id');
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get the doctor ID from the query result
    $doctor_id = $doctor['doctor_id'];

    function addPatient($doctor_id, $first_name, $last_name, $date_of_birth, $gender, $address, $phone, $email) {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO patient (doctor_id, first_name, last_name, date_of_birth, gender, address, phone, email) 
        VALUES (:doctor_id, :first_name, :last_name, :date_of_birth, :gender, :address, :phone, :email)');
        $stmt->bindParam(':doctor_id', $doctor_id);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':date_of_birth', $date_of_birth);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        header('Location: patient_records.php');
        exit();
    }
?>