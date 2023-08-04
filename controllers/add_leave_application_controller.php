<?php
// get the user ID from the session
$user_id = $_SESSION['user_id'];

// check if the form has been submitted
if (isset($_POST['submit'])) {
  // get the form data
  $reason_for_leave = $_POST['reason_for_leave'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $medical_document = null;

  // check if reason for leave is sickness and if medical document is uploaded
  if ($reason_for_leave == 'sickness' && isset($_FILES['medical_document'])) {
    $medical_document = $_FILES['medical_document']['name'];
  }

  // validate the form data
  $errors = array();
  if (empty($reason_for_leave)) {
    $errors[] = 'Reason for leave is required';
  }
  if (empty($start_date)) {
    $errors[] = 'Start date is required';
  }
  if (empty($end_date)) {
    $errors[] = 'End date is required';
  }
  // check if reason for leave is sickness and if medical document is uploaded
  if ($reason_for_leave == 'sickness' && empty($medical_document)) {
    $errors[] = 'Medical document is required for sickness leave';
  }
  if (!empty($start_date) && !empty($end_date) && strtotime($start_date) > strtotime($end_date)) {
    $errors[] = 'Start date should be less than or equal to end date';
  }  
  if (!empty($medical_document)) {
    $allowed_extensions = array('pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png');
    $file_info = pathinfo($_FILES['medical_document']['name']);
    $extension = strtolower($file_info['extension']);
    if (!in_array($extension, $allowed_extensions)) {
      $errors[] = 'Invalid file type. Allowed file types are: ' . implode(', ', $allowed_extensions);
    }
  }
  if (empty($errors)) {
    addLeaveApplication($user_id, $reason_for_leave, $start_date, $end_date, $medical_document);
    // upload the medical document file if it exists
    if (!empty($medical_document)) {
      move_uploaded_file($_FILES['medical_document']['tmp_name'], '../uploads/' . $medical_document);
    }

    // redirect to the leave application page with a success message
    header('Location: doctor_leave_application.php');
    exit;
  }
}
?>