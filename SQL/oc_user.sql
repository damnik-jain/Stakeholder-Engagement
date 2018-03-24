-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2018 at 04:19 AM
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
-- Table structure for table `oc_user`
--

CREATE TABLE `oc_user` (
  `user_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `image` varchar(255) NOT NULL,
  `city` varchar(20) NOT NULL,
  `code` varchar(40) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oc_user`
--

INSERT INTO `oc_user` (`user_id`, `user_group_id`, `username`, `password`, `salt`, `firstname`, `lastname`, `email`, `image`, `city`, `code`, `ip`, `status`, `date_added`) VALUES
(1, 1, 'admin', 'b9f345666cc2af0b201c0c364684ea9eef4caf57', '72Nti0IyI', 'John', 'Doe', 'jaindamnik203@gmail.com', '', 'Mumbai', '', '::1', 1, '2018-03-19 08:35:32'),
(2, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '0000-00-00 00:00:00'),
(3, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '0000-00-00 00:00:00'),
(4, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:16'),
(5, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:16'),
(6, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:44'),
(7, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:44'),
(8, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:44'),
(9, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:44'),
(10, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:44'),
(11, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:44'),
(12, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:44'),
(13, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:44'),
(14, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:44'),
(15, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:44'),
(16, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:45'),
(17, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:45'),
(18, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:45'),
(19, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:45'),
(20, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:45'),
(21, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:45'),
(22, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:45'),
(23, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:47:45'),
(24, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:03'),
(25, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:03'),
(26, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:03'),
(27, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:03'),
(28, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:03'),
(29, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:03'),
(30, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:03'),
(31, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:03'),
(32, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:03'),
(33, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:03'),
(34, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:03'),
(35, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:03'),
(36, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:25'),
(37, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:25'),
(38, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:25'),
(39, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:25'),
(40, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:25'),
(41, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:25'),
(42, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:25'),
(43, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:25'),
(44, 1, 'Damnik', 'damnik', '', 'Damnik', 'Jain', 'jaindamn@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:45'),
(45, 1, 'Shrey', 'Shrey', '', 'Shewy', 'Shry', 'slkjslkfjsja@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-22 21:49:45'),
(46, 1, 'Jatin', 'Jatin', '', 'Jatin', 'Shah', 'jatin@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-08 00:00:00'),
(47, 1, 'Yartik', 'Jain', '', 'Jain', 'Yartik', 'jain@gmail.com', '', 'Mumbai', '', '', 1, '2018-03-16 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_user`
--
ALTER TABLE `oc_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oc_user`
--
ALTER TABLE `oc_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
