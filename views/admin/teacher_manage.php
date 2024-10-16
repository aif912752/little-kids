<?php

include '../../config/database.php';
$sql = "SELECT * FROM teacher Join room ON teacher.room_id = room.room_id";
$result = $connect->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลครู</title>

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
                        <div>
                            <h3 class="text-3xl font-medium text-black">จัดการข้อมูลครู</h3>
                        </div>

                        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg  bg-white p-3">

                            <!-- ชิดขวา -->
                            <div class="flex justify-end p-3">
                                <a href="teacher_add.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">เพิ่มข้อมูล</a>
                            </div>


                            <table id="example" class="display pt-8" style="width:100%">
                                <thead class="bg-slate-200 border border-rounded">
                                    <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ชื่อ-นามสกุล</th>
                                    <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ตำแหน่ง</th>
                                    <th class="py-2 border-b-2 border-gray-200 bg-gray-100">วัน/เดือน/ปี</th>
                                    <th class="py-2 border-b-2 border-gray-200 bg-gray-100">หมายเลขโทรศัพท์</th>
                                    <th class="py-2 border-b-2 border-gray-200 bg-gray-100">อีเมล์</th>
                                    <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ชั้นที่สอน</th>
                                    <th class="py-2 border-b-2 border-gray-200 bg-gray-100">จัดการ</th>
                                </thead>
                                <tbody>

                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $img_src = !empty($row['img']) ? '../teacher/uploads/teacher/' . $row['img'] : 'path/to/default-image.jpg';
                                    ?>

                                            <tr>
                                                <td class="py-5 border-b border-l border-gray-200 bg-white">
                                                    <div class="flex items-center text-sm">
                                                        <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                                            <img class="object-cover w-full h-full rounded-full" src="<?php echo $img_src; ?>" alt="" loading="lazy" />
                                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                        </div>
                                                        <div>
                                                            <p class="font-semibold text-black"> <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['position']; ?></td>
                                                <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['birthdate']; ?></td>
                                                <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['phone_number']; ?></td>
                                                <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['email']; ?></td>
                                                <td class="py-5 border-b border-gray-200 bg-white"><?php 
                                                    if($row['room_name'] == null){
                                                        echo "ยังไม่มีชั้นที่สอน";
                                                    }else{
                                                        echo $row['room_name'];
                                                    }
                                                     
                                                ?></td>
                                                <td class="py-5 border-b border-gray-200 bg-white">
                                                    <a href="teacher_edit.php?id=<?php echo $row['teacher_id']; ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">แก้ไข</a>
                                                    <a class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                                        onclick="confirmDelete(event, '<?php echo $row['teacher_id']; ?>')">
                                                        ลบ
                                                    </a>
                                                </td>
                                            </tr>

                                    <?php
                                        }
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
    function confirmDelete(event, teacherId) {
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
                window.location.href = 'teacher_delete.php?id=' + teacherId; // ดำเนินการลบเมื่อยืนยัน
            }
        });
    }
</script>