
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
            <?php  
                include '../../config/database.php';
                if(empty($_SESSION['room_id']))
                {   
                    unset($_SESSION['room_id']); 
                }
                if(isset($_GET['day_attendance'])){
                    $_SESSION['day_attendance'] = $_GET['day_attendance'];
                }
                if(isset($_GET['day_attendance_end'])){
                    $_SESSION['day_attendance_end'] = $_GET['day_attendance_end'];
                }
                
               
                // ค้นหา ห้องทั้งหมด
                if(isset($_GET['room_id'])){
                    $_SESSION['room_id'] = $_GET['room_id'];
                }
                
                
                

                
                if (isset($_SESSION['room_id'])) {
                  
                    if (isset($_SESSION['day_attendance']) && isset($_SESSION['day_attendance_end'])) {
                        $day_attendance = $_SESSION['day_attendance'];
                        $day_attendance_end = $_SESSION['day_attendance_end'];
                        $sql = "SELECT * FROM attendance 
                                WHERE attendance_date BETWEEN '$day_attendance' AND '$day_attendance_end' AND room_id = ".$_SESSION['room_id']."
                                ORDER BY attendance_date ASC";  // Order by attendance_date ascending
                       
                        $result = $connect->query($sql);
                    } else if (isset($_SESSION['day_attendance_end'])) {
                        $day_attendance_end = $_SESSION['day_attendance_end'];
                        $sql = "SELECT * FROM attendance 
                                WHERE attendance_date = '$day_attendance_end'  AND room_id = ".$_SESSION['room_id']."
                                ORDER BY attendance_date ASC";  // Order by attendance_date ascending
                        $result = $connect->query($sql);
                    } else if (isset($_SESSION['day_attendance'])) {
                        $day_attendance = $_SESSION['day_attendance'];
                        $sql = "SELECT * FROM attendance 
                                WHERE attendance_date = '$day_attendance'  AND room_id = ".$_SESSION['room_id']."
                                ORDER BY attendance_date ASC";  // Order by attendance_date ascending
                        $result = $connect->query($sql);
                    } else {
                        // ถ้าไม่มีให้ค้นหาวันล่าสุด 
                        $sql = "SELECT * FROM attendance 
                                WHERE attendance_date = (SELECT MAX(attendance_date) FROM attendance)  AND room_id = ".$_SESSION['room_id']."
                                ORDER BY attendance_date ASC";  // Order by attendance_date ascending
                        $result = $connect->query($sql);
                    }
                }else{
                    if (isset($_SESSION['day_attendance']) && isset($_SESSION['day_attendance_end'])) {
                        $day_attendance = $_SESSION['day_attendance'];
                        $day_attendance_end = $_SESSION['day_attendance_end'];
                        $sql = "SELECT * FROM attendance 
                                WHERE attendance_date BETWEEN '$day_attendance' AND '$day_attendance_end' 
                                ORDER BY attendance_date ASC";  // Order by attendance_date ascending
                       
                        $result = $connect->query($sql);
                    } else if (isset($_SESSION['day_attendance_end'])) {
                        $day_attendance_end = $_SESSION['day_attendance_end'];
                        $sql = "SELECT * FROM attendance 
                                WHERE attendance_date = '$day_attendance_end' 
                                ORDER BY attendance_date ASC";  // Order by attendance_date ascending
                        $result = $connect->query($sql);
                    } else if (isset($_SESSION['day_attendance'])) {
                        $day_attendance = $_SESSION['day_attendance'];
                        $sql = "SELECT * FROM attendance 
                                WHERE attendance_date = '$day_attendance' 
                                ORDER BY attendance_date ASC";  // Order by attendance_date ascending
                        $result = $connect->query($sql);
                    } else {
                        // ถ้าไม่มีให้ค้นหาวันล่าสุด 
                        $sql = "SELECT * FROM attendance 
                                WHERE attendance_date = (SELECT MAX(attendance_date) FROM attendance) 
                                ORDER BY attendance_date ASC";  // Order by attendance_date ascending
                        $result = $connect->query($sql);
                    }
                }


                $sqlroom = "SELECT * FROM room ";
                $resultroom = $connect->query($sqlroom);



?>
            <div class=" w-full page-wrapper xl:px-6 px-0">

                <div class="container px-6 py-8 mx-auto ">
                    <h3 class="text-3xl font-medium text-black">จัดการข้อมูลการมาเรียน</h3>



                    <div class="flex flex-col mt-8">
                        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg  bg-white p-3">
                                <div class ="w-full p-3">
                                    
                                    <select name='room_id' id="room_id" class="w-full border border-gray-200 p-2">
                                        <option value="">เลือกห้อง</option>
                                        <?php
                                        if ($resultroom->num_rows > 0) {
                                            while ($rowroom = $resultroom->fetch_assoc()) {
                                        
                                                if(isset($_SESSION['room_id']) && $_SESSION['room_id'] == $rowroom['room_id']){
                                                    echo "<option value='".$rowroom['room_id']."' selected>".$rowroom['room_name']."</option>";
                                                }else{
                                                    echo "<option value='".$rowroom['room_id']."'>".$rowroom['room_name']."</option>";
                                                }
                                        ?>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="flex justify-between p-3">
                                    <div>
                                        <label for="search" class="text-sm font-medium text-gray-700">ค้นหาวันที่</label>
                                        <input type="date" class="border border-gray-200 p-2" placeholder="ค้นหาวันที่" id="dateInput" value="<?= isset($_SESSION['day_attendance']) ?  $_SESSION['day_attendance']:'' ?>" /> - 
                                        <input type="date" class="border border-gray-200 p-2" placeholder="ค้นหาวันที่" id="dateInput_end" value="<?= isset($_SESSION['day_attendance_end']) ?  $_SESSION['day_attendance_end']:'' ?>" /> 
                                    </div>
                                    
                                    <div>
                                    <a href="attendance_add.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">เพิ่มข้อมูล</a>
                                    </div>
                                </div>
                              


                                <table id="example" class="display pt-8" style="width:100%">
                                    <thead class="bg-slate-200 border border-rounded">
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ชื่อ-นามสกุล</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">วันที่ลงเวลา</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">สถานะ</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">หมายเหตุ</th>
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
                                                        <div class="flex items-center text-sm py-4">

                                                            <div>
                                                                <p class="font-semibold text-black"> <?php echo $row['student_name'] . ' ' . $row['student_lastname']; ?></p>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['attendance_date']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white">
                                                    <?php echo $row['status']; ?>
                                                    </td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['note']; ?></td>

                                                    <td class="py-5 border-b border-r border-gray-200 bg-white">
                                                        <a href="attendance_edit.php?id=<?php echo $row['attendance_id']; ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">แก้ไข</a>
                                                        <a href="attendance_delete.php?id=<?php echo $row['attendance_id']; ?>" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">ลบ</a>
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
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('dateInput').addEventListener('change', function(event) {
            const selectedDate = event.target.value;
            console.log(selectedDate);
            window.location.href = `attendance.php?day_attendance=${selectedDate}`;
        });
        document.getElementById('dateInput_end').addEventListener('change', function(event) {
            const selectedDate = event.target.value;
            console.log(selectedDate);
            window.location.href = `attendance.php?day_attendance_end=${selectedDate}`;
        });

        document.getElementById('room_id').addEventListener('change', function(event) {

            const selectedRoom = event.target.value;
            if(event.target.value != ''){
                console.log(selectedRoom);
                window.location.href = `attendance.php?room_id=${selectedRoom}`;
            }else{
                window.location.href = `attendance.php`;
            }
           
        });


    });
</script>
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
 