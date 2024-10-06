-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 11:18 AM
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
(3, 0, 'ฟหกฟหกฟหก', 'กกกกก', 'ฟหกฟหก', '2024-10-23 20:46:00', '2024-10-25 20:46:00'),
(4, 0, 'ตีไก่', 'นวล', 'ไปเที่ยวกัน', '2024-10-13', '2024-10-12'),
(6, 0, 'ตีไก่', 'ไอ่นนท์', 'หกด', '2024-10-15', '2024-10-15');

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
(1, 'ไอ่นนท์', 'กาย', 'ผู้ดูแลระบบ', 'ไอ่นนท์', 'warunyoo084@gmail.com', 'ไอ่นนท์', '2024-10-16', 'ไอ่นนท์', 'ไอ่นนท์', 'ไอ่นนท์', 'กาย', 26);

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
(28, 19, 'นวล', '123456789', '2024-10-06', '', '', 'มา'),
(30, 20, 'กิจกรรมนัทนาการtest1', 'intarathaiwong', '2024-10-06', 'โดยต่อย', '', 'ขาด');

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
  `phone_number` varchar(50) NOT NULL COMMENT 'เบอร์โทรผู้อำนวยการ',
  `position` varchar(100) NOT NULL COMMENT 'ตำเเหน่งผู้อำนวยการ',
  `user_id` int(11) NOT NULL COMMENT 'เป็นrefไอดีที่มาจากuser	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`director_id`, `Img`, `first_name`, `last_name`, `birthdate`, `email`, `phone_number`, `position`, `user_id`) VALUES
(1, '', 'กาย', 'กาย', '2024-10-11', 'warunyoo084@gmail.com', '848091046', 'ครูใหญ่', 20),
(2, '', 'กาย', 'กาย', '2024-10-18', 'warunyoo084@gmail.com', '848091046', 'ไอ่นนท์', 27);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `evaluation_id` int(11) NOT NULL COMMENT 'รหัสประจำแบบประเมิน',
  `evaluation_name` varchar(255) NOT NULL COMMENT 'หัวแบบฟอร์ม',
  `score` varchar(3) NOT NULL COMMENT 'คะเเนนเก็บเป็น string',
  `evaluation_date` date NOT NULL COMMENT 'วันที่ทำการประเมิน',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`evaluation_id`, `evaluation_name`, `score`, `evaluation_date`, `created_at`, `updated_at`) VALUES
(4, 'กิจกรรมนัทนาการ', '', '0000-00-00', '2024-10-06 05:37:50', '2024-10-06 05:37:50'),
(5, 'กิจกรรมนัทนาการtest1', '', '0000-00-00', '2024-10-06 05:46:22', '2024-10-06 05:46:22');

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
(1, '4', 'กาย', '0');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_to_activity`
--

CREATE TABLE `evaluation_to_activity` (
  `id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL COMMENT 'อ้างอิงจากรหัสประเมิน อ้างอิงมาจาก table evaluation ',
  `evaluation_activity_id` varchar(50) NOT NULL COMMENT 'อ้างอิงจากรหัสกิจกรรมประเมินจาก table evaluation_activity ',
  `total_score` varchar(50) NOT NULL COMMENT 'คะเเนนรวม ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(1, '', 'กิจกรรมนัทนาการtest1', 'กิจกรรมนัทนาการtest1', 'กิจกรรมนัทนาการ', 'Male', 'กดหกดหกดหกด', 'กิจกรรมนัทนาการtest1', 20, 32, '');

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
(1, 'อนุบาล 2', '2024-10-05 18:12:33', '2024-10-05 18:12:33'),
(2, 'อนุบาล 3', '2024-10-06 07:03:31', '2024-10-06 07:03:31');

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

