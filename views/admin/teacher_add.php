<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลครู</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .swal2-confirm {
            background-color: #2563EB !important;
            color: white !important;
        }
    </style>
</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">

            <?php include '../../src/navbar_teacher.php'; ?>
            
            <div class=" w-full page-wrapper xl:px-6 px-0">
                <main class="h-full  max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        <div class="w-full">
                            <div class="bg-gradient-to-b from-blue-500 to-blue-300 h-96"></div>
                            <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
                                <div class="bg-white w-full shadow rounded p-8 sm:p-12 -mt-72">
                                    <p class="text-3xl font-bold leading-7 text-center">เพิ่มข้อมูลครู</p>
                                    <form action="insert_teacher.php" method="post" enctype="multipart/form-data">
                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none">Username</label>
                                                <input type="text" name="username"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                              
                                            </div>
                                            <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0">
                                                <label class="font-semibold leading-none"> Password </label>
                                                <input type="password" name="password"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                        </div>
                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none">ชื่อ</label>
                                                <input type="text" name="first_name"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                            <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0">
                                                <label class="font-semibold leading-none">นามสกุล</label>
                                                <input type="text" name="last_name"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                        </div>
                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none"> เลขประจำตัวประชาชน </label>
                                                <input type="text" name="citizen_id"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                            <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0">
                                                <label class="font-semibold leading-none">วัน/เดือน/ปี เกิด</label>
                                                <input type="date" name="birthdate"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                        </div>
                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none">เชื้อชาติ</label>
                                                <input type="text" name="ethnicity"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                            <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0">
                                                <label class="font-semibold leading-none">สัญชาติ</label>
                                                <input type="text" name="nationality"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                        </div>
                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full  flex flex-col">
                                                <label class="font-semibold leading-none">ศาสนา</label>
                                                <input type="text" name="religion"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>

                                        </div>

                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none">ตำแหน่ง</label>
                                                <input type="text" name="position"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                            <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0">
                                                <label class="font-semibold leading-none">email</label>
                                                <input type="text" name="email"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                        </div>

                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none">เบอร์โทรศัพท์</label>
                                                <input type="text" name="phone_number"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                            <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0">
                                                <label class="font-semibold leading-none">ชั้นปีที่ </label>
                                                <input type="text" name="class_taught"  class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                        </div>

                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none">ที่อยู่</label>
                                                <textarea name="teacher_address" rows="4" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"></textarea>                      
                                            </div>
                                        </div>
                                    

                                        <div class="md:flex items-start mt-4">
                                            

                                            <div class="w-full md:w-full flex flex-col md:ml-6 md:mt-0">
                                                <div class="md:flex">
                                                    <div class="w-full p-3">
                                                        <div id="upload-box" class="relative border-dotted h-48 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                                                            <div class="absolute">
                                                                <div class="flex flex-col items-center">
                                                                    <i class="fa fa-folder-open fa-4x text-blue-700"></i>
                                                                    <span class="block text-gray-400 font-normal">อัพโหลดรูปครู</span>
                                                                </div>
                                                            </div>
                                                            <input id="img" name="img" type="file" class="h-full w-full opacity-0" accept="image/*" onchange="previewImage(this);">
                                                        </div>
                                                       
                                                        <div id="preview" class="mt-3 hidden">
                                                            <img id="preview-img" src="#" alt="ตัวอย่างรูปภาพ" class="max-w-full h-auto rounded-lg shadow-lg">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-center w-full gap-4">
                                            <button class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                                บันทึก
                                            </button>
                                            <a href="teacher_manage.php" class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-red-600 rounded hover:bg-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:outline-none">ยกเลิก</a>
                                        </div>
                                    </form>
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

<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

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




