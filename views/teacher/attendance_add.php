<?php
include '../../config/database.php';

// ดึงข้อมูลนักเรียนจากฐานข้อมูล
$query = "SELECT student_id , first_name, last_name FROM students";
$result = $connect->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลการมาเรียน</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

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
                                    <p class="text-3xl font-bold leading-7 text-center">บันทึกการเข้าเรียน</p>
                                    <p class="text-3xl font-bold leading-7 text-center" id="currentDate"></p>

                                    <form action="insert_attendance.php" method="POST">
                                        <input type="hidden" name="attendance_date" value="<?php echo date('Y-m-d'); ?>">
                                        <table class="w-full">
                                            <thead>
                                                <tr class="bg-gray-200">
                                                    <th class="py-2 px-4 text-left">ลำดับ</th>
                                                    <th class="py-2 px-4 text-left">ชื่อนักเรียน</th>
                                                    <th class="py-2 px-4 text-center" colspan="3">ตัวเลือก</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                while ($row = $result->fetch_assoc()) {
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
    function previewImage(input) {
        var preview = document.getElementById('preview');
        var previewImg = document.getElementById('preview-img');
        var uploadBox = document.getElementById('upload-box');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
                uploadBox.classList.add('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            previewImg.src = "";
            preview.classList.add('hidden');
            uploadBox.classList.remove('hidden');
        }
    }
</script>
<script>
    // ฟังก์ชันในการแสดงวันที่ปัจจุบัน
    function displayCurrentDate() {
        const dateElement = document.getElementById('currentDate');
        const today = new Date();
        const day = String(today.getDate()).padStart(2, '0');
        const month = String(today.getMonth() + 1).padStart(2, '0'); // เดือนเริ่มต้นจาก 0
        const year = today.getFullYear();
        dateElement.textContent = `${day}/${month}/${year}`;
    }

    // เรียกใช้ฟังก์ชันเพื่อแสดงวันที่ปัจจุบันเมื่อโหลดหน้า
    displayCurrentDate();
</script>

</html>