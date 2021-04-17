-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2021 at 12:09 AM
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
  `university_name` varchar(30) NOT NULL,
  `rso_name` varchar(30) NOT NULL,
  `rso_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`rso_id`, `university_name`, `rso_name`, `rso_password`) VALUES
(3, 'UCF', 'Hack UCF', 'hack'),
(4, 'MIT', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `location_name` varchar(50) DEFAULT NULL,
  `event_name` varchar(50) NOT NULL,
  `date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `event_description` text NOT NULL,
  `event_type` set('Public','Private_Uni','Private_RSO','') NOT NULL,
  `rso_name` varchar(30) NOT NULL,
  `university_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `location_name`, `event_name`, `date`, `start_time`, `end_time`, `event_description`, `event_type`, `rso_name`, `university_name`) VALUES
(11, 'UCF Main Campus', 'Hacking Seminar', '2021-04-18', '15:00:00', '16:30:00', 'This will be a short presentation about the fundamentals of hacking.', 'Public', 'Hack UCF', 'UCF'),
(12, 'UCF Main Campus', 'Registration for club', '2021-04-18', '16:00:00', '17:00:00', 'This will be a seminar to register for Hack UCF.', 'Public', 'Hack UCF', 'UCF'),
(13, 'MIT Main Campus', 'Random stuff part 2', '2021-04-20', '15:30:00', '16:30:00', 'testing the conflicting event times', 'Public', 'test', 'MIT'),
(14, 'MIT Main Campus', 'Registration for club', '2021-04-20', '16:31:00', '17:30:00', 'This will be a seminar to register for Hack MIT.', 'Public', 'Hack MIT', 'MIT'),
(15, 'UCF Main Campus', 'Random stuff', '2021-05-07', '17:00:00', '18:30:00', 'We dont know what this is.', 'Private_Uni', 'Hack UCF', 'UCF'),
(16, 'MIT Main Campus', 'Registration for club', '2021-04-30', '15:00:00', '18:00:00', 'This will be a seminar to register for Hack MIT.', 'Private_RSO', 'test', 'MIT');

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
  `rso_id` int(11) NOT NULL,
  `university_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `student_username`, `student_password`, `rso_name`, `rso_id`, `university_name`) VALUES
(1, '', 'yo12345', 'testing2', 'Hack UCF', 0, ''),
(2, '', 'yosemiteyoserph', '1234', 'test', 0, 'UCF'),
(3, '', 'ha1234', 'testing', '', 0, '');

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
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
