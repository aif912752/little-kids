<?php
include 'config/database.php';

// Query ข้อมูลกิจกรรมจากฐานข้อมูล
$sql = "SELECT id, activity_type, activity_name, activity_description, activity_date_start, activity_date_end FROM activity";
$result = $connect->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercy - Tailwind Template</title>
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" integrity="sha512-7x3zila4t2qNycrtZ31HO0NnJr8kg2VI67YLoRSyi9hGhRN66FHYWr7Axa9Y1J9tGYHVBPqIjSE1ogHrJTz51g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">

</head>
<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body class="font-body">

    <!-- home section -->
    <section class="bg-white py-10 md:mb-10">

        <div class="container max-w-screen-xl mx-auto px-4">

            <nav class="flex-wrap lg:flex items-center" x-data="{navbarOpen:false}">
                <div class="flex items-center mb-10 lg:mb-0">
                    <img src="assets/image/navbar-logo.png" alt="Logo">

                    <button class="lg:hidden w-10 h-10 ml-auto flex items-center justify-center border border-blue-500 text-blue-500 rounded-md" @click="navbarOpen = !navbarOpen">
                        <i data-feather="menu"></i>
                    </button>
                </div>

                <ul class="lg:flex flex-col lg:flex-row lg:items-center lg:mx-auto lg:space-x-8 xl:space-x-14" :class="{'hidden':!navbarOpen,'flex':navbarOpen}">
                    <li class="font-semibold text-gray-900 hover:text-gray-400 transition ease-in-out duration-300 mb-5 lg:mb-0">
                        <a href="#">หน้าหลัก</a>
                    </li>

                </ul>

                <div class="lg:flex flex-col md:flex-row md:items-center text-center md:space-x-6" :class="{'hidden':!navbarOpen,'flex':navbarOpen}">
                    <a href="./login.php" class="px-6 py-4 bg-blue-500 text-white font-semibold text-lg rounded-xl hover:bg-blue-700 transition ease-in-out duration-500 mb-5 md:mb-0">เข้าสู่ระบบ</a>

                </div>
            </nav>

            <div class="flex flex-col lg:flex-row justify-between space-x-20">
                <div class="text-center lg:text-left mt-40">
                    <h1 class="font-semibold text-gray-900 text-3xl md:text-6xl leading-normal mb-6">สถานรับเลี้ยงเด็กอนุบาล
                        <br> ลิตเติ้ลคิดส์
                    </h1>


                </div>

                <div class="mt-24">
                    <img src="/little-kids/public/humans.png" alt="Image">
                </div>
            </div>

        </div> <!-- container.// -->

    </section>
    <!-- home section //end -->


    <!-- donation section -->
    <section class="bg-white py-16">
        <div class="container max-w-screen-xl mx-auto px-4">

            <h1 class="font-semibold text-gray-900 text-xl md:text-4xl text-center mb-16">กิจกรรม</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <?php
                // ตรวจสอบว่ามีข้อมูลในตารางหรือไม่
                if ($result->num_rows > 0) {
                    // วนลูปแสดงข้อมูลกิจกรรม
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="px-6 py-6 w-full border-2 border-gray-200 rounded-3xl">

                            <h4 class="font-semibold text-gray-900 text-lg md:text-2xl mb-6"><?php echo $row['activity_name']; ?> </h4>

                            <p class="font-light text-gray-400 text-sm md:text-md lg:text-lg mb-10">
                            <?php echo $row['activity_description']; ?>
                                 </p>

                            <div class="flex items-center justify-between mb-8">
                                <h6 class="font-light text-gray-400 text-sm md:text-lg">เริ่ม : <span class="font-semibold text-gray-900 text-md md:text-lg"><?php echo $row['activity_date_start']; ?></span></h6>

                                <h6 class="font-light text-gray-400 text-sm md:text-lg">สิ้นสุด : <span class="font-semibold text-gray-900 text-md md:text-lg"><?php echo $row['activity_date_end']; ?></span></h6>
                            </div>
                        </div>

                <?php
                    }
                } else {
                    // ถ้าไม่มีข้อมูลกิจกรรม
                    echo "<p>ไม่มีกิจกรรมที่จะแสดง</p>";
                }
                ?>
            </div>



        </div> <!-- container.// -->
    </section>
    <!-- donation section //end -->




    <!-- join volunters section //end -->

    <footer class="bg-white py-16">

        <div class="container max-w-screen-xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row lg:justify-between">

                <div class="space-y-7 mb-10 lg:mb-0">
                    <div class="flex justify-center lg:justify-start">
                        <img src="assets/image/footer-logo.png" alt="Image">
                    </div>

                    <p class="font-light text-gray-400 text-md md:text-lg text-center lg:text-left">Donate and help others people <br> around the world</p>

                    <div class="flex items-center justify-center lg:justify-start space-x-5">
                        <a href="#" class="px-3 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-info hover:text-white transition ease-in-out duration-500">
                            <i data-feather="facebook"></i>
                        </a>

                        <a href="#" class="px-3 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-info hover:text-white transition ease-in-out duration-500">
                            <i data-feather="twitter"></i>
                        </a>

                        <a href="#" class="px-3 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-info hover:text-white transition ease-in-out duration-500">
                            <i data-feather="linkedin"></i>
                        </a>
                    </div>
                </div>

                <div class="text-center lg:text-left space-y-7 mb-10 lg:mb-0">
                    <h4 class="font-semibold text-gray-900 text-lg md:text-2xl">Quick links</h4>

                    <a href="#" class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">Charity Ratings</a>

                    <a href="#" class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">Top-Rated Charities</a>

                    <a href="#" class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">Top Compensation</a>

                    <a href="#" class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">High Asset Charities</a>
                </div>

                <div class="text-center lg:text-left space-y-7 mb-10 lg:mb-0">
                    <h4 class="font-semibold text-gray-900 text-lg md:text-2xl">Company</h4>

                    <a href="#" class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">About Us</a>

                    <a href="#" class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">Journalists / Media</a>

                    <a href="#" class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">Membership</a>

                    <a href="#" class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">Blog</a>
                </div>

                <div class="text-center lg:text-left space-y-7 mb-10 lg:mb-0">
                    <h4 class="font-semibold text-gray-900 text-lg md:text-2xl">Legal</h4>

                    <a href="#" class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">FAQ</a>

                    <a href="#" class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">Terms & Conditions</a>
                </div>

            </div>
        </div> <!-- container.// -->

    </footer>

    <script>
        feather.replace()
    </script>

</body>

</html>