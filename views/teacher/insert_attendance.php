<?php
include('../../config/database.php');

// ตั้งค่า Time Zone ให้เป็น Asia/Bangkok
date_default_timezone_set('Asia/Bangkok');

// รับค่าจากฟอร์ม
$status_data = $_POST['status'] ?? [];
$attendance_date = $_POST['attendance_date'] ?? date('Y-m-d');
$note_data = $_POST['note'] ?? []; // เก็บข้อมูลหมายเหตุ

// ตรวจสอบว่ามีข้อมูลการเข้าเรียนถูกส่งมาหรือไม่
if (!empty($status_data)) {
    $success_count = 0;
    $error_count = 0;

    foreach ($status_data as $student_id => $status) {
        echo "Processing student_id: $student_id, status: $status<br>";

        // ดึงข้อมูลชื่อและนามสกุลของนักเรียนจาก student_id
        $sql_student = "SELECT first_name, last_name FROM students WHERE student_id = ?";
        $stmt = $connect->prepare($sql_student);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result_student = $stmt->get_result();

        if ($result_student->num_rows > 0) {
            $row = $result_student->fetch_assoc();
            $student_name = $row['first_name'];
            $student_lastname = $row['last_name'];
            
            // รับหมายเหตุสำหรับนักเรียน
        $note = $note_data[$student_id] ?? ''; // ถ้าไม่มีหมายเหตุให้ใช้ค่าว่าง
        

            // เพิ่มข้อมูลลงในตาราง attendance
            $sql = "INSERT INTO attendance (student_id, student_name, student_lastname, attendance_date, status, note) 
                VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("ssssss", $student_id, $student_name, $student_lastname, $attendance_date, $status, $note);
            
            if ($stmt->execute()) {
                $success_count++;
                echo "Inserted successfully for student_id: $student_id<br>";
            } else {
                $error_count++;
                echo "Error inserting for student_id: $student_id. Error: " . $stmt->error . "<br>";
            }
        } else {
            $error_count++;
            echo "Student not found for student_id: $student_id<br>";
        }
    }

    echo "Total success: $success_count, Total errors: $error_count<br>";

    if ($error_count == 0) {
        echo "<script>
                alert('บันทึกข้อมูลการมาเรียนเรียบร้อยแล้วทั้งหมด {$success_count} รายการ');
                window.location.href = 'attendance.php';
              </script>";
    } else {
        echo "<script>
                alert('บันทึกข้อมูลสำเร็จ {$success_count} รายการ และไม่สำเร็จ {$error_count} รายการ');
                window.location.href = 'attendance.php';
              </script>";
    }
} else {
    echo "ไม่ได้รับข้อมูลการเข้าเรียน (status_data is empty)<br>";
    echo "<script>
            alert('ไม่ได้รับข้อมูลการเข้าเรียน');
            window.history.back();
          </script>";
}

$connect->close();
?>