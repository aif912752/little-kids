<?php 
    session_start();
    include '../../config/database.php';
    $sql = "SELECT * FROM administrators ";
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
                        
                        <!-- ชิดขวา -->
                        <div class="flex justify-end p-3">
                            <a href="admin_add.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">เพิ่มข้อมูล</a>
                        </div>
                            

                        <table id="example" class="display pt-8" style="width:100%">
                            <thead class="bg-slate-200">
                                <th class="py-2 border border-black">ชื่อ-นามสกุล</th>
                                <th class="py-2 border border-black">ตำแหน่ง</th>
                                <th class="py-2 border border-black">วัน/เดือน/ปี</th>
                                <th class="py-2 border border-black">หมายเลขโทรศัพท์</th>
                                <th class="py-2 border border-black">อีเมล์</th>
                                <th class="py-2 border border-black">จัดการ</th>
                            </thead>
                            <tbody>

                                <?php 
                                    if($result->num_rows > 0){
                                        while($row = $result->fetch_assoc()){
                                ?>

                                <tr>
                                    <td class="py-2 border border-black"><?php echo $row['first_name'].' '.$row['last_name']; ?></td>
                                    <td class="py-2 border border-black"><?php echo $row['position']; ?></td>
                                    <td class="py-2 border border-black"><?php echo $row['birthdate']; ?></td>
                                    <td class="py-2 border border-black"><?php echo $row['phone_number']; ?></td>
                                    <td class="py-2 border border-black"><?php echo $row['email']; ?></td>
                                    <td class="py-2 border border-black">
                                        <a href="admin_edit.php?id=<?php echo $row['admin_id']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">แก้ไข</a>
                                        <a href="admin_delete.php?id=<?php echo $row['admin_id']; ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">ลบ</a>
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
    if(isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        echo "<script>
            Swal.fire({
                icon: '".$_SESSION['status']."',
                title: 'สำเร็จ!',
                text: '$alert',
            })
        </script>";
        unset($_SESSION['status']);
        unset($_SESSION['alert']);
    }

?>