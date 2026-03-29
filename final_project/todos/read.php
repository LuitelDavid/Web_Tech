<?php
// todos/read.php
require_once '../config/db.php';

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized access']);
    exit;
}

$user_id = $_SESSION['user_id'];
$today = date('Y-m-d');

try {
    $stmt = $pdo->prepare("SELECT id, task, is_completed FROM todos WHERE user_id = ? AND created_at = ? ORDER BY id ASC");
    $stmt->execute([$user_id, $today]);
    $todos = $stmt->fetchAll();
    
    echo json_encode(['success' => true, 'todos' => $todos]);
} catch (\PDOException $e) {
    echo json_encode(['error' => 'Failed to fetch todos: ' . $e->getMessage()]);
}
?>
