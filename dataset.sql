-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 10:42 AM
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
-- Database: `bayes_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `steroid` tinyint(1) NOT NULL,
  `anorexia` tinyint(1) NOT NULL,
  `alive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `age`, `steroid`, `anorexia`, `alive`) VALUES
(1, 30, 0, 1, 1),
(2, 50, 0, 1, 1),
(3, 78, 1, 1, 1),
(4, 31, 0, 1, 1),
(5, 34, 1, 1, 1),
(6, 34, 1, 1, 1),
(7, 51, 0, 0, 0),
(8, 23, 1, 1, 1),
(9, 39, 1, 1, 1),
(10, 30, 1, 1, 1),
(11, 39, 0, 1, 1),
(12, 32, 1, 1, 1),
(13, 41, 1, 1, 1),
(14, 30, 1, 1, 1),
(15, 47, 0, 1, 1),
(16, 38, 0, 0, 0),
(17, 66, 1, 1, 1),
(18, 40, 0, 1, 1),
(19, 38, 1, 1, 1),
(20, 38, 0, 1, 1),
(21, 22, 1, 1, 1),
(22, 27, 1, 0, 1),
(23, 31, 1, 1, 1),
(24, 42, 1, 1, 1),
(25, 25, 0, 1, 1),
(26, 27, 0, 1, 1),
(27, 49, 0, 0, 1),
(28, 58, 1, 1, 1),
(29, 61, 0, 1, 1),
(30, 51, 0, 1, 1),
(31, 39, 0, 1, 0),
(32, 62, 0, 1, 0),
(33, 41, 1, 0, 1),
(34, 26, 0, 1, 1),
(35, 35, 1, 1, 1),
(36, 37, 1, 1, 0),
(37, 23, 1, 0, 1),
(38, 20, 0, 0, 1),
(39, 42, 0, 1, 1),
(40, 65, 1, 1, 1),
(41, 52, 0, 1, 1),
(42, 23, 1, 1, 1),
(43, 33, 1, 1, 1),
(44, 56, 0, 1, 1),
(45, 34, 1, 1, 1),
(46, 28, 1, 1, 1),
(47, 37, 0, 1, 1),
(48, 28, 1, 1, 1),
(49, 36, 0, 1, 1),
(50, 38, 1, 0, 1),
(51, 39, 0, 1, 1),
(52, 39, 1, 1, 1),
(53, 44, 1, 1, 1),
(54, 40, 1, 1, 1),
(55, 30, 1, 1, 1),
(56, 37, 0, 0, 1),
(57, 34, 0, 0, 1),
(58, 30, 1, 1, 1),
(59, 64, 1, 1, 1),
(60, 45, 0, 1, 1),
(61, 37, 1, 1, 1),
(62, 32, 1, 1, 1),
(63, 32, 1, 0, 1),
(64, 36, 0, 1, 1),
(65, 49, 1, 1, 1),
(66, 27, 1, 1, 1),
(67, 56, 0, 1, 1),
(68, 57, 1, 0, 0),
(69, 39, 1, 1, 1),
(70, 44, 0, 1, 1),
(71, 24, 1, 1, 1),
(72, 34, 0, 1, 0),
(73, 51, 1, 0, 1),
(74, 36, 0, 0, 1),
(75, 50, 1, 1, 1),
(76, 32, 0, 1, 1),
(77, 58, 1, 1, 0),
(78, 34, 0, 1, 1),
(79, 34, 0, 1, 1),
(80, 28, 1, 1, 1),
(81, 23, 1, 0, 1),
(82, 36, 1, 1, 1),
(83, 30, 0, 1, 1),
(84, 67, 0, 1, 1),
(85, 62, 1, 1, 1),
(86, 28, 0, 0, 1),
(87, 44, 0, 1, 0),
(88, 30, 1, 0, 0),
(89, 38, 0, 0, 0),
(90, 38, 0, 0, 1),
(91, 50, 0, 1, 1),
(92, 42, 0, 0, 0),
(93, 33, 1, 1, 1),
(94, 52, 0, 1, 1),
(95, 59, 0, 1, 0),
(96, 40, 0, 0, 1),
(97, 30, 0, 1, 1),
(98, 44, 0, 1, 1),
(99, 47, 1, 1, 0),
(100, 60, 0, 1, 1),
(101, 48, 0, 1, 0),
(102, 22, 1, 1, 1),
(103, 27, 0, 1, 1),
(104, 51, 0, 0, 1),
(105, 47, 1, 1, 0),
(106, 25, 1, 1, 1),
(107, 35, 0, 1, 0),
(108, 45, 0, 0, 1),
(109, 54, 0, 1, 1),
(110, 33, 0, 1, 0),
(111, 7, 1, 1, 1),
(112, 42, 0, 1, 0),
(113, 52, 0, 1, 1),
(114, 45, 0, 1, 1),
(115, 36, 0, 1, 1),
(116, 69, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
