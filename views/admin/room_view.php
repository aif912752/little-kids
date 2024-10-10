<?php
include '../../config/database.php';
$id = $_GET['id'];

$sql = "SELECT * FROM room WHERE room_id =" . $id;
$result = $connect->query($sql);
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ห้อง</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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


                        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg  bg-white p-3">

                            <div class="text-center p-3">
                                <h3 class="text-3xl font-medium text-black">ห้อง <?php echo $row['room_name'] ?> </h3>
                            </div>
                            <div class="flex justify-between items-start my-4">
                                <table class="my-3 border bg-green-500">
                                    <?php
                                    $sql2 = "SELECT * FROM teacher WHERE room_id =" . $id;
                                    $result2 = $connect->query($sql2);
                                    while ($row2 = $result2->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td class="p-2 text-white">ชื่อครูประจำชั้น : </td>
                                            <td class="p-2 text-white"><?= $row2['first_name'] . ' ' . $row2['last_name'] ?> </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                <div class="flex gap-4">
                                    <?php
                                    echo '<a href="student_add.php?room_id=' . $id . '" class="px-4 py-2 bg-blue-600 text-white border border-blue-500 rounded hover:bg-blue-700 focus:outline-none">เพิ่มข้อมูลนักเรียน</a>';
                                    if ($_SESSION['role'] == '1')
                                    {
                                        echo '<a href="http://'. $_SERVER['HTTP_HOST'].'/little-kids/views/admin/room_manage.php"   class="px-4 py-2 bg-red-600 text-white border border-red-500 rounded hover:bg-red-700 focus:outline-none">กลับหน้าหลัก</a>';
                                    }else{
                                        echo '<a href="http://'. $_SERVER['HTTP_HOST'].'/little-kids/views/teacher/student.php"  class="px-4 py-2 bg-red-600 text-white border border-red-500 rounded hover:bg-red-700 focus:outline-none">กลับหน้าหลัก</a>';
                                    }
                                    
                                    ?>
                                </div>
                            </div>


                            <!-- ตาราง -->
                            <table id="example" class="display pt-8" style="width:100%">
                                <thead class="bg-slate-200 border border-rounded">
                                    <tr>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">จำนวน</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ชื่อนักเรียน</th>
                                        <th class = "py-2 border-b-2 border-gray-200 bg-gray-100">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql3 = "SELECT * FROM students WHERE room_id =" . $id;
                                    $result3 = $connect->query($sql3);
                                    $i = 0;
                                    while ($row3 = $result3->fetch_assoc()) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td class="py-5 border-b border-gray-200 bg-white"><?= $i ?></td>
                                            <td class="py-5 border-b border-gray-200 bg-white"><?= $row3['first_name'] . ' ' . $row3['last_name']  ?></td>
                                            <td class="py-5 border-b border-gray-200 bg-white">
                                                <a href="student_edit.php?id=<?= $row3['student_id'] ?>&room_id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">แก้ไข</a>
                                                <a href="student_delete.php?id=<?= $row3['student_id'] ?>&room_id=<?= $id ?>" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">ลบ</a>
                                            </td>
                                        </tr>
                                    <?php } ?>

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