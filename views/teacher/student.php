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
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-2xl transition duration-300 ease-in-out transform hover:-translate-y-1">
                    <!-- ชื่อห้อง -->
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center"><?php echo $row['room_name']; ?></h2>
                    
                    <!-- ลิงก์เลือกห้อง -->
                    <div class="flex justify-center">
                        <a href="<?= "http://". $_SERVER['HTTP_HOST'] ?>/little-kids/views/admin/room_view.php?id=<?php echo $row['room_id']; ?>" 
                           class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                           เลือกห้องนี้
                        </a>
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