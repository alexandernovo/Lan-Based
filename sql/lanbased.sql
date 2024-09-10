-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 02:32 PM
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
-- Database: `lanbased`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(255) NOT NULL,
  `class_id` int(255) NOT NULL,
  `activity_title` varchar(255) NOT NULL,
  `activity_description` longtext NOT NULL,
  `isDueDate` int(2) NOT NULL,
  `dueDate` datetime NOT NULL,
  `total_points` int(11) NOT NULL,
  `activity_type` varchar(10) NOT NULL,
  `activity_dateAdded` datetime NOT NULL,
  `activity_status` int(2) NOT NULL,
  `question_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `class_id` int(255) NOT NULL,
  `announcement_title` varchar(255) NOT NULL,
  `announcement_description` varchar(255) NOT NULL,
  `announcement_type` varchar(255) NOT NULL,
  `announcement_date` datetime NOT NULL,
  `announcement_assID` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive_class`
--

CREATE TABLE `archive_class` (
  `archive_class_id` int(255) NOT NULL,
  `class_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `attachment_id` int(255) NOT NULL,
  `activity_id` int(255) NOT NULL,
  `attachment_file` varchar(255) NOT NULL,
  `attachment_filetype` varchar(255) NOT NULL,
  `attachment_name` varchar(255) NOT NULL,
  `attachment_type` varchar(20) NOT NULL,
  `attachment_addeddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attachments`
--
-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `class_image` varchar(255) DEFAULT NULL,
  `classname` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `class_status` int(2) NOT NULL,
  `classaddeddate` datetime NOT NULL,
  `classcode` varchar(255) NOT NULL,
  `schedclass_lecture` varchar(255) NOT NULL,
  `schedclass_lab` varchar(255) NOT NULL,
  `room_lab` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `classroom_lecture` varchar(255) NOT NULL,
  `classroom_lab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_people`
--

CREATE TABLE `class_people` (
  `class_people_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `class_id` int(255) NOT NULL,
  `added_date` datetime NOT NULL,
  `class_people_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_people`
--


-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_id` int(255) NOT NULL,
  `class_id` int(255) NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `material_addedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--



-- --------------------------------------------------------

--
-- Table structure for table `material_attachment`
--

CREATE TABLE `material_attachment` (
  `material_attachment_id` int(255) NOT NULL,
  `material_id` int(255) NOT NULL,
  `material_fileName` varchar(255) NOT NULL,
  `material_file` varchar(255) NOT NULL,
  `material_type` varchar(255) NOT NULL,
  `material_dateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material_attachment`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(255) NOT NULL,
  `notification_datetime` datetime DEFAULT NULL,
  `notification_description` longtext DEFAULT NULL,
  `notification_title` varchar(255) DEFAULT NULL,
  `notification_type` varchar(255) DEFAULT NULL,
  `included_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity_id` int(255) DEFAULT NULL,
  `is_read` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--
-- --------------------------------------------------------

--
-- Table structure for table `saved_file`
--

CREATE TABLE `saved_file` (
  `saved_file_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `attachment_id` int(255) NOT NULL,
  `attachment_type` varchar(10) NOT NULL,
  `saved_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saved_file`
--


-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `submission_id` int(255) NOT NULL,
  `activity_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `submission_index` int(255) NOT NULL,
  `submission_status` int(2) NOT NULL,
  `submission_score` int(255) DEFAULT NULL,
  `submission_remarks` varchar(255) NOT NULL,
  `submission_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submission`
--


-- --------------------------------------------------------

--
-- Table structure for table `submission_file`
--

CREATE TABLE `submission_file` (
  `submission_file_id` int(255) NOT NULL,
  `submission_id` int(255) NOT NULL,
  `submission_file` varchar(255) NOT NULL,
  `submission_fileName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submission_file`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `usertype` int(2) NOT NULL,
  `userstatus` int(2) NOT NULL,
  `registereddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `middlename`, `lastname`, `username`, `email`, `password`, `profile`, `usertype`, `userstatus`, `registereddate`) VALUES
(1, 'Mark', 'Z', 'Zuckerberg', 'admin', 'admin@gmail.com', '$2y$10$rO0EHoVTpMpVuGIDgAdl4Oa/DyEAVHgPdPBNHvlVkOJS1ae9grSM.', '', 2, 1, '2024-05-26 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `archive_class`
--
ALTER TABLE `archive_class`
  ADD PRIMARY KEY (`archive_class_id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`attachment_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `class_people`
--
ALTER TABLE `class_people`
  ADD PRIMARY KEY (`class_people_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `material_attachment`
--
ALTER TABLE `material_attachment`
  ADD PRIMARY KEY (`material_attachment_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `saved_file`
--
ALTER TABLE `saved_file`
  ADD PRIMARY KEY (`saved_file_id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `submission_file`
--
ALTER TABLE `submission_file`
  ADD PRIMARY KEY (`submission_file_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `archive_class`
--
ALTER TABLE `archive_class`
  MODIFY `archive_class_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `attachment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class_people`
--
ALTER TABLE `class_people`
  MODIFY `class_people_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `material_attachment`
--
ALTER TABLE `material_attachment`
  MODIFY `material_attachment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `saved_file`
--
ALTER TABLE `saved_file`
  MODIFY `saved_file_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `submission_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `submission_file`
--
ALTER TABLE `submission_file`
  MODIFY `submission_file_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_people`
--
ALTER TABLE `class_people`
  ADD CONSTRAINT `class_people_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_people_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
