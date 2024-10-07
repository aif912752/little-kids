<?php
include('../../config/database.php');

$evaluation_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($evaluation_id) {
    // Fetch evaluation details
    $sql = "SELECT * FROM evaluation_students WHERE evaluation_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $evaluation_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $evaluation = $result->fetch_assoc();

    // Fetch questions and answers
    $sql = "SELECT * FROM evaluation_activity_student WHERE activity_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $evaluation_id);
    $stmt->execute();
    $activities = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $questions = [];
    foreach ($activities as $activity) {
        $question = [
            'text' => $activity['evaluation_name'],
            'answers' => json_decode($activity['evaluation_score'], true)
        ];
        $questions[] = $question;
    }

    $response = [
        'evaluation_name' => $evaluation['evaluation_name'],
        'evaluation_date' => $evaluation['evaluation_date'],
        'questions' => $questions
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid evaluation ID']);
}
?>