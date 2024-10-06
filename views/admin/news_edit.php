<?php
session_start();
include('../../config/database.php');

// ตรวจสอบว่ามีการส่ง ID มาหรือไม่
if (!isset($_GET['id'])) {
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'ไม่พบ ID ของข่าว';
    header('Location: news.php');
    exit();
}

$id = $_GET['id'];

// ดึงข้อมูลข่าวจาก database
$sql = "SELECT * FROM news WHERE news_id = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'ไม่พบข่าวที่ต้องการแก้ไข';
    header('Location: news.php');
    exit();
}

$news = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข่าว</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            }
        }
    </script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">แก้ไขข่าว</h1>
        <form action="news_update.php" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <input type="hidden" name="news_id" value="<?php echo $news['news_id']; ?>">
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    หัวข้อข่าว
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" value="<?php echo htmlspecialchars($news['title']); ?>" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="details">
                    รายละเอียด
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="details" name="details" rows="5" required><?php echo htmlspecialchars($news['details']); ?></textarea>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="img">
                    รูปภาพ
                </label>
                <div class="md:flex">
                    <div class="w-full p-3">
                        <?php if (!empty($news['img'])): ?>
                            <div id="preview" class="mb-3">
                                <img id="preview-img" src="uploads/<?php echo $news['img']; ?>" alt="รูปภาพปัจจุบัน" class="max-w-full h-auto rounded-lg shadow-lg">
                            </div>
                        <?php else: ?>
                            <div id="preview" class="mb-3 hidden">
                                <img id="preview-img" src="#" alt="ตัวอย่างรูปภาพ" class="max-w-full h-auto rounded-lg shadow-lg">
                            </div>
                        <?php endif; ?>
                        <div id="upload-box" class="relative border-dotted h-48 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center <?php echo !empty($news['img']) ? 'hidden' : ''; ?>">
                            <div class="absolute">
                                <div class="flex flex-col items-center">
                                    <i class="fa fa-folder-open fa-4x text-blue-700"></i>
                                    <span class="block text-gray-400 font-normal">อัพโหลดรูปกิจกรรม</span>
                                </div>
                            </div>
                            <input id="img" name="img" type="file" class="h-full w-full opacity-0" accept="image/*" onchange="previewImage(this);">
                        </div>
                    </div>
                </div>
                <p class="text-xs italic mt-1">หากต้องการเปลี่ยนรูปภาพ กรุณาอัปโหลดรูปใหม่</p>
            </div>
            
            
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    บันทึกการแก้ไข
                </button>
                <a href="news.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    ยกเลิก
                </a>
            </div>
        </form>
    </div>
</body>
</html>