<?php
include('../../config/database.php');
$id = $_GET['id'] ?? '';
if ($id) {



    $sql = "SELECT * FROM students WHERE student_id = $id";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // select users table
        $sql = "SELECT * FROM user WHERE id = " . $row['user_id'];
        $result = $connect->query($sql);
        $user = $result->fetch_assoc();
    } else {
        echo "<script>
                alert('ไม่พบข้อมูลที่ต้องการแก้ไข');
                window.location.href = 'student.php';
            </script>";
    }
} else {
    echo "<script>
            alert('ไม่พบข้อมูลที่ต้องการแก้ไข');
            window.location.href = 'student.php';
        </script>";
}

?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลนักเรียน</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class=" font-inter">
    <div class="flex h-screen bg-gray-50 " :class="{ 'overflow-hidden': isSideMenuOpen }">

        <?php include '../../src/navbar_teacher.php'; ?>


        <div class="flex flex-col w-full overflow-y-auto">
            <div class="w-full">
                <div class="bg-gradient-to-b from-blue-500 to-blue-300 h-96"></div>
                <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
                    <div class="bg-white w-full shadow rounded p-8 sm:p-12 -mt-72">
                        <p class="text-3xl font-bold leading-7 text-center">เพิ่มข้อมูลนักเรียน</p>
                        <form action="insert_student.php" method="post">
                            <div class="md:flex items-center mt-4">
                                <div class="w-full md:w-1/2 flex flex-col">
                                    <label class="font-semibold leading-none">ชื่อจริง</label>
                                    <input type="text" name="first_name" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                </div>
                                <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                                    <label class="font-semibold leading-none">นามสกุล</label>
                                    <input type="text" name="last_name" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                </div>
                            </div>
                            <div class="md:flex items-center mt-4">
                                <div class="w-full md:w-1/2 flex flex-col">
                                    <label class="font-semibold leading-none">วันเดือนปีเกิด</label>
                                    <input type="date" name="birthdate" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                </div>
                                <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                                    <label class="font-semibold leading-none">เชื้อชาติ</label>
                                    <input type="text" name="ethnicity" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                </div>
                            </div>
                            <div class="md:flex items-center mt-4">
                                <div class="w-full md:w-1/2 flex flex-col">
                                    <label class="font-semibold leading-none">สัญชาติ</label>
                                    <input type="text" name="nationality" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                </div>
                                <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                                    <label class="font-semibold leading-none">ศาสนา</label>
                                    <input type="text" name="religion" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                </div>
                            </div>
                            <div class="md:flex items-center mt-4">
                                <div class="w-full md:w-1/2 flex flex-col">
                                    <label class="font-semibold leading-none">เพศนักเรียน</label>
                                    <input type="text" name="gender" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                </div>
                                <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                                    <label class="font-semibold leading-none">รหัสบัตรประชาชน</label>
                                    <input type="text" name="citizen_id" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                </div>
                            </div>
                            <div class="md:flex items-center mt-4">
                                <div class="w-full md:w-1/2 flex flex-col">
                                    <label class="font-semibold leading-none">วันที่ลงทะเบียนเข้าเรียน</label>
                                    <input type="text" name="enrollment_date" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                </div>
                                <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                                    <label class="font-semibold leading-none">ชั้นที่เรียน</label>
                                    <input type="text" name="grade_level" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                </div>
                            </div>
                            <div class="md:flex items-center mt-4">
                                <div class="w-full md:w-1/2 flex flex-col">
                                    <label class="font-semibold leading-none">สถานะนักเรียน</label>
                                    <select name="status" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200">
                                        <option value="1">กำลังศึกษา </option>
                                        <option value="2">ไม่ศึกษา</option>
                                        <option value="3">สำเร็จการศึกษา</option>
                                    </select>
                                </div>
                            </div>



                            <div class="flex items-center justify-center w-full">
                                <button class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                    บันทึก
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>





        </div>
    </div>
</body>

</html>