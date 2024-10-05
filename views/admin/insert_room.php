<?php
session_start();
include('../../config/database.php');
$room_name = $_POST['room_name'] ?? '';

if ($room_name) {
    $sql = "INSERT INTO room (room_name) VALUES ('$room_name')";
    $result = $connect->query($sql);
    if ($result) {
        $_SESSION['status'] = 'success';
        $_SESSION['alert'] = 'เพิ่มข้อมูลเรียบร้อยแล้ว';
        echo "<script>
                window.location.href = 'room_manage.php';
              </script>";
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'เพิ่มข้อมูลไม่สำเร็จ';
        echo "<script>
                window.history.back();
              </script>";
    }
    
} else {
    // ถ้าไม่มีข้อมูลให้แจ้งเตือน
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
    // echo "<script>
    //         window.history.back();
    //       </script>";
}
