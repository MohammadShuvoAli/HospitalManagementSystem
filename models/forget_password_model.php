<?php
require_once '../models/config.php';

function generate_reset_token($pdo, $user_id) {
  $token = bin2hex(random_bytes(32));
  
  $stmt = $pdo->prepare("INSERT INTO PasswordResetToken (user_id, token) VALUES (:user_id, :token)");
  $stmt->bindParam(':user_id', $user_id);
  $stmt->bindParam(':token', $token);
  $stmt->execute();
  
  return $token;
}

function find_user_by_email($pdo, $email) {
  $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $user = $stmt->fetch();
  
  return $user;
}
?>
