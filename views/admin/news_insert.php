<?php
session_start();
include('../../config/database.php');

$title = $_POST['title'] ?? '';
$details = $_POST['details'] ?? '';

// ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
if (empty($title) || empty($details)) {
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'กรอกข้อมูลไม่ครบ';
    echo "<script>window.history.back();</script>";
    exit;
}

$upload_dir = 'uploads/'; // เปลี่ยนเส้นทางตามที่ต้องการ

// ตรวจสอบว่าโฟลเดอร์นี้มีอยู่แล้วหรือไม่ ถ้าไม่มีก็สร้างใหม่
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true); // สร้างโฟลเดอร์พร้อมกำหนดสิทธิ์ 0777
}

$img_name = null;

// ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพหรือไม่
if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
    $img = $_FILES['img'];
    $img_name = uniqid() . '-' . basename($img['name']); // สร้างชื่อไฟล์ที่ไม่ซ้ำกัน
    $img_tmp_name = $img['tmp_name'];

    $target_file = $upload_dir . $img_name;

    // ตรวจสอบว่าการย้ายไฟล์สำเร็จหรือไม่
    if (!move_uploaded_file($img_tmp_name, $target_file)) {
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'ไม่สามารถอัปโหลดรูปภาพได้';
        echo "<script>window.history.back();</script>";
        exit;
    }
}

// เตรียม SQL statement สำหรับการ insert ข้อมูล
$sql = "INSERT INTO news (title, details, img) VALUES (?, ?, ?)";
$stmt = $connect->prepare($sql);
$stmt->bind_param("sss", $title, $details, $img_name);

// ทำการ execute statement
if ($stmt->execute()) {
    $_SESSION['status'] = 'success';
    $_SESSION['alert'] = 'บันทึกข้อมูลข่าวสำเร็จ';
    echo "<script>window.location.href = 'news.php';</script>";
} else {
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'ไม่สามารถบันทึกข้อมูลได้';
    echo "<script>window.history.back();</script>";
}

$stmt->close();
$connect->close();
?>