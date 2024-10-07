-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 03:17 PM
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
(5, '', 'ปัญญา', 'จิตใจดี', '2024-10-23', 'warunyoo084@gmail.com', '848091046', 'ผู้อำนวยการ', 33);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`director_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `director_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้อำนวยการ', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
