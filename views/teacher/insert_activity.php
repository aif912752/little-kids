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
    
    // เพิ่มข้อมูลลงในตาราง activity
    $sql = "INSERT INTO activity (activity_name, activity_type, activity_description, activity_date_start, activity_date_end) 
            VALUES ('$activity_name', '$activity_type', '$activity_description', '$activity_date_start', '$activity_date_end')";

    if ($connect->query($sql) === TRUE) {
        echo "<script>
                alert('บันทึกข้อมูลกิจกรรมเรียบร้อยแล้ว');
                window.location.href = 'activity.php'; // แก้ไขเป็นหน้าที่ต้องการให้กลับไป
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }

} else {
    echo "<script>
            alert('กรุณากรอกข้อมูลให้ครบถ้วน');
            window.history.back();
          </script>";
}

$connect->close();
?>
