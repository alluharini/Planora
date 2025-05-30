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

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($name) || empty($email) || empty($password)) {
    echo json_encode([
        'status' => false,
        'message' => 'All fields are required.',
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
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        echo json_encode([
            'status' => false,
            'message' => 'Email is already registered.',
            'data' => []
        ]);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $success = $stmt->execute([$name, $email, $password]);

    if ($success) {
        echo json_encode([
            'status' => true,
            'message' => 'Registration successful.',
            'data' => [[
                'id' => $pdo->lastInsertId(),
                'name' => $name,
                'email' => $email,
                'password' => $password // ⚠️ For production, never return or store plaintext passwords!
            ]]
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Registration failed.',
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
