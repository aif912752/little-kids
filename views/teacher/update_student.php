<?php
session_start();
include('../../config/database.php');

// รับข้อมูลจากฟอร์ม
$id = $_POST['id'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$ethnicity = $_POST['ethnicity'] ?? '';
$nationality = $_POST['nationality'] ?? '';
$religion = $_POST['religion'] ?? '';
$citizen_id = $_POST['citizen_id'] ?? '';
$enrollment_date = $_POST['enrollment_date'] ?? '';
$room_id = $_POST['room_id'] ?? '';
$old_username = $_POST['old_username'] ?? '';
$old_image = $_POST['old_image'] ?? ''; // เก็บชื่อไฟล์รูปภาพเดิม

$student_height = $_POST['student_height'] ?? '';
$student_weight = $_POST['student_weight'] ?? '';


// ตรวจสอบว่า username ซ้ำหรือไม่
if ($username != $old_username) {
    $checkUserQuery = "SELECT * FROM user WHERE username = '$username'";
    $checkUserResult = $connect->query($checkUserQuery);
    if ($checkUserResult->num_rows > 0) {
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'Username นี้ถูกใช้ไปแล้ว กรุณาใช้ username อื่น';
        echo "<script>window.history.back();</script>";
        exit();
    }
}

// อัปเดตข้อมูลในตาราง user
$sql = "UPDATE user SET username = '$username', password = '$password' WHERE id = $id";
$result = $connect->query($sql);

if ($result) {

    $upload_dir = 'uploads/'; // เปลี่ยนเส้นทางตามที่ต้องการ

    // ตรวจสอบว่าโฟลเดอร์นี้มีอยู่แล้วหรือไม่ ถ้าไม่มีก็สร้างใหม่
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); // สร้างโฟลเดอร์พร้อมกำหนดสิทธิ์ 0777
    }

    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพหรือไม่
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        // select  ข้อมูลเดิม
        $sql = "SELECT img FROM students WHERE student_id = $id";
        $result = $connect->query($sql);
        $data = $result->fetch_assoc();
        $old_img = $data['img'];
        // ทำการ ลบ รูปเดิม
        if ($old_img != '') {
            // เช็คว่าไฟล์มีอยู่หรือไม่
            if (file_exists($upload_dir . $old_img)) {
                unlink($upload_dir . $old_img);
            }
        }

        $img = $_FILES['img'];
        $img_name = uniqid() . '-' . basename($img['name']); // สร้างชื่อไฟล์ที่ไม่ซ้ำกัน
        $img_tmp_name = $img['tmp_name'];

        $target_file = $upload_dir . $img_name;

        // ตรวจสอบว่าการย้ายไฟล์สำเร็จหรือไม่
        if (move_uploaded_file($img_tmp_name, $target_file)) {
            echo "Upload successful!";
        } else {
            echo "Upload failed!";
            exit;
        }
        $imgstring = ",img = '$img_name'";
    } else {
        echo "No file uploaded or file error!";
        $imgstring = "";
    }

    // select ข้อมูลเดิม
    $sql = "SELECT * FROM students WHERE student_id = $id";
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();
    $user_id = $data['user_id'];
    // อัปเดตข้อมูลในตาราง user
    $sql = "UPDATE user SET username = '$username', password = '$password', name = '$first_name' WHERE id = $user_id";
    $result = $connect->query($sql);
    

    // อัปเดตข้อมูลในตาราง students
    $sql2 = "UPDATE students SET first_name = '$first_name', last_name = '$last_name', ethnicity = '$ethnicity', birthdate = '$birthdate', nationality = '$nationality', religion = '$religion', citizen_id = '$citizen_id' " . $imgstring . ", room_id = '$room_id', enrollment_date = '$enrollment_date' ,student_height ='$student_height',student_weight ='$student_weight'   WHERE student_id = $id";
    $result2 = $connect->query($sql2);
    // อัปเดตข้อมูลในตาราง students
    $result2 = $connect->query($sql2);
    if ($result2) {
        $_SESSION['status'] = 'success';
        $_SESSION['alert'] = 'แก้ไขข้อมูลเรียบร้อยแล้ว';
        echo "<script>window.location.href = 'student.php';</script>";
    } else {
        echo $connect->error;
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'แก้ไขข้อมูลในตาราง students ไม่สำเร็จ';
        echo "<script>window.history.back();</script>";
    }
} else {
    echo $connect->error;
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'แก้ไขข้อมูลในตาราง user ไม่สำเร็จ';
    echo "<script>window.history.back();</script>";
}
