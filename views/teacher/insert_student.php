<?php
include('../../config/database.php');

// กำหนดโฟลเดอร์ที่เก็บไฟล์รูปภาพ
$upload_dir = 'uploads/'; // เปลี่ยนเส้นทางตามที่ต้องการ

// ตรวจสอบว่าโฟลเดอร์นี้มีอยู่แล้วหรือไม่ ถ้าไม่มีก็สร้างใหม่
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true); // สร้างโฟลเดอร์พร้อมกำหนดสิทธิ์ 0777
}

// ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพหรือไม่
if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
    $img = $_FILES['img'];
    $img_name = $img['name'];
    $img_tmp_name = $img['tmp_name'];
    $img_error = $img['error'];

    $target_file = $upload_dir . basename($img_name);

    // ตรวจสอบว่าการย้ายไฟล์สำเร็จหรือไม่
    if (move_uploaded_file($img_tmp_name, $target_file)) {
        echo "Upload successful!";
    } else {
        echo "Upload failed!";
        exit;
    }
} else {
    echo "No file uploaded or file error!";
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$nationality = $_POST['nationality'] ?? '';
$citizen_id = $_POST['citizen_id'] ?? '';
$religion = $_POST['religion'] ?? '';
$enrollment_date = $_POST['enrollment_date'] ?? '';
$grade_level = $_POST['grade_level'] ?? '';
$status = $_POST['status'] ?? '';

// ใช้ citizen_id เป็น username
$username = $citizen_id;

// insert ข้อมูลลงในตาราง user
$sql = "INSERT INTO user (username, password, name, role) VALUES ('$username', '$password', '$first_name', '5')";
$result = $connect->query($sql);

// select ข้อมูล user_id ที่เพิ่งเพิ่มเข้าไป
$last_id = $connect->insert_id;
if ($result) {
    // insert ข้อมูลลงในตาราง students พร้อมกับฟิลด์ img
    $sql2 = "INSERT INTO students (first_name, last_name, birthdate, nationality, religion, enrollment_date, grade_level, status, user_id, citizen_id, img) 
             VALUES ('$first_name', '$last_name', '$birthdate', '$nationality', '$religion', '$enrollment_date', '$grade_level', '$status', '$last_id', '$citizen_id', '$img_name')";
    $result2 = $connect->query($sql2);

    if ($result2) {
        echo "<script>
                alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                window.location.href = 'student.php';
              </script>";
    } else {
        echo $connect->error;
    }
} else {
    echo $connect->error;
}
