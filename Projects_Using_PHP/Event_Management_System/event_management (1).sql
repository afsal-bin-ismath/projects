-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 11:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event management`
--

-- --------------------------------------------------------

--
-- Table structure for table `advancecollectiondb`
--

CREATE TABLE `advancecollectiondb` (
  `seluser` varchar(100) NOT NULL,
  `seldate` varchar(100) NOT NULL,
  `Advanceamount` varchar(100) NOT NULL,
  `totalAmount` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookeventsdb`
--

CREATE TABLE `bookeventsdb` (
  `selectuser` varchar(100) NOT NULL,
  `selectevent` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `startingTime` time(6) NOT NULL,
  `EndingTime` time(6) NOT NULL,
  `selectnumberofpeoples` varchar(100) NOT NULL,
  `foodcatering` varchar(100) NOT NULL,
  `CateringAmount` varchar(100) NOT NULL,
  `photography` varchar(100) NOT NULL,
  `PhotographyAmount` varchar(100) NOT NULL,
  `Entertainment` varchar(100) NOT NULL,
  `EntertainmentAmount` varchar(100) NOT NULL,
  `goodybags` varchar(100) NOT NULL,
  `GoodyBagsAmount` varchar(100) NOT NULL,
  `totalamount` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookinguserdb`
--

CREATE TABLE `bookinguserdb` (
  `id` int(4) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `AadharNo` varchar(100) NOT NULL,
  `PhoneNo` varchar(100) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eventdb`
--

CREATE TABLE `eventdb` (
  `id` int(4) NOT NULL,
  `eventname` varchar(100) NOT NULL,
  `eventType` varchar(100) NOT NULL,
  `numberofpeople` varchar(100) NOT NULL,
  `floortype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventdb`
--

INSERT INTO `eventdb` (`id`, `eventname`, `eventType`, `numberofpeople`, `floortype`) VALUES
(1, 'wedding', 'WEDDING', ' 1500', 'First Floor - 500 sq ft');

-- --------------------------------------------------------

--
-- Table structure for table `registrationdb`
--

CREATE TABLE `registrationdb` (
  `id` int(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobileno` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `passWord` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrationdb`
--

INSERT INTO `registrationdb` (`id`, `name`, `mobileno`, `email`, `address`, `userName`, `passWord`) VALUES
(1, 'john', '1234567892', 'john@gmail.com', 'chennai', 'john123', 'john@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookinguserdb`
--
ALTER TABLE `bookinguserdb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventdb`
--
ALTER TABLE `eventdb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrationdb`
--
ALTER TABLE `registrationdb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookinguserdb`
--
ALTER TABLE `bookinguserdb`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventdb`
--
ALTER TABLE `eventdb`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registrationdb`
--
ALTER TABLE `registrationdb`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
