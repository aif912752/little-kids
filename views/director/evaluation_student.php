<?php
include '../../config/database.php';
$sql = "SELECT * FROM evaluation_students";
$result = $connect->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบข้อมูลแบบประเมินนักเรียน</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">

    <style>
        .dataTables_length select {
            width: 50px;
        }
    </style>
</head>

<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>

            <div class=" w-full page-wrapper xl:px-6 px-0">

                <div class="container px-6 py-8 mx-auto ">
                    <h3 class="text-3xl font-medium text-black">ตรวจสอบข้อมูลแบบประเมินนักเรียน</h3>
                    <div class="flex flex-col mt-8">
                        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg  bg-white p-3">

                                <!-- ชิดขวา -->
                                <!-- <div class="flex justify-end p-3">
                                    <a href="evaluation_student_add.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">เพิ่มข้อมูล</a>
                                </div> -->


                                <table id="example" class="display pt-8 " style="width:100%">
                                    <thead class="bg-slate-200 border border-rounded">
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">ชื่อหัวข้อ</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">วันที่สร้าง</th>
                                        <th class="py-2 border-b-2 border-gray-200 bg-gray-100">รายละเอียด</th>

                                    </thead>
                                    <tbody>

                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $img_src = !empty($row['img']) ? 'uploads/' . $row['img'] : 'path/to/default-image.jpg';
                                        ?>

                                                <tr>
                                                    <td class="py-5 border-b border-l border-gray-200 bg-white">
                                                        <div class="flex items-center text-sm px-4">

                                                            <div>
                                                                <p class="font-semibold text-black"> <?php echo $row['evaluation_name']; ?></p>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td class="py-5 border-b border-gray-200 bg-white"><?php echo $row['evaluation_date']; ?></td>
                                                    <td class="py-5 border-b border-gray-200 bg-white">
                                                        <button onclick="showEvaluationDetails(<?php echo $row['evaluation_id']; ?>)" class="appearance-none block w-full bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                                            รายละเอียด
                                                        </button>
                                                    </td>


                                                </tr>

                                        <?php
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <div id="evaluationModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true">
                    <div class="flex items-end justify-center  pt-4 px-4  text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-4 py-5 sm:px-6">
                                <h3 class="text-2xl leading-6 font-bold text-white" id="modal-title">
                                    รายละเอียดแบบประเมิน
                                </h3>
                            </div>
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <div class="mt-2">
                                            <div id="evaluationDetails" class="text-sm text-gray-700"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal()">
                                    ปิด
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end of project-->
    </main>
</body>
<script>
    function showEvaluationDetails(evaluationId) {
        // Fetch evaluation details using AJAX
        fetch(`get_evaluation_details.php?id=${evaluationId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('evaluationDetails').innerHTML = formatEvaluationDetails(data);
                document.getElementById('evaluationModal').classList.remove('hidden');
            })
            .catch(error => console.error('Error:', error));
    }

    function formatEvaluationDetails(data) {
        let detailsHtml = `
    <div class="bg-blue-100 border-l-4 border-blue-600 text-blue-700 p-4 mb-4" role="alert">
      <p class="font-bold">ชื่อแบบประเมิน: ${data.evaluation_name}</p>
      <p>วันที่สร้าง: ${data.evaluation_date}</p>
    </div>
    <h4 class="font-bold text-lg mb-3 text-gray-800">คำถามในแบบประเมิน:</h4>
  `;

        data.questions.forEach((question, questionIndex) => {
            detailsHtml += `
      <div class="mb-6 bg-white shadow rounded-lg p-4">
        <p class="font-semibold text-gray-800 text-lg mb-3">${questionIndex + 1}. ${question.text}</p>
        <ul class="mt-2 space-y-2">
    `;
            question.answers.forEach((answer, answerIndex) => {
                detailsHtml += `
        <li class="flex items-center bg-gray-50 p-2 rounded">
          <span class="inline-flex items-center justify-center h-6 w-6 rounded-lg bg-blue-600 text-white text-sm font-semibold mr-3">${answerIndex + 1}</span>
          <span class="flex-grow">${answer.text}</span>
          <span class="inline-flex items-center justify-center h-6 px-2 rounded-lg bg-green-500 text-white text-sm font-semibold ml-2">
            ${answer.score} คะแนน
          </span>
        </li>
      `;
            });
            detailsHtml += `</ul></div>`;
        });
        return detailsHtml;
    }

    function closeModal() {
        document.getElementById('evaluationModal').classList.add('hidden');
    }
</script>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable(); // เรียกใช้งาน DataTables
    });
</script>
<!-- SweetAlert2 -->
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

<?php
// เช็ค session alert ถ้ามีข้อความมีไหม ถ้ามีให้แสดงผล
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    if ($_SESSION['status'] == 'error') {
        echo "<script>
            Swal.fire({
                position: 'center',
                icon: '" . $_SESSION['status'] . "',
                title: 'เกิดข้อผิดพลาด',
                text: '$alert',
                showConfirmButton: false,
                timer: 1500
            })
            </script>";
    } else {
        echo "<script>
            Swal.fire({
                position: 'center',
                icon: '" . $_SESSION['status'] . "',
                title: 'สำเร็จ!',
                text: '$alert',
                showConfirmButton: false,
                timer: 1500
            })
            </script>";
    }

    unset($_SESSION['status']);
    unset($_SESSION['alert']);
}

?>