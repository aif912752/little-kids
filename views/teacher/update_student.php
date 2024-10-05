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
$grade_level = $_POST['grade_level'] ?? '';
$old_username = $_POST['old_username'] ?? '';
$old_image = $_POST['old_image'] ?? ''; // เก็บชื่อไฟล์รูปภาพเดิม

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
    // การจัดการการอัปโหลดไฟล์รูปภาพ
    $image = $_FILES['image']['name'] ?? ''; // รับชื่อไฟล์รูปภาพ
    $image_tmp = $_FILES['image']['tmp_name'] ?? ''; // รับไฟล์ชั่วคราว

    // ถ้ามีการอัปโหลดรูปภาพใหม่
    if (!empty($image)) {
        // กำหนดโฟลเดอร์ที่จะเก็บรูปภาพ
        $upload_directory = 'uploads/';
        $image_path = $upload_directory . basename($image);

        // อัปโหลดไฟล์รูปภาพ
        if (move_uploaded_file($image_tmp, $image_path)) {
            // ถ้าอัปโหลดไฟล์สำเร็จ อัปเดตฟิลด์ img ในตาราง students
            $sql2 = "UPDATE students SET first_name = '$first_name', last_name = '$last_name', ethnicity = '$ethnicity', birthdate = '$birthdate', nationality = '$nationality', religion = '$religion', citizen_id = '$citizen_id', enrollment_date = '$enrollment_date', grade_level = '$grade_level', img = '$image' WHERE student_id = $id";
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['alert'] = 'ไม่สามารถอัปโหลดรูปภาพได้';
            echo "<script>window.history.back();</script>";
            exit();
        }
    } else {
        // ถ้าไม่มีการอัปโหลดรูปภาพ จะใช้ชื่อไฟล์เดิม
        $sql2 = "UPDATE students SET first_name = '$first_name', last_name = '$last_name', ethnicity = '$ethnicity', birthdate = '$birthdate', nationality = '$nationality', religion = '$religion', citizen_id = '$citizen_id', enrollment_date = '$enrollment_date', grade_level = '$grade_level', img = '$old_image' WHERE student_id = $id";
    }

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
