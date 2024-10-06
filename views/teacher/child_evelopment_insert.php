<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $studentId = $_POST['student_id']; // Ensure you have student_id sent from the form

    // SQL สำหรับเพิ่มข้อมูลน้ำหนักและส่วนสูง
    $sql = "INSERT INTO student_measurements (student_id, weight, height) VALUES (?, ?, ?)";

    if ($stmt = $connect->prepare($sql)) {
        // Binding parameters
        $stmt->bind_param("idd", $studentId, $weight, $height);
        if ($stmt->execute()) {
            // Show success message and redirect
            echo "<script>
                alert('บันทึกข้อมูลน้ำหนักและส่วนสูงเรียบร้อยแล้ว!');
                window.location.href = 'child_evelopment_add.php';
            </script>";
        } else {
            echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "ไม่สามารถเตรียม SQL ได้: " . $connect->error;
    }
}

$connect->close();
