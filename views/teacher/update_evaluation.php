<?php
// เชื่อมต่อกับฐานข้อมูล
include('../../config/database.php');

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ดึงข้อมูลที่ส่งมาจากฟอร์ม
    $evaluation_id = $_POST['evaluation_id'];
    $evaluation_name = $_POST['evaluation_name'];
    $questions = $_POST['questions'];

    // อัปเดตข้อมูลแบบประเมิน
    $sql = "UPDATE evaluation SET evaluation_name = ? WHERE evaluation_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("si", $evaluation_name, $evaluation_id);
    
    if ($stmt->execute()) {
        // อัปเดตข้อมูลกิจกรรม (คำถามและคำตอบ)
        foreach ($questions as $question_id => $question) {
            $question_text = $question['text'];

            // อัปเดตคำถาม
            $sql_question = "UPDATE evaluation_activity SET evaluation_name = ? WHERE id = ?";
            $stmt_question = $connect->prepare($sql_question);
            $stmt_question->bind_param("si", $question_text, $question_id);
            $stmt_question->execute();

            // อัปเดตคำตอบ
            foreach ($question['answers'] as $answer_id => $answer) {
                $answer_text = $answer['text'];
                $answer_score = $answer['score'];

                // อัปเดตคำตอบ
                $sql_answer = "UPDATE evaluation_answer SET text = ?, score = ? WHERE id = ?";
                $stmt_answer = $connect->prepare($sql_answer);
                $stmt_answer->bind_param("sii", $answer_text, $answer_score, $answer_id);
                $stmt_answer->execute();
            }
        }
        echo "<p class='text-green-500'>อัปเดตข้อมูลแบบประเมินเรียบร้อยแล้ว</p>";
    } else {
        echo "<p class='text-red-500'>เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$connect->close();
?>
