<?php
session_start();
include('../../config/database.php');
$id = $_GET['id'] ?? '';
$room_id = $_GET['room_id'] ?? '';
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
            // ลบข้อมูลจากตาราง students
            $sql = "DELETE FROM students WHERE student_id = $id"; // เปลี่ยนชื่อ table และ id
            $result = $connect->query($sql);

            if ($result) {
                // ลบข้อมูล ผู้ปกครอง จากตาราง guardian
                $sql = "DELETE FROM guardians WHERE student_id = $id"; // เปลี่ยนชื่อ table และ id
                $result = $connect->query($sql);
                $_SESSION['status'] = 'success';
                $_SESSION['alert'] = 'ลบข้อมูลสำเร็จ';
                echo "<script>
                        window.location.href = 'room_view.php?id=".$room_id."';
                    </script>";
            } else {
                echo $connect->error;
                $_SESSION['status'] = 'success';
                $_SESSION['alert'] = 'ลบข้อมูลไม่สำเร็จ';
                echo "<script>
                        window.location.href = 'room_view.php?id=".$room_id."';
                    </script>";
            }
        } else {
            echo $connect->error;
            $_SESSION['status'] = 'success';
            $_SESSION['alert'] = 'ลบข้อมูลไม่สำเร็จ';
            echo "<script>
                        window.location.href = 'room_view.php?id=".$room_id."';
                </script>";
        }
    } else {
        echo $connect->error;
        $_SESSION['status'] = 'success';
        $_SESSION['alert'] = 'ไม่พบข้อมูลที่ต้องการลบ';
        echo "<script>
                        window.location.href = 'room_view.php?id=".$room_id."';
                </script>";
    }
} else {
    $_SESSION['status'] = 'success';
    $_SESSION['alert'] = 'ไม่พบข้อมูลที่ต้องการลบ';
    echo "<script>
        window.location.href = 'room_view.php?id=".$room_id."';
    </script>";
}
