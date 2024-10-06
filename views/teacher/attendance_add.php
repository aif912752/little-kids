<?php
include '../../config/database.php';

// ดึงข้อมูลห้องเรียนจากฐานข้อมูล
$roomQuery = "SELECT room_id, room_name FROM room";
$roomResult = $connect->query($roomQuery);

// Initial student query (no filtering yet)
$studentQuery = "SELECT student_id, first_name, last_name FROM students WHERE room_id IS NULL"; // Default query, will update after room selection
$studentResult = $connect->query($studentQuery);
?> 


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลการมาเรียน</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>

            <div class=" w-full page-wrapper xl:px-6 px-0">

                <!-- Main Content -->
                <main class="h-full  max-w-full">

                    <div class="container full-container p-0 flex flex-col gap-6">

                        <div class="w-full">
                            <div class="bg-gradient-to-b from-blue-500 to-blue-300 h-96"></div>
                            <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
                                <div class="bg-white w-full shadow rounded p-8 sm:p-12 -mt-72">
                                    <form action="insert_attendance.php" method="POST">

                                        <p class="text-3xl font-bold leading-7 text-center">บันทึกการเข้าเรียน</p>
                                        <p class="text-3xl font-bold leading-7 text-center" id="currentDate"></p>

                                        <input type="hidden" name="attendance_date" id="attendanceDate">
                                        <div class="mb-6">
                                            <label for="roomSelect" class="block text-sm font-medium text-gray-700">เลือกชั้นเรียน</label>
                                            <select id="roomSelect" name="room_id" onchange="fetchStudents()" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">-- กรุณาเลือกชั้นเรียน --</option>
                                                <?php
                                                while ($room = $roomResult->fetch_assoc()) {
                                                    echo "<option value='{$room['room_id']}'>{$room['room_name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <table id="studentsTable" class="w-full hidden">
                                            <thead>
                                                <tr class="bg-gray-200">
                                                    <th class="py-2 px-4 text-left">ลำดับ</th>
                                                    <th class="py-2 px-4 text-left">ชื่อนักเรียน</th>
                                                    <th class="py-2 px-4 text-center" colspan="3">ตัวเลือก</th>
                                                    <th class="py-2 px-4 text-left" >หมายเหตุ</th> <!-- New header for notes -->

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                while ($row = $studentResult->fetch_assoc()) {
                                                    echo "<tr class='border-b'>";
                                                    echo "<td class='py-2 px-4'>{$count}</td>";
                                                    echo "<td class='py-2 px-4'>{$row['first_name']} {$row['last_name']}</td>";
                                                    echo "<td class='py-2 px-4 text-center'>
                            <input type='radio' name='status[{$row['student_id']}]' value='มา' id='present_{$row['student_id']}' class='mr-2' required>
                            <label for='present_{$row['student_id']}'>มา</label>
                          </td>";
                                                    echo "<td class='py-2 px-4 text-center'>
                            <input type='radio' name='status[{$row['student_id']}]' value='ขาด' id='absent_{$row['student_id']}' class='mr-2'>
                            <label for='absent_{$row['student_id']}'>ขาด</label>
                          </td>";
                                                    echo "<td class='py-2 px-4 text-center'>
                            <input type='radio' name='status[{$row['student_id']}]' value='สาย' id='late_{$row['student_id']}' class='mr-2'>
                            <label for='late_{$row['student_id']}'>สาย</label>
                          </td>";

                          echo "<td class='py-2 px-4'>
                          <input type='text' name='note[{$row['student_id']}]' class='border border-gray-300 rounded-md w-full  
                          ' placeholder='กรอกหมายเหตุ (ถ้ามี)'>
                        </td>";
                                                    echo "</tr>";
                                                    $count++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="mt-6">
                                            <button type="submit" class="hover:bg-blue-900 text-white font-bold py-2 px-4 rounded" style="background-color:#03346E ;">
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

<script>
    // ฟังก์ชันในการแสดงวันที่ปัจจุบันในรูปแบบ DD/MM/YYYY
    function displayCurrentDate() {
        const dateElement = document.getElementById('currentDate');
        const dateInput = document.getElementById('attendanceDate');

        const today = new Date();
        const day = String(today.getDate()).padStart(2, '0');
        const month = String(today.getMonth() + 1).padStart(2, '0'); // เดือนเริ่มจาก 0
        const year = today.getFullYear();

        // แสดงวันที่ใน <p> และใส่ค่าใน <input hidden>
        dateElement.textContent = `${day}/${month}/${year}`;
        dateInput.value = `${year}-${month}-${day}`; // รูปแบบที่ส่งไปในฟอร์มเป็น Y-m-d
    }

    // เรียกใช้ฟังก์ชันเมื่อหน้าโหลดเสร็จ
    displayCurrentDate();

    // ฟังก์ชันดึงข้อมูลนักเรียนตามชั้นเรียนที่เลือก
    function fetchStudents() {
        const roomId = document.getElementById('roomSelect').value;
        const studentsTable = document.getElementById('studentsTable');

        if (roomId) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `fetch_students.php?room_id=${roomId}`, true);
            xhr.onload = function() {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    let output = '';
                    let count = 1;
                    response.forEach(student => {
                        output += `<tr class='border-b'>
                            <td class='py-2 px-4'>${count}</td>
                            <td class='py-2 px-4'>${student.first_name} ${student.last_name}</td>
                            <td class='py-2 px-4 text-center'>
                                <input type='radio' name='status[${student.student_id}]' value='มา' id='present_${student.student_id}' class='mr-2' required>
                                <label for='present_${student.student_id}'>มา</label>
                            </td>
                            <td class='py-2 px-4 text-center'>
                                <input type='radio' name='status[${student.student_id}]' value='ขาด' id='absent_${student.student_id}' class='mr-2'>
                                <label for='absent_${student.student_id}'>ขาด</label>
                            </td>
                            <td class='py-2 px-4 text-center'>
                                <input type='radio' name='status[${student.student_id}]' value='สาย' id='late_${student.student_id}' class='mr-2'>
                                <label for='late_${student.student_id}'>สาย</label>
                            </td>

                              <td class='py-2 px-4 text-center'>
                                <input type='text' name='note[${student.student_id}]' class='border border-gray-300 rounded-md w-full  
                          ' placeholder='กรอกหมายเหตุ (ถ้ามี)'>
                            </td>
                        </tr>`;
                        count++;
                    });
                    studentsTable.querySelector('tbody').innerHTML = output;
                    studentsTable.classList.remove('hidden'); // Show the table
                }
            };
            xhr.send();
        } else {
            studentsTable.classList.add('hidden'); // Hide the table if no room is selected
        }
    }
</script>


</html>