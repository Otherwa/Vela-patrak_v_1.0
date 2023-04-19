-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql101.epizy.com
-- Generation Time: Jan 19, 2023 at 03:51 AM
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
(3, 'BMS', 120, 'BMS', 17, '2023-01-10 10:18:39'),
(4, 'BSc-BT', 120, 'BSc-BT', 17, '2023-01-12 03:54:55'),
(5, 'BA', 120, 'BA', 17, '2023-01-17 07:26:12');

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
(17, 'Mohini', 'Bhole', 'BSc IT', 'bhole.mohini@gmail.com', '9324581700', 'Mohini', '12345678', 'admin'),
(19, 'Sandeep', 'Kamble', 'Science', 'absc@gmail.com', '5642156521258', 'Sandeep', '12345678', 'admin');

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
(5, 'Mohini', 'Bhole', 'INFORMATION TECHNOLOGY', 'bhole.mohini@gmail.com', '9324581700', 17, '2023-01-15 14:24:59', 'Degree');

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
('111', 0, 90, 17, '2023-01-12 03:46:06'),
('309', 2, 120, 17, '2023-01-12 04:28:16'),
('409', 3, 120, 17, '2023-01-12 04:28:07');

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
(15, 'Mohini Bhole', 'SYIT', 'II', 'SIT202', 17, '2023-01-15 14:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SubjectCode` varchar(255) NOT NULL,
  `SubjectName` varchar(125) NOT NULL,
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
('SBT101', 'Basic Chemistry-I ', 'I', 'FYBT', 'BSc-BT', 17, '2023-01-12 04:21:04', 'BIOTECHONOLOGY', 'Degree'),
('SBT102', 'Basic Chemistry-II ', 'I', 'FYBT', 'BSc-BT', 17, '2023-01-12 04:22:12', 'BIOTECHONOLOGY', 'Degree'),
('SBT103', 'Basic Life Sciences-I : B', 'I', 'FYBT', 'BSc-BT', 17, '2023-01-12 04:22:53', 'BIOTECHONOLOGY', 'Degree'),
('SBT104', 'Basic Life Sciences-II: M', 'I', 'FYBT', 'BSc-BT', 17, '2023-01-12 04:23:21', 'BIOTECHONOLOGY', 'Degree'),
('SBT105', 'Basic Biotechnology-I: In', 'I', 'FYBT', 'BSc-BT', 17, '2023-01-12 04:24:19', 'BIOTECHONOLOGY', 'Degree'),
('SBT106', ' Basic Biotechnology-II :', 'I', 'FYBT', 'BSc-BT', 17, '2023-01-12 04:24:52', 'BIOTECHONOLOGY', 'Degree'),
('SBT107', 'Societal Awareness', 'I', 'FYBT', 'BSc-BT', 17, '2023-01-12 04:25:51', 'BIOTECHONOLOGY', 'Degree'),
('SBTP101', 'Practical of Basic Chemis', 'I', 'FYBT', 'BSc-BT', 17, '2023-01-12 04:27:29', 'BIOTECHONOLOGY', 'Degree'),
('SBTP102', 'Practical of Basic Chemis', 'I', 'FYBT', 'BSc-BT', 17, '2023-01-12 04:29:01', 'BIOTECHONOLOGY', 'Degree'),
('SBTP103', 'Practical of Basic Life S', 'I', 'FYBT', 'BSc-BT', 17, '2023-01-12 04:29:48', 'BIOTECHONOLOGY', 'Degree'),
('SBTP104', 'Practical of Basic Life S', 'I', 'FYBT', 'Bsc-IT', 17, '2023-01-12 04:30:27', 'BIOTECHONOLOGY', 'Degree'),
('SBTP105', 'Practical of Basic Biotec', 'I', 'FYBT', 'BSc-BT', 17, '2023-01-12 04:31:27', 'BIOTECHONOLOGY', 'Degree'),
('SBTP106', 'Practical of Basic Biotec', 'I', 'FYBT', 'BSc-BT', 17, '2023-01-12 04:32:14', 'BIOTECHONOLOGY', 'Degree'),
('SIT101', 'Imperative Programming', 'I', 'FYIT', 'Bsc-IT', 17, '2023-01-10 10:20:29', 'INFORMATION TECHNOLOGY', 'Degree'),
('SIT102', 'Digital Electronics', 'I', 'FYIT', 'Bsc-IT', 17, '2023-01-10 10:21:11', 'INFORMATION TECHNOLOGY', 'Degree'),
('SIT201', 'Object oriented Programmi', 'II', 'SYIT', 'Bsc-IT', 17, '2023-01-12 03:39:28', 'INFORMATION TECHNOLOGY', 'Degree'),
('SIT202', 'Database Management Syste', 'II', 'SYIT', 'Bsc-IT', 17, '2023-01-12 03:40:04', 'INFORMATION TECHNOLOGY', 'Degree'),
('SIT203', 'Web Programming', 'II', 'SYIT', 'Bsc-IT', 17, '2023-01-12 03:41:27', 'INFORMATION TECHNOLOGY', 'Degree'),
('SIT204', 'Numerical and Statistical', 'II', 'SYIT', 'Bsc-IT', 17, '2023-01-12 03:41:58', 'INFORMATION TECHNOLOGY', 'Degree');

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
(0, '07:00:00', '07:48:00', 17, '2023-01-11 04:45:51'),
(2, '07:48:00', '08:36:00', 17, '2023-01-11 04:46:25'),
(3, '09:00:00', '09:48:00', 17, '2023-01-11 04:47:21'),
(4, '09:48:00', '10:36:00', 17, '2023-01-11 04:47:47'),
(5, '10:36:00', '11:24:00', 17, '2023-01-12 03:43:46'),
(6, '11:24:00', '12:10:00', 17, '2023-01-12 03:45:10'),
(7, '11:30:00', '12:10:00', 17, '2023-01-12 03:49:35'),
(8, '12:30:00', '13:18:00', 17, '2023-01-12 04:04:28'),
(9, '12:10:00', '12:50:00', 17, '2023-01-12 04:04:38'),
(10, '13:18:00', '14:06:00', 17, '2023-01-12 04:05:13'),
(11, '12:50:00', '13:30:00', 17, '2023-01-12 04:06:30'),
(12, '14:06:00', '14:54:00', 17, '2023-01-12 04:07:13'),
(13, '13:30:00', '14:10:00', 17, '2023-01-12 04:07:39'),
(14, '14:40:00', '15:20:00', 17, '2023-01-12 04:09:41'),
(15, '15:20:00', '16:00:00', 17, '2023-01-12 04:09:55'),
(16, '16:00:00', '16:40:00', 17, '2023-01-12 04:10:09'),
(17, '16:40:00', '17:20:00', 17, '2023-01-12 04:10:19'),
(18, '17:20:00', '18:00:00', 17, '2023-01-12 04:10:40');

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
(21, '2021-2022', '409', '11:24 AM - 12:10 PM', 'Monday', 'A', 'SBT101', 'BIOTECHONOLOGY', 17, '2023-01-15 07:41:47', '--', '--', '--', '--', '--', '--', '--', 'Degree', 'I', 'FYBT'),
(16, '2022-2023', '111', '10:36 AM - 11:24 AM', 'Monday', 'A', 'SIT202', 'INFORMATION TECHNOLOGY', 17, '2023-01-15 07:42:58', '--', '--', '--', '--', '--', '--', '--', 'Degree', 'II', 'SYIT'),
(17, '2022-2023', '111', '11:24 AM - 12:10 PM', 'Monday', 'A', 'SIT202', 'INFORMATION TECHNOLOGY', 17, '2023-01-15 07:42:03', '--', '--', '--', '--', '--', '--', '--', 'Degree', 'II', 'SYIT'),
(19, '2022-2023', '111', '12:30 AM - 1:18 PM', 'Monday', 'A', 'SIT205', 'INFORMATION TECHNOLOGY', 17, '2023-01-15 07:41:09', '--', '--', '--', '--', '--', '--', '--', 'Degree', 'II', 'SYIT'),
(14, '2022-2023', '111', '9:00 AM - 9:48 AM', 'Monday', 'A', 'SIT201', 'INFORMATION TECHNOLOGY', 17, '2023-01-15 07:41:38', '--', '--', '--', '--', '--', '--', '--', 'Degree', 'II', 'SYIT'),
(15, '2022-2023', '111', '9:48 AM - 10:36 AM', 'Monday', 'A', 'SIT201', 'INFORMATION TECHNOLOGY', 17, '2023-01-15 07:41:23', '--', '--', '--', '--', '--', '--', '--', 'Degree', 'II', 'SYIT'),
(1, '2022-2023', '214', '7:48 AM - 8:36 AM', 'Wednesday', 'A', 'SIT102', 'INFORMATION TECHNOLOGY', 17, '2023-01-15 07:40:05', '--', '--', '--', '--', '--', '--', '--', 'Degree', 'I', 'FYIT'),
(7, '2022-2023', '69', '7:48 AM - 8:36 AM', 'Wednesday', 'B', 'MSFHS101', 'BMS', 17, '2023-01-15 07:40:01', '--', '--', '--', '--', '--', '--', '--', 'Degree', 'I', 'FYBMS');

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
  MODIFY `MemberId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `ProfessorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `selectsubject`
--
ALTER TABLE `selectsubject`
  MODIFY `ProfessorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
