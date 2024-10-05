-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 08:17 PM
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
(19, '', 'นวล', '123456789', '0000-00-00', '', '', 'ไทย', 'Male', '15000', '2024-10-22', 'Inactive', 30, '', '1', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประจำตัว', AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
