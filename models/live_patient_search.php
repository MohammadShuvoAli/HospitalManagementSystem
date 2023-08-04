<?php
// Include the database connection file
include_once 'config.php';

// Fetch the search query from AJAX request
$search = $_POST['search'];

// Check if the search query is empty
// Prepare the SQL statement to search for patients based on first name, last name, phone, or email
$sql = "SELECT * FROM Patient WHERE first_name LIKE ? OR last_name LIKE ? OR phone LIKE ? OR email LIKE ?";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, "%$search%", PDO::PARAM_STR);
$stmt->bindValue(2, "%$search%", PDO::PARAM_STR);
$stmt->bindValue(3, "%$search%", PDO::PARAM_STR);
$stmt->bindValue(4, "%$search%", PDO::PARAM_STR);
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Encode the fetched patient data as JSON and send it as response
echo json_encode($patients);
?>
