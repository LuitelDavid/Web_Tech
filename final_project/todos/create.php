<?php
// todos/create.php
require_once '../config/db.php';

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized access']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

$task = $_POST['task'] ?? '';
$user_id = $_SESSION['user_id'];
$date = date('Y-m-d'); // Today's date

if (empty(trim($task))) {
    echo json_encode(['error' => 'Task description is required']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO todos (user_id, task, created_at) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $task, $date]);
    
    echo json_encode([
        'success' => true,
        'todo' => [
            'id' => $pdo->lastInsertId(),
            'task' => $task,
            'is_completed' => 0
        ]
    ]);
} catch (\PDOException $e) {
    echo json_encode(['error' => 'Failed to create todo: ' . $e->getMessage()]);
}
?>
