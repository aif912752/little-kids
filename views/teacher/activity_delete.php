<?php
include('../../config/database.php');
$id = $_GET['id'] ?? '';


if ($id) {
    // ตรวจสอบค่า $id
    var_dump($id); // เพิ่มบรรทัดนี้เพื่อตรวจสอบค่า

    // Select ข้อมูลจาก attendance
    $stmt = $connect->prepare("SELECT * FROM activity WHERE id  = ? LIMIT 1");
    $stmt->bind_param("i", $id); // "i" หมายถึง integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            // ลบข้อมูลจากตาราง attendance
            $stmt = $connect->prepare("DELETE FROM activity WHERE id  = ?");
            $stmt->bind_param("i", $id); // "i" หมายถึง integer
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "<script>
                        alert('ลบข้อมูลเรียบร้อยแล้ว');
                        window.location.href = 'eventcalendar.php';
                    </script>";
            } else {
                echo "<script>
                        alert('ไม่สามารถลบข้อมูลได้');
                        window.location.href = 'eventcalendar.php';
                    </script>";
            }
        } else {
            echo "<script>
                    alert('ไม่พบข้อมูลที่ต้องการลบ');
                    window.location.href = 'eventcalendar.php';
                </script>";
        }
    } else {
        echo "Query Error: " . $connect->error; // แสดงข้อผิดพลาดถ้าการ query มีปัญหา
    }
} else {

    echo "<script>
            alert('ไม่พบข้อมูลที่ต้องการลบ');
            window.location.href = 'eventcalendar.php';
        </script>";
}
