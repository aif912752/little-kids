<?php
include '../../config/database.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับคำตอบจากฟอร์ม
    $answers = $_POST['answers']; // คำตอบ
    $evaluations = $_POST['evaluations']; // ค่าของ evaluation_id

    foreach ($evaluations as $evaluation_id) {
        foreach ($answers as $question_id => $score) {
            // ดึงข้อมูลที่เกี่ยวข้องกับคำถามนี้
            $sql_question_info = "SELECT id AS evaluation_activity_id FROM evaluation_activity WHERE id = ?";
            $stmt_info = $connect->prepare($sql_question_info);
            $stmt_info->bind_param("s", $question_id); // ใช้ "s" เพราะ id เป็น varchar
            $stmt_info->execute();
            $result_info = $stmt_info->get_result();
            
            if ($question_info = $result_info->fetch_assoc()) {
                $evaluation_activity_id = $question_info['evaluation_activity_id']; // ใช้ evaluation_activity_id

                // สร้างไอดีหลักใหม่
                $id = uniqid(); // หรือสามารถใช้ UUID ได้ถ้ามี

                // บันทึกข้อมูลลงในตาราง evaluation_to_activity
                $sql_insert = "INSERT INTO evaluation_to_activity (id, evaluation_id, evaluation_activity_id, total_score) VALUES (?, ?, ?, ?)";
                $stmt_insert = $connect->prepare($sql_insert);
                $stmt_insert->bind_param("ssss", $id, $evaluation_id, $evaluation_activity_id, $score);

                if (!$stmt_insert->execute()) {
                    echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $stmt_insert->error;
                }
            }
        }
    }

    // ส่งกลับหรือแสดงข้อความสำเร็จ
    echo "<script>alert('ส่งข้อมูลประเมินเรียบร้อยแล้ว!'); window.location.href = 'evaluation.php';</script>";
} else {
    // หากเข้ามาที่หน้าผ่าน GET ให้ส่งกลับไปยังหน้าแบบฟอร์ม
    header("Location: evaluation.php");
    exit();
}

// ปิดการเชื่อมต่อฐานข้อมูล
$connect->close();
?>
