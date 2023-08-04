<?php
require_once "config.php";

function getPasswordByUsername($username)
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT `password` FROM `user` WHERE `username` = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['password'];
}

function updatePasswordByUsername($username, $password)
{
    global $pdo;
    $stmt = $pdo->prepare('UPDATE user SET password = :password WHERE username = :username');
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
}
?>