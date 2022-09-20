-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2022 at 02:22 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dxinfo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` bigint(20) NOT NULL,
  `admin_username` varchar(100) NOT NULL DEFAULT '',
  `admin_password` varchar(200) NOT NULL DEFAULT '',
  `admin_firstname` varchar(100) NOT NULL DEFAULT '',
  `admin_lastname` varchar(100) NOT NULL DEFAULT '',
  `language` int(11) NOT NULL DEFAULT '0',
  `data_per_page` int(11) NOT NULL DEFAULT '20',
  `admin_last_login` int(11) NOT NULL DEFAULT '0',
  `admin_log_attempts` int(11) NOT NULL DEFAULT '0',
  `lockout_timestamp` datetime DEFAULT NULL,
  `admin_status` float NOT NULL DEFAULT '0',
  `temp_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_username`, `admin_password`, `admin_firstname`, `admin_lastname`, `language`, `data_per_page`, `admin_last_login`, `admin_log_attempts`, `lockout_timestamp`, `admin_status`, `temp_del`) VALUES
(1, 'superadmin', '$2y$10$V20FOs0HNEu/ggAzHF9dquhjf/472JyT6u4ioMl2LtQJeqH/TRHNK', 'Julcess', 'Mercado', 0, 20, 1663290385, 2, NULL, 0, 0),
(2, 'adminrye', '$2y$10$GHrT/jMl9hfd/dbof9kOvOaX1.zI1M4PlHkuhujorqmNX6Bs5.aIO', 'Ryan', 'Verba', 0, 20, 1663633093, 1, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL,
  `announcements_title` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `announcements_details` text CHARACTER SET utf8 NOT NULL,
  `announcements_img` varchar(255) CHARACTER SET utf8 NOT NULL,
  `announcements_count` int(1) NOT NULL DEFAULT '0',
  `date_edit` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `announcements_status` int(255) NOT NULL,
  `temp_del` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL DEFAULT '0',
  `document_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_created` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_edited` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `document_status` int(1) NOT NULL DEFAULT '0',
  `temp_del` int(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL DEFAULT '0',
  `document_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `document_id` int(10) NOT NULL DEFAULT '0',
  `file_linkname` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `file_link` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_created` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `file_status` int(1) NOT NULL DEFAULT '0',
  `temp_del` int(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` bigint(20) NOT NULL,
  `position_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_name`) VALUES
(1, 'Associate'),
(2, 'Senior Associate'),
(3, 'Team Leader'),
(4, 'Supervisor'),
(5, 'Manager'),
(6, 'Director'),
(7, 'TBD');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` bigint(20) NOT NULL,
  `role_name` varchar(50) NOT NULL DEFAULT '',
  `permissions` varchar(20000) NOT NULL DEFAULT '',
  `role_status` int(11) NOT NULL DEFAULT '0',
  `temp_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `permissions`, `role_status`, `temp_del`) VALUES
(1, 'General (normal user)', 'general', 0, 0),
(2, 'Admin', 'all', 0, 0),
(3, 'Ambassador', 'webinar-and-events,webinar-events-add,webinar-events-edit,webinar-events-delete', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `team_status` int(11) NOT NULL DEFAULT '0',
  `temp_del` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_name`, `team_status`, `temp_del`, `timestamp`) VALUES
(1, 'Team Goop!', 0, 0, '2022-09-09 01:26:47'),
(2, 'Team B', 0, 0, '2022-09-09 01:26:57'),
(3, 'Team C', 0, 0, '2022-09-09 01:27:04'),
(4, 'Team D', 0, 0, '2022-09-09 01:27:09'),
(5, 'Team E', 0, 0, '2022-09-09 01:27:18'),
(6, 'Team F', 0, 0, '2022-09-09 01:27:26'),
(7, 'Team BD', 0, 0, '2022-09-09 01:27:34'),
(8, 'Team Management', 0, 0, '2022-09-09 01:27:45'),
(9, 'Trainees', 0, 0, '2022-09-09 01:27:53'),
(10, 'Tech Team', 0, 0, '2022-09-09 01:27:59'),
(13, 'Test Team', 2, 1663578869, '2022-09-19 09:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `test_username` varchar(100) NOT NULL,
  `test_firstname` varchar(100) NOT NULL,
  `test_lastname` varchar(100) NOT NULL,
  `test_status` int(11) NOT NULL DEFAULT '0',
  `temp_del` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `test_username`, `test_firstname`, `test_lastname`, `test_status`, `temp_del`, `timestamp`) VALUES
(11, '2200057', 'Julcess', 'Marie', 2, 0, '2022-08-22 05:54:00'),
(12, '2200057ss', 'Dddddddddasd', 'Ddddad', 0, 0, '2022-08-18 23:58:44'),
(13, '2220090', 'Kimberly', 'De Leon', 2, 1660803128, '2022-08-18 06:12:08'),
(14, '2220090', 'Kim', 'De Leon', 0, 0, '2022-08-19 05:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `user_employee_id` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_password` varchar(200) NOT NULL DEFAULT '',
  `user_firstname` varchar(100) NOT NULL DEFAULT '',
  `user_middlename` varchar(100) NOT NULL DEFAULT '',
  `user_lastname` varchar(100) NOT NULL DEFAULT '',
  `user_nickname` varchar(50) NOT NULL DEFAULT '',
  `user_photo` varchar(100) NOT NULL DEFAULT '',
  `role_ids` varchar(1000) NOT NULL DEFAULT ',',
  `permissions` varchar(1000) NOT NULL DEFAULT ',',
  `user_position` int(11) NOT NULL DEFAULT '0',
  `user_level` int(11) NOT NULL DEFAULT '1',
  `user_gender` varchar(100) NOT NULL,
  `user_mobile` varchar(50) NOT NULL DEFAULT '',
  `team_id` bigint(20) NOT NULL DEFAULT '0',
  `user_hiredate` int(11) NOT NULL DEFAULT '0',
  `user_enddate` int(11) NOT NULL DEFAULT '0',
  `user_mantra_in_life` varchar(300) NOT NULL,
  `user_skills` varchar(300) NOT NULL,
  `starting_date` int(11) NOT NULL DEFAULT '0',
  `data_per_page` int(11) NOT NULL DEFAULT '20',
  `user_last_login` int(11) NOT NULL DEFAULT '0',
  `user_log_attempts` int(11) DEFAULT NULL,
  `lockout_timestamp` datetime DEFAULT NULL,
  `user_status` float NOT NULL DEFAULT '0',
  `temp_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_employee_id`, `user_email`, `user_password`, `user_firstname`, `user_middlename`, `user_lastname`, `user_nickname`, `user_photo`, `role_ids`, `permissions`, `user_position`, `user_level`, `user_gender`, `user_mobile`, `team_id`, `user_hiredate`, `user_enddate`, `user_mantra_in_life`, `user_skills`, `starting_date`, `data_per_page`, `user_last_login`, `user_log_attempts`, `lockout_timestamp`, `user_status`, `temp_del`) VALUES
(1, '2200057', 'julcess-marie.m1@trans-cosmos.co.jp', '$2y$10$SMpmeXR0kKN8yTY/wY/r8.lvG7ccRcIebe059ZvO2fkz6h4uzwn6.', 'Julcess Marie', 'Papica', 'Mercado', 'Cess', 'julcessmercado.jpg', ',1,', ',', 2, 2, '0', '09754310357', 1, 20220218, 20270101, 'Appear as you are, be as you appear.', 'Javascript, Jquery, Php, Laravel, Mysql, Git', 0, 20, 1663290376, NULL, NULL, 0, 0),
(7, '2220090', 'kimberly.de-leon1@trans-cosmos.co.jp', '$2y$10$FmXPHs7P7cGA4yHYp7HAAu0XHCLqrk2Gk4bmmn0wmZSTa2wp/payW', 'Kimberly Nelle', '', 'De Leon', 'Kim', 'avatar2.png', ',3,', ',', 1, 0, '0', '', 10, 20220801, 20270101, 'Time is Gold', 'Javascript, Jquery, PHP, Laravel, MYSQL, Git', 0, 20, 0, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `webinarandevents`
--

CREATE TABLE `webinarandevents` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL,
  `webinar_host` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `webinar_title` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `webinar_img` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `webinar_description` text CHARACTER SET utf8 NOT NULL,
  `date_set` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `month_set` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_created` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_edited` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `webinar_status` int(1) NOT NULL DEFAULT '0',
  `temp_del` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `webinarandevents`
--

INSERT INTO `webinarandevents` (`id`, `user_id`, `webinar_host`, `webinar_title`, `webinar_img`, `webinar_description`, `date_set`, `month_set`, `date_created`, `date_edited`, `webinar_status`, `temp_del`, `timestamp`) VALUES
(1, 2, '2200057', 'January General Assembly', '1663230276_1662616156_jan2022GA.jpg', 'General Assembly', '20220114', '202201', 'September 15, 2022 - Thursday - 04:24 pm', '', 0, 0, '2022-09-19 08:43:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `webinarandevents`
--
ALTER TABLE `webinarandevents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `webinarandevents`
--
ALTER TABLE `webinarandevents`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
