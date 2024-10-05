<?php
include('../../config/database.php');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$citizen_id = $_POST['citizen_id'] ?? '';
$religion = $_POST['religion'] ?? '';
$enrollment_date = $_POST['enrollment_date'] ?? '';
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
    $sql2 = "INSERT INTO students (first_name, last_name, birthdate,  religion, enrollment_date,  status, user_id, citizen_id, img) 
             VALUES ('$first_name', '$last_name', '$birthdate',  '$religion', '$enrollment_date',  '$status', '$last_id', '$citizen_id', '$img_name')";
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
