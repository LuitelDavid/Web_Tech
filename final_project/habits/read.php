<?php
// habits/read.php
require_once '../config/db.php';

date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized access']);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("SELECT h.*, 
        (SELECT 1 FROM habit_logs hl WHERE hl.habit_id = h.id AND DATE(hl.completed_date) = ? LIMIT 1) as completed_today
        FROM habits h WHERE h.user_id = ?");
    $stmt->execute([$today, $user_id]);
    $habits = $stmt->fetchAll();
    
    echo json_encode(['success' => true, 'habits' => $habits ?? []]);
} catch (\PDOException $e) {
    echo json_encode(['error' => 'Failed to fetch habits: ' . $e->getMessage()]);
}
?>
