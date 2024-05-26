-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2024 at 03:03 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rgu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(255) NOT NULL,
  `Admin_Username` varchar(255) NOT NULL,
  `Admin_Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_Username`, `Admin_Password`) VALUES
(1, 'Admin', '$2y$10$7psQ3r27f.FfwXIGI2x13e/IGd5dB2OuVtqmY3E/Z2aWsxAFSOedO'),
(3, 'Admin', '$2y$10$eWX0rZGdYXOFIQD7wHnJhudlvgb6X/jbEp1MHXgQEkPpm9mJs4GZ.');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_ID` int(255) NOT NULL,
  `Item_Name` varchar(255) NOT NULL,
  `Item_Description` varchar(255) NOT NULL,
  `Item_Quantity` int(255) NOT NULL,
  `Item_Added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_ID`, `Item_Name`, `Item_Description`, `Item_Quantity`, `Item_Added`) VALUES
(2, 'Uniform OJT', 'Ab iure eu quas nequ', 931, '2024-01-14 00:00:00'),
(3, 'Uniform', 'Quis laboris eos eli', 374, '2024-01-14 00:00:00'),
(4, 'toga', 'dsvsvfv', 7, '2024-02-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_ID` int(255) NOT NULL,
  `Item_ID` int(255) NOT NULL,
  `Student_ID` int(255) NOT NULL,
  `Order_Description` varchar(255) NOT NULL,
  `Order_Quantity` int(255) NOT NULL,
  `Order_Status` varchar(255) NOT NULL,
  `Date_Ordered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_ID`, `Item_ID`, `Student_ID`, `Order_Description`, `Order_Quantity`, `Order_Status`, `Date_Ordered`) VALUES
(10, 2, 2, 'Shoulder:\r\nTorso:\r\nWaist:\r\nLegs:', 1, 'Paid', '2024-01-14 00:00:00'),
(11, 2, 4, 'Shoulder:\r\nTorso:\r\nWaist:\r\nLegs:', 1, 'Paid', '2024-01-14 00:00:00'),
(12, 2, 5, 'Shoulder:\r\nTorso:\r\nWaist:\r\nLegs:', 1, 'Not Paid', '2024-01-14 00:00:00'),
(13, 2, 3, 'Shoulder: 12cm\r\nTorso: 13cm\r\nWaist:14cm\r\nLegs: 18cm', 1, 'Paid', '2024-01-31 00:00:00'),
(14, 2, 3, 'Shoulder: 18cm\r\nTorso: 19cm\r\nWaist: 20cm\r\nLegs: 25cm', 5, 'Not Paid', '2024-01-31 00:00:00'),
(15, 2, 3, 'Shoulder: 19cm\r\nTorso: 19cm\r\nWaist: 19cm\r\nLegs: 19cm', 4, 'Not Paid', '2024-01-31 00:00:00'),
(16, 2, 6, 'Shoulder:\r\nTorso:\r\nWaist:\r\nLegs:', 1, 'Paid', '2024-02-01 00:00:00'),
(17, 2, 8, 'Shoulder:\r\nTorso:\r\nWaist:\r\nLegs:', 6, 'Paid', '2024-02-01 00:00:00'),
(18, 2, 9, 'Shoulder:123\r\nTorso:12312\r\nWaist:12\r\nLegs:123', 6, 'Not Paid', '2024-02-01 00:00:00'),
(19, 3, 10, 'Shoulder:55\r\nTorso:70\r\nWaist:70\r\nLegs:70', 2, 'Paid', '2024-02-08 00:00:00'),
(20, 2, 8, '123122524324', 1, 'Not Paid', '2024-05-02 00:00:00'),
(21, 2, 13, '2g2rgvevev2r', 1, 'Paid', '2024-05-10 00:00:00'),
(22, 2, 14, '124565334', 1, 'Not Paid', '2024-05-10 00:00:00'),
(23, 2, 15, 'weragfg\r\narsgeare', 1, 'Paid', '2024-05-10 00:00:00'),
(24, 2, 15, 'dsfhsdhsdfh', 1, 'Not Paid', '2024-05-10 00:00:00'),
(25, 2, 16, 'sdffdgddfegdfh', 1, 'Not Paid', '2024-05-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `Schools_ID` int(255) NOT NULL,
  `Schools_Name` varchar(255) NOT NULL,
  `Schools_CreatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`Schools_ID`, `Schools_Name`, `Schools_CreatedAt`) VALUES
(3, 'BSICT', '2024-01-14 00:00:00'),
(6, 'BSIT', '2024-01-31 00:00:00'),
(7, 'BEED', '2024-01-31 00:00:00'),
(8, 'BSHM', '2024-01-31 00:00:00'),
(9, 'HRST', '2024-02-01 00:00:00'),
(12, 'Bs Infotech', '2024-05-10 00:00:00'),
(13, 'BSITTTTT', '2024-05-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `Sections_ID` int(255) NOT NULL,
  `Year_ID` int(255) NOT NULL,
  `Sections_Name` varchar(255) NOT NULL,
  `Sections_CreatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`Sections_ID`, `Year_ID`, `Sections_Name`, `Sections_CreatedAt`) VALUES
