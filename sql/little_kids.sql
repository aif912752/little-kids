-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 01:26 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `user_id`, `activity_type`, `activity_name`, `activity_description`, `activity_date_start`, `activity_date_end`) VALUES
(3, 0, 'ฟหกฟหกฟหก', 'กกกกก', 'ฟหกฟหก', '2024-10-23 20:46:00', '2024-10-25 20:46:00'),
(4, 0, 'ตีไก่', 'นวล', 'ไปเที่ยวกัน', '2024-10-12 20:59:00', '2024-10-12 20:59:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `status` varchar(50) NOT NULL COMMENT 'สถานะการเข้าเรียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `student_name`, `student_lastname`, `attendance_date`, `note`, `status`) VALUES
(35, 17, 'กาย', 'กาย', '2024-10-06', '', 'มา'),
(37, 18, 'กหกฟหกฟหก', '', '2024-10-06', '', 'มา'),
(39, 17, 'กาย', 'กาย', '2024-10-06', '1', 'สาย'),
(40, 17, 'กาย', 'กาย', '2024-10-06', '', 'มา');

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
  `phone_number` int(15) NOT NULL COMMENT 'เบอร์โทรผู้อำนวยการ',
  `position` varchar(100) NOT NULL COMMENT 'ตำเเหน่งผู้อำนวยการ',
  `user_id` int(11) NOT NULL COMMENT 'เป็นrefไอดีที่มาจากuser	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`director_id`, `Img`, `first_name`, `last_name`, `birthdate`, `email`, `phone_number`, `position`, `user_id`) VALUES
