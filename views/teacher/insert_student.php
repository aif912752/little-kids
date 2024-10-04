<?php
include('../../config/database.php');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$id_card = $_POST['id_card'] ?? ''; //ไม่ได้ใช้ตัวนี้
$birthdate = $_POST['birthdate'] ?? '';
$email = $_POST['email'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$nationality = $_POST['nationality'] ?? '';
$citizen_id = $_POST['citizen_id'] ?? '';
$religion = $_POST['religion'] ?? '';
$address = $_POST['address'] ?? '';
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
    // insert ข้อมูลลงในตาราง students
    $sql2 = "INSERT INTO students (first_name, last_name, birthdate, email, phone_number, nationality, religion, address, enrollment_date, grade_level, status, user_id) 
             VALUES ('$first_name', '$last_name', '$birthdate', '$email', '$phone_number', '$nationality', '$religion', '$address', '$enrollment_date', '$grade_level', '$status', '$last_id')";
    $result2 = $connect->query($sql2);

    if ($result2) {
        echo "<script>
                alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                window.location.href = 'admin_manage.php';
              </script>";
    } else {
        echo $connect->error;
    }
} else {
    echo $connect->error;
}
