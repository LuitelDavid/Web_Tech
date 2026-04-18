<?php
require_once '../db.php';
session_start();

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

// Helper to check session
function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }
}

switch ($method) {
    case 'GET':
        // Fetch all messages with user names
        try {
            $stmt = $pdo->query("SELECT m.id, m.content, m.created_at, m.user_id, u.name as user_name 
                                 FROM messages m 
                                 JOIN users u ON m.user_id = u.id 
                                 ORDER BY m.created_at DESC");
            $messages = $stmt->fetchAll();
            echo json_encode($messages);
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case 'POST':
        checkAuth();
        $data = json_decode(file_get_contents('php://input'), true);
        $content = trim($data['content'] ?? '');

        if (empty($content)) {
            echo json_encode(['error' => 'Message content cannot be empty']);
            exit;
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO messages (user_id, content) VALUES (?, ?)");
            $stmt->execute([$_SESSION['user_id'], $content]);
            echo json_encode(['success' => 'Message posted']);
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case 'DELETE':
        checkAuth();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode(['error' => 'Message ID required']);
            exit;
        }

        try {
            // Check ownership
            $stmt = $pdo->prepare("SELECT user_id FROM messages WHERE id = ?");
            $stmt->execute([$id]);
            $msg = $stmt->fetch();

            if ($msg && $msg['user_id'] == $_SESSION['user_id']) {
                $stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
                $stmt->execute([$id]);
                echo json_encode(['success' => 'Message deleted']);
            } else {
                echo json_encode(['error' => 'Unauthorized to delete this message']);
            }
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(['error' => 'Invalid method']);
        break;
}
?>
