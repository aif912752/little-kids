-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 08:54 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluation_activity`
--
ALTER TABLE `evaluation_activity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evaluation_activity`
--
ALTER TABLE `evaluation_activity`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
