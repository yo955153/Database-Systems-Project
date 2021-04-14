-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2021 at 11:58 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_events_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `rso_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `rso_name` varchar(30) NOT NULL,
  `rso_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`rso_id`, `university_id`, `rso_name`, `rso_password`) VALUES
(3, 0, 'Hack UCF', 'hack'),
(4, 0, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `event_name` varchar(20) NOT NULL,
  `event_description` text NOT NULL,
  `event_type` set('Public','Private_Uni','Private_RSO','') NOT NULL,
  `rso_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `location_id`, `start_time`, `end_time`, `event_name`, `event_description`, `event_type`, `rso_name`) VALUES
(1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hacking Seminar', 'This will be a short presentation about the fundamentals of hacking.', 'Public', 'Hack UCF'),
(2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Registration for clu', 'This will be a seminar to register for Hack UCF.', 'Private_Uni', 'Hack UCF');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(30) NOT NULL,
  `longitude` point NOT NULL,
  `latitude` point NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `new_super_admin`
--

CREATE TABLE `new_super_admin` (
  `super_admin_id` int(11) NOT NULL,
  `university_name` varchar(30) NOT NULL,
  `university_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `new_super_admin`
--

INSERT INTO `new_super_admin` (`super_admin_id`, `university_name`, `university_password`) VALUES
(1, 'MIT', 'test'),
(2, 'UCF', 'test2'),
(3, 'YOSERPH', 'igger'),
(4, 'MOUDA', 'ibrahimobitch');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(20) NOT NULL,
  `student_username` varchar(20) NOT NULL,
  `student_password` varchar(20) NOT NULL,
  `rso_name` varchar(30) NOT NULL,
  `rso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `student_username`, `student_password`, `rso_name`, `rso_id`) VALUES
(1, '', 'yo12345', 'testing2', '', 0),
(2, '', 'yosemiteyoserph', '1234', '', 0),
(3, '', 'ha1234', 'testing', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `super_admin_id` int(11) NOT NULL,
  `university_name` int(11) NOT NULL,
  `university_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`rso_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `new_super_admin`
--
ALTER TABLE `new_super_admin`
  ADD PRIMARY KEY (`super_admin_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `rso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `new_super_admin`
--
ALTER TABLE `new_super_admin`
  MODIFY `super_admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
