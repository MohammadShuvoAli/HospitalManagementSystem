<?php
include 'sanitize.php';
// Check if form is submitted
if (isset($_POST['update'])) {
    // Get form data and sanitize it
    $patient_id = sanitize($_POST['patient_id']);
    $first_name = sanitize($_POST['first_name']);
    $last_name = sanitize($_POST['last_name']);
    $email = sanitize($_POST['email']);
    $date_of_birth = sanitize($_POST['date_of_birth']);
    $gender = sanitize($_POST['gender']);
    $address = sanitize($_POST['address']);
    $phone = sanitize($_POST['phone']);

    require_once '../models/edit_patient_model.php';
    // Prepare and execute parameterized SQL query to update patient details in database
    updatePatient($first_name, $last_name, $email, $date_of_birth, $gender, $address, $phone, $patient_id);
  
    // Redirect to patient records page
    header('Location: patient_records.php');
    exit();
  }

  if (isset($_POST['delete'])) {
    // Get the patient ID from the form and sanitize it
    $patient_id = sanitize($_POST['patient_id']);
  
    require_once '../models/edit_patient_model.php';
    // Prepare and execute the parameterized SQL query to delete the patient record 
    deletePatient($patient_id);
    
    // Check if the query was successful
    if ($stmt->rowCount() > 0) {
      // Redirect back to the patient list page
      header('Location: patient_records.php');
      exit;
    } else {
      // Display an error message
      echo "Error deleting patient record.";
    }
  }

  // Check if patient ID is set and sanitize it
if (!isset($_GET['patient_id'])) {
    // If patient ID is not set, redirect to patient records page
    header('Location: patient_records.php');
    exit();
  }
  $patient_id = sanitize($_GET['patient_id']);
?>