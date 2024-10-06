<?php
include '../../config/database.php';

// Fetching room data
$roomQuery = "SELECT room_id, room_name FROM room";
$roomResult = $connect->query($roomQuery);

// ดึงข้อมูลโดยใช้ LEFT JOIN เพื่อรวมทุกรายนักเรียน
$sql = "SELECT sm.student_id, sm.weight, sm.height, s.first_name, s.last_name, s.citizen_id, s.birthdate, s.enrollment_date, r.room_name, sm.id 
        FROM students s
        INNER JOIN student_measurements sm ON sm.student_id = s.student_id
        LEFT JOIN room r ON s.room_id = r.room_id"; // อย่าลืมเพิ่ม sm.id เพื่อดึง id จาก student_measurements
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
                    <h3 class="text-3xl font-medium text-black">ข้อมูลน้ำหนักและส่วนสูงนักเรียน</h3>

                    <div class="flex flex-col mt-8">
                        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg bg-white p-3">

                                <!-- ชิดขวา -->
                                <div class="flex justify-end p-3">
                                    <a href="child_evelopment_add.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">เพิ่มข้อมูล</a>
                                </div>

                                <table id="example" class="display pt-8" style="width:100%">
                                    <thead class="bg-slate-200 border border-rounded">
                                        <tr>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ชื่อ-นามสกุล</th>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">น้ำหนัก (กิโลกรัม)</th>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ส่วนสูง (เซนติเมตร)</th>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">เลขบัตรประชาชน</th>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">วัน/เดือน/ปี</th>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">วันที่ลงทะเบียนเข้าเรียน</th>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ชั้นที่เรียน</th>
                                            <th class="py-2 border-b-2 border-gray-200 bg-gray-100">จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td class="py-5 border-b border-l border-gray-200 bg-white">
                                                        <p class="font-semibold text-black"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
                                                    </td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['weight'] !== null ? $row['weight'] : 'N/A'; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['height'] !== null ? $row['height'] : 'N/A'; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['citizen_id']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['birthdate']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['enrollment_date']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['room_name']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white">
                                                        <a href="child_evelopment_edit.php?id=<?php echo $row['id']; ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">แก้ไข</a>
                                                        <a href="child_evelopment_delete.php?id=<?php echo $row['id']; ?>" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">ลบ</a>
                                                    </td>
                                                </tr>

                                        <?php
                                            }
                                        } else {
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