-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 04:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `little_kids`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL COMMENT 'รหัสกิจกรรม',
  `user_id` int(11) NOT NULL COMMENT 'รหัสผู้ใช้ที่เกี่ยวข้อง',
  `activity_type` varchar(255) NOT NULL COMMENT 'ประเภทกิจกรรม',
  `activity_name` varchar(255) NOT NULL COMMENT 'ชื่อกิจกรรม',
  `activity_description` text DEFAULT NULL COMMENT 'รายละเอียดกิจกรรม',
  `activity_date_start` varchar(255) DEFAULT current_timestamp() COMMENT 'วันที่เริ่มกิจกรรม',
  `activity_date_end` varchar(255) DEFAULT current_timestamp() COMMENT 'เวลาสิ้นสุดกิจกรรม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `user_id`, `activity_type`, `activity_name`, `activity_description`, `activity_date_start`, `activity_date_end`) VALUES
(5, 0, 'กีฬา', 'กิจกรรมนัทนาการ', 'เล่นกิจกรรมกับเพื่อน', '2024-10-07', '2024-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `admin_id` int(11) NOT NULL COMMENT 'รหัสผู้ดูแลระบบ',
  `first_name` varchar(100) NOT NULL COMMENT 'ชื่อจริงของผู้ดูแลระบบ',
  `last_name` varchar(100) NOT NULL COMMENT 'นามสกุลของผู้ดูแลระบบ',
  `position` varchar(100) NOT NULL COMMENT 'ตำเเหน่วของผู้ดูเเลระบบ',
  `citizen_id` varchar(100) NOT NULL COMMENT 'บัตรประชนชนของผู้ดูเเลระบบ',
  `email` varchar(255) DEFAULT NULL COMMENT 'อีเมลของผู้ดูแลระบบ',
  `phone_number` varchar(15) DEFAULT NULL COMMENT 'หมายเลขโทรศัพท์ของผู้ดูแลระบบ',
  `birthdate` date NOT NULL COMMENT 'วันเดือนปีเกิด',
  `ethnicity` varchar(50) DEFAULT NULL COMMENT 'เชื้อชาติ',
  `nationality` varchar(50) DEFAULT NULL COMMENT 'สัญชาติ',
  `religion` varchar(50) DEFAULT NULL COMMENT 'ศาสนา',
  `address` text DEFAULT NULL COMMENT 'ที่อยู่ของผู้ดูแลระบบ',
  `user_id` int(11) NOT NULL COMMENT 'เป็นrefไอดีที่มาจากuser'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`admin_id`, `first_name`, `last_name`, `position`, `citizen_id`, `email`, `phone_number`, `birthdate`, `ethnicity`, `nationality`, `religion`, `address`, `user_id`) VALUES
