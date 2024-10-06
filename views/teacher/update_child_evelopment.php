<?php
include '../../config/database.php';

// รับค่าที่ส่งมาจากฟอร์ม
$id = $_POST['id'];
$weight = $_POST['weight'];
$height = $_POST['height'];

// ตรวจสอบค่าที่รับมา
echo "ID: " . $id . "<br>";
echo "Weight: " . $weight . "<br>";
echo "Height: " . $height . "<br>";

// อัพเดตข้อมูลน้ำหนักและส่วนสูงในตาราง student_measurements
$stmt = $connect->prepare("UPDATE student_measurements SET weight=?, height=? WHERE id=?");
$stmt->bind_param("ddi", $weight, $height, $id); // d = double, i = integer

if ($stmt->execute()) {
    echo "ข้อมูลถูกอัพเดตเรียบร้อยแล้ว!";
    // Redirect กลับไปที่หน้าแสดงข้อมูลนักเรียนได้
    echo "<script>window.location.href = 'child_evelopment.php';</script>";
} else {
    echo "เกิดข้อผิดพลาดในการอัพเดตข้อมูล: " . $stmt->error;
}

$stmt->close();
$connect->close();
?>
