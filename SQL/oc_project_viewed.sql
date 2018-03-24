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
-- Table structure for table `oc_project_viewed`
--

CREATE TABLE `oc_project_viewed` (
  `view_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oc_project_viewed`
--

INSERT INTO `oc_project_viewed` (`view_id`, `user_id`, `time`, `project_id`) VALUES
(5, 32, '2018-03-21 18:05:52', 1),
(6, 32, '2018-03-11 18:05:52', 1),
(8, 32, '2018-03-11 18:05:52', 2),
(10, 32, '2018-03-13 18:05:52', 1),
(11, 32, '2018-03-21 18:05:52', 1),
(13, 32, '2018-03-16 18:05:52', 1),
(14, 32, '2018-03-21 18:05:52', 1),
(17, 32, '2018-03-17 18:05:52', 1),
(19, 32, '2018-03-21 18:05:52', 2),
(20, 32, '2018-03-14 18:05:52', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_project_viewed`
--
ALTER TABLE `oc_project_viewed`
  ADD PRIMARY KEY (`view_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_grade_id` (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oc_project_viewed`
--
ALTER TABLE `oc_project_viewed`
  MODIFY `view_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
