<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>รายงานการประเมินผลกิจกรรมของครู</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
</head>

<body class="bg-surface">
    <main>
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>

            <div class="w-full page-wrapper xl:px-6 px-0">
                <main class="h-full max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        <div>
                            <h3 class="text-3xl font-medium text-black">รายงานการประเมินผลกิจกรรมของครู</h3>
                        </div>

                        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg bg-white p-3">
                            <?php
                            include('../../config/database.php');

                            // Query เพื่อดึงคะแนนรวมจาก evaluation_to_activity
                            $sql = "
                                SELECT 
                                    teacher_id, 
                                    evaluation_id, 
                                    evaluation_activity_id, 
                                    SUM(total_score) AS total_score
                                FROM evaluation_to_activity
                                GROUP BY teacher_id, evaluation_id, evaluation_activity_id
                                ORDER BY teacher_id, evaluation_id
                            ";
                            $result = $connect->query($sql);
                            ?>

                            <div class="flex justify-end p-3">
                                <a href="javascript:void(0)" onclick="openPrintWindow()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">ปริ้นรายงาน</a>
                            </div>

                            <table id="example" class="display pt-8" style="width:100%">
                                <thead class="bg-slate-200 border border-rounded">
                                    <tr>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ไอดีคุณครู</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">รหัสประเมิน</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">รหัสกิจกรรม</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">คะแนนรวม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // ลูปแสดงข้อมูลในตาราง
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td class='py-5 border-b border-gray-200 bg-white'>" . $row['teacher_id'] . "</td>";
                                            echo "<td class='py-5 border-b border-gray-200 bg-white'>" . $row['evaluation_id'] . "</td>";
                                            echo "<td class='py-5 border-b border-gray-200 bg-white'>" . $row['evaluation_activity_id'] . "</td>";
                                            echo "<td class='py-5 border-b border-gray-200 bg-white'>" . $row['total_score'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='py-5 border-b border-gray-200 bg-white'>ไม่มีข้อมูล</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- แสดงกราฟ -->
                        <div class="p-5">
                            <canvas id="activityChart" width="400" height="200"></canvas>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            const labels = [];
                            const scores = [];

                            <?php
                            // เตรียมข้อมูลสำหรับกราฟ
                            $result->data_seek(0); // รีเซ็ตผลลัพธ์
                            while ($row = $result->fetch_assoc()) {
                                echo "labels.push('คุณครู ID: " . $row['teacher_id'] . " - ประเมิน ID: " . $row['evaluation_id'] . "');";
                                echo "scores.push(" . $row['total_score'] . ");";
                            }
                            ?>

                            const ctx = document.getElementById('activityChart').getContext('2d');
                            const activityChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'คะแนนรวม',
                                        data: scores,
                                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </main>
            </div>
        </div>
    </main>
</body>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS CDN -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable(); // เรียกใช้งาน DataTables
    });
</script>

<script>
    function openPrintWindow() {
        var printContents = document.getElementById('example').outerHTML;
        var newWindow = window.open('', '_blank', 'width=800, height=600');
        newWindow.document.write('<html><head><title>Print Report</title>');
        newWindow.document.write('<style>table { width: 100%; border-collapse: collapse; } th, td { padding: 10px; text-align: left; border: 1px solid #ddd; } th { background-color: #f2f2f2; } h1 { text-align: center; margin-bottom: 20px; }</style>');
        newWindow.document.write('</head><body>');
        newWindow.document.write('<h1>รายงานการประเมินผลกิจกรรม</h1>');
        newWindow.document.write(printContents);
        newWindow.document.write('</body></html>');
        newWindow.document.close();
        newWindow.focus();
        newWindow.print();
    }
</script>

</html>