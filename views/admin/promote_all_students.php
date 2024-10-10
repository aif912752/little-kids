<?php
include '../../config/database.php';

if (isset($_GET['current_room_id']) && isset($_GET['next_room_id'])) {
    $current_room_id = $_GET['current_room_id'];
    $next_room_id = $_GET['next_room_id'];

    // Check if the next room exists
    $sql_check = "SELECT * FROM room WHERE room_id = ?";
    $stmt_check = $connect->prepare($sql_check);
    $stmt_check->bind_param("i", $next_room_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows == 0) {
        // Next room doesn't exist, redirect with error
        header("Location: room_view.php?id=" . $current_room_id . "&promoted=bulk_error&message=" . urlencode("ไม่พบห้องเรียนถัดไป"));
        exit();
    }

    // Update all students' room_id
    $sql = "UPDATE students SET room_id = ? WHERE room_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $next_room_id, $current_room_id);

    if ($stmt->execute()) {
        // Redirect back to the room view page with a success message
        header("Location: room_view.php?id=" . $current_room_id . "&promoted=bulk_success");
        exit();
    } else {
        // Redirect back to the room view page with an error message
        header("Location: room_view.php?id=" . $current_room_id . "&promoted=bulk_error&message=" . urlencode("เกิดข้อผิดพลาดในการเลื่อนชั้น"));
        exit();
    }
} else {
    // Redirect back to the room view page if the required parameters are missing
    header("Location: room_view.php?id=" . $current_room_id . "&promoted=bulk_error&message=" . urlencode("ข้อมูลไม่ครบถ้วน"));
    exit();
}
?>