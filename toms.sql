-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 03:26 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toms`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `department`) VALUES
(3, 'John Mark', 'Canillo', 'CICTE'),
(4, 'Juan', 'Carlo', 'CICTE');

-- --------------------------------------------------------

--
-- Table structure for table `s_iterinary`
--

CREATE TABLE `s_iterinary` (
  `id` int(10) UNSIGNED NOT NULL,
  `s_tv_id` int(10) UNSIGNED NOT NULL,
  `placetovisit` varchar(50) NOT NULL,
  `departure` varchar(50) NOT NULL,
  `arrival` varchar(50) NOT NULL,
  `meansoftrans` varchar(50) NOT NULL,
  `transallowed` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_iterinary`
--

INSERT INTO `s_iterinary` (`id`, `s_tv_id`, `placetovisit`, `departure`, `arrival`, `meansoftrans`, `transallowed`, `total`) VALUES
(5, 1, 'To Bacolod Terminal', '6:30 AM', '9:30 AM', 'Bus', '150.00', '150.00');

-- --------------------------------------------------------

--
-- Table structure for table `s_travel_order`
--

CREATE TABLE `s_travel_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `destination` varchar(50) DEFAULT NULL,
  `departure` date DEFAULT NULL,
  `dreturn` date DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `diem` decimal(10,0) UNSIGNED DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_travel_order`
--

INSERT INTO `s_travel_order` (`id`, `student_id`, `destination`, `departure`, `dreturn`, `purpose`, `status`, `created_at`, `diem`, `remarks`, `total`) VALUES
(1, 3, 'Bacolod', '2019-11-24', '2019-11-28', 'purpose', 'Approved', '2019-11-24 08:18:00', '500', 'no remarks', '650.00'),
(4, 4, 'Sagay', '2019-11-26', '2019-11-30', 'Attending to school', '', '2019-11-24 05:19:03', '0', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `salutation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `firstname`, `lastname`, `position`, `department`, `middlename`, `salutation`) VALUES
(1, 'Elvin', 'Lucatin', 'Dean', 'CICTE', 'Test', 'PhD'),
(8, 'Gerard', 'Siason', 'Teacher', 'CICTE', 'Sy', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_iterinary`
--

CREATE TABLE `t_iterinary` (
  `id` int(10) UNSIGNED NOT NULL,
  `t_tv_id` int(10) UNSIGNED NOT NULL,
  `placetovisit` varchar(50) NOT NULL,
  `departure` varchar(50) NOT NULL,
  `arrival` varchar(50) NOT NULL,
  `meansoftrans` varchar(50) NOT NULL,
  `transallowed` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_iterinary`
--

INSERT INTO `t_iterinary` (`id`, `t_tv_id`, `placetovisit`, `departure`, `arrival`, `meansoftrans`, `transallowed`, `total`) VALUES
(11, 13, 'To Cadiz Terminal', '6:00 AM', '7:00 AM', 'Tricycle', '50.00', '50.00'),
(12, 13, 'To Bacolod Terminal', '8:00 AM', '11:30 AM', 'Bus', '150.00', '150.00'),
(13, 14, 'To Cadiz Terminal', '6:00 AM', '7:00 AM', 'Van', '500.00', '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `t_travel_order`
--

CREATE TABLE `t_travel_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED DEFAULT NULL,
  `destination` varchar(50) DEFAULT NULL,
  `departure` date DEFAULT NULL,
  `dreturn` date DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `diem` decimal(10,0) UNSIGNED DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_travel_order`
--

INSERT INTO `t_travel_order` (`id`, `teacher_id`, `destination`, `departure`, `dreturn`, `purpose`, `status`, `created_at`, `diem`, `remarks`, `total`) VALUES
(13, 8, 'Bacolod', '2019-11-22', '2019-11-29', 'Board Meeting', 'Approved', '2019-11-24 08:07:44', '500', 'no remarks', '200.00'),
(14, 1, 'Talisay', '2019-11-24', '2019-11-26', 'Presentation at DAR', 'Approved', '2019-11-24 08:20:10', '0', '', '500.00'),
(15, 1, 'Sagay', '2019-11-27', '2019-11-28', '', '', '2019-11-24 08:06:23', '0', '', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `role` varchar(50) DEFAULT '',
  `firstname` varchar(50) DEFAULT '',
  `lastname` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `firstname`, `lastname`) VALUES
(1, 'admin', 'admin', 'Administrator', 'Gerard', 'Siason');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_iterinary`
--
ALTER TABLE `s_iterinary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_tv_id` (`s_tv_id`);

--
-- Indexes for table `s_travel_order`
--
ALTER TABLE `s_travel_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_iterinary`
--
ALTER TABLE `t_iterinary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_tv_id` (`t_tv_id`);

--
-- Indexes for table `t_travel_order`
--
ALTER TABLE `t_travel_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `s_iterinary`
--
ALTER TABLE `s_iterinary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `s_travel_order`
--
ALTER TABLE `s_travel_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_iterinary`
--
ALTER TABLE `t_iterinary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_travel_order`
--
ALTER TABLE `t_travel_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
