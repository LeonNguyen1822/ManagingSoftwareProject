-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2023 at 05:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salesdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `ReceiptID` text NOT NULL,
  `ItemID` text NOT NULL,
  `ItemName` text NOT NULL,
  `ItemPrice` float NOT NULL,
  `Quantity` int(11) NOT NULL,
  `TotalPrice` float NOT NULL,
  `DateofSale` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`ReceiptID`, `ItemID`, `ItemName`, `ItemPrice`, `Quantity`, `TotalPrice`, `DateofSale`) VALUES
('RC345', 'I780', 'Apples', 4, 3, 12, '2023-09-09'),
('RC423', 'I765', 'Oranges', 3, 3, 9, '2023-09-09'),
('RC345', 'I700', 'Bananas', 3, 3, 9, '2023-09-09'),
('RC345', 'I781', 'Watermelons', 6, 3, 18, '2023-09-09'),
('RC345', 'I785', 'Lemons', 2, 2, 4, '2023-09-09');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
