<?php
session_start();
include('config/database.php');
//เมื่อทำการ post 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //เช็คข้อมูล post username password
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if (!empty($username) && !empty($password)) {
        //ทำการเช็ค username และ password ทำการ query ข้อมูล
        $sql = "SELECT * FROM user WHERE username = ? AND password = ? ";
        $stmt = $connect->prepare($sql);
        // ตรวจสอบว่าการเตรียมคำสั่ง SQL สำเร็จหรือไม่
        if ($stmt === false) {
            die("Error preparing SQL query: " . $connect->error);
        }

        // ผูกพารามิเตอร์และรันคำสั่ง
        $stmt->bind_param("ss", $username,$password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // เก็บข้อมูล session 
            $_SESSION['user_id'] = $user['id'];          // ID ของผู้ใช้
            $_SESSION['username'] = $user['username'];   // ชื่อผู้ใช้
            // แล้วทำการแยกสิทธิ์
            switch ($user['role']) {
                case 1:
                    // เช็ค 1 = ผู้ดูแลระบบ
                    $_SESSION['role'] = 'admin';
                    header('Location: views/admin/index.php'); // เปลี่ยนเส้นทางไปที่แดชบอร์ดของผู้ดูแลระบบ
                    break;
                case 2:
                     // เช็ค 2 = ผู้อำนวยการ
                    $_SESSION['role'] = 'director';
                    header('Location: views/director/index.php'); // เปลี่ยนเส้นทางไปที่แดชบอร์ดของ director
                    break;
                case 3:
                    // เช็ค 3 = คุณครู
                    $_SESSION['role'] = 'teacher';
                    header('Location: views/teacher/index.php'); // เปลี่ยนเส้นทางไปที่แดชบอร์ดของ teacher
                    break;
                case 4:
                    // เช็ค 4 = ผู้ปกครอง
                    header('Location: views/guardian/index.php'); // เปลี่ยนเส้นทางไปที่แดชบอร์ดของ guardian
                    $_SESSION['role'] = 'guardian';
                    break;
                default:
                    // บทบาทไม่ถูกต้อง
                    $_SESSION['role'] = 'unknown';
                    break;
                }
                // echo  $_SESSION['role'];
                
        } else {
            echo 'รหัสผ่านไม่ถูกต้อง';
        }
    }

    

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าล็อคอิน </title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <section class="flex justify-center items-center h-screen bg-gray-100">
        <form action="index.php" method="POST" class="max-w-md w-full bg-white rounded p-6 space-y-4">
            <div class="mb-4">
                <p class="text-gray-600">Sign In</p>
                <h2 class="text-xl font-bold">Join our community</h2>
            </div>
            <div>
                <input class="w-full p-4 text-sm bg-gray-50 focus:outline-none border border-gray-200 rounded text-gray-600" type="text" name="username" placeholder="Email">
            </div>
            <div>
                <input class="w-full p-4 text-sm bg-gray-50 focus:outline-none border border-gray-200 rounded text-gray-600" type="text" name="password" placeholder="Password">
            </div>
            <div>
                <button class="w-full py-4 bg-blue-600 hover:bg-blue-700 rounded text-sm font-bold text-gray-50 transition duration-200">ล็อคอิน</button>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex flex-row items-center">
                    <input type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <label for="comments" class="ml-2 text-sm font-normal text-gray-600">Remember me</label>
                </div>
                <div>
                    <a class="text-sm text-blue-600 hover:underline" href="#">Forgot password?</a>
                </div>
            </div>
        </form>
    </section>

</body>

</html>