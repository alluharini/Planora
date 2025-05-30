<?php
// config.php

$servername = "localhost"; // or your database host
$username = "root";        // your database username
$password = "";            // your database password
$dbname = "planora";       // your database name

try {
    // Create a PDO instance for database connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Send a JSON response in case of a failure
    echo json_encode([
        "status" => false,
        "message" => "Database connection failed: " . $e->getMessage(),
        "data" => []
    ]);
    exit();
}
?>
