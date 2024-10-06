<?php
include '../../config/database.php';

// ตรวจสอบว่า id ถูกส่งมาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id']; // รับค่าจาก URL

    // ดึงข้อมูลนักเรียนจากฐานข้อมูล
    $sql = "SELECT sm.student_id, sm.weight, sm.height, s.first_name, s.last_name
            FROM students s
            INNER JOIN student_measurements sm ON sm.student_id = s.student_id
            WHERE sm.id = ?"; // ใช้ sm.id สำหรับการค้นหา

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id); // ใช้ id ในการค้นหา
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูลนักเรียนที่ต้องการแก้ไข";
        exit;
    }
} else {
    echo "ไม่พบข้อมูลนักเรียนที่ต้องการแก้ไข";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลพัฒนาการเด็ก</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</head>

<body class="bg-surface">
    <main>
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>

            <div class="w-full page-wrapper xl:px-6 px-0">
                <main class="h-full max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        <div class="w-full">
                            <div class="bg-gradient-to-b from-blue-500 to-blue-300 h-96"></div>
                            <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
                                <div class="bg-white w-full shadow rounded-lg p-8 sm:p-12 -mt-72"> <!-- เพิ่ม rounded-lg ที่นี่ -->
                                    <form action="update_child_evelopment.php" method="post" enctype="multipart/form-data">
                                        <div class="mt-8 bg-white p-6 shadow sm:rounded-lg"> <!-- เพิ่ม rounded-lg ที่นี่ -->
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                                            <p class="text-3xl font-bold leading-7 text-center mb-4">แก้ไขข้อมูลน้ำหนักและส่วนสูงนักเรียน</p>

                                            <div class="mb-6">
                                                <label class="block text-gray-700 text-sm font-bold mb-2" for="full_name">ชื่อ-นามสกุล</label>
                                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="full_name" type="text" value="<?php echo $row['first_name'] . ' ' . $row['last_name']; ?>" disabled>
                                            </div>

                                            <div class="mb-6">
                                                <label class="block text-gray-700 text-sm font-bold mb-2" for="weight">น้ำหนัก (กิโลกรัม)</label>
                                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="weight" name="weight" type="number" step="0.1" value="<?php echo $row['weight']; ?>" required>
                                            </div>

                                            <div class="mb-6">
                                                <label class="block text-gray-700 text-sm font-bold mb-2" for="height">ส่วนสูง (เซนติเมตร)</label>
                                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="height" name="height" type="number" step="0.1" value="<?php echo $row['height']; ?>" required>
                                            </div>

                                            <div class="flex justify-end">
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    บันทึกการแก้ไข
                                                </button>
                                            </div>
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

</html>