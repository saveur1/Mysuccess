-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2022 at 12:54 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(40) NOT NULL,
  `block_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `block_name`) VALUES
(51, 'senior 2', 'first'),
(53, 'senior 3', 'third'),
(54, 'senior 4', 'ntamba'),
(55, 'senior 5', 'Block 1'),
(57, 'senior 4 MCE', 'Block 3'),
(58, 'senior 4 LFK', 'muhabura'),
(59, 'senior 4 HEG', 'Kalisimbi'),
(60, 'senior 4 MPG', 'block 3'),
(61, 'senior 5 MCE', 'muhabura'),
(62, 'senior 6 MCE', 'Kalisimbi'),
(63, 'senior 6 LFK', 'muhabura'),
(65, 'senior 5 MPG', 'muhabura');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(40) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `marks`) VALUES
(100, 'Mathematics', 100),
(101, 'Computer Science', 100),
(104, 'Enterpreneurship', 70),
(105, 'Economics', 70);

-- --------------------------------------------------------

--
-- Table structure for table `subject_classes`
--

CREATE TABLE `subject_classes` (
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_classes`
--

INSERT INTO `subject_classes` (`subject_id`, `class_id`) VALUES
(100, 50),
(100, 51),
(101, 57),
(105, 59);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fee`
--

CREATE TABLE `tbl_fee` (
  `fee_id` int(11) NOT NULL,
  `fee_term` int(11) NOT NULL,
  `pay_date` date DEFAULT NULL,
  `reg_no` int(11) NOT NULL,
  `amount` decimal(60,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `reg_no` int(11) NOT NULL,
  `student_name` varchar(80) NOT NULL,
  `dateofbirth` varchar(80) NOT NULL,
  `student_ID` varchar(80) DEFAULT NULL,
  `address` varchar(80) NOT NULL,
  `guardianidnumber` varchar(80) DEFAULT NULL,
  `fatherorguardian_name` varchar(80) DEFAULT NULL,
  `phone_number` varchar(80) DEFAULT NULL,
  `admission_date` varchar(80) NOT NULL,
  `image` varchar(80) DEFAULT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`reg_no`, `student_name`, `dateofbirth`, `student_ID`, `address`, `guardianidnumber`, `fatherorguardian_name`, `phone_number`, `admission_date`, `image`, `class_id`) VALUES
(221018, 'Nzambazamariya ignacia', '2022-08-05', '67187416879561', 'kigarama', '78461587943526', 'jean paul', '07913617851', '2022-08-05', '', 58),
(221019, 'Nzambazamariya ignacia', '2022-09-01', '14314462534545443', 'kicukiro', '526527637676764677', 'kambuca', '0785614766', '2022-08-20', '', 55);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(100) NOT NULL,
  `dateofbirth` varchar(80) DEFAULT NULL,
  `qualification` varchar(60) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email_id` varchar(60) DEFAULT NULL,
  `address` varchar(70) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `teacher_image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`teacher_id`, `teacher_name`, `dateofbirth`, `qualification`, `experience`, `phone_number`, `email_id`, `address`, `joining_date`, `teacher_image`) VALUES
(3, 'dasvfgbagar', '2022-08-18', 'fr', 34141, '542326326', 'bikorimana@gmail.com', 'nyamagabe', '2022-08-06', ''),
(4, 'UWAMAHORO Vestine', '2022-07-31', 'diploma', 34, '0785614766', 'saveur@bikorimana.com', 'nyamirambo', '2022-02-08', ''),
(5, 'bivakumana', '2022-08-04', 'diploma', 5, '07913617851', 'saveur@bikorimana.com', 'kigarama', '2022-08-03', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_role` varchar(78) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_password`, `user_name`, `user_email`, `user_role`) VALUES
(1, 'saveur@123', 'bikorimana saveur', 'bikorimana@gmail.com', 'administrator'),
(2, 'saaaaveri', 'bikiorumana', 'bikorimanaxavier@gmail.com', 'administrator'),
(9, 'uwimna', 'uwimana adeline', 'bikorimanaxavier@gmail.com', 'register'),
(10, 'richard', 'manirarora richard', 'hassinaumutesi@gmail.com', 'administrator'),
(11, 'uwimanaverthe', 'uwimana berthe', 'uwimanaberthe@gmail.com', 'administrator'),
(13, 'sibomana', 'sibomana eric', 'sibomana@gmail.com', 'administrator'),
(14, 'methide', 'Twizeyimana Method', 'tm@gmail.com', 'administrator'),
(15, 'berthe', 'uwimana berthe', 'berthe@gmail.com', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_class`
--

CREATE TABLE `teacher_class` (
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `tbl_fee`
--
ALTER TABLE `tbl_fee`
  ADD PRIMARY KEY (`fee_id`),
  ADD KEY `reg_no` (`reg_no`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tbl_fee`
--
ALTER TABLE `tbl_fee`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `reg_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221020;

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_fee`
--
ALTER TABLE `tbl_fee`
  ADD CONSTRAINT `stud_fee` FOREIGN KEY (`reg_no`) REFERENCES `tbl_student` (`reg_no`);

--
-- Constraints for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD CONSTRAINT `tbl_student_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
