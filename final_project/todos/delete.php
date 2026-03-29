<?php
// todos/delete.php
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

$id = $_POST['id'] ?? null;
$user_id = $_SESSION['user_id'];

if (!$id) {
    echo json_encode(['error' => 'Todo ID is required']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM todos WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $user_id]);
    
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Todo not found or unauthorized']);
    }
} catch (\PDOException $e) {
    echo json_encode(['error' => 'Failed to delete todo: ' . $e->getMessage()]);
}
?>
