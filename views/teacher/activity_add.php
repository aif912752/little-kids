<?php
include '../../config/database.php';

// ดึงข้อมูลนักเรียนจากฐานข้อมูล
$query = "SELECT student_id , first_name, last_name FROM students";
$result = $connect->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มกิจกรรม</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>

            <div class=" w-full page-wrapper xl:px-6 px-0">

                <!-- Main Content -->
                <main class="h-full  max-w-full">

                    <div class="container full-container p-0 flex flex-col gap-6">

                        <div class="w-full">
                            <div class="bg-gradient-to-b from-blue-500 to-blue-300 h-96"></div>
                            <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
                                <div class="bg-white w-full shadow rounded p-8 sm:p-12 -mt-72">
                                    <p class="text-3xl font-bold leading-7 text-center">เพิ่มกิจกรรม</p>
                                    <form action="insert_activity.php" method="post">

                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none">ชื่อกิจกรรม</label>
                                                <input type="text" name="activity_name" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                            <div class="w-full md:w-1/2 flex flex-col md:ml-6 ">
                                                <label class="font-semibold leading-none">ประเภท</label>
                                                <input type="text" name="activity_type" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                        </div>

                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none">รายละเอียดกิจกรรม </label>
                                                <textarea name="activity_description" rows="5"
                                                    class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"
                                                    autoComplete="off" spellCheck="false"></textarea>
                                            
                                                </div>

                                        </div>




                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none">วันที่เริ่มกิจกรรม</label>
                                                <input type="datetime-local" name="activity_date_start" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                            <div class="w-full md:w-1/2 flex flex-col md:ml-6 ">
                                                <label class="font-semibold leading-none">วันที่สิ้นสุดกิจกรรม</label>
                                                <input type="datetime-local" name="activity_date_end" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                        </div>




                                        <div class="flex items-center justify-center w-full">
                                            <button class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                                บันทึก
                                            </button>
                                        </div>
                                    </form>
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
<script>
    function previewImage(input) {
        var preview = document.getElementById('preview');
        var previewImg = document.getElementById('preview-img');
        var uploadBox = document.getElementById('upload-box');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
                uploadBox.classList.add('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            previewImg.src = "";
            preview.classList.add('hidden');
            uploadBox.classList.remove('hidden');
        }
    }
</script>

</html>