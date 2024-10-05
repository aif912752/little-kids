<?php
session_start();
include('../../config/database.php');
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$citizen_id = $_POST['citizen_id'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$email = $_POST['email'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$nationality = $_POST['nationality'] ?? '';
$ethnicity = $_POST['ethnicity'] ?? '';
$religion = $_POST['religion'] ?? '';
$address = $_POST['address'] ?? '';
// เช็คว่ามีข้อมูลที่ส่งมาหรือไม่
if ($username && $password && $first_name && $last_name && $citizen_id && $birthdate && $email && $phone_number && $nationality && $ethnicity && $religion && $address) {
    // ถ้ามีข้อมูลให้ทำการเพิ่มข้อมูลลงในฐานข้อมูล
    // select ข้อมูลจากตาราง user ที่มี username ซ้ำกับที่ส่งมา ถ้าซ้ำให้แจ้งเตือน
    $checkUserQuery = "SELECT * FROM user WHERE username = '$username'";
    $checkUserResult = $connect->query($checkUserQuery);
    if ($checkUserResult->num_rows > 0) {

        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'Username นี้ถูกใช้ไปแล้ว กรุณาใช้ username อื่น';
        echo "<script>       
                window.history.back();
              </script>";
    } else {
        // insert ข้อมูลลงในตาราง  user
        $sql = "INSERT INTO user (username, password,name,role) VALUES ('$username', '$password','$first_name','1')";
        $result = $connect->query($sql);
        // select ข้อมูลล่าสุดที่เพิ่มเข้าไป
        $last_id = $connect->insert_id;
        if ($result) {
            // insert ข้อมูลลงในตาราง administrators
            $sql2 = "INSERT INTO administrators (first_name, last_name, position, ethnicity, birthdate, email, phone_number ,nationality, religion, address,user_id,citizen_id) 
    VALUES ('$first_name', '$last_name', 'ผู้ดูแลระบบ', '$ethnicity', '$birthdate', '$email', '$phone_number', '$nationality', '$religion', '$address', '$last_id','$citizen_id')";
            $result2 = $connect->query($sql2);
            if ($result2) {
                $_SESSION['status'] = 'success';
                $_SESSION['alert'] = 'บันทึกข้อมูลสำเร็จ';
                echo "<script>
                
                window.location.href = 'admin_manage.php';
            </script>";
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['alert'] = 'บันทึกข้อมูลไม่สำเร็จ';
                echo "<script>
               
                window.history.back();
              </script>";
              echo $connect->error;
            }
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['alert'] = 'บันทึกข้อมูลไม่สำเร็จ';
            echo "<script>
           
            window.history.back();
            </script>";
            echo $connect->error;
        }
    }
}else{
    // ถ้าไม่มีข้อมูลให้แจ้งเตือน
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
    echo "<script>
    window.history.back();
    </script>";
}
