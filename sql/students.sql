-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 08:29 AM
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
  `grade_level` varchar(50) NOT NULL COMMENT 'ชั้นที่เรียน',
  `status` enum('Active','Inactive','Graduated') DEFAULT 'Active' COMMENT 'สถาณะนักเรียน',
  `user_id` int(11) NOT NULL COMMENT 'เป็นrefไอดีที่มาจากuser	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `img`, `first_name`, `last_name`, `birthdate`, `ethnicity`, `nationality`, `religion`, `gender`, `citizen_id`, `enrollment_date`, `grade_level`, `status`, `user_id`) VALUES
(1, '', 'supapit', 'intarathaiwong', '2024-10-18', '', 'asd', 'asd', 'Male', '', '0000-00-00', 'asd', '', 6),
(2, '', 'supapit', 'intarathaiwong', '0000-00-00', '', 'asd', 'asd', 'Male', '', '0000-00-00', 'asd', '', 7),
(3, '', 'supapit', 'intarathaiwong', '0000-00-00', '', 'asd', 'asd', 'Male', '1515151515', '0000-00-00', 'asd', '', 8),
(4, '', 'supapit', 'intarathaiwong', '0000-00-00', '', 'asd', 'asd', 'Male', '1515151515', '0000-00-00', 'asd', 'Active', 9),
(5, '', 'supapit', 'intarathaiwong', '0000-00-00', '', 'asd', 'asd', 'Male', '1515151515', '0000-00-00', 'asd', 'Inactive', 10),
(6, '', 'supapit', 'intarathaiwong', '0000-00-00', '', 'asd', 'asd', 'Male', '1515151515', '0000-00-00', 'asd', '', 11);

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
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประจำตัว', AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
