-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 08:19 AM
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
  `class_taught` varchar(50) NOT NULL COMMENT 'ชั้นที่สอน',
  
  `user_id` int(11) NOT NULL COMMENT 'เป็นrefไอดีที่มาจากuser'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีครู';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
