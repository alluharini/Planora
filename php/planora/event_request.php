<?php
header('Content-Type: application/json');

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'status' => false,
        'message' => 'Invalid request method',
        'data' => []
    ]);
    exit;
}

// Database connection
$host = "localhost";
$dbname = "planora";
$username = "root";
$password = ""; // replace with your actual DB password

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode([
        'status' => false,
        'message' => 'Database connection failed: ' . $conn->connect_error,
        'data' => []
    ]);
    exit;
}

// Get form data
$guest_count = intval($_POST['guest_count'] ?? 0);
$event_type = $_POST['event_type'] ?? '';
$cuisine = $_POST['cuisine'] ?? '';
$dietary_preference = $_POST['dietary_preference'] ?? '';
$price_range = $_POST['price_range'] ?? 'Medium'; // Default fallback

// Insert into DB
$stmt = $conn->prepare("INSERT INTO event_requests (guest_count, event_type, cuisine, dietary_preference, price_range) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("issss", $guest_count, $event_type, $cuisine, $dietary_preference, $price_range);

if ($stmt->execute()) {
    echo json_encode([
        'status' => true,
        'message' => 'Event data submitted successfully',
        'data' => [
            'id' => $stmt->insert_id,
            'guest_count' => $guest_count,
            'event_type' => $event_type,
            'cuisine' => $cuisine,
            'dietary_preference' => $dietary_preference,
            'price_range' => $price_range
        ]
    ]);
} else {
    echo json_encode([
        'status' => false,
        'message' => 'Failed to save event: ' . $stmt->error,
        'data' => []
    ]);
}

$stmt->close();
$conn->close();
?>
