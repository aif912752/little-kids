<?php 
session_start();
include('../../config/database.php');
$room_id = $_POST['room_id'] ?? '';
$room_name = $_POST['room_name'] ?? '';

if($room_name) {
    $sql = "UPDATE room SET room_name = '$room_name' WHERE room_id = $room_id";
    $result = $connect->query($sql);
    if($result) {
        $_SESSION['status'] = 'success';
        $_SESSION['alert'] = 'แก้ไขข้อมูลเรียบร้อยแล้ว';
        echo "<script>
                window.location.href = 'room_manage.php';
            </script>";
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'แก้ไขข้อมูลไม่สำเร็จ';
        echo "<script>
                window.history.back();
              </script>";
    }
} else {
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
    echo "<script>
            window.history.back();
          </script>";
}

?>