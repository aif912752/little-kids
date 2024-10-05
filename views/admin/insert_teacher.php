<?php
session_start();
include('../../config/database.php');

// รับข้อมูลจากฟอร์ม
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$position = $_POST['position'] ?? '';
$email = $_POST['email'] ?? '';
$ethnicity = $_POST['ethnicity'] ?? '';
$nationality = $_POST['nationality'] ?? '';
$religion = $_POST['religion'] ?? '';
$citizen_id = $_POST['citizen_id'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$teacher_address = $_POST['teacher_address'] ?? '';
$class_taught = $_POST['class_taught'] ?? '';

// เช็คว่ามีข้อมูลที่ส่งมาหรือไม่
if (!empty($username) && !empty($password) && !empty($first_name) && !empty($last_name) && !empty($position) && !empty($email) && !empty($ethnicity) && !empty($nationality) && !empty($religion) && !empty($citizen_id) && !empty($birthdate) && !empty($phone_number) && !empty($teacher_address) && !empty($class_taught)) {

    $upload_dir = '../teacher/uploads/teacher/'; // กำหนดเส้นทางในการเก็บไฟล์อัปโหลด

    // ตรวจสอบว่าโฟลเดอร์นี้มีอยู่หรือไม่ ถ้าไม่มีก็สร้างใหม่
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); // สร้างโฟลเดอร์พร้อมกำหนดสิทธิ์ 0777
    }

    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพหรือไม่
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $img = $_FILES['img'];
        $img_name = uniqid() . '-' . basename($img['name']); // สร้างชื่อไฟล์ที่ไม่ซ้ำกัน
        $img_tmp_name = $img['tmp_name'];

        $target_file = $upload_dir . $img_name;

        // ตรวจสอบว่าการย้ายไฟล์สำเร็จหรือไม่
        if (move_uploaded_file($img_tmp_name, $target_file)) {
            echo "Upload successful!";
        } else {
            echo "Upload failed!";
            $img = ''; // ถ้าอัปโหลดไม่สำเร็จ ให้ใช้ค่าว่าง
        }
        $img = $img_name; // เก็บชื่อไฟล์ที่อัปโหลด
    } else {
        echo "No file uploaded or file error!";
        $img = ''; // ถ้าไม่มีการอัปโหลดรูปภาพ
    }
    //เช็ค username ซ้ำกับในฐานข้อมูลหรือไม่
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

    // เพิ่มข้อมูล user ในฐานข้อมูล
    $sql = "INSERT INTO user (username, password,name, role) VALUES (?, ?,?, '3')";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $first_name);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $user_id = $stmt->insert_id; // รับค่า user_id ที่เพิ่มลงในฐานข้อมูล
        // เตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูลครู

        $sql2 = "INSERT INTO teacher (first_name, last_name, position, email, ethnicity, nationality, religion, citizen_id, birthdate, phone_number, teacher_address, class_taught, img, user_id) 
VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // เตรียม statement สำหรับป้องกัน SQL Injection
        $stmt2 = $connect->prepare($sql2);

        // กำหนดจำนวนพารามิเตอร์เป็น 14 ค่า และปรับปรุงชนิดข้อมูลใน bind_param
        $stmt2->bind_param("sssssssssssssi", $first_name, $last_name, $position, $email, $ethnicity, $nationality, $religion, $citizen_id, $birthdate, $phone_number, $teacher_address, $class_taught, $img, $user_id);

        // ตรวจสอบผลลัพธ์การบันทึกข้อมูล
        if ($stmt2->execute()) {
            $_SESSION['status'] = 'success';
            $_SESSION['alert'] = 'เพิ่มข้อมูลครูเรียบร้อยแล้ว';
            echo "<script>
        window.location.href = 'teacher_manage.php';
      </script>";
        } else {
            echo "Error: " . $connect->error;
            //         $_SESSION['status'] = 'error';
            //         $_SESSION['alert'] = 'เพิ่มข้อมูลไม่สำเร็จ';
            //         echo "<script>
            //     window.history.back();
            //   </script>";
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'เพิ่มข้อมูลไม่สำเร็จ';
        echo "<script>
                window.history.back();
              </script>";
    }
} else {
    // ถ้าไม่มีข้อมูลให้แจ้งเตือน
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
    echo "<script>
            window.history.back();
          </script>";
}
