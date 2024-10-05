<?php
session_start();
include('../../config/database.php');
$id = $_POST['id'] ?? '';
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
$old_username = $_POST['old_username'] ?? '';
$user_id = $_POST['user_id'] ?? '';

// เช็คว่ามีข้อมูลที่ส่งมาหรือไม่
if ($username && $password && $first_name && $last_name && $citizen_id && $birthdate && $email && $phone_number && $nationality && $ethnicity && $religion && $address) {
    
    // ถ้ามี username ที่แก้ไข ไม่ซ้ำกับ username ในฐานข้อมูล ให้ทำการแก้ไขข้อมูล
    if ($username != $old_username) {
        $checkUserQuery = "SELECT * FROM user WHERE username = '$username'";
        $checkUserResult = $connect->query($checkUserQuery);
        if ($checkUserResult->num_rows > 0) {
            $_SESSION['status'] = 'error';
            $_SESSION['alert'] = 'Username นี้ถูกใช้ไปแล้ว กรุณาใช้ username อื่น';
            echo "<script>
                    window.history.back();
                  </script>";
            return;
        }
    }

    // ถ้ามีข้อมูลให้ทำการแก้ไขข้อมูลลงในฐานข้อมูล
    
    // update ข้อมูลลงในตาราง  user
    $sql = "UPDATE user SET username = '$username', password = '$password' WHERE id = $user_id";
    $result = $connect->query($sql);
    if ($result) {
        // update ข้อมูลลงในตาราง administrators
        $sql2 = "UPDATE administrators SET first_name = '$first_name', last_name = '$last_name', ethnicity = '$ethnicity', birthdate = '$birthdate', email = '$email', phone_number = '$phone_number', nationality = '$nationality', religion = '$religion', address = '$address', citizen_id = '$citizen_id' WHERE admin_id = $id";
        $result2 = $connect->query($sql2);
        if ($result2) {
            $_SESSION['status'] = 'success';
            $_SESSION['alert'] = 'แก้ไขข้อมูลเรียบร้อยแล้ว';
            echo "<script>
                    window.location.href = 'admin_manage.php';
                </script>";

        } else {
            echo $connect->error;
            $_SESSION['status'] = 'error';
            $_SESSION['alert'] = 'แก้ไขข้อมูลไม่สำเร็จ';
            echo "<script>
                    window.history.back();
                  </script>";
        }
    } else {
        echo $connect->error;
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'แก้ไขข้อมูลไม่สำเร็จ';
        echo "<script>
                window.history.back();
              </script>";
    }
} else {
    // แจ้งเตือนถ้าข้อมูลไม่ครบ
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
    echo "<script>
            window.history.back();
    </script>";
}
