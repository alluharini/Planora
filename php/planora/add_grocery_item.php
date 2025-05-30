<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

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

$name = isset($_POST['name']) ? trim($_POST['name']) : '';

if (empty($name)) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Name is required",
        "data" => []
    ]);
    exit();
}

$stmt = $conn->prepare("INSERT INTO grocery_list (name, is_checked) VALUES (?, 0)");
$stmt->bind_param("s", $name);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Item inserted successfully",
        "data" => [
            ["id" => $stmt->insert_id, "name" => $name, "is_checked" => 0]
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
