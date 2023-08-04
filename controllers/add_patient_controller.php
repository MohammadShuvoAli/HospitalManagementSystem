<?php
include 'sanitize.php';
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $first_name = sanitize($_POST['first_name']);
    $last_name = sanitize($_POST['last_name']);
    $date_of_birth = sanitize($_POST['date_of_birth']);
    if (isset($_POST['gender'])) {
        $gender = sanitize($_POST['gender']);
    } else {
        $gender = '';
    }
    $address = sanitize($_POST['address']);
    $phone = sanitize($_POST['phone']);
    $email = sanitize($_POST['email']);
    // Validate inputs
    $errors = array();
    if (empty($first_name)) {
        $errors[] = 'First name is required';
    }
    if (empty($last_name)) {
        $errors[] = 'Last name is required';
    }
    if (empty($date_of_birth)) {
        $errors[] = 'Date of birth is required';
    }
    if (empty($gender)) {
        $errors[] = 'Gender is required';
    }
    if (empty($address)) {
        $errors[] = 'Address is required';
    }
    if (empty($phone)) {
        $errors[] = 'Phone number is required';
    }
    // Validate email
    if (empty($_POST["email"])) {
        $errors[] = "Email is required";
    } else {
        $email = sanitize($_POST["email"]);
        // Check if email already exists
        if (checkEmailExists($pdo, $email)) {
            $errors[] = "Email already exists";
        }
    }
    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        try {
            addPatient($doctor_id, $first_name, $last_name, $date_of_birth, $gender, $address, $phone, $email);
        } catch (PDOException $e) {
            $message = 'Error adding patient: ' . $e->getMessage();
        }
    }
}
