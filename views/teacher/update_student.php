<?php
session_start();
include('../../config/database.php');

// รับข้อมูลจากฟอร์ม
$id = $_POST['id'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$citizen_id = $_POST['citizen_id'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$nationality = $_POST['nationality'] ?? '';
$ethnicity = $_POST['ethnicity'] ?? '';
$religion = $_POST['religion'] ?? '';
$old_username = $_POST['old_username'] ?? '';

// ตรวจสอบว่า username ซ้ำหรือไม่
if ($username != $old_username) {
    $checkUserQuery = "SELECT * FROM user WHERE username = '$username'";
    $checkUserResult = $connect->query($checkUserQuery);
    if ($checkUserResult->num_rows > 0) {
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'Username นี้ถูกใช้ไปแล้ว กรุณาใช้ username อื่น';
        return;
    }
}

$sql = "UPDATE user SET username = '$username', password = '$password' WHERE id = $id";
$result = $connect->query($sql);

if ($result) {
    // อัปเดตข้อมูลในตาราง students
    $sql2 = "UPDATE students SET first_name = '$first_name', last_name = '$last_name', ethnicity = '$ethnicity', birthdate = '$birthdate', nationality = '$nationality', religion = '$religion', citizen_id = '$citizen_id' WHERE student_id = $id";
    $result2 = $connect->query($sql2);

    if ($result2) {
        $_SESSION['status'] = 'success';
        $_SESSION['alert'] = 'แก้ไขข้อมูลเรียบร้อยแล้ว';
        echo "<script>
                window.location.href = 'student.php';
            </script>";
    } else {
        echo $connect->error;
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'แก้ไขข้อมูลในตาราง students ไม่สำเร็จ';
            echo "<script>
                    window.history.back();
                  </script>";
    }
} else {
    echo $connect->error;
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'แก้ไขข้อมูลในตาราง user ไม่สำเร็จ';
    echo "<script>
            window.history.back();
          </script>";
}
