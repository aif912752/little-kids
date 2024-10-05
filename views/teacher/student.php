<?php
include '../../config/database.php';
$sql = "SELECT * FROM students  ";
$result = $connect->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลผู้ดูแลระบบ</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>

            <div class=" w-full page-wrapper xl:px-6 px-0">

                <div class="container px-6 py-8 mx-auto ">
                    <h3 class="text-3xl font-medium text-black">จัดการข้อมูลนักเรียน</h3>



                    <div class="flex flex-col mt-8">
                        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg  bg-white p-3">

                                <!-- ชิดขวา -->
                                <div class="flex justify-end p-3">
                                    <a href="student_add.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">เพิ่มข้อมูล</a>
                                </div>


                                <table id="example" class="display pt-8" style="width:100%">
                                    <thead class="bg-slate-200 border border-rounded">
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ชื่อ-นามสกุล</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">เลขบัตรประชาชน</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">วัน/เดือน/ปี</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">วันที่ลงทะเบียนเข้าเรียน</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ชั้นที่เรียน</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">สถานะ</th>
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
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['citizen_id']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['birthdate']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['enrollment_date']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['grade_level']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['status']; ?></td>

                                                    <td class="py-5 border-b border-r border-gray-200 bg-white">
                                                        <a href="student_edit.php?id=<?php echo $row['student_id']; ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">แก้ไข</a>
                                                        <a href="student_delete.php?id=<?php echo $row['student_id']; ?>" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">ลบ</a>
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
<script>
    $(document).ready(function() {
        $('#example').DataTable(); // เรียกใช้งาน DataTables
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>