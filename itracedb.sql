-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2022 at 08:47 PM
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
  `adminContactNo` varchar(13) NOT NULL,
  `adminPassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_t`
--

INSERT INTO `admin_t` (`adminNo`, `adminFullName`, `adminEmail`, `adminContactNo`, `adminPassword`) VALUES
(1, 'Admeen Admeenan', 'admin@gmail.com', '+639959006390', 'admin');

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
('E-406', 0),
('N-105', 0);

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

--
-- Dumping data for table `logsh_t`
--

INSERT INTO `logsh_t` (`histID`, `roomID`, `RFIDno`, `fullName`, `timeIn`, `tempIn`, `timeOut`, `tempOut`, `logDate`) VALUES
(74, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05'),
(75, 'E-405', '19816425243', 'Eduardo Fernandez', '00:52:01', '999.99', '00:00:00', '0.00', '2022-12-07'),
(76, 'E-405', '192114934', 'Leonel Villamor', '00:52:04', '999.99', '00:00:00', '0.00', '2022-12-07'),
(77, 'E-405', '192114934', 'Leonel Villamor', '00:52:48', '0.00', '00:00:00', '0.00', '2022-12-07'),
(78, 'E-405', '227547548', 'Cherrylyn Cardiel', '00:53:16', '999.99', '00:00:00', '0.00', '2022-12-07'),
(79, 'E-405', '9710125338', 'Rejine Santos', '00:53:21', '0.00', '00:00:00', '0.00', '2022-12-07'),
(80, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05'),
(81, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07'),
(82, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08'),
(83, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10'),
(84, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05'),
(85, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07'),
(86, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08'),
(87, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10'),
(88, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05'),
(89, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07'),
(90, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08'),
(91, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10'),
(92, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05'),
(93, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07'),
(94, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08'),
(95, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10'),
(96, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05'),
(97, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07'),
(98, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08'),
(99, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10'),
(100, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05'),
(101, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07'),
(102, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08'),
(103, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10'),
(104, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05'),
(105, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07'),
(106, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08'),
(107, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10');

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
  `cardOut` int(1) NOT NULL DEFAULT 0,
  `attempting` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs_t`
--

INSERT INTO `logs_t` (`logID`, `count`, `roomID`, `RFIDno`, `fullName`, `timeIn`, `tempIn`, `timeOut`, `tempOut`, `logDate`, `cardOut`, `attempting`) VALUES
(1, 1, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05', 1, 0),
(5, 2, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07', 1, 0),
(6, 3, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08', 1, 0),
(7, 4, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10', 1, 0),
(8, 1, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05', 1, 0),
(9, 2, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07', 1, 0),
(10, 3, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08', 1, 0),
(11, 4, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10', 1, 0),
(12, 1, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05', 1, 0),
(13, 2, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07', 1, 0),
(14, 3, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08', 1, 0),
(15, 4, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10', 1, 0),
(16, 1, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05', 1, 0),
(17, 2, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07', 1, 0),
(18, 3, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08', 1, 0),
(19, 4, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10', 1, 0),
(20, 1, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05', 1, 0),
(21, 2, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07', 1, 0),
(22, 3, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08', 1, 0),
(23, 4, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10', 1, 0),
(24, 1, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05', 1, 0),
(25, 2, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07', 1, 0),
(26, 3, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08', 1, 0),
(27, 4, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10', 1, 0),
(28, 1, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05', 1, 0),
(29, 2, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07', 1, 0),
(30, 3, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08', 1, 0),
(31, 4, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10', 1, 0),
(32, 1, 'E-405', '19816425243', 'Eduardo Fernandez', '21:53:24', '37.00', '22:53:30', '37.20', '2022-12-05', 1, 0),
(33, 2, 'E-405', '192114934', 'Leonel Villamor', '06:52:48', '24.00', '06:53:54', '26.99', '2022-12-07', 1, 0),
(34, 3, 'E-405', '227547548', 'Cherrylyn Cardiel', '14:53:16', '32.00', '16:58:53', '33.00', '2022-12-08', 1, 0),
(35, 4, 'E-405', '9710125338', 'Rejine Santos', '17:53:21', '26.00', '19:53:56', '27.31', '2023-01-10', 1, 0);

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
  `notified` int(1) NOT NULL DEFAULT 0,
  `tap` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_t`
--

INSERT INTO `user_t` (`count`, `RFIDno`, `uFN`, `uMN`, `uLN`, `uGender`, `uRole`, `uID`, `uDept`, `uMail`, `uContactNo`, `uAddress`, `regDate`, `cardAdd`, `covidStat`, `notified`, `tap`) VALUES
(1, '19816425243', 'Eduardo', 'Santos', 'Fernandez', 'Male', 'Student', '2017-03312-MN-0', 'Information Techonology', 'ejaayfernandez@gmail.com', '+639126234216', 'Pasig, Manila', '2022-11-09', 1, 0, 0, 0),
(2, '192114934', 'Leonel', 'Mendoza', 'Villamor', 'Male', 'Faculty', '2016-03890-MN-1', 'Computer Science', 'lnlvillamor@gmail.com', '+639756734564', 'Paranaque, Manila', '2022-11-19', 1, 0, 0, 0),
(3, '227547548', 'Cherrylyn', 'Alejo', 'Cardiel', 'Female', 'Student', '2019-03512-MN-0', 'Information Techonology', 'cherryyyyy@gmail.com', '+639123456789', 'Manila, Manila', '2022-11-29', 1, 0, 0, 0),
(4, '9710125338', 'Rejine', 'Pozon', 'Santos', 'Female', 'Faculty', '2015-85688-MN-1', 'Computer Science', 'rsantos@gmail.com', '+639206745678', 'Pasig, Manila', '2022-12-06', 1, 0, 0, 0);

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
  MODIFY `adminNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forget_t`
--
ALTER TABLE `forget_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logsh_t`
--
ALTER TABLE `logsh_t`
  MODIFY `histID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `logs_t`
--
ALTER TABLE `logs_t`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_t`
--
ALTER TABLE `user_t`
  MODIFY `count` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
