<?php
include '../../config/database.php'; // เชื่อมต่อฐานข้อมูล

// ดึงข้อมูลหัวข้อจากตาราง evaluation
$sql_evaluation = "SELECT * FROM evaluation";
$result_evaluation = $connect->query($sql_evaluation);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มประเมิน</title>
    <!-- เชื่อมต่อ Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>
            <div class=" w-full page-wrapper xl:px-6 px-0">
            <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">ฟอร์มประเมิน</h1>

        <form action="submit_evaluation.php" method="post" class="bg-white shadow-md rounded-lg p-6">
            <?php while ($evaluation = $result_evaluation->fetch_assoc()): ?>
                <h2 class="text-xl font-semibold mb-4 
            text-gray-800">
                    <?php echo htmlspecialchars($evaluation['evaluation_name']); ?></h2>

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
                        <?php foreach ($evaluation_score as $option): ?>
                            <label class="block mb-2">
                                <input type="radio" name="answers[<?php echo $question['id']; ?>]" value="<?php echo $option['score']; ?>" class="mr-2 leading-tight">
                                <span class="text-gray-800"><?php echo htmlspecialchars($option['text']); ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <?php $question_index++; // เพิ่มตัวนับคำถาม 
                    ?>
                <?php endwhile; ?>
            <?php endwhile; ?>

            <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                ส่งข้อมูลประเมิน
            </button>
        </form>
    </div>
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