<?php  
include('../../config/database.php');
$id = $_GET['id'] ?? ''; // รับค่า attendance_id จาก URL

if($id) {
    // Select ข้อมูลเพื่อลบ attendance ที่ตรงกับ attendance_id
    $sql = "SELECT student_id FROM attendance WHERE attendance_id = $id"; // เลือก student_id จากตาราง attendance
    $result = $connect->query($sql);
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $student_id = $row['student_id'];
        
        // ลบข้อมูลจากตาราง attendance
        $sql = "DELETE FROM attendance WHERE attendance_id = $id"; // ลบข้อมูลจาก attendance ที่ตรงกับ attendance_id
        $result = $connect->query($sql);
        
        if($result) {
            echo "<script>
                    alert('ลบข้อมูลการเช็คชื่อเรียบร้อยแล้ว');
                    window.location.href = 'attendance_manage.php'; // เปลี่ยนเส้นทางหลังจากลบเสร็จ
                </script>";
        } else {
            echo $connect->error;
        }
    } else {
        echo $connect->error;
        echo "<script>
                alert('ไม่พบข้อมูลที่ต้องการลบ');
                window.location.href = 'attendance_manage.php';
            </script>"; 
    }         
} else {
    echo "<script>
            alert('ไม่พบข้อมูลที่ต้องการลบ');
            window.location.href = 'attendance_manage.php';
        </script>";
}
?>
