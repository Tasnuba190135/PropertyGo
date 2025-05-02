-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 07:40 AM
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
-- Database: `propertygo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file`
--

CREATE TABLE `tbl_file` (
  `file_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 1,
  `file_owner_id` int(11) NOT NULL,
  `file_original_name` text NOT NULL,
  `file_new_name` text NOT NULL,
  `note_ids` text DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`file_id`, `status`, `file_owner_id`, `file_original_name`, `file_new_name`, `note_ids`, `created`, `updated`) VALUES
(1, 1, 2, 'N1.pdf', 'Z0Qsi7ypr4z1.pdf', '', '2025-04-29 05:06:21', '2025-04-29 05:06:21'),
(2, 1, 2, 'photo_2025-04-29_11-03-11.jpg', 'ScvRUZIaUHNu2.jpg', '', '2025-04-29 05:06:21', '2025-04-29 05:06:21'),
(3, 1, 3, 'N1.pdf', 'FCr4RyKykL2Z3.pdf', '', '2025-04-29 05:09:25', '2025-04-29 05:09:25'),
(4, 1, 3, 'photo_2025-04-29_11-02-42.jpg', 'CNvAwV4TvMjv4.jpg', '', '2025-04-29 05:09:25', '2025-04-29 05:09:25'),
(5, 1, 4, 'N1.pdf', 'WQUGHuuFeZ5.pdf', '', '2025-04-29 05:11:18', '2025-04-29 05:11:18'),
(6, 1, 4, 'photo_2025-04-29_11-02-30 (2).jpg', 'veoFXlc3wdE6.jpg', '', '2025-04-29 05:11:18', '2025-04-29 05:11:18'),
(7, 1, 5, 'N1.pdf', 'KN1o3QoJcIP7.pdf', '', '2025-04-29 05:18:05', '2025-04-29 05:18:05'),
(8, 1, 5, 'photo_2025-04-29_11-02-15.jpg', 'BY6xre7YZAN8.jpg', '', '2025-04-29 05:18:05', '2025-04-29 05:18:05'),
(9, 1, 6, 'N1.pdf', 't70Kzkxo1mm9.pdf', '', '2025-04-29 05:20:21', '2025-04-29 05:20:21'),
(10, 1, 6, 'photo_2025-04-29_11-02-15.jpg', '7wheeDibxYn310.jpg', '', '2025-04-29 05:20:21', '2025-04-29 05:20:21'),
(11, 1, 7, 'N1.pdf', 'teAnSl1RunSs11.pdf', '', '2025-04-29 05:25:22', '2025-04-29 05:25:22'),
(12, 1, 7, 'photo_2025-04-29_11-01-35.jpg', 'owqmApe7NS6q12.jpg', '', '2025-04-29 05:25:22', '2025-04-29 05:25:22'),
(13, 1, 8, 'N1.pdf', 'zG61JdZvK5hY13.pdf', '', '2025-04-29 05:27:25', '2025-04-29 05:27:25'),
(14, 1, 8, 'photo_2025-04-29_11-02-03.jpg', 'eg18AUK8ykvB14.jpg', '', '2025-04-29 05:27:25', '2025-04-29 05:27:25'),
(15, 1, 9, 'N1.pdf', 'RgU9N3Hq5srB15.pdf', '', '2025-04-29 05:29:15', '2025-04-29 05:29:15'),
(16, 1, 9, 'photo_2025-04-29_11-01-49.jpg', 'UO1c0NttU1Nc16.jpg', '', '2025-04-29 05:29:15', '2025-04-29 05:29:15'),
(17, 1, 10, 'N1.pdf', 'x2RN9Zg2KDRG17.pdf', '', '2025-04-29 05:33:10', '2025-04-29 05:33:10'),
(18, 1, 10, 'photo_2025-04-29_10-58-55.jpg', 'cO1Q8st0swI18.jpg', '', '2025-04-29 05:33:10', '2025-04-29 05:33:10'),
(19, 1, 11, 'N1.pdf', 'pAHq6aUZiAr19.pdf', '', '2025-04-29 05:35:40', '2025-04-29 05:35:40'),
(20, 1, 11, 'photo_2025-04-29_10-58-50.jpg', 'iePnq6lHMzsf20.jpg', '', '2025-04-29 05:35:40', '2025-04-29 05:35:40'),
(21, 1, 12, 'N1.pdf', 'uCZrKCMIHBc21.pdf', '', '2025-04-29 05:37:51', '2025-04-29 05:37:51'),
(22, 1, 12, 'photo_2025-04-29_11-01-18.jpg', 'osUVcczvnMEq22.jpg', '', '2025-04-29 05:37:51', '2025-04-29 05:37:51'),
(23, 1, 13, 'N1.pdf', 'nlvNvFeDobc923.pdf', '', '2025-04-29 05:39:43', '2025-04-29 05:39:43'),
(24, 1, 13, 'photo_2025-04-29_11-01-49.jpg', 'QQNn1jVCfLXF24.jpg', '', '2025-04-29 05:39:43', '2025-04-29 05:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property`
--

CREATE TABLE `tbl_property` (
  `property_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `sold_to` int(11) DEFAULT 0,
  `property_title` varchar(100) DEFAULT '',
  `note_ids` text DEFAULT NULL,
  `property_category` varchar(50) DEFAULT '',
  `area` double DEFAULT 0,
  `description` text DEFAULT NULL,
  `division` varchar(50) DEFAULT '',
  `district` varchar(50) DEFAULT '',
  `address` text DEFAULT NULL,
  `google_location_url` text DEFAULT NULL,
  `bedroom_no` int(11) DEFAULT 0,
  `bathroom_no` int(11) DEFAULT 0,
  `price` double DEFAULT 0,
  `property_image_file_ids` text DEFAULT NULL,
  `property_video_file_ids` text DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `posted` timestamp NULL DEFAULT NULL,
  `parent_property_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `user_type` varchar(50) DEFAULT 'client',
  `note_ids` text DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `status`, `email`, `password`, `user_type`, `note_ids`, `created`, `updated`) VALUES
(1, 1, 'super@admin', '$2y$10$6w..LLwJ5nYcqAhRU6TgjOZ/iljtNuTTVn0bMRlUK9u7x4gHAepe6', 'super-admin', NULL, '2025-04-29 04:56:25', '2025-04-29 04:56:25'),
(2, 0, '170150.cse@student.just.edu.bd', '$2y$10$AcM5s7oNNtfuSJ6/rj7yte394oWZZFp/1zV1nF9sJFTKDaXAkWTFW', 'client', '', '2025-04-29 05:06:21', '2025-04-29 05:06:21'),
(3, 0, '170151.cse@student.just.edu.bd', '$2y$10$5BGlFX62kdoAALg60eUAKOgNeez4k80ktUaD/o3b.JBL8nfQtWO8K', 'client', '', '2025-04-29 05:09:25', '2025-04-29 05:09:25'),
(4, 0, '190101.cse@student.just.edu.bd', '$2y$10$fmPoq2vZIqobibhx3Mr/oO0NixxECNGzgaP49fkmgAhSrtzS8F1ui', 'client', '', '2025-04-29 05:11:17', '2025-04-29 05:11:17'),
(5, 0, '190102.cse@student.just.edu.bd', '$2y$10$lLAqPSOc6auoUTPkLwGqmuPb.Q99nk9krLiVioMC9S.cThiGiWF.C', 'client', '', '2025-04-29 05:18:05', '2025-04-29 05:18:05'),
(6, 0, '190103.cse@student.just.edu.bd', '$2y$10$cDtMkvSvuuptkdqUi5rH9eodX5ja3Qvi5xoI2nyOu1YL5e3xrdhwm', 'client', '', '2025-04-29 05:20:21', '2025-04-29 05:20:21'),
(7, 0, '190104.cse@student.just.edu.bd', '$2y$10$mznwiU.nNTExH.W7kLdu0uAWdlnU7NMig8yfr9wjOUEJc0Ca29hMi', 'client', '', '2025-04-29 05:25:22', '2025-04-29 05:25:22'),
(8, 0, '190111.cse@student.just.edu.bd', '$2y$10$BK6lcmRBp1UxmloYnkB8Z.prVmeaNrzrMCc5fiWsRXwqSDnTpfJT.', 'client', '', '2025-04-29 05:27:25', '2025-04-29 05:27:25'),
(9, 0, '190112.cse@student.just.edu.bd', '$2y$10$KZH9ImUDg4w/MJllMEdoVOvZ7zoZrapcP5W9hAOxVCXv864y6.Fay', 'client', '', '2025-04-29 05:29:15', '2025-04-29 05:29:15'),
(10, 0, 'tanvironton@gmail.com', '$2y$10$jyO2lQrrNqUdobTe7Aeif.PNoqyTqZsRdW/73cyW05P1g6FttjMeO', 'client', '', '2025-04-29 05:33:10', '2025-04-29 05:33:10'),
(11, 0, '190116.cse@student.just.edu.bd', '$2y$10$oWOISBouAOJNxtk.zhqbQeGxcNvjCbbSzLfS3FYOlJz.VUSWT/YIS', 'client', '', '2025-04-29 05:35:40', '2025-04-29 05:35:40'),
(12, 1, 'admin@gmail.com', '$2y$10$2EPlqCJNTqZqh73.CzC5Tu3UM3eNaRE1kONIQJ3.Rt/NK8o8CvI3O', 'admin', '', '2025-04-29 05:37:51', '2025-04-29 05:38:08'),
(13, 0, 'admin2@gmail.com', '$2y$10$bPiGdtCI7JpU9xUgtHNR1OciSwBrDKMscSsaoszH1MQM0o4ayGd/m', 'admin', '', '2025-04-29 05:39:43', '2025-04-29 05:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_details`
--

CREATE TABLE `tbl_user_details` (
  `user_details_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `note_ids` text DEFAULT NULL,
  `full_name` text DEFAULT NULL,
  `contact_no` text DEFAULT NULL,
  `division` text DEFAULT NULL,
  `district` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `nid_number` text DEFAULT NULL,
  `profile_picture_id` int(11) DEFAULT 0,
  `nid_file_id` int(11) DEFAULT 0,
  `other_document_file_id` int(11) DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_details`
--

INSERT INTO `tbl_user_details` (`user_details_id`, `status`, `user_id`, `note_ids`, `full_name`, `contact_no`, `division`, `district`, `address`, `gender`, `nid_number`, `profile_picture_id`, `nid_file_id`, `other_document_file_id`, `created`, `updated`) VALUES
(1, 1, 1, '', 'Super Admin', '', '', '', '', '', '', 0, 0, 0, '2025-04-29 04:56:25', '2025-04-29 04:56:25'),
(2, 0, 2, '', 'Md. Abdul Maruf Siddiki', '+8801785214488', 'Rajshahi', 'Bogura', 'Bogura, Rajshahi', 'male', '5110271200', 2, 1, 0, '2025-04-29 05:06:21', '2025-04-29 05:06:21'),
(3, 0, 3, '', 'M A Rafi', '+8801521257588', 'Dhaka', 'Dhaka', 'Mirpur, Dhaka', 'male', '5110271201', 4, 3, 0, '2025-04-29 05:09:25', '2025-04-29 05:09:25'),
(4, 0, 4, '', 'Masum Billah', '+8801971636762', 'Khulna', 'Satkhira', 'Shatkhira, Khulna', 'male', '5110271210', 6, 5, 0, '2025-04-29 05:11:18', '2025-04-29 05:11:18'),
(5, 0, 5, '', 'Joydip Das', '+8801995140040', 'Khulna', 'Jashore', 'Jessore, Khulna', 'male', '5110271211', 8, 7, 0, '2025-04-29 05:18:05', '2025-04-29 05:18:05'),
(6, 0, 6, '', 'Md Shojib Hossain', '+8801971636762', 'Rajshahi', 'Pabna', 'Pabna, Rajshahi', 'male', '5110271212', 10, 9, 0, '2025-04-29 05:20:21', '2025-04-29 05:20:21'),
(7, 0, 7, '', 'Jyotiran Mondal Joy ', '+8801797428597', 'Khulna', 'Khulna', 'Daulatpur, Khulna', 'male', '5110271213', 12, 11, 0, '2025-04-29 05:25:22', '2025-04-29 05:25:22'),
(8, 0, 8, '', 'Nishat Jahan Tandra', '+8801521546406', 'Rajshahi', 'Naogaon', 'Naoga, Rajshahi', 'female', '5110271219', 14, 13, 0, '2025-04-29 05:27:25', '2025-04-29 05:27:25'),
(9, 0, 9, '', 'Hira Biswas', '+8801793250485', 'Khulna', 'Jashore', 'Jessore, Khulna', 'female', '5110271220', 16, 15, 0, '2025-04-29 05:29:15', '2025-04-29 05:29:15'),
(10, 0, 10, '', 'Tanvir Hossain', '+8801643620448', 'Rajshahi', 'Bogura', 'Bogra, Rajshahi.', 'male', '6752993722', 18, 17, 0, '2025-04-29 05:33:10', '2025-04-29 05:33:10'),
(11, 0, 11, '', 'Md. Masrafi Bin Seraj Sakib', '+8801886420246', 'Khulna', 'Khulna', 'Khulna Sadar, Khulna', 'male', '5110271222', 20, 19, 0, '2025-04-29 05:35:40', '2025-04-29 05:35:40'),
(12, 1, 12, '', 'Md Hasib Khondokar', '+8801734512328', 'Dhaka', 'Munshiganj', 'Dhaka 1020', 'male', '123455432', 22, 21, 0, '2025-04-29 05:37:51', '2025-04-29 05:38:08'),
(13, 0, 13, '', 'Tasnuba Tasnim', '+8801812312312', 'Dhaka', 'Dhaka', 'Dhaka 1020', 'female', '28912308918', 24, 23, 0, '2025-04-29 05:39:43', '2025-04-29 05:39:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `tbl_property`
--
ALTER TABLE `tbl_property`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  ADD PRIMARY KEY (`user_details_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_property`
--
ALTER TABLE `tbl_property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  MODIFY `user_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
