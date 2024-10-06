<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>รายงานตารางกิจกรรม</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <style>
        .dataTables_length select {
            width: 50px;
            /* ทำให้ขนาดของ select ปรับตามเนื้อหา */

        }

        /* .swal2-confirm {
            background-color: #2563EB !important;
            color: white !important;
        } */
    </style>
</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>

            <div class=" w-full page-wrapper xl:px-6 px-0">
                <!-- Main Content -->
                <main class="h-full  max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        <div>
                            <h3 class="text-3xl font-medium text-black">รายงานตารางกิจกรรมต่อเดือน</h3>
                        </div>
                       
                        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg  bg-white p-3">
                            <!-- <div class="flex p-3 justify-end">
                                <button class="px-4 py-2 bg-blue-700 text-white border border-blue-500 rounded-l hover:bg-blue-600 focus:outline-none">เดือน</button>
                                <button class="px-4 py-2 bg-blue-700 text-white border border-blue-500 rounded-r hover:bg-blue-600 focus:outline-none">ปี</button>
                            </div> -->
                            <?php
                            // เชื่อมต่อกับฐานข้อมูล
                            include('../../config/database.php');
                            function getThaiMonth($month)
                            {
                                $thaiMonths = [
                                    1 => 'มกราคม',
                                    2 => 'กุมภาพันธ์',
                                    3 => 'มีนาคม',
                                    4 => 'เมษายน',
                                    5 => 'พฤษภาคม',
                                    6 => 'มิถุนายน',
                                    7 => 'กรกฎาคม',
                                    8 => 'สิงหาคม',
                                    9 => 'กันยายน',
                                    10 => 'ตุลาคม',
                                    11 => 'พฤศจิกายน',
                                    12 => 'ธันวาคม'
                                ];

                                return $thaiMonths[$month];
                            }
                            // Query เพื่อดึงข้อมูลจำนวนกิจกรรมต่อเดือน
                            $sql = "SELECT YEAR(activity_date_start) AS year, MONTH(activity_date_start) AS month, COUNT(*) AS total_activities FROM  activity GROUP BY  YEAR(activity_date_start), MONTH(activity_date_start) ORDER BY year, month";
                            // เตรียมคำสั่ง SQL
                            $result = $connect->query($sql);
                            ?>

                            <!-- ตาราง -->
                            <table id="example" class="display pt-8" style="width:100%">
                                <thead class="bg-slate-200 border border-rounded">
                                    <tr>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">เดือน</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">จำนวนกิจกรรม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // ตรวจสอบว่ามีผลลัพธ์หรือไม่
                                    if ($result->num_rows > 0) {
                                        // วนลูปแสดงผลข้อมูลในตาราง
                                        while ($row = $result->fetch_assoc()) {
                                            $month = $row['month'];
                                            $total_activities = $row['total_activities'];

                                            // แปลงตัวเลขเดือนเป็นชื่อเดือนภาษาไทย
                                            $monthName = getThaiMonth($month);

                                            echo "<tr>";
                                            echo "<td class='py-5 border-b border-gray-200 bg-white'>" . $monthName . "</td>";
                                            echo "<td class='py-5 border-b border-gray-200 bg-white'>" . $total_activities . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='2' class='py-5 border-b border-gray-200 bg-white'>No data available</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </main>

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
        $('#example').DataTable(); // เรียกใช้งาน DataTables
    });
</script>

<!-- SweetAlert2 -->
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

<?php
// เช็ค session alert ถ้ามีข้อความมีไหม ถ้ามีให้แสดงผล
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    if ($_SESSION['status'] == 'error') {
        echo "<script>
            Swal.fire({
                position: 'center',
                icon: '" . $_SESSION['status'] . "',
                title: 'เกิดข้อผิดพลาด',
                text: '$alert',
                showConfirmButton: false,
                timer: 1500
            })
            </script>";
    } else {
        echo "<script>
            Swal.fire({
                position: 'center',
                icon: '" . $_SESSION['status'] . "',
                title: 'สำเร็จ!',
                text: '$alert',
                showConfirmButton: false,
                timer: 1500
            })
            </script>";
    }

    unset($_SESSION['status']);
    unset($_SESSION['alert']);
}

?>


<script>
    function confirmDelete(event, adminId) {
        event.preventDefault(); // ป้องกันไม่ให้ลิงก์ทำงานโดยตรง

        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณต้องการลบข้อมูลนี้ใช่หรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'admin_delete.php?id=' + adminId; // ดำเนินการลบเมื่อยืนยัน
            }
        });
    }
</script>