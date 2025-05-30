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

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$status = isset($_POST['status']) ? (int) $_POST['status'] : null;

if ($id <= 0 || !isset($status)) {
    echo json_encode([
        'status' => false,
        'message' => 'Event ID and status are required.',
        'data' => []
    ]);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE events_detail SET status = ? WHERE id = ?");
    $success = $stmt->execute([$status, $id]);

    if ($success && $stmt->rowCount() > 0) {
        echo json_encode([
            'status' => true,
            'message' => 'Event status updated successfully.',
            'data' => [['id' => $id, 'status' => $status]]
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'No event found with the given ID or status unchanged.',
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
