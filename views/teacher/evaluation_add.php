<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบฟอร์มประเมิน</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>
            <div class=" w-full page-wrapper xl:px-6 px-0">

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
                                echo "<p class='ml-4 text-gray-600'>คำตอบที่เลือก: " . htmlspecialchars($question['answer']) . "</p>";
                                echo "</div>";
                            }
                            echo "</div>";
                        }
                        echo '</div>';
                    } else {
                    ?>

                        <form method="post" id="evaluationForm" class="p-6 space-y-6">
                            <div id="topicsContainer" class="space-y-6">
                                <!-- หัวข้อจะถูกเพิ่มที่นี่ -->
                            </div>
                            <div class="flex space-x-4">
                                <button type="button" onclick="addTopic()" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-indigo-600 transition duration-300 ease-in-out">เพิ่มหัวข้อ</button>
                                <button  class="flex-1 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-300 ease-in-out">ส่งแบบประเมิน</button>
                            </div>
                        </form>

                        <script>
                            let topicCounter = 0;
                            let questionCounter = 0;

                            function addTopic() {
                                const topicsContainer = document.getElementById('topicsContainer');
                                const topicDiv = document.createElement('div');
                                topicDiv.className = 'bg-white p-4 rounded-lg shadow-md';
                                topicDiv.innerHTML = `
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
                                questionDiv.className = 'bg-gray-50 p-4 rounded-md';
                                questionDiv.innerHTML = `
                    <input type="text" name="topics[${topicIndex}][questions][${questionCounter}][text]" placeholder="คำถาม" class="w-full p-2 mb-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <div class="answersContainer space-y-2"></div>
                    <button type="button" onclick="addAnswer(this.previousElementSibling, ${topicIndex}, ${questionCounter})" class="mt-2 bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition duration-300 ease-in-out">เพิ่มคำตอบ</button>
                `;
                                questionsContainer.appendChild(questionDiv);
                                questionCounter++;
                            }

                            function addAnswer(answersContainer, topicIndex, questionIndex) {
                                const answerDiv = document.createElement('div');
                                answerDiv.className = 'flex items-center space-x-2';
                                const answerId = `answer${Date.now()}`;
                                answerDiv.innerHTML = `
                    <input type="radio" name="topics[${topicIndex}][questions][${questionIndex}][answer]" value="${answerId}" id="${answerId}" required class="text-indigo-600 focus:ring-indigo-500">
                    <input type="text" name="topics[${topicIndex}][questions][${questionIndex}][answers][${answerId}]" placeholder="คำตอบ" class="flex-grow p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
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
        </div>
        <!--end of project-->
    </main>
</body>

</html>