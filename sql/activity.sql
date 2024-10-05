-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 06:10 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกิจกรรม', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
