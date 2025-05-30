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
$food_name = isset($_POST['food_name']) ? trim($_POST['food_name']) : '';

if (empty($food_name)) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Food name is required",
        "data" => []
    ]);
    exit();
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO leftover_ideas (food_name) VALUES (?)");
$stmt->bind_param("s", $food_name);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Food idea added successfully",
        "data" => [
            ["id" => $stmt->insert_id, "food_name" => $food_name]
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
