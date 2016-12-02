-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2016 at 09:01 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GloriousDb`
--

CREATE DATABASE IF NOT EXISTS `GloriousDb`;
USE `GloriousDb`;
-- --------------------------------------------------------

--
-- Table structure for table `AppUser`
--

CREATE TABLE `AppUser` (
  `AppUserId` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `IsAdmin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AppUser`
--

INSERT INTO `AppUser` (`AppUserId`, `UserName`, `Password`, `IsAdmin`) VALUES
(11, 'NewCustomer', '618582454714f1dcb0b27a41cc861759f1c703d6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `CategoryId` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`CategoryId`, `CategoryName`) VALUES
(2, 'Keyboards'),
(3, 'Mice'),
(1, 'Video Cards');

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `CustomerId` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Address1` varchar(100) NOT NULL,
  `Address2` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `AppUserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`CustomerId`, `FirstName`, `LastName`, `Address1`, `Address2`, `City`, `State`, `Zip`, `Email`, `AppUserId`) VALUES
(5, 'Joe', 'Carmack', '29837 W 3rd st. </input>', '', 'greeley'';', 'CA', '80444-4444', 'adsadf@adfasf.com', 11);

-- --------------------------------------------------------

--
-- Table structure for table `OrderLine`
--

CREATE TABLE `OrderLine` (
  `Quantity` int(11) NOT NULL,
  `PriceEach` double NOT NULL,
  `OrderSummaryId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `OrderSummary`
--

CREATE TABLE `OrderSummary` (
  `OrderSummaryId` int(11) NOT NULL,
  `OrderDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ShipTo` varchar(8000) NOT NULL,
  `CustomerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `ProductId` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Description` varchar(8000) NOT NULL,
  `Stock` int(11) NOT NULL,
  `PriceEach` double NOT NULL,
  `ImagePath` varchar(8000) NOT NULL,
  `CategoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`ProductId`, `ProductName`, `Description`, `Stock`, `PriceEach`, `ImagePath`, `CategoryId`) VALUES
(1, 'EVGA GTX 1070 FTW', 'In light of recent events concerning the EVGA 1070 FTW, we are having a fire sale! The GTX 1070 FTW is literally the hottest card on the market. No joke, they literally catch fire.', 2, 450.99, '1070ftw.jpg', 1),
(2, 'Nvidia GTX Titan X (Pascal)', 'The single most powerful GPU on the market. Be as glorious as you can be with 12 GB GDDR5 and 3584 CUDA cores.', 0, 1239.99, 'titanx.jpg', 1),
(3, 'Vortex Pok3r (Browns)', 'As the most popular keyboard among enthusiasts, the Vortex Pok3r delivers superior build quality. This model comes equipped with Cherry MX Brown switches, which have a tactile bump but no audible click. The 60% layout gives you tons of room for CS:GO flick-shots.', 3, 99.99, 'pok3r.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AppUser`
--
ALTER TABLE `AppUser`
  ADD PRIMARY KEY (`AppUserId`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `UserName_2` (`UserName`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`CategoryId`),
  ADD UNIQUE KEY `Name` (`CategoryName`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`CustomerId`);

--
-- Indexes for table `OrderLine`
--
ALTER TABLE `OrderLine`
  ADD PRIMARY KEY (`OrderSummaryId`,`ProductId`);

--
-- Indexes for table `OrderSummary`
--
ALTER TABLE `OrderSummary`
  ADD PRIMARY KEY (`OrderSummaryId`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`ProductId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AppUser`
--
ALTER TABLE `AppUser`
  MODIFY `AppUserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `OrderSummary`
--
ALTER TABLE `OrderSummary`
  MODIFY `OrderSummaryId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



# Privileges for `gloriousDbUser`@`%`

GRANT USAGE ON *.* TO 'gloriousDbUser'@'%' IDENTIFIED BY PASSWORD '*9AF046706A7014A24A26593768EBD930CABC3220';


# Privileges for `gloriousDbUser`@`localhost`

GRANT USAGE ON *.* TO 'gloriousDbUser'@'localhost' IDENTIFIED BY PASSWORD '*9AF046706A7014A24A26593768EBD930CABC3220';

GRANT SELECT, INSERT, UPDATE, DELETE ON `GloriousDb`.* TO 'gloriousDbUser'@'localhost';
