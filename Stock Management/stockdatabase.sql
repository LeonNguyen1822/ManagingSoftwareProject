-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2023 at 07:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `StockID` varchar(11) NOT NULL,
  `StockName` varchar(255) DEFAULT NULL,
  `NumOfStock` int(11) DEFAULT NULL,
  `MinStock` int(11) DEFAULT NULL,
  `MaxStock` int(11) DEFAULT NULL,
  `StockStatus` varchar(50) DEFAULT NULL,
  `Delivery` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`StockID`, `StockName`, `NumOfStock`, `MinStock`, `MaxStock`, `StockStatus`, `Delivery`) VALUES
('001', 'Apples', 15, 25, 200, 'Low Stock', NULL),
('002', 'Watermelons', 5, 15, 100, 'Low Stock', NULL),
('003', 'Bananas', 30, 30, 200, 'Normal', NULL),
('004', 'Lemons', 100, 20, 80, 'High Stock', NULL),
('005', 'Oranges', 50, 25, 100, 'Normal', NULL),
('006', 'Pineapples', 30, 15, 50, 'Normal', NULL),
('007', 'Lettuce', 2, 30, 100, 'Low Stock', NULL);

--
-- Triggers `stock`
--
DELIMITER $$
CREATE TRIGGER `UpdateStockStatus` BEFORE UPDATE ON `stock` FOR EACH ROW BEGIN
    IF NEW.NumOfStock < NEW.MinStock THEN
        SET NEW.StockStatus = 'Low Stock';
    ELSEIF NEW.NumOfStock > NEW.MaxStock THEN
        SET NEW.StockStatus = 'High Stock';
    ELSE
        SET NEW.StockStatus = 'Normal';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateStockStatusOnAdd` BEFORE INSERT ON `stock` FOR EACH ROW BEGIN
    IF NEW.NumOfStock < NEW.MinStock THEN
        SET NEW.StockStatus = 'Low Stock';
    ELSEIF NEW.NumOfStock > NEW.MaxStock THEN
        SET NEW.StockStatus = 'High Stock';
    ELSE
        SET NEW.StockStatus = 'Normal';
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`StockID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
