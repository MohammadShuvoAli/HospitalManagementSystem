<?php
require_once '../models/config.php';
// get the user ID from the session
$user_id = $_SESSION['user_id'];

// fetch all the leave applications for the doctor
$stmt = $pdo->prepare('SELECT * FROM `Leave` WHERE user_id = :user_id ORDER BY user_id DESC');
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$leave_applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>