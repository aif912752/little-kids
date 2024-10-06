<?php
// เชื่อมต่อกับฐานข้อมูล
include('../../config/database.php');

// Fetch teachers from the database
$teacherQuery = "SELECT teacher_id, first_name, last_name FROM teacher";
$teacherResult = $connect->query($teacherQuery);
$teachers = [];

if ($teacherResult) {
    while ($row = $teacherResult->fetch_assoc()) {
        $teachers[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบฟอร์มประเมิน</title>
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
                        <h1 class="text-2xl font-bold text-white">แบบฟอร์มประเมิน</h1>
                    </div>

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        echo '<div class="p-6 space-y-4">';
                        foreach ($_POST['topics'] as $topicIndex => $topic) {
                            echo "<div class='bg-gray-50 p-4 rounded-lg'>";
                            echo "<h2 class='text-xl font-semibold text-indigo-700 mb-2'>หัวข้อ: " . htmlspecialchars($topic['name']) . "</h2>";
                            foreach ($topic['questions'] as $questionIndex => $question) {
                                echo "<div class='mb-2'>";
                                echo "<p class='font-medium text-gray-700'>คำถาม: " . htmlspecialchars($question['text']) . "</p>";
                                echo "<ul class='ml-4 text-gray-600'>";
                                foreach ($question['answers'] as $answerText) {
                                    echo "<li>- " . htmlspecialchars($answerText) . "</li>";
                                }
                                echo "</ul>";
                                echo "</div>";
                            }
                            echo "</div>";
                        }
                        echo '</div>';
                    } else {
                    ?>

                        <form method="post" action="evaluation_insert.php" id="evaluationForm" class="p-6 space-y-6">
                            <div>
                            <label for="teacherSelect" class="block font-medium text-gray-700 mb-2">เลือกอาจารย์:</label>
            <select name="teacher_id" id="teacherSelect" class="w-full p-2 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                <option value="">เลือกอาจารย์</option>
                <?php foreach ($teachers as $teacher): ?>
                    <option value="<?= htmlspecialchars($teacher['teacher_id']) ?>">
                        <?= htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="selected_teacher_id" id="selectedTeacherId">
            <div id="selectedTeacherIdDisplay" class="text-gray-700 font-medium mt-2"></div>
                            </div>
                            <script>
                                function showTeacherId() {
                                    const teacherSelect = document.getElementById('teacherSelect');
                                    const selectedTeacherId = teacherSelect.value; // รับค่า teacher_id ที่ถูกเลือก
                                    const displayDiv = document.getElementById('selectedTeacherId');

                                    if (selectedTeacherId) {
                                        displayDiv.textContent = "Teacher ID: " + selectedTeacherId; // แสดง teacher_id
                                    } else {
                                        displayDiv.textContent = ""; // หากไม่มีการเลือกให้ลบข้อความ
                                    }
                                }
                            </script>

                            <div id="topicsContainer" class="space-y-6">
                                <!-- หัวข้อจะถูกเพิ่มที่นี่ -->
                            </div>
                            <div class="flex space-x-4">
                                <button type="button" onclick="addTopic()" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-indigo-600 transition duration-300 ease-in-out">เพิ่มหัวข้อ</button>
                                <button type="submit" class="flex-1 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-300 ease-in-out">ส่งแบบประเมิน</button>
                            </div>
                        </form>

                        <script>
                            let topicCounter = 0;
                            let questionCounter = 0;

                            function addTopic() {
                                const topicsContainer = document.getElementById('topicsContainer');
                                const topicDiv = document.createElement('div');
                                topicDiv.className = 'bg-white p-4 rounded-lg shadow-md relative';
                                topicDiv.innerHTML = `
                <button type="button" onclick="this.parentNode.remove()" class="absolute top-2 right-2 text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <input type="text" name="topics[${topicCounter}][name]" placeholder="ชื่อหัวข้อ" class="w-full p-2 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                <div class="questionsContainer space-y-4"></div>
                <button type="button" onclick="addQuestion(this.parentNode, ${topicCounter})" class="mt-4 bg-blue-600 text-white px-3 py-2 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out">เพิ่มคำถาม</button>
            `;
                                topicsContainer.appendChild(topicDiv);
                                topicCounter++;
                            }

                            function addQuestion(topicDiv, topicIndex) {
                                const questionsContainer = topicDiv.querySelector('.questionsContainer');
                                const questionDiv = document.createElement('div');
                                questionDiv.className = 'bg-gray-50 p-4 rounded-md relative';
                                questionDiv.innerHTML = `
                <button type="button" onclick="this.parentNode.remove()" class="absolute top-2 right-2 text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <input type="text" name="topics[${topicIndex}][questions][${questionCounter}][text]" placeholder="คำถาม" class="w-full p-2 mb-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                <div class="answersContainer space-y-2"></div>
                <button type="button" onclick="addAnswer(this.previousElementSibling, ${topicIndex}, ${questionCounter})" class="mt-2 bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition duration-300 ease-in-out">เพิ่มคำตอบ</button>
            `;
                                questionsContainer.appendChild(questionDiv);
                                questionCounter++;
                            }

                            function addAnswer(answersContainer, topicIndex, questionIndex) {
                                const answerDiv = document.createElement('div');
                                answerDiv.className = 'flex items-center space-x-2 mb-2';
                                const answerId = `answer${Date.now()}`;
                                answerDiv.innerHTML = `
        <input type="text" name="topics[${topicIndex}][questions][${questionIndex}][answers][${answerId}][text]" placeholder="คำตอบ" class="flex-grow p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        <input type="number" name="topics[${topicIndex}][questions][${questionIndex}][answers][${answerId}][score]" placeholder="คะแนน" class="w-20 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required min="0">
        <button type="button" onclick="this.parentNode.remove()" class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600 transition duration-300 ease-in-out">ลบ</button>
    `;
                                answersContainer.appendChild(answerDiv);
                            }

                            // เพิ่มหัวข้อแรกโดยอัตโนมัติ
                            addTopic();
                        </script>


                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>
<script>
        document.getElementById('teacherSelect').addEventListener('change', function() {
            const selectedTeacherId = this.value;
            if (selectedTeacherId) {
                document.getElementById('selectedTeacherIdDisplay').innerText = `ID อาจารย์ที่เลือก: ${selectedTeacherId}`;
                document.getElementById('selectedTeacherId').value = selectedTeacherId;
            } else {
                document.getElementById('selectedTeacherIdDisplay').innerText = '';
                document.getElementById('selectedTeacherId').value = '';
            }
        });
    </script>

</html>