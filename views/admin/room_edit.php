<?php 
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลห้อง</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .swal2-confirm {
            background-color: #2563EB !important; 
            color: white !important;
        }
    </style>
</head>


<body class=" font-inter">
    <div class="flex h-screen bg-gray-50 " :class="{ 'overflow-hidden': isSideMenuOpen }">

        <?php include '../../src/navbar_teacher.php'; ?>
        <?php 
            include '../../config/database.php';
            $id = $_GET['id'] ?? '';
            $sql = "SELECT * FROM room WHERE room_id = $id";
            $result = $connect->query($sql);
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['alert'] = 'ไม่พบข้อมูลที่ต้องการแก้ไข';
                header('location: room_manage.php');
            }
        ?>

        <div class="flex flex-col w-full overflow-y-auto">
            <div class="w-full">
                <div class="bg-gradient-to-b from-blue-500 to-blue-300 h-96"></div>
                <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
                    <div class="bg-white w-full shadow rounded p-8 sm:p-12 -mt-72">
                        <p class="text-3xl font-bold leading-7 text-center">เพิ่มข้อมูลห้อง</p>
                        <form action="update_room.php" method="post">
                            <div class="md:flex items-center mt-4">
                                <div class="w-full flex flex-col">
                                    <label class="font-semibold leading-none">ชื่อชั้นเรียน</label>
                                    <input type="text" name="room_name" value="<?= $row['room_name'] ?>" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                    <input type="hidden" name="room_id" value="<?= $row['room_id'] ?>" />
                                </div>
                            </div>
                          
                            <div class="flex items-center justify-center w-full gap-4">
                                <button class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                    บันทึก
                                </button>
                                <a href="room_manage.php" class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-red-600 rounded hover:bg-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:outline-none">ยกเลิก</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>



</html>


<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'>
    
</script>
<?php 
    // เช็ค session alert ถ้ามีข้อความมีไหม ถ้ามีให้แสดงผล
    if(isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        echo "<script>
            Swal.fire({
                icon: '".$_SESSION['status']."',
                title: 'เกิดข้อผิดพลาด',
                text: '$alert',
            })
        </script>";
        unset($_SESSION['status']);
        unset($_SESSION['alert']);
    }

?>