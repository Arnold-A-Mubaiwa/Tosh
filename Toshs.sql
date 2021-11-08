-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 08, 2021 at 08:47 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Toshs`
--

-- --------------------------------------------------------

--
-- Table structure for table `chec`
--

CREATE TABLE `chec` (
  `ID` int(11) NOT NULL,
  `doc` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `ID` int(11) NOT NULL,
  `PostID` int(25) NOT NULL,
  `UserID` int(25) NOT NULL,
  `Comment` text NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(25) NOT NULL,
  `Name` varchar(25) DEFAULT NULL,
  `Surname` varchar(25) DEFAULT NULL,
  `Password` varchar(25) NOT NULL,
  `Position` varchar(25) DEFAULT NULL,
  `Faculty` varchar(25) DEFAULT NULL,
  `Year` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Name`, `Surname`, `Password`, `Position`, `Faculty`, `Year`) VALUES
(121589, 'Tosh', 'Myi', '123123123', 'Lecturer', 'MICT', NULL),
(401201335, 'Mphumi', 'Myi', '123123123', 'Student', 'MICT', '3rd');

-- --------------------------------------------------------

--
-- Table structure for table `Videos`
--

CREATE TABLE `Videos` (
  `PostID` int(25) NOT NULL,
  `Module` varchar(25) DEFAULT NULL,
  `Link` text DEFAULT NULL,
  `Descrip` text DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `UserID` int(25) DEFAULT NULL,
  `Year` varchar(25) DEFAULT NULL,
  `Faculty` varchar(25) DEFAULT NULL,
  `Statuses` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Videos`
--

INSERT INTO `Videos` (`PostID`, `Module`, `Link`, `Descrip`, `Notes`, `UserID`, `Year`, `Faculty`, `Statuses`) VALUES
(1273004659, 'Mathematics', 'https://www.youtube.com/embed/RUUekA1GEiI', 'Expontial Formulas and algebraic equations', 'hj', 121589, '1st', 'MICT', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `Watched`
--

CREATE TABLE `Watched` (
  `ID` int(25) NOT NULL,
  `PostID` int(25) NOT NULL,
  `UserID` int(25) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chec`
--
ALTER TABLE `chec`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `Videos`
--
ALTER TABLE `Videos`
  ADD PRIMARY KEY (`PostID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
