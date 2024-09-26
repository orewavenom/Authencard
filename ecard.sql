-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 12:28 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecard`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `sirname` varchar(30) NOT NULL,
  `mtitle` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `password` varchar(90) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `firstname`, `sirname`, `mtitle`, `phone`, `password`, `email`) VALUES
(1, 'Ajay', 'Chauhan', 'Mr', '9619527226', 'e10adc3949ba59abbe56e057f20f883e', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `type` varchar(30) NOT NULL,
  `size` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `title`, `name`, `type`, `size`) VALUES
(1, 'Staff', 'staff.csv', 'application/vnd.ms-excel', '76');

-- --------------------------------------------------------

--
-- Table structure for table `inorg`
--

CREATE TABLE `inorg` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(300) NOT NULL,
  `year` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inorg`
--

INSERT INTO `inorg` (`id`, `name`, `phone`, `email`, `website`, `year`) VALUES
(1, 'Vidyalankar Polytechnic', '1234567890', 'swami@ves.ac.in', 'https://vpt.edu.in/', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `profilepictures`
--

CREATE TABLE `profilepictures` (
  `id` int(11) NOT NULL,
  `ids` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `type` varchar(30) NOT NULL,
  `Size` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profilepictures`
--

INSERT INTO `profilepictures` (`id`, `ids`, `category`, `name`, `type`, `Size`) VALUES
(1, '1', 'Administrator', 'adsad.jpg', ' image/jpeg', '192392');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `phone`, `email`, `created`) VALUES
(4, 'safjdasjh@gajh', '21251156', 'safjdasjh@gajh', '18/05/2021 16:51:18PM'),
(5, 'Deepak', '9702043716', 'Deepak@gmail.com', '18/05/2021 18:05:09PM');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `namev` varchar(100) NOT NULL,
  `emailv` varchar(100) NOT NULL,
  `phonev` varchar(10) NOT NULL,
  `profile` varchar(20) NOT NULL,
  `expiry` varchar(30) NOT NULL,
  `seo_url` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `name`, `email`, `phone`, `namev`, `emailv`, `phonev`, `profile`, `expiry`, `seo_url`, `status`, `created`) VALUES
(1, 'asdasd', 'asd@sadasd', '1324568790', '4', 'asdas@sadasd', '1234568790', 'asdasdasd', 'asdasdasd', 'asdasdasd', 1, 'asdasdasd'),
(6, 'Deepak Chauhan', 'deepak@gmail.com', '9702043716', '5', 'ajay@gmail.com', '9619527226', 'Deepak ChauhanRJXTJE', '16/05/2021 3:33:38PM', 'N95GBD3238', 1, '16/05/2021 15:35:10PM'),
(8, 'Deepak', 'Deepak@hfgsdjf.com', '54564345', '4', 'ksjfjks@dkj', '35453546', '5Y4M79VSG0.png', '17/05/2021 4:23:24PM', 'PEBZ8Y6KNG', 1, '16/05/2021 16:24:37PM'),
(9, 'Bhaskar', 'Bhaskar@Bhaskar', '5616541656', '5', 'Deepak@gmail.com', '9702043716', 'EASP7E9LTY.png', '19/05/2021 2:41:01PM', 'GKO3TSZP6Y', 1, '19/05/2021 14:41:32PM'),
(11, 'TEST', 'ajayjullesh134@gmail.com', '1234569870', '5', 'Deepak@gmail.com', '9702043716', 'T04GP8J7V9.png', '19/05/2021 3:43:27PM', 'KDUUQ61MKM', 1, '19/05/2021 15:43:36PM'),
(12, 'test', 'asdas@asdasd.com', '1234567890', '5', 'Deepak@gmail.com', '9702043716', 'AT41AG28OO.png', '19/05/2021 3:51:45PM', 'BT5QP7HN7Z', 1, '19/05/2021 15:52:05PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inorg`
--
ALTER TABLE `inorg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profilepictures`
--
ALTER TABLE `profilepictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inorg`
--
ALTER TABLE `inorg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profilepictures`
--
ALTER TABLE `profilepictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
