<?php
session_start();
include('../../config/database.php');

// รับข้อมูลจากฟอร์ม
$id = $_POST['id'] ?? '';
$activity_name = $_POST['activity_name'] ?? '';
$activity_type = $_POST['activity_type'] ?? '';
$activity_description = $_POST['activity_description'] ?? '';
$activity_date_start = $_POST['activity_date_start'] ?? '';
$activity_date_end = $_POST['activity_date_end'] ?? '';

// ตรวจสอบว่ามีข้อมูลครบถ้วนหรือไม่
if (empty($id) || empty($activity_name) || empty($activity_type) || empty($activity_description) || empty($activity_date_start) || empty($activity_date_end)) {
    echo "ข้อมูลไม่ครบถ้วน";
    exit();
}

$id = intval($id); // แปลงค่า id ให้เป็นตัวเลข

// อัปเดตข้อมูลในตาราง activity
$sql = "UPDATE activity SET 
            activity_name = '$activity_name', 
            activity_type = '$activity_type', 
            activity_description = '$activity_description', 
            activity_date_start = '$activity_date_start', 
            activity_date_end = '$activity_date_end'  -- ลบ ',' ที่นี่
        WHERE id = $id";  // คำสั่ง WHERE ไม่เปลี่ยนแปลง
echo $sql; // ดู query ที่จะรัน
$result = $connect->query($sql);

if ($result) {
    $_SESSION['status'] = 'success';
    $_SESSION['alert'] = 'แก้ไขข้อมูลในตาราง activity เรียบร้อยแล้ว';
    echo "<script>window.location.href = 'activity.php';</script>"; // เปลี่ยนไปยังหน้า activity.php
} else {
    echo "Error: " . $connect->error;
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'แก้ไขข้อมูลในตาราง activity ไม่สำเร็จ';
    echo "<script>window.history.back();</script>";
}
?>
