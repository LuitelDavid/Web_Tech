<?php
// progress/chart_data.php
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
    // 1. Get list of dates for the period
    $dates = [];
    for ($i = $period - 1; $i >= 0; $i--) {
        $dates[] = date('Y-m-d', strtotime("-$i days"));
    }

    // 2. Fetch all completions for the user's habits in this period
    // We aggregate per day (one or more habits completed = completed)
    // Or we count total completions per day.
    // The requirement says: "Aggregate per day (not per habit)"
    // and "Return dates with 0 completion (no missing days)"
    // Response format: [{"date": "YYYY-MM-DD", "completed": 1}, ...]
    
    $stmt = $pdo->prepare("
        SELECT DATE(completed_date) as c_date, COUNT(DISTINCT habit_id) as total_completed
        FROM habit_logs
        INNER JOIN habits ON habit_logs.habit_id = habits.id
        WHERE habits.user_id = ? AND habit_logs.completed_date >= ?
        GROUP BY c_date
    ");
    $start_date = $dates[0];
    $stmt->execute([$user_id, $start_date]);
    $completions = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); // Date => Count

    $chart_data = [];
    foreach ($dates as $date) {
        $chart_data[] = [
            'date' => $date,
            'completed' => isset($completions[$date]) ? (int)$completions[$date] : 0
        ];
    }

    echo json_encode(array_values($chart_data));

} catch (\PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
