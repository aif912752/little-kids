-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 10:50 AM
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
-- Indexes for dumped tables
--

--
-- Indexes for table `student_measurements`
--
ALTER TABLE `student_measurements`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_measurements`
--
ALTER TABLE `student_measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีหลัก pk';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
