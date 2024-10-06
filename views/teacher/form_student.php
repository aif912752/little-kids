<?php
include '../../config/database.php'; // เชื่อมต่อฐานข้อมูล

// ดึงข้อมูลครูจากตาราง teacher
$sql_teachers = "SELECT student_id, first_name, last_name FROM students";
$result_teachers = $connect->query($sql_teachers);

$selected_teacher_id = null;
$show_evaluation_form = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['select_teacher'])) {
    $selected_teacher_id = $_POST['student_id'];
    $show_evaluation_form = true;
}

// ดึงข้อมูลหัวข้อจากตาราง evaluation เฉพาะของครูที่เลือก
$sql_evaluation = "SELECT * FROM evaluation_students WHERE students_id = ?";
$stmt_evaluation = $connect->prepare($sql_evaluation);
$stmt_evaluation->bind_param("i", $selected_teacher_id);
$stmt_evaluation->execute();
$result_evaluation = $stmt_evaluation->get_result();
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มประเมินครู</title>
    <!-- เชื่อมต่อ Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- เชื่อมต่อ SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-surface">
    <main>
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>
            <div class="w-full page-wrapper xl:px-6 px-0">
                <div class="relative">
                    <h2 class="w-full mb-4 text-3xl font-bold text-center sm:text-4xl md:text-5xl">แบบประเมินครู</h2>
                </div>
                <div class="relative block p-8 overflow-hidden border bg-white border-slate-100 rounded-lg ml-6 mr-6">
                    <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600"></span>

                    <!-- ฟอร์มเลือกครู -->
                    <form action="" method="post" class="mb-6">
                        <div class="mb-4">
                            <label for="student_id" class="block text-sm font-medium text-gray-700">เลือกครูที่ต้องการประเมิน:</label>
                            <select name="student_id" id="student_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                                <option value="">-- เลือกครู --</option>
                                <?php while ($teacher = $result_teachers->fetch_assoc()): ?>
                                    <option value="<?php echo $teacher['student_id']; ?>" <?php echo ($selected_teacher_id == $teacher['student_id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" name="select_teacher" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                                เลือกครู
                            </button>
                        </div>
                    </form>

                    <?php if ($show_evaluation_form && $result_evaluation->num_rows > 0): ?>
                        <form action="" method="post" class="">
                            <input type="hidden" name="student_id" value="<?php echo $selected_teacher_id; ?>">
                            <?php while ($evaluation = $result_evaluation->fetch_assoc()): ?>
                                <h2 class="text-xl font-semibold mb-4 text-gray-800">
                                    <?php echo htmlspecialchars($evaluation['evaluation_name']); ?>
                                </h2>

                                <?php
                                // ดึงคำถามย่อยจากตาราง evaluation_activity
                                $sql_questions = "SELECT * FROM evaluation_activity WHERE activity_id = ?";
                                $stmt_questions = $connect->prepare($sql_questions);
                                $stmt_questions->bind_param("s", $evaluation['evaluation_id']);
                                $stmt_questions->execute();
                                $questions_result = $stmt_questions->get_result();

                                $question_index = 1; // ตัวนับสำหรับลำดับคำถาม
                                while ($question = $questions_result->fetch_assoc()):
                                    // แปลง JSON เป็นอาเรย์
                                    $evaluation_score = json_decode($question['evaluation_score'], true);
                                ?>
                                    <div class="mb-6">
                                        <h3 class="text-lg font-medium text-gray-700 mb-2"><?php echo $question_index . '. ' . htmlspecialchars($question['evaluation_name']); ?></h3>
                                        <input type="hidden" name="evaluation_id[<?php echo $question['id']; ?>]" value="<?php echo $evaluation['evaluation_id']; ?>">
                                        <input type="hidden" name="evaluation_activity_id[]" value="<?php echo $question['id']; ?>">
                                        <?php foreach ($evaluation_score as $option): ?>
                                            <label class="block mb-2">
                                                <input type="radio" name="answers[<?php echo $question['id']; ?>]" value="<?php echo $option['score']; ?>" class="mr-2 leading-tight" required>
                                                <span class="text-gray-800"><?php echo htmlspecialchars($option['text']); ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php $question_index++; ?>
                                <?php endwhile; ?>
                            <?php endwhile; ?>
                            <div class="flex justify-end">
                                <button type="submit" name="submit_evaluation" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                                    ส่งข้อมูลประเมิน
                                </button>
                            </div>
                        </form>
                    <?php elseif ($show_evaluation_form): ?>
                        <div class="text-center text-gray-700">
                            <h3 class="text-xl font-medium">ไม่มีข้อมูลสำหรับการประเมินครูท่านนี้ในขณะนี้</h3>
                        </div>
                    <?php endif; ?>

                    <script>
                        // ฟังก์ชันแสดงป๊อปอัพ
                        function showAlert(title, text, icon) {
                            Swal.fire({
                                title: title,
                                text: text,
                                icon: icon,
                                confirmButtonText: 'ตกลง',
                                confirmButtonColor: '#007bff'
                            });
                        }
                    </script>

                    <?php
                    if (isset($_POST['submit_evaluation'])) {
                        $student_id = $_POST['student_id'];
                        $evaluation_ids = $_POST['evaluation_id'];
                        $evaluation_activity_ids = $_POST['evaluation_activity_id'];
                        $answers = $_POST['answers'];
                        $success = true;

                        foreach ($evaluation_activity_ids as $activity_id) {
                            $evaluation_id = $evaluation_ids[$activity_id];
                            $total_score = $answers[$activity_id];

                            $sql_insert = "INSERT INTO evaluation_to_activity_student (evaluation_id, evaluation_activity_id, total_score, students_id) VALUES (?, ?, ?, ?)";
                            $stmt_insert = $connect->prepare($sql_insert);
                            $stmt_insert->bind_param("issi", $evaluation_id, $activity_id, $total_score, $student_id);

                            if (!$stmt_insert->execute()) {
                                echo "<script>showAlert('เกิดข้อผิดพลาด', '" . $stmt_insert->error . "', 'error');</script>";
                                $success = false;
                                break;
                            }
                        }

                        if ($success) {
                            echo "<script>showAlert('สำเร็จ', 'บันทึกข้อมูลประเมินเรียบร้อยแล้ว', 'success');</script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>

<?php
// ปิดการเชื่อมต่อฐานข้อมูล
$connect->close();
?>