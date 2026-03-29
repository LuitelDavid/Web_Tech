<?php
// habits/delete.php
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

if (!$id) {
    echo json_encode(['error' => 'ID is required']);
    exit;
}

try {
    // Verify ownership
    $stmt = $pdo->prepare("SELECT id FROM habits WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $_SESSION['user_id']]);
    if (!$stmt->fetch()) {
        echo json_encode(['error' => 'Habit not found or unauthorized']);
        exit;
    }

    // Delete habit (logs will be deleted via CASCADE)
    $stmt = $pdo->prepare("DELETE FROM habits WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode(['success' => 'Habit deleted successfully']);
} catch (\PDOException $e) {
    echo json_encode(['error' => 'Failed to delete habit: ' . $e->getMessage()]);
}
?>
