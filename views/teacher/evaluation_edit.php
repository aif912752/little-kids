<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขแบบฟอร์มประเมิน</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-surface">
    <main>
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>
            <div class="w-full page-wrapper xl:px-6 px-0">
                <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="bg-indigo-600 px-6 py-4">
                        <h1 class="text-2xl font-bold text-white">แก้ไขแบบฟอร์มประเมิน</h1>
                    </div>

                    <?php
                    // เชื่อมต่อกับฐานข้อมูล
                    include('../../config/database.php');

                    // สมมติว่าเรามี ID ของแบบประเมินที่ต้องการแก้ไข
                    $evaluation_id = isset($_GET['id']) ? $_GET['id'] : null;

                    if ($evaluation_id) {
                        // ดึงข้อมูลแบบประเมินจากฐานข้อมูล
                        $sql = "SELECT * FROM evaluation WHERE evaluation_id = ?";
                        $stmt = $connect->prepare($sql);
                        $stmt->bind_param("i", $evaluation_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $evaluation = $result->fetch_assoc();

                        if ($evaluation) {
                            // ดึงข้อมูลกิจกรรมที่เกี่ยวข้อง
                            $sql = "SELECT * FROM evaluation_activity WHERE activity_id = ?";
                            $stmt = $connect->prepare($sql);
                            $stmt->bind_param("s", $evaluation['evaluation_id']);
                            $stmt->execute();
                            $activities = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                            // แสดงฟอร์มแก้ไข
                            ?>
                            <form method="post" action="update_evaluation.php" id="evaluationForm" class="p-6 space-y-6">
                                <input type="hidden" name="evaluation_id" value="<?php echo $evaluation_id; ?>">
                                <div id="topicsContainer" class="space-y-6">
                                    <div class="bg-white p-4 rounded-lg shadow-md relative">
                                        <input type="text" name="evaluation_name" value="<?php echo htmlspecialchars($evaluation['evaluation_name']); ?>" class="w-full p-2 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                        <div class="questionsContainer space-y-4">
                                            <?php foreach ($activities as $activity) : ?>
                                                <div class="bg-gray-50 p-4 rounded-md relative">
                                                    <input type="text" name="questions[<?php echo $activity['id']; ?>][text]" value="<?php echo htmlspecialchars($activity['evaluation_name']); ?>" class="w-full p-2 mb-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                                    <div class="answersContainer space-y-2">
                                                        <?php
                                                        $answers = json_decode($activity['evaluation_score'], true);
                                                        foreach ($answers as $answer) :
                                                        ?>
                                                            <div class="flex items-center space-x-2 mb-2">
                                                                <input type="text" name="questions[<?php echo $activity['id']; ?>][answers][<?php echo uniqid(); ?>][text]" value="<?php echo htmlspecialchars($answer['text']); ?>" class="flex-grow p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                                                <input type="number" name="questions[<?php echo $activity['id']; ?>][answers][<?php echo uniqid(); ?>][score]" value="<?php echo $answer['score']; ?>" class="w-20 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required min="0">
                                                                <button type="button" onclick="this.parentNode.remove()" class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600 transition duration-300 ease-in-out">ลบ</button>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <button type="button" onclick="addAnswer(this.previousElementSibling, '<?php echo $activity['id']; ?>')" class="mt-2 bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition duration-300 ease-in-out">เพิ่มคำตอบ</button>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <button type="button" onclick="addQuestion(this.previousElementSibling)" class="mt-4 bg-blue-600 text-white px-3 py-2 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out">เพิ่มคำถาม</button>
                                    </div>
                                </div>
                                <div class="flex space-x-4">
                                    <button type="submit" class="flex-1 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-300 ease-in-out">บันทึกการแก้ไข</button>
                                </div>
                            </form>

                            <script>
                                function addQuestion(container) {
                                    const questionDiv = document.createElement('div');
                                    questionDiv.className = 'bg-gray-50 p-4 rounded-md relative';
                                    const questionId = Date.now();
                                    questionDiv.innerHTML = `
                                        <button type="button" onclick="this.parentNode.remove()" class="absolute top-2 right-2 text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                        <input type="text" name="questions[new_${questionId}][text]" placeholder="คำถาม" class="w-full p-2 mb-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                        <div class="answersContainer space-y-2"></div>
                                        <button type="button" onclick="addAnswer(this.previousElementSibling, 'new_${questionId}')" class="mt-2 bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition duration-300 ease-in-out">เพิ่มคำตอบ</button>
                                    `;
                                    container.appendChild(questionDiv);
                                }

                                function addAnswer(container, questionId) {
                                    const answerDiv = document.createElement('div');
                                    answerDiv.className = 'flex items-center space-x-2 mb-2';
                                    const answerId = Date.now();
                                    answerDiv.innerHTML = `
                                        <input type="text" name="questions[${questionId}][answers][new_${answerId}][text]" placeholder="คำตอบ" class="flex-grow p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                        <input type="number" name="questions[${questionId}][answers][new_${answerId}][score]" placeholder="คะแนน" class="w-20 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required min="0">
                                        <button type="button" onclick="this.parentNode.remove()" class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600 transition duration-300 ease-in-out">ลบ</button>
                                    `;
                                    container.appendChild(answerDiv);
                                }
                            </script>
                            <?php
                        } else {
                            echo "<p class='p-6 text-red-500'>ไม่พบแบบประเมินที่ต้องการแก้ไข</p>";
                        }
                    } else {
                        echo "<p class='p-6 text-red-500'>ไม่ได้ระบุ ID ของแบบประเมินที่ต้องการแก้ไข</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
