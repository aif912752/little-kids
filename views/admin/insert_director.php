<?php
session_start();
include('../../config/database.php');

// รับข้อมูลจากแบบฟอร์ม
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$position = $_POST['position'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$email = $_POST['email'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';

// เช็คว่ามีข้อมูลที่ส่งมาครบถ้วนหรือไม่
if ($username && $password && $first_name && $last_name && $position && $birthdate && $email && $phone_number) {

    // ตรวจสอบว่ามี username ซ้ำในฐานข้อมูลหรือไม่
    $checkUserQuery = "SELECT * FROM user WHERE username = '$username'";
    $checkUserResult = $connect->query($checkUserQuery);

    if ($checkUserResult->num_rows > 0) {
        // ถ้ามี username ซ้ำ ให้แสดงข้อความแจ้งเตือน
        echo "<script>
                alert('Username นี้ถูกใช้ไปแล้ว กรุณาใช้ username อื่น');
                window.history.back();
              </script>";
        return;
    } else {
        // ถ้า username ไม่มีซ้ำ ให้ทำการเพิ่มข้อมูลลงในฐานข้อมูล

        // insert ข้อมูลลงในตาราง user
        $sql = "INSERT INTO user (username, password, name, role) VALUES ('$username', '$password', '$first_name', '2')";
        $result = $connect->query($sql);

        // select ข้อมูล user_id ที่เพิ่งเพิ่มเข้าไป
        $last_id = $connect->insert_id;

        if ($result) {
            // insert ข้อมูลลงในตาราง director
            $sql2 = "INSERT INTO director (first_name, last_name, birthdate, email, phone_number, position, user_id) 
                     VALUES ('$first_name', '$last_name', '$birthdate', '$email', '$phone_number', '$position', '$last_id')";
            $result2 = $connect->query($sql2);

            if ($result2) {
                $_SESSION['status'] = 'success';
                $_SESSION['alert'] = 'บันทึกข้อมูลสำเร็จ';
                echo "<script>
                        window.location.href = 'director_manage.php';
                      </script>";
            } else {
                echo "Error: " . $connect->error;
                // ถ้าไม่มีข้อมูลให้แจ้งเตือน
                $_SESSION['status'] = 'error';
                $_SESSION['alert'] = 'บันทึกข้อมูลไม่สำเร็จ';
                echo "<script>
                    window.history.back();
                </script>";
            }
        } else {
            echo "Error: " . $connect->error;
            // ถ้าไม่มีข้อมูลให้แจ้งเตือน
            $_SESSION['status'] = 'error';
            $_SESSION['alert'] = 'บันทึกข้อมูลไม่สำเร็จ';
            echo "<script>
                window.history.back();
            </script>";
        }
    }
} else {
   // ถ้าไม่มีข้อมูลให้แจ้งเตือน
   $_SESSION['status'] = 'error';
   $_SESSION['alert'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
   echo "<script>
    window.history.back();
   </script>";
}
