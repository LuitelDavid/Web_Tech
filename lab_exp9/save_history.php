<?php
require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['expression']) && isset($data['result'])) {
        try {
            $stmt = $pdo->prepare("INSERT INTO history (expression, result) VALUES (?, ?)");
            $stmt->execute([$data['expression'], $data['result']]);
            echo json_encode(['status' => 'success', 'message' => 'History saved']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
