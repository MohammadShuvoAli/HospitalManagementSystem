<?php
function getUserByUsername($username) {
    require '../models/config.php';
    $stmt = $pdo->prepare("SELECT * FROM User WHERE username=:username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row;
}
?>