(1, '', 'กาย', 'กาย', '2024-10-11', 'warunyoo084@gmail.com', 848091046, 'ครูใหญ่', 2),
(2, '', 'กาย', 'กาย', '2024-10-18', 'warunyoo084@gmail.com', 848091046, 'ไอ่นนท์', 27);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`evaluation_id`, `techer_id`, `evaluation_name`, `score`, `evaluation_date`, `created_at`, `updated_at`) VALUES
(13, 1, '55', '2', '2024-10-06', '2024-10-06 16:55:29', '2024-10-06 16:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_activity`
--

CREATE TABLE `evaluation_activity` (
  `id` int(50) NOT NULL,
  `activity_id` varchar(50) NOT NULL COMMENT 'เก็บ id มาจาก table evalution',
  `evaluation_name` varchar(255) NOT NULL COMMENT 'ชื่อกิจกรรม',
  `evaluation_score` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'คะเเนนประเมินในรูปแบบ JSON' CHECK (json_valid(`evaluation_score`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation_activity`
--

INSERT INTO `evaluation_activity` (`id`, `activity_id`, `evaluation_name`, `evaluation_score`) VALUES
(5, '13', '2', '[{\"text\":\"2\",\"score\":2}]');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_activity_student`
--

CREATE TABLE `evaluation_activity_student` (
  `id` int(11) NOT NULL COMMENT 'id หลัก',
  `activity_id` varchar(50) NOT NULL COMMENT 'เก็บ id มาจาก table evalution',
  `evaluation_name` varchar(255) NOT NULL COMMENT 'ชื่อกิจกรรม',
  `evaluation_score` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'คะเเนนประเมินในรูปแบบ JSON' CHECK (json_valid(`evaluation_score`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation_activity_student`
--

INSERT INTO `evaluation_activity_student` (`id`, `activity_id`, `evaluation_name`, `evaluation_score`) VALUES
(10, '11', '2', '[{\"text\":\"2\",\"score\":\"2\"}]'),
(11, '12', '555+500', '[{\"text\":\"2\",\"score\":\"2\"},{\"text\":\"1\",\"score\":\"2\"}]'),
(12, '13', '11', '[{\"text\":\"3\",\"score\":3},{\"text\":\"23\",\"score\":3}]'),
(13, '13', '23', '[{\"text\":\"2\",\"score\":3},{\"text\":\"3\",\"score\":3}]');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation_students`
--

INSERT INTO `evaluation_students` (`evaluation_id`, `students_id`, `evaluation_name`, `score`, `evaluation_date`, `created_at`, `updated_at`) VALUES
(12, 18, 'หัวข้อ 1 ', '4', '2024-10-06', '2024-10-06 16:59:17', '2024-10-06 16:59:17'),
(13, 17, '11', '12', '2024-10-07', '2024-10-07 06:47:07', '2024-10-07 06:47:07');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation_to_activity`
--

INSERT INTO `evaluation_to_activity` (`id`, `techer_id`, `evaluation_id`, `evaluation_activity_id`, `total_score`, `created_at`, `updated_at`) VALUES
(3, 1, 13, '5', '2', '2024-10-06 16:56:05', '2024-10-06 16:56:05');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`guardian_id`, `img`, `first_name`, `last_name`, `phone_number`, `gender`, `address`, `relation_to_student`, `student_id`, `user_id`, `room_id`) VALUES
(1, '', '3', '3', '0636675523', '', '3', '1', 1, 1, '1');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `details`, `img`, `created_at`) VALUES
(1, 'คนตื่นดวง หรือจะสู้ ฅนตื่นธรรม', 'มาร่วมตีแผ่กระแสที่แรงที่สุดในสังคม กับรายการ #โหนกระแส \r\nเวลา จันทร์-ศุกร์ เวลา 12.35 น. ทางช่อง3HD กดเลข33\r\n', '6702cc336f231-user.png', '2024-10-07 07:31:51'),
(2, 'คนตื่นดวง หรือจะสู้ ฅนตื่นธรรม', 'มาร่วมตีแผ่กระแสที่แรงที่สุดในสังคม กับรายการ #โหนกระแส \r\nเวลา จันทร์-ศุกร์ เวลา 12.35 น. ทางช่อง3HD กดเลข33', '6702cc3b62c90-orderhub.jpg', '2024-10-07 07:31:51'),
(4, '2', '22', '6702c911750b5-user.webp', '2024-10-07 07:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL COMMENT 'ชื่อห้องเรียน',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `created_at`, `updated_at`) VALUES
(1, 'A1', '2024-10-05 18:54:02', '2024-10-05 18:54:02'),
(2, 'A2', '2024-10-05 18:54:13', '2024-10-05 18:54:13');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `img`, `first_name`, `last_name`, `birthdate`, `ethnicity`, `nationality`, `religion`, `gender`, `citizen_id`, `enrollment_date`, `grade_level`, `status`, `user_id`, `guardians_id`, `room_id`, `student_height`, `student_weight`) VALUES
(17, '670145d5111e2-1.png', 'กาย', 'กาย', '2024-10-25', '', '', 'กาย', 'Male', '123465', '0000-00-00', '', 'Active', 24, '', '1', '', ''),
(18, '670168f02a3bd-1.jpg', 'กหกฟหกฟหก', '', '0000-00-00', 'ไทย', 'ไทย', 'ไทย', 'Male', '150000', '2024-08-01', 'อนุบาล 5', 'Active', 25, '', '2', '', '');

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
  `phone_number` int(15) NOT NULL COMMENT 'เบอร์โทรครู',
  `teacher_address` varchar(255) NOT NULL COMMENT 'ที่อยู่ครู',
  `room_id` varchar(50) NOT NULL COMMENT 'ชั้นที่สอน',
  `user_id` int(11) NOT NULL COMMENT 'เป็นrefไอดีที่มาจากuser'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `img`, `first_name`, `last_name`, `position`, `email`, `ethnicity`, `nationality`, `religion`, `citizen_id`, `birthdate`, `phone_number`, `teacher_address`, `room_id`, `user_id`) VALUES
(1, '', 'กาย', 'กาย', 'กาย', 'กาย', 'กาย', 'กาย', 'กาย', 0, '0000-00-00', 0, '', '', 3),
(2, '', 'กกกกก', 'asdasdasd', 'กกกกก', 'warunyoo084@gmail.com', 'กกกกก', 'กกกกก', 'กกกกก', 0, '2024-10-17', 0, 'asdasdas', 'กกกกก', 28);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `role`) VALUES
(1, 'admin', '123456789', 'adminnon', 1),
(2, 'director', '123456789', 'director1', 2),
(3, 'teacher', '123456789', 'teacher1', 3),
(4, 'ruler', '123456789', 'ruler1', 4),
(5, '', '', 'student1', 5),
(19, '123456', '123456', 'กาย', 2),
(20, '0848091046', '123456789', 'กาย', 2),
(24, '', '', 'กาย', 5),
(25, '', '', 'กหกฟหกฟหก', 5),
(26, 'dddd', '123456789', 'ไอ่นนท์', 1),
(27, 'guardians', '123456789', 'กาย', 4),
(28, 'teacher2', '123456789', 'กกกกก', 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกิจกรรม', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ดูแลระบบ', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการลงเวลา', AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `director_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้อำนวยการ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประจำแบบประเมิน', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `evaluation_activity`
--
ALTER TABLE `evaluation_activity`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evaluation_activity_student`
--
ALTER TABLE `evaluation_activity_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id หลัก', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `evaluation_students`
--
ALTER TABLE `evaluation_students`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประจำแบบประเมิน', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `evaluation_to_activity`
--
ALTER TABLE `evaluation_to_activity`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `evaluation_to_activity_student`
--
ALTER TABLE `evaluation_to_activity_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id หลัก', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `guardian_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ปกครอง', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประจำตัว', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีครู', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
