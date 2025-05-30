<?php
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        'status' => false,
        'message' => 'Invalid request method.',
        'data' => []
    ]);
    exit;
}

$email = trim($_GET['email'] ?? '');

if (empty($email)) {
    echo json_encode([
        'status' => false,
        'message' => 'Email is required.',
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
    $stmt = $pdo->prepare("SELECT id, event_name, event_date, email, status FROM events_detail WHERE email = ?");
    $stmt->execute([$email]);
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($events) {
        echo json_encode([
            'status' => true,
            'message' => 'Events fetched successfully.',
            'data' => $events
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'No events found for this email.',
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
