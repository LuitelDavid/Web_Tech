<?php
// todos/toggle.php
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
    // Verify ownership and get current status
    $stmt = $pdo->prepare("SELECT is_completed FROM todos WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $user_id]);
    $todo = $stmt->fetch();

    if (!$todo) {
        echo json_encode(['error' => 'Todo not found or unauthorized']);
        exit;
    }

    $new_status = $todo['is_completed'] ? 0 : 1;
    $stmt = $pdo->prepare("UPDATE todos SET is_completed = ? WHERE id = ?");
    $stmt->execute([$new_status, $id]);

    echo json_encode(['success' => true, 'is_completed' => $new_status]);
} catch (\PDOException $e) {
    echo json_encode(['error' => 'Failed to toggle todo: ' . $e->getMessage()]);
}
?>