(1, 'ไอ่นนท์', 'กาย', 'ผู้ดูแลระบบ', 'ไอ่นนท์', 'warunyoo084@gmail.com', 'ไอ่นนท์', '2024-10-16', 'ไอ่นนท์', 'ไอ่นนท์', 'ไอ่นนท์', 'กาย', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL COMMENT 'รหัสการลงเวลา',
  `student_id` int(11) NOT NULL COMMENT 'รหัสนักเรียน',
  `student_name` varchar(255) NOT NULL COMMENT 'ชื่อนักเรียน',
  `student_lastname` varchar(255) NOT NULL COMMENT 'นามกสุลนักเรียน',
  `attendance_date` date NOT NULL COMMENT 'วันที่ลงเวลา',
  `note` varchar(100) NOT NULL COMMENT 'หมายเหตุ',
  `room_id` varchar(50) NOT NULL COMMENT 'เก็บวันที่ if ref มาจาก table room ',
  `status` varchar(50) NOT NULL COMMENT 'สถานะการเข้าเรียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `student_name`, `student_lastname`, `attendance_date`, `note`, `room_id`, `status`) VALUES
(30, 20, 'supapit', 'intarathaiwong', '2024-10-07', '', '5', 'มา');

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `director_id` int(10) NOT NULL COMMENT 'ไอดีผู้อำนวยการ',
  `Img` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `first_name` varchar(100) NOT NULL COMMENT 'ชื่อผุ้อำนวยการ',
  `last_name` varchar(100) NOT NULL COMMENT 'นามสกุลผู้อำนวยการ',
  `birthdate` date NOT NULL COMMENT 'วันเดือนปีเกิดผู้อำนวยการ',
  `email` varchar(100) NOT NULL COMMENT 'อีเมล์ผู้อำนวยการ',
  `phone_number` varchar(15) NOT NULL COMMENT 'เบอร์โทรผู้อำนวยการ',
  `position` varchar(100) NOT NULL COMMENT 'ตำเเหน่งผู้อำนวยการ',
  `user_id` int(11) NOT NULL COMMENT 'เป็นrefไอดีที่มาจากuser	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`director_id`, `Img`, `first_name`, `last_name`, `birthdate`, `email`, `phone_number`, `position`, `user_id`) VALUES
(5, '', 'ปัญญา', 'จิตใจดี', '2024-10-23', 'warunyoo084@gmail.com', '0848091046', 'ผู้อำนวยการ', 33);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `evaluation_id` int(11) NOT NULL COMMENT 'รหัสประจำแบบประเมิน',
  `techer_id` int(50) NOT NULL COMMENT 'ไอดีคุณครู',
  `evaluation_name` varchar(255) NOT NULL COMMENT 'หัวแบบฟอร์ม',
  `score` varchar(3) NOT NULL COMMENT 'คะเเนนเก็บเป็น string',
  `evaluation_date` date NOT NULL COMMENT 'วันที่ทำการประเมิน',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`evaluation_id`, `techer_id`, `evaluation_name`, `score`, `evaluation_date`, `created_at`, `updated_at`) VALUES
