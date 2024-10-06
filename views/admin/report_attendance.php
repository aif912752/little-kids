<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>รายงานการมาเรียนกิจกรรมของนักเรียน</title>
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
                            <h3 class="text-3xl font-medium text-black">รายงานการมาเรียนกิจกรรมของนักเรียน</h3>
                        </div>

                        <!-- แผนภูมิแท่ง -->




                        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg  bg-white p-3">
                            <!-- <div class="flex p-3 justify-end">
                                <button class="px-4 py-2 bg-blue-700 text-white border border-blue-500 rounded-l hover:bg-blue-600 focus:outline-none">เดือน</button>
                                <button class="px-4 py-2 bg-blue-700 text-white border border-blue-500 rounded-r hover:bg-blue-600 focus:outline-none">ปี</button>
                            </div> -->
                            <div class="p-5">
                                <canvas id="activityChart" width="400" height="200"></canvas>
                            </div>

                            <?php
                            include('../../config/database.php');
                            // ฟังก์ชันแปลงเลขเดือนเป็นชื่อเดือนภาษาไทย
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

                            // Query เพื่อดึงข้อมูลการขาด ลา มาสาย ต่อเดือน
                            $sql = "
    SELECT 
        YEAR(attendance_date) AS year, 
        MONTH(attendance_date) AS month,
        SUM(CASE WHEN status = 'ขาด' THEN 1 ELSE 0 END) AS total_absent,
        SUM(CASE WHEN status = 'ลา' THEN 1 ELSE 0 END) AS total_leave,
        SUM(CASE WHEN status = 'สาย' THEN 1 ELSE 0 END) AS total_late
    FROM attendance
    GROUP BY YEAR(attendance_date), MONTH(attendance_date)
    ORDER BY year, month
";
                            $result = $connect->query($sql);
                            ?>

                            <table id="example" class="display pt-8" style="width:100%">
                                <thead class="bg-slate-200 border border-rounded">
                                    <tr>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">เดือน</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ขาด</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ลา</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">มาสาย</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // ลูปแสดงข้อมูลในตาราง
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $month = $row['month'];
                                            $year = $row['year'];
                                            $total_absent = $row['total_absent'];
                                            $total_leave = $row['total_leave'];
                                            $total_late = $row['total_late'];

                                            // รวมจำนวน ขาด ลา มาสาย
                                            $total_attendance = $total_absent + $total_leave + $total_late;

                                            echo "<tr>";
                                            echo "<td class='py-5 border-b border-gray-200 bg-white'>" . getThaiMonth($month) . " " . $year . "</td>";
                                            echo "<td class='py-5 border-b border-gray-200 bg-white'>" . $total_absent . "</td>";
                                            echo "<td class='py-5 border-b border-gray-200 bg-white'>" . $total_leave . "</td>";
                                            echo "<td class='py-5 border-b border-gray-200 bg-white'>" . $total_late . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='py-5 border-b border-gray-200 bg-white'>No data available</td></tr>";
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


<!-- สคริปต์สำหรับ Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const months = [];
    const totalAbsents = [];
    const totalLeaves = [];
    const totalLates = [];

    <?php
    // เตรียมข้อมูลสำหรับ JavaScript
    $result->data_seek(0); // รีเซ็ตผลลัพธ์
    while ($row = $result->fetch_assoc()) {
        $month = $row['month'];
        $year = $row['year'];
        $monthName = getThaiMonth($month);

        echo "months.push('" . $monthName . " " . $year . "');"; // เพิ่มเดือนและปีในอาร์เรย์
        echo "totalAbsents.push(" . $row['total_absent'] . ");"; // จำนวนขาด
        echo "totalLeaves.push(" . $row['total_leave'] . ");"; // จำนวนลา
        echo "totalLates.push(" . $row['total_late'] . ");"; // จำนวนมาสาย
    }
    ?>

    const ctx = document.getElementById('activityChart').getContext('2d');
    const activityChart = new Chart(ctx, {
        type: 'bar', // ประเภทของกราฟ
        data: {
            labels: months, // แท็ก x-axis
            datasets: [{
                    label: 'ขาด',
                    data: totalAbsents, // ข้อมูลจำนวนขาด
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // สีแดงอ่อน
                    borderColor: 'rgba(255, 99, 132, 1)', // สีแดงเข้ม
                    borderWidth: 1
                },
                {
                    label: 'ลา',
                    data: totalLeaves, // ข้อมูลจำนวนลา
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // สีน้ำเงินอ่อน
                    borderColor: 'rgba(54, 162, 235, 1)', // สีน้ำเงินเข้ม
                    borderWidth: 1
                },
                {
                    label: 'มาสาย',
                    data: totalLates, // ข้อมูลจำนวนมาสาย
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // สีเขียวอ่อน
                    borderColor: 'rgba(75, 192, 192, 1)', // สีเขียวเข้ม
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // เริ่มที่ 0
                }
            }
        }
    });
</script>

<!-- JavaScript สำหรับเปิดหน้าใหม่และปริ้น -->
<script>
    function openPrintWindow() {
        // ดึงข้อมูลตารางออกมาเป็น HTML
        var printContents = document.getElementById('example').outerHTML;

        // สร้างหน้าต่างใหม่
        var newWindow = window.open('', '_blank', 'width=800, height=600');

        // เขียนข้อมูล HTML ลงในหน้าต่างใหม่ พร้อมหัวข้อ
        newWindow.document.write('<html><head><title>Print Report</title>');
        newWindow.document.write('<style>table { width: 100%; border-collapse: collapse; } th, td { padding: 10px; text-align: left; border: 1px solid #ddd; } th { background-color: #f2f2f2; } h1 { text-align: center; margin-bottom: 20px; }</style>');
        newWindow.document.write('</head><body>');
        newWindow.document.write('<h1>รายงานกิจกรรมประจำเดือน</h1>'); // หัวข้อรายงาน
        newWindow.document.write(printContents);
        newWindow.document.write('</body></html>');

        // รอให้โหลดข้อมูลเสร็จแล้วสั่งปริ้น
        newWindow.document.close();
        newWindow.focus();
        newWindow.print();
    }
</script>