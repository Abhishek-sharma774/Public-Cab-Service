-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 10:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `liftup`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `username` varchar(80) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$XPlaUytO7YlJDfdocxLr8uDgB9Hc3d.ZH60w/KA7KX5ihnzdjt60G');

-- --------------------------------------------------------

--
-- Table structure for table `a_driver_login`
--

CREATE TABLE `a_driver_login` (
  `id` int(11) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `a_driver_login`
--

INSERT INTO `a_driver_login` (`id`, `username`, `password`, `at`) VALUES
(1, '7302464646', '$2y$10$XP.fm5icRpLa2pThud9Bw.XyW7MtC/g1x34jtF69ASu05N4mZLpwS', '0000-00-00 00:00:00'),
(2, '9898989898', '$2y$10$A76hresvhsAOyIfPxUmxueIF65TOf7bf6Z2uzwXoQuXppxQjvDZBq', '0000-00-00 00:00:00'),
(3, '1234567899', '$2y$10$bN3ei.f6XTcja2sp8qfOY.R6uIz.i4TbLEJrl6eSpsBwz8o0yae3.', '0000-00-00 00:00:00'),
(4, '8393937817', '$2y$10$.cKABw037P3hfSMxBT0v5ubJeqghl3Ru2SzGLN5CpTdajQUAKqz6a', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `a_user_login`
--

CREATE TABLE `a_user_login` (
  `id` int(11) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `a_user_login`
--

INSERT INTO `a_user_login` (`id`, `username`, `password`, `at`) VALUES
(1, '8393937817', '$2y$10$WuP/ExUoLm3ZvNGUyeeRXeWMSHJnhtCn.DcfTfyPr96zp84HHMOpy', '2023-05-10 11:02:20'),
(2, '7983875643', '$2y$10$ikEzdGYoyEPeateHkF9RoOc1zYUZlQrOuQRTSYseIB2g290viandm', '2023-05-20 08:58:31'),
(3, '8989898989', '$2y$10$b3MLL30YnBy.lnpC.hS2PuFkclPimBIW9kwxBjCWn/SJLUiF7RSiu', '2023-05-22 14:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `driver_details`
--

CREATE TABLE `driver_details` (
  `id` int(11) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dl_no` varchar(80) DEFAULT NULL,
  `vehicle_no` varchar(50) DEFAULT NULL,
  `at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver_details`
--

INSERT INTO `driver_details` (`id`, `name`, `mobile`, `email`, `gender`, `dl_no`, `vehicle_no`, `at`) VALUES
(1, 'akshit', '7302464646', 'akshit@gmail.com', 'Male', 'A67C45', 'up37ap4546', '2023-05-10 11:06:55'),
(2, 'priyanshi yadav', '9898989898', 'priyanshi.34070@tmu.ac.in', 'Female', 'A56368D', 'UP22at5463', '2023-05-10 11:08:42'),
(3, 'arun', '1234567899', 'vanshu1@yopmail.com', 'Male', 'up22hjasdf', 'dafjhkjadf', '2023-05-20 09:03:57'),
(4, 'Abhishek Sharma', '8393937817', 'abhishekji774@gmail.com', 'Male', 'up22hjasdf', 'dafjhkjadf', '2023-05-22 14:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `driver_routes`
--

CREATE TABLE `driver_routes` (
  `id` int(11) NOT NULL,
  `driver_id` varchar(15) DEFAULT NULL,
  `seats` varchar(10) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `source_latitude` varchar(80) DEFAULT NULL,
  `source_longitude` varchar(80) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `destination_latitude` varchar(80) DEFAULT NULL,
  `destination_longitude` varchar(80) DEFAULT NULL,
  `at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver_routes`
--

INSERT INTO `driver_routes` (`id`, `driver_id`, `seats`, `source`, `source_latitude`, `source_longitude`, `destination`, `destination_latitude`, `destination_longitude`, `at`) VALUES
(1, '8393937817', '0', 'Delhi, India', '28.7040592', '77.10249019999999', 'Rampur, Uttar Pradesh, India', '28.798299', '79.02202869999999', '2023-05-22 14:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `name`, `mobile`, `email`, `gender`, `at`) VALUES
(1, 'Abhishek Sharma', '8393937817', 'abhishekkji774@gmail.com', 'Male', '2023-05-10 11:02:20'),
(2, 'DEEPAK KUMAR', '7983875643', 'dk.ceh2018@gmail.com', 'Male', '2023-05-20 08:58:31'),
(3, 'priyanshi', '8989898989', 'priyanshi123@gmail.com', 'Female', '2023-05-22 14:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_ride`
--

CREATE TABLE `user_ride` (
  `id` int(11) NOT NULL,
  `user_id` varchar(15) DEFAULT NULL,
  `driver_id` varchar(15) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `source_latitude` varchar(80) DEFAULT NULL,
  `source_longitude` varchar(80) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `destination_latitude` varchar(80) DEFAULT NULL,
  `destination_longitude` varchar(80) DEFAULT NULL,
  `ride_status` varchar(50) DEFAULT NULL,
  `at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_ride`
--

INSERT INTO `user_ride` (`id`, `user_id`, `driver_id`, `source`, `source_latitude`, `source_longitude`, `destination`, `destination_latitude`, `destination_longitude`, `ride_status`, `at`) VALUES
(1, '8989898989', '8393937817', 'Hapur, Uttar Pradesh, India', '28.73057979999999', '77.7758825', 'Rampur, Uttar Pradesh, India', '28.798299', '79.02202869999999', 'Confirmed', '2023-05-22 14:04:57'),
(2, '8989898989', '8393937817', 'Hapur, Uttar Pradesh, India', '28.73057979999999', '77.7758825', 'Rampur, Uttar Pradesh, India', '28.798299', '79.02202869999999', 'Confirmed', '2023-05-22 14:05:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_driver_login`
--
ALTER TABLE `a_driver_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_user_login`
--
ALTER TABLE `a_user_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_details`
--
ALTER TABLE `driver_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_routes`
--
ALTER TABLE `driver_routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_ride`
--
ALTER TABLE `user_ride`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `a_driver_login`
--
ALTER TABLE `a_driver_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `a_user_login`
--
ALTER TABLE `a_user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `driver_details`
--
ALTER TABLE `driver_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `driver_routes`
--
ALTER TABLE `driver_routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_ride`
--
ALTER TABLE `user_ride`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
