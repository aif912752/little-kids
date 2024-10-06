<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลปกครอง</title>

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
            <?php 
                include('../../config/database.php');
                $id = $_GET['id'];
                $sql = "SELECT * FROM guardians WHERE guardian_id = $id";
                $result = $connect->query($sql);
                if($result)
                {
                    $guardian = $result->fetch_assoc();
                    $user_id = $guardian['user_id'];
                    $sql2 = "SELECT * FROM user WHERE id = $user_id";
                    $result2 = $connect->query($sql2);
                    if($result2)
                    {
                        $user = $result2->fetch_assoc();
                        
                    }else{
                        
                        $user=[];
                    }
                   
                    

                }else{
                    
                    $guardian=[];
                }

            ?>
            <div class=" w-full page-wrapper xl:px-6 px-0">

                <!-- Main Content -->
                <main class="h-full  max-w-full">

                    <div class="container full-container p-0 flex flex-col gap-6">

                        <div class="w-full">
                            <div class="bg-gradient-to-b from-blue-500 to-blue-300 h-96"></div>
                            <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
                                <div class="bg-white w-full shadow rounded p-8 sm:p-12 -mt-72">
                                    <p class="text-3xl font-bold leading-7 text-center">แก้ไขข้อมูลผู้ปกครอง</p>
                                    <form action="update_guardian.php" method="post" enctype="multipart/form-data">
                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none">username</label>
                                                <input type="text" name="username_guardian" value="<?php echo isset($user['username']) ? $user['username'] :"" ;?>" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                                <input type="hidden" name="old_username" value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>" />

                                                <input type="hidden" name="guardian_user_id" value="<?php echo isset($guardian['user_id']) ? $guardian['user_id'] : ''; ?>" />
                                            </div>
                                            <div class="w-full md:w-1/2 flex flex-col md:ml-6 ">
                                                <label class="font-semibold leading-none">password</label>
                                                <input type="password" name="password_guardian" value="<?php echo isset($user['password']) ? $user['password'] :"" ;?>" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                        </div>

                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none">ชื่อจริงผู้ปกครอง</label>
                                                <input type="text" name="first_name_guardian" value="<?php echo isset($guardian['first_name']) ? $guardian['first_name'] :"" ;?>" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                            <div class="w-full md:w-1/2 flex flex-col md:ml-6 ">
                                                <label class="font-semibold leading-none">นามสกุลผู้ปกครอง</label>
                                                <input type="text" name="last_name_guardian" value="<?php echo isset($guardian['last_name']) ? $guardian['last_name'] :"" ;?>" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                        </div>

                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none">เบอร์โทรศัพท์ผู้ปกครอง</label>
                                                <input type="text" name="phone_number_guardian" value="<?php echo isset($guardian['phone_number']) ? $guardian['phone_number'] :"" ;?>" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                            <div class="w-full md:w-1/2 flex flex-col md:ml-6 ">
                                                <label class="font-semibold leading-none">เพศผู้ปกครอง</label>
                                                <div class="flex item-center gap-2 mt-3 mb-5 ">
                                                    <input type="radio" name="gender_guardian" value="1" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 bg-gray-100 border rounded border-gray-200" <?php echo (isset($guardian['gender']) && $guardian['gender'] == 'Male') ? 'checked' : ''; ?> /> ชาย
                                                    <input type="radio" name="gender_guardian" value="2" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 bg-gray-100 border rounded border-gray-200" <?php echo (isset($guardian['gender']) && $guardian['gender'] == 'Female') ? 'checked' : ''; ?> /> หญิง
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full  flex flex-col  ">
                                                <label class="font-semibold leading-none">เกี่ยวข้องเป็น</label>
                                                <input type="text" name="relation_to_student" value="<?php echo isset($guardian['relation_to_student']) ? $guardian['relation_to_student'] :"" ;?>"   class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                            </div>
                                        </div>

                                        <div class="md:flex items-center mt-4">
                                            <div class="w-full flex flex-col">
                                                <label class="font-semibold leading-none">ที่อยู่</label>
                                                <textarea name="address_guardian" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"><?php echo isset($guardian['address']) ? $guardian['address'] :"" ;?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center justify-center w-full gap-4">
                                            <button class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                                บันทึก
                                            </button>
                                            <a href="guardian_manage.php" class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-red-600 rounded hover:bg-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:outline-none">ยกเลิก</a>

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