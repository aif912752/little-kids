<?php 
    session_start();
    include('../../config/database.php');
    $id = $_POST['id'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $old_username = $_POST['old_username'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $user_id = $_POST['user_id'] ?? '';

    if($username && $password && $first_name && $last_name && $position && $birthdate && $email && $phone_number) {
        if($username != $old_username) {
            $checkUserQuery = "SELECT * FROM user WHERE username = '$username'";
            $checkUserResult = $connect->query($checkUserQuery);
            if($checkUserResult->num_rows > 0) {
                $_SESSION['status'] = 'error';
                $_SESSION['alert'] = 'Username นี้ถูกใช้ไปแล้ว กรุณาใช้ username อื่น';
                echo "<script>
                        window.history.back();
                      </script>";
                return;
            }
        }

        $sql = "UPDATE user SET username = '$username', password = '$password' WHERE id = $user_id";
        $result = $connect->query($sql);
        if($result) {
            $sql2 = "UPDATE director SET first_name = '$first_name', last_name = '$last_name', birthdate = '$birthdate', email = '$email', phone_number = '$phone_number', position = '$position' WHERE director_id = $id";
            $result2 = $connect->query($sql2);
            if($result2) {
                $_SESSION['status'] = 'success';
                $_SESSION['alert'] = 'แก้ไขข้อมูลเรียบร้อยแล้ว';
                echo "<script>
                        window.location.href = 'director_manage.php';
                      </script>";
            } else {
                echo $connect->error;
                $_SESSION['status'] = 'error';
                $_SESSION['alert'] = 'แก้ไขข้อมูลไม่สำเร็จ';
                echo "<script>
                        window.history.back();
                      </script>";
            }
        } else {
            echo $connect->error;
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