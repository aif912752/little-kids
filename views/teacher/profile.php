<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>
            <?php
            include('../../config/database.php');

            // ดึงข้อมูลครูจากตาราง teacher โดยใช้ user_id
            $sql = "SELECT * FROM teacher JOIN room ON teacher.room_id = room.room_id WHERE teacher.user_id = ?";
            $stmt = $connect->prepare($sql);


            if ($stmt === false) {
                die("Error preparing SQL query: " . $connect->error);
            }

            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $teacher = $result->fetch_assoc();
            } else {
                die("ไม่พบข้อมูลครู");
            }
            ?>
            <div class=" w-full page-wrapper xl:px-6 px-0">

                <div class="h-full  p-8">
                    <div class="bg-white rounded-lg shadow-xl pb-8">

                        <div class="w-full h-[250px]">
                            <img src="https://vojislavd.com/ta-template-demo/assets/img/profile-background.jpg" class="w-full h-full rounded-tl-lg rounded-tr-lg">
                        </div>
                        <div class="flex flex-col items-center -mt-20">
                            <?php
                            if ($teacher['img'] != null) {
                                echo '<img src="uploads/teacher/'.$teacher['img'].'" class="w-40 h-40 border-4 border-white rounded-full">';
                                // echo '<img src="https://vojislavd.com/ta-template-demo/assets/img/profile.jpg" class="w-40 border-4 border-white rounded-full">';
                            } else {
                                echo '<img src="../../public/user.png" class="w-40 border-4 border-white rounded-full">';
                            }
                            ?>
                            <!-- <img src="https://vojislavd.com/ta-template-demo/assets/img/profile.jpg" class="w-40 border-4 border-white rounded-full"> -->
                            <div class="flex items-center space-x-2 mt-2">
                                <p class="text-2xl"><?php echo $teacher['first_name'] . ' ' . $teacher['last_name']; ?></p>
                                <span class="bg-blue-500 rounded-full p-1" title="Verified">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-100 h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                            </div>

                        </div>
                        <div class="flex-1 flex flex-col items-center lg:items-end justify-end px-8 mt-2">
                            <div class="flex items-center space-x-4 mt-2">
                                <a href="edit_profile.php" class="flex items-center bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 rounded text-sm space-x-2 transition duration-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                                    </svg>
                                    <span>แก้ไขข้อมูลส่วนตัว</span>
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
                        <div class="w-full flex flex-col 2xl:w-1/3">
                            <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                                <h4 class="text-xl text-gray-900 font-bold">ข้อมูลส่วนตัว</h4>
                                <ul class="mt-2 text-gray-700">

                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24">ชื่อ-นามสกุล:</span>
                                        <span class="text-gray-700"> <?= $teacher['first_name'] . ' ' . $teacher['last_name'] ?> </span>
                                    </li>
                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24">ตำแหน่ง:</span>
                                        <span class="text-gray-700"><?= $teacher['position']  ?></span>
                                    </li>
                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24">email :</span>
                                        <span class="text-gray-700"><?= $teacher['email'] ?></span>
                                    </li>
                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24">วันเกิด :</span>
                                        <span class="text-gray-700"><?= $teacher['birthdate'] ?> </span>
                                    </li>
                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24">เบอร์โทร:</span>
                                        <span class="text-gray-700"><?= $teacher['phone_number'] ?></span>
                                    </li>
                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24">ชั้นที่สอน:</span>
                                        <span class="text-gray-700"><?= $teacher['room_name']  ?></span>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!--end of project-->
    </main>
    <script>
        const DATA_SET_VERTICAL_BAR_CHART_1 = [68.106, 26.762, 94.255, 72.021, 74.082, 64.923, 85.565, 32.432, 54.664, 87.654, 43.013, 91.443];

        const labels_vertical_bar_chart = ['January', 'February', 'Mart', 'April', 'May', 'Jun', 'July', 'August', 'September', 'October', 'November', 'December'];

        const dataVerticalBarChart = {
            labels: labels_vertical_bar_chart,
            datasets: [{
                label: 'Revenue',
                data: DATA_SET_VERTICAL_BAR_CHART_1,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
            }]
        };
        const configVerticalBarChart = {
            type: 'bar',
            data: dataVerticalBarChart,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Last 12 Months'
                    }
                }
            },
        };

        var verticalBarChart = new Chart(
            document.getElementById('verticalBarChart'),
            configVerticalBarChart
        );
    </script>
</body>

</html>

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