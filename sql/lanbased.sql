-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 02:15 PM
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
--

INSERT INTO `activity` (`activity_id`, `class_id`, `activity_title`, `activity_description`, `isDueDate`, `dueDate`, `total_points`, `activity_type`, `activity_dateAdded`, `activity_status`, `question_type`) VALUES
(17, 4, 'Introduction to Web Development', 'In this activity, participants will learn the basics of web development, including HTML, CSS, and JavaScript. The session will cover how to structure web pages, style them effectively, and add interactivity. By the end of the workshop, participants will have created their own simple website.', 1, '2024-06-15 21:18:00', 100, 'activity', '2024-06-07 00:00:00', 1, NULL),
(18, 4, 'Quis doloremque sed ', 'Nisi aliquip enim es', 1, '2024-07-21 08:03:00', 48, 'question', '2024-06-12 00:00:00', 1, 'Short Answer'),
(19, 4, 'Necessitatibus inven', 'Laudantium porro id', 1, '1994-05-20 00:59:00', 8, 'activity', '2024-08-30 00:00:00', 1, NULL),
(20, 4, 'Doloribus officiis i', 'Esse ut cillum aliqu', 1, '2017-09-08 08:30:00', 89, 'activity', '2024-08-30 00:00:00', 1, NULL),
(21, 4, 'Excepturi exercitati', 'Inventore quasi anim', 1, '1978-10-11 23:17:00', 78, 'activity', '2024-08-30 00:00:00', 1, NULL),
(22, 4, 'Excepturi exercitati', 'Inventore quasi anim', 1, '1978-10-11 23:17:00', 78, 'activity', '2024-08-30 00:00:00', 1, NULL),
(23, 4, 'Nisi dicta vel rem e', 'Ea quas facere unde ', 1, '2018-04-09 15:57:00', 84, 'activity', '2024-08-30 00:00:00', 1, NULL),
(24, 4, 'Nisi dicta vel rem e', 'Ea quas facere unde ', 1, '2018-04-09 15:57:00', 84, 'activity', '2024-08-30 00:00:00', 1, NULL),
(25, 4, 'Vitae sit illo ut e', 'Assumenda quia volup', 1, '1978-09-16 01:59:00', 93, 'activity', '2024-08-30 00:00:00', 1, NULL),
(26, 4, 'Enim duis dolores no', 'Doloremque eaque bla', 1, '2015-05-13 07:38:00', 87, 'activity', '2024-08-30 00:00:00', 1, NULL),
(27, 4, 'Commodi beatae hic i', 'Natus minus non esse', 1, '2002-08-04 08:34:00', 64, 'activity', '2024-08-30 00:00:00', 1, NULL),
(28, 4, 'Ex minus ex porro do', 'Culpa quasi qui mol', 1, '2009-01-10 08:38:00', 24, 'activity', '2024-08-30 00:00:00', 1, NULL),
(29, 4, 'Maiores similique ex', 'Voluptate perferendi', 1, '2007-03-13 09:28:00', 22, 'activity', '2024-08-30 00:00:00', 1, NULL),
(30, 4, 'Consequatur ullamco', 'Vitae non dignissimo', 1, '2020-03-21 23:02:00', 6, 'activity', '2024-08-30 00:00:00', 1, NULL),
(31, 4, 'Nostrud cum amet no', 'Modi odio rem conseq', 1, '1989-07-15 15:57:00', 41, 'activity', '2024-08-30 00:00:00', 1, NULL),
(32, 4, 'Consequat Eius cupi', 'Delectus voluptas s', 1, '1972-03-10 16:14:00', 77, 'activity', '2024-08-30 00:00:00', 1, NULL),
(33, 6, 'Quaerat debitis dese', 'Distinctio Facilis ', 1, '1998-06-14 03:43:00', 45, 'question', '2024-09-02 00:00:00', 1, 'Multiple Choice'),
(34, 6, 'Vitae repudiandae pa', 'Velit ad aut tempore', 1, '1996-06-08 02:03:00', 5, 'question', '2024-09-02 00:00:00', 1, 'Multiple Choice'),
(35, 6, 'Et at iusto dolorem ', 'Autem quo accusamus ', 1, '1974-07-25 19:58:00', 32, 'question', '2024-09-02 00:00:00', 1, 'Short Answer'),
(36, 6, 'Qui sunt exercitatio', 'Nostrud maxime ut cu', 1, '1993-11-01 00:31:00', 52, 'question', '2024-09-02 00:00:00', 1, 'Short Answer'),
(37, 6, 'Culpa adipisci rem e', 'Reiciendis corrupti', 1, '2010-08-05 00:32:00', 84, 'activity', '2024-09-02 00:00:00', 1, NULL),
(38, 6, 'Nesciunt odio deser', 'Nihil non illo accus', 1, '2014-09-15 06:13:00', 71, 'activity', '2024-09-04 00:00:00', 1, NULL),
(39, 6, 'Quasi esse pariatur', 'Ipsum mollit totam ', 1, '1981-07-09 16:52:00', 62, 'activity', '2024-09-04 00:00:00', 1, NULL),
(40, 6, 'Laborum Temporibus ', 'Et voluptatem Porro', 1, '1998-11-24 06:37:00', 69, 'activity', '2024-09-10 00:00:00', 1, NULL);

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

