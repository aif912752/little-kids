<?php
session_start();
include('../../config/database.php');

$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$citizen_id = $_POST['citizen_id'] ?? '';
$religion = $_POST['religion'] ?? '';
$enrollment_date = $_POST['enrollment_date'] ?? '';
$status = $_POST['status'] ?? '';
$room_id = $_POST['room_id'] ?? '';
$gender = $_POST['gender'] ?? '';
$ethnicity = $_POST['ethnicity'] ?? '';
$nationality = $_POST['nationality'] ?? '';

$student_height = $_POST['student_height'] ?? '';
$student_weight = $_POST['student_weight'] ?? '';

// ผู้ปกครอง
// $username_guardian = $_POST['username_guardian'] ?? '';
// $password_guardian = $_POST['password_guardian'] ?? '';
$first_name_guardian = $_POST['first_name_guardian'] ?? '';
$last_name_guardian = $_POST['last_name_guardian'] ?? '';
$phone_number_guardian = $_POST['phone_number_guardian'] ?? '';
$gender_guardian = $_POST['gender_guardian'] ?? '';
$relation_to_student = $_POST['relation_to_student'] ?? '';
$address_guardian = $_POST['address_guardian'] ?? '';


// ใช้ citizen_id เป็น username
$username = $citizen_id;
$password = $citizen_id;
// ตรวจสอบว่ามี username ซ้ำกันหรือไม่
$sql_check = "SELECT * FROM user WHERE username = '$username'";
$result_check = $connect->query($sql_check);
if ($result_check->num_rows > 0) {
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'มีข้อมูลนักเรียนนี้อยู่ในระบบแล้ว';
    echo "<script>
    window.history.back();
    </script>";
    exit;
}


// ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
if (empty($first_name) || empty($last_name) || empty($birthdate)  || empty($citizen_id) || empty($religion) || empty($enrollment_date) || empty($status) || empty($room_id) || empty($ethnicity) || empty($nationality) || empty($student_height) || empty($student_weight) ||  empty($first_name_guardian) || empty($last_name_guardian) || empty($phone_number_guardian) || empty($gender_guardian) || empty($relation_to_student) || empty($address_guardian)) {
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'กรอกข้อมูลไม่ครบ';
    echo "<script>
    window.history.back();
    </script>";
    exit;
}



$upload_dir = 'uploads/'; // เปลี่ยนเส้นทางตามที่ต้องการ

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
        exit;
    }
} else {
    echo "No file uploaded or file error!";
}



// insert ข้อมูลลงในตาราง user
$sql = "INSERT INTO user (username, password, name, role) VALUES ('$username', '$password', '$first_name', '4')";
$result = $connect->query($sql);

// select ข้อมูล user_id ที่เพิ่งเพิ่มเข้าไป
$last_id = $connect->insert_id;
if ($result) {
    // insert ข้อมูลลงในตาราง students พร้อมกับฟิลด์ img
    $sql2 = "INSERT INTO students (first_name, last_name, birthdate,  religion, enrollment_date,  status, user_id, citizen_id, img,room_id,ethnicity,nationality,student_height,student_weight,gender) 
             VALUES ('$first_name', '$last_name', '$birthdate',  '$religion', '$enrollment_date',  '$status', '$last_id', '$citizen_id', '$img_name','$room_id','$ethnicity','$nationality','$student_height','$student_weight','$gender')";
    $result2 = $connect->query($sql2);

    if ($result2) {
        $last_student_id = $connect->insert_id;
            // insert ข้อมูลลงในตาราง guardians
            $sql4 = "INSERT INTO guardians (first_name, last_name, phone_number,gender,relation_to_student,address,student_id) 
                     VALUES ('$first_name_guardian', '$last_name_guardian', '$phone_number_guardian','$gender_guardian','$relation_to_student','$address_guardian','$last_student_id')";
            $result4 = $connect->query($sql4);
            if ($result4) {
                // เอา id ของ guardians ที่เพิ่งเพิ่มเข้าไป
                $last_id_guardian = $connect->insert_id;
                // ข้อมูล guardians ถูกเพิ่มเข้าไปแล้ว ทำการ update student_id ในตาราง students
                $sql5 = "UPDATE guardians SET student_id = '$last_student_id' WHERE guardian_id = '$last_id_guardian'";
                $result5 = $connect->query($sql5);
                if($result5){
                    $_SESSION['status'] = 'success';
                    $_SESSION['alert'] = 'บันทึกข้อมูลนักเรียนสำเร็จ';
                    echo "<script>      
                        window.location.href = 'student.php';
                      </script>";
                }else{
                    $_SESSION['status'] = 'error';
                    $_SESSION['alert'] = 'ไม่สามารถบันทึกข้อมูลได้ ส่วนเพิ่ม guardians ผู้ปกครอง';
                    echo "<script>
                    window.history.back();
                    </script>";
                }
               
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['alert'] = 'ไม่สามารถบันทึกข้อมูลได้ ส่วนเพิ่ม guardians ผู้ปกครอง';
                echo "<script>
            window.history.back();
            </script>";
                echo $connect->error;
            }
        
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'ไม่สามารถบันทึกข้อมูลได้';
        echo "<script>
    window.history.back();
    </scrip>";
        echo $connect->error;
    }
} else {
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'กรอกข้อมูลไม่ครบ';
    echo "<script>
window.history.back();
</script>";
    echo $connect->error;
}

?>