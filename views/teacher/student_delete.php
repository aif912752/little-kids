<?php 
session_start();
include('../../config/database.php');
$id = $_GET['id'] ?? '';

if($id) {
    // Select ข้อมูลเพื่อเอา user_id ออกมา แล้วลบ user ก่อน
    $sql = "SELECT user_id FROM students WHERE student_id = $id"; // เปลี่ยนชื่อ table และ id
    $result = $connect->query($sql);
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        
        // ลบข้อมูลจากตาราง user
        $sql = "DELETE FROM user WHERE id = $user_id";
        $result = $connect->query($sql);
        
        if($result) {
            // ลบข้อมูลจากตาราง students
            $sql = "DELETE FROM students WHERE student_id = $id"; // เปลี่ยนชื่อ table และ id
            $result = $connect->query($sql);
            
            if($result) {

                //select ข้อมูลเพื่อเอา student_id ออกมา แล้ว ลบ guardian ก่อน
                $sqlselectguardian = "SELECT * FROM guardians WHERE student_id = $id";
                $resultselectguardian = $connect->query($sqlselectguardian);
                // ถ้า มีข้อมูล guardian ให้ เก็บข้อมูล user_id มา ลบ ใน ตาราง user ก่อน
                if($resultselectguardian->num_rows > 0){
                    $row = $resultselectguardian->fetch_assoc();
                    $user_id_guardian = $row['user_id'];
                    $sql = "DELETE FROM user WHERE id = $user_id_guardian";
                    $result = $connect->query($sql);

                    // ลบข้อมูล ผู้ปกครอง จากตาราง guardian
                    $sql = "DELETE FROM guardians WHERE student_id = $id"; // เปลี่ยนชื่อ table และ id
                    $result = $connect->query($sql);
                }
                
                $_SESSION['status'] = 'success';
                $_SESSION['alert'] = 'ลบข้อมูลสำเร็จ';
                echo "<script>
                        window.location.href = 'student.php';
                    </script>";
            } else {
                echo $connect->error;
                $_SESSION['status'] = 'success';
                $_SESSION['alert'] = 'ลบข้อมูลไม่สำเร็จ';
                echo "<script>
                        window.location.href = 'student.php';
                    </script>";
            }
        } else {
            echo $connect->error;
            $_SESSION['status'] = 'success';
            $_SESSION['alert'] = 'ลบข้อมูลไม่สำเร็จ';
            echo "<script>
                        window.location.href = 'student.php';
                </script>";
        }
    } else {
        echo $connect->error;
        $_SESSION['status'] = 'success';
        $_SESSION['alert'] = 'ไม่พบข้อมูลที่ต้องการลบ';
            echo "<script>
                        window.location.href = 'student.php';
                </script>";
    }         
} else {
    $_SESSION['status'] = 'success';
    $_SESSION['alert'] = 'ไม่พบข้อมูลที่ต้องการลบ';
    echo "<script>
        window.location.href = 'student.php';
    </script>";
}
?>
