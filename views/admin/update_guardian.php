<?php
session_start();
include('../../config/database.php');

$id = $_POST['id'] ?? '';
$old_username_guardian = $_POST['old_username'];
$guardian_user_id = $_POST['guardian_user_id'] ?? '';
$username = $_POST['username_guardian'] ?? '';
$password = $_POST['password_guardian'] ?? '';
$first_name_guardian = $_POST['first_name_guardian'] ?? '';
$last_name_guardian = $_POST['last_name_guardian'] ?? '';
$phone_number_guardian = $_POST['phone_number_guardian'] ?? '';
$gender_guardian = $_POST['gender_guardian'] ?? '';
$relation_to_student = $_POST['relation_to_student'] ?? '';
$address_guardian = $_POST['address_guardian'] ?? '';

// เช็ค username ซ้ำ


if($old_username_guardian != $username)
{
    $sql = "SELECT * FROM  user  WHERE username = '$username' ";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'Username นี้ถูกใช้ไปแล้ว กรุณาใช้ username อื่น';
        echo "<script>
                window.history.back();
              </script>";
        return;
    }
}

// เช็คกรอกข้อมูลครบไหม
if($username && $password && $first_name_guardian && $last_name_guardian && $phone_number_guardian && $gender_guardian && $relation_to_student && $address_guardian) 
{
   // ทำการ อัพเดทข้อมูล  user
    $sql2 = "UPDATE user SET username = '$username', password = '$password' WHERE id = '$guardian_user_id'";
    $result2  = $connect->query($sql2);
    if($result2)
    {
        // ทำการ อัพเดทข้อมูล  guardian
        $sql3 = "UPDATE guardians SET first_name = '$first_name_guardian', last_name = '$last_name_guardian', phone_number = '$phone_number_guardian' ,gender = '$gender_guardian', relation_to_student = '$relation_to_student', address = '$address_guardian' WHERE guardian_id = '$id'";
        $result3  = $connect->query($sql3);
        if($result3)
        {
            $_SESSION['status'] = 'success';
            $_SESSION['alert'] = 'แก้ไขข้อมูลสำเร็จ';
            echo "<script>
                    window.location = 'guardian_manage.php';
                  </script>";
            return;
        }else{
            echo $connect->error;
            $_SESSION['status'] = 'error';
            $_SESSION['alert'] = 'ไม่สามารถแก้ไขข้อมูลได้2';
            // echo "<script>
            //         window.history.back();
            //       </script>";
            // return;
        }
    }else{
        echo $connect->error;
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'ไม่สามารถแก้ไขข้อมูลได้1';
        echo "<script>
                window.history.back();
              </script>";
        return;
    }
}else{
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'กรุณากรอกข้อมูลให้ครบ';
    echo "<script>
            window.history.back();
          </script>";
    return;
}