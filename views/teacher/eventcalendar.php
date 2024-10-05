<?php
date_default_timezone_set('Asia/Bangkok');
include '../../config/database.php';
$sql = "SELECT * FROM activity";
$result = $connect->query($sql);

$events = array();
while ($row = $result->fetch_assoc()) {
    $end_date = new DateTime($row['activity_date_end']);
    $end_date->modify('+1 day');  // เพิ่ม 1 วันสำหรับ FullCalendar
    $events[] = array(
        'id' => $row['id'],
        'title' => $row['activity_name'],
        'start' => $row['activity_date_start'],
        'end' => $end_date->format('Y-m-d'),
        'description' => $row['activity_description'],
        'type' => $row['activity_type']
    );
}

function formatThaiDate($date)
{
    $thai_months = array(
        "01" => "มกราคม",
        "02" => "กุมภาพันธ์",
        "03" => "มีนาคม",
        "04" => "เมษายน",
        "05" => "พฤษภาคม",
        "06" => "มิถุนายน",
        "07" => "กรกฎาคม",
        "08" => "สิงหาคม",
        "09" => "กันยายน",
        "10" => "ตุลาคม",
        "11" => "พฤศจิกายน",
        "12" => "ธันวาคม"
    );
    $date_obj = new DateTime($date, new DateTimeZone('UTC'));
    $date_obj->setTimezone(new DateTimeZone('Asia/Bangkok'));
    $thai_year = $date_obj->format('Y') + 543;
    return $date_obj->format('d') . " " . $thai_months[$date_obj->format('m')] . " " . $thai_year;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กิจกรรม</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/th.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }

        .fc-event-desc {
            font-size: 0.8em;
            color: #666;
        }
    </style>
</head>

<body class="bg-surface">
    <main>
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>
            <div class="w-full page-wrapper xl:px-6 px-0">
                <main class="h-full max-w-full">
                    <div id='calendar'></div>
                </main>
            </div>
        </div>
    </main>

    <!-- Modal for adding new event -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">เพิ่มกิจกรรมใหม่</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEventForm" action="insert_activity.php" method="POST">
                        <div class="mb-3">
                            <label for="activity_name" class="form-label">ชื่อกิจกรรม</label>
                            <input type="text" class="form-control" id="activity_name" name="activity_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="activity_type" class="form-label">ประเภทกิจกรรม</label>
                            <input type="text" class="form-control" id="activity_type" name="activity_type" required>
                        </div>
                        <div class="mb-3">
                            <label for="activity_description" class="form-label">รายละเอียดกิจกรรม</label>
                            <textarea class="form-control" id="activity_description" name="activity_description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="activity_date_start" class="form-label">วันที่เริ่มต้น</label>
                            <input type="text" class="form-control flatpickr" id="activity_date_start" name="activity_date_start" required>
                        </div>
                        <div class="mb-3">
                            <label for="activity_date_end" class="form-label">วันที่สิ้นสุด</label>
                            <input type="text" class="form-control flatpickr" id="activity_date_end" name="activity_date_end" required>
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for editing event -->
    <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEventModalLabel">แก้ไขกิจกรรม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editEventForm" action="update_activity.php" method="POST">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label for="edit_activity_name" class="form-label">ชื่อกิจกรรม</label>
                            <input type="text" class="form-control" id="edit_activity_name" name="activity_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_activity_type" class="form-label">ประเภทกิจกรรม</label>
                            <input type="text" class="form-control" id="edit_activity_type" name="activity_type" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_activity_description" class="form-label">รายละเอียดกิจกรรม</label>
                            <textarea class="form-control" id="edit_activity_description" name="activity_description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_activity_date_start" class="form-label">วันที่เริ่มต้น</label>
                            <input type="text" class="form-control flatpickr" id="edit_activity_date_start" name="activity_date_start" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_activity_date_end" class="form-label">วันที่สิ้นสุด</label>
                            <input type="text" class="form-control flatpickr" id="edit_activity_date_end" name="activity_date_end" required>
                        </div>
                        <div class="flex justify-between items-center">
                        <button type="submit" class=" bg-red-600 text-white p-3 rounded-md"
                        style="background-color: #03346E;">บันทึกการแก้ไข</button>
                      
                        <button type="button" id="deleteEventButton" class=" bg-red-600 text-white p-3 rounded-md"
                         style="background-color: #800000;">ลบกิจกรรม</button>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: <?php echo json_encode($events); ?>,
            selectable: true,
            timeZone: 'Asia/Bangkok',
            select: function(info) {
                $('#addEventModal').modal('show');
                $('#activity_date_start').val(formatDateForFlatpickr(info.start));

                let endDate = info.end ? new Date(info.end) : new Date(info.start);
                endDate.setDate(endDate.getDate() - 1);
                $('#activity_date_end').val(formatDateForFlatpickr(endDate));
            },
            eventClick: function(info) {
                $('#editEventModal').modal('show');
                $('#edit_id').val(info.event.id);
                $('#edit_activity_name').val(info.event.title);
                $('#edit_activity_type').val(info.event.extendedProps.type);
                $('#edit_activity_description').val(info.event.extendedProps.description);
                
                $('#edit_activity_date_start').val(formatDateForFlatpickr(info.event.start));
                
                let endDate = info.event.end ? new Date(info.event.end) : new Date(info.event.start);
                endDate.setDate(endDate.getDate() - 1);
                $('#edit_activity_date_end').val(formatDateForFlatpickr(endDate));
            }
        });
        calendar.render();

        // การจัดการกับการลบกิจกรรม
        $('#editEventForm').on('submit', function(e) {
            e.preventDefault();
            let startDate = document.getElementById('edit_activity_date_start').value;
            let endDate = document.getElementById('edit_activity_date_end').value;

            document.getElementById('edit_activity_date_start').value = formatDateForDatabase(startDate);
            document.getElementById('edit_activity_date_end').value = formatDateForDatabase(endDate);

            this.submit();
        });

        // ลบกิจกรรม
        $('#deleteEventButton').on('click', function() {
            const eventId = $('#edit_id').val();
            if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบกิจกรรมนี้?')) {
                window.location.href = `activity_delete.php?id=${eventId}`;
            }
        });
    });

    function formatDateForFlatpickr(date) {
        if (!date || isNaN(date.getTime())) {
            return '';
        }
        let d = new Date(date);
        let day = ('0' + d.getDate()).slice(-2);
        let month = ('0' + (d.getMonth() + 1)).slice(-2);
        let year = d.getFullYear();
        return `${day}/${month}/${year}`;
    }

    function formatDateForDatabase(dateStr) {
        if (!dateStr) return '';
        let parts = dateStr.split('/');
        if (parts.length !== 3) return '';
        return `${parts[2]}-${parts[1]}-${parts[0]}`;
    }

    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('.flatpickr', {
            dateFormat: 'd/m/Y',
            locale: 'th',
            firstDayOfWeek: 1,
            defaultDate: 'today',
            onReady: function(selectedDates, dateStr, instance) {
                instance.setDate(instance.selectedDates[0], true, instance.config.dateFormat);
            }
        });
    });
</script>

</html>