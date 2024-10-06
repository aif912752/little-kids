<?php
// เชื่อมต่อกับฐานข้อมูล
include('../../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // เตรียมคำสั่ง SQL สำหรับบันทึกหัวข้อและคำถาม
    $sqlTopic = "INSERT INTO evaluation (evaluation_name, created_at) VALUES (?, NOW())"; 
    $sqlQuestion = "INSERT INTO evaluation_activity (activity_id, evaluation_name, evaluation_score) VALUES (?, ?, ?)";

    // เตรียม statement
    if ($stmtTopic = $connect->prepare($sqlTopic)) {
        if ($stmtQuestion = $connect->prepare($sqlQuestion)) {

            // เริ่มการวนลูปผ่าน array ของหัวข้อ
            foreach ($_POST['topics'] as $topicIndex => $topic) {
                // บันทึกหัวข้อลงในตาราง evaluation
                $evaluationName = $topic['name']; // หัวข้อประเมิน

                // bind และ execute สำหรับการเพิ่มข้อมูลหัวข้อ
                $stmtTopic->bind_param("s", $evaluationName); // ปรับให้ไม่ใช้ teacher_id
                $stmtTopic->execute();

                // ดึง id ของหัวข้อที่เพิ่งบันทึกลงไป
                $evaluationId = $connect->insert_id;

                // วนลูปคำถามภายในหัวข้อ
                foreach ($topic['questions'] as $questionIndex => $question) {
                    $questionText = $question['text']; // คำถาม
                    $answer = $question['answer']; // คำตอบที่เลือก

                    // บันทึกคำถามและคำตอบลงใน evaluation_activity
                    $stmtQuestion->bind_param("iss", $evaluationId, $questionText, $answer);
                    $stmtQuestion->execute();
                }
            }

            // ปิดการ prepare statement
            $stmtTopic->close();
            $stmtQuestion->close();

            echo "บันทึกข้อมูลเรียบร้อยแล้ว!";
        } else {
            echo "Error preparing SQL for questions: " . $connect->error;
        }
    } else {
        echo "Error preparing SQL for topics: " . $connect->error;
    }
}

$connect->close();
