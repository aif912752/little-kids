
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลผู้ดูแลระบบ</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="text-gray-800 font-inter">
    <?php include '../../src/navbar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container px-6 py-8 mx-auto">
            <h3 class="text-3xl font-medium text-gray-700">เพิ่มข้อมูลผู้ดูแลระบบ</h3>
            <div class="flex flex-col mt-8">
                <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <form action="insert_admin.php" method="POST" class="grid grid-cols-2 gap-4  inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg  bg-white p-3">
                        <!-- Row 1 -->
                        <div class="col-span-1">
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                            <input type="text" name="username" class="border border-gray-400 p-2 w-full" required>
                        </div>
                        <div class="col-span-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" class="border border-gray-400 p-2 w-full" required>
                        </div>

                        <!-- Row 2 -->
                        <div class="col-span-1">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">ชื่อ</label>
                            <input type="text" name="first_name" class="border border-gray-400 p-2 w-full" required>
                        </div>
                        <div class="col-span-1">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">นามสกุล</label>
                            <input type="text" name="last_name" class="border border-gray-400 p-2 w-full" required>
                        </div>


                        <!-- Row 4 -->
                        <div class="col-span-2">
                            <label for="citizen_id" class="block text-sm font-medium text-gray-700">เลขประจำตัวประชาชน</label>
                            <input type="text" name="citizen_id" class="border border-gray-400 p-2 w-full" required>
                        </div>

                        <!-- Row 5 -->
                        <div class="col-span-1">
                            <label for="birthdate" class="block text-sm font-medium text-gray-700">วัน/เดือน/ปี เกิด</label>
                            <input type="date" name="birthdate" class="border border-gray-400 p-2 w-full" required>
                        </div>
                        <div class="col-span-1">
                            <label for="email" class="block text-sm font-medium text-gray-700">อีเมล์</label>
                            <input type="email" name="email" class="border border-gray-400 p-2 w-full" required>
                        </div>

                        <!-- Row 6 -->
                        <div class="col-span-1">
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">เบอร์โทรศัพท์</label>
                            <input type="text" name="phone_number" class="border border-gray-400 p-2 w-full" required>
                        </div>
                        <div class="col-span-1">
                            <label for="nationality" class="block text-sm font-medium text-gray-700">เชื้อชาติ</label>
                            <input type="text" name="nationality" class="border border-gray-400 p-2 w-full" required>
                        </div>

                        <!-- Row 7 -->
                        <div class="col-span-1">
                            <label for="ethnicity" class="block text-sm font-medium text-gray-700">สัญชาติ</label>
                            <input type="text" name="ethnicity" class="border border-gray-400 p-2 w-full" required>
                        </div>
                        <div class="col-span-1">
                            <label for="religion" class="block text-sm font-medium text-gray-700">ศาสนา</label>
                            <input type="text" name="religion" class="border border-gray-400 p-2 w-full" required>
                        </div>

                        <!-- Row 8 -->
                        <div class="col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">ที่อยู่</label>
                            <input type="text" name="address" class="border border-gray-400 p-2 w-full" required>
                        </div>

                        <!-- Row 9 -->
                        <div class="col-span-2 text-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">บันทึก</button>
                            <a href="admin_manage.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">ยกเลิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>


</body>

</html>