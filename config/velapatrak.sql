-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql101.epizy.com
-- Generation Time: Jan 10, 2023 at 05:48 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_32417587_vel`
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
(49, '2021-2022'),
(8, '2022-2023'),
(34, '2023-2024');

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
(1, 'Bsc-IT', 120, 'BSc-IT', 17, '2023-01-10 10:17:27'),
(2, 'BCom', 120, 'BCom', 17, '2023-01-10 10:17:54'),
(3, 'BMS', 120, 'BMS', 17, '2023-01-10 10:18:39');

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
(13, 'Atharvv', 'Desai', '--', 'atharvdesai2002gmail.com', '8828388979', 'Otherwa', 'admin', 'member'),
(17, 'Mohini', 'Bhole', 'BSc IT', 'bhole.mohini@gmail.com', '9324581700', 'Mohini', '12345678', 'admin');

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
(5, 'Mohini', 'Bhole', 'INFORMATION TECHNOLOGY', 'bhole.mohini@gmail.com', '9324581700', 17, '2023-01-10 10:23:35', 'Degree');

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
('69', 1, 69, 13, '2022-11-11 12:40:11');

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
(13, 'Mohini Bhole', 'FYIT', 'I', 'SIT102', 17, '2023-01-10 10:23:13');

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
  `Part` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SubjectCode`, `SubjectName`, `Semester`, `Class`, `CourseId`, `MemberId`, `Date`, `Department`, `Part`) VALUES
('MSFHS101', 'Foundation of Human Skill', 'I', 'FYBMS', 'BMS', 17, '2023-01-10 10:26:46', 'BMS', 'Degree'),
('SIT101', 'Imperative Programming', 'I', 'FYIT', 'Bsc-IT', 17, '2023-01-10 10:20:29', 'INFORMATION TECHLOGY', 'Degree'),
('SIT102', 'Digital Electronics', 'I', 'FYIT', 'Bsc-IT', 17, '2023-01-10 10:21:11', 'INFORMATION TECHLOGY', 'Degree');

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
  `Id` int(11) NOT NULL,
  `AcademicYear` varchar(50) NOT NULL,
  `RoomNo` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `TimeSlot` varchar(25) NOT NULL,
  `Day` varchar(50) NOT NULL,
  `Division` varchar(5) NOT NULL,
  `SubjectCode` varchar(25) NOT NULL DEFAULT '--',
  `Department` text NOT NULL,
  `MemberId` int(255) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Division1` varchar(5) NOT NULL,
  `Division2` varchar(25) NOT NULL,
  `Division3` varchar(25) NOT NULL,
  `SubjectCode1` varchar(25) NOT NULL,
  `Division4` varchar(25) NOT NULL,
  `Division5` varchar(25) NOT NULL,
  `Division6` varchar(25) NOT NULL,
  `Part` text NOT NULL,
  `Sem` varchar(25) NOT NULL,
  `Class` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`Id`, `AcademicYear`, `RoomNo`, `TimeSlot`, `Day`, `Division`, `SubjectCode`, `Department`, `MemberId`, `Date`, `Division1`, `Division2`, `Division3`, `SubjectCode1`, `Division4`, `Division5`, `Division6`, `Part`, `Sem`, `Class`) VALUES
(1, '2022-2023', '214', '07:48:00 - 08:36:00', 'Wednesday', 'A', 'SIT102', 'INFORMATION TECHLOGY', 17, '2023-01-10 10:24:43', '--', '--', '--', '--', '--', '--', '--', 'Degree', 'I', 'FYIT'),
(7, '2022-2023', '69', '07:48:00 - 08:36:00', 'Wednesday', 'B', 'MSFHS101', 'BMS', 17, '2023-01-10 10:28:19', '--', '--', '--', '--', '--', '--', '--', 'Degree', 'I', 'FYBMS');

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
  ADD KEY `SubjectCode` (`SubjectCode`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD KEY `Member_timeslot` (`MemberId`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`AcademicYear`,`RoomNo`,`TimeSlot`,`Day`,`Sem`),
  ADD KEY `member_timetable` (`MemberId`),
  ADD KEY `Class` (`Class`),
  ADD KEY `RoomNo` (`RoomNo`),
  ADD KEY `SubjectCode` (`SubjectCode`),
  ADD KEY `Id` (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `MemberId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `ProfessorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `selectsubject`
--
ALTER TABLE `selectsubject`
  MODIFY `ProfessorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