(3, 2, 'A', '2024-01-14 00:00:00'),
(4, 2, 'B', '2024-01-14 00:00:00'),
(5, 2, 'C', '2024-01-14 00:00:00'),
(6, 1, 'B', '2024-01-31 00:00:00'),
(7, 1, 'C', '2024-01-31 00:00:00'),
(9, 1, 'D', '2024-01-31 00:00:00'),
(10, 1, 'A', '2024-02-01 00:00:00'),
(11, 5, 'A', '2024-02-08 00:00:00'),
(12, 5, 'B', '2024-02-08 00:00:00'),
(13, 5, 'C', '2024-02-08 00:00:00'),
(14, 7, 'A', '2024-05-10 00:00:00'),
(15, 7, 'B', '2024-05-10 00:00:00'),
(16, 9, 'A', '2024-05-10 00:00:00'),
(17, 9, 'B', '2024-05-10 00:00:00'),
(18, 11, 'A', '2024-05-10 00:00:00'),
(19, 11, 'B', '2024-05-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Student_ID` int(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Middlename` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Sections_ID` int(255) NOT NULL,
  `Date_Added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`Student_ID`, `Firstname`, `Middlename`, `Lastname`, `Gender`, `Sections_ID`, `Date_Added`) VALUES
(2, 'Hadassah', 'Aiko Graves', 'Cotton', 'Female', 3, '2024-01-14 00:00:00'),
(3, 'Arthur', 'Rina Foley', 'Ayala', 'Male', 2, '2024-01-14 00:00:00'),
(4, 'Nicole', 'Jin Russell', 'Shelton', 'Male', 3, '2024-01-14 00:00:00'),
(5, 'DANIEL', 'LOL', 'PADILLA', 'Male', 3, '2024-01-14 00:00:00'),
(6, 'arnold', 'espanola', 'novo', 'Male', 2, '2024-02-01 00:00:00'),
(8, 'eeee', 'rrrrr', 'tttttt', 'Male', 6, '2024-02-01 00:00:00'),
(9, 'Justin', 'Z', 'Verzosa', 'Male', 3, '2024-02-01 00:00:00'),
(10, '1wc', '2efe2f', '2ferc', 'Male', 11, '2024-02-08 00:00:00'),
(11, 'Eeeeeee', 'OhYeah', 'T35y34y', 'Male', 11, '2024-02-08 00:00:00'),
(12, 'James', 'Iiiii', 'Enojo', 'Male', 14, '2024-05-10 00:00:00'),
(13, 'Menard', 'Aaaaaa', 'Acana', 'Male', 17, '2024-05-10 00:00:00'),
(14, 'Arnold', 'Eeee', 'Novo', 'Male', 17, '2024-05-10 00:00:00'),
(15, 'Jomar', 'Iywgdcuye', 'Casianan', 'Male', 18, '2024-05-10 00:00:00'),
(16, 'Arnold', 'Sadfsadf', 'U,gsadv', 'Male', 18, '2024-05-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `Year_ID` int(255) NOT NULL,
  `Schools_ID` int(255) NOT NULL,
  `Year` int(255) NOT NULL,
  `Year_CreatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`Year_ID`, `Schools_ID`, `Year`, `Year_CreatedAt`) VALUES
(1, 3, 3, '2024-01-14 00:00:00'),
(2, 3, 1, '2024-01-14 00:00:00'),
(4, 1, 3, '2024-01-14 00:00:00'),
(5, 3, 2, '2024-01-14 00:00:00'),
(6, 3, 4, '2024-01-14 00:00:00'),
(7, 10, 1, '2024-05-10 00:00:00'),
(8, 10, 2, '2024-05-10 00:00:00'),
(9, 11, 1, '2024-05-10 00:00:00'),
(10, 11, 2, '2024-05-10 00:00:00'),
(11, 12, 1, '2024-05-10 00:00:00'),
(12, 12, 2, '2024-05-10 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`Schools_ID`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`Sections_ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`Student_ID`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`Year_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `Schools_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `Sections_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `Student_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `Year_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
