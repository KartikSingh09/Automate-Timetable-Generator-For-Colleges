-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 06:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `admin_name`, `admin_password`, `admin_email`) VALUES
(2211, 'kartik singh', 'abc@1234', 'kartik@gmail.com'),
(3322, 'diya mehta', 'abc@1234', 'diya@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `semester` int(10) NOT NULL,
  `division_counts` int(10) NOT NULL,
  `subj1` varchar(100) NOT NULL,
  `subj2` varchar(100) NOT NULL,
  `subj3` varchar(100) NOT NULL,
  `subj4` varchar(100) NOT NULL,
  `subj5` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `semester`, `division_counts`, `subj1`, `subj2`, `subj3`, `subj4`, `subj5`) VALUES
(1, 'BCA ', 1, 6, 'FOW', 'FOP', 'FOC', 'Maths', 'CS'),
(2, 'BCA', 2, 6, 'Data Structures', 'Operating System', 'PHP', 'Python', 'Project');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_info`
--

CREATE TABLE `faculty_info` (
  `faculty_id` int(10) NOT NULL,
  `faculty_name` varchar(40) NOT NULL,
  `faculty_password` varchar(30) NOT NULL,
  `faculty_email` varchar(40) NOT NULL,
  `faculty_subject` varchar(40) NOT NULL,
  `assigned_division` varchar(40) NOT NULL,
  `assigned_sem` int(11) NOT NULL,
  `assigned_course` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_info`
--

INSERT INTO `faculty_info` (`faculty_id`, `faculty_name`, `faculty_password`, `faculty_email`, `faculty_subject`, `assigned_division`, `assigned_sem`, `assigned_course`) VALUES
(1001, 'Pratibha Agarwal', 'abc@1234', 'pratibha@gmail.com', 'Python', 'A,B,C', 4, 'BCA'),
(1102, 'Kartik', 'abc@1234', 'kartik@gmail.com', 'PHP', 'A,B,C', 5, 'BCA'),
(2233, 'diya', 'abc@1234', 'diya@gmail.com', 'Java', 'A,B,C,D,E', 5, 'IMCA');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `student_id` bigint(100) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `division` varchar(10) NOT NULL,
  `semester` int(10) NOT NULL,
  `course` varchar(10) NOT NULL,
  `student_password` varchar(100) NOT NULL,
  `specialization` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`student_id`, `student_name`, `student_email`, `division`, `semester`, `course`, `student_password`, `specialization`) VALUES
(2205103110004, 'Diya Mehta', 'diya@gmail.com', 'H', 5, 'IMCA', 'abc@1234', 'FSW'),
(2205103140014, 'Kartik Singh', 'kartik@gmail.com', 'H', 5, 'IMCA', 'abc@1234', 'CSF ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_info`
--
ALTER TABLE `faculty_info`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
