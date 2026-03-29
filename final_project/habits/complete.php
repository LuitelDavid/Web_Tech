<?php
// habits/complete.php
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
$date = date('Y-m-d'); // Today's date

if (!$id) {
    echo json_encode(['error' => 'Habit ID is required']);
    exit;
}

try {
    // 1. Verify ownership of the habit
    $stmt = $pdo->prepare("SELECT id FROM habits WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $_SESSION['user_id']]);
    if (!$stmt->fetch()) {
        echo json_encode(['error' => 'Habit not found or unauthorized']);
        exit;
    }

    // 2. Check for existing completion today
    $stmt = $pdo->prepare("SELECT id FROM habit_logs WHERE habit_id = ? AND completed_date = ?");
    $stmt->execute([$id, $date]);
    $existing = $stmt->fetch();

    if ($existing) {
        // Unmark as complete
        $stmt = $pdo->prepare("DELETE FROM habit_logs WHERE id = ?");
        $stmt->execute([$existing['id']]);
        echo json_encode(['success' => true, 'action' => 'unmarked', 'date' => $date]);
    } else {
        // Mark as complete
        $stmt = $pdo->prepare("INSERT INTO habit_logs (habit_id, completed_date) VALUES (?, ?)");
        $stmt->execute([$id, $date]);
        echo json_encode(['success' => true, 'action' => 'marked', 'date' => $date]);
    }
} catch (\PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
