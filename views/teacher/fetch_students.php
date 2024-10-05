<?php
include '../../config/database.php';

if (isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];

    // ดึงข้อมูลนักเรียนตาม room_id
    $studentQuery = "SELECT student_id, first_name, last_name FROM students WHERE room_id = ?";
    $stmt = $connect->prepare($studentQuery);
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    // ส่งผลลัพธ์กลับในรูปแบบ JSON
    echo json_encode($students);
}
?>