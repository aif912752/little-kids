<?php
include('../../config/database.php');
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$position = $_POST['position'] ?? '';
$id_card = $_POST['id_card'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$email = $_POST['email'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$nationality = $_POST['nationality'] ?? '';
$citizen_id = $_POST['citizen_id'] ?? '';
$religion = $_POST['religion'] ?? '';
$address = $_POST['address'] ?? '';
// เช็คว่ามีข้อมูลที่ส่งมาหรือไม่
if ($username && $password && $first_name && $last_name && $position && $id_card && $birthdate && $email && $phone_number && $nationality && $citizen_id && $religion && $address) {
    // ถ้ามีข้อมูลให้ทำการเพิ่มข้อมูลลงในฐานข้อมูล\

    // insert ข้อมูลลงในตาราง  user
    $sql = "INSERT INTO user (username, password,name,role) VALUES ('$username', '$password','$first_name','1')";
    $result = $connect->query($sql);
    // select ข้อมูลล่าสุดที่เพิ่มเข้าไป
    $last_id = $connect->insert_id;
    if ($result) {
        // insert ข้อมูลลงในตาราง administrators
        $sql2 = "INSERT INTO administrators (first_name, last_name, position, citizen_id, birthdate, email, phone_number ,nationality, religion, address,user_id) 
        VALUES ('$first_name', '$last_name', '$position', '$citizen_id', '$birthdate', '$email', '$phone_number', '$nationality', '$religion', '$address', '$last_id')";
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

}
