<?php
include('../../config/database.php');

// รับข้อมูลจากฟอร์ม
$student_id = $_POST['student_id'] ?? '';
$first_name = $_POST['student_name'] ?? '';
$last_name = $_POST['student_lastname'] ?? '';
$attendance_date = $_POST['attendance_date'] ?? '';
$check_in_time = $_POST['check_in_time'] ?? '';
$check_out_time = $_POST['check_out_time'] ?? '';

// ตรวจสอบว่าข้อมูลที่จำเป็นถูกส่งมาครบถ้วนหรือไม่
if ($student_id && $first_name && $last_name && $attendance_date && $check_in_time) {
    
    // insert ข้อมูลลงในตาราง attendance
    $sql = "INSERT INTO attendance (student_id, student_name, student_lastname, attendance_date, check_in_time, check_out_time) 
            VALUES ('$student_id', '$first_name', '$last_name', '$attendance_date', '$check_in_time', '$check_out_time')";
    $result = $connect->query($sql);

    if ($result) {
        echo "<script>
                alert('บันทึกข้อมูลการเช็คชื่อเรียบร้อยแล้ว');
                window.location.href = 'attendance.php';
              </script>";
    } else {
        echo $connect->error;
    }
} else {
    // แจ้งเตือนถ้าข้อมูลไม่ครบถ้วน
    echo "<script>
            alert('กรุณากรอกข้อมูลให้ครบถ้วน');
            window.history.back();
          </script>";
}
?>
