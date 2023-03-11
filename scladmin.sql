-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2021 at 06:14 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scladmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(20) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `joindate` varchar(25) NOT NULL,
  `resigndate` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `hobbies` varchar(60) NOT NULL,
  `type` int(11) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `gender`, `dob`, `qualification`, `joindate`, `resigndate`, `address`, `pic`, `hobbies`, `type`, `createdon`) VALUES
(1, '', 'admin@gmail.com', '12345', '', '', '', '', '', '', '', '', 1, '2021-08-18 07:01:54'),
(2, 'Tirraj Sharma', 'tirraj@gmail.com', '12345', '1', '1990-07-18', 'Bed,Med', '2021-07-14', '', '45,Shanti Nagar,Indore', '1629376871Koala.jpg', '', 2, '2021-08-19 12:41:11'),
(4, 'Sureshi', 'sureshi@gmail.com', '5432', '0', '2021-08-18', 'Bed,Med adffafdfffuuuu', '2021-08-20', '2021-08-20', '1200000000,Kalani Nagar,Indore', '1629380024Desert.jpg', 'Swimming', 2, '2021-08-19 13:33:44'),
(10, 'kishore kumar', 'kishore@gmail.com', '12345', '1', '1992-05-13', 'Msc', '2021-08-19', '', 'Indore', '1629380318Penguins.jpg', 'Others', 2, '2021-08-19 13:38:38'),
(11, 'harshita', 'harshita@gmail.com', 'Harshita@456', '0', '1992-06-10', 'Med,Phd', '2021-07-14', '', '47,Kalani Nagar Indore', '1629432753Desert.jpg', 'Volleyball,Swimming', 2, '2021-08-20 04:12:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
