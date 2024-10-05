-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 07:47 PM
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
  `student_lastname` varchar(255) NOT NULL COMMENT 'ชื่อนักเรียน',
  `attendance_date` date NOT NULL COMMENT 'วันที่ลงเวลา',
  `check_in_time` time NOT NULL COMMENT 'เวลาเข้า',
  `check_out_time` time DEFAULT NULL COMMENT 'เวลาออก',
  `note` varchar(100) NOT NULL COMMENT 'หมายเหตุ',
  `status` enum('normal','absent','leave','late') DEFAULT 'normal' COMMENT 'สถานะการเข้าเรียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `student_name`, `student_lastname`, `attendance_date`, `check_in_time`, `check_out_time`, `note`, `status`) VALUES
(12, 17, 'กาย', 'กาย', '2024-10-05', '10:47:00', '02:49:00', '', 'absent');

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
  `student_id` int(11) NOT NULL COMMENT ' รหัสนักเรียนที่ถูกประเมิน',
  `teacher_id` int(11) NOT NULL COMMENT 'รหัสครูที่ทำการประเมิน',
  `score` varchar(3) NOT NULL COMMENT 'คะเเนนเก็บเป็น string',
  `evaluation_date` date NOT NULL COMMENT 'วันที่ทำการประเมิน',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_activity`
--

CREATE TABLE `evaluation_activity` (
  `id` varchar(50) NOT NULL COMMENT 'ไอดีหลัก pk',
  `activity_id` varchar(50) NOT NULL COMMENT 'เก็บ id มาจาก table evalution',
  `evaluation_name` varchar(255) NOT NULL COMMENT 'ชื่อกิจกรรม',
  `evaluation_type` varchar(255) NOT NULL COMMENT 'ประเภทกิจกรรม'
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
(17, '670145d5111e2-1.png', 'กาย', 'กาย', '2024-10-25', '', '', 'กาย', 'Male', '123465', '0000-00-00', '', 'Active', 24, '', '', '', ''),
(18, '670168f02a3bd-1.jpg', 'กหกฟหกฟหก', '', '0000-00-00', 'ไทย', 'ไทย', 'ไทย', 'Male', '150000', '2024-08-01', 'อนุบาล 5', 'Active', 25, '', '', '', '');

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
(1, '', 'กาย', 'กาย', 'กาย', 'กาย', 'กาย', 'กาย', 'กาย', 0, '0000-00-00', '0', '', '', 3),
(2, '', 'กกกกก', 'asdasdasd', 'กกกกก', 'warunyoo084@gmail.com', 'กกกกก', 'กกกกก', 'กกกกก', 0, '2024-10-17', '0', 'asdasdas', 'กกกกก', 28);

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
(19, '123456', '123456', 'กาย', 2),
(20, '0848091046', '123456789', 'กาย', 2),
(24, '', '', 'กาย', 5),
(25, '', '', 'กหกฟหกฟหก', 5),
(26, 'dddd', '123456789', 'ไอ่นนท์', 1),
(27, 'test1', '123456789', 'กาย', 2),
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
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการลงเวลา', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `director_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้อำนวยการ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประจำแบบประเมิน';

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `guardian_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ปกครอง';

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT;

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
