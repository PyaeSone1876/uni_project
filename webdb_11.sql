-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 04:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `agreement` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `address`, `password`, `department`, `agreement`) VALUES
(1, 'admin', 'admin123@gmail.com', 'no.45,YGN', '123', 'IT Department', 'yes'),
(3, 'admintwo', 'admin345@gmail.com', 'no.45,YGN', '123', 'Student Department', 'yes'),
(6, 'adminthree', 'admin456@gmail.com', 'no21,ygn', '123', 'Customer Service Department', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(5, 'IT Support', 'hello world'),
(6, 'Finance', 'hello world'),
(7, 'Customer Service', 'hello world'),
(8, 'Student Service', 'hello world');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL,
  `uid` int(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `like_count` int(100) NOT NULL,
  `unlike_count` int(100) NOT NULL,
  `date_ment` varchar(255) NOT NULL,
  `post_Anno` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `date_time`
--

CREATE TABLE `date_time` (
  `id` int(11) NOT NULL,
  `closure_date` varchar(255) NOT NULL,
  `final_closuredate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `date_time`
--

INSERT INTO `date_time` (`id`, `closure_date`, `final_closuredate`) VALUES
(1, 'March 18, 2024, 9:34 pm', 'March 18, 2024, 6:34 pm');

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `like_count` int(11) DEFAULT 0,
  `unlike_count` int(11) DEFAULT 0,
  `comment_count` int(11) DEFAULT 0,
  `views` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `year` varchar(255) NOT NULL,
  `Post_Anno` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`id`, `uid`, `username`, `content`, `file`, `like_count`, `unlike_count`, `comment_count`, `views`, `category`, `date_created`, `year`, `Post_Anno`) VALUES
(309, 1, 'admin', 'Hello World!', '', 2, 1, 0, 3, 'IT Support', 'March 4, 2023, 1:18 pm', '2023', 'No'),
(311, 3, 'admintwo', 'Hi!', '', 0, 0, 0, 0, 'Student Service', 'March 4, 2023, 1:20 pm', '2023\r\n', 'No'),
(313, 6, 'adminthree', 'hi', '', 0, 0, 0, 0, 'Customer Service', 'March 4, 2023, 1:22 pm', '2023', 'No'),
(314, 6, 'adminthree', 'hi', '', 0, 0, 0, 0, 'Customer Service', 'March 4, 2024, 1:22 pm', '2024', 'No'),
(315, 26, 'qamanager', 'hi', '', 0, 0, 0, 0, 'Student Service', 'March 4, 2024, 1:25 pm', '2024', 'No'),
(316, 67, 'staffone', 'hi', '', 0, 0, 0, 0, 'IT Support', 'March 4, 2024, 1:26 pm', '2024', 'No'),
(317, 67, 'staffone', 'hello', '', 0, 0, 0, 0, 'IT Support', 'March 4, 2024, 1:26 pm', '2024', 'No'),
(318, 67, 'staffone', 'hey guys!', '', 0, 0, 0, 0, 'IT Support', 'March 4, 2024, 1:26 pm', '2024', 'Yes'),
(319, 1, 'admin', 'hi', '', 0, 0, 0, 0, 'IT Support', 'March 4, 2024, 1:41 pm', '2024', 'No'),
(322, 68, 'stafftwo', 'hi', '', 2, 0, 0, 2, 'Finance', 'March 4, 2024, 2:07 pm', '2024', 'No'),
(324, 67, 'staffone', 'hello', 'New Microsoft Word Document.docx', 0, 0, 0, 2, 'IT Support', 'March 5, 2024, 10:01 am', '2024', 'No'),
(367, 1, 'admin', 'sdsdsd', '', 1, 1, 0, 15, 'IT Support', 'March 8, 2024, 4:28 pm', '2024', 'No'),
(368, 1, 'admin', 'sdsd', '', 0, 0, 0, 0, 'IT Support', 'March 17, 2024, 6:34 pm', '2024', 'No'),
(369, 1, 'admin', 'hi', '', 0, 0, 0, 0, 'IT Support', 'March 17, 2024, 6:34 pm', '2024', 'No'),
(370, 1, 'admin', 'hello world!', '', 0, 0, 0, 0, 'IT Support', 'March 17, 2024, 6:35 pm', '2024', 'No'),
(371, 1, 'admin', 'hello word', 'New Microsoft Word Document.docx', 0, 0, 0, 0, 'IT Support', 'March 17, 2024, 6:36 pm', '2024', 'No'),
(372, 1, 'admin', 'dsdsdsdsd', '', 0, 0, 0, 0, 'IT Support', 'March 17, 2024, 7:48 pm', '2024', 'No'),
(373, 1, 'admin', 'sdsdsdsd', '', 0, 0, 0, 0, 'IT Support', 'March 18, 2024, 3:53 am', '2024', 'No'),
(374, 1, 'admin', 'sdsdsdd', '', 0, 0, 0, 1, 'IT Support', 'March 18, 2024, 3:53 am', '2024', 'No'),
(375, 67, 'staffone', 'hello world!', '', 0, 0, 0, 0, 'IT Support', 'March 18, 2024, 8:07 pm', '2024', 'No'),
(376, 67, 'staffone', 'hahahahhaha', '', 0, 0, 0, 0, 'IT Support', 'March 18, 2024, 8:28 pm', '2024', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `qacoordinator`
--

CREATE TABLE `qacoordinator` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `agreement` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qacoordinator`
--

INSERT INTO `qacoordinator` (`id`, `username`, `email`, `address`, `password`, `department`, `agreement`) VALUES
(1, 'qacoordinator', 'qacoordinator123@gmail.com', 'No.45,YGN', '123', 'IT Department', 'yes'),
(3, 'qacoordinatortwo', 'qacoordinator456@gmail.com', 'No.11,YGN', '123', 'Student Department', 'yes'),
(4, 'qacoordinatortwo', 'qacoordinator777@gmail.com', 'No.11,YGN', '123', 'Finance Department', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `qamanager`
--

CREATE TABLE `qamanager` (
  `id` int(5) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `agreement` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qamanager`
--

INSERT INTO `qamanager` (`id`, `username`, `email`, `address`, `password`, `department`, `agreement`) VALUES
(26, 'qamanager', 'qamanager123@gmail.com', 'no.45,YGN', '123', 'Student Department', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(5) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `agreement` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `username`, `email`, `address`, `password`, `department`, `agreement`) VALUES
(67, 'staffone', 'staff123@gmail.com', 'no.45,YGN', '555', 'IT Department', 'yes'),
(68, 'stafftwo', 'staff345@gmail.com', 'no.45,YGN', '123', 'Finance Department', 'yes'),
(69, 'staffthree', 'staff456@gmail.com', 'no.45,YGN', '123', 'Student Department', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `user_ment_likes`
--

CREATE TABLE `user_ment_likes` (
  `user_id` int(100) NOT NULL,
  `ment_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_ment_unlikes`
--

CREATE TABLE `user_ment_unlikes` (
  `user_id` int(100) NOT NULL,
  `ment_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_post_likes`
--

CREATE TABLE `user_post_likes` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_post_likes`
--

INSERT INTO `user_post_likes` (`user_id`, `post_id`) VALUES
(1, 322),
(67, 367),
(67, 322);

-- --------------------------------------------------------

--
-- Table structure for table `user_post_unlikes`
--

CREATE TABLE `user_post_unlikes` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_post_unlikes`
--

INSERT INTO `user_post_unlikes` (`user_id`, `post_id`) VALUES
(1, 367);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `date_time`
--
ALTER TABLE `date_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qacoordinator`
--
ALTER TABLE `qacoordinator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qamanager`
--
ALTER TABLE `qamanager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `date_time`
--
ALTER TABLE `date_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=377;

--
-- AUTO_INCREMENT for table `qacoordinator`
--
ALTER TABLE `qacoordinator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `qamanager`
--
ALTER TABLE `qamanager`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
