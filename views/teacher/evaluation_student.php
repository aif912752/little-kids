<?php
include '../../config/database.php';
$sql = "SELECT * FROM evaluation_students";
$result = $connect->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลแบบประเมินนักเรียน</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">

    <style>
        .dataTables_length select {
            width: 50px;
        }
    </style>
</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>

            <div class=" w-full page-wrapper xl:px-6 px-0">

                <div class="container px-6 py-8 mx-auto ">
                    <h3 class="text-3xl font-medium text-black">จัดการข้อมูลแบบประเมินนักเรียน</h3>



                    <div class="flex flex-col mt-8">
                        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg  bg-white p-3">

                                <!-- ชิดขวา -->
                                <div class="flex justify-end p-3">
                                    <a href="evaluation_student_add.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">เพิ่มข้อมูล</a>
                                </div>


                                <table id="example" class="display pt-8 " style="width:100%">
                                    <thead class="bg-slate-200 border border-rounded">
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ชื่อหัวข้อ</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">วันที่สร้าง</th>
                                        <!-- <th class="py-2 border-b-2 border-gray-200 bg-gray-100">รายละเอียด</th> -->

                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">จัดการ</th>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $img_src = !empty($row['img']) ? 'uploads/' . $row['img'] : 'path/to/default-image.jpg';
                                        ?>

                                                <tr>
                                                    <td class="py-5 border-b border-l border-gray-200 bg-white">
                                                        <div class="flex items-center text-sm px-4">

                                                            <div>
                                                                <p class="font-semibold text-black"> <?php echo $row['evaluation_name']; ?></p>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['evaluation_date']; ?></td>
                                                    <!-- <td class="py-5 border-b border-gray-200 bg-white">
                                                        <button class="appearance-none block w-full bg-green-700 text-gray-100 font-bold border border-gray-200 rounded-lg py-3 px-3 leading-tight hover:bg-green-600 focus:outline-none focus:bg-white focus:border-gray-500">รายละเอียด</button>
                                                    </td> -->

                                                    <td class="py-5 border-b border-r border-gray-200 bg-white">
                                                        <a href="evaluation_student_edit.php?id=<?php echo $row['evaluation_id']; ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">แก้ไข</a>
                                                        <a href="evaluation_student_delete.php?id=<?php echo $row['evaluation_id']; ?>" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">ลบ</a>
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
                    </div>
                </div>

            </div>
        </div>
        <!--end of project-->
    </main>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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