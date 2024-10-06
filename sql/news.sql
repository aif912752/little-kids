-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 10:10 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

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
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `details`, `img`) VALUES
(1, 'คนตื่นดวง หรือจะสู้ ฅนตื่นธรรม', 'มาร่วมตีแผ่กระแสที่แรงที่สุดในสังคม กับรายการ #โหนกระแส \r\nเวลา จันทร์-ศุกร์ เวลา 12.35 น. ทางช่อง3HD กดเลข33\r\n', ''),
(2, 'คนตื่นดวง หรือจะสู้ ฅนตื่นธรรม', 'มาร่วมตีแผ่กระแสที่แรงที่สุดในสังคม กับรายการ #โหนกระแส \r\nเวลา จันทร์-ศุกร์ เวลา 12.35 น. ทางช่อง3HD กดเลข33', NULL),
(3, 'คนตื่นดวง หรือจะสู้ ฅนตื่นธรรม', 'มาร่วมตีแผ่กระแสที่แรงที่สุดในสังคม กับรายการ #โหนกระแส \r\nเวลา จันทร์-ศุกร์ เวลา 12.35 น. ทางช่อง3HD กดเลข33', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
