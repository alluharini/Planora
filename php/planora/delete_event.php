<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$password = "";
$dbname = "planora";

// Create DB connection
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["status" => false, "message" => "Database connection failed"]);
    exit();
}

// Get eventId from POST form data
if (!isset($_POST['eventId'])) {
    echo json_encode(["status" => false, "message" => "Missing eventId"]);
    exit();
}

$eventId = $conn->real_escape_string($_POST['eventId']);

// Delete query
$sql = "DELETE FROM events_detail WHERE id = '$eventId'";

if ($conn->query($sql) === TRUE) {
    if ($conn->affected_rows > 0) {
        echo json_encode(["status" => true, "message" => "Event deleted successfully"]);
    } else {
        echo json_encode(["status" => false, "message" => "Event not found"]);
    }
} else {
    echo json_encode(["status" => false, "message" => "Failed to delete event"]);
}

$conn->close();
?>
