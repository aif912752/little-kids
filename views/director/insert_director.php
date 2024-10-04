<?php
include('../../config/database.php');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$position = $_POST['position'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$email = $_POST['email'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';


// เช็คว่ามีข้อมูลที่ส่งมาหรือไม่
if ($username && $password && $first_name && $last_name && $position && $birthdate && $email && $phone_number) {
    // ถ้ามีข้อมูลให้ทำการเพิ่มข้อมูลลงในฐานข้อมูล

    // insert ข้อมูลลงในตาราง user
    $sql = "INSERT INTO user (username, password, name, role) VALUES ('$username', '$password', '$first_name', '2')";
    $result = $connect->query($sql);

    // select ข้อมูล user_id ที่เพิ่งเพิ่มเข้าไป
    $last_id = $connect->insert_id;
    if ($result) {
        // insert ข้อมูลลงในตาราง directors
        $sql2 = "INSERT INTO directors (first_name, last_name, birthdate, email, phone_number, position, user_id) 
                 VALUES ('$first_name', '$last_name', '$birthdate', '$email', '$phone_number', '$position', '$last_id')";
        $result2 = $connect->query($sql2);

        if ($result2) {
            echo "<script>
                    alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                    window.location.href = 'director_manage.php';
                </script>";
        } else {
            echo $connect->error;
        }
    } else {
        echo $connect->error;
    }
}
