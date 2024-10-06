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
            $question_text = isset($question['text']) ? $question['text'] : '';

            // อัปเดตคำถาม
            $sql_question = "UPDATE evaluation_activity SET evaluation_name = ? WHERE id = ?";
            $stmt_question = $connect->prepare($sql_question);
            $stmt_question->bind_param("si", $question_text, $question_id);
            $stmt_question->execute();

            // สร้าง array สำหรับคะแนน
            $answers_array = [];
            if (isset($question['answers']) && is_array($question['answers'])) {
                foreach ($question['answers'] as $answer) {
                    // ตรวจสอบว่ามีคีย์ 'text' และ 'score' หรือไม่
                    $answer_text = isset($answer['text']) ? $answer['text'] : '';
                    $answer_score = isset($answer['score']) ? $answer['score'] : 0; // ใช้ค่า 0 หากไม่มีคะแนน

                    $answers_array[] = [
                        'text' => $answer_text,
                        'score' => $answer_score
                    ];
                }
            }

            // แปลง array เป็น JSON
            $answers_json = json_encode($answers_array);

            // อัปเดตคะแนนในตาราง evaluation_activity
            $sql_update_score = "UPDATE evaluation_activity SET evaluation_score = ? WHERE id = ?";
            $stmt_update_score = $connect->prepare($sql_update_score);
            $stmt_update_score->bind_param("si", $answers_json, $question_id);
            $stmt_update_score->execute();
        }
// แจ้งผลการอัปเดต
echo "<script>
alert('อัปเดตข้อมูลแบบประเมินเรียบร้อยแล้ว');
window.location.href = 'evaluation.php'; // เปลี่ยนเส้นทางไปยัง evaluation.php
</script>";
} else {
echo "<p class='text-red-500'>เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . $stmt->error . "</p>";
}

    $stmt->close();
}

$connect->close();
?>