INSERT INTO `announcement` (`announcement_id`, `user_id`, `class_id`, `announcement_title`, `announcement_description`, `announcement_type`, `announcement_date`, `announcement_assID`) VALUES
(25, 1, 4, 'asdasd', 'asdasd', 'stream', '2024-06-23 05:39:53', NULL),
(26, 1, 4, 'sadasd', 'asdasd', 'stream', '2024-06-23 06:33:39', NULL),
(27, 1, 4, 'sadasd', 'asdasd', 'stream', '2024-06-23 07:33:07', NULL),
(28, 1, 4, 'sad', 'asd', 'stream', '2024-06-23 07:56:51', NULL),
(29, 1, 4, 'Hey', 'hey', 'stream', '2024-07-29 09:06:38', NULL),
(30, 1, 4, 'mga mother fuckers', 'mga mother fuckers', 'stream', '2024-07-29 09:06:51', NULL),
(31, 1, 4, 'Ruy Agi', 'Ruy Agi', 'stream', '2024-07-29 09:07:05', NULL),
(32, 1, 4, 'sadasd', 'asdasd', 'stream', '2024-08-30 08:38:46', NULL),
(33, 1, 4, 'sadasd', 'asdasd', 'stream', '2024-08-30 08:39:01', NULL);

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

INSERT INTO `attachments` (`attachment_id`, `activity_id`, `attachment_file`, `attachment_filetype`, `attachment_name`, `attachment_type`, `attachment_addeddate`) VALUES
(46, 17, 'public/assets/attachments/1876070561666307e8e7d744.69139285.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'ABSTRACT.docx', 'attachments', '2024-06-07 09:15:20'),
(47, 17, 'public/assets/attachments/196035958666307e8eb5b24.50677775.png', 'image/png', 'typing test.png', 'attachments', '2024-06-07 09:15:20'),
(48, 18, 'public/assets/attachments/1640983202666929e91045a8.10555995.png', 'image/png', 'jlahjslhdkgasgkjd.png', 'attachments', '2024-06-12 12:54:01'),
(49, 18, 'public/assets/attachments/1388647491666929e9148047.12864514.png', 'image/png', 'sadasd.png', 'attachments', '2024-06-12 12:54:01'),
(50, 19, 'public/assets/attachments/40580094566d1c4008b2b73.47466638.jpeg', 'image/jpeg', 'download (1).jpeg', 'attachments', '2024-08-30 09:07:12'),
(51, 20, 'public/assets/attachments/65469828266d1c4456affd9.73161041.png', 'image/png', 'jlahjslhdkgasgkjd.png', 'attachments', '2024-08-30 09:08:21'),
(52, 21, 'public/assets/attachments/195279666566d1c4959921f2.64044117.png', 'image/png', 'websocket.png', 'attachments', '2024-08-30 09:09:41'),
(53, 22, 'public/assets/attachments/199840161366d1c49bb7c446.18942355.png', 'image/png', 'websocket.png', 'attachments', '2024-08-30 09:09:47'),
(54, 23, 'public/assets/attachments/197368150566d1c54e432d54.17955875.png', 'image/png', 'jlahjslhdkgasgkjd.png', 'attachments', '2024-08-30 09:12:46'),
(55, 24, 'public/assets/attachments/198049894866d1c5f7473ef3.21319670.png', 'image/png', 'jlahjslhdkgasgkjd.png', 'attachments', '2024-08-30 09:15:35'),
(56, 25, 'public/assets/attachments/182583053866d1c60b2dd770.04798712.png', 'image/png', 'asdasdasdsd.png', 'attachments', '2024-08-30 09:15:55'),
(57, 26, 'public/assets/attachments/82666140266d1c65c3a51e9.31348815.png', 'image/png', 'asdasdasdsd.png', 'attachments', '2024-08-30 09:17:16'),
(58, 27, 'public/assets/attachments/70508393066d1c6fce72378.77568317.png', 'image/png', 'websocket.png', 'attachments', '2024-08-30 09:19:56'),
(59, 28, 'public/assets/attachments/62226179566d1c7433ec776.86672761.png', 'image/png', 'sadasd.png', 'attachments', '2024-08-30 09:21:07'),
(60, 29, 'public/assets/attachments/60892579466d1c7b5015661.01067432.png', 'image/png', 'sadasdasdasd.png', 'attachments', '2024-08-30 09:23:01'),
(61, 30, 'public/assets/attachments/213016481066d1c94052e248.64194285.jpeg', 'image/jpeg', 'OIP.jpeg', 'attachments', '2024-08-30 09:29:36'),
(62, 31, 'public/assets/attachments/185398334166d1cebf6c2046.32755157.png', 'image/png', 'asdasdasdsd.png', 'attachments', '2024-08-30 09:53:03'),
(63, 32, 'public/assets/attachments/154024204666d1cefed20a37.37248168.png', 'image/png', 'asdasdasdsd.png', 'attachments', '2024-08-30 09:54:06'),
(64, 33, 'public/assets/attachments/84747929566d5a24c7d2ef0.76111042.jpeg', 'image/jpeg', 'adlawon3.jpeg', 'attachments', '2024-09-02 07:32:28'),
(65, 34, 'public/assets/attachments/74020078166d5a2ca714fc3.27651312.txt', 'text/plain', 'php-socket.txt', 'attachments', '2024-09-02 07:34:34'),
(66, 35, 'public/assets/attachments/1663884366d5a319d91392.75094290.jpg', 'image/jpeg', 'att.qN0i68w1KIyy28kOlJ_LluI6BdzOOZAipckf9TNy0Ak.jpg', 'attachments', '2024-09-02 07:35:53'),
(67, 36, 'public/assets/attachments/98469520966d5a3b4705e88.08056933.jpeg', 'image/jpeg', 'images.jpeg', 'attachments', '2024-09-02 07:38:28'),
(68, 37, 'public/assets/attachments/95472680166d5a3d08d8177.27529033.jpeg', 'image/jpeg', 'images.jpeg', 'attachments', '2024-09-02 07:38:56'),
(69, 38, 'public/assets/attachments/129737318966d85ae70eaac5.67965640.jpg', 'image/jpeg', 'att.qN0i68w1KIyy28kOlJ_LluI6BdzOOZAipckf9TNy0Ak.jpg', 'attachments', '2024-09-04 09:04:39'),
(70, 39, 'public/assets/attachments/95841989866d85b14ba2918.98405326.jpeg', 'image/jpeg', 'images.jpeg', 'attachments', '2024-09-04 09:05:24'),
(71, 40, 'public/assets/attachments/68634265266e02d201161b1.29627108.jpeg', 'image/jpeg', 'images.jpeg', 'attachments', '2024-09-10 07:27:28');

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

INSERT INTO `class` (`class_id`, `user_id`, `class_image`, `classname`, `section`, `room`, `subject`, `class_status`, `classaddeddate`, `classcode`, `schedclass_lecture`, `schedclass_lab`, `room_lab`, `course`, `program`, `classroom_lecture`, `classroom_lab`) VALUES
(6, 1, '', 'IT-138', '3-A', 'Sed non optio volup', 'Ipsam perferendis pa', 1, '2024-09-04 00:00:00', 'RFPFaYUi9', 'Consequuntur officia', 'Dolore amet id assu', 'Aute nihil sed ratio', 'Veritatis corrupti ', 'Voluptatem quia temp', '', ''),
(7, 1, '', 'Joel Haney', 'Dicta deserunt volup', 'Sapiente voluptas fa', 'Sed et iste officia ', 1, '2024-09-11 00:00:00', '0shejJ6q1', 'Cum pariatur Est fu', 'Rem amet velit tem', '', 'Commodo maxime magna', 'Reiciendis eos qui ', 'Sapiente voluptas fa', ''),
(8, 1, 'public/assets/class_image/1206974966fbd96e41e5c6.32227029.jpg', '', '4-A', 'Consequatur Volupta', '', 1, '2024-10-01 00:00:00', 'WgQ8eUvpB', 'Laboriosam consequa', 'Inventore labore qua', '', 'BSIT', 'Autem corrupti assu', 'Consequatur Volupta', '');

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

INSERT INTO `class_people` (`class_people_id`, `user_id`, `class_id`, `added_date`, `class_people_status`) VALUES
(95, 9, 6, '2024-09-10 08:09:27', 1),
(97, 6, 7, '2024-10-01 07:28:35', 1);

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

INSERT INTO `material` (`material_id`, `class_id`, `material_name`, `material_addedDate`) VALUES
(8, 4, 'Hatdogs', '2024-06-18 08:15:04'),
(9, 4, 'Hatdogs', '2024-07-02 08:54:14');

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

INSERT INTO `material_attachment` (`material_attachment_id`, `material_id`, `material_fileName`, `material_file`, `material_type`, `material_dateAdded`) VALUES
(16, 8, 'jlahjslhdkgasgkjd.png', 'public/assets/material/105604901766717a48a643c4.19556503.png', 'image/png', '2024-06-18 08:15:04'),
(17, 9, 'jlahjslhdkgasgkjd.png', 'public/assets/material/8614827206683f876609fa7.03804169.png', 'image/png', '2024-07-02 08:54:14'),
(18, 9, 'sadasd.png', 'public/assets/material/7351562936683f87662aa79.07793328.png', 'image/png', '2024-07-02 08:54:14'),
(19, 9, 'sadasdasdasd.png', 'public/assets/material/16405981286683f876640bf4.47605858.png', 'image/png', '2024-07-02 08:54:14');

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

INSERT INTO `notifications` (`notification_id`, `notification_datetime`, `notification_description`, `notification_title`, `notification_type`, `included_id`, `user_id`, `activity_id`, `is_read`) VALUES
(13, '2024-09-10 00:00:00', 'Lynn Salas has joined IT-138(3-A)', 'Joined Class', 'join', 6, 1, NULL, 0),
(14, '2024-10-01 00:00:00', 'Aimees Hutchinson has joined Joel Haney(Dicta deserunt volup)', 'Joined Class', 'join', 7, 1, NULL, 0),
(15, '2024-10-01 00:00:00', 'Aimees Hutchinson has joined Joel Haney(Dicta deserunt volup)', 'Joined Class', 'join', 7, 1, NULL, 0);

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

INSERT INTO `saved_file` (`saved_file_id`, `user_id`, `attachment_id`, `attachment_type`, `saved_datetime`) VALUES
(3, 6, 16, 'material', '2024-07-02 08:46:12'),
(4, 6, 17, 'material', '2024-07-02 08:54:28'),
(7, 9, 16, 'material', '2024-08-24 08:21:11');

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

INSERT INTO `submission` (`submission_id`, `activity_id`, `user_id`, `submission_index`, `submission_status`, `submission_score`, `submission_remarks`, `submission_date`) VALUES
(16, 17, 6, 1, 3, 50, '', '2024-07-14 01:34:01'),
(17, 18, 6, 1, 1, NULL, '', '2024-07-15 08:35:03');

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

INSERT INTO `submission_file` (`submission_file_id`, `submission_id`, `submission_file`, `submission_fileName`) VALUES
(16, 16, 'public/assets/submissions/129898196266936349b27ef4.42052165.png', 'jlahjslhdkgasgkjd.png'),
(17, 16, 'public/assets/submissions/109597345166936349b5bc36.62164737.png', 'sadasd.png'),
(18, 17, 'public/assets/submissions/146030720669517778d1d18.89057714.png', 'jlahjslhdkgasgkjd.png'),
(19, 17, 'public/assets/submissions/336181094669517778ed046.77951747.png', 'sadasd.png');

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
(1, 'Mark', 'Z', 'Zuckerberg', 'admin', 'admin@gmail.com', '$2y$10$rO0EHoVTpMpVuGIDgAdl4Oa/DyEAVHgPdPBNHvlVkOJS1ae9grSM.', '', 1, 1, '2024-05-26 00:00:00'),
(6, 'Aimees', 'Brynne Guy', 'Hutchinson', 'linizulyka', 'kumof@mailinator.com', '$2y$10$ttSw.adUml5nSE2L1hCpIuwcMHb41Be3l0gVCOiAWKLZ47OfpLkG6', '', 0, 1, '2024-06-07 00:00:00'),
(7, 'Nicholas', 'Charles', 'Monroe', 'xynug123', 'gijygu@mailinator.com', 'xynug123', '', 0, 1, '2024-08-24 00:00:00'),
(8, 'Rahim', 'Cailin Witt', 'Chapman', 'lafot1234', 'cudaxe@mailinator.com', 'lafot1234', '', 0, 1, '2024-08-24 00:00:00'),
(9, 'Lynn', 'Bernard Garrison', 'Salas', 'zetotyvava', 'xiqibo@mailinator.com', '$2y$10$2aReUAIDlcVez4EjDQZvhe3noj3GnAHKa9hHxWYMI/AHhFbjJXRD.', '', 0, 1, '2024-08-24 00:00:00'),
(10, 'Aphrodite', 'Kiara Spears', 'Foley', 'admin123', 'lokedexomu@mailinator.com', '$2y$10$459MkXw6BLhHBfWQhKigpOU.UpFlFXKcbQmK13b2O4AlikGojF2nu', '', 2, 1, '2024-09-08 00:00:00');

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
  MODIFY `class_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `class_people`
--
ALTER TABLE `class_people`
  MODIFY `class_people_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

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
  MODIFY `notification_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
