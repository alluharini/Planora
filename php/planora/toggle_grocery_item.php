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

// Get form-data values
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$is_checked = isset($_POST['is_checked']) ? intval($_POST['is_checked']) : 0;

if ($id <= 0) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Valid ID is required",
        "data" => []
    ]);
    exit();
}

$stmt = $conn->prepare("UPDATE grocery_list SET is_checked=? WHERE id=?");
$stmt->bind_param("ii", $is_checked, $id);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Record updated successfully",
        "data" => [
            ["id" => $id, "is_checked" => $is_checked]
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Failed to update data",
        "data" => []
    ]);
}

$stmt->close();
$conn->close();
?>
