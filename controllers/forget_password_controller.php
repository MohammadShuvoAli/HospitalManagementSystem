<?php
include 'sanitize.php';

if (isset($_POST['submit'])) {
  $email = sanitize($_POST['email']);

  if (empty($email)) {
    $error = "Please enter your email!";
  } else {
    $user = find_user_by_email($pdo, $email);

    if (!$user) {
      $error = "No user found with that email!";
    } else {
      $token = generate_reset_token($pdo, $user["user_id"]);

      // Send email with reset link
      $reset_link = "http://127.0.0.1/hms/reset_password.php?token=$token";
      $to = $user["email"];
      $subject = "Password Reset";
      $message = "Please click on this link to reset your password: $reset_link " . "\r\n" . "\r\n" .
        "This link will be valid for 5 minutes.";
      $headers = "From: mohammadshuvoali@gmail.com";

      if (mail($to, $subject, $message, $headers)) {
        $success = "An email has been sent to your
               <br> email address with instructions 
               <br> on how to reset your password. <br>";
      } else {
        $error = "Unable to send email. Please try again later.";
      }
    }
  }
}

?>
