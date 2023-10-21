-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2023 at 08:52 AM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(30) NOT NULL,
  `branch_code` varchar(50) NOT NULL,
  `department` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_code`, `department`, `contact`, `date_created`) VALUES
(1, '101010010111000', 'CAS', '09123546345', '2023-10-09 13:01:50'),
(2, '010111010000011', 'ABEL', '09123456789', '2023-10-09 13:13:12'),
(3, '101011100011000', 'CSS', '09123532426', '2023-10-09 13:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(30) NOT NULL,
  `doc_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `doc_name`, `date_created`) VALUES
(1, 'Daily Time Record', '2023-10-08 00:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(30) NOT NULL,
  `user_id` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` int(30) NOT NULL,
  `reference_number` varchar(100) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `sender_name` varchar(30) NOT NULL,
  `sender_contact` varchar(30) NOT NULL,
  `recipient_name` varchar(30) NOT NULL,
  `recipient_contact` varchar(30) NOT NULL,
  `doc_type` varchar(30) NOT NULL,
  `from_branch_id` varchar(30) NOT NULL,
  `to_branch_id` varchar(30) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `reference_number`, `created_by`, `sender_name`, `sender_contact`, `recipient_name`, `recipient_contact`, `doc_type`, `from_branch_id`, `to_branch_id`, `remarks`, `status`, `date_created`, `date_updated`) VALUES
(2, '202310091M6TK3J', '5', '5', '09823235345', '4', '0912354634542', '1', '1', '1', 'Signature for DTR', 0, '2023-10-09 23:02:57', '2023-10-17 20:21:42'),
(3, '202310090NV1G5R', '2', '2', '09456258490', '3', '09456258490', '1', '3', '2', 'Signature for DTR', 0, '2023-10-09 23:03:12', '2023-10-17 19:32:41'),
(4, '202310106OP5CMJ', '5', '5', '09823235345', '4', '0912354634542', '1', '1', '1', 'Signature for DTR', 1, '2023-10-10 02:01:40', '2023-10-17 19:34:53'),
(5, '20231010V2IBNGC', '4', '4', '0912354634542', '3', '09456258490', '1', '1', '2', 'Signature for DTR', 0, '2023-10-10 02:01:57', '2023-10-17 19:35:44'),
(6, '20231010L8AF19P', '4', '4', '0912354634542', '5', '09823235345', '1', '1', '1', 'Signature for DTR', 2, '2023-10-10 02:02:14', '2023-10-17 20:48:09'),
(7, '202310102V5C17R', '4', '4', '0912354634542', '5', '0912354634542', '1', '1', '1', 'Signature for DTR', 2, '2023-10-10 02:07:59', '2023-10-17 20:48:04'),
(8, '202310108LNCUGH', '4', '4', '0912354634542', '2', '09456258490', '1', '1', '3', 'Signature for DTR', 1, '2023-10-10 02:08:13', '2023-10-17 19:35:08'),
(9, '20231017OQKNTE9', '4', '4', '0912354634542', '3', '09456258490', '1', '1', '2', 'Test', 0, '2023-10-17 14:39:20', '2023-10-17 14:39:20'),
(10, '20231018N3TXQLD', '4', '2', '09456258490', '5', '09823235345', '1', '3', '1', 'Sample', 0, '2023-10-18 14:51:10', '2023-10-18 14:55:12'),
(11, '20231021NHZBQYF', '2', '2', '09456258490', '4', '0912354634542', '1', '3', '1', 'Sample', 0, '2023-10-21 09:39:16', '2023-10-21 09:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_tracks`
--

CREATE TABLE `parcel_tracks` (
  `id` int(30) NOT NULL,
  `parcel_id` int(30) NOT NULL,
  `status` int(2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcel_tracks`
--

INSERT INTO `parcel_tracks` (`id`, `parcel_id`, `status`, `date_created`) VALUES
(33, 1, 0, '2023-10-09 23:02:05'),
(34, 2, 0, '2023-10-09 23:02:57'),
(35, 3, 0, '2023-10-09 23:03:12'),
(36, 2, 1, '2023-10-10 00:19:29'),
(38, 1, 2, '2023-10-10 01:08:28'),
(39, 4, 0, '2023-10-10 02:01:40'),
(40, 5, 0, '2023-10-10 02:01:57'),
(41, 6, 0, '2023-10-10 02:02:14'),
(42, 7, 0, '2023-10-10 02:07:59'),
(43, 8, 0, '2023-10-10 02:08:13'),
(44, 4, 1, '2023-10-10 02:08:58'),
(45, 7, 1, '2023-10-10 02:10:01'),
(46, 1, 0, '2023-10-10 03:53:36'),
(47, 1, 1, '2023-10-10 03:54:20'),
(48, 7, 0, '2023-10-16 01:15:40'),
(49, 8, 1, '2023-10-16 01:30:34'),
(50, 4, 0, '2023-10-16 01:39:34'),
(51, 4, 1, '2023-10-16 01:40:19'),
(52, 4, 0, '2023-10-16 01:41:07'),
(53, 4, 2, '2023-10-16 01:41:30'),
(54, 4, 0, '2023-10-16 01:42:40'),
(55, 4, 1, '2023-10-16 01:43:07'),
(56, 4, 0, '2023-10-16 01:56:58'),
(57, 4, 1, '2023-10-16 01:57:21'),
(58, 4, 0, '2023-10-16 02:09:27'),
(59, 4, 1, '2023-10-16 02:10:37'),
(60, 4, 0, '2023-10-16 02:12:03'),
(61, 4, 1, '2023-10-16 02:12:21'),
(62, 2, 0, '2023-10-17 19:29:57'),
(63, 7, 2, '2023-10-17 20:48:04'),
(64, 6, 2, '2023-10-17 20:48:09'),
(65, 9, 0, '2023-10-17 14:39:20'),
(66, 10, 0, '2023-10-18 14:51:10'),
(67, 10, 2, '2023-10-18 14:52:08'),
(68, 10, 0, '2023-10-18 14:53:55'),
(69, 10, 1, '2023-10-18 14:54:08'),
(70, 10, 0, '2023-10-18 14:55:12'),
(71, 11, 0, '2023-10-21 09:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(1, 'Docu-Track PSU Lingayen Campus', 'info@sample.comm', '+6948 8542 623', '2102  Caldwell Road, Rochester, New York, 14608', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `contact_number` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 = admin, 2 = staff',
  `branch_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `contact_number`, `email`, `password`, `type`, `branch_id`, `date_created`) VALUES
(1, 'Administrator', '', '', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 1, 0, '2020-11-26 10:57:04'),
(2, 'Karl', 'Tusok', '09456258490', 'karlpajarillo@gmail.com', '0192023a7bbd73250516f069df18b500', 2, 3, '2023-06-19 20:50:18'),
(3, 'Victor', 'Magtanggol', '09456258490', 'victormagtanggol@gmail.com', '17a821dfa961c93a6c586ca257750fb2', 2, 2, '2023-06-19 23:47:45'),
(4, 'Nhel', 'Ferndz', '0912354634542', 'Nhel@admin.com', '0192023a7bbd73250516f069df18b500', 2, 1, '2023-10-01 01:20:18'),
(5, 'Light', 'Yagami', '09823235345', 'light@admin.com', '0192023a7bbd73250516f069df18b500', 2, 1, '2023-10-09 13:30:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
