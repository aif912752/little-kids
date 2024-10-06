<?php
include '../../config/database.php';

// Fetching data only from the student_measurements table
$sql = "SELECT sm.student_id, sm.weight, sm.height, s.first_name, s.last_name, s.citizen_id, s.birthdate, s.enrollment_date, r.room_name 
        FROM student_measurements sm
        JOIN students s ON sm.student_id = s.student_id
        JOIN room r ON s.room_id = r.room_id"; // Joining with students and room tables
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
            width: 50px; /* Adjust the size of select based on content */
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
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['weight']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['height']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['citizen_id']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['birthdate']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['enrollment_date']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['room_name']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='7' class='text-center py-5'>ไม่มีข้อมูล</td></tr>";
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
        $('#example').DataTable(); // Initialize DataTables
    });
</script>
