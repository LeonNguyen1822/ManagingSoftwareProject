-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 15, 2023 lúc 12:25 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `SalesDatabase`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `SaleRecords`
--

CREATE TABLE `SaleRecords` (
  `SaleID` int(11) NOT NULL,
  `ReceiptID` int(11) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `ItemName` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `ItemPrice` decimal(10,2) NOT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `SaleDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `SaleRecords`
--

INSERT INTO `SaleRecords` (`SaleID`, `ReceiptID`, `ItemId`, `ItemName`, `Quantity`, `ItemPrice`, `TotalPrice`, `SaleDate`) VALUES
(10, 1, 1, 'apple', 3, 10.00, 30.00, '2023-10-15 10:23:47'),
(11, 2, 2, 'orange', 10, 100.00, 1000.00, '2023-10-15 10:24:30');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `SaleRecords`
--
ALTER TABLE `SaleRecords`
  ADD PRIMARY KEY (`SaleID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `SaleRecords`
--
ALTER TABLE `SaleRecords`
  MODIFY `SaleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
