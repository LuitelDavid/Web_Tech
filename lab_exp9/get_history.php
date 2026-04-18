<?php
require_once 'db.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT expression, result, created_at FROM history ORDER BY created_at DESC LIMIT 10");
    $history = $stmt->fetchAll();
    echo json_encode($history);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
