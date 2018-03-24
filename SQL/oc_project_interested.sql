-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2018 at 12:21 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opencart`
--

-- --------------------------------------------------------

--
-- Table structure for table `oc_project_interested`
--

CREATE TABLE `oc_project_interested` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oc_project_interested`
--

INSERT INTO `oc_project_interested` (`project_id`, `user_id`, `timestamp`) VALUES
(1, 29, '2018-03-11 15:25:07'),
(1, 30, '2018-03-17 15:25:07'),
(1, 31, '2018-03-21 15:25:07'),
(1, 24, '2018-03-15 18:30:00'),
(2, 25, '2018-03-16 18:30:00'),
(2, 22, '2018-03-12 18:30:00'),
(1, 27, '2018-03-13 18:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_project_interested`
--
ALTER TABLE `oc_project_interested`
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
