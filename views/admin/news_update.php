<?php
session_start();
include('../../config/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $news_id = $_POST['news_id'];
    $title = $_POST['title'];
    $details = $_POST['details'];

    // เตรียม SQL statement สำหรับการ update ข้อมูล
    $sql = "UPDATE news SET title = ?, details = ?";
    $params = array($title, $details);

    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพใหม่หรือไม่
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $upload_dir = 'uploads/';
        $img = $_FILES['img'];
        $img_name = uniqid() . '-' . basename($img['name']);
        $target_file = $upload_dir . $img_name;

        if (move_uploaded_file($img['tmp_name'], $target_file)) {
            // ถ้าอัปโหลดสำเร็จ ให้อัปเดตชื่อไฟล์ในฐานข้อมูล
            $sql .= ", img = ?";
            $params[] = $img_name;

            // ลบรูปภาพเก่า (ถ้ามี)
            $old_img_query = "SELECT img FROM news WHERE news_id = ?";
            $old_img_stmt = $connect->prepare($old_img_query);
            $old_img_stmt->bind_param("i", $news_id);
            $old_img_stmt->execute();
            $old_img_result = $old_img_stmt->get_result();
            if ($old_img_row = $old_img_result->fetch_assoc()) {
                $old_img = $old_img_row['img'];
                if (!empty($old_img) && file_exists($upload_dir . $old_img)) {
                    unlink($upload_dir . $old_img);
                }
            }
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['alert'] = 'ไม่สามารถอัปโหลดรูปภาพได้';
            header("Location: news_edit.php?id=$news_id");
            exit();
        }
    }

    $sql .= " WHERE news_id = ?";
    $params[] = $news_id;

    $stmt = $connect->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);

    if ($stmt->execute()) {
        $_SESSION['status'] = 'success';
        $_SESSION['alert'] = 'แก้ไขข้อมูลข่าวสำเร็จ';
        header('Location: news.php');
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['alert'] = 'ไม่สามารถแก้ไขข้อมูลได้';
        header("Location: news_edit.php?id=$news_id");
    }

    $stmt->close();
} else {
    $_SESSION['status'] = 'error';
    $_SESSION['alert'] = 'เกิดข้อผิดพลาดในการส่งข้อมูล';
    header('Location: news.php');
}

$connect->close();
?>