<?php
include '../../config/database.php';
$sql = "SELECT * FROM attendance  ";
$result = $connect->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">

</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>

            <div class=" w-full page-wrapper xl:px-6 px-0">

                <!-- Main Content -->
                <main class="h-full  max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        <!--  Header Start -->
                        <header class=" bg-white shadow-md rounded-md w-full text-sm py-4 px-6">


                            <!-- ========== HEADER ========== -->

                            <nav class=" w-ful flex items-center justify-between" aria-label="Global">
                                <ul class="icon-nav flex items-center gap-4">
                                    <li class="relative xl:hidden">
                                        <a class="text-xl  icon-hover cursor-pointer text-heading" id="headerCollapse"
                                            data-hs-overlay="#application-sidebar-brand"
                                            aria-controls="application-sidebar-brand" aria-label="Toggle navigation"
                                            href="javascript:void(0)">
                                            <i class="ti ti-menu-2 relative z-1"></i>
                                        </a>
                                    </li>


                                </ul>
                                <div class="flex items-center gap-4">

                                    <div
                                        class="hs-dropdown relative inline-flex [--placement:bottom-right] sm:[--trigger:hover]">
                                        <a class="relative hs-dropdown-toggle cursor-pointer align-middle rounded-full">
                                            <img class="object-cover w-9 h-9 rounded-full"
                                                src="../../public/student.jpg" alt="" aria-hidden="true">
                                        </a>
                                        <div class="card hs-dropdown-menu transition-[opacity,margin] rounded-md duration hs-dropdown-open:opacity-100 opacity-0 mt-2 min-w-max  w-[200px] hidden z-[12]"
                                            aria-labelledby="hs-dropdown-custom-icon-trigger">
                                            <div class="card-body p-0 py-2">
                                                <a href="javscript:void(0)"
                                                    class="flex gap-2 items-center font-medium px-4 py-1.5 hover:bg-gray-200 text-gray-400">
                                                    <i class="ti ti-user  text-xl "></i>
                                                    <p class="text-sm ">My Profile</p>
                                                </a>


                                                <div class="px-4 mt-[7px] grid">
                                                    <a href="../../src/logout.php"
                                                        class="btn-outline-primary font-medium text-[15px] w-full hover:bg-blue-600 hover:text-white">Logout</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </nav>

                            <!-- ========== END HEADER ========== -->
                        </header>
                        <!--  Header End -->


                        <div class="col-span-2">
                            <div class="card h-full">
                                <div class="card-body">
                                    <h4 class="text-gray-500 text-lg font-semibold mb-5">ข้อมูลการมาเรียน</h4>
                                    <div class="relative overflow-x-auto">
                                        <!-- table -->
                                        <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                                            <thead>
                                                <tr class="text-sm">
                                                    <th scope="col" class="p-4 font-semibold">ชื่อ-นามสกุล</th>
                                                    <th scope="col" class="p-4 font-semibold">วันที่</th>

                                                    <th scope="col" class="p-4 font-semibold">เวลาเข้า</th>
                                                    <th scope="col" class="p-4 font-semibold">เวลาออก</th>
                                                    <th scope="col" class="p-4 font-semibold">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>

                                                        <tr>
                                                            <td class="p-4 text-sm">
                                                                <div class="flex gap-6 items-center">
                                                                    <div class="h-12 w-12 inline-block"><img
                                                                            src="./assets/images/profile/user-1.jpg" alt=""
                                                                            class="rounded-full w-100"></div>
                                                                    <div class="flex flex-col gap-1 text-gray-500">
                                                                        <h3 class=" font-bold"><?php echo $row['student_name'] . ' ' . $row['student_lastname']; ?></h3>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="p-4">
                                                                <h3 class="font-medium"><?php echo $row['attendance_date']; ?></h3>
                                                            </td>
                                                            <td class="p-4">
                                                                <h3 class="font-medium"><?php echo $row['check_in_time']; ?></h3>
                                                            </td>
                                                            <td class="p-4">
                                                                <h3 class="font-medium"><?php echo $row['check_out_time']; ?></h3>
                                                            </td>
                                                            <td class="p-4">
                                                                <span
                                                                    class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-teal-500"><?php echo $row['status']; ?></span>
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


    </main>
    </div>
    </div>
    <!--end of project-->
    </main>
</body>



</html>