-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2022 at 05:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `velapatrak`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members`
(
  `MemberId` int
(11) NOT NULL,
  `FirstName` varchar
(15) NOT NULL,
  `LastName` varchar
(15) NOT NULL,
  `Department` varchar
(10) NOT NULL,
  `Email` varchar
(25) NOT NULL,
  `Phone` varchar
(14) NOT NULL,
  `Username` varchar
(15) NOT NULL,
  `Password` varchar
(15) NOT NULL,
  `Type` varchar
(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`
MemberId`,
`FirstName
`, `LastName`, `Department`, `Email`, `Phone`, `Username`, `Password`, `Type`) VALUES
(1, 'Atharv', 'Desai', 'BScIT', 'atharvdesai2002@gmail.com', '8828388979', 'admin', 'timetable', 'admin'),
(3, 'Pushkar', 'Sane', 'BSc IT', 'thekingpush417@gmail.com', '8355958447', 'admin', 'timetable', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot`
(
  `TimeSlot` int
(20) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `MemberId` int
(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp
()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
ADD PRIMARY KEY
(`MemberId`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
ADD KEY `Member_timeslot`
(`MemberId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `MemberId` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `timeslot`
--
ALTER TABLE `timeslot`
ADD CONSTRAINT `Member_timeslot` FOREIGN KEY
(`MemberId`) REFERENCES `members`
(`MemberId`) ON
DELETE CASCADE ON
UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
