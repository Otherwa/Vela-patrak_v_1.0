-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2022 at 06:06 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `velapatrak`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `AcademicYear` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`AcademicYear`) VALUES
('2015-2016\r\n'),
('2016-2017'),
('2017-2018'),
('2018-2019'),
('2019-2020'),
('2020-2021'),
('2021-2022'),
('2022-2023'),
('2022-2023');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `CourseId` int(10) NOT NULL,
  `CourseName` varchar(100) NOT NULL,
  `Strength` int(10) NOT NULL,
  `Abbreviation` varchar(100) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseId`, `CourseName`, `Strength`, `Abbreviation`, `MemberId`, `Date`) VALUES
(1, 'BSC_IT', 45, 'bscit', 13, '2022-09-08 11:30:34'),
(0, 'BMS', 56, '12', 13, '2022-09-08 11:41:09'),
(213, 'adf', 132, 'sdf', 13, '2022-09-08 11:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `MemberId` int(11) NOT NULL,
  `FirstName` varchar(15) NOT NULL,
  `LastName` varchar(15) NOT NULL,
  `Department` varchar(10) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Phone` varchar(14) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`MemberId`, `FirstName`, `LastName`, `Department`, `Email`, `Phone`, `Username`, `Password`, `Type`) VALUES
(12, 'Pushkar', 'Sane', 'BSc IT', 'puskhar2gmail.com', '12345', 'pushkar', '12345', 'superadmin'),
(13, 'Atharv', 'Desai', 'BSc IT', 'atharvdesai2002gmail.com', '8828388979', 'Otherwa', 'admin', 'admin'),
(14, 'Himanshu', 'Chaudhari', 'Bsc', 'himanshu@gmail.com', '8828388979', 'XHiman', '12345', 'member'),
(15, 'Atharv', 'Desai', 'BAMMC', 'adad@gmail.com', '8828388979', 'sfsf', '12345678', 'member'),
(16, 'Atharv', 'Desai', 'BSc IT', 'atharvdesai2002@gmail.com', '8828388979', 'ATharv', '123456789', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `ProfessorId` int(11) NOT NULL,
  `ProfessorFirstName` varchar(50) NOT NULL,
  `ProfessorLastName` varchar(50) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `EmailId` varchar(100) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Part` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`ProfessorId`, `ProfessorFirstName`, `ProfessorLastName`, `Department`, `EmailId`, `Phone`, `MemberId`, `Date`, `Part`) VALUES
(1, 'Kunal', 'Bhole', 'POL.SCIENCE', 'kunal@gmail.com', '8828388979', 13, '2022-09-08 08:05:18', 'Junior'),
(3, 'Pushkar', 'Sane', 'INFORMATION TECHLOGY', 'Nice@gmail.com', '8828388978', 13, '2022-09-08 09:19:10', 'Degree'),
(4, 'Atharv', 'Desai', 'INFORMATION TECHLOGY', 'atharvdesai2002@gmail.com', '8828388979', 13, '2022-11-11 14:59:25', 'Degree');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RoomNo` varchar(20) NOT NULL,
  `Floor` int(5) NOT NULL,
  `Capacity` int(5) NOT NULL,
  `MemberId` int(5) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RoomNo`, `Floor`, `Capacity`, `MemberId`, `Date`) VALUES
('214', 2, 69, 13, '2022-09-08 10:08:14'),
('69', 69, 69, 13, '2022-11-11 12:40:11');

-- --------------------------------------------------------

--
-- Table structure for table `selectsubject`
--

CREATE TABLE `selectsubject` (
  `ProfessorId` int(11) NOT NULL,
  `ProfessorName` text NOT NULL,
  `Class` text NOT NULL,
  `Semester` text NOT NULL,
  `Subject` text NOT NULL,
  `MemberId` int(255) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selectsubject`
--

INSERT INTO `selectsubject` (`ProfessorId`, `ProfessorName`, `Class`, `Semester`, `Subject`, `MemberId`, `Date`) VALUES
(2, 'Kunal Bhole', 'TYIT', 'III', '1212', 13, '2022-11-11 14:54:59'),
(3, 'Pushkar Sane', 'FYIT', 'I', '0', 13, '2022-11-11 17:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SubjectCode` varchar(255) NOT NULL,
  `SubjectName` text NOT NULL,
  `Semester` text NOT NULL,
  `Class` text NOT NULL,
  `CourseId` text NOT NULL,
  `MemberId` int(255) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Department` text NOT NULL,
  `Part` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SubjectCode`, `SubjectName`, `Semester`, `Class`, `CourseId`, `MemberId`, `Date`, `Department`, `Part`) VALUES
('XYZ1212', 'TEST Subject', 'III', 'FYIT', '0', 13, '2022-11-11 17:04:23', 'INFORMATION TECHLOGY', 'Degree');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `TimeSlot` int(20) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `MemberId` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`TimeSlot`, `StartTime`, `EndTime`, `MemberId`, `Date`) VALUES
(1, '07:48:00', '08:36:00', 13, '2022-11-11 09:23:30'),
(2, '08:34:00', '09:15:00', 13, '2022-11-11 12:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `AcademicYear` text NOT NULL,
  `RoomNo` int(255) NOT NULL,
  `TimeSlot` int(25) NOT NULL,
  `Day` text NOT NULL,
  `Division` varchar(5) NOT NULL,
  `SubjectCode` int(255) NOT NULL,
  `Department` text NOT NULL,
  `MemberId` int(255) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Division1` varchar(5) NOT NULL,
  `Division2` varchar(5) NOT NULL,
  `Division3` varchar(5) NOT NULL,
  `SubjectCode1` int(255) NOT NULL,
  `Division11` varchar(5) NOT NULL,
  `Division12` varchar(5) NOT NULL,
  `Division13` varchar(5) NOT NULL,
  `Division14` varchar(5) NOT NULL,
  `Part` text NOT NULL,
  `Sem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD KEY `members_course` (`MemberId`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`MemberId`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`ProfessorId`),
  ADD KEY `members_professor` (`MemberId`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD KEY `members_rooms` (`MemberId`),
  ADD KEY `RoomNo` (`RoomNo`);

--
-- Indexes for table `selectsubject`
--
ALTER TABLE `selectsubject`
  ADD PRIMARY KEY (`ProfessorId`),
  ADD KEY `members_selectsubject` (`MemberId`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`SubjectCode`),
  ADD KEY `members_subject` (`MemberId`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD KEY `Member_timeslot` (`MemberId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `MemberId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `ProfessorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `selectsubject`
--
ALTER TABLE `selectsubject`
  MODIFY `ProfessorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `members_course` FOREIGN KEY (`MemberId`) REFERENCES `members` (`MemberId`);

--
-- Constraints for table `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `members_professor` FOREIGN KEY (`MemberId`) REFERENCES `members` (`MemberId`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `members_rooms` FOREIGN KEY (`MemberId`) REFERENCES `members` (`MemberId`);

--
-- Constraints for table `selectsubject`
--
ALTER TABLE `selectsubject`
  ADD CONSTRAINT `members_selectsubject` FOREIGN KEY (`MemberId`) REFERENCES `members` (`MemberId`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `members_subject` FOREIGN KEY (`MemberId`) REFERENCES `members` (`MemberId`);

--
-- Constraints for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD CONSTRAINT `Member_timeslot` FOREIGN KEY (`MemberId`) REFERENCES `members` (`MemberId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
