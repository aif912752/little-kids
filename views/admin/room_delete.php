<?php 
session_start();
include('../../config/database.php');
$id = $_GET['id'] ?? '';
if ($id) {
    $sql = "DELETE FROM room WHERE room_id = $id";
    $result = $connect->query($sql);
    if ($result) {
        $_SESSION['status'] = 'success';
        $_SESSION['alert'] = 'ลบข้อมูลสำเร็จ';
        echo "<script>
               
                window.location = 'room_manage.php';
              </script>";
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'เกิดข้อผิดพลาด';
        echo "<script>
               
                window.history.back();
              </script>";
    }
} else {
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'ไม่พบข้อมูลที่ต้องการลบ';
    echo "<script>
           
            window.history.back();
          </script>";
}
?>