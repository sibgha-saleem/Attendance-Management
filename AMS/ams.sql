-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2023 at 09:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `dp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `name`, `email`, `password`, `dp`) VALUES
(5, 'Ayesha123', 'Ayesha Ahmad', 'ayesha123@gmail.com', '$2y$10$Ab07OWMfffieZGDTtjQEKeVV3RLz5GOOQe1ohP5OpD6gWrWQd5O9C', 'uploads/227117688a31648d4d9e46e7a089cbe21380ca5f6.webp'),
(8, 'Sibgha199', 'Sibgha Saleem', 'sibgha1999@gmail.com', '$2y$10$LbL6pCfPJJh4INGEgJohMeJh6/PemiuzgnWP5A5WIGdgz6Is5TfUu', 'uploads/15969728695bb9758ac2751d431ef1572e0b07dd71.jpg'),
(9, 'Hadia123', 'Hadia Zahid', 'hadia123@gmail.com', '$2y$10$FSs9UidMIEqPSYihbhKCU.Ex9WM9bp5a5U3R9PGMycqBw69Z.vzSK', 'uploads/988916011maxresdefault.jpg'),
(10, 'admin', 'admin', 'admin123@gmail.com', '$2y$10$tCnDk5kldlCpKi4.alcqWO7Eu6zZDPgTJQRz1WR3KgNSxTiMiTqMS', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `marked` varchar(100) NOT NULL,
  `day` int(10) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `text` varchar(400) NOT NULL,
  `status` varchar(100) NOT NULL,
  `score` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `username`, `marked`, `day`, `reason`, `text`, `status`, `score`) VALUES
(4, 'Ayesha123', 'Leave', 2, 'ggv', '         fgwgrgwwwwwwwwww', 'Approve', 1),
(7, 'Sibgha199', 'Present', 2, '', '', '', 1),
(8, 'Hadia123', 'Absent', 2, '', '', '', 0),
(12, 'Amna123', 'Absent', 2, '', '', '', 0),
(13, 'Ayesha123', 'Present', 1, '', '', '', 1),
(14, 'Sibgha199', 'Absent', 1, '', '', '', 0),
(15, 'Hadia123', 'Present', 1, '', '', '', 1),
(17, 'Ayesha123', 'Present', 3, '', '', '', 1),
(18, 'Sibgha199', 'Leave', 3, 'hcjvjje', 'fehbfjhwsfgyjgebjygfjebjfysefsefsef', 'Pending', 0),
(19, 'Hadia123', 'Present', 3, '', '', '', 1),
(20, 'Amna123', 'Present', 3, '', '', '', 1),
(21, 'Ayesha123', 'Absent', 4, '', '', '', 0),
(22, 'Sibgha199', 'Present', 4, '', '', '', 1),
(23, 'Hadia123', 'Present', 4, '', '', '', 1),
(24, 'Amna123', 'Present', 4, '', '', '', 1),
(25, 'Ayesha123', 'Present', 5, '', '', '', 1),
(27, 'Hadia123', 'Leave', 5, 'echabjabjab', 'ahwdjgavdjgavwgdvahwvdhagwvdhvaw', 'Approve', 1),
(28, 'Amna123', 'Present', 5, '', '', '', 1),
(29, 'Sibgha199', 'Leave', 5, 'ggv', '         wegsegsegsggsegsxesg', 'Pending', 0),
(31, 'Ayesha123', 'Absent', 6, '', '', '', 0),
(32, 'Sibgha199', 'Absent', 6, '', '', '', 0),
(33, 'Hadia123', 'Absent', 6, '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `score` int(100) NOT NULL,
  `grades` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `username`, `score`, `grades`) VALUES
(3, 'Ayesha123', 4, 'D'),
(4, 'Sibgha199', 2, 'D'),
(9, 'Hadia123', 4, 'D'),
(13, 'Amna123', 3, 'F'),
(15, 'abcd', 0, 'F');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
