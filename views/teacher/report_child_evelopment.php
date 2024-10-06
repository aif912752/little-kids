<?php
include '../../config/database.php';

// Fetching room data
$roomQuery = "SELECT room_id, room_name FROM room";
$roomResult = $connect->query($roomQuery);

// ดึงข้อมูลโดยใช้ LEFT JOIN เพื่อรวมทุกรายนักเรียน
$sql = "SELECT 
sm.student_id, 
sm.weight, 
sm.height, 
sm.recorded_at,
s.first_name, 
s.last_name,
s.citizen_id, 
s.birthdate, 
s.enrollment_date,
s.room_id,  -- room_id จากตาราง students
r.room_name  -- เพิ่ม room_name จากตาราง room
FROM student_measurements sm
INNER JOIN (
SELECT 
    student_id, 
    MAX(recorded_at) AS last_recorded 
FROM student_measurements 
GROUP BY student_id
) AS latest ON sm.student_id = latest.student_id AND sm.recorded_at = latest.last_recorded
INNER JOIN students s ON sm.student_id = s.student_id
LEFT JOIN room r ON s.room_id = r.room_id;  -- JOIN กับตาราง room
"; // อย่าลืมเพิ่ม sm.id เพื่อดึง id จาก student_measurements
$result = $connect->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลนักเรียน</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <style>
        .dataTables_length select {
            width: 50px;
            /* ปรับขนาดของ select ตามเนื้อหา */
        }
    </style>
</head>

<body class="bg-surface">
    <main>
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>

            <div class="w-full page-wrapper xl:px-6 px-0">
                <div class="container px-6 py-8 mx-auto">
                    <h3 class="text-3xl font-medium text-black">รายงานพัฒนาการของนักเรียนภายในชั้นเรียน</h3>

                    <div class="flex flex-col mt-8">
                        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg bg-white p-3">

                                <table id="example" class="display pt-8" style="width:100%">
                                    <thead class="bg-slate-200 border border-rounded">
                                        <tr>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ชื่อ-นามสกุล</th>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">น้ำหนัก (กิโลกรัม)</th>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ส่วนสูง (เซนติเมตร)</th>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">วันที่เก็บข้อมูล่าสุด</th>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ชั้นที่เรียน</th>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">BMI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $weight = $row['weight'] !== null ? $row['weight'] : 0; // น้ำหนัก
                                                $height = $row['height'] !== null ? $row['height'] : 0; // ส่วนสูง
                                                $bmi = ($height > 0) ? $weight / (($height / 100) ** 2) : 0; // คำนวณ BMI

                                                // กำหนดค่า BMI ให้เป็น 'N/A' ถ้าน้ำหนักหรือส่วนสูงไม่ถูกต้อง
                                                $bmi_display = ($weight == 0 || $height == 0) ? 'N/A' : number_format($bmi, 2);
                                        ?>
                                                <tr>
                                                    <td class="py-5 border-b border-l border-gray-200 bg-white">
                                                        <p class="font-semibold text-black"><?php echo $row['first_name'] . " " . $row['last_name']; ?></p>
                                                    </td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $weight; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $height; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['recorded_at']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['room_name']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $bmi_display; ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='6' class='py-5 border-b border-gray-200 bg-white text-center'>ไม่มีข้อมูล</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end of project-->
    </main>
</body>

</html>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS CDN -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable(); // เริ่มต้น DataTables
    });
</script>