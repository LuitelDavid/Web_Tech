<?php
// habits/update.php
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
$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');

if (!$id || empty($title)) {
    echo json_encode(['error' => 'ID and title are required']);
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

    $stmt = $pdo->prepare("UPDATE habits SET title = ?, description = ? WHERE id = ?");
    $stmt->execute([$title, $description, $id]);
    echo json_encode(['success' => 'Habit updated successfully']);
} catch (\PDOException $e) {
    echo json_encode(['error' => 'Failed to update habit: ' . $e->getMessage()]);
}
?>
