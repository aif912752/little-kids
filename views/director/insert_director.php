<?php
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
    } else {
        // ถ้า username ไม่มีซ้ำ ให้ทำการเพิ่มข้อมูลลงในฐานข้อมูล

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
                echo "Error: " . $connect->error;
            }
        } else {
            echo "Error: " . $connect->error;
        }
    }
} else {
    // แจ้งเตือนถ้าข้อมูลไม่ครบ
    echo "<script>
            alert('กรุณากรอกข้อมูลให้ครบถ้วน');
            window.history.back();
          </script>";
}
