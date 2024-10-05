<?php
include('../../config/database.php');

// รับค่าจากฟอร์ม
$student_id = $_POST['student_id'] ?? '';
$check_in_time = $_POST['check_in_time'] ?? '';
$check_out_time = $_POST['check_out_time'] ?? '';
$status = $_POST['status'] ?? '';
$attendance_date = date('Y-m-d'); // วันที่ปัจจุบัน

// ดึงข้อมูลชื่อและนามสกุลของนักเรียนจาก student_id
$sql_student = "SELECT first_name, last_name FROM students WHERE student_id = '$student_id'";
$result_student = $connect->query($sql_student);

if ($result_student->num_rows > 0) {
    $row = $result_student->fetch_assoc();
    $student_name = $row['first_name'];
    $student_lastname = $row['last_name'];

    // เพิ่มข้อมูลลงในตาราง attendance
    $sql = "INSERT INTO attendance (student_id, student_name, student_lastname, attendance_date, check_in_time, check_out_time, status) 
            VALUES ('$student_id', '$student_name', '$student_lastname', '$attendance_date', '$check_in_time', '$check_out_time', '$status')";
    
    $result = $connect->query($sql);

    if ($result) {
        echo "<script>
                alert('บันทึกข้อมูลการมาเรียนเรียบร้อยแล้ว');
                window.location.href = 'attendance.php'; // แก้ไขเป็นหน้าที่ต้องการให้กลับไป
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
} else {
    echo "<script>
            alert('ไม่พบข้อมูลนักเรียน');
            window.history.back();
          </script>";
}

$connect->close();
?>