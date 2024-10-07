<?php
include '../../config/database.php';
// Query เพื่อดึงข้อมูลห้องจากตาราง room
$sql = "SELECT room_id, room_name FROM room";
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
            /* ทำให้ขนาดของ select ปรับตามเนื้อหา */

        }
    </style>
</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>

            <div class=" w-full page-wrapper xl:px-6 px-0">



                <div class="container px-6 py-8 mx-auto">
                    <!-- หัวข้อหลัก -->

                    <!-- หัวข้อเลือกห้อง -->
                    <div class="container mx-auto mt-10">
                        <h1 class="text-3xl font-bold text-center mb-6 text-gray-700">เลือกห้อง</h1>

                        <!-- Grid การจัดเรียงห้อง -->
                        <div class="grid grid-cols-2 gap-2 mt-12 sm:grid-cols-3 gap-6">

                            <?php while ($row = $result->fetch_assoc()): ?>
                                <div
                                    class="transition-all shadow-md duration-1000 bg-white hover:bg-blue-500  hover:shadow-xl m-2 p-4 relative z-40 group  ">
                                    <div
                                        class=" absolute  bg-blue-500/50 top-0 left-0 w-24 h-1 z-30  transition-all duration-200   group-hover:bg-white group-hover:w-1/2  ">
                                    </div>
                                    <div class="py-2 px-9 relative  ">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="hover:text-white" width="48" height="48" viewBox="0 0 14 14">
                                            <path fill="currentColor" fill-rule="evenodd" d="M12.402 8.976H7.259a2.278 2.278 0 0 0-.193-4.547h-1.68A3.095 3.095 0 0 0 4.609 0h7.793a1.35 1.35 0 0 1 1.348 1.35v6.279c0 .744-.604 1.348-1.348 1.348ZM2.898 4.431a1.848 1.848 0 1 0 0-3.695a1.848 1.848 0 0 0 0 3.695m5.195 2.276c0-.568-.46-1.028-1.027-1.028H2.899a2.649 2.649 0 0 0-2.65 2.65v1.205c0 .532.432.963.964.963h.172l.282 2.61A1 1 0 0 0 2.66 14h.502a1 1 0 0 0 .99-.862l.753-5.404h2.16c.567 0 1.027-.46 1.027-1.027Z" clip-rule="evenodd" />
                                        </svg>
                                        <h3 class="mt-8 text-xl font-semibold text-black group-hover:text-white "><?php echo $row['room_name']; ?>
                                        </h3>
                                        <!-- ลิงก์เลือกห้อง -->
                                        <div class="flex justify-center">
                                            <a href="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/little-kids/views/admin/room_view.php?id=<?php echo $row['room_id']; ?>"
                                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-900 transition duration-300">
                                                เลือกห้องนี้
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
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
    function confirmDelete(event, studentId) {
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
                window.location.href = 'student_delete.php?id=' + studentId; // ดำเนินการลบเมื่อยืนยัน
            }
        });
    }
</script>