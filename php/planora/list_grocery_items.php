<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

// Require POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "status" => false,
        "message" => "Method Not Allowed. Use POST.",
        "data" => []
    ]);
    exit();
}

// Check if a dummy field is present (optional for validation)
if (!isset($_POST['fetch'])) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Missing required form-data field 'fetch'",
        "data" => []
    ]);
    exit();
}

// DB connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "planora";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode([
        "status" => false,
        "message" => "Database connection failed",
        "data" => []
    ]);
    exit();
}

$result = $conn->query("SELECT id, name, is_checked FROM grocery_list ORDER BY created_at DESC");

$items = [];
while ($row = $result->fetch_assoc()) {
    $row['is_checked'] = (bool)$row['is_checked'];
    $items[] = $row;
}

echo json_encode([
    "status" => true,
    "message" => "Grocery list retrieved successfully",
    "data" => $items
]);

$conn->close();
?>
