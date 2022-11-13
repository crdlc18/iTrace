-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2022 at 07:07 PM
-- Server version: 10.6.5-MariaDB
-- PHP Version: 8.0.14

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
  `passwrd` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_t`
--

INSERT INTO `admin_t` (`adminNo`, `adminFullName`, `adminEmail`, `passwrd`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attendlog_hist`
--

CREATE TABLE `attendlog_hist` (
  `histID` int(11) NOT NULL,
  `RoomID` varchar(5) NOT NULL,
  `RFID_no` varchar(30) NOT NULL,
  `fullName` varchar(90) NOT NULL,
  `timeIn` time NOT NULL,
  `InTemp_celsius` decimal(5,2) NOT NULL,
  `timeOut` time NOT NULL,
  `OutTemp_celsius` decimal(5,2) NOT NULL,
  `attendDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendlog_hist`
--

INSERT INTO `attendlog_hist` (`histID`, `RoomID`, `RFID_no`, `fullName`, `timeIn`, `InTemp_celsius`, `timeOut`, `OutTemp_celsius`, `attendDate`) VALUES
(1, 'E-405', '19816425243', 'Gray', '08:00:00', '37.85', '08:05:00', '37.85', '2022-11-04'),
(2, 'E-405', '192114934', 'white', '09:00:00', '34.25', '10:00:00', '39.00', '2022-11-04'),
(3, 'E-405', '227547548', 'Card l', '09:00:00', '34.06', '10:00:00', '35.06', '2022-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `attend_log`
--

CREATE TABLE `attend_log` (
  `attendID` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `RoomID` varchar(5) NOT NULL,
  `RFID_no` varchar(30) NOT NULL,
  `fullName` varchar(90) NOT NULL,
  `timeIn` time NOT NULL,
  `InTemp_celsius` decimal(5,2) NOT NULL,
  `timeOut` time NOT NULL,
  `OutTemp_celsius` decimal(5,2) NOT NULL DEFAULT 0.00,
  `attendDate` date NOT NULL,
  `card_out` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attend_log`
--

INSERT INTO `attend_log` (`attendID`, `count`, `RoomID`, `RFID_no`, `fullName`, `timeIn`, `InTemp_celsius`, `timeOut`, `OutTemp_celsius`, `attendDate`, `card_out`) VALUES
(7, 1, 'E-405', '19816425243', 'Gray', '08:00:00', '37.85', '08:05:00', '37.85', '2022-11-03', 1),
(8, 2, 'E-405', '192114934', 'white', '09:00:00', '34.25', '10:00:00', '39.00', '2022-11-03', 1),
(9, 3, 'E-405', '227547548', 'Card l', '09:00:00', '34.06', '10:00:00', '35.06', '2022-11-03', 1);

--
-- Triggers `attend_log`
--
DELIMITER $$
CREATE TRIGGER `TR_InsHist` AFTER INSERT ON `attend_log` FOR EACH ROW BEGIN INSERT INTO AttendLog_Hist (`RoomID`, `RFID_no`, `fullName`,  `timeIn`, `InTemp_celsius`, `timeOut`,`OutTemp_celsius`, `attendDate`) VALUES (NEW.RoomID, NEW.RFID_no, NEW.fullName,  NEW.timeIn, NEW.InTemp_celsius, NEW.timeOut, NEW.OutTemp_celsius, NEW.attendDate); 

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dev_t`
--

CREATE TABLE `dev_t` (
  `RoomID` varchar(5) NOT NULL,
  `Dept` varchar(50) NOT NULL,
  `DevMode` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dev_t`
--

INSERT INTO `dev_t` (`RoomID`, `Dept`, `DevMode`) VALUES
('E-405', 'Information Technology', 1),
('E-406', 'Computer Science', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_t`
--

CREATE TABLE `user_t` (
  `count` int(11) NOT NULL,
  `RFID_no` varchar(30) NOT NULL,
  `fName` varchar(30) DEFAULT NULL,
  `mName` varchar(30) DEFAULT NULL,
  `sName` varchar(30) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `userRole` varchar(10) DEFAULT NULL,
  `roleID` varchar(20) DEFAULT NULL,
  `dept` varchar(50) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contactNo` varchar(13) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `regDate` date NOT NULL,
  `addCard` int(11) NOT NULL DEFAULT 0,
  `covidStat` int(11) NOT NULL DEFAULT 0,
  `isSelected` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_t`
--

INSERT INTO `user_t` (`count`, `RFID_no`, `fName`, `mName`, `sName`, `gender`, `userRole`, `roleID`, `dept`, `email`, `contactNo`, `address`, `regDate`, `addCard`, `covidStat`, `isSelected`) VALUES
(1, '19816425243', 'Gray', 'Gray', 'Grayyy', 'Male', 'Student', '2017-09834-MN-0', 'Computer Science', 'G@gmail.com', '09760249248', 'Eusebio Bliss Village III, West Bank Rd., Maybunga 1607', '2022-10-27', 1, 1, 1),
(2, '192114934', 'White', 'W', 'W', 'Female', 'Faculty', '2016-03890-MN-1', 'Information Technology', 'W@gmail.com', '09760249248', 'Eusebio Bliss Village III, West Bank Rd., Maybunga 1607', '2022-10-27', 1, 1, 0),
(3, '227547548', 'Card I', 'I', 'I', 'Male', 'Faculty', '2018-06822-MN-1', 'Information Technology', 'light@gmail.com', '111111111', '5-A Dr Sixto Antonio Avenue, Rosario, Pasig, Metro Manila 1609', '2022-10-29', 1, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_t`
--
ALTER TABLE `admin_t`
  ADD PRIMARY KEY (`adminNo`);

--
-- Indexes for table `attendlog_hist`
--
ALTER TABLE `attendlog_hist`
  ADD PRIMARY KEY (`histID`);

--
-- Indexes for table `attend_log`
--
ALTER TABLE `attend_log`
  ADD PRIMARY KEY (`attendID`),
  ADD KEY `attendLog_rfidCount_fk` (`count`,`RFID_no`),
  ADD KEY `attendLog_roomID_fk` (`RoomID`);

--
-- Indexes for table `dev_t`
--
ALTER TABLE `dev_t`
  ADD PRIMARY KEY (`RoomID`);

--
-- Indexes for table `user_t`
--
ALTER TABLE `user_t`
  ADD PRIMARY KEY (`count`,`RFID_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_t`
--
ALTER TABLE `admin_t`
  MODIFY `adminNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendlog_hist`
--
ALTER TABLE `attendlog_hist`
  MODIFY `histID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attend_log`
--
ALTER TABLE `attend_log`
  MODIFY `attendID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_t`
--
ALTER TABLE `user_t`
  MODIFY `count` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attend_log`
--
ALTER TABLE `attend_log`
  ADD CONSTRAINT `attendLog_rfidCount_fk` FOREIGN KEY (`count`,`RFID_no`) REFERENCES `user_t` (`count`, `RFID_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendLog_roomID_fk` FOREIGN KEY (`RoomID`) REFERENCES `dev_t` (`RoomID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
