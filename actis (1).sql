-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2018 at 04:15 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `actis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `fullname`, `username`, `password`) VALUES
(1, 'adminName01', 'admin01', ''),
(2, 'adminName02', 'admin02', 'adminn02'),
(3, 'Zel', '', ''),
(4, 'Gohan', '', ''),
(5, 'Guko', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `is_saved` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `schoolyear_id`, `is_saved`) VALUES
(1, 'English', 3, 0),
(2, 'Math', 1, 0),
(3, 'Science', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `examinee`
--

CREATE TABLE `examinee` (
  `examinee_id` int(11) NOT NULL,
  `ornum` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `lastschool` varchar(255) NOT NULL,
  `is_taken` tinyint(4) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examinee`
--

INSERT INTO `examinee` (`examinee_id`, `ornum`, `fullname`, `lastschool`, `is_taken`, `code`) VALUES
(1, '123', 'Juan Dela Cruz', 'Basak', 0, '9Dh3A'),
(2, '1234', 'Cardo Dalisay', 'Basak', 0, 'U8IQ9'),
(3, '123456', 'San Gohan', 'Abellana', 0, 'bhWB4');

-- --------------------------------------------------------

--
-- Table structure for table `examinee_category_taken`
--

CREATE TABLE `examinee_category_taken` (
  `ect_taken_id` int(11) NOT NULL,
  `examinee_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `examinee_question_answer`
--

CREATE TABLE `examinee_question_answer` (
  `eqa_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `examinee_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `choice_a` varchar(255) NOT NULL,
  `choice_b` varchar(255) NOT NULL,
  `choice_c` varchar(255) NOT NULL,
  `choice_d` varchar(255) NOT NULL,
  `answer` varchar(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `schoolyear_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `question`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `answer`, `category_id`, `schoolyear_id`) VALUES
(1, 'question1', 'wrong1', 'correct', 'wrong2', 'wrong3', 'b', 3, 2),
(2, 'question2', 'wrong1', 'wrong2', 'correct', 'wrong3', 'c', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `dateofsched` date NOT NULL,
  `schoolyear_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schoolyear`
--

CREATE TABLE `schoolyear` (
  `schoolyear_id` int(11) NOT NULL,
  `schoolyear` varchar(20) NOT NULL,
  `iscurrent` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolyear`
--

INSERT INTO `schoolyear` (`schoolyear_id`, `schoolyear`, `iscurrent`) VALUES
(1, '2018-2019', 0),
(2, '2020-2021', 0),
(3, '2019-2020', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `examinee`
--
ALTER TABLE `examinee`
  ADD PRIMARY KEY (`examinee_id`),
  ADD UNIQUE KEY `ornum` (`ornum`);

--
-- Indexes for table `examinee_category_taken`
--
ALTER TABLE `examinee_category_taken`
  ADD PRIMARY KEY (`ect_taken_id`);

--
-- Indexes for table `examinee_question_answer`
--
ALTER TABLE `examinee_question_answer`
  ADD PRIMARY KEY (`eqa_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `schoolyear`
--
ALTER TABLE `schoolyear`
  ADD PRIMARY KEY (`schoolyear_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `examinee`
--
ALTER TABLE `examinee`
  MODIFY `examinee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `examinee_category_taken`
--
ALTER TABLE `examinee_category_taken`
  MODIFY `ect_taken_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examinee_question_answer`
--
ALTER TABLE `examinee_question_answer`
  MODIFY `eqa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schoolyear`
--
ALTER TABLE `schoolyear`
  MODIFY `schoolyear_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
