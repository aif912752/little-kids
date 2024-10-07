<?php
include 'config/database.php';

// Query ข้อมูลกิจกรรมจากฐานข้อมูล (ส่วนนี้จะยังคงอยู่เพื่อใช้ในส่วนอื่น)
$sql_activity = "SELECT id, activity_type, activity_name, activity_description, activity_date_start, activity_date_end FROM activity";
$result_activity = $connect->query($sql_activity);

// Query ข้อมูลข่าวจากตาราง news สำหรับการแสดงข่าวสาร
$sql_news = "SELECT title, details, img FROM news";
$result_news = $connect->query($sql_news);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <title>ลิตเติ้ลคิดส์ - สถานรับเลี้ยงเด็กอนุบาล</title>

    <meta
        name="description"
        content="Freebie 44 - Marketing Web App (Tailwind CSS). Check out more at https://pixelcave.com" />
    <meta name="author" content="pixelcave" />

    <!-- Icons -->
    <link
        rel="icon"
        href="/little-kids/public/2.png"
        sizes="any"
        type="image/svg+xml" />
    <link
        rel="icon"
        href="/little-kids/public/2.png"
        type="image/png" />

    <!-- Inter web font from bunny.net (GDPR compliant) -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link
        href="https://fonts.bunny.net/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />

    <!-- Tailwind CSS Play CDN (mainly for development/testing purposes) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>

    <!-- Tailwind CSS v3 Configuration -->

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">

