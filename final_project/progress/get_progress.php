<?php
// progress/get_progress.php
require_once '../config/db.php';

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized access']);
    exit;
}

$user_id = $_SESSION['user_id'];
$period = isset($_GET['period']) ? (int)$_GET['period'] : 7; // Default 7 days

try {
    // 1. Fetch habits
    $stmt = $pdo->prepare("SELECT id, title FROM habits WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $habits = $stmt->fetchAll();

    $results = [];

    foreach ($habits as $habit) {
        $habit_id = $habit['id'];

        // Streak Calculation
        $stmt_logs = $pdo->prepare("SELECT completed_date FROM habit_logs WHERE habit_id = ? ORDER BY completed_date DESC");
        $stmt_logs->execute([$habit_id]);
        $logs = $stmt_logs->fetchAll(PDO::FETCH_COLUMN);

        $streak = 0;
        if (!empty($logs)) {
            $today = date('Y-m-d');
            $yesterday = date('Y-m-d', strtotime('-1 day'));
            
            // Start checking from the most recent log
            $current_date = $logs[0];
            
            // A streak is active if the last log was today or yesterday
            if ($current_date === $today || $current_date === $yesterday) {
                $streak = 1;
                for ($i = 0; $i < count($logs) - 1; $i++) {
                    $date1 = new DateTime($logs[$i]);
                    $date2 = new DateTime($logs[$i+1]);
                    $diff = $date1->diff($date2)->days;
                    
                    if ($diff === 1) {
                        $streak++;
                    } else {
                        break;
                    }
                }
            }
        }

        // Progress Calculation (Completed Days / Total Days in period)
        $start_date = date('Y-m-d', strtotime("-$period days"));
        $stmt_count = $pdo->prepare("SELECT COUNT(*) FROM habit_logs WHERE habit_id = ? AND completed_date >= ?");
        $stmt_count->execute([$habit_id, $start_date]);
        $completed_days = $stmt_count->fetchColumn();
        
        $progress = round(($completed_days / $period) * 100, 1);

        $results[] = [
            'id' => $habit_id,
            'title' => $habit['title'],
            'streak' => $streak,
            'progress' => $progress,
            'completed_days' => $completed_days,
            'total_days' => $period
        ];
    }

    echo json_encode(['success' => true, 'data' => $results]);

} catch (\PDOException $e) {
    echo json_encode(['error' => 'Failed to calculate progress: ' . $e->getMessage()]);
}
?>
