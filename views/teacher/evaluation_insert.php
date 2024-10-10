<?php
// เชื่อมต่อกับฐานข้อมูล
include('../../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // เตรียมคำสั่ง SQL สำหรับบันทึกหัวข้อและคำถาม
    $sqlEvaluation = "INSERT INTO evaluation (evaluation_name, score, evaluation_date, created_at, updated_at) VALUES (?, ?, NOW(), NOW(), NOW())";
    $sqlActivity = "INSERT INTO evaluation_activity (id, activity_id, evaluation_name, evaluation_score) VALUES (?, ?, ?, ?)";

    // เริ่ม transaction
    $connect->begin_transaction();

    try {
        // เตรียม statement
        $stmtEvaluation = $connect->prepare($sqlEvaluation);
        $stmtActivity = $connect->prepare($sqlActivity);

        // วนลูปผ่าน array ของหัวข้อ
        foreach ($_POST['topics'] as $topic) {
            $topicName = $topic['name']; // หัวข้อหลัก
            $totalScore = 0; // คะแนนรวมของหัวข้อนี้

            // คำนวณคะแนนรวมของหัวข้อ
            if (isset($topic['questions']) && is_array($topic['questions'])) {
                foreach ($topic['questions'] as $question) {
                    if (isset($question['answers']) && is_array($question['answers'])) {
                        foreach ($question['answers'] as $answer) {
                            if (isset($answer['score'])) {
                                $totalScore += intval($answer['score']);
                            }
                        }
                    }
                }
            }

            // แปลง $totalScore เป็น string
            $scoreStr = strval($totalScore);

            // บันทึกหัวข้อลงในตาราง evaluation
            $stmtEvaluation->bind_param("ss", $topicName, $scoreStr);
            $stmtEvaluation->execute();

            // ดึง id ของหัวข้อที่เพิ่งบันทึกลงไป (จะใช้เป็น activity_id)
            $activityId = $connect->insert_id;

            // วนลูปคำถามภายในหัวข้อ
            if (isset($topic['questions']) && is_array($topic['questions'])) {
                foreach ($topic['questions'] as $question) {
                    $questionText = $question['text'];
                    $answersWithScores = [];

                    if (isset($question['answers']) && is_array($question['answers'])) {
                        foreach ($question['answers'] as $answer) {
                            if (isset($answer['text']) && isset($answer['score'])) {
                                $answersWithScores[] = [
                                    'text' => $answer['text'],
                                    'score' => intval($answer['score'])
                                ];
                            }
                        }
                    }

                    // แปลงคำตอบและคะแนนเป็น JSON สำหรับ evaluation_score
                    $evaluationScoreJson = json_encode($answersWithScores);

                    // สร้าง unique ID สำหรับ evaluation_activity
                    $uniqueId = uniqid('eval_', true);

                    // แปลง $activityId เป็น string
                    $activityIdStr = strval($activityId);

                    // บันทึกคำถามและคำตอบลงใน evaluation_activity
                    $stmtActivity->bind_param("ssss", $uniqueId, $activityIdStr, $questionText, $evaluationScoreJson);
                    $stmtActivity->execute();
                }
            }
        }

        // Commit transaction
        $connect->commit();

        // แสดงป๊อปอัพเมื่อบันทึกสำเร็จและเปลี่ยนเส้นทางกลับไปยัง evaluation.php
        echo "<script>
       alert('บันทึกข้อมูลเรียบร้อยแล้ว!');
       window.location.href = 'evaluation.php';
     </script>";
    } catch (Exception $e) {
        // Rollback ในกรณีที่เกิดข้อผิดพลาด
        $connect->rollback();
        echo "<script>alert('เกิดข้อผิดพลาด: " . $e->getMessage() . "');</script>";
    }
    // ปิดการ prepare statement
    $stmtEvaluation->close();
    $stmtActivity->close();
}

$connect->close();
