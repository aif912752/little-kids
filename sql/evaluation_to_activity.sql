-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 12:55 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `evaluation_to_activity`
--

INSERT INTO `evaluation_to_activity` (`id`, `techer_id`, `evaluation_id`, `evaluation_activity_id`, `total_score`, `created_at`, `updated_at`) VALUES
(1, 0, 6, '2', '5', '2024-10-06 10:52:24', '2024-10-06 10:52:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluation_to_activity`
--
ALTER TABLE `evaluation_to_activity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evaluation_to_activity`
--
ALTER TABLE `evaluation_to_activity`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
