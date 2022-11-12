-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2022 at 03:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `Id` int(11) NOT NULL,
  `AcademicYear` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`Id`, `AcademicYear`) VALUES
(1, '2015-2016\r\n'),
(2, '2016-2017'),
(3, '2017-2018'),
(4, '2018-2019'),
(5, '2019-2020'),
(6, '2020-2021'),
(7, '2021-2022'),
(8, '2022-2023');

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
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
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
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selectsubject`
--

INSERT INTO `selectsubject` (`ProfessorId`, `ProfessorName`, `Class`, `Semester`, `Subject`, `MemberId`, `Date`) VALUES
(4, 'Pushkar Sane', 'FYIT', 'III', 'XYZ1212', 13, '2022-11-12 12:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SubjectCode` varchar(255) NOT NULL,
  `SubjectName` varchar(25) NOT NULL,
  `Semester` varchar(25) NOT NULL,
  `Class` varchar(25) NOT NULL,
  `CourseId` text NOT NULL,
  `MemberId` int(255) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Department` text NOT NULL,
  `Part` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SubjectCode`, `SubjectName`, `Semester`, `Class`, `CourseId`, `MemberId`, `Date`, `Department`, `Part`) VALUES
('adas12', 'POlitival', 'II', 'SYBA', 'BSC_IT', 13, '2022-11-12 11:58:12', 'POL.SCIENCE', 'Junior'),
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
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
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
  `AcademicYear` varchar(50) NOT NULL,
  `RoomNo` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `TimeSlot` varchar(25) NOT NULL,
  `Day` varchar(50) NOT NULL,
  `Division` varchar(5) NOT NULL,
  `SubjectName` varchar(25) NOT NULL,
  `Department` text NOT NULL,
  `MemberId` int(255) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Division1` varchar(5) NOT NULL,
  `Division2` varchar(5) NOT NULL,
  `Division3` varchar(5) NOT NULL,
  `SubjectName1` varchar(25) NOT NULL,
  `Division11` varchar(5) NOT NULL,
  `Division12` varchar(5) NOT NULL,
  `Division13` varchar(5) NOT NULL,
  `Division14` varchar(5) NOT NULL,
  `Part` varchar(25) NOT NULL,
  `Sem` varchar(25) NOT NULL,
  `Class` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`AcademicYear`, `RoomNo`, `TimeSlot`, `Day`, `Division`, `SubjectName`, `Department`, `MemberId`, `Date`, `Division1`, `Division2`, `Division3`, `SubjectName1`, `Division11`, `Division12`, `Division13`, `Division14`, `Part`, `Sem`, `Class`) VALUES
('2021-2022', '214', '7.48-8.36', 'MONDAY', 'A', 'POlitival', 'INFORMATION TECHLOGY', 13, '2022-11-12 14:54:32', '', '', '', '', '', '', '', '', 'Degree', 'II', 'FYIT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `AcademicYear` (`AcademicYear`);

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
  ADD PRIMARY KEY (`RoomNo`),
  ADD KEY `members_rooms` (`MemberId`);

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
  ADD KEY `members_subject` (`MemberId`),
  ADD KEY `Semester` (`Semester`),
  ADD KEY `Class` (`Class`),
  ADD KEY `SubjectName` (`SubjectName`),
  ADD KEY `Part` (`Part`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD KEY `Member_timeslot` (`MemberId`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`AcademicYear`,`RoomNo`,`TimeSlot`,`Day`,`Sem`,`Class`),
  ADD UNIQUE KEY `RoomNo` (`RoomNo`),
  ADD UNIQUE KEY `Day` (`Day`),
  ADD UNIQUE KEY `AcademicYear` (`AcademicYear`),
  ADD UNIQUE KEY `TimeSlot` (`TimeSlot`),
  ADD UNIQUE KEY `Sem` (`Sem`),
  ADD KEY `member_timetable` (`MemberId`),
  ADD KEY `Class` (`Class`),
  ADD KEY `SubjectName` (`SubjectName`),
  ADD KEY `Part` (`Part`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `ProfessorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `config_timetable` FOREIGN KEY (`AcademicYear`) REFERENCES `config` (`AcademicYear`),
  ADD CONSTRAINT `member_timetable` FOREIGN KEY (`MemberId`) REFERENCES `members` (`MemberId`),
  ADD CONSTRAINT `rooms_timetable` FOREIGN KEY (`RoomNo`) REFERENCES `rooms` (`RoomNo`),
  ADD CONSTRAINT `subject1_timetable` FOREIGN KEY (`Class`) REFERENCES `subject` (`Class`),
  ADD CONSTRAINT `subject2_timetable` FOREIGN KEY (`SubjectName`) REFERENCES `subject` (`SubjectName`),
  ADD CONSTRAINT `subject3_timetable` FOREIGN KEY (`Part`) REFERENCES `subject` (`Part`),
  ADD CONSTRAINT `subject_timetable` FOREIGN KEY (`Sem`) REFERENCES `subject` (`Semester`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
