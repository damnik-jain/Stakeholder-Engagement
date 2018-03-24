-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2018 at 12:19 PM
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
-- Table structure for table `oc_project`
--

CREATE TABLE `oc_project` (
  `project_id` int(11) NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(5000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oc_project`
--

INSERT INTO `oc_project` (`project_id`, `title`, `description`, `department`, `city`, `image`) VALUES
(1, 'Stakeholder Engagement for Urban Planning and Management', 'Indian cities require private sector investments for improvement of infrastructure and services. Can we provide a matchmaking platform for connecting, investors, PPP partners, CSR funds, Technology provider, Research Institutions, Multilateral and Bilateral financing agencies with cities?', 'Ministry of Urban development', 'Smart Bench City', 'https://innovate.mygov.in/wp-content/uploads/2017/10/mygov46562_1507700468.png'),
(2, 'Social Media Sentiment Analysis', 'General problem statement in simple words Government of Telangana use Social Media (Twitter, Facebook etc) to engage with Citizens. A large number of Tweets, Facebook Posts are required to be analyzed to understand the citizen sentiments and key problems. Advanced Social Media Sentiment Analysis with English Local Language Support (Telugu, Hindi) Existing solutions Manual Role of Technology Natural Language Processing Deep Learning, Neural Networks Python, R 6 Source of data Facebook, Twitter APIs 7 Desired outcome Sentiment Analysis with Local Language Support', 'Government of Telangana', 'Hyderabad', 'https://innovate.mygov.in/wp-content/uploads/2017/10/mygov46562_1507700684.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_project`
--
ALTER TABLE `oc_project`
  ADD PRIMARY KEY (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oc_project`
--
ALTER TABLE `oc_project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
