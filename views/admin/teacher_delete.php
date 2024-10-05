<?php 
    session_start();
    include('../../config/database.php');
    $id = $_GET['id'] ?? '';
   
        if($id){
            //select ข้อมูลเพื่อเอา user_id ออกมา แล้ว ลบ user ก่อน
            $sql = "SELECT user_id FROM teacher WHERE teacher_id = $id";
            $result = $connect->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $user_id = $row['user_id'];
                $img = $row['img'];
                if($img != null){
                    unlink('../../uploads/teacher/'.$img);
                }
                $sql = "DELETE FROM user WHERE id = $user_id";
                $result = $connect->query($sql);
                if($result){
                    // ลบข้อมูล
                    $sql = "DELETE FROM teacher WHERE teacher_id = $id";
                    $result = $connect->query($sql);
                    if($result){
                        $_SESSION['status'] = 'success';
                        $_SESSION['alert'] = 'ลบข้อมูลสำเร็จ';
                        echo "<script>
                                window.location.href = 'teacher_manage.php';
                            </script>";
                    }else{
                        echo $connect->error;
                        $_SESSION['status'] = 'error';
                        $_SESSION['alert'] = 'ลบข้อมูลไม่สำเร็จ';
                    echo "<script>
                    window.location.href = 'teacher_manage.php';
                </script>"; 
                    }
                }else{
                    echo $connect->error;
                    $_SESSION['status'] = 'error';
                    $_SESSION['alert'] = 'ลบข้อมูลไม่สำเร็จ';
                    echo "<script>
                    window.location.href = 'teacher_manage.php';
                </script>"; 
                }
            }else{
                echo $connect->error;
                $_SESSION['status'] = 'error';
                $_SESSION['alert'] = 'ไม่พบข้อมูลที่ต้องการลบ';
                echo "<script>
                        window.location.href = 'teacher_manage.php';
                    </script>"; 
            }         
        } else {
            $_SESSION['status'] = 'error';
                $_SESSION['alert'] = 'ไม่พบข้อมูลที่ต้องการลบ';
            echo "<script>
                    alert('ไม่พบข้อมูลที่ต้องการลบ');
                    window.location.href = 'teacher_manage.php';
                </script>";
        }

?>