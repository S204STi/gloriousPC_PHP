-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2016 at 06:19 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `GloriousDb`
--
CREATE DATABASE IF NOT EXISTS `GloriousDb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `GloriousDb`;

-- --------------------------------------------------------

--
-- Table structure for table `AppUser`
--

DROP TABLE IF EXISTS `AppUser`;
CREATE TABLE `AppUser` (
  `AppUserId` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `IsAdmin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `AppUser`:
--

--
-- Dumping data for table `AppUser`
--

INSERT INTO `AppUser` (`AppUserId`, `UserName`, `Password`, `IsAdmin`) VALUES
(11, 'NewCustomer', '618582454714f1dcb0b27a41cc861759f1c703d6', 0),
(13, 'admin', '70cdd075f3610013ccc7f4fffcae5ebaa2d2de22', 1),
(14, 'LuckyDude556', '9a03c97bce7a43cfc3ea39f81208b4bee6f65c07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
CREATE TABLE `Category` (
  `CategoryId` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `Category`:
--

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`CategoryId`, `CategoryName`) VALUES
(2, 'Keyboards'),
(5, 'Mice'),
(1, 'Video Cards');

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

DROP TABLE IF EXISTS `Customer`;
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
-- RELATIONS FOR TABLE `Customer`:
--   `UserId`
--       `User` -> `Id`
--

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`CustomerId`, `FirstName`, `LastName`, `Address1`, `Address2`, `City`, `State`, `Zip`, `Email`, `AppUserId`) VALUES
(5, 'John', 'Carmack', '29837 W 3rd st. </input>', '', 'greeley'';', 'CA', '80444-4444', 'adsadf@adfasf.com', 11),
(6, 'Broseph <h1>', 'Mcgee''; Select * from Customers;', 'asdlkjalkjasoof2039u093joaij0ojo;ij; kja;lsd', '', 'oaijsdfoij', 'CA', '83888', 'alkdsjfalksj@slakjd.com', 12),
(7, 'Joe', 'Carmack', '48499 W 83rd Ave.', '', 'Greeley', 'CO', '80634', 'aalkdj@alkdj.com', 14);

-- --------------------------------------------------------

--
-- Table structure for table `OrderLine`
--

DROP TABLE IF EXISTS `OrderLine`;
CREATE TABLE `OrderLine` (
  `Quantity` int(11) NOT NULL,
  `PriceEach` double NOT NULL,
  `OrderSummaryId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `OrderLine`:
--

-- --------------------------------------------------------

--
-- Table structure for table `OrderSummary`
--

DROP TABLE IF EXISTS `OrderSummary`;
CREATE TABLE `OrderSummary` (
  `OrderSummaryId` int(11) NOT NULL,
  `OrderDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ShipTo` varchar(8000) NOT NULL,
  `CustomerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `OrderSummary`:
--

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

DROP TABLE IF EXISTS `Product`;
CREATE TABLE `Product` (
  `ProductId` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Description` varchar(8000) NOT NULL,
  `Stock` int(11) NOT NULL,
  `PriceEach` double NOT NULL,
  `ImagePath` varchar(255) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `IsFeatured` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `Product`:
--

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`ProductId`, `ProductName`, `Description`, `Stock`, `PriceEach`, `ImagePath`, `CategoryId`, `IsFeatured`) VALUES
(1, 'EVGA GTX 1070 FTW', 'In light of recent events concerning the EVGA 1070 FTW, we are having a fire sale! The GTX 1070 FTW is literally the hottest card on the market. No joke, they literally catch fire.', 4, 450.99, '1070ftw.jpg', 1, 1),
(2, 'Nvidia GTX Titan X (Pascal)', 'The single most powerful GPU on the market. Be as glorious as you can be with 12 GB GDDR5 and 3584 CUDA cores.', 0, 1239.99, 'titanx.jpg', 1, 0),
(3, 'Vortex Pok3r (Browns)', 'As the most popular keyboard among enthusiasts, the Vortex Pok3r delivers superior build quality. This model comes equipped with Cherry MX Brown switches, which have a tactile bump but no audible click. The 60% layout gives you tons of room for CS:GO flick-shots.', 3, 99.99, 'pok3r.jpg', 2, 1),
(5, 'Razer Deathadder', 'Up your Battlefield 1 game with flick shots and no scopes. \r\n"You talk too much. Give me your money. Now." -- Min-Liang Tan CEO, Razer', 500, 69.99, 'razer-deathadder.png', 4, 1);

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
  MODIFY `AppUserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `OrderSummary`
--
ALTER TABLE `OrderSummary`
  MODIFY `OrderSummaryId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;



# Privileges for `gloriousDbUser`@`%`

GRANT USAGE ON *.* TO 'gloriousDbUser'@'%' IDENTIFIED BY PASSWORD '*9AF046706A7014A24A26593768EBD930CABC3220';


# Privileges for `gloriousDbUser`@`localhost`

GRANT USAGE ON *.* TO 'gloriousDbUser'@'localhost' IDENTIFIED BY PASSWORD '*9AF046706A7014A24A26593768EBD930CABC3220';

GRANT SELECT, INSERT, UPDATE, DELETE ON `GloriousDb`.* TO 'gloriousDbUser'@'localhost';
