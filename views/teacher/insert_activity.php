<?php
include('../../config/database.php');

// รับค่าจากฟอร์ม
$activity_name = $_POST['activity_name'] ?? '';
$activity_type = $_POST['activity_type'] ?? '';
$activity_description = $_POST['activity_description'] ?? '';
$activity_date_start = $_POST['activity_date_start'] ?? '';
$activity_date_end = $_POST['activity_date_end'] ?? '';

// ตรวจสอบข้อมูลที่ได้รับจากฟอร์มว่าไม่เป็นค่าว่าง
if (!empty($activity_name) && !empty($activity_type) && !empty($activity_description) && !empty($activity_date_start) && !empty($activity_date_end)) {
    
    // แปลงรูปแบบวันที่จาก DD/MM/YYYY เป็น YYYY-MM-DD สำหรับ MySQL
    $activity_date_start = date('Y-m-d', strtotime(str_replace('/', '-', $activity_date_start)));
    $activity_date_end = date('Y-m-d', strtotime(str_replace('/', '-', $activity_date_end)));

    // เพิ่มข้อมูลลงในตาราง activity
    $sql = "INSERT INTO activity (activity_name, activity_type, activity_description, activity_date_start, activity_date_end) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssss", $activity_name, $activity_type, $activity_description, $activity_date_start, $activity_date_end);

    if ($stmt->execute()) {
        echo "<script>
                alert('บันทึกข้อมูลกิจกรรมเรียบร้อยแล้ว');
                window.location.href = 'eventcalendar.php';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "<script>
            alert('กรุณากรอกข้อมูลให้ครบถ้วน');
            window.history.back();
          </script>";
}

$connect->close();
?>