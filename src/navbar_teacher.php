<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <link rel="stylesheet" href="../../assets/css/theme.css" />

</head>
<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body>

    <aside id="application-sidebar-brand"
        class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full  transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-5 xl:left-auto top-0 left-0 with-vertical h-screen z-[999] shrink-0  w-[270px] shadow-md xl:rounded-md rounded-none bg-white left-sidebar   transition-all duration-300">
        <!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
        <div class="p-4 flex justify-center">
            <span class="text-nowrap text-gray-800 text-xl  font-semibold">
                ลิตเติ้ลคิดส์
            </span>
        </div>
        <div class="scroll-sidebar" data-simplebar="">
            <nav class=" w-full flex flex-col sidebar-nav px-4 mt-5">
                <ul id="sidebarnav" class="text-gray-600 text-sm">
                    <li class="text-xs font-bold pb-[5px]">
                        <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                        <span class="text-xs text-gray-400 font-semibold">HOME</span>
                    </li>

                    <?php
                    if ($_SESSION['role'] == '1') {
                    ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base  flex items-center relative  rounded-md text-gray-500  w-full"
                                href="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/little-kids/views/admin/index.php">
                                <i class="ti ti-layout-dashboard ps-2  text-2xl"></i> <span>หน้าหลัก</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base  flex items-center relative  rounded-md text-gray-500  w-full"
                                href="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/little-kids/views/admin/admin_manage.php">
                                <i class="ti ti-user ps-2 text-2xl"></i> <span>จัดการข้อมูลผู้ดูแลระบบ</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base  flex items-center relative  rounded-md text-gray-500  w-full" href="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/little-kids/views/admin/director_manage.php">
                                <i class="ti ti-user ps-2 text-2xl"></i> <span>จัดการข้อมูลผู้อำนวยการ</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base  flex items-center relative  rounded-md text-gray-500  w-full" href="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/little-kids/views/admin/teacher_manage.php">
                                <i class="ti ti-user ps-2 text-2xl"></i> <span>จัดการข้อมูลครู</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full" href="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/little-kids/views/teacher/student.php">
                                <i class="ti ti-user ps-2 text-2xl"></i> <span>จัดการข้อมูลนักเรียน</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full" href="parent_manage.php">
                                <i class="ti ti-user ps-2 text-2xl"></i> <span>จัดการข้อมูลผู้ปกครอง</span>
                            </a>
                        </li>

                    <?php
                    } else if ($_SESSION['role'] == '2') {
                    ?>

                    <?php
                    } else if ($_SESSION['role'] == '3') {
                    ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base  flex items-center relative  rounded-md text-gray-500  w-full"
                                href="index.php">
                                <i class="ti ti-layout-dashboard ps-2  text-2xl"></i> <span>หน้าหลัก</span>
                            </a>
                        </li>

                        <li class="text-xs font-bold mb-4 mt-6">
                            <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                            <span class="text-xs text-gray-400 font-semibold">นักเรียน</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full"
                                href="student.php">
                                <i class="ti ti-article ps-2 text-2xl"></i> <span>ข้อมูลนักเรียน</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full"
                                href="attendance.php">
                                <i class="ti ti-article ps-2 text-2xl"></i> <span>ข้อมูลการมาเรียน</span>
                            </a>
                        </li>



                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full"
                                href="activity.php">
                                <i class="ti ti-article ps-2 text-2xl"></i> <span>ตารางกิจกรรม</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full"
                                href="eventcalendar.php">
                                <i class="ti ti-article ps-2 text-2xl"></i> <span>ปฏิทินกิจกรรม</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full"
                                href="./components/cards.html">
                                <i class="ti ti-article ps-2 text-2xl"></i> <span>พัฒนาการของนักเรียน</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full"
                                href="./components/cards.html">
                                <i class="ti ti-article ps-2 text-2xl"></i> <span>แบบประเมิน</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full"
                                href="profile.php">
                                <i class="ti ti-article ps-2 text-2xl"></i> <span>โปรไฟล์</span>
                            </a>
                        </li>

                    <?php
                    } else if ($_SESSION['role'] == '4') {
                    ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base  flex items-center relative  rounded-md text-gray-500  w-full"
                                href="index.php">
                                <i class="ti ti-layout-dashboard ps-2  text-2xl"></i> <span>หน้าหลัก</span>
                            </a>
                        </li>

                        <li class="text-xs font-bold mb-4 mt-6">
                            <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                            <span class="text-xs text-gray-400 font-semibold">นักเรียน</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full"
                                href="attendance.php">
                                <i class="ti ti-article ps-2 text-2xl"></i> <span>ข้อมูลการมาเรียน</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full"
                                href="activity.php">
                                <i class="ti ti-article ps-2 text-2xl"></i> <span>ตารางกิจกรรม</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full"
                                href="eventcalendar.php">
                                <i class="ti ti-article ps-2 text-2xl"></i> <span>ปฏิทินกิจกรรม</span>
                            </a>
                        </li>
                    <?php
                    } else if ($_SESSION['role'] == '5') {

                    ?>
                    <?php
                    } else {
                    }
                    ?>




                </ul>
            </nav>
        </div>

        <!-- Bottom Upgrade Option -->
        <div class="m-4  relative grid">
            <a href="../../src/logout.php" class="text-base font-semibold hover:bg-blue-700 btn">ออกจากระบบ</a>
        </div>
        <!-- </aside> -->
    </aside>


    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../../assets/libs/iconify-icon/dist/iconify-icon.min.js"></script>
    <script src="../../assets/libs/@preline/dropdown/index.js"></script>
    <script src="../../assets/libs/@preline/overlay/index.js"></script>
    <script src="../../assets/js/sidebarmenu.js"></script>

    <script src="../../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../../assets/js/dashboard.js"></script>

</body>

</html>