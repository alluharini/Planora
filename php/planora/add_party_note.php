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
$note = isset($_POST['note']) ? trim($_POST['note']) : '';

if (empty($note)) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Note is required",
        "data" => []
    ]);
    exit();
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO party_notes (note) VALUES (?)");
$stmt->bind_param("s", $note);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Note added successfully",
        "data" => [
            ["id" => $stmt->insert_id, "note" => $note]
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
