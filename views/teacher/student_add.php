<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลนักเรียน</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class=" font-inter">
    <div class="flex h-screen bg-gray-800 " :class="{ 'overflow-hidden': isSideMenuOpen }">

        <?php include '../../src/navbar_teacher.php'; ?>


        <div class="flex flex-col w-full overflow-y-auto">
        <div class="w-full">
    <div class="bg-gradient-to-b from-blue-800 to-blue-600 h-96"></div>
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
                        <input type="text" name="last_name" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                    </div>
                </div>
                <div class="md:flex items-center mt-4">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">วันเดือนปีเกิด</label>
                        <input type="date" name="birthdate" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">เชื้อชาติ</label>
                        <input type="text" name="ethnicity" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                    </div>
                </div>
                <div class="md:flex items-center mt-4">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">สัญชาติ</label>
                        <input type="text" name="nationality" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">ศาสนา</label>
                        <input type="text" name="religion" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                    </div>
                </div>
                <div class="md:flex items-center mt-4">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">เพศนักเรียน</label>
                        <input type="text" name="gender" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">รหัสบัตรประชาชน</label>
                        <input type="text" name="citizen_id" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                    </div>
                </div>
                <div class="md:flex items-center mt-4">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">วันที่ลงทะเบียนเข้าเรียน</label>
                        <input type="text" name="enrollment_date" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">ชั้นที่เรียน</label>
                        <input type="text" name="grade_level" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                    </div>
                </div>
                <div class="md:flex items-center mt-4">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">สถานะนักเรียน</label>
                        <input type="text" name="status" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
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




            <main class=" overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <h3 class="text-3xl font-medium text-gray-700">เพิ่มข้อมูลนักเรียน</h3>
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
                                    <label for="id_card" class="block text-sm font-medium text-gray-700">เลขประจำตัวประชาชน</label>
                                    <input type="text" name="id_card" class="border border-gray-400 p-2 w-full" required>
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
                                    <label for="citizen_id" class="block text-sm font-medium text-gray-700">สัญชาติ</label>
                                    <input type="text" name="citizen_id" class="border border-gray-400 p-2 w-full" required>
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
        </div>
    </div>
</body>

</html>