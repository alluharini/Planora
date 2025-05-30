<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "planora";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Database connection failed",
        "data" => []
    ]);
    exit();
}

// Get form-data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$value = isset($_POST['value']) ? floatval($_POST['value']) : null;

if (empty($name) || $value === null) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Name and value are required",
        "data" => []
    ]);
    exit();
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO menu_items (name, value) VALUES (?, ?)");
$stmt->bind_param("sd", $name, $value);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Menu item added successfully",
        "data" => [
            ["id" => $stmt->insert_id, "name" => $name, "value" => $value]
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Failed to insert data",
        "data" => []
    ]);
}

$stmt->close();
$conn->close();
?>
