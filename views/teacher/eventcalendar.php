<?php
include '../../config/database.php';
$sql = "SELECT * FROM activity";
$result = $connect->query($sql);

$events = array();
while ($row = $result->fetch_assoc()) {
    $events[] = array(
        'title' => $row['activity_name'],
        'start' => $row['activity_date_start'],
        'end' => $row['activity_date_end'],
        'description' => $row['activity_description'],
        'type' => $row['activity_type']
    );
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: <?php echo json_encode($events); ?>,
                eventClick: function(info) {
                    alert('กิจกรรม: ' + info.event.title + '\n' +
                          'ประเภท: ' + info.event.extendedProps.type + '\n' +
                          'รายละเอียด: ' + info.event.extendedProps.description);
                }
            });
            calendar.render();
        });
    </script>
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>
<body class=" bg-surface">
    <main>
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <?php include '../../src/navbar_teacher.php'; ?>
            <div class=" w-full page-wrapper xl:px-6 px-0">
            <main class="h-full  max-w-full">

    <div id='calendar'></div>
    </main>
            </div>
        </div>
        <!--end of project-->
    </main>
</body>
</html>