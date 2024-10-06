<?php
include '../../config/database.php';

// ดึงข้อมูลห้องเรียนจากฐานข้อมูล
$roomQuery = "SELECT room_id, room_name FROM room";
$roomResult = $connect->query($roomQuery);

// Initial student query (no filtering)
$studentQuery = "SELECT student_id, first_name, last_name FROM students"; // Default query
$studentResult = $connect->query($studentQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลพัฒนาการเด็ก</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</head>

<body class="bg-surface">
    <main>
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>

            <div class="w-full page-wrapper xl:px-6 px-0">
                <main class="h-full max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        <div class="w-full">
                            <div class="bg-gradient-to-b from-blue-500 to-blue-300 h-96"></div>
                            <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
                                <div class="bg-white w-full shadow rounded p-8 sm:p-12 -mt-72">
                                    <form action="child_evelopment_insert.php" method="POST">
                                        <p class="text-3xl font-bold leading-7 text-center">บันทึกน้ำหนักและส่วนสูงนักเรียน</p>

                                        <div class="mb-6">
                                            <label for="student_id" class="block text-sm font-medium text-gray-700">เลือกนักเรียน</label>
                                            <select name="student_id" id="student_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">-- กรุณาเลือกนักเรียน --</option>
                                                <?php
                                                // Fetch students from the database
                                                $studentQuery = "SELECT student_id, first_name, last_name FROM students"; // Adjust this if needed
                                                $studentResult = $connect->query($studentQuery);

                                                while ($student = $studentResult->fetch_assoc()) {
                                                    echo "<option value='{$student['student_id']}'>{$student['first_name']} {$student['last_name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-6">
                                            <label for="weight" class="block text-sm font-medium text-gray-700">น้ำหนัก (กิโลกรัม)</label>
                                            <input type="number" step="0.01" name="weight" id="weight" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div class="mb-6">
                                            <label for="height" class="block text-sm font-medium text-gray-700">ส่วนสูง (เซนติเมตร)</label>
                                            <input type="number" step="0.01" name="height" id="height" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        </div>

                                        <div class="mt-6 flex justify-center">
                                            <button type="submit" class="hover:bg-blue-900 text-white font-bold py-2 px-4 rounded" style="background-color:#03346E;">
                                                บันทึกข้อมูล
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <!--end of project-->
    </main>
</body>

</html>