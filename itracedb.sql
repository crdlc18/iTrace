-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 07:16 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itracedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_t`
--

CREATE TABLE `admin_t` (
  `adminNo` int(11) NOT NULL,
  `adminFullName` varchar(90) NOT NULL,
  `adminEmail` varchar(50) NOT NULL,
  `adminPassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_t`
--

INSERT INTO `admin_t` (`adminNo`, `adminFullName`, `adminEmail`, `adminPassword`) VALUES
(1, 'Admeen Admeenan', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `dev_t`
--

CREATE TABLE `dev_t` (
  `roomID` varchar(5) NOT NULL,
  `deviceMode` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dev_t`
--

INSERT INTO `dev_t` (`roomID`, `deviceMode`) VALUES
('E-405', 1),
('E-406', 0);

-- --------------------------------------------------------

--
-- Table structure for table `forget_t`
--

CREATE TABLE `forget_t` (
  `id` int(11) NOT NULL,
  `uMail` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logsh_t`
--

CREATE TABLE `logsh_t` (
  `histID` int(11) NOT NULL,
  `roomID` varchar(5) NOT NULL,
  `RFIDno` varchar(30) NOT NULL,
  `fullName` varchar(90) NOT NULL,
  `timeIn` time NOT NULL,
  `tempIn` decimal(5,2) NOT NULL,
  `timeOut` time NOT NULL,
  `tempOut` decimal(5,2) NOT NULL,
  `logDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logs_t`
--

CREATE TABLE `logs_t` (
  `logID` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `roomID` varchar(5) NOT NULL,
  `RFIDno` varchar(30) NOT NULL,
  `fullName` varchar(90) NOT NULL,
  `timeIn` time NOT NULL,
  `tempIn` decimal(5,2) NOT NULL,
  `timeOut` time NOT NULL,
  `tempOut` decimal(5,2) NOT NULL DEFAULT 0.00,
  `logDate` date NOT NULL,
  `cardOut` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `logs_t`
--
DELIMITER $$
CREATE TRIGGER `TR_InsHist` AFTER INSERT ON `logs_t` FOR EACH ROW BEGIN INSERT INTO logsh_t (`roomID`, `RFIDno`, `fullName`,  `timeIn`, `tempIn`, `timeOut`,`tempOut`, `logDate`) VALUES (NEW.roomID, NEW.RFIDno, NEW.fullName,  NEW.timeIn, NEW.tempIn, NEW.timeOut, NEW.tempOut, NEW.logDate); 

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_t`
--

CREATE TABLE `user_t` (
  `count` int(11) NOT NULL,
  `RFIDno` varchar(30) NOT NULL,
  `uFN` varchar(30) DEFAULT NULL,
  `uMN` varchar(30) DEFAULT NULL,
  `uLN` varchar(30) DEFAULT NULL,
  `uGender` varchar(7) DEFAULT NULL,
  `uRole` varchar(10) DEFAULT NULL,
  `uID` varchar(20) DEFAULT NULL,
  `uDept` varchar(50) DEFAULT NULL,
  `uMail` varchar(30) DEFAULT NULL,
  `uContactNo` varchar(13) DEFAULT NULL,
  `uAddress` varchar(100) DEFAULT NULL,
  `regDate` date NOT NULL,
  `cardAdd` int(11) NOT NULL DEFAULT 0,
  `covidStat` int(11) NOT NULL DEFAULT 0,
  `isSelected` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_t`
--

INSERT INTO `user_t` (`count`, `RFIDno`, `uFN`, `uMN`, `uLN`, `uGender`, `uRole`, `uID`, `uDept`, `uMail`, `uContactNo`, `uAddress`, `regDate`, `cardAdd`, `covidStat`, `isSelected`) VALUES
(1, '19816425243', 'Cherrylyn', 'Alejo', 'Cardiel', 'Female', 'Student', '2019-09834-MN-0', 'Information Technology', 'cherryyyyy@gmail.com', '+639905024894', 'Manila, Manila', '2022-11-25', 1, 1, 0),
(2, '192114934', 'Leonel', 'Mendoza', 'Villamor', 'Male', 'Faculty', '2016-03890-MN-1', 'Computer Science', 'lnlvillamor@gmail.com', '+639202416980', 'Paranaque, Manila', '2022-11-25', 1, 1, 1),
(3, '227547548', 'Eduardo', 'Santos', 'Fernandez', 'Male', 'Student', '2019-03522-MN-0', 'Information Technology', 'ejaayfernandez@gmail.com', '+639760249248', 'Pasig, Manila', '2022-11-25', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_t`
--
ALTER TABLE `admin_t`
  ADD PRIMARY KEY (`adminNo`);

--
-- Indexes for table `dev_t`
--
ALTER TABLE `dev_t`
  ADD PRIMARY KEY (`roomID`);

--
-- Indexes for table `forget_t`
--
ALTER TABLE `forget_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logsh_t`
--
ALTER TABLE `logsh_t`
  ADD PRIMARY KEY (`histID`);

--
-- Indexes for table `logs_t`
--
ALTER TABLE `logs_t`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `logs_rfidCount_fk` (`count`,`RFIDno`),
  ADD KEY `logs_roomID_fk` (`roomID`);

--
-- Indexes for table `user_t`
--
ALTER TABLE `user_t`
  ADD PRIMARY KEY (`count`,`RFIDno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_t`
--
ALTER TABLE `admin_t`
  MODIFY `adminNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forget_t`
--
ALTER TABLE `forget_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logsh_t`
--
ALTER TABLE `logsh_t`
  MODIFY `histID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs_t`
--
ALTER TABLE `logs_t`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_t`
--
ALTER TABLE `user_t`
  MODIFY `count` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs_t`
--
ALTER TABLE `logs_t`
  ADD CONSTRAINT `logs_rfidCount_fk` FOREIGN KEY (`count`,`RFIDno`) REFERENCES `user_t` (`count`, `RFIDno`) ON DELETE CASCADE,
  ADD CONSTRAINT `logs_roomID_fk` FOREIGN KEY (`roomID`) REFERENCES `dev_t` (`roomID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