</head>
<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body>
    <!-- Page Container -->
    <div
        id="page-container"
        class="mx-auto flex min-h-dvh w-full min-w-[320px] flex-col bg-gray-100">
        <!-- Page Content -->
        <main id="page-content" class="flex max-w-full flex-auto flex-col">
            <!-- Hero -->
            <div class="bg-[#4379F2]">
                <!-- Header -->
                <header id="page-header" class="flex flex-none items-center py-10">
                    <div
                        class="container mx-auto flex flex-col gap-6 px-4 text-center sm:flex-row sm:items-center sm:justify-between sm:gap-0 lg:px-8 xl:max-w-6xl">
                        <div>
                            <a
                                href="javascript:void(0)"
                                class="inline-flex items-center gap-2 text-lg font-bold tracking-wide text-white hover:opacity-75">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    data-slot="icon"
                                    class="hi-mini hi-link inline-block size-5 opacity-50">
                                    <path
                                        d="M12.232 4.232a2.5 2.5 0 0 1 3.536 3.536l-1.225 1.224a.75.75 0 0 0 1.061 1.06l1.224-1.224a4 4 0 0 0-5.656-5.656l-3 3a4 4 0 0 0 .225 5.865.75.75 0 0 0 .977-1.138 2.5 2.5 0 0 1-.142-3.667l3-3Z" />
                                    <path
                                        d="M11.603 7.963a.75.75 0 0 0-.977 1.138 2.5 2.5 0 0 1 .142 3.667l-3 3a2.5 2.5 0 0 1-3.536-3.536l1.225-1.224a.75.75 0 0 0-1.061-1.06l-1.224 1.224a4 4 0 1 0 5.656 5.656l3-3a4 4 0 0 0-.225-5.865Z" />
                                </svg>
                                <span>ลิตเติ้ลคิดส์</span>
                            </a>
                        </div>
                        <nav
                            class="flex items-center justify-center gap-4 text-sm sm:gap-6">
                            <a
                                href="index.php"
                                class="font-semibold text-white hover:text-white">
                                <span>หน้าแรก</span>
                            </a>


                            <a
                                href="login.php"
                                class="inline-flex items-center gap-2 font-semibold text-white hover:text-white">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    data-slot="icon"
                                    class="hi-mini hi-user-circle inline-block size-5 opacity-50">
                                    <path
                                        fill-rule="evenodd"
                                        d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>เข้าสู่ระบบ</span>
                            </a>
                        </nav>
                    </div>
                </header>
                <!-- END Header -->

                <!-- Hero Content -->
                <div
                    class="container mx-auto px-4 pt-16 lg:px-8 lg:pt-32 xl:max-w-6xl">
                    <div class="text-center">
                        <h2
                            class="mb-4 text-balance text-3xl font-extrabold text-white md:text-5xl">
                            สถานรับเลี้ยงเด็กอนุบาลลิตเติ้ลคิดส์
                        </h2>

                    </div>
                    <div class="flex flex-wrap justify-center gap-4 pb-16 pt-10">
                        <a href="login.php"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-blue-800 bg-[#1C1678] px-6 py-4 font-semibold leading-6 text-white hover:border-blue-700/50 hover:bg-blue-700/50 hover:text-white focus:outline-none focus:ring focus:ring-blue-500/50 active:border-blue-700 active:bg-blue-700">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                data-slot="icon"
                                class="hi-mini hi-arrow-right inline-block size-5 opacity-50">
                                <path
                                    fill-rule="evenodd"
                                    d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>เข้าสู่ระบบ</span>
                        </a>

                    </div>
                    <div
                        class="relative mx-5 -mb-20 rounded-xl bg-white p-2 shadow-lg sm:-mb-40 lg:mx-32">
                        <div class="aspect-h-10 aspect-w-16 w-full bg-gray-200">
                            <img
                                src="/little-kids/public/Little.jpg"
                                alt="Hero Image"
                                class="mx-auto rounded-lg" />
                        </div>
                    </div>
                </div>
                <!-- END Hero Content -->
            </div>
            <!-- END Hero -->

            <!-- Features Section -->
            <div class="bg-white pt-40">
                <div
                    class="container mx-auto space-y-16 px-4 py-16 lg:px-8 lg:py-32 xl:max-w-6xl">
                    <!-- Heading -->
                    <div class="text-center">
                        <h2 class="mb-4 text-3xl font-extrabold md:text-4xl">
                            ข่าวสารต่างๆ
                        </h2>

                    </div>
                    <!-- END Heading -->

                    <!-- Features -->
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3 md:gap-12">
                        <?php while ($row = $result_news->fetch_assoc()): ?>

                            <div class="py-5 text-center">
                                <?php
                                $img_src = !empty($row['img']) ? 'views/admin/uploads/' . $row['img'] : 'path/to/default-image.jpg';
                                ?>
                                <img src="<?php echo htmlspecialchars($img_src); ?>"
                                    class="object-cover w-full mb-2 overflow-hidden rounded-lg shadow-sm max-h-56 btn-"
                                    alt="" />
                                <h4 class="mb-2 text-xl font-bold"><?php echo $row['title']; ?></h4>
                                <p class="text-left leading-relaxed text-gray-600">
                                    <?php echo $row['details']; ?>
                                </p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <!-- END Features -->
                </div>
            </div>
            <!-- END Features Section -->

            <!-- How it works -->
            <div class="relative bg-white">
                <div class="absolute inset-0 skew-y-1 bg-blue-900"></div>
                <div
                    class="container relative mx-auto space-y-16 px-4 py-16 lg:px-8 lg:py-32 xl:max-w-7xl">
                    <!-- Heading -->
                    <div class="text-center">
                        <h2 class="text-3xl font-extrabold text-white md:text-4xl">
                            กิจกรรม
                        </h2>
                    </div>
                    <!-- END Heading -->

                    <!-- Steps -->
                    <div
                        class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3">
                        <?php
                        // ตรวจสอบว่ามีข้อมูลในตารางหรือไม่
                        if ($result_activity->num_rows > 0) {
                            // วนลูปแสดงข้อมูลกิจกรรม
                            while ($row = $result_activity->fetch_assoc()) {
                        ?>
                                <div
                                    class="rounded-3xl bg-white/5 p-10 shadow-sm transition hover:bg-white/10">
                                    <svg
                                        class="hi-solid hi-desktop-computer mb-5 inline-block h-12 w-12 text-blue-300"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <h4 class="mb-2 text-lg font-bold text-white">
                                        <?php echo $row['activity_name']; ?>
                                    </h4>
                                    <p class="text-sm leading-relaxed text-white/75">
                                        <?php echo $row['activity_description']; ?>
                                    </p>
                                </div>

                        <?php
                            }
                        } else {
                            // ถ้าไม่มีข้อมูลกิจกรรม
                            echo "<p>ไม่มีกิจกรรมที่จะแสดง</p>";
                        }
                        ?>
                    </div>
                    <!-- END Steps -->
                </div>
            </div>
            <!-- How it works -->


            <!-- END Pricing Section -->


            <!-- Stats Section -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-white">
                <div
                    class="container mx-auto flex flex-col gap-6 px-4 py-16 text-center text-sm md:flex-row md:justify-between md:gap-0 md:text-left lg:px-8 lg:py-32 xl:max-w-6xl">
                    <nav class="space-x-2 sm:space-x-4">
                        <a
                            href="javascript:void(0)"
                            class="font-medium text-gray-700 hover:text-blue-500">
                            About
                        </a>
                        <a
                            href="javascript:void(0)"
                            class="font-medium text-gray-700 hover:text-blue-500">
                            Terms of Service
                        </a>
                        <a
                            href="javascript:void(0)"
                            class="font-medium text-gray-700 hover:text-blue-500">
                            Privacy Policy
                        </a>
                    </nav>
                    <div class="text-gray-500">
                        <span class="font-medium">Company</span> ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </main>
        <!-- END Page Content -->
    </div>
    <!-- END Page Container -->
</body>

</html>