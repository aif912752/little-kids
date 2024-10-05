-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 02:57 PM
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
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `guardian_id` int(11) NOT NULL COMMENT 'รหัสผู้ปกครอง',
  `first_name` varchar(100) NOT NULL COMMENT 'ชื่อของผู้ปกครอง',
  `last_name` varchar(100) NOT NULL COMMENT 'นามสกุลของผู้ปกครอง',
  `phone_number` varchar(15) DEFAULT NULL COMMENT 'หมายเลขโทรศัพท์ของผู้ปกครอง',
  `gender` enum('Male','Female','Other') NOT NULL COMMENT 'เพศของผู้ปกครอง',
  `address` text DEFAULT NULL COMMENT 'ที่อยู่ของผู้ปกครอง',
  `relation_to_student` varchar(50) NOT NULL COMMENT 'ความสัมพันธ์ระหว่างผู้ปกครองกับนักเรียน เช่น พ่อ, แม่, ลุง, ป้า',
  `student_id` int(11) NOT NULL COMMENT 'ชื่อนามสกุลของนักเรียนที่ ref ไปหา',
  `user_id` int(11) NOT NULL COMMENT 'รหัสที่ ref ไปหา user_id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`guardian_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `guardian_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ปกครอง';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
