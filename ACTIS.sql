-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2018 at 11:58 AM
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
(1, 'adminName011', 'admin01', 'admin01'),
(2, 'adminName02', 'admin02', 'adminn02'),
(3, 'Zel', 'admin03', 'admin03'),
(4, 'Gohan', 'admin04', 'admin04'),
(5, 'Guko', 'admin05', 'admin05'),
(6, 'batosay gwapo', 'batosay', 'batosay');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `schoolyear_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `schoolyear_id`) VALUES
(1, 'English', 3),
(2, 'Math', 1),
(3, 'Science', 2),
(4, 'English', 2),
(5, 'English', 1),
(6, 'Filipino', 1),
(7, 'Math', 4),
(8, 'Algebra', 4);

-- --------------------------------------------------------

--
-- Table structure for table `examinee`
--

CREATE TABLE `examinee` (
  `examinee_id` int(11) NOT NULL,
  `ornum` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `lastschool` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `is_taken` tinyint(4) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examinee`
--

INSERT INTO `examinee` (`examinee_id`, `ornum`, `fullname`, `lastschool`, `code`, `is_taken`, `status`) VALUES
(1, '123', 'Juan Dela Cruz', 'ACT Bulacao Campus', '9Dh3A', 0, '0'),
(2, '1234', 'Cardo Dalisay II', 'Basak', 'U8IQ9', 0, '0'),
(3, '123456', 'San Gohan', 'Abellana', 'bhWB4', 0, '0'),
(4, '1', 'Ricardo', 'Leon Kilat', 'hPVFt', 0, '0'),
(5, '12', 'Marivin', 'Basak', 'tietY', 1, '1'),
(6, '4', 'Ricardo Dalisay III', 'Abellana', '3N54l', 1, '2');

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

--
-- Dumping data for table `examinee_question_answer`
--

INSERT INTO `examinee_question_answer` (`eqa_id`, `category_id`, `examinee_id`, `question_id`, `answer`) VALUES
(1, 3, 5, 1, 'b'),
(2, 3, 5, 3, 'c'),
(3, 3, 5, 6, 'b'),
(4, 3, 6, 1, 'c'),
(5, 3, 6, 3, 'd'),
(6, 3, 6, 6, 'b'),
(7, 4, 6, 4, 'b'),
(8, 4, 6, 5, 'd');

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
(2, 'question2', 'wrong1', 'wrong2', 'correct', 'wrong3', 'a', 2, 1),
(3, 'science01', 'wrong1', 'wrong2', 'correct', 'wrong3', 'c', 3, 2),
(4, 'english 01', 'wrong1', 'correct', 'wrong2', 'wrong3', 'b', 4, 2),
(5, 'english 02', 'wrong1', 'wrong2', 'wrong3', 'correct', 'd', 4, 2),
(6, 'what is earth', 'tm', 'globe', 'sun', 'smart', 'b', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `dateofsched` date NOT NULL,
  `schoolyear_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `dateofsched`, `schoolyear_id`) VALUES
(1, '2323-12-21', 1),
(2, '2029-09-01', 1),
(3, '2102-12-21', 1),
(4, '2020-12-25', 2),
(5, '2018-09-30', 2),
(6, '2018-10-02', 3);

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
(2, '2020-2021', 1),
(3, '2019-2020', 0),
(4, '2022-2023', 0);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `examinee`
--
ALTER TABLE `examinee`
  MODIFY `examinee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `examinee_category_taken`
--
ALTER TABLE `examinee_category_taken`
  MODIFY `ect_taken_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examinee_question_answer`
--
ALTER TABLE `examinee_question_answer`
  MODIFY `eqa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schoolyear`
--
ALTER TABLE `schoolyear`
  MODIFY `schoolyear_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