INSERT INTO `students` (`student_id`, `img`, `first_name`, `last_name`, `birthdate`, `ethnicity`, `nationality`, `religion`, `gender`, `citizen_id`, `enrollment_date`, `status`, `user_id`, `guardians_id`, `room_id`, `student_height`, `student_weight`) VALUES
(17, '670145d5111e2-1.png', 'กาย', 'กาย', '2024-10-25', '', '', 'กาย', 'Male', '123465', '0000-00-00', 'Active', 24, '', '', '', ''),
(18, '67017e0985bc4-1.jpg', 'กหกฟหกฟหก', '', '0000-00-00', 'ไทย', 'ไทย', 'ไทย', 'Male', '150000', '2024-08-01', 'Active', 25, '', '', '', ''),
(19, '6701979a22c77-1.jpg', 'นวล', '123456789', '0000-00-00', '', '', 'ไทย', 'Male', '15000', '2024-10-22', 'Inactive', 30, '', '1', '', ''),
(20, '', 'กิจกรรมนัทนาการtest1', 'intarathaiwong', '2024-10-14', 'กิจกรรมนัทนาการtest1', 'กิจกรรมนัทนาการtest1', 'กิจกรรมนัทนาการtest1', 'Male', 'กิจกรรมนัทน', '2024-10-18', 'Inactive', 31, '', '2', '150', '20');

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
(1, '18', 50.50, 175.60, '2024-10-06 09:10:54'),
(2, '17', 150.20, 18.30, '2024-10-06 09:12:41'),
(3, '19', 42.00, 456.00, '2024-10-06 09:13:57'),
(4, '19', 150.00, 33.00, '2024-10-06 09:16:09'),
(5, '17', 50.00, 175.00, '2024-10-06 09:17:29');

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
  `phone_number` varchar(50) NOT NULL COMMENT 'เบอร์โทรครู',
  `teacher_address` varchar(255) NOT NULL COMMENT 'ที่อยู่ครู',
  `room_id` varchar(50) NOT NULL COMMENT 'ชั้นที่สอน',
  `user_id` int(11) NOT NULL COMMENT 'เป็นrefไอดีที่มาจากuser'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `img`, `first_name`, `last_name`, `position`, `email`, `ethnicity`, `nationality`, `religion`, `citizen_id`, `birthdate`, `phone_number`, `teacher_address`, `room_id`, `user_id`) VALUES
(1, '', 'กาย', 'กาย', 'กาย', 'กาย', 'กาย', 'กาย', 'กาย', 0, '0000-00-00', '0', '', '1', 3),
(2, '', 'กกกกก', 'asdasdasd', 'กกกกก', 'warunyoo084@gmail.com', 'กกกกก', 'กกกกก', 'กกกกก', 0, '2024-10-17', '0', 'asdasdas', '1', 28),
(3, '67019789ee59c-1.jpg', 'supapit', 'intarathaiwong', 'ครูใหญ่', 'warunyoo084@gmail.com', 'asd', 'กาย', 'กาย', 1515151515, '2024-10-16', '0848091046', 'asdasd', '1', 29);

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
(2, 'director', '123456789', 'director1', 2),
(3, 'teacher', '123456789', 'teacher1', 3),
(4, 'ruler', '123456789', 'ruler1', 4),
(5, '', '', 'student1', 5),
(19, '15000', '', 'กาย', 2),
(20, '0848091046', '123456789', 'กาย', 2),
(24, '', '', 'กาย', 5),
(25, '', '', 'กหกฟหกฟหก', 5),
(26, 'dddd', '123456789', 'ไอ่นนท์', 1),
(27, 'test1', '123456789', 'กาย', 2),
(28, 'teacher2', '123456789', 'กกกกก', 3),
(29, 'teacher23', '123456789', 'supapit', 3),
(30, '15000', '', 'นวล', 5),
(31, 'กิจกรรมนัทนาการtest1', 'กิจกรรมนัทนาการtest1', 'กิจกรรมนัทนาการtest1', 5),
(32, '123465789', '123456789', 'กิจกรรมนัทนาการtest1', 4);

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
-- Indexes for table `evaluation_to_activity`
--
ALTER TABLE `evaluation_to_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`guardian_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกิจกรรม', AUTO_INCREMENT=7;

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
  MODIFY `director_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้อำนวยการ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประจำแบบประเมิน', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evaluation_activity`
--
ALTER TABLE `evaluation_activity`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `evaluation_to_activity`
--
ALTER TABLE `evaluation_to_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `guardian_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ปกครอง', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประจำตัว', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student_measurements`
--
ALTER TABLE `student_measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีหลัก pk', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีครู', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
