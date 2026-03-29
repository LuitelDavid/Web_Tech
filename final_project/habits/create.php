<?php
// habits/create.php
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

$user_id = $_SESSION['user_id'];
$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');

if (empty($title)) {
    echo json_encode(['error' => 'Habit title is required']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO habits (user_id, title, description) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $title, $description]);
    echo json_encode(['success' => 'Habit created successfully', 'habit_id' => $pdo->lastInsertId()]);
} catch (\PDOException $e) {
    echo json_encode(['error' => 'Failed to create habit: ' . $e->getMessage()]);
}
?>
