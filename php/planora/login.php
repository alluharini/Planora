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

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode([
        'status' => false,
        'message' => 'Email and password are required.',
        'data' => []
    ]);
    exit;
}

try {
    // Check if the user exists
    $stmt = $pdo->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() == 0) {
        echo json_encode([
            'status' => false,
            'message' => 'Invalid email or password.',
            'data' => []
        ]);
        exit;
    }

    // Fetch user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password (in production, hash the password and compare)
    if ($password === $user['password']) {
        echo json_encode([
            'status' => true,
            'message' => 'Login successful.',
            'data' => [
                [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ]
            ]
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Invalid email or password.',
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
