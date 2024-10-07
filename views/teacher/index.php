<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Teacher Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">

</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>
            <?php
            include '../../config/database.php';

            // เอา user_id ไปเอาหา student_id 
            $sql_student_id = "SELECT student_id FROM students WHERE user_id = " . $_SESSION['user_id'];
            $result_student_id = $connect->query($sql_student_id);
            $student_id = $result_student_id->fetch_assoc()['student_id'] ?? 0;

            $sql = "SELECT * FROM attendance WHERE student_id = $student_id";
            $result = $connect->query($sql);

            // ดึงจำนวนครูจากตาราง teacher
            $sql_teacher_count = "SELECT COUNT(*) as teacher_count FROM teacher";
            $result_teacher_count = $connect->query($sql_teacher_count);
            $teacher_count = $result_teacher_count->fetch_assoc()['teacher_count'] ?? 0;

            // ดึงจำนวนนักเรียนจากตาราง students
            $sql_student_count = "SELECT COUNT(*) as student_count FROM students";
            $result_student_count = $connect->query($sql_student_count);
            $student_count = $result_student_count->fetch_assoc()['student_count'] ?? 0;

            // ดึงจำนวนข่าวสารและกิจกรรมจากตาราง activity
            $sql_activity_count = "SELECT COUNT(*) as activity_count FROM activity";
            $result_activity_count = $connect->query($sql_activity_count);
            $activity_count = $result_activity_count->fetch_assoc()['activity_count'] ?? 0;

            // เพิ่มเติม: ดึงจำนวนผู้ปกครองจากตาราง guardians
            $sql_guardian_count = "SELECT COUNT(*) as guardian_count FROM guardians";
            $result_guardian_count = $connect->query($sql_guardian_count);
            $guardian_count = $result_guardian_count->fetch_assoc()['guardian_count'] ?? 0;

            // คำนวณจำนวนรวมทั้งหมด
            $total_count = $teacher_count + $student_count + $guardian_count;

            // Fetch activity data
            $sql_activity = "SELECT DATE(activity_date_start) as date, COUNT(*) as count FROM activity GROUP BY DATE(activity_date_start) ORDER BY date DESC LIMIT 11";
            $result_activity = $connect->query($sql_activity);
            $activity_data = [];
            $dates = [];

            while ($row = $result_activity->fetch_assoc()) {
                $activity_data[] = $row['count'];
                $dates[] = date('M d', strtotime($row['date']));
            }

            // Fetch news data
            $sql_news = "SELECT DATE(created_at) as date, COUNT(*) as count FROM news GROUP BY DATE(created_at) ORDER BY date DESC LIMIT 11";
            $result_news = $connect->query($sql_news);
            $news_data = [];

            while ($row = $result_news->fetch_assoc()) {
                $news_data[] = $row['count'];
            }


            // Ensure both arrays have 11 elements, fill with 0 if necessary
            $activity_data = array_pad($activity_data, 11, 0);
            $news_data = array_pad($news_data, 11, 0);
            $dates = array_pad($dates, 11, '');

            // Reverse the arrays to display oldest data first
            $activity_data = array_reverse($activity_data);
            $news_data = array_reverse($news_data);
            $dates = array_reverse($dates);

            // Convert PHP arrays to JSON for use in JavaScript
            $activity_json = json_encode($activity_data);
            $news_json = json_encode($news_data);
            $dates_json = json_encode($dates);
            ?>

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
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                href="#">
                                <div class="p-5">
                                    <div class="flex justify-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 36 36">
                                            <path fill="#292F33" d="M31 36v-3.5c0-3.314-3.685-5.5-7-5.5H12c-3.313 0-7 2.186-7 5.5V36h26z" />
                                            <path fill="#66757F" d="M8.1 33.341c.251 0 .401 2.659.401 2.659h-.956s.193-2.659.555-2.659m3 0c.251 0 .401 2.659.401 2.659h-.957c.001 0 .194-2.659.556-2.659m13.845 0c-.25 0-.4 2.659-.4 2.659h.955s-.193-2.659-.555-2.659m3 0c-.25 0-.4 2.659-.4 2.659h.955s-.193-2.659-.555-2.659" />
                                            <path fill="#9266CC" d="M18 34.411C22.078 32.463 23.62 27 23.62 27H12.38s1.542 5.463 5.62 7.411z" />
                                            <path fill="#744EAA" d="M13 27h9.875s-1.256 3.5-4.938 3.5S13 27 13 27" />
                                            <path fill="#FFAC33" d="M17.944 5.069c4.106 0 10.948 2.053 10.948 10.948s0 10.948-2.053 10.948c-2.054 0-4.79-2.053-8.896-2.053c-4.105 0-6.784 2.053-8.895 2.053c-2.287 0-2.053-8.211-2.053-10.948c.002-8.895 6.844-10.948 10.949-10.948" />
                                            <path fill="#FFDC5D" d="M14.328 27.02C14.328 28.5 16.5 29 18 29s3.66-.5 3.66-1.98v-3.205h-7.332v3.205z" />
                                            <path fill="#F9CA55" d="M14.321 25.179c1.023 1.155 2.291 1.468 3.669 1.468c1.379 0 2.647-.312 3.67-1.468v-2.936h-7.339v2.936z" />
                                            <path fill="#FFDC5D" d="M9.734 15.717c0-5.834 3.676-10.563 8.21-10.563c4.534 0 8.211 4.729 8.211 10.563c0 5.833-3.677 10.286-8.211 10.286c-4.534 0-8.21-4.452-8.21-10.286" />
                                            <path fill="#DF1F32" d="M17.944 23.543c-1.605 0-2.446-.794-2.536-.885a.684.684 0 0 1 .96-.974c.035.032.553.491 1.576.491c1.039 0 1.557-.473 1.577-.492a.688.688 0 0 1 .963.02c.26.269.26.691-.004.955c-.089.091-.929.885-2.536.885" />
                                            <path fill="#662113" d="M14.608 17.886a.849.849 0 0 1-.846-.846v-.845c0-.465.381-.846.846-.846s.847.381.847.846v.845a.85.85 0 0 1-.847.846m6.765 0a.849.849 0 0 1-.846-.846v-.845c0-.465.381-.846.846-.846c.465 0 .846.381.846.846v.845a.849.849 0 0 1-.846.846" />
                                            <path fill="#C1694F" d="M18.837 20.5h-1.691a.424.424 0 0 1-.423-.423v-.153c0-.233.189-.424.423-.424h1.691c.232 0 .423.19.423.424v.153a.424.424 0 0 1-.423.423" />
                                            <path fill="#FFAC33" d="M7.725 19c-.021-1-.044-.224-.044-.465c0-3.422 2.053.494 2.053-1.943c0-2.439 1.368-2.683 2.736-4.051c.685-.685 2.053-2.026 2.053-2.026s3.421 2.067 6.158 2.067c2.736 0 5.474 1.375 5.474 4.112s2.053-1.584 2.053 1.837c0 .244-.023-.531-.04.469h.718c.007-2 .007-1.924.007-3.202c0-8.895-6.843-12.207-10.948-12.207S6.998 6.848 6.998 15.743c0 .793-.02 1.257.008 3.257h.719z" />
                                            <path fill="#FFDC5D" d="M11.444 15.936c0 1.448-.734 2.622-1.639 2.622s-1.639-1.174-1.639-2.622s.734-2.623 1.639-2.623c.905-.001 1.639 1.174 1.639 2.623m16.389 0c0 1.448-.733 2.622-1.639 2.622c-.905 0-1.639-1.174-1.639-2.622s.733-2.623 1.639-2.623c.906-.001 1.639 1.174 1.639 2.623" />
                                            <path fill="#292F33" d="m32.104 3.511l-14-3a.491.491 0 0 0-.209 0l-14 3a.5.5 0 0 0-.032.97l4.944 1.413C8.615 6.489 8.5 7.176 8.5 8c0 2.29 3.285 3.5 9.5 3.5s9.5-1.21 9.5-3.5c0-.824-.115-1.511-.307-2.106l4.945-1.413a.5.5 0 0 0-.034-.97z" />
                                            <path fill="#66757F" d="M32.48 3.863a.502.502 0 0 0-.618-.344L18 7.48L4.137 3.519a.5.5 0 1 0-.274.962l14 4a.49.49 0 0 0 .273 0l14-4a.498.498 0 0 0 .344-.618z" />
                                            <path fill="#FFCC4D" d="m17.958 3.502l-12 1c-.026.002-.458.057-.458.498v6.095c-.299.186-.5.74-.5 2.405c0 2.485.448 4.5 1 4.5s1-2.015 1-4.5c0-1.665-.201-2.219-.5-2.405V5.46l11.542-.962a.5.5 0 0 0-.084-.996z" />
                                        </svg>

                                    </div>
                                    <div class="ml-2 w-full flex-1">
                                        <div>
                                            <div class="mt-3 text-3xl font-bold leading-8"><?php echo $student_count; ?></div>

                                            <div class="mt-1 text-base text-gray-800">นักเรียนทั้งหมด</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                href="#">
                                <div class="p-5">
                                    <div class="flex justify-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 128 128">
                                            <linearGradient id="notoTeacherLightSkinTone0" x1="63.999" x2="63.999" y1="116.605" y2="39.511" gradientTransform="matrix(1 0 0 -1 0 128)" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#26A69A" />
                                                <stop offset="1" stop-color="#00796B" />
                                            </linearGradient>
                                            <path fill="url(#notoTeacherLightSkinTone0)" d="M6.36 10.9h115.29v77.52H6.36z" />
                                            <linearGradient id="notoTeacherLightSkinTone1" x1="63.999" x2="63.999" y1="119.455" y2="37.224" gradientTransform="matrix(1 0 0 -1 0 128)" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#8D6E63" />
                                                <stop offset=".779" stop-color="#795548" />
                                            </linearGradient>
                                            <path fill="url(#notoTeacherLightSkinTone1)" d="M119.29 13.26v72.81H8.71V13.26h110.58M124 8.55H4v82.23h120V8.55z" />
                                            <path fill="#312D2D" d="M98.9 79.85c-1.25-2.27.34-4.58 3.06-7.44c4.31-4.54 9-15.07 4.64-25.76c.03-.06-.86-1.86-.83-1.92l-1.79-.09c-.57-.08-20.26-.12-39.97-.12s-39.4.04-39.97.12c0 0-2.65 1.95-2.63 2.01c-4.35 10.69.33 21.21 4.64 25.76c2.71 2.86 4.3 5.17 3.06 7.44c-1.21 2.21-4.81 2.53-4.81 2.53s.83 2.26 2.83 3.48c1.85 1.13 4.13 1.39 5.7 1.43c0 0 6.15 8.51 22.23 8.51h17.9c16.08 0 22.23-8.51 22.23-8.51c1.57-.04 3.85-.3 5.7-1.43c2-1.22 2.83-3.48 2.83-3.48s-3.61-.32-4.82-2.53z" />
                                            <radialGradient id="notoTeacherLightSkinTone2" cx="99.638" cy="45.85" r="23.419" gradientTransform="matrix(1 0 0 .4912 -21.055 59.629)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".728" stop-color="#454140" stop-opacity="0" />
                                                <stop offset="1" stop-color="#454140" />
                                            </radialGradient>
                                            <path fill="url(#notoTeacherLightSkinTone2)" d="M63.99 95.79v-9.44l28.57-2.26l2.6 3.2s-6.15 8.51-22.23 8.51l-8.94-.01z" />
                                            <radialGradient id="notoTeacherLightSkinTone3" cx="76.573" cy="49.332" r="6.921" gradientTransform="matrix(-.9057 .4238 -.3144 -.6719 186.513 79.36)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".663" stop-color="#454140" />
                                                <stop offset="1" stop-color="#454140" stop-opacity="0" />
                                            </radialGradient>
                                            <path fill="url(#notoTeacherLightSkinTone3)" d="M95.1 83.16c-4.28-6.5 5.21-8.93 5.21-8.93l.01.01c-1.65 2.05-2.4 3.84-1.43 5.61c1.21 2.21 4.81 2.53 4.81 2.53s-4.91 4.36-8.6.78z" />
                                            <radialGradient id="notoTeacherLightSkinTone4" cx="94.509" cy="68.91" r="30.399" gradientTransform="matrix(-.0746 -.9972 .8311 -.0622 33.494 157.622)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".725" stop-color="#454140" stop-opacity="0" />
                                                <stop offset="1" stop-color="#454140" />
                                            </radialGradient>
                                            <path fill="url(#notoTeacherLightSkinTone4)" d="M106.62 46.65c4.25 10.35-.22 21.01-4.41 25.51c-.57.62-3.01 3.01-3.57 4.92c0 0-9.54-13.31-12.39-21.13c-.57-1.58-1.1-3.2-1.17-4.88c-.05-1.26.14-2.76.87-3.83c.89-1.31 20.16-1.7 20.16-1.7c0 .01.51 1.11.51 1.11z" />
                                            <radialGradient id="notoTeacherLightSkinTone5" cx="44.31" cy="68.91" r="30.399" gradientTransform="matrix(.0746 -.9972 -.8311 -.0622 98.274 107.563)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".725" stop-color="#454140" stop-opacity="0" />
                                                <stop offset="1" stop-color="#454140" />
                                            </radialGradient>
                                            <path fill="url(#notoTeacherLightSkinTone5)" d="M21.4 46.65c-4.24 10.35.23 21.01 4.41 25.5c.58.62 3.01 3.01 3.57 4.92c0 0 9.54-13.31 12.39-21.13c.58-1.58 1.1-3.2 1.17-4.88c.05-1.26-.14-2.76-.87-3.83c-.89-1.31-1.93-.96-3.44-.96c-2.88 0-15.49-.74-16.47-.74c.01.02-.76 1.12-.76 1.12z" />
                                            <radialGradient id="notoTeacherLightSkinTone6" cx="49.439" cy="45.85" r="23.419" gradientTransform="matrix(-1 0 0 .4912 98.878 59.629)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".728" stop-color="#454140" stop-opacity="0" />
                                                <stop offset="1" stop-color="#454140" />
                                            </radialGradient>
                                            <path fill="url(#notoTeacherLightSkinTone6)" d="M64.03 95.79v-9.44l-28.57-2.26l-2.6 3.2s6.15 8.51 22.23 8.51l8.94-.01z" />
                                            <radialGradient id="notoTeacherLightSkinTone7" cx="26.374" cy="49.332" r="6.921" gradientTransform="matrix(.9057 .4238 .3144 -.6719 -13.024 100.635)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".663" stop-color="#454140" />
                                                <stop offset="1" stop-color="#454140" stop-opacity="0" />
                                            </radialGradient>
                                            <path fill="url(#notoTeacherLightSkinTone7)" d="M32.92 83.16c4.28-6.5-5.21-8.93-5.21-8.93l-.01.01c1.65 2.05 2.4 3.84 1.43 5.61c-1.21 2.21-4.81 2.53-4.81 2.53s4.91 4.36 8.6.78z" />
                                            <linearGradient id="notoTeacherLightSkinTone8" x1="64" x2="64" y1="25.908" y2="10.938" gradientTransform="matrix(1 0 0 -1 0 128)" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#E1F5FE" />
                                                <stop offset="1" stop-color="#81D4FA" />
                                            </linearGradient>
                                            <path fill="url(#notoTeacherLightSkinTone8)" d="M114.5 120.75c0-15.47-25.34-23.56-50.36-23.56H64c-25.14.03-50.5 7.32-50.5 23.56V124h101v-3.25z" />
                                            <path fill="#EDC391" d="M64 92.33h-9.08v9.98l9.06 2.38l9.1-2.38v-9.98z" />
                                            <linearGradient id="notoTeacherLightSkinTone9" x1="29.113" x2="29.113" y1="29.156" y2="4.97" gradientTransform="matrix(1 0 0 -1 0 128)" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#FFA000" />
                                                <stop offset=".341" stop-color="#FF9300" />
                                                <stop offset=".972" stop-color="#FF7100" />
                                                <stop offset="1" stop-color="#FF6F00" />
                                            </linearGradient>
                                            <path fill="url(#notoTeacherLightSkinTone9)" d="M12 120.75V124h32.89l1.33-27.04C27.52 99.72 12 107.15 12 120.75z" />
                                            <linearGradient id="notoTeacherLightSkinTonea" x1="98.888" x2="98.888" y1="29.435" y2="4.807" gradientTransform="matrix(1 0 0 -1 0 128)" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#FFA000" />
                                                <stop offset=".341" stop-color="#FF9300" />
                                                <stop offset=".972" stop-color="#FF7100" />
                                                <stop offset="1" stop-color="#FF6F00" />
                                            </linearGradient>
                                            <path fill="url(#notoTeacherLightSkinTonea)" d="M81.78 96.96L83.1 124H116v-3.25c0-13.6-15.52-21.03-34.22-23.79z" />
                                            <path fill="#66C0E8" d="m54.03 92.12l9.99 12.82l-16.24 6.64l-2.41-14.54z" />
                                            <path fill="#66C0E8" d="m73.97 92.12l-9.99 12.82l16.24 6.64l2.41-14.54z" />
                                            <path fill="#AF5214" d="M48.88 95s-1.14 2.72-1.94 6c-1.59 6.52-1.69 15.8-1.69 15.8s-6.89-2.34-9.04-8.05c-2.54-6.75 1.75-10.46 1.75-10.46s.9-.38 4.68-2.46s6.24-.83 6.24-.83zm30.24 0s1.14 2.72 1.94 6c1.59 6.52 1.69 15.8 1.69 15.8s6.89-2.34 9.04-8.05c2.54-6.75-1.75-10.46-1.75-10.46s-.9-.38-4.68-2.46s-6.24-.83-6.24-.83z" />
                                            <path fill="#EDC391" d="M91.12 50.43H36.47c-5.89 0-10.71 5.14-10.71 11.41s4.82 11.41 10.71 11.41h54.65c5.89 0 10.71-5.14 10.71-11.41s-4.82-11.41-10.71-11.41z" />
                                            <path fill="#F9DDBD" d="M63.79 11.07c-17.4 0-33.52 18.61-33.52 45.4c0 26.64 16.61 39.81 33.52 39.81S97.31 83.1 97.31 56.46c0-26.78-16.11-45.39-33.52-45.39z" />
                                            <g fill="#312D2D">
                                                <ellipse cx="47.98" cy="58.81" rx="4.93" ry="5.1" />
                                                <ellipse cx="79.13" cy="58.81" rx="4.93" ry="5.1" />
                                            </g>
                                            <path fill="#454140" d="M55.37 49.82c-.93-1.23-3.07-3.01-7.23-3.01s-6.31 1.79-7.23 3.01c-.41.54-.31 1.17-.02 1.55c.26.35 1.04.68 1.9.39s2.54-1.16 5.35-1.18c2.81.02 4.49.89 5.35 1.18c.86.29 1.64-.03 1.9-.39c.28-.38.39-1.01-.02-1.55zm30.99 0c-.93-1.23-3.07-3.01-7.23-3.01s-6.31 1.79-7.23 3.01c-.41.54-.31 1.17-.02 1.55c.26.35 1.04.68 1.9.39s2.54-1.16 5.35-1.18c2.81.02 4.49.89 5.35 1.18c.86.29 1.64-.03 1.9-.39c.29-.38.39-1.01-.02-1.55z" />
                                            <path fill="#DBA689" d="M67.65 68.06c-.11-.04-.21-.07-.32-.08h-7.08c-.11.01-.22.04-.32.08c-.64.26-.99.92-.69 1.63c.3.71 1.71 2.69 4.55 2.69s4.25-1.99 4.55-2.69c.31-.71-.05-1.37-.69-1.63z" />
                                            <path fill="#444" d="M72.32 76.14c-3.18 1.89-13.63 1.89-16.81 0c-1.83-1.09-3.7.58-2.94 2.24c.75 1.63 6.44 5.42 11.37 5.42s10.55-3.79 11.3-5.42c.76-1.66-1.09-3.33-2.92-2.24z" />
                                            <path fill="#212121" stroke="#212121" stroke-miterlimit="10" stroke-width=".55" d="M93.83 52.93c-.07-1.19-.12-1.31-1.69-1.81c-1.23-.39-7.95-.94-13.01-.66c-.36.02-.71.04-1.04.07c-4.59.39-10.1 2.24-14.24 2.34c-1.76.04-9.01-1.86-14.14-2.26c-.33-.02-.66-.05-1-.06c-5.07-.26-11.82.33-13.05.73c-1.57.51-1.62.63-1.68 1.82c-.07 1.19.13 2.2 1.06 2.51c1.27.42 1.28 2 2.13 6.54c.77 4.14 2.62 7.41 10.57 7.98c.34.02.66.04.98.04c7.03.1 9.45-4.53 10.25-6.07c1.49-2.86 1.02-6.8 4.96-6.81c3.93-.01 3.56 3.86 5.07 6.71c.81 1.53 3.17 6.18 10.14 6.08c.34 0 .69-.02 1.05-.05c7.94-.62 9.78-3.9 10.52-8.04c.82-4.55.83-6.14 2.09-6.56c.91-.3 1.11-1.31 1.03-2.5zM53.28 68.17c-1.22.57-2.85.86-4.57.86c-3.59-.01-7.57-1.27-9.01-3.81c-2.04-3.62-2.57-10.94.03-12.47c1.14-.67 4.99-1.13 8.97-.96c4.13.18 8.4 1.04 9.94 3.06c2.55 3.33-1.5 11.5-5.36 13.32zm34.9-3.1c-1.43 2.56-5.44 3.85-9.05 3.86c-1.7.01-3.31-.27-4.51-.83c-3.87-1.8-7.97-9.94-5.45-13.29c1.53-2.04 5.82-2.92 9.96-3.12c3.97-.19 7.81.25 8.94.91c2.61 1.52 2.13 8.84.11 12.47z" />
                                            <linearGradient id="notoTeacherLightSkinToneb" x1="79.569" x2="76.946" y1="22.713" y2="11.668" gradientTransform="matrix(1 0 0 -1 0 128)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".002" stop-color="#212121" stop-opacity=".2" />
                                                <stop offset="1" stop-color="#212121" stop-opacity=".6" />
                                            </linearGradient>
                                            <path fill="url(#notoTeacherLightSkinToneb)" d="m101.67 121.61l.57-2.2l.01-.05l1.93-7.6l-6.9-1.98l-34.92-10.03c-.05-.01-.09-.01-.13-.03a6.177 6.177 0 0 0-7.51 4.27L48.97 124h52.02l.68-2.39z" opacity=".67" />
                                            <path fill="#424242" d="M105.75 111.88c.29-1.01-.29-2.06-1.3-2.34l-38.69-11.1a6.19 6.19 0 0 0-7.65 4.24L52 124h50.28l3.47-12.12z" />
                                            <linearGradient id="notoTeacherLightSkinTonec" x1="81.84" x2="79.869" y1="17.098" y2="10.486" gradientTransform="matrix(1 0 0 -1 0 128)" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#EF5350" />
                                                <stop offset="1" stop-color="#E53935" />
                                            </linearGradient>
                                            <path fill="url(#notoTeacherLightSkinTonec)" d="M105.08 120.31c.35-1.22-.38-2.5-1.62-2.85l-41.52-11.9c-4.53-1.3-5.32 2.35-6.59 6.78L52 124h52.02l1.06-3.69z" />
                                            <linearGradient id="notoTeacherLightSkinToned" x1="58.405" x2="60.268" y1="19.113" y2="24.969" gradientTransform="matrix(1 0 0 -1 0 128)" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#212121" />
                                                <stop offset="1" stop-color="#424242" />
                                            </linearGradient>
                                            <path fill="url(#notoTeacherLightSkinToned)" d="M63.26 98.24a6.172 6.172 0 0 0-5.14 4.42L52 124h3.87l7.39-25.76z" />
                                            <path fill="#424242" d="M64.33 101.57c.18 0 .38.02.59.07l37.25 10.7l-.31 1.08c-11.79-3.29-34.29-9.62-38.94-11.16c.24-.33.71-.69 1.41-.69m0-3.33c-4.52 0-6.78 5.57-3.12 6.94c4.03 1.5 42.93 12.32 42.93 12.32l1.58-5.52c.31-1.06-.19-2.14-1.11-2.4L65.77 98.42c-.5-.12-.98-.18-1.44-.18z" opacity=".2" />
                                            <linearGradient id="notoTeacherLightSkinTonee" x1="-117.44" x2="-73.995" y1="-972.312" y2="-972.312" gradientTransform="matrix(.9612 .2758 -.3192 1.1123 -136.555 1216.41)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".01" stop-color="#BDBDBD" />
                                                <stop offset=".987" stop-color="#F8F8F7" />
                                            </linearGradient>
                                            <path fill="url(#notoTeacherLightSkinTonee)" d="m103.37 112.12l-39.8-11.42c-1.08-.31-2.26.46-2.62 1.71l-.06.22c-.36 1.25.23 2.53 1.31 2.84l39.8 11.42s-.34-.83.07-2.3c.41-1.48 1.3-2.47 1.3-2.47z" />
                                            <path fill="#312D2D" d="M104.07 25.11c-2.44-3.69-7.91-8.64-12.82-8.97c-.79-4.72-5.84-8.72-10.73-10.27c-13.23-4.19-21.84.51-26.46 3.03c-.96.52-7.17 3.97-11.51 1.5c-2.72-1.55-2.67-5.74-2.67-5.74s-8.52 3.25-5.61 12.3c-2.93.12-6.77 1.36-8.8 5.47c-2.42 4.9-1.56 8.99-.86 10.95c-2.52 2.14-5.69 6.69-3.52 12.6c1.64 4.45 8.17 6.5 8.17 6.5c-.46 8.01 1.03 12.94 1.82 14.93c.14.35.63.32.72-.04c.99-3.97 4.37-17.8 4.03-20.21c0 0 11.35-2.25 22.17-10.22c2.2-1.62 4.59-3 7.13-4.01c13.59-5.41 16.43 3.82 16.43 3.82s9.42-1.81 12.26 11.27c1.07 4.9 1.79 12.75 2.4 18.24c.04.39.57.47.72.11c.95-2.18 2.85-6.5 3.3-10.91c.16-1.55 4.34-3.6 6.14-10.26c2.41-8.88-.54-17.42-2.31-20.09z" />
                                            <radialGradient id="notoTeacherLightSkinTonef" cx="82.019" cy="84.946" r="35.633" gradientTransform="matrix(.3076 .9515 .706 -.2282 -3.184 -15.605)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".699" stop-color="#454140" stop-opacity="0" />
                                                <stop offset="1" stop-color="#454140" />
                                            </radialGradient>
                                            <path fill="url(#notoTeacherLightSkinTonef)" d="M100.22 55.5c.16-1.55 4.34-3.6 6.14-10.26c.19-.71.35-1.43.5-2.15c1.46-8.09-1.16-15.52-2.79-17.98c-2.26-3.41-7.1-7.89-11.69-8.81c-.4-.05-.79-.1-1.16-.12c0 0 .33 2.15-.54 3.86c-1.12 2.22-3.41 2.75-3.41 2.75c11.97 11.98 11.12 22 12.95 32.71z" />
                                            <radialGradient id="notoTeacherLightSkinToneg" cx="47.28" cy="123.8" r="9.343" gradientTransform="matrix(.8813 .4726 .5603 -1.045 -63.752 111.228)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".58" stop-color="#454140" />
                                                <stop offset="1" stop-color="#454140" stop-opacity="0" />
                                            </radialGradient>
                                            <path fill="url(#notoTeacherLightSkinToneg)" d="M56.95 7.39c-1.1.53-2.06 1.06-2.9 1.51c-.96.52-7.17 3.97-11.51 1.5c-2.67-1.52-2.67-5.58-2.67-5.72c-1.23 1.57-4.95 12.78 5.93 13.53c4.69.32 7.58-3.77 9.3-7.23c.62-1.26 1.59-3.1 1.85-3.59z" />
                                            <radialGradient id="notoTeacherLightSkinToneh" cx="159.055" cy="62.862" r="28.721" gradientTransform="matrix(-.9378 -.3944 -.2182 .5285 231.04 50.678)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".699" stop-color="#454140" stop-opacity="0" />
                                                <stop offset="1" stop-color="#454140" />
                                            </radialGradient>
                                            <path fill="url(#notoTeacherLightSkinToneh)" d="M79.16 5.47c7.32 1.98 10.89 5.71 12.08 10.68c.35 1.46.77 15.08-25.23-.4c-9.67-5.76-7.03-9.36-5.9-9.77c4.42-1.6 10.85-2.73 19.05-.51z" />
                                            <radialGradient id="notoTeacherLightSkinTonei" cx="43.529" cy="115.276" r="8.575" gradientTransform="matrix(1 0 0 -1.2233 0 153.742)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".702" stop-color="#454140" stop-opacity="0" />
                                                <stop offset="1" stop-color="#454140" />
                                            </radialGradient>
                                            <path fill="url(#notoTeacherLightSkinTonei)" d="M39.84 4.68c-.01.01-.03.01-.06.03h-.01c-.93.39-8.24 3.78-5.51 12.25l7.78 1.25c-6.89-6.98-2.17-13.55-2.17-13.55s-.02.01-.03.02z" />
                                            <radialGradient id="notoTeacherLightSkinTonej" cx="42.349" cy="100.139" r="16.083" gradientTransform="matrix(-.9657 -.2598 -.2432 .9037 107.598 -51.632)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".66" stop-color="#454140" stop-opacity="0" />
                                                <stop offset="1" stop-color="#454140" />
                                            </radialGradient>
                                            <path fill="url(#notoTeacherLightSkinTonej)" d="m39.07 17.73l-4.81-.77c-.19 0-.83.06-1.18.11c-2.71.38-5.9 1.78-7.63 5.36c-1.86 3.86-1.81 7.17-1.3 9.38c.15.74.45 1.58.45 1.58s2.38-2.26 8.05-2.41l6.42-13.25z" />
                                            <radialGradient id="notoTeacherLightSkinTonek" cx="38.533" cy="84.609" r="16.886" gradientTransform="matrix(.9907 .1363 .1915 -1.3921 -15.841 155.923)" gradientUnits="userSpaceOnUse">
                                                <stop offset=".598" stop-color="#454140" stop-opacity="0" />
                                                <stop offset="1" stop-color="#454140" />
                                            </radialGradient>
                                            <path fill="url(#notoTeacherLightSkinTonek)" d="M24.37 33.58c-2.37 2.1-5.56 6.79-3.21 12.61c1.77 4.39 8.09 6.29 8.09 6.29c0 .02 1.26.4 1.91.4l1.48-21.9c-3.03 0-5.94.91-7.82 2.22c.03.03-.46.35-.45.38z" />
                                        </svg>
                                    </div>
                                    <div class="ml-2 w-full flex-1">
                                        <div>
                                            <div class="mt-3 text-3xl font-bold leading-8"><?php echo $teacher_count; ?></div>

                                            <div class="mt-1 text-base text-gray-800">ครูทั้งหมด</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                href="#">
                                <div class="p-5">
                                    <div class="flex justify-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M2 9V3h20v6h-2V5H4v4H2Zm0 9v-7h2v5h16v-5h2v7H2Zm0-7V9h6.6l1.475 2.875L13.425 6h1.2l1.5 3H22v2h-7.125l-.925-1.875L10.575 15h-1.2l-2-4H2ZM1 21v-2h22v2H1Zm11-10.5Z" />
                                        </svg>

                                    </div>
                                    <div class="ml-2 w-full flex-1">
                                        <div>
                                            <div class="mt-3 text-3xl font-bold leading-8"><?php echo $activity_count; ?></div>

                                            <div class="mt-1 text-base text-gray-800">ข่าวสารและกิจกรรม</div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>




                        <div class="col-span-12 mt-5">
                            <div class="grid gap-2 grid-cols-1 lg:grid-cols-2">
                                <div class="bg-white shadow-lg p-4" id="chartline"></div>
                                <div class="bg-white shadow-lg" id="chartpie"></div>
                            </div>
                        </div>

                    </div>


            </div>


    </main>
    </div>
    </div>
    <!--end of project-->
    </main>



    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var chart = document.querySelector('#chartline')
        var options = {
            series: [{
                name: 'กิจกรรม',
                type: 'area',
                data: <?php echo $activity_json; ?>
            }, {
                name: 'ข่าวสาร',
                type: 'line',
                data: <?php echo $news_json; ?>
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            stroke: {
                curve: 'smooth'
            },
            fill: {
                type: 'solid',
                opacity: [0.35, 1],
            },
            labels: <?php echo $dates_json; ?>,
            markers: {
                size: 0
            },
            yaxis: [{
                    title: {
                        text: 'จำนวนกิจกรรม',
                    },
                },
                {
                    opposite: true,
                    title: {
                        text: 'จำนวนข่าวสาร',
                    },
                }
            ],
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function(y) {
                        if (typeof y !== "undefined") {
                            return y.toFixed(0) + " รายการ";
                        }
                        return y;
                    }
                }
            }
        };
        var chart = new ApexCharts(chart, options);
        chart.render();
    </script>
    <script>
        var chart = document.querySelector('#chartpie')
        var options = {
            series: [<?php echo $teacher_count; ?>, <?php echo $student_count; ?>, <?php echo $guardian_count; ?>],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'จำนวนทั้งหมด',
                            formatter: function(w) {
                                return <?php echo $total_count; ?>
                            }
                        }
                    }
                }
            },
            labels: ['ครู', 'นักเรียน', 'ผู้ปกครอง'],
        };
        var chart = new ApexCharts(chart, options);
        chart.render();
    </script>
</body>



</html>