<?php
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'status' => false,
        'message' => 'Invalid request method.',
        'data' => []
    ]);
    exit;
}

$event_name = trim($_POST['event_name'] ?? '');
$event_date = trim($_POST['event_date'] ?? '');
$email = trim($_POST['email'] ?? '');
// Default status is 0
$status = isset($_POST['status']) ? (int) $_POST['status'] : 0;

if (empty($event_name) || empty($event_date) || empty($email)) {
    echo json_encode([
        'status' => false,
        'message' => 'Event name, date, and email are required.',
        'data' => []
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'status' => false,
        'message' => 'Invalid email format.',
        'data' => []
    ]);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO events_detail (event_name, event_date, email, status) VALUES (?, ?, ?, ?)");
    $success = $stmt->execute([$event_name, $event_date, $email, $status]);

    if ($success) {
        echo json_encode([
            'status' => true,
            'message' => 'Event created successfully.',
            'data' => [[
                'id' => $pdo->lastInsertId(),
                'event_name' => $event_name,
                'event_date' => $event_date,
                'email' => $email,
                'status' => $status
            ]]
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Event creation failed.',
            'data' => []
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'status' => false,
        'message' => 'Database error: ' . $e->getMessage(),
        'data' => []
    ]);
}
?>
