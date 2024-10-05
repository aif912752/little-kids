<?php
include('../../config/database.php');
$id = $_GET['id'] ?? '';

if ($id) {
    // Select ข้อมูลเพื่อเอา user_id ออกมา แล้วลบ user ก่อน
    $sql = "SELECT user_id FROM students WHERE student_id = $id"; // เปลี่ยนชื่อ table และ id
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        // ลบข้อมูลจากตาราง user
        $sql = "DELETE FROM user WHERE id = $user_id";
        $result = $connect->query($sql);

        if ($result) {
            // ลบข้อมูลจากตาราง attendance
            $sql = "DELETE FROM attendance WHERE attendance_id  = $id"; // เปลี่ยนชื่อ table และ id
            $result = $connect->query($sql);

            if ($result) {
                echo "<script>
                        alert('ลบข้อมูลเรียบร้อยแล้ว');
                        window.location.href = 'attendance.php';
                    </script>";
            } else {
                echo $connect->error;
            }
        } else {
            echo $connect->error;
        }
    } else {
        echo $connect->error;
        echo "<script>
                alert('ไม่พบข้อมูลที่ต้องการลบ');
                window.location.href = 'attendance.php';
            </script>";
    }
} else {
    echo "<script>
            alert('ไม่พบข้อมูลที่ต้องการลบ');
            window.location.href = 'attendance.php';
        </script>";
}
