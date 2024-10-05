
<?php
session_start();
include('../../config/database.php');
$id = $_POST['id'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$old_username = $_POST['old_username'] ?? '';
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
$room_id = $_POST['room_id'] ?? '';

//เช็คว่ามีข้อมูลที่ส่งมาหรือไม่
if ($username && $password && $first_name && $last_name && $position && $email && $ethnicity && $nationality && $religion && $citizen_id && $birthdate && $phone_number && $teacher_address && $room_id) {    //ถ้ามี username ที่แก้ไข ไม่ซ้ำกับ username ในฐานข้อมูล ให้ทำการแก้ไขข้อมูล
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
    $upload_dir = '../teacher/uploads/teacher/'; // กำหนดเส้นทางในการเก็บไฟล์อัปโหลด

    // ตรวจสอบว่าโฟลเดอร์นี้มีอยู่แล้วหรือไม่ ถ้าไม่มีก็สร้างใหม่
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
        
        }
        $img = $img_name;
    } else {
        echo "No file uploaded or file error!";
        $img = '';
    }

        // update user
        $sql2 = "UPDATE user SET username = ?, password = ? WHERE id = ?";
        $stmt2 = $connect->prepare($sql2);
        $stmt2->bind_param('ssi', $username, $password, $id);
        $stmt2->execute();
        if($stmt2) {
            if($img != '') {
                // ถ้ามีการอัปโหลดรูปภาพ ให้ทำการอัปเดตรูปภาพด้วย
                $sql3 = "UPDATE teacher 
                         SET first_name = ?, last_name = ?, position =?, email = ?, ethnicity = ?, nationality =?, religion =?, citizen_id =?, birthdate =?, phone_number =?, teacher_address =?, room_id =?, img = ? 
                         WHERE teacher_id = ?";
                $stmt3 = $connect->prepare($sql3);
                $stmt3->bind_param('sssssssssssssi', $first_name, $last_name, $position, $email, $ethnicity, $nationality, $religion, $citizen_id, $birthdate, $phone_number, $teacher_address, $room_id, $img, $id);
            } else {
                // ถ้าไม่มีการอัปโหลดรูปภาพ ให้ทำการอัปเดตโดยไม่รวมรูปภาพ
                $sql3 = "UPDATE teacher 
                         SET first_name = ?, last_name = ?, position = ?, email = ?, ethnicity = ?, nationality = ?, religion = ?, citizen_id = ?, birthdate = ?, phone_number = ?, teacher_address = ?, room_id = ? 
                         WHERE teacher_id = ?";
                $stmt3 = $connect->prepare($sql3);
                $stmt3->bind_param('ssssssssssssi', $first_name, $last_name, $position, $email, $ethnicity, $nationality, $religion, $citizen_id, $birthdate, $phone_number, $teacher_address, $room_id, $id);
            }
           
            $stmt3->execute();
            if($stmt3->execute()) {
                $_SESSION['status'] = 'success';
                $_SESSION['alert'] = 'แก้ไขข้อมูลเรียบร้อยแล้ว';
                echo "<script>
                        window.location.href = 'teacher_manage.php';
                      </script>";
                return;
            }else{
                echo "Error: " . $connect->error;
                $_SESSION['status'] = 'error';
                $_SESSION['alert'] = 'แก้ไขข้อมูลไม่สำเร็จ';
                echo "<script>
                        window.history.back();
                      </script>";
                return;
            }
        }else{
            $_SESSION['status'] = 'error';
            $_SESSION['alert'] = 'แก้ไขข้อมูลไม่สำเร็จ';
            echo "<script>
                    window.history.back();
                  </script>";
            return;
        }
}else{
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
    echo "<script>
            window.history.back();
          </script>";
    return;
}


?>



