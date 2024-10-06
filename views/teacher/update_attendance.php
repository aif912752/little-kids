<?php
session_start();
include('../../config/database.php');

// รับข้อมูลจากฟอร์ม
$id = $_POST['id'] ?? '';

$student_name = $_POST['student_name'] ?? '';
$student_lastname =  $_POST['student_lastname'] ?? '';

$status = $_POST['status'] ?? '';



// ตรวจสอบว่ามีข้อมูลครบถ้วนหรือไม่
if (empty($id) ||  empty($status)) {
    echo "ข้อมูลไม่ครบถ้วน";
    exit();
}


$id = intval($id); // แปลงค่า id ให้เป็นตัวเลข

// อัปเดตข้อมูลในตาราง attendance
$sql = "UPDATE attendance SET  status = '$status', student_name = '$student_name' WHERE attendance_id = $id";
echo $sql; // ดู query ที่จะรัน
$result = $connect->query($sql);

if ($result) {
    $_SESSION['status'] = 'success';
    $_SESSION['alert'] = 'แก้ไขข้อมูลในตาราง attendance เรียบร้อยแล้ว';
    echo "<script>window.location.href = 'attendance.php';</script>";
} else {
    echo "Error: " . $connect->error;
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'แก้ไขข้อมูลในตาราง attendance ไม่สำเร็จ';
    echo "<script>window.history.back();</script>";
}
