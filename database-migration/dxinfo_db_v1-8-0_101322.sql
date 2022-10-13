-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 12, 2022 at 09:44 AM
-- Server version: 5.6.51
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infohubt_db`
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
(1, 'superadmin', '$2y$10$V20FOs0HNEu/ggAzHF9dquhjf/472JyT6u4ioMl2LtQJeqH/TRHNK', 'Super', 'Admin', 0, 20, 1665476349, 3, NULL, 0, 0),
(2, 'adminrye', '$2y$10$GHrT/jMl9hfd/dbof9kOvOaX1.zI1M4PlHkuhujorqmNX6Bs5.aIO', 'Ryan', 'Verba', 0, 20, 1664322311, 3, NULL, 0, 0);

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

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `user_id`, `announcements_title`, `announcements_details`, `announcements_img`, `announcements_count`, `date_edit`, `date_created`, `announcements_status`, `temp_del`, `timestamp`) VALUES
(1, 51, 'TCI Requirement: LMS | TCC102', 'I am writing to ask for everyone’s cooperation to ensure your team’s completion as we are strengthening Transcosmos’ Data and Information Security to create awareness and prevent fraud.\r\n\r\nAll  TCAP employees are required to attend the face-to-face training with our ISMS team - for those regularly reporting onsite or complete the TCC 102 – Compliance Refresher in LMS self-learning Course.\r\n\r\nHere are the step-by-step process of logging in to the Learning Management System (LMS) for first-time users.\r\n1. Go to - tcaptd.tcaseanlms.com\r\n2. To log in – Use TCAP email or the provided username\r\n3. If it’s the first time to log in, the initial password is the same as the username, or use the default password: TC@sean123\r\n4. Assign a new password and follow the requirement\r\na. Forgot Password: Please use the link on the login page. A triggered email for password change will be sent to your TCAP email account.\r\n\r\nAll managers/supervisors will receive a separate email that includes the LMS user ID of their team with additional details within the day, and the target completion is October 7, 2022.\r\n\r\nThank you', 'image (1).png', 0, 'October 11, 2022 - Tuesday - 10:23 am', 'September 30, 2022 - Friday - 03:28 am', 0, 0, '2022-10-11 02:23:35'),
(2, 51, 'Testing Announcement', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32', 'Events Survey Presentation.jpg', 0, 'October 12, 2022 - Wednesday - 10:38 am', 'October 12, 2022', 0, 0, '2022-10-12 02:38:25'),
(3, 8, 'Rtret', 'rtyrytrfgdgdgfdsfsfsdf', 'unnamed (1).png', 0, 'October 12, 2022 - Wednesday - 11:53 am', 'October 12, 2022', 2, 1665546840, '2022-10-12 03:54:00');

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

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `document_name`, `date_created`, `date_edited`, `document_status`, `temp_del`, `timestamp`) VALUES
(1, 51, 'Quicklinks', 'September 28, 2022 - Wednesday - 02:18 pm', 'September 28, 2022 - Wednesday - 02:19 pm', 0, 0, '2022-09-28 06:19:53'),
(2, 51, 'New Hire Important Documents', 'September 28, 2022 - Wednesday - 02:24 pm', 'September 28, 2022 - Wednesday - 02:24 pm', 0, 0, '2022-09-28 06:24:50'),
(3, 51, 'Information Security Files', 'September 28, 2022 - Wednesday - 02:25 pm', 'September 28, 2022 - Wednesday - 02:25 pm', 0, 0, '2022-09-28 06:25:36'),
(4, 51, 'HMO Related Files', 'September 28, 2022 - Wednesday - 02:25 pm', 'October 10, 2022 - Monday - 03:27 pm', 0, 0, '2022-10-10 07:27:23'),
(5, 51, 'Developers Training Files', 'September 28, 2022 - Wednesday - 02:26 pm', 'September 28, 2022 - Wednesday - 02:27 pm', 0, 0, '2022-09-28 06:27:08'),
(6, 51, 'Bridge Directors Training Files', 'September 28, 2022 - Wednesday - 02:27 pm', 'September 28, 2022 - Wednesday - 02:28 pm', 0, 0, '2022-09-28 06:28:05'),
(7, 51, 'QA Tracker links', 'October 10, 2022 - Monday - 04:31 pm', 'October 10, 2022 - Monday - 04:33 pm', 0, 0, '2022-10-10 08:33:05'),
(8, 21, 'Testing Only', 'October 11, 2022 - Tuesday - 03:50 pm', 'October 11, 2022 - Tuesday - 03:52 pm', 2, 1665476710, '2022-10-11 08:25:10'),
(9, 21, 'Julcess Testing', 'October 11, 2022 - Tuesday - 04:17 pm', '', 2, 1665476703, '2022-10-11 08:25:03'),
(10, 51, 'Kim TEsting', 'October 11, 2022 - Tuesday - 04:18 pm', '', 2, 1665537718, '2022-10-12 01:21:58'),
(11, 21, 'Joseph Testing', 'October 11, 2022 - Tuesday - 04:19 pm', '', 2, 1665476694, '2022-10-11 08:24:54'),
(12, 45, 'Kim testing 2iii', 'October 11, 2022 - Tuesday - 04:19 pm', '', 2, 1665537736, '2022-10-12 01:22:16'),
(13, 51, 'Ryan New Testing', 'October 11, 2022 - Tuesday - 04:25 pm', 'October 11, 2022 - Tuesday - 04:27 pm', 2, 1665537727, '2022-10-12 01:22:07'),
(14, 51, 'Testing', 'October 12, 2022 - Wednesday - 10:28 am', 'October 12, 2022 - Wednesday - 10:29 am', 0, 0, '2022-10-12 02:29:28'),
(15, 8, 'Savvxv', 'October 12, 2022 - Wednesday - 11:57 am', '', 2, 1665547217, '2022-10-12 04:00:17');

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

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `user_id`, `document_name`, `document_id`, `file_linkname`, `file_link`, `date_created`, `file_status`, `temp_del`, `timestamp`) VALUES
(1, 51, 'Quicklinks', 1, 'Work From Home Tracker', 'https://docs.google.com/spreadsheets/d/1Ak7STwFwr0-FgMvTW2rcyRYYmAUOfg3yUXwcjV4FbxA/edit#gid=672444593', 'September 28, 2022 - Wednesday - 02:19 pm', 0, 0, '2022-09-28 06:19:53'),
(2, 51, 'Quicklinks', 1, 'DX Email Template', 'https://docs.google.com/spreadsheets/d/1DVkVwYD89sNfs8jJ1QrUvvhijKIOdAEv/edit#gid=1666765996', 'September 28, 2022 - Wednesday - 02:19 pm', 0, 0, '2022-09-28 06:19:53'),
(3, 51, 'New Hire Important Documents', 2, 'New Hire Important Documents', 'Z:\\DX TCI\\16_DX InfoHub\\New Hire Important Documents', 'September 28, 2022 - Wednesday - 02:24 pm', 0, 0, '2022-09-28 06:24:50'),
(4, 51, 'Information Security Files', 3, 'Information Security Files', 'Z:\\DX TCI\\16_DX InfoHub\\Information Security Files', 'September 28, 2022 - Wednesday - 02:25 pm', 0, 0, '2022-09-28 06:25:36'),
(6, 51, 'Developers Training Files', 5, 'Developers Training Files', 'Z:\\DX TCI\\16_DX InfoHub\\Developers Training Files', 'September 28, 2022 - Wednesday - 02:27 pm', 0, 0, '2022-09-28 06:27:08'),
(7, 51, 'Bridge Directors Training Files', 6, 'Bridge Directors Training Files', 'Z:\\DX TCI\\16_DX InfoHub\\Bridge Directors Training Files', 'September 28, 2022 - Wednesday - 02:28 pm', 0, 0, '2022-09-28 06:28:05'),
(15, 51, 'HMO Related Files', 4, 'HMO Related Files', 'Z:\\DX TCI\\16_DX InfoHub\\HMO Related Files', 'September 29, 2022 - Thursday - 06:19 pm', 0, 0, '2022-10-10 07:27:23'),
(17, 51, 'QA Tracker links', 7, 'HR Eyes Revamped Ticket Tracker', 'https://docs.google.com/spreadsheets/d/1e_OO6npnPb4n6TEO2NfNs_hH_Cujyv08LqUyJ6iLleE/edit#gid=1410844117', 'October 10, 2022 - Monday - 04:33 pm', 0, 0, '2022-10-10 08:33:05'),
(18, 51, 'QA Tracker links', 7, 'DX Info Hub Ticket Tracker', 'https://docs.google.com/spreadsheets/d/1bYeRg_NGaEQzCL6s2j8sPEtqJewpVk7S-7Je9iCkCyM/edit#gid=1084982907', 'October 10, 2022 - Monday - 04:33 pm', 0, 0, '2022-10-10 08:33:05'),
(19, 21, 'Testing Only', 8, 'Test Link 1', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 03:52 pm', 0, 0, '2022-10-11 07:52:03'),
(20, 21, 'Testing Only', 8, 'Test Link 2', 'https://docs.google.com/spreadsheets/d/1bYeRg_NGaEQzCL6s2j8sPEtqJewpVk7S-7Je9iCkCyM/edit#gid=1572733321', 'October 11, 2022 - Tuesday - 03:52 pm', 0, 0, '2022-10-11 07:52:03'),
(24, 51, 'Ryan New Testing', 13, 'HMO Related Files 4', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 04:27 pm', 0, 0, '2022-10-11 08:27:40'),
(25, 51, 'Ryan New Testing', 13, 'HMO Related Files 5', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 04:27 pm', 0, 0, '2022-10-11 08:27:40'),
(26, 51, 'Ryan New Testing', 13, 'HMO Related Files 6', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 04:27 pm', 0, 0, '2022-10-11 08:27:40'),
(27, 51, 'Ryan New Testing', 13, 'HMO Related Files 1', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 04:27 pm', 0, 0, '2022-10-11 08:27:40'),
(28, 51, 'Ryan New Testing', 13, 'HMO Related Files 2', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 04:27 pm', 0, 0, '2022-10-11 08:27:40'),
(29, 51, 'Ryan New Testing', 13, 'HMO Related Files 3', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 04:27 pm', 0, 0, '2022-10-11 08:27:40'),
(30, 51, 'Testing', 14, 'Tracker 1', 'https://docs.google.com/spreadsheets/d/1bYeRg_NGaEQzCL6s2j8sPEtqJewpVk7S-7Je9iCkCyM/edit#gid=1084982907', 'October 12, 2022 - Wednesday - 10:29 am', 0, 0, '2022-10-12 02:29:28'),
(31, 51, 'Testing', 14, 'Tracker 2', 'https://docs.google.com/spreadsheets/d/1Ak7STwFwr0-FgMvTW2rcyRYYmAUOfg3yUXwcjV4FbxA/edit#gid=1869106605', 'October 12, 2022 - Wednesday - 10:29 am', 0, 0, '2022-10-12 02:29:28');

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
(3, 'Ambassador', 'webinar-and-events,webinar-events-add,webinar-events-edit,webinar-events-delete,general', 0, 0),
(5, 'Testing Role', 'general', 2, 1665542511);

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
(16, 'Team A', 0, 0, '2022-09-28 03:18:55'),
(17, 'Testing 404', 0, 0, '2022-10-12 02:39:23');

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
(1, '2200057', 'julcess-marie.m1@trans-cosmos.co.jp', '$2y$10$SMpmeXR0kKN8yTY/wY/r8.lvG7ccRcIebe059ZvO2fkz6h4uzwn6.', 'Julcess Marie', 'Papica', 'Mercado', 'Cess', 'julcessmercado.jpg', ',3,', ',', 2, 2, '0', '09754310357', 1, 20220218, 20270101, 'To be Announce', 'JS, PHP, MYSQL', 0, 20, 1665476666, 1, NULL, 0, 0),
(6, '2210040', 'yves-patrick.b1@trans-cosmos.co.jp', '$2y$10$rFIcHKIZmZcsgMhWJbktw.vOY04z56oo.ZSzLOd4WONMmIRl1ih/2', 'Yves Patrick', 'Valiente', 'Batungbacal', 'Patrick', 'yvesbatungbacal.jpg', ',2,', ',', 4, 0, '0', '09123456789', 8, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664350897, NULL, NULL, 0, 0),
(3, '2180223', 'ampioco.morris1@trans-cosmos.co.jp', '$2y$10$NRbseewWCZ16GZB8SriFUOFBsPm1OEenUYM.SBPZHEHA0a3dxxFCu', 'Morris John Louise', 'Guillan', 'Ampioco', 'Morris', 'morrisampioco1.jpg', ',2,3,', ',', 5, 5, '1', '09123456789', 8, 20220916, 20270101, 'To be announce', 'To be announce', 0, 20, 1665543279, NULL, NULL, 0, 0),
(8, '2150107', 'jennica-ashley.felix1@trans-cosmos.co.jp', '$2y$10$4W5FgcvzCScRBXYLgMkXUel5peXNkKE3n9VVzo5/unbZLDVHi.unq', 'Jennica Ashley', 'Ortiz', 'Felix', 'Ash', 'ashleyfelix.jpg', ',2,3,', ',', 4, 0, '0', '09123456789', 8, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665546681, NULL, NULL, 0, 0),
(7, '2170052', 'christian.alde1@trans-cosmos.co.jp', '$2y$10$g0u1Fu8PhDrFGvUbhlmGsO975JRxKX//lGXYQmjcWhIpzjGLyR/AW', 'Christian', 'Viray', 'Alde', 'Tian', 'christianalde.jpg', ',2,', ',', 4, 0, '1', '09123456789', 8, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665549646, NULL, NULL, 0, 0),
(9, '2190048', 'exequiel.delfin1@trans-cosmos.co.jp', '$2y$10$q8CtevEOlf607BhX8VfIVOxTNdXHhhgOGgj2EhSfN7H.W8lAODW.i', 'Exequiel', 'Luces', 'Delfin', 'Exe', 'exequieldelfin (1).jpeg', ',1,', ',', 3, 0, '1', '09123456789', 16, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664351467, NULL, NULL, 0, 0),
(10, '2210909', 'raffy.gumapo1@trans-cosmos.co.jp', '$2y$10$Ux2K01ma5ID9G7yngn0LpuDvB7WrH4vhRzG9qHI3U4652rQvrpCpO', 'Raffy', '', 'Gumapo', 'Raffy', 'raffygumapo (1).jpg', ',1,', ',', 1, 0, '1', '09123456789', 16, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664351576, NULL, NULL, 0, 0),
(11, '2210475', 'essel.luna1@trans-cosmos.co.jp', '$2y$10$CdDC.T1TE8zR8RfRnBXhDu/cNcIR.IVeEHDBDoUWcp.mvya.TPJEa', 'Essel May', 'Santiago', 'Luna', 'Essel', 'esselluna (1).jpg', ',1,', ',', 1, 0, '0', '09123456789', 16, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664351607, NULL, NULL, 0, 0),
(12, '2150088', 'antonio.aduna1@trans-cosmos.co.jp', '$2y$10$gLnK0i7HOfDidWMcxHeOJeXNSfT/g91jwSw1M.Tr3hSoTRdvoitOO', 'Antonio Jr.', 'Quimpo', 'Aduna', 'Antonio', 'antonioaduna.jpg', ',1,', ',', 1, 0, '1', '09123456789', 2, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665376388, NULL, NULL, 0, 0),
(13, '2150096', 'joseph-john.mondia1@trans-cosmos.co.jp', '$2y$10$ncGlc1ifLmbpvd53FUfXzeOMQn0i5fPxiUyweqgkgGvw207QBWuYq', 'Joseph John', 'Tubongbanua', 'Mondia', 'JJ', 'josephmondia.jpg', ',1,', ',', 1, 0, '1', '09123456789', 2, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665378232, NULL, NULL, 0, 0),
(14, '2190019', 'monton.julie-ann1@trans-cosmos.co.jp', '$2y$10$k.Fe7ed2xeYcYOU0PUQUmeCA19coa2yK6fxF/F02qDSWS2CHlSazq', 'Julie Ann', 'Lipio', 'Monton', 'Julie', 'juliemonton.jpg', ',1,', ',', 1, 0, '0', '09123456789', 2, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664351793, NULL, NULL, 0, 0),
(15, '2200031', 'philipcarlo.ventura1@trans-cosmos.co.jp', '$2y$10$n/qckiHPiFL2ZOMLqk4l8u/l5Zql7o0J/Hwk98BgO8UquepmhQwiW', 'Phillip Carlo', 'Portinto', 'Ventura', 'Phillip', 'phillipventura.jpg', ',1,', ',', 1, 0, '1', '09123456789', 2, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665380193, NULL, NULL, 0, 0),
(16, '2210339', 'erwina.catacutan1@trans-cosmos.co.jp', '$2y$10$Y8OmJQmhI27fN1FJCoqEQ.O0cUVPX3TIEamHkF8tF0TQdjWb7hci6', 'Erwina', 'Dela Cruz', 'Catacutan', 'Wina', 'erwinacatacutan (1).jpg', ',1,', ',', 1, 0, '0', '09123456789', 3, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664351935, NULL, NULL, 0, 0),
(17, '2210937', 'lorenzo-jr.cruz1@trans-cosmos.co.jp', '$2y$10$V2cnV5zV/P3HsHZwKaCsxuv4swNRcnUg8akyqUz5b5wEVx/4eqXou', 'Lorenzo Jr.', '', 'Cruz', 'Enzo', 'lorenzocruz (1).jpg', ',1,', ',', 1, 0, '1', '09123456789', 3, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664351974, NULL, NULL, 0, 0),
(18, '2217400', 'jeremy-amadeo.dadua1@trans-cosmos.co.jp', '$2y$10$V5olzESsEzA0MnUhbr21.ujB1cpi1iS01TJ2XkMwcUQEDu5oOjI06', 'Jeremy', 'Amadeo', 'Dadua', 'Jeremy', 'jeremydudua (1).jpg', ',1,', ',', 1, 0, '1', '09123456789', 3, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664352040, NULL, NULL, 0, 0),
(19, '2170244', 'revin.galindez1@trans-cosmos.co.jp', '$2y$10$8CX02obxMQu8FvdoPjSRqOJ71h3ZluUoGCmRP1fzrXFGr0Fo2CDeC', 'Revin', 'Santos', 'Galindez', 'Revin', 'revingalindez.jpg', ',1,', ',', 3, 0, '1', '09123456789', 3, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665378051, NULL, NULL, 0, 0),
(20, '2210773', 'mary-joy.bolima1@trans-cosmos.co.jp', '$2y$10$5R3NxFIYEsqWmHI1XfHWR.fbJQk2dub2nPM/DIGs0n5wUM5vssYia', 'Mary Joy', 'Acabado', 'Bolima', 'Mj', 'marybolima (1).jpg', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1664351032, NULL, NULL, 0, 0),
(21, '2210903', 'joseph.catiis1@trans-cosmos.co.jp', '$2y$10$Tpx3GA3CL5VWOMTCGNo0LuiAoqQlO8y5.P/Sn69o7P/lioBrg7whW', 'Joseph', '', 'Catiis', 'Joseph', '', ',3,', ',', 1, 0, '1', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665547200, NULL, NULL, 2, 1665547035),
(22, '2210694', 'iino.yumeka1@trans-cosmos.co.jp', '$2y$10$.LfG2P.I4b77VyPWSFClP.7/27GX/CHWtymMkVOjq/g7Mil95NjdW', 'Yumeka', 'Sioco', 'Iino', 'Yumeka', 'yumekalino.jpg', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664351106, NULL, NULL, 1, 0),
(23, '2210749', 'leonald.lumbad1@trans-cosmos.co.jp', '$2y$10$IvpFzQ4J7/pTmkbGtDXcD.HpVCN3qK8Y1j6AOysA21GsTYMFtSbEu', 'Leonard', 'Arcenilla', 'Lumbad', 'Leona', 'leonardlumbad.jpg', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665378120, NULL, NULL, 0, 0),
(24, '2200015', 'gregorio-r.moraiii1@trans-cosmos.co.jp', '$2y$10$QlKFoxlvkDvfEBlh0tmMPO4/0Yiv5y.2u1X1G1Byl7EOmPQq4pAJe', 'Gregorio Ii', 'Ramos', 'Mora', 'Gary', 'gregoriomora (1).jpg', ',1,', ',', 3, 0, '1', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664351253, NULL, NULL, 0, 0),
(25, '2210813', 'ken.hopep-paril1@trans-cosmos.co.jp', '$2y$10$8avO3B0/ZA/O3s9tIlWgC.3zX18gKL/BkPuLt8yAySYzL49GhYxHu', 'D-pper Ken Hope', 'Ponting', 'Paril', 'Ken', 'kenparil.jpg', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665378384, NULL, NULL, 0, 0),
(26, '2190050', 'ron-lester.rillera1@trans-cosmos.co.jp', '$2y$10$gC1aUqlhNWeR5R0o1YlBpu1ZPKIqaOQWerbJEz2is4LkGO1Mo3lui', 'Ron Lester', 'Vanta', 'Rillera', 'Ron', 'ronrillera (1).png', ',1,', ',', 3, 0, '1', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664351369, NULL, NULL, 0, 0),
(27, '2210785', 'sheila-victoria.s1@trans-cosmos.co.jp', '$2y$10$RlX0X9CKMWQhYuLLJOBsA.ZtpEjqOY2tYBihC24bWxaZqVj0DsBLK', 'Sheila Victoria', 'Cruz', 'Siongco', 'Sheila', 'sheilasiongco.jpg', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665380021, NULL, NULL, 0, 0),
(28, '2170041', 'jessa-faye.abulencia1@trans-cosmos.co.jp', '$2y$10$/fmor8xsguoAp2habTvVz.iC56T2b.DWe5a1oQwvOtMfuNAMlv6ra', 'Jessa Faye', 'Joves', 'Abulencia', 'Jessa', 'jessaabulencia.jpg', ',1,', ',', 1, 0, '0', '09123456789', 4, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664352157, NULL, NULL, 0, 0),
(29, '2190051', 'david-isaac.d1@trans-cosmos.co.jp', '$2y$10$/f4zBStMf6d/oIwy1N/hVOuWE4jcw5ySrUMCT5MK2UHReJA.5Cqy6', 'David Isaac', 'Baclayon', 'Dela Cruz', 'David', 'daviddelacruz.png', ',1,', ',', 1, 0, '1', '09123456789', 4, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665377930, NULL, NULL, 0, 0),
(30, '2190046', 'rachel.robles1@trans-cosmos.co.jp', '$2y$10$IWo265c7vCP76DaAt790FOZiMyYjQTtvN9mYT1oJ2BwhZjWsfTvz.', 'Rachel', '', 'Robles', 'Rachel', 'rachelrobles.jpg', ',1,', ',', 1, 0, '0', '09123456789', 4, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665379193, NULL, NULL, 0, 0),
(31, '2190030', 'james-albert.salva1@trans-cosmos.co.jp', '$2y$10$NmWE6TwxVqDo8c3RDbaxuecEXYlIiHw6FQkWue7I3zQSLrVzD0X7K', 'James Albert', 'San Juan', 'Salva', 'Albert', 'jamessalva (1).jpg', ',3,', ',', 3, 0, '1', '09123456789', 4, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664352351, NULL, NULL, 0, 0),
(32, '2150029', 'joseph-anthony.c1@trans-cosmos.co.jp', '$2y$10$Y6O0jk3KXFGvucvnhjZJbeZf3resVT2NYDDISIbWjVmjibPj0wS/a', 'Joseph Anthony', 'Flores', 'Carpio', 'Jay', 'josephcarpio.jpg', ',1,', ',', 3, 0, '1', '09123456789', 5, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664352403, NULL, NULL, 0, 0),
(33, '2210817', 'joan.francisco1@trans-cosmos.co.jp', '$2y$10$E4.70DzbuijaB1j7qNK/1.TqWb2ry3mQH39FB4Xz5iXgF1HlAG74W', 'Joan', 'Borcelis', 'Francisco', 'Joan', 'joanfrancisco.jpg', ',1,', ',', 1, 0, '0', '09123456789', 5, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665377986, NULL, NULL, 0, 0),
(34, '2210914', 'dexter.nierva1@trans-cosmos.co.jp', '$2y$10$UQgCnHOjcWeJYDqf5yv5V.RK5NtYs/VarcnDwddies.NCwXag1at6', 'Dexter', '', 'Nierva', 'Dex N', 'dexternierva (1).jpg', ',1,', ',', 1, 0, '1', '09123456789', 5, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664352476, NULL, NULL, 0, 0),
(35, '2210499', 'raven.reyes1@trans-cosmos.co.jp', '$2y$10$7rZ.4/5QRkYO.L725ax36ephGnmmmeyIElgUuCsRAs6iNj0SOP8FK', 'Raven Auriesh', 'Corpuz', 'Reyes', 'Raven', 'ravenreyes (1).jpeg', ',3,', ',', 1, 0, '0', '09123456789', 5, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664352559, NULL, NULL, 0, 0),
(36, '2210493', 'jeffrey-andrew.a1@trans-cosmos.co.jp', '$2y$10$F6dzaUOvVFNqdekCyL75Be9EoxhzX4W98CpDQYgxmcqU3d1sAJCTm', 'Jeffrey Andrew', 'Erice', 'Agregado', 'Jeffrey', 'jeffreyagregado.jpg', ',1,', ',', 1, 0, '1', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1664352610, NULL, NULL, 0, 0),
(37, '2190047', 'alexandra.marasigan1@trans-cosmos.co.jp', '$2y$10$qyoZCrtgKYaMec9hiPSks.TrhMgv0p4SzehTeiBRvqDVWG0AGXts.', 'Alexandra', 'Casiple', 'Marasigan', 'Alex', 'alexandramarasigan (1).jpg', ',1,', ',', 1, 0, '0', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664352644, NULL, NULL, 0, 0),
(38, '2200058', 'john-juvir.m1@trans-cosmos.co.jp', '$2y$10$VB2G.ViPzIyc.LsqnEsZg.kUuzV/Vp4XFxmXIMswbrWk6lMyHZJ1C', 'John Juvir', 'Cabuga', 'Monteagudo', 'Juvir', 'johnjuvirmonteagudo.jpg', ',1,', ',', 3, 0, '1', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665378299, NULL, NULL, 0, 0),
(39, '2220005', 'bart.tabusao1@trans-cosmos.co.jp', '$2y$10$oBGg/nQmVankU07TmYhYWujPicaZbP5kZFyl7sPlR.H4.L4UoQm4S', 'Bart', '', 'Tabusao', 'Bart', 'barttabusao (1).jpg', ',1,', ',', 1, 0, '1', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664352757, NULL, NULL, 0, 0),
(40, '2190210', 'crisler-billones.v1@trans-cosmos.co.jp', '$2y$10$5KEQPcFnhveJpcK2d26jmOtMAuf7tSYmuRnrahnR7pxD3qgNh5Vwu', 'Crisler', 'Billones', 'Vallo', 'Cj', 'crislervallo (1).jpg', ',1,', ',', 1, 0, '1', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664352807, NULL, NULL, 0, 0),
(41, '2180182', 'junel.aceres1@trans-cosmos.co.jp', '$2y$10$dBDuPEmpCDaLfVM0Obc5Ie5LGaTVhUM2oOeJ/i364.FDrPkeYapsK', 'Junel', 'De Guzman', 'Aceres', 'Junel', 'junelaceres.jpeg', ',2,3,', ',', 3, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665561001, NULL, NULL, 0, 0),
(42, '2210412', 'michael-angelo.a1@trans-cosmos.co.jp', '$2y$10$O13rZ9hdMllkQ61ZsQWdxOovTL6jRtkCnuZBZWWJw.tAtv8icboY.', 'Michael Angelo', 'De Vera', 'Antipuesto', 'Mike', 'michaelangeloantipuesto.png', ',1,', ',', 1, 0, '1', '09123456789', 1, 20220921, 20270101, 'To be announce', 'Skills to be updated', 0, 20, 1664350319, NULL, NULL, 0, 0),
(43, '2220179', 'kemberly.carig1@trans-cosmos.co.jp', '$2y$10$LBBDUECJ/vlesCDuBVMjgO6Y3uDv0qsxjTrYOdQRlg3bsg4csw/Fi', 'Kemberly', '', 'Carig', 'KC', 'pic.resume.jpg', ',1,', ',', 1, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665376232, NULL, NULL, 0, 0),
(44, '2210413', 'karrilene.dado1@trans-cosmos.co.jp', '$2y$10$beXyptCq32uc8kWIHiHh7O2rsKBxBRe.PtCmJuTg/JpptCCAVZKie', 'Karrilene', 'Palo', 'Dado', 'Karri', '', ',3,', ',', 1, 0, '0', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665560699, NULL, NULL, 2, 1665542819),
(45, '2220090', 'kimberly.de-leon1@trans-cosmos.co.jp', '$2y$10$X520raanCTpie.LNIdiwjOSBWspKRkOiDDt0nZvfAdAcV74cdyfbS', 'Kimberly', 'Nelle', 'De Leon', 'Kim', 'image.png', ',2,3,', ',', 1, 0, '0', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665476359, NULL, NULL, 0, 0),
(46, '2210476', 'jeveca.longakit1@trans-cosmos.co.jp', '$2y$10$36xozTi284AEq3JhX/fwB.j7Qh3nH8i3cli6dHNXQ277AlPOBqEwi', 'Maria Jeveca', 'Huyo-a', 'Longakit', 'Jev', 'marialongakit (1).jpg', ',2,3,', ',', 3, 0, '0', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665386801, NULL, NULL, 0, 0),
(47, '2210784', 'dexter-guzman.m1@trans-cosmos.co.jp', '$2y$10$o66yHZu6i.XemYmICcirKOBczaEVy9eBh2p7LuyoH7lmkNsjiC.3G', 'Dexter', 'Guzman', 'Macabangon', 'Dex', 'dextermacabangon.png', ',1,', ',', 1, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665378176, NULL, NULL, 0, 0),
(48, '2210936', 'juneneil.magnanao1@trans-cosmos.co.jp', '$2y$10$30Te3g2Ult6K1rIbCK6rROvo0eZdqMDE6CrPpayEiyOG/.YzMpNrC', 'June Neil', '', 'Magnanao', 'Neil', 'junemagnanao.jpg', ',1,', ',', 1, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664350589, NULL, NULL, 0, 0),
(49, '2210200', 'angelo.tribiana1@trans-cosmos.co.jp', '$2y$10$U2cawdpzr8VphGW0beac0.mHLxJNaOI9SSsVCJbzfwR2hTy627vhK', 'Michael Angelo', 'Tribiana', 'Manaog', 'Gelo', 'michaelangelomanaog.jpg', ',1,', ',', 1, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664350734, NULL, NULL, 0, 0),
(50, '2160046', 'ian.nicolas1@trans-cosmos.co.jp', '$2y$10$0xpMPduQQqpkxPvrDwtTX.IlTcUkHSnwGPpTTLSC7KkuaCpVnPzBa', 'Ian', 'Gutierez', 'Nicolas', 'Ian', 'iannicolas.jpg', ',2,', ',', 3, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664350785, NULL, NULL, 0, 0),
(51, '2210725', 'john-ryan.verba1@trans-cosmos.co.jp', '$2y$10$8Dt7RIlH12chqtn9ujzH5.e0lGhezsLwXJN.g0QHXAs7n0akZSe9.', 'John Ryan', 'Ting', 'Verba', 'Ry', 'ryanverba.jpg', ',2,3,', ',', 1, 0, '1', '09778021204', 10, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665560844, NULL, NULL, 0, 0),
(52, '2210413', 'karrilene.dado1@trans-cosmos.co.jp', '$2y$10$2pdkGZkmf2dhSWxLVatAGOZNvG3n2LFeIHnvoCSsjVNDT1kRMOKHy', 'Karrilene', 'Palo', 'Dado', 'Karri', 'avatar2.png', ',3,', ',', 1, 0, '0', '09123456789', 10, 20221012, 20270101, 'To be announce', 'To be announce', 0, 20, 0, NULL, NULL, 0, 0),
(53, '2210903', 'joseph.catiis1@trans-cosmos.co.jp', '$2y$10$fuCqrsGeeOR.WRsw.1f0hOAdqGYgeDRo6QIndbIoNPyGm0nIL74LC', 'Joseph', 'De Guzman', 'Catiis', 'Joseph', 'avatar5.png', ',3,', ',', 1, 0, '1', '09123456789', 7, 20221012, 20270101, 'To be announce', 'To be announce', 0, 20, 0, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `webinarandevents`
--

CREATE TABLE `webinarandevents` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL,
  `webinar_host` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `webinar_speaker` varchar(255) NOT NULL,
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

INSERT INTO `webinarandevents` (`id`, `user_id`, `webinar_host`, `webinar_speaker`, `webinar_title`, `webinar_img`, `webinar_description`, `date_set`, `month_set`, `date_created`, `date_edited`, `webinar_status`, `temp_del`, `timestamp`) VALUES
(1, 51, '2180182', '2150029', 'Little Ways You Can Organize', '1664338565_little-ways-to-organize.jpg', 'Little Ways You Can Organize', '20220114', '202201', 'September 28, 2022 - Wednesday - 12:16 pm', '', 0, 0, '2022-09-28 04:16:05'),
(2, 51, '2180182', 'Management Team and Leaders', 'January 2022 General Assembly', 'jan2022GA.jpg', 'January 2022 General Assembly', '20220114', '202201', 'September 28, 2022 - Wednesday - 12:20 pm', 'October 10, 2022 - Monday - 11:49 am', 0, 0, '2022-10-10 03:49:00'),
(3, 51, '2180182', '2210413', 'January 2022 Team Bonding', '1664338916_jan2022team-bonding.jpg', 'January 2022 Team Bonding', '20220114', '202201', 'September 28, 2022 - Wednesday - 12:21 pm', '', 0, 0, '2022-09-28 04:21:56'),
(4, 51, '2180182', 'HRIS Team', 'Connecting Passion With Purpose', '1664338997_passion-with-purpose.jpg', 'Connecting Passion with Purpose', '20220121', '202201', 'September 28, 2022 - Wednesday - 12:23 pm', 'October 12, 2022 - Wednesday - 03:52 pm', 0, 0, '2022-10-12 07:52:41'),
(5, 51, '2210476', 'Management Team and Leaders', 'February 2022 General Assembly', '1664339561_GA Feb2022.JPG', 'February 2022 General Assembly', '20220211', '202202', 'September 28, 2022 - Wednesday - 12:32 pm', 'October 10, 2022 - Monday - 11:51 am', 0, 0, '2022-10-10 03:51:36'),
(6, 51, '2210476', '2210413', 'February 2022 Team Bonding', '1664339732_feb2022team-bonding.jpg', 'February 2022 Team Bonding', '20220211', '202202', 'September 28, 2022 - Wednesday - 12:35 pm', '', 0, 0, '2022-09-28 04:35:32'),
(7, 51, '2180182', 'JM Serminio And Matthew Del Rosario', 'The Importance Of Using Git In Our Jo\'s', '1664339834_using-git-in-jo.jpg', 'The Importance of Using Git in our JO\'s', '20220211', '202202', 'September 28, 2022 - Wednesday - 12:37 pm', 'October 12, 2022 - Wednesday - 03:51 pm', 0, 0, '2022-10-12 07:51:49'),
(8, 51, '2180182', '2210784', 'How To Protect Yourself From Cyber Attacks', 'cyber-attacks.jpg', 'How to Protect Yourself from Cyber Attacks', '20220221', '202202', 'September 28, 2022 - Wednesday - 12:39 pm', 'September 28, 2022 - Wednesday - 12:42 pm', 0, 0, '2022-09-28 04:42:49'),
(9, 51, '2180182', '2160046,2210725,2210476', 'Millennials In Workforce', '1664340015_unnamed (5).jpg', 'Millennials in Workforce ', '20220221', '202202', 'September 28, 2022 - Wednesday - 12:40 pm', 'October 12, 2022 - Wednesday - 03:50 pm', 0, 0, '2022-10-12 07:50:55'),
(10, 51, '2180182', '2150107', 'Clean Coding', '1664340435_clean-coding.jpg', 'Clean Coding', '20220302', '202203', 'September 28, 2022 - Wednesday - 12:47 pm', '', 0, 0, '2022-09-28 04:47:15'),
(11, 51, '2180182', 'Management Team and Leaders', 'March 2022 General Assembly', '1664340481_mar2022GA.jpg', 'March 2022 General Assembly', '20220311', '202203', 'September 28, 2022 - Wednesday - 12:48 pm', 'October 10, 2022 - Monday - 11:50 am', 0, 0, '2022-10-10 03:50:53'),
(12, 51, '2210499', '2210476', 'March 2022 Team Bonding', '1664340555_mar2022team-bonding.jpg', 'March 2022 Team Bonding', '20220311', '202209', 'September 28, 2022 - Wednesday - 12:49 pm', 'September 28, 2022 - Wednesday - 12:49 pm', 0, 0, '2022-09-28 04:49:30'),
(13, 51, '2180182', '2190030,2190046', 'Adobe XD Workshop', 'unnamed (4).jpg', 'Adobe XD Workshop', '20220429', '202204', 'September 28, 2022 - Wednesday - 12:52 pm', 'October 12, 2022 - Wednesday - 03:53 pm', 0, 0, '2022-10-12 07:53:22'),
(14, 51, '2210413', '2210476', 'April 2022 Team Bonding', '1664340803_Ice Breaker Activity April 2022.jpg', 'April 2022 Team Bonding', '20220408', '202204', 'September 28, 2022 - Wednesday - 12:53 pm', '', 0, 0, '2022-09-28 04:53:23'),
(15, 51, '2150107', 'Management Team and Leaders', 'May 2022 General Assembly', '1664346873_MAY 2022 GA.png', 'May 2022 General Assembly', '20220512', '202205', 'September 28, 2022 - Wednesday - 02:34 pm', 'October 10, 2022 - Monday - 11:50 am', 0, 0, '2022-10-10 03:50:21'),
(16, 51, '2210476', '2210413', 'May 2022 Team Bonding', 'May team bonding.png', 'May 2022 Team Bonding', '20220512', '202205', 'September 28, 2022 - Wednesday - 02:35 pm', 'September 28, 2022 - Wednesday - 02:37 pm', 0, 0, '2022-09-28 06:37:23'),
(17, 51, '2180182', '2150107', 'Team Quality', '1664347120_team quality (1).png', 'Team Quality', '20220527', '202205', 'September 28, 2022 - Wednesday - 02:38 pm', '', 0, 0, '2022-09-28 06:38:40'),
(18, 51, '2180182', '2170052', 'Speed Coding: Tips & Tricks', '1664347293_speed coding (1).png', 'Speed Coding: Tips & Tricks', '20220527', '202205', 'September 28, 2022 - Wednesday - 02:41 pm', '', 0, 0, '2022-09-28 06:41:33'),
(19, 51, '2180182', 'Management Team and Leaders', 'June 2022 General Assembly', '1664347387_JUNE GA (1).png', 'June 2022 General Assembly', '20220610', '202206', 'September 28, 2022 - Wednesday - 02:43 pm', 'October 10, 2022 - Monday - 11:49 am', 0, 0, '2022-10-10 03:49:50'),
(20, 51, '2210499', '2210475', 'June 2022 Team Bonding', '1664347469_Ice Breaker.png', 'June 2022 Team Bonding', '20220610', '202209', 'September 28, 2022 - Wednesday - 02:44 pm', 'September 28, 2022 - Wednesday - 02:44 pm', 0, 0, '2022-09-28 06:44:40'),
(21, 51, '2210476', '2180223', 'Email Etiquette', '1664347537_EMAIL ETIQUETTE (1).png', 'Email Etiquette', '20220610', '202206', 'September 28, 2022 - Wednesday - 02:45 pm', '', 0, 0, '2022-09-28 06:45:37'),
(22, 51, '2210499', '2170244', 'Basics Of Handling Wacoal Projects', '1664347628_Basics of Handling Wacoal Project (1).png', 'Basics of Handling Wacoal Projects', '20220624', '202206', 'September 28, 2022 - Wednesday - 02:47 pm', '', 0, 0, '2022-09-28 06:47:08'),
(23, 51, '2180182', '2190048', 'Tips in Handling Multiple Projects with TCAP Setup', '1664347693_Tips in Handling Multiple Projects.png', 'Tips in Handling Multiple Projects with TCAP Setup', '20220624', '202206', 'September 28, 2022 - Wednesday - 02:48 pm', 'October 10, 2022 - Monday - 11:53 am', 0, 0, '2022-10-10 03:53:02'),
(24, 51, '2180182', 'Management Team and Leaders', 'July 2022 General Assembly', '1664347758_JULY GA (1).png', 'July 2022 General Assembly', '20220708', '202207', 'September 28, 2022 - Wednesday - 02:49 pm', 'October 10, 2022 - Monday - 11:49 am', 0, 0, '2022-10-10 03:49:20'),
(25, 51, '2210499', '2210475', 'July 2022 Team Bonding', '1664347832_July Ice Breaker Activity (1).png', 'July 2022 Team Bonding', '20220708', '202207', 'September 28, 2022 - Wednesday - 02:50 pm', '', 0, 0, '2022-09-28 06:50:32'),
(26, 51, '2210903', 'Jun Iwasaki', 'Conversations With Jun Iwasaki', '1664347954_a-talk-with-jun.jpg', 'Conversations with Jun Iwasaki', '20220718', '202207', 'September 28, 2022 - Wednesday - 02:52 pm', '', 0, 0, '2022-09-28 06:52:34'),
(27, 51, '2180182', '2210412', 'How Front-end And Back-end Developers Work Together?', '1664348092_how-developers-work-together.jpg', 'How Front-end And Back-end Developers Work Together?', '20220729', '202207', 'September 28, 2022 - Wednesday - 02:54 pm', 'October 10, 2022 - Monday - 11:25 am', 0, 0, '2022-10-10 03:25:15'),
(28, 51, '2210413', '2210499', 'Enjoy Life By Being Productive', '1664348166_enjoy life by being productive (1).png', 'Enjoy Life by Being Productive', '20220729', '202207', 'September 28, 2022 - Wednesday - 02:56 pm', '', 0, 0, '2022-09-28 06:56:06'),
(29, 51, '2180182', '2180223', 'Usapang Soft Skills', '1664348243_usapang soft skills (1).png', 'Usapang Soft Skills', '20220811', '202208', 'September 28, 2022 - Wednesday - 02:57 pm', '', 0, 0, '2022-09-28 06:57:23'),
(30, 51, '2180182', 'HR Team', 'Employee And Labor Relations With Hr Team', 'employee and labor (1).png', 'Employee and Labor Relations with HR Team', '20220811', '202208', 'September 28, 2022 - Wednesday - 02:58 pm', 'October 10, 2022 - Monday - 11:23 am', 0, 0, '2022-10-10 03:23:46'),
(31, 51, '2180182', '2190051', 'Working Under Pressure', '1664348493_WORKING UNDER PRESSURE.png', 'Working Under Pressure', '20220811', '202208', 'September 28, 2022 - Wednesday - 03:01 pm', '', 0, 0, '2022-09-28 07:01:33'),
(32, 51, '2180182', 'Knowell', 'Introduction To AWS', '1664348608_introduction to aws (1).png', 'Introduction to AWS', '20220811', '202208', 'September 28, 2022 - Wednesday - 03:03 pm', 'October 10, 2022 - Monday - 11:24 am', 0, 0, '2022-10-10 03:24:36'),
(33, 51, '2180182', 'Management Team and Leaders', 'August 2022 General Assembly', '1664348749_AUGUST GA (1).png', 'August 2022 General Assembly', '20220812', '202208', 'September 28, 2022 - Wednesday - 03:05 pm', 'October 10, 2022 - Monday - 11:23 am', 0, 0, '2022-10-10 03:23:20'),
(34, 51, '2210499', '2210476', 'August 2022 Team Bonding', '1664348793_August 2022 Team Bonding.png', 'August 2022 Team Bonding', '20220812', '202208', 'September 28, 2022 - Wednesday - 03:06 pm', '', 0, 0, '2022-09-28 07:06:33'),
(35, 51, '2210476', '2180223', 'Develop Self-awareness Through Mindfulness', '1664348878_12 Aug 2022 - Develop Self Awareness.png', 'Develop Self-awareness through Mindfulness', '20220812', '202208', 'September 28, 2022 - Wednesday - 03:07 pm', '', 0, 0, '2022-09-28 07:07:58'),
(36, 51, '2210725', '2210339', 'SASS Introduction', '1664349113_SASS Intro (1).png', 'SASS Introduction', '20220824', '202208', 'September 28, 2022 - Wednesday - 03:11 pm', 'October 10, 2022 - Monday - 04:15 pm', 0, 0, '2022-10-10 08:15:30'),
(37, 51, '2210499', '2190047', 'Self-improvement Tips To Get Your Life Back On Track', '1664349176_Self Improvement Tips  (1).png', 'Self-improvement Tips To Get Your Life Back On Track', '20220824', '202208', 'September 28, 2022 - Wednesday - 03:12 pm', 'October 10, 2022 - Monday - 11:22 am', 0, 0, '2022-10-10 03:22:11'),
(38, 51, '2210725', 'Management Team and Leaders', 'September 2022 General Assembly', 'general-assembly (1).png', 'September 2022 General Assembly', '20220909', '202209', 'September 28, 2022 - Wednesday - 03:14 pm', 'October 10, 2022 - Monday - 11:18 am', 0, 0, '2022-10-10 03:18:25'),
(39, 51, '2210725', '2220090,2210725', 'September 2022 Team Bonding', '1664349325_ice-breaker.png', 'September 2022 Team Bonding', '20220909', '202209', 'September 28, 2022 - Wednesday - 03:15 pm', 'October 10, 2022 - Monday - 11:20 am', 0, 0, '2022-10-10 03:20:42'),
(40, 51, '2210725', 'Jeff Aguilar of IT Team', 'IT Security', 'IT Security (1).png', 'IT Security', '20220927', '202209', 'September 28, 2022 - Wednesday - 03:16 pm', 'October 10, 2022 - Monday - 11:20 am', 0, 0, '2022-10-10 03:20:04'),
(41, 51, '2210725', '2180223', 'Embracing Change', '1664349444_Embracing Change (2).png', 'Embracing Change', '20220927', '202209', 'September 28, 2022 - Wednesday - 03:17 pm', '', 0, 0, '2022-09-28 07:17:24'),
(42, 51, '', '', '', '1664407681_', '', '19700101', '197001', 'September 29, 2022 - Thursday - 07:28 am', '', 2, 1665373705, '2022-10-10 03:48:25'),
(43, 51, '', '', '', '1664408041_', '', '19700101', '197001', 'September 29, 2022 - Thursday - 07:34 am', '', 2, 1665373720, '2022-10-10 03:48:40'),
(44, 51, '2200057', 'others', 'ryan testing', 'Capture.JPG', 'ryan testing', '20220929', '202209', 'September 29, 2022 - Thursday - 05:55 pm', '', 2, 1664445347, '2022-09-29 09:55:47'),
(45, 51, '2200057', 'Others', 'ryan testing', '', 'ryan testing', '20220929', '202209', 'September 29, 2022 - Thursday - 05:58 pm', 'September 29, 2022 - Thursday - 05:59 pm', 2, 1664445739, '2022-09-29 10:02:19'),
(46, 51, '2200057', 'others', 'ryan testing 101', 'little-ways-to-organize.jpg', 'ryan testing 101', '20221223', '202212', 'September 29, 2022 - Thursday - 06:00 pm', '', 2, 1665371925, '2022-10-10 03:18:45'),
(47, 51, '2150107', 'others', 'ryan testing 202', '', 'ryan testing 202', '20221228', '202212', 'September 29, 2022 - Thursday - 06:01 pm', 'September 29, 2022 - Thursday - 06:04 pm', 2, 1665371920, '2022-10-10 03:18:40'),
(48, 41, '2210903', '2200057', 'ryan testing 30sept2022', 'Ice Breaker Activity April 2022.jpg', 'ryan testing 30sept2022', '20220930', '202209', 'September 30, 2022 - Friday - 02:33 am', '', 2, 1665371930, '2022-10-10 03:18:50'),
(49, 51, '2220090,2210725', '2210040,2170052', 'GIT Training', 'git training logo (1).jpg', 'GIT Training', '20221010', '202210', 'October 10, 2022', '', 0, 0, '2022-10-10 03:35:29'),
(50, 51, '2210903', 'Management Team and Leaders', 'October 2022 General Assembly', 'general-assembly.png', 'October 2022 General Assembly', '20221014', '202210', 'October 10, 2022', '', 0, 0, '2022-10-10 03:36:36'),
(51, 51, '2210903', '2210476,2220179', 'October 2022 Team Bonding', 'ice-breaker.png', 'Ice Breaker Activity: Take a break and have some fun!', '20221014', '202210', 'October 10, 2022', '', 0, 0, '2022-10-10 03:38:08'),
(52, 51, '2210499', '2200057,2220090,2210725', 'DX Info Hub Walkthrough', 'info hub banner (1).jpg', 'DX Info Hub Walkthrough', '20221024', '202210', 'October 10, 2022', 'October 12, 2022 - Wednesday - 10:25 am', 0, 0, '2022-10-12 02:25:59'),
(53, 51, '2150107', '2170052', 'Webinar Live Testing', 'ice-breaker (1).png', 'Webinar Live Testing', '20221223', '202210', 'October 12, 2022', 'October 12, 2022 - Wednesday - 12:05 pm', 0, 0, '2022-10-12 04:05:24');

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
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `webinarandevents`
--
ALTER TABLE `webinarandevents`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