(14, 4, 'คุณครูมีส่วนรวมกับกิจกรรมหรือไม่', '28', '2024-10-07', '2024-10-07 13:35:02', '2024-10-07 13:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_activity`
--

CREATE TABLE `evaluation_activity` (
  `id` int(50) NOT NULL,
  `activity_id` varchar(50) NOT NULL COMMENT 'เก็บ id มาจาก table evalution',
  `evaluation_name` varchar(255) NOT NULL COMMENT 'ชื่อกิจกรรม',
  `evaluation_score` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'คะเเนนประเมินในรูปแบบ JSON' CHECK (json_valid(`evaluation_score`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `evaluation_activity`
--

INSERT INTO `evaluation_activity` (`id`, `activity_id`, `evaluation_name`, `evaluation_score`) VALUES
(6, '14', 'เข้าร่วมกิจกรรม', '[{\"text\":\"\\u0e14\\u0e35\\u0e21\\u0e32\\u0e01\",\"score\":5},{\"text\":\"\\u0e14\\u0e35\",\"score\":4},{\"text\":\"\\u0e01\\u0e25\\u0e32\\u0e07\",\"score\":3},{\"text\":\"\\u0e44\\u0e21\\u0e48\\u0e14\\u0e35\",\"score\":2}]'),
(7, '14', 'ความคิดสร้างสรรค์', '[{\"text\":\"\\u0e14\\u0e35\\u0e21\\u0e32\\u0e01\",\"score\":5},{\"text\":\"\\u0e14\\u0e35\",\"score\":4},{\"text\":\"\\u0e01\\u0e25\\u0e32\\u0e07\",\"score\":3},{\"text\":\"\\u0e44\\u0e21\\u0e48\\u0e14\\u0e35\",\"score\":2}]');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_activity_student`
--

CREATE TABLE `evaluation_activity_student` (
  `id` int(11) NOT NULL COMMENT 'id หลัก',
  `activity_id` varchar(50) NOT NULL COMMENT 'เก็บ id มาจาก table evalution',
  `evaluation_name` varchar(255) NOT NULL COMMENT 'ชื่อกิจกรรม',
  `evaluation_score` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'คะเเนนประเมินในรูปแบบ JSON' CHECK (json_valid(`evaluation_score`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `evaluation_activity_student`
--

INSERT INTO `evaluation_activity_student` (`id`, `activity_id`, `evaluation_name`, `evaluation_score`) VALUES
(15, '15', 'ความสนุกสนานของกิจกรรม', '[{\"text\":\"\\u0e14\\u0e35\\u0e21\\u0e32\\u0e01\",\"score\":5},{\"text\":\"\\u0e14\\u0e35\",\"score\":4},{\"text\":\"\\u0e1b\\u0e32\\u0e19\\u0e01\\u0e25\\u0e32\\u0e07\",\"score\":3},{\"text\":\"\\u0e19\\u0e49\\u0e2d\\u0e22\",\"score\":2},{\"text\":\"\\u0e19\\u0e49\\u0e2d\\u0e22\\u0e21\\u0e32\\u0e01\",\"score\":1}]'),
(16, '15', 'กิจกรรมมีความหลากหลาย', '[{\"text\":\"\\u0e14\\u0e35\\u0e21\\u0e32\\u0e01\",\"score\":5},{\"text\":\"\\u0e14\\u0e35\",\"score\":4},{\"text\":\"\\u0e1b\\u0e32\\u0e19\\u0e01\\u0e25\\u0e32\\u0e07\",\"score\":3},{\"text\":\"\\u0e19\\u0e49\\u0e2d\\u0e22\",\"score\":2},{\"text\":\"\\u0e19\\u0e49\\u0e2d\\u0e22\\u0e21\\u0e32\\u0e01\",\"score\":1}]');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_students`
--

CREATE TABLE `evaluation_students` (
  `evaluation_id` int(11) NOT NULL COMMENT 'รหัสประจำแบบประเมิน',
  `students_id` int(11) NOT NULL COMMENT 'ไอดีนักเรียนมราทุกประเมิน',
  `evaluation_name` varchar(255) NOT NULL COMMENT 'หัวแบบฟอร์ม',
  `score` varchar(3) NOT NULL COMMENT 'คะเเนนเก็บเป็น string',
  `evaluation_date` date NOT NULL COMMENT 'วันที่ทำการประเมิน',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `evaluation_students`
--

INSERT INTO `evaluation_students` (`evaluation_id`, `students_id`, `evaluation_name`, `score`, `evaluation_date`, `created_at`, `updated_at`) VALUES
(15, 20, 'กิจกรรมนัทนาการ', '30', '2024-10-07', '2024-10-07 13:23:41', '2024-10-07 13:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_to_activity`
--

CREATE TABLE `evaluation_to_activity` (
  `id` int(150) NOT NULL,
  `techer_id` int(50) NOT NULL COMMENT 'ไอดีคุณครูที่ประเมิน',
  `evaluation_id` int(11) NOT NULL COMMENT 'อ้างอิงจากรหัสประเมิน อ้างอิงมาจาก table evaluation ',
  `evaluation_activity_id` varchar(50) NOT NULL COMMENT 'อ้างอิงจากรหัสกิจกรรมประเมินจาก table evaluation_activity ',
  `total_score` varchar(50) NOT NULL COMMENT 'คะเเนนรวม ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_to_activity_student`
--

CREATE TABLE `evaluation_to_activity_student` (
  `id` int(11) NOT NULL COMMENT 'id หลัก',
  `students_id` int(50) NOT NULL COMMENT 'ไอดีที่ ref มาจาก table',
  `evaluation_id` int(11) NOT NULL COMMENT 'อ้างอิงจากรหัสประเมิน อ้างอิงมาจาก table evaluation ',
  `evaluation_activity_id` varchar(50) NOT NULL COMMENT 'อ้างอิงจากรหัสกิจกรรมประเมินจาก table evaluation_activity ',
  `total_score` varchar(50) NOT NULL COMMENT 'คะเเนนรวม ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `evaluation_to_activity_student`
--

INSERT INTO `evaluation_to_activity_student` (`id`, `students_id`, `evaluation_id`, `evaluation_activity_id`, `total_score`, `created_at`, `updated_at`) VALUES
(2, 20, 15, '15', '5', '2024-10-07 13:43:02', '2024-10-07 13:43:02'),
(3, 20, 15, '16', '3', '2024-10-07 13:43:02', '2024-10-07 13:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `guardian_id` int(11) NOT NULL COMMENT 'รหัสผู้ปกครอง',
  `img` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `first_name` varchar(100) NOT NULL COMMENT 'ชื่อของผู้ปกครอง',
  `last_name` varchar(100) NOT NULL COMMENT 'นามสกุลของผู้ปกครอง',
  `phone_number` varchar(15) DEFAULT NULL COMMENT 'หมายเลขโทรศัพท์ของผู้ปกครอง',
  `gender` enum('Male','Female','Other') NOT NULL COMMENT 'เพศของผู้ปกครอง',
  `address` text DEFAULT NULL COMMENT 'ที่อยู่ของผู้ปกครอง',
  `relation_to_student` varchar(50) NOT NULL COMMENT 'ความสัมพันธ์ระหว่างผู้ปกครองกับนักเรียน เช่น พ่อ, แม่, ลุง, ป้า',
  `student_id` int(11) NOT NULL COMMENT 'ชื่อนามสกุลของนักเรียนที่ ref ไปหา',
  `user_id` int(11) NOT NULL COMMENT 'รหัสที่ ref ไปหา user_id',
  `room_id` varchar(255) NOT NULL COMMENT 'ไอดีที่ ref ไปหาห้องเรียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`guardian_id`, `img`, `first_name`, `last_name`, `phone_number`, `gender`, `address`, `relation_to_student`, `student_id`, `user_id`, `room_id`) VALUES
(3, '', 'ปรีดา', 'ใจเสีย', '028480954', 'Male', 'อ.เมือง จ.เชียงใหม่ 50555', 'พ่อ', 20, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่สร้างข่าว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `details`, `img`, `created_at`) VALUES
(6, 'ประชาสัมพันธ์', 'รับนักเรียนเพิ่ม 50 อัตตรา', '6703e1e045b0c-2.jpg', '2024-10-07 13:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL COMMENT 'ชื่อห้องเรียน',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `created_at`, `updated_at`) VALUES
(5, 'อนุบาล 1', '2024-10-07 13:13:07', '2024-10-07 13:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL COMMENT 'รหัสประจำตัว',
  `img` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `first_name` varchar(100) NOT NULL COMMENT 'ชื่อนักเรียน',
  `last_name` varchar(100) NOT NULL COMMENT 'นามสกุล',
  `birthdate` date NOT NULL COMMENT 'วันเดือนปีเกิดนักเรียน',
  `ethnicity` varchar(100) NOT NULL COMMENT 'เชื้อชาติ',
  `nationality` varchar(100) NOT NULL COMMENT 'สัญชาติ',
  `religion` varchar(100) NOT NULL COMMENT 'ศาสนา',
  `gender` enum('Male','Female','Other') NOT NULL COMMENT 'เพศนักเรียน',
  `citizen_id` varchar(11) NOT NULL COMMENT 'รหัสบัตรประชาชน',
  `enrollment_date` date NOT NULL COMMENT 'วันที่ลงทะเบียนเข้าเรียน',
  `grade_level` varchar(50) NOT NULL COMMENT 'ชั้นที่เรียน',
  `status` enum('Active','Inactive','Graduated') DEFAULT 'Active' COMMENT 'สถาณะนักเรียน',
  `user_id` int(11) NOT NULL COMMENT 'เป็นrefไอดีที่มาจากuser	',
  `guardians_id` varchar(255) NOT NULL COMMENT 'ไอดีที่ ref ไปหาผู้ครอง',
  `room_id` varchar(255) NOT NULL COMMENT 'ไอดีที่ ref ไปหาห้องเรียน',
  `student_height` varchar(255) NOT NULL COMMENT 'ส่วนสูงนักเรียน',
  `student_weight` varchar(255) NOT NULL COMMENT 'น้ำหนักนักเรียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `img`, `first_name`, `last_name`, `birthdate`, `ethnicity`, `nationality`, `religion`, `gender`, `citizen_id`, `enrollment_date`, `grade_level`, `status`, `user_id`, `guardians_id`, `room_id`, `student_height`, `student_weight`) VALUES
(20, '6703dfff025eb-1.jpg', 'supapit', 'intarathaiwong', '2024-10-10', 'ไทย', 'พทธ', 'พุทธ', 'Female', '15099660454', '2024-10-17', '', 'Active', 35, '', '5', '150', '45');

-- --------------------------------------------------------

--
-- Table structure for table `student_measurements`
--

CREATE TABLE `student_measurements` (
  `id` int(11) NOT NULL COMMENT 'ไอดีหลัก pk',
  `student_id` varchar(50) NOT NULL COMMENT 'ไอดีนักเรียน',
  `weight` decimal(5,2) NOT NULL COMMENT 'น้ำหนัก (กิโลกรัม)',
  `height` decimal(5,2) NOT NULL COMMENT 'ส่วนสูง (เซนติเมตร)',
  `recorded_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาที่บันทึกข้อมูล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student_measurements`
--

INSERT INTO `student_measurements` (`id`, `student_id`, `weight`, `height`, `recorded_at`) VALUES
(2, '20', 56.00, 175.00, '2024-10-07 13:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(10) NOT NULL COMMENT 'ไอดีครู',
  `img` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `first_name` varchar(100) NOT NULL COMMENT 'ชื่อครู',
  `last_name` varchar(100) NOT NULL COMMENT 'นามสกุลครู',
  `position` varchar(100) NOT NULL COMMENT 'ตำเเหน่งครู',
  `email` varchar(100) NOT NULL COMMENT 'อีเมลครู',
  `ethnicity` varchar(100) NOT NULL COMMENT 'เชื้อชาติ',
  `nationality` varchar(100) NOT NULL COMMENT 'สัญชาติ',
  `religion` varchar(100) NOT NULL COMMENT 'ศาสนา',
  `citizen_id` int(15) NOT NULL COMMENT 'รหัสบัตรประชาชน',
  `birthdate` date NOT NULL COMMENT 'วันเดือนปีเกิดครู',
  `phone_number` varchar(15) NOT NULL COMMENT 'เบอร์โทรครู',
  `teacher_address` varchar(255) NOT NULL COMMENT 'ที่อยู่ครู',
  `room_id` varchar(50) NOT NULL COMMENT 'ชั้นที่สอน',
  `user_id` int(11) NOT NULL COMMENT 'เป็นrefไอดีที่มาจากuser'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `img`, `first_name`, `last_name`, `position`, `email`, `ethnicity`, `nationality`, `religion`, `citizen_id`, `birthdate`, `phone_number`, `teacher_address`, `room_id`, `user_id`) VALUES
(4, '6703deb0a46f5-1.png', 'ดรุนี', 'ปีจิตะ', 'ครู', 'warunyoo084@gmail.com', 'ไทย', 'ไทย', 'พุทธ', 2147483647, '2024-10-17', '0848091046', '228/45 หมู 5  ซอย.เจริญสุข อ.เมือง จ.เชียงใหม่', '5', 34);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `role`) VALUES
(1, 'admin', '123456789', 'adminnon', 1),
(33, 'director', '123456789', 'ปัญญา', 2),
(34, 'teacher', '123456789', 'ดรุนี', 3),
(35, '150996604546', '150996604546', 'supapit', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`director_id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`evaluation_id`);

--
-- Indexes for table `evaluation_activity`
--
ALTER TABLE `evaluation_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_activity_student`
--
ALTER TABLE `evaluation_activity_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_students`
--
ALTER TABLE `evaluation_students`
  ADD PRIMARY KEY (`evaluation_id`);

--
-- Indexes for table `evaluation_to_activity`
--
ALTER TABLE `evaluation_to_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_to_activity_student`
--
ALTER TABLE `evaluation_to_activity_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`guardian_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_measurements`
--
ALTER TABLE `student_measurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกิจกรรม', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ดูแลระบบ', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการลงเวลา', AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `director_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้อำนวยการ', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประจำแบบประเมิน', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `evaluation_activity`
--
ALTER TABLE `evaluation_activity`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `evaluation_activity_student`
--
ALTER TABLE `evaluation_activity_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id หลัก', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `evaluation_students`
--
ALTER TABLE `evaluation_students`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประจำแบบประเมิน', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `evaluation_to_activity`
--
ALTER TABLE `evaluation_to_activity`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `evaluation_to_activity_student`
--
ALTER TABLE `evaluation_to_activity_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id หลัก', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `guardian_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ปกครอง', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประจำตัว', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student_measurements`
--
ALTER TABLE `student_measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีหลัก pk', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีครู', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
