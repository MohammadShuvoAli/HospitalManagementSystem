<?php
require_once 'config.php';
function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if token is valid and not expired
if (!isset($_GET["token"])) {
    die("Token is missing.");
}
$token = sanitize($_GET["token"]);
$stmt = $pdo->prepare("SELECT * FROM PasswordResetToken WHERE token = :token AND created_at >= DATE_SUB(NOW(), INTERVAL 5 MINUTE)");
$stmt->bindParam(':token', $token);
$stmt->execute();
$token_data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$token_data) {
    // Delete the reset token from the PasswordResetToken table
    $stmt = $pdo->prepare("DELETE FROM PasswordResetToken WHERE token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    die("Invalid or expired token.");
}
?>