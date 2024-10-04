<?php 
    include('../../config/database.php');
    $id = $_GET['id'] ?? '';
   
        if($id){
            //select ข้อมูลเพื่อเอา user_id ออกมา แล้ว ลบ user ก่อน
            $sql = "SELECT user_id FROM administrators WHERE admin_id = $id";
            $result = $connect->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $user_id = $row['user_id'];
                $sql = "DELETE FROM user WHERE id = $user_id";
                $result = $connect->query($sql);
                if($result){
                    // ลบข้อมูล
                    $sql = "DELETE FROM administrators WHERE admin_id = $id";
                    $result = $connect->query($sql);
                    if($result){
                        echo "<script>
                                alert('ลบข้อมูลเรียบร้อยแล้ว');
                                window.location.href = 'admin_manage.php';
                            </script>";
                    }else{
                        echo $connect->error;
                    }
                }else{
                    echo $connect->error;
                }
            }else{
                echo $connect->error;
                echo "<script>
                        alert('ไม่พบข้อมูลที่ต้องการลบ');
                        window.location.href = 'admin_manage.php';
                    </script>"; 
            }         
        } else {
            echo "<script>
                    alert('ไม่พบข้อมูลที่ต้องการลบ');
                    window.location.href = 'admin_manage.php';
                </script>";
        }

?>