<?php 
    include('../../config/database.php');
    $id = $_GET['id'] ?? '';
   
    if($id) {
        // select ข้อมูลเพื่อเอา user_id ออกมา แล้วลบ user ก่อน
        $sql = "SELECT user_id FROM directors WHERE director_id = $id";
        $result = $connect->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            
            // ลบข้อมูลในตาราง user
            $sql = "DELETE FROM user WHERE id = $user_id";
            $result = $connect->query($sql);

            if($result) {
                // ลบข้อมูลในตาราง directors
                $sql = "DELETE FROM directors WHERE director_id = $id";
                $result = $connect->query($sql);

                if($result) {
                    echo "<script>
                            alert('ลบข้อมูลเรียบร้อยแล้ว');
                            window.location.href = 'director_manage.php';
                          </script>";
                } else {
                    echo $connect->error;
                }
            } else {
                echo $connect->error;
            }
        } else {
            echo "<script>
                    alert('ไม่พบข้อมูลที่ต้องการลบ');
                    window.location.href = 'director_manage.php';
                  </script>"; 
        }
    } else {
        echo "<script>
                alert('ไม่พบข้อมูลที่ต้องการลบ');
                window.location.href = 'director_manage.php';
              </script>";
    }
?>
