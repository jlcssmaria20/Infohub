-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 04:43 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `language` int(11) NOT NULL DEFAULT 0,
  `data_per_page` int(11) NOT NULL DEFAULT 20,
  `admin_last_login` int(11) NOT NULL DEFAULT 0,
  `admin_log_attempts` int(11) NOT NULL DEFAULT 0,
  `lockout_timestamp` datetime DEFAULT NULL,
  `admin_status` float NOT NULL DEFAULT 0,
  `temp_del` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_username`, `admin_password`, `admin_firstname`, `admin_lastname`, `language`, `data_per_page`, `admin_last_login`, `admin_log_attempts`, `lockout_timestamp`, `admin_status`, `temp_del`) VALUES
(1, 'superadmin', '$2y$10$V20FOs0HNEu/ggAzHF9dquhjf/472JyT6u4ioMl2LtQJeqH/TRHNK', 'Super', 'Admin', 0, 20, 1669014326, 4, NULL, 0, 0),
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
  `announcements_count` int(1) NOT NULL DEFAULT 0,
  `date_edit` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `announcements_status` int(255) NOT NULL DEFAULT 0,
  `temp_del` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `user_id`, `announcements_title`, `announcements_details`, `announcements_img`, `announcements_count`, `date_edit`, `date_created`, `announcements_status`, `temp_del`, `timestamp`) VALUES
(1, 51, 'TCI Requirement: LMS | TCC102', 'I am writing to ask for everyone’s cooperation to ensure your team’s completion as we are strengthening Transcosmos’ Data and Information Security to create awareness and prevent fraud.\r\n\r\nAll  TCAP employees are required to attend the face-to-face training with our ISMS team - for those regularly reporting onsite or complete the TCC 102 – Compliance Refresher in LMS self-learning Course.\r\n\r\nHere are the step-by-step process of logging in to the Learning Management System (LMS) for first-time users.\r\n1. Go to - tcaptd.tcaseanlms.com\r\n2. To log in – Use TCAP email or the provided username\r\n3. If it’s the first time to log in, the initial password is the same as the username, or use the default password: TC@sean123\r\n4. Assign a new password and follow the requirement\r\na. Forgot Password: Please use the link on the login page. A triggered email for password change will be sent to your TCAP email account.\r\n\r\nAll managers/supervisors will receive a separate email that includes the LMS user ID of their team with additional details within the day, and the target completion is October 7, 2022.\r\n\r\nThank you', 'tcc.png', 0, 'October 18, 2022 - Tuesday - 08:24 pm', 'September 30, 2022 - Friday - 03:28 am', 0, 0, '2022-10-18 12:24:31'),
(2, 51, 'Testing Announcement', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32', 'Events Survey Presentation.jpg', 0, 'October 12, 2022 - Wednesday - 10:38 am', 'October 12, 2022', 2, 1665965241, '2022-10-17 00:07:21'),
(3, 8, 'Rtret', 'rtyrytrfgdgdgfdsfsfsdf', 'unnamed (1).png', 0, 'October 12, 2022 - Wednesday - 11:53 am', 'October 12, 2022', 2, 1665546840, '2022-10-12 03:54:00'),
(4, 45, 'INTERVIEW REGARDING FIRST HALF OF FY - PERFORMANCE ASSESSMENT RESULTS', 'RE: INTERVIEW REGARDING FIRST HALF OF FY - PERFORMANCE ASSESSMENT RESULTS\r\n\r\nKindly check your updated schedule of interview with the Manager... \r\nPlease allot time and see you! Since there are adjustment for some who filed their leaves. \r\n\r\nShould there be concerns, please coordinate with me Sir Morris accordingly. ????', 'performance assessment.jpg', 0, '', 'November 29, 2022', 0, 0, '2022-11-29 03:35:47'),
(5, 45, 'Neww', 'neww', 'performance assessment.jpg', 0, 'November 29, 2022', 'November 29, 2022', 0, 0, '2022-11-29 03:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL DEFAULT 0,
  `document_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `document_description` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_created` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_edited` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `document_status` int(1) NOT NULL DEFAULT 0,
  `temp_del` int(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `document_name`, `document_description`, `date_created`, `date_edited`, `document_status`, `temp_del`, `timestamp`) VALUES
(1, 51, 'Quicklinks', 'Quicklinks', 'September 28, 2022 - Wednesday - 02:18 pm', 'September 28, 2022 - Wednesday - 02:19 pm', 0, 0, '2022-09-27 22:19:53'),
(2, 51, 'New Hire Important Documents', 'New hire importsnt docs', 'September 28, 2022 - Wednesday - 02:24 pm', 'September 28, 2022 - Wednesday - 02:24 pm', 0, 0, '2022-09-27 22:24:50'),
(3, 51, 'Information Security Files', 'Information Security Files description', 'September 28, 2022 - Wednesday - 02:25 pm', 'September 28, 2022 - Wednesday - 02:25 pm', 0, 0, '2022-09-27 22:25:36'),
(4, 51, 'HMO Related Files', 'HMO Related Files description', 'September 28, 2022 - Wednesday - 02:25 pm', 'October 10, 2022 - Monday - 03:27 pm', 0, 0, '2022-10-09 23:27:23'),
(5, 51, 'Developers Training Files', 'Developers Training Files description', 'September 28, 2022 - Wednesday - 02:26 pm', 'September 28, 2022 - Wednesday - 02:27 pm', 0, 0, '2022-09-27 22:27:08'),
(6, 51, 'Bridge Directors Training Files', 'Bridge Directors Training Files Description', 'September 28, 2022 - Wednesday - 02:27 pm', 'September 28, 2022 - Wednesday - 02:28 pm', 0, 0, '2022-09-27 22:28:05'),
(7, 51, 'QA Tracker links', 'QA Tracker links description', 'October 10, 2022 - Monday - 04:31 pm', 'October 10, 2022 - Monday - 04:33 pm', 0, 0, '2022-10-10 00:33:05'),
(16, 45, 'General Links', 'Commonly used links', 'October 25, 2022', 'November 21, 2022 - Monday - 01:46 pm', 0, 0, '2022-11-21 05:46:21'),
(17, 45, 'Sssassssssssssssssssssssssssssssssssssssssssssssss', 'Asssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 'November 29, 2022', '', 0, 0, '2022-11-29 03:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL DEFAULT 0,
  `document_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `document_description` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `document_id` int(10) NOT NULL DEFAULT 0,
  `file_linkname` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `file_link` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_created` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `file_status` int(1) NOT NULL DEFAULT 0,
  `temp_del` int(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `user_id`, `document_name`, `document_description`, `document_id`, `file_linkname`, `file_link`, `date_created`, `file_status`, `temp_del`, `timestamp`) VALUES
(1, 51, 'Quicklinks', '', 1, 'Work From Home Tracker', 'https://docs.google.com/spreadsheets/d/1Ak7STwFwr0-FgMvTW2rcyRYYmAUOfg3yUXwcjV4FbxA/edit#gid=672444593', 'September 28, 2022 - Wednesday - 02:19 pm', 0, 0, '2022-09-28 06:19:53'),
(2, 51, 'Quicklinks', '', 1, 'DX Email Template', 'https://docs.google.com/spreadsheets/d/1DVkVwYD89sNfs8jJ1QrUvvhijKIOdAEv/edit#gid=1666765996', 'September 28, 2022 - Wednesday - 02:19 pm', 0, 0, '2022-09-28 06:19:53'),
(3, 51, 'New Hire Important Documents', '', 2, 'New Hire Important Documents', 'Z:\\DX TCI\\16_DX InfoHub\\New Hire Important Documents', 'September 28, 2022 - Wednesday - 02:24 pm', 0, 0, '2022-09-28 06:24:50'),
(4, 51, 'Information Security Files', '', 3, 'Information Security Files', 'Z:\\DX TCI\\16_DX InfoHub\\Information Security Files', 'September 28, 2022 - Wednesday - 02:25 pm', 0, 0, '2022-09-28 06:25:36'),
(6, 51, 'Developers Training Files', '', 5, 'Developers Training Files', 'Z:\\DX TCI\\16_DX InfoHub\\Developers Training Files', 'September 28, 2022 - Wednesday - 02:27 pm', 0, 0, '2022-09-28 06:27:08'),
(7, 51, 'Bridge Directors Training Files', '', 6, 'Bridge Directors Training Files', 'Z:\\DX TCI\\16_DX InfoHub\\Bridge Directors Training Files', 'September 28, 2022 - Wednesday - 02:28 pm', 0, 0, '2022-09-28 06:28:05'),
(15, 51, 'HMO Related Files', '', 4, 'HMO Related Files', 'Z:\\DX TCI\\16_DX InfoHub\\HMO Related Files', 'September 29, 2022 - Thursday - 06:19 pm', 0, 0, '2022-10-10 07:27:23'),
(17, 51, 'QA Tracker links', '', 7, 'HR Eyes Revamped Ticket Tracker', 'https://docs.google.com/spreadsheets/d/1e_OO6npnPb4n6TEO2NfNs_hH_Cujyv08LqUyJ6iLleE/edit#gid=1410844117', 'October 10, 2022 - Monday - 04:33 pm', 0, 0, '2022-10-10 08:33:05'),
(18, 51, 'QA Tracker links', '', 7, 'DX Info Hub Ticket Tracker', 'https://docs.google.com/spreadsheets/d/1bYeRg_NGaEQzCL6s2j8sPEtqJewpVk7S-7Je9iCkCyM/edit#gid=1084982907', 'October 10, 2022 - Monday - 04:33 pm', 0, 0, '2022-10-10 08:33:05'),
(19, 21, 'Testing Only', '', 8, 'Test Link 1', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 03:52 pm', 0, 0, '2022-10-11 07:52:03'),
(20, 21, 'Testing Only', '', 8, 'Test Link 2', 'https://docs.google.com/spreadsheets/d/1bYeRg_NGaEQzCL6s2j8sPEtqJewpVk7S-7Je9iCkCyM/edit#gid=1572733321', 'October 11, 2022 - Tuesday - 03:52 pm', 0, 0, '2022-10-11 07:52:03'),
(24, 51, 'Ryan New Testing', '', 13, 'HMO Related Files 4', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 04:27 pm', 0, 0, '2022-10-11 08:27:40'),
(25, 51, 'Ryan New Testing', '', 13, 'HMO Related Files 5', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 04:27 pm', 0, 0, '2022-10-11 08:27:40'),
(26, 51, 'Ryan New Testing', '', 13, 'HMO Related Files 6', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 04:27 pm', 0, 0, '2022-10-11 08:27:40'),
(27, 51, 'Ryan New Testing', '', 13, 'HMO Related Files 1', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 04:27 pm', 0, 0, '2022-10-11 08:27:40'),
(28, 51, 'Ryan New Testing', '', 13, 'HMO Related Files 2', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 04:27 pm', 0, 0, '2022-10-11 08:27:40'),
(29, 51, 'Ryan New Testing', '', 13, 'HMO Related Files 3', 'https://docs.google.com/spreadsheets/d/1Ydwiryja4rEmcAWTlca1lIDDoUHTnDhm/edit#gid=1943549513', 'October 11, 2022 - Tuesday - 04:27 pm', 0, 0, '2022-10-11 08:27:40'),
(30, 51, 'Testing', '', 14, 'Tracker 1', 'https://docs.google.com/spreadsheets/d/1bYeRg_NGaEQzCL6s2j8sPEtqJewpVk7S-7Je9iCkCyM/edit#gid=1084982907', 'October 12, 2022 - Wednesday - 10:29 am', 0, 0, '2022-10-12 02:29:28'),
(31, 51, 'Testing', '', 14, 'Tracker 2', 'https://docs.google.com/spreadsheets/d/1Ak7STwFwr0-FgMvTW2rcyRYYmAUOfg3yUXwcjV4FbxA/edit#gid=1869106605', 'October 12, 2022 - Wednesday - 10:29 am', 0, 0, '2022-10-12 02:29:28'),
(32, 1, 'General Links', '', 16, 'Work from home tracker', 'https://docs.google.com/spreadsheets/d/1Ak7STwFwr0-FgMvTW2rcyRYYmAUOfg3yUXwcjV4FbxA/edit#gid=2075401605', 'November 21, 2022 - Monday - 01:46 pm', 0, 0, '2022-11-21 05:46:21'),
(33, 1, 'General Links', '', 16, 'Leaves Tracker', 'https://docs.google.com/spreadsheets/d/1ZdszNL7ITgdCEo02hTQVVuTI3wrVJpi9zz_raw8esvs/edit#gid=0', 'November 21, 2022 - Monday - 01:46 pm', 0, 0, '2022-11-21 05:46:21');

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
  `role_status` int(11) NOT NULL DEFAULT 0,
  `temp_del` int(11) NOT NULL DEFAULT 0
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
  `team_status` int(11) NOT NULL DEFAULT 0,
  `temp_del` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `test_status` int(11) NOT NULL DEFAULT 0,
  `temp_del` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `user_position` int(11) NOT NULL DEFAULT 0,
  `user_level` int(11) NOT NULL DEFAULT 1,
  `user_gender` varchar(100) NOT NULL,
  `user_mobile` varchar(50) NOT NULL DEFAULT '',
  `team_id` bigint(20) NOT NULL DEFAULT 0,
  `user_hiredate` int(11) NOT NULL DEFAULT 0,
  `user_enddate` int(11) NOT NULL DEFAULT 0,
  `user_mantra_in_life` varchar(300) NOT NULL,
  `user_skills` varchar(300) NOT NULL,
  `starting_date` int(11) NOT NULL DEFAULT 0,
  `data_per_page` int(11) NOT NULL DEFAULT 20,
  `user_last_login` int(11) NOT NULL DEFAULT 0,
  `user_log_attempts` int(11) DEFAULT NULL,
  `lockout_timestamp` datetime DEFAULT NULL,
  `user_status` float NOT NULL DEFAULT 0,
  `temp_del` int(11) NOT NULL DEFAULT 0,
  `user_certificate` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_employee_id`, `user_email`, `user_password`, `user_firstname`, `user_middlename`, `user_lastname`, `user_nickname`, `user_photo`, `role_ids`, `permissions`, `user_position`, `user_level`, `user_gender`, `user_mobile`, `team_id`, `user_hiredate`, `user_enddate`, `user_mantra_in_life`, `user_skills`, `starting_date`, `data_per_page`, `user_last_login`, `user_log_attempts`, `lockout_timestamp`, `user_status`, `temp_del`, `user_certificate`) VALUES
(1, '2200057', 'julcess-marie.m1@trans-cosmos.co.jp', '$2y$10$SMpmeXR0kKN8yTY/wY/r8.lvG7ccRcIebe059ZvO2fkz6h4uzwn6.', 'Julcess Marie', 'Papica', 'Mercado', 'Cess', 'julcessmercado.jpg', ',3,', ',', 2, 2, '0', '09754310357', 1, 20220218, 20270101, 'To be Announce', 'JS, PHP, MYSQL', 0, 20, 1669013995, 2, NULL, 0, 0, NULL),
(6, '2210040', 'yves-patrick.b1@trans-cosmos.co.jp', '$2y$10$rFIcHKIZmZcsgMhWJbktw.vOY04z56oo.ZSzLOd4WONMmIRl1ih/2', 'Yves Patrick', 'Valiente', 'Batungbacal', 'Patrick', 'yvesbatungbacal.jpg', ',2,', ',', 4, 0, '0', '09123456789', 8, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664350897, NULL, NULL, 0, 0, NULL),
(3, '2180223', 'ampioco.morris1@trans-cosmos.co.jp', '$2y$10$NRbseewWCZ16GZB8SriFUOFBsPm1OEenUYM.SBPZHEHA0a3dxxFCu', 'Morris John Louise', 'Guillan', 'Ampioco', 'Morris', 'barong 3.jpg', ',2,3,', ',', 5, 5, '1', '09123456789', 8, 20220916, 20270101, 'To be announce', 'To be announce', 0, 20, 1666094516, 1, NULL, 0, 0, NULL),
(8, '2150107', 'jennica-ashley.felix1@trans-cosmos.co.jp', '$2y$10$4W5FgcvzCScRBXYLgMkXUel5peXNkKE3n9VVzo5/unbZLDVHi.unq', 'Jennica Ashley', 'Ortiz', 'Felix', 'Ash', 'ashleyfelix.jpg', ',2,3,', ',', 4, 0, '0', '09123456789', 8, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665546681, NULL, NULL, 0, 0, NULL),
(7, '2170052', 'christian.alde1@trans-cosmos.co.jp', '$2y$10$g0u1Fu8PhDrFGvUbhlmGsO975JRxKX//lGXYQmjcWhIpzjGLyR/AW', 'Christian', 'Viray', 'Alde', 'Tian', 'christianalde.jpg', ',2,', ',', 4, 0, '1', '09123456789', 8, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665549646, NULL, NULL, 0, 0, NULL),
(9, '2190048', 'exequiel.delfin1@trans-cosmos.co.jp', '$2y$10$q8CtevEOlf607BhX8VfIVOxTNdXHhhgOGgj2EhSfN7H.W8lAODW.i', 'Exequiel', 'Luces', 'Delfin', 'Exe', 'exequieldelfin.jpeg', ',1,', ',', 3, 0, '1', '09123456789', 16, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666094976, NULL, NULL, 0, 0, NULL),
(10, '2210909', 'raffy.gumapo1@trans-cosmos.co.jp', '$2y$10$Ux2K01ma5ID9G7yngn0LpuDvB7WrH4vhRzG9qHI3U4652rQvrpCpO', 'Raffy', '', 'Gumapo', 'Raffy', 'raffygumapo.jpg', ',1,', ',', 1, 0, '1', '09123456789', 16, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666095008, NULL, NULL, 0, 0, NULL),
(11, '2210475', 'essel.luna1@trans-cosmos.co.jp', '$2y$10$CdDC.T1TE8zR8RfRnBXhDu/cNcIR.IVeEHDBDoUWcp.mvya.TPJEa', 'Essel May', 'Santiago', 'Luna', 'Essel', 'esselluna.jpg', ',1,', ',', 1, 0, '0', '09123456789', 16, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666095074, NULL, NULL, 0, 0, NULL),
(12, '2150088', 'antonio.aduna1@trans-cosmos.co.jp', '$2y$10$gLnK0i7HOfDidWMcxHeOJeXNSfT/g91jwSw1M.Tr3hSoTRdvoitOO', 'Antonio Jr.', 'Quimpo', 'Aduna', 'Antonio', 'antonioaduna.jpg', ',1,', ',', 1, 0, '1', '09123456789', 2, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665376388, NULL, NULL, 0, 0, NULL),
(13, '2150096', 'joseph-john.mondia1@trans-cosmos.co.jp', '$2y$10$ncGlc1ifLmbpvd53FUfXzeOMQn0i5fPxiUyweqgkgGvw207QBWuYq', 'Joseph John', 'Tubongbanua', 'Mondia', 'JJ', 'josephmondia.jpg', ',1,', ',', 1, 0, '1', '09123456789', 2, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665378232, NULL, NULL, 0, 0, NULL),
(14, '2190019', 'monton.julie-ann1@trans-cosmos.co.jp', '$2y$10$k.Fe7ed2xeYcYOU0PUQUmeCA19coa2yK6fxF/F02qDSWS2CHlSazq', 'Julie Ann', 'Lipio', 'Monton', 'Julie', 'juliemonton.jpg', ',1,', ',', 1, 0, '0', '09123456789', 2, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664351793, NULL, NULL, 0, 0, NULL),
(15, '2200031', 'philipcarlo.ventura1@trans-cosmos.co.jp', '$2y$10$n/qckiHPiFL2ZOMLqk4l8u/l5Zql7o0J/Hwk98BgO8UquepmhQwiW', 'Phillip Carlo', 'Portinto', 'Ventura', 'Phillip', 'phillipventura.jpg', ',1,', ',', 1, 0, '1', '09123456789', 2, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665380193, NULL, NULL, 0, 0, NULL),
(16, '2210339', 'erwina.catacutan1@trans-cosmos.co.jp', '$2y$10$Y8OmJQmhI27fN1FJCoqEQ.O0cUVPX3TIEamHkF8tF0TQdjWb7hci6', 'Erwina', 'Dela Cruz', 'Catacutan', 'Wina', 'erwinacatacutan.jpg', ',1,', ',', 1, 0, '0', '09123456789', 3, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666095608, NULL, NULL, 0, 0, NULL),
(17, '2210937', 'lorenzo-jr.cruz1@trans-cosmos.co.jp', '$2y$10$V2cnV5zV/P3HsHZwKaCsxuv4swNRcnUg8akyqUz5b5wEVx/4eqXou', 'Lorenzo Jr.', '', 'Cruz', 'Enzo', 'lorenzocruz.jpg', ',1,', ',', 1, 0, '1', '09123456789', 3, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666094761, NULL, NULL, 0, 0, NULL),
(18, '2217400', 'jeremy-amadeo.dadua1@trans-cosmos.co.jp', '$2y$10$V5olzESsEzA0MnUhbr21.ujB1cpi1iS01TJ2XkMwcUQEDu5oOjI06', 'Jeremy', 'Amadeo', 'Dadua', 'Jeremy', 'jeremydudua.jpg', ',1,', ',', 1, 0, '1', '09123456789', 3, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666094861, NULL, NULL, 0, 0, NULL),
(19, '2170244', 'revin.galindez1@trans-cosmos.co.jp', '$2y$10$8CX02obxMQu8FvdoPjSRqOJ71h3ZluUoGCmRP1fzrXFGr0Fo2CDeC', 'Revin', 'Santos', 'Galindez', 'Revin', 'revingalindez.jpg', ',1,', ',', 3, 0, '1', '09123456789', 3, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665378051, NULL, NULL, 0, 0, NULL),
(20, '2210773', 'mary-joy.bolima1@trans-cosmos.co.jp', '$2y$10$5R3NxFIYEsqWmHI1XfHWR.fbJQk2dub2nPM/DIGs0n5wUM5vssYia', 'Mary Joy', 'Acabado', 'Bolima', 'Mj', 'Pic.jpg', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1666094695, NULL, NULL, 0, 0, NULL),
(21, '2210903', 'joseph.catiis1@trans-cosmos.co.jp', '$2y$10$Tpx3GA3CL5VWOMTCGNo0LuiAoqQlO8y5.P/Sn69o7P/lioBrg7whW', 'Joseph', '', 'Catiis', 'Joseph', '', ',3,', ',', 1, 0, '1', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665547200, NULL, NULL, 2, 1665547035, NULL),
(22, '2210694', 'iino.yumeka1@trans-cosmos.co.jp', '$2y$10$.LfG2P.I4b77VyPWSFClP.7/27GX/CHWtymMkVOjq/g7Mil95NjdW', 'Yumeka', 'Sioco', 'Iino', 'Yumeka', 'yumekalino.jpg', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664351106, NULL, NULL, 1, 0, NULL),
(23, '2210749', 'leonald.lumbad1@trans-cosmos.co.jp', '$2y$10$IvpFzQ4J7/pTmkbGtDXcD.HpVCN3qK8Y1j6AOysA21GsTYMFtSbEu', 'Leonard', 'Arcenilla', 'Lumbad', 'Leona', 'leonardlumbad.jpg', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665378120, NULL, NULL, 0, 0, NULL),
(24, '2200015', 'gregorio-r.moraiii1@trans-cosmos.co.jp', '$2y$10$QlKFoxlvkDvfEBlh0tmMPO4/0Yiv5y.2u1X1G1Byl7EOmPQq4pAJe', 'Gregorio Ii', 'Ramos', 'Mora', 'Gary', 'gregoriomora.jpg', ',1,', ',', 3, 0, '1', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666095646, NULL, NULL, 0, 0, NULL),
(25, '2210813', 'ken.hopep-paril1@trans-cosmos.co.jp', '$2y$10$8avO3B0/ZA/O3s9tIlWgC.3zX18gKL/BkPuLt8yAySYzL49GhYxHu', 'D-pper Ken Hope', 'Ponting', 'Paril', 'Ken', 'kenparil.jpg', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665378384, NULL, NULL, 0, 0, NULL),
(26, '2190050', 'ron-lester.rillera1@trans-cosmos.co.jp', '$2y$10$gC1aUqlhNWeR5R0o1YlBpu1ZPKIqaOQWerbJEz2is4LkGO1Mo3lui', 'Ron Lester', 'Vanta', 'Rillera', 'Ron', 'ronrillera.png', ',1,', ',', 3, 0, '1', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666095205, NULL, NULL, 0, 0, NULL),
(27, '2210785', 'sheila-victoria.s1@trans-cosmos.co.jp', '$2y$10$RlX0X9CKMWQhYuLLJOBsA.ZtpEjqOY2tYBihC24bWxaZqVj0DsBLK', 'Sheila Victoria', 'Cruz', 'Siongco', 'Sheila', 'sheilasiongco.jpg', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665380021, NULL, NULL, 0, 0, NULL),
(28, '2170041', 'jessa-faye.abulencia1@trans-cosmos.co.jp', '$2y$10$/fmor8xsguoAp2habTvVz.iC56T2b.DWe5a1oQwvOtMfuNAMlv6ra', 'Jessa Faye', 'Joves', 'Abulencia', 'Jessa', 'jessaabulencia.jpg', ',1,', ',', 1, 0, '0', '09123456789', 4, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664352157, NULL, NULL, 0, 0, NULL),
(29, '2190051', 'david-isaac.d1@trans-cosmos.co.jp', '$2y$10$/f4zBStMf6d/oIwy1N/hVOuWE4jcw5ySrUMCT5MK2UHReJA.5Cqy6', 'David Isaac', 'Baclayon', 'Dela Cruz', 'David', 'daviddelacruz.png', ',1,', ',', 1, 0, '1', '09123456789', 4, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665377930, NULL, NULL, 0, 0, NULL),
(30, '2190046', 'rachel.robles1@trans-cosmos.co.jp', '$2y$10$IWo265c7vCP76DaAt790FOZiMyYjQTtvN9mYT1oJ2BwhZjWsfTvz.', 'Rachel', '', 'Robles', 'Rachel', 'rachelrobles.jpg', ',1,', ',', 1, 0, '0', '09123456789', 4, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665379193, NULL, NULL, 0, 0, NULL),
(31, '2190030', 'james-albert.salva1@trans-cosmos.co.jp', '$2y$10$NmWE6TwxVqDo8c3RDbaxuecEXYlIiHw6FQkWue7I3zQSLrVzD0X7K', 'James Albert', 'San Juan', 'Salva', 'Albert', 'jamessalva.jpg', ',3,', ',', 3, 0, '1', '09123456789', 4, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666095235, NULL, NULL, 0, 0, NULL),
(32, '2150029', 'joseph-anthony.c1@trans-cosmos.co.jp', '$2y$10$Y6O0jk3KXFGvucvnhjZJbeZf3resVT2NYDDISIbWjVmjibPj0wS/a', 'Joseph Anthony', 'Flores', 'Carpio', 'Jay', 'josephcarpio.jpg', ',1,', ',', 3, 0, '1', '09123456789', 5, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664352403, NULL, NULL, 0, 0, NULL),
(33, '2210817', 'joan.francisco1@trans-cosmos.co.jp', '$2y$10$E4.70DzbuijaB1j7qNK/1.TqWb2ry3mQH39FB4Xz5iXgF1HlAG74W', 'Joan', 'Borcelis', 'Francisco', 'Joan', 'joanfrancisco.jpg', ',3,1,', ',', 1, 0, '0', '09123456789', 5, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665377986, NULL, NULL, 0, 0, NULL),
(34, '2210914', 'dexter.nierva1@trans-cosmos.co.jp', '$2y$10$UQgCnHOjcWeJYDqf5yv5V.RK5NtYs/VarcnDwddies.NCwXag1at6', 'Dexter', '', 'Nierva', 'Dex N', 'dexternierva.jpg', ',1,', ',', 1, 0, '1', '09123456789', 5, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666095143, NULL, NULL, 0, 0, NULL),
(35, '2210499', 'raven.reyes1@trans-cosmos.co.jp', '$2y$10$7rZ.4/5QRkYO.L725ax36ephGnmmmeyIElgUuCsRAs6iNj0SOP8FK', 'Raven Auriesh', 'Corpuz', 'Reyes', 'Raven', 'ravenreyes.jpeg', ',3,', ',', 1, 0, '0', '09123456789', 5, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666095177, NULL, NULL, 0, 0, NULL),
(36, '2210493', 'jeffrey-andrew.a1@trans-cosmos.co.jp', '$2y$10$F6dzaUOvVFNqdekCyL75Be9EoxhzX4W98CpDQYgxmcqU3d1sAJCTm', 'Jeffrey Andrew', 'Erice', 'Agregado', 'Jeffrey', 'jeffreyagregado.jpg', ',1,', ',', 1, 0, '1', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1664352610, NULL, NULL, 0, 0, NULL),
(37, '2190047', 'alexandra.marasigan1@trans-cosmos.co.jp', '$2y$10$qyoZCrtgKYaMec9hiPSks.TrhMgv0p4SzehTeiBRvqDVWG0AGXts.', 'Alexandra', 'Casiple', 'Marasigan', 'Alex', 'alexandramarasigan.jpg', ',1,', ',', 1, 0, '0', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666095103, NULL, NULL, 0, 0, NULL),
(38, '2200058', 'john-juvir.m1@trans-cosmos.co.jp', '$2y$10$VB2G.ViPzIyc.LsqnEsZg.kUuzV/Vp4XFxmXIMswbrWk6lMyHZJ1C', 'John Juvir', 'Cabuga', 'Monteagudo', 'Juvir', 'johnjuvirmonteagudo.jpg', ',1,', ',', 3, 0, '1', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665378299, NULL, NULL, 0, 0, NULL),
(39, '2220005', 'bart.tabusao1@trans-cosmos.co.jp', '$2y$10$oBGg/nQmVankU07TmYhYWujPicaZbP5kZFyl7sPlR.H4.L4UoQm4S', 'Bart', '', 'Tabusao', 'Bart', 'barttabusao.jpg', ',1,', ',', 1, 0, '1', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666095501, NULL, NULL, 0, 0, NULL),
(40, '2190210', 'crisler-billones.v1@trans-cosmos.co.jp', '$2y$10$5KEQPcFnhveJpcK2d26jmOtMAuf7tSYmuRnrahnR7pxD3qgNh5Vwu', 'Crisler', 'Billones', 'Vallo', 'Cj', 'crislervallo.jpg', ',1,', ',', 1, 0, '1', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666095532, NULL, NULL, 0, 0, NULL),
(41, '2180182', 'junel.aceres1@trans-cosmos.co.jp', '$2y$10$dBDuPEmpCDaLfVM0Obc5Ie5LGaTVhUM2oOeJ/i364.FDrPkeYapsK', 'Junel', 'De Guzman', 'Aceres', 'Junel', 'junelaceres.jpeg', ',2,3,', ',', 3, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1666736831, NULL, NULL, 0, 0, NULL),
(42, '2210412', 'michael-angelo.a1@trans-cosmos.co.jp', '$2y$10$O13rZ9hdMllkQ61ZsQWdxOovTL6jRtkCnuZBZWWJw.tAtv8icboY.', 'Michael Angelo', 'De Vera', 'Antipuesto', 'Mike', 'michaelangeloantipuesto.png', ',1,', ',', 1, 0, '1', '09123456789', 1, 20220921, 20270101, 'To be announce', 'Skills to be updated', 0, 20, 1664350319, NULL, NULL, 0, 0, NULL),
(43, '2220179', 'kemberly.carig1@trans-cosmos.co.jp', '$2y$10$LBBDUECJ/vlesCDuBVMjgO6Y3uDv0qsxjTrYOdQRlg3bsg4csw/Fi', 'Kemberly', '', 'Carig', 'KC', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1666095686, 2, NULL, 0, 0, NULL),
(44, '2210413', 'karrilene.dado1@trans-cosmos.co.jp', '$2y$10$beXyptCq32uc8kWIHiHh7O2rsKBxBRe.PtCmJuTg/JpptCCAVZKie', 'Karrilene', 'Palo', 'Dado', 'Karri', '', ',3,', ',', 1, 0, '0', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1665965808, 3, NULL, 2, 1665542819, NULL),
(45, '2220090', 'kimberly.de-leon1@trans-cosmos.co.jp', '$2y$10$X520raanCTpie.LNIdiwjOSBWspKRkOiDDt0nZvfAdAcV74cdyfbS', 'Kimberly', 'Nelle', 'De Leon', 'Kim', 'avatar2.png', ',2,3,', ',', 1, 0, '0', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1669692568, 5, '2022-11-21 16:05:03', 0, 0, NULL),
(46, '2210476', 'jeveca.longakit1@trans-cosmos.co.jp', '$2y$10$36xozTi284AEq3JhX/fwB.j7Qh3nH8i3cli6dHNXQ277AlPOBqEwi', 'Maria Jeveca', 'Huyo-a', 'Longakit', 'Jev', 'marialongakit.jpg', ',2,3,', ',', 3, 0, '0', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1666095043, NULL, NULL, 0, 0, NULL),
(47, '2210784', 'dexter-guzman.m1@trans-cosmos.co.jp', '$2y$10$o66yHZu6i.XemYmICcirKOBczaEVy9eBh2p7LuyoH7lmkNsjiC.3G', 'Dexter', 'Guzman', 'Macabangon', 'Dex', 'dextermacabangon.png', ',1,', ',', 1, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665378176, NULL, NULL, 0, 0, NULL),
(48, '2210936', 'juneneil.magnanao1@trans-cosmos.co.jp', '$2y$10$30Te3g2Ult6K1rIbCK6rROvo0eZdqMDE6CrPpayEiyOG/.YzMpNrC', 'June Neil', '', 'Magnanao', 'Neil', 'junemagnanao.jpg', ',1,', ',', 1, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664350589, NULL, NULL, 0, 0, NULL),
(49, '2210200', 'angelo.tribiana1@trans-cosmos.co.jp', '$2y$10$U2cawdpzr8VphGW0beac0.mHLxJNaOI9SSsVCJbzfwR2hTy627vhK', 'Michael Angelo', 'Tribiana', 'Manaog', 'Gelo', 'michaelangelomanaog.jpg', ',1,', ',', 1, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664350734, NULL, NULL, 0, 0, NULL),
(50, '2160046', 'ian.nicolas1@trans-cosmos.co.jp', '$2y$10$0xpMPduQQqpkxPvrDwtTX.IlTcUkHSnwGPpTTLSC7KkuaCpVnPzBa', 'Ian', 'Gutierez', 'Nicolas', 'Ian', 'iannicolas.jpg', ',2,', ',', 3, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664350785, NULL, NULL, 0, 0, NULL),
(51, '2210725', 'john-ryan.verba1@trans-cosmos.co.jp', '$2y$10$8Dt7RIlH12chqtn9ujzH5.e0lGhezsLwXJN.g0QHXAs7n0akZSe9.', 'John Ryan', 'Ting', 'Verba', 'Ry', 'ryanverba.jpg', ',2,3,', ',', 1, 0, '1', '09778021204', 10, 20220921, 20270101, 'To be announce', 'To be announce', 0, 20, 1665560844, NULL, NULL, 0, 0, NULL),
(52, '2210413', 'karrilene.dado1@trans-cosmos.co.jp', '$2y$10$2pdkGZkmf2dhSWxLVatAGOZNvG3n2LFeIHnvoCSsjVNDT1kRMOKHy', 'Karrilene', 'Palo', 'Dado', 'Karri', 'avatar2.png', ',3,', ',', 1, 0, '0', '09123456789', 10, 20221012, 20270101, 'To be announce', 'To be announce', 0, 20, 0, 3, NULL, 1, 0, NULL),
(53, '2210903', 'joseph.catiis1@trans-cosmos.co.jp', '$2y$10$fuCqrsGeeOR.WRsw.1f0hOAdqGYgeDRo6QIndbIoNPyGm0nIL74LC', 'Joseph', 'De Guzman', 'Catiis', 'Joseph', 'avatar5.png', ',3,', ',', 1, 0, '1', '09123456789', 7, 20221012, 20270101, 'To be announce', 'To be announce', 0, 20, 0, NULL, NULL, 0, 0, NULL),
(54, '2220080', 'new-user1@gmail.com', '$2y$10$lFbTBrTN0Yz0Pc69oRMSk.eFosYN4nIIuUCEc5.xY8A8MigueFRZi', 'Juan', 'Dela', 'Cruz', 'One', 'rachelrobles.JPG', ',1,', ',', 1, 2, '1', '09287646683', 7, 20221015, 20270101, 'Its the fear of looking stupid that stops us from being awesome. Its the fear of looking stupid that stops us from being awesome.', 'HTML, CSS and JavascriptHTML, CSS and JavascriptHTML, CSS and Javascript', 0, 20, 1665965489, NULL, NULL, 0, 0, NULL),
(55, '2220070', 'new-user2@gmail.com', '$2y$10$D6aAGnmnGTYDnHLjl.KCPOmKiAElEOIPH3uw/LHfgkmOhc6N5kpAe', 'Angel', 'Anne', 'Anjo', 'Ala', 'avatar2.png', ',1,', ',', 1, 0, '0', '09287646683', 7, 20221017, 20270101, 'Its the fear of looking stupid that stops us from being awesome. ', 'HTML, CSS and JavascriptHTML, CSS and Javascript', 0, 20, 0, NULL, NULL, 0, 0, NULL);

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
  `webinar_status` int(1) NOT NULL DEFAULT 0,
  `temp_del` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `webinarandevents`
--

INSERT INTO `webinarandevents` (`id`, `user_id`, `webinar_host`, `webinar_speaker`, `webinar_title`, `webinar_img`, `webinar_description`, `date_set`, `month_set`, `date_created`, `date_edited`, `webinar_status`, `temp_del`, `timestamp`) VALUES
(1, 51, '2180182', '2150029', 'Little Ways You Can Organize', 'little-ways-to-organize.jpg', 'Little Ways You Can Organize', '20220114', '202201', 'September 28, 2022 - Wednesday - 12:16 pm', 'October 18, 2022 - Tuesday - 07:56 pm', 0, 0, '2022-10-18 11:56:35'),
(2, 51, '2180182', 'Management Team and Leaders', 'January 2022 General Assembly', 'jan2022GA.jpg', 'January 2022 General Assembly', '20220114', '202201', 'September 28, 2022 - Wednesday - 12:20 pm', 'October 18, 2022 - Tuesday - 07:56 pm', 0, 0, '2022-10-18 11:56:57'),
(3, 51, '2180182', '2210413', 'January 2022 Team Bonding', 'jan2022team-bonding.jpg', 'January 2022 Team Bonding', '20220114', '202201', 'September 28, 2022 - Wednesday - 12:21 pm', 'October 18, 2022 - Tuesday - 07:57 pm', 0, 0, '2022-10-18 11:57:14'),
(4, 51, '2180182', 'HRIS Team', 'Connecting Passion With Purpose', 'passion-with-purpose.jpg', 'Connecting Passion with Purpose', '20220121', '202201', 'September 28, 2022 - Wednesday - 12:23 pm', 'October 18, 2022 - Tuesday - 07:56 pm', 0, 0, '2022-10-18 11:56:22'),
(5, 51, '2210476', 'Management Team and Leaders', 'February 2022 General Assembly', 'GA Feb2022.JPG', 'February 2022 General Assembly', '20220211', '202202', 'September 28, 2022 - Wednesday - 12:32 pm', 'October 18, 2022 - Tuesday - 07:55 pm', 0, 0, '2022-10-18 11:55:25'),
(6, 51, '2210476', '2210413', 'February 2022 Team Bonding', 'feb2022team-bonding.jpg', 'February 2022 Team Bonding', '20220211', '202202', 'September 28, 2022 - Wednesday - 12:35 pm', 'October 18, 2022 - Tuesday - 07:55 pm', 0, 0, '2022-10-18 11:55:48'),
(7, 51, '2180182', 'JM Serminio And Matthew Del Rosario', 'The Importance Of Using Git In Our Jo\'s', 'using-git-in-jo.jpg', 'The Importance of Using Git in our JO\'s', '20220211', '202202', 'September 28, 2022 - Wednesday - 12:37 pm', 'October 18, 2022 - Tuesday - 07:55 pm', 0, 0, '2022-10-18 11:55:59'),
(8, 51, '2180182', '2210784', 'How To Protect Yourself From Cyber Attacks', 'cyber-attacks.jpg', 'How to Protect Yourself from Cyber Attacks', '20220221', '202202', 'September 28, 2022 - Wednesday - 12:39 pm', 'October 18, 2022 - Tuesday - 07:54 pm', 0, 0, '2022-10-18 11:54:52'),
(9, 51, '2180182', '2160046,2210725,2210476', 'Millennials In Workforce', 'Millennials.jpg', 'Millennials in Workforce ', '20220221', '202202', 'September 28, 2022 - Wednesday - 12:40 pm', 'October 18, 2022 - Tuesday - 07:55 pm', 0, 0, '2022-10-18 11:55:08'),
(10, 51, '2180182', '2150107', 'Clean Coding', 'clean-coding.jpg', 'Clean Coding', '20220302', '202203', 'September 28, 2022 - Wednesday - 12:47 pm', 'October 18, 2022 - Tuesday - 07:54 pm', 0, 0, '2022-10-18 11:54:35'),
(11, 51, '2180182', 'Management Team and Leaders', 'March 2022 General Assembly', 'mar2022GA.jpg', 'March 2022 General Assembly', '20220311', '202203', 'September 28, 2022 - Wednesday - 12:48 pm', 'October 18, 2022 - Tuesday - 07:53 pm', 0, 0, '2022-10-18 11:53:59'),
(12, 51, '2210499', '2210476', 'March 2022 Team Bonding', 'mar2022team-bonding.jpg', 'March 2022 Team Bonding', '20220311', '202209', 'September 28, 2022 - Wednesday - 12:49 pm', 'October 18, 2022 - Tuesday - 07:54 pm', 0, 0, '2022-10-18 11:54:14'),
(13, 51, '2180182', '2190030,2190046', 'Adobe XD Workshop', 'Adobe XD.jpg', 'Adobe XD Workshop', '20220429', '202204', 'September 28, 2022 - Wednesday - 12:52 pm', 'October 18, 2022 - Tuesday - 07:52 pm', 0, 0, '2022-10-18 11:52:16'),
(14, 51, '2190030', '2210476', 'April 2022 Team Bonding', 'Ice Breaker Activity April 2022.jpg', 'April 2022 Team Bonding', '20220408', '202204', 'September 28, 2022 - Wednesday - 12:53 pm', 'October 18, 2022 - Tuesday - 07:53 pm', 0, 0, '2022-10-18 11:53:36'),
(15, 51, '2150107', 'Management Team and Leaders', 'May 2022 General Assembly', 'MAY 2022 GENERAL ASSEMBLY.png', 'May 2022 General Assembly', '20220512', '202205', 'September 28, 2022 - Wednesday - 02:34 pm', 'October 18, 2022 - Tuesday - 07:51 pm', 0, 0, '2022-10-18 11:51:18'),
(16, 51, '2210476', '2210413', 'May 2022 Team Bonding', 'May team bonding.jpg', 'May 2022 Team Bonding', '20220512', '202205', 'September 28, 2022 - Wednesday - 02:35 pm', 'October 18, 2022 - Tuesday - 07:51 pm', 0, 0, '2022-10-18 11:51:33'),
(17, 51, '2180182', '2150107', 'Team Quality', 'team quality.png', 'Team Quality', '20220527', '202205', 'September 28, 2022 - Wednesday - 02:38 pm', 'October 18, 2022 - Tuesday - 07:50 pm', 0, 0, '2022-10-18 11:50:18'),
(18, 51, '2180182', '2170052', 'Speed Coding: Tips & Tricks', 'speed coding.jpg', 'Speed Coding: Tips & Tricks', '20220527', '202205', 'September 28, 2022 - Wednesday - 02:41 pm', 'October 18, 2022 - Tuesday - 07:50 pm', 0, 0, '2022-10-18 11:50:35'),
(19, 51, '2180182', 'Management Team and Leaders', 'June 2022 General Assembly', 'JUNE GA.png', 'June 2022 General Assembly', '20220610', '202206', 'September 28, 2022 - Wednesday - 02:43 pm', 'October 18, 2022 - Tuesday - 07:49 pm', 0, 0, '2022-10-18 11:49:23'),
(20, 51, '2210499', '2210475', 'June 2022 Team Bonding', 'Ice Breaker.png', 'June 2022 Team Bonding', '20220610', '202209', 'September 28, 2022 - Wednesday - 02:44 pm', 'October 18, 2022 - Tuesday - 07:49 pm', 0, 0, '2022-10-18 11:49:41'),
(21, 51, '2210476', '2180223', 'Email Etiquette', 'EMAIL ETIQUETTE.png', 'Email Etiquette', '20220610', '202206', 'September 28, 2022 - Wednesday - 02:45 pm', 'October 18, 2022 - Tuesday - 07:49 pm', 0, 0, '2022-10-18 11:49:56'),
(22, 51, '2210499', '2170244', 'Basics Of Handling Wacoal Projects', 'Basics of Handling Wacoal Project.jpg', 'Basics of Handling Wacoal Projects', '20220624', '202206', 'September 28, 2022 - Wednesday - 02:47 pm', 'October 18, 2022 - Tuesday - 07:48 pm', 0, 0, '2022-10-18 11:48:30'),
(23, 51, '2180182', '2190048', 'Tips in Handling Multiple Projects with TCAP Setup', 'Tips in Handling Multiple Projects.png', 'Tips in Handling Multiple Projects with TCAP Setup', '20220624', '202206', 'September 28, 2022 - Wednesday - 02:48 pm', 'October 18, 2022 - Tuesday - 07:48 pm', 0, 0, '2022-10-18 11:48:46'),
(24, 51, '2180182', 'Management Team and Leaders', 'July 2022 General Assembly', 'JULY GA.png', 'July 2022 General Assembly', '20220708', '202207', 'September 28, 2022 - Wednesday - 02:49 pm', 'October 18, 2022 - Tuesday - 07:47 pm', 0, 0, '2022-10-18 11:47:38'),
(25, 51, '2210499', '2210475', 'July 2022 Team Bonding', 'July Ice Breaker Activity (1).png', 'July 2022 Team Bonding', '20220708', '202207', 'September 28, 2022 - Wednesday - 02:50 pm', 'October 18, 2022 - Tuesday - 07:48 pm', 0, 0, '2022-10-18 11:48:06'),
(26, 51, '2210903', 'Jun Iwasaki', 'Conversations With Jun Iwasaki', 'a-talk-with-jun.jpg', 'Conversations with Jun Iwasaki', '20220718', '202207', 'September 28, 2022 - Wednesday - 02:52 pm', 'October 18, 2022 - Tuesday - 07:47 pm', 0, 0, '2022-10-18 11:47:23'),
(27, 51, '2180182', '2210412', 'How Front-end And Back-end Developers Work Together?', 'how-developers-work-together.jpg', 'How Front-end And Back-end Developers Work Together?', '20220729', '202207', 'September 28, 2022 - Wednesday - 02:54 pm', 'October 18, 2022 - Tuesday - 07:45 pm', 0, 0, '2022-10-18 11:45:40'),
(28, 51, '2190030', '2210499', 'Enjoy Life By Being Productive', 'defaultbanner.png', 'Enjoy Life by Being Productive', '20220729', '202207', 'September 28, 2022 - Wednesday - 02:56 pm', 'October 18, 2022 - Tuesday - 08:40 pm', 0, 0, '2022-10-18 12:40:43'),
(29, 51, '2180182', '2180223', 'Usapang Soft Skills', 'usapang soft skills.png', 'Usapang Soft Skills', '20220811', '202208', 'September 28, 2022 - Wednesday - 02:57 pm', 'October 18, 2022 - Tuesday - 07:44 pm', 0, 0, '2022-10-18 11:44:40'),
(30, 51, '2180182', 'HR Team', 'Employee And Labor Relations With Hr Team', 'employee and labor.png', 'Employee and Labor Relations with HR Team', '20220811', '202208', 'September 28, 2022 - Wednesday - 02:58 pm', 'October 18, 2022 - Tuesday - 07:44 pm', 0, 0, '2022-10-18 11:44:56'),
(31, 51, '2180182', '2190051', 'Working Under Pressure', 'WORKING UNDER PRESSURE.png', 'Working Under Pressure', '20220811', '202208', 'September 28, 2022 - Wednesday - 03:01 pm', 'October 18, 2022 - Tuesday - 07:45 pm', 0, 0, '2022-10-18 11:45:13'),
(32, 51, '2180182', 'Knowell', 'Introduction To AWS', 'introduction to aws.png', 'Introduction to AWS', '20220811', '202208', 'September 28, 2022 - Wednesday - 03:03 pm', 'October 18, 2022 - Tuesday - 07:45 pm', 0, 0, '2022-10-18 11:45:23'),
(33, 51, '2180182', 'Management Team and Leaders', 'August 2022 General Assembly', 'AUGUST GA.png', 'August 2022 General Assembly', '20220812', '202208', 'September 28, 2022 - Wednesday - 03:05 pm', 'October 18, 2022 - Tuesday - 07:43 pm', 0, 0, '2022-10-18 11:43:36'),
(34, 51, '2210499', '2210476', 'August 2022 Team Bonding', 'August 2022 Team Bonding.png', 'August 2022 Team Bonding', '20220812', '202208', 'September 28, 2022 - Wednesday - 03:06 pm', 'October 18, 2022 - Tuesday - 07:43 pm', 0, 0, '2022-10-18 11:43:51'),
(35, 51, '2210476', '2180223', 'Develop Self-awareness Through Mindfulness', '12 Aug 2022 - Develop Self Awareness.jpg', 'Develop Self-awareness through Mindfulness', '20220812', '202208', 'September 28, 2022 - Wednesday - 03:07 pm', 'October 18, 2022 - Tuesday - 07:44 pm', 0, 0, '2022-10-18 11:44:05'),
(36, 51, '2210725', '2210339', 'SASS Introduction', 'SASS Intro.png', 'SASS Introduction', '20220824', '202208', 'September 28, 2022 - Wednesday - 03:11 pm', 'October 18, 2022 - Tuesday - 07:42 pm', 0, 0, '2022-10-18 11:42:58'),
(37, 51, '2210499', '2190047', 'Self-improvement Tips To Get Your Life Back On Track', 'Self Improvement Tips  (1).png', 'Self-improvement Tips To Get Your Life Back On Track', '20220824', '202208', 'September 28, 2022 - Wednesday - 03:12 pm', 'October 18, 2022 - Tuesday - 07:43 pm', 0, 0, '2022-10-18 11:43:24'),
(38, 51, '2210725', 'Management Team and Leaders', 'September 2022 General Assembly', 'general-assembly (1).png', 'September 2022 General Assembly', '20220909', '202209', 'September 28, 2022 - Wednesday - 03:14 pm', 'October 18, 2022 - Tuesday - 07:42 pm', 0, 0, '2022-10-18 11:42:02'),
(39, 51, '2210725', '2220090,2210725', 'September 2022 Team Bonding', 'ice-breaker (1).png', 'September 2022 Team Bonding', '20220909', '202209', 'September 28, 2022 - Wednesday - 03:15 pm', 'October 18, 2022 - Tuesday - 07:42 pm', 0, 0, '2022-10-18 11:42:21'),
(40, 51, '2210725', 'Jeff Aguilar of IT Team', 'IT Security', 'IT Security.png', 'IT Security', '20220927', '202209', 'September 28, 2022 - Wednesday - 03:16 pm', 'October 18, 2022 - Tuesday - 07:41 pm', 0, 0, '2022-10-18 11:41:27'),
(41, 51, '2210725', '2180223', 'Embracing Change', 'Embracing Change.png', 'Embracing Change', '20220927', '202209', 'September 28, 2022 - Wednesday - 03:17 pm', 'October 18, 2022 - Tuesday - 07:41 pm', 0, 0, '2022-10-18 11:41:41'),
(42, 51, '', '', '', '1664407681_', '', '19700101', '197001', 'September 29, 2022 - Thursday - 07:28 am', '', 2, 1665373705, '2022-10-10 03:48:25'),
(43, 51, '', '', '', '1664408041_', '', '19700101', '197001', 'September 29, 2022 - Thursday - 07:34 am', '', 2, 1665373720, '2022-10-10 03:48:40'),
(44, 51, '2200057', 'others', 'ryan testing', 'Capture.JPG', 'ryan testing', '20220929', '202209', 'September 29, 2022 - Thursday - 05:55 pm', '', 2, 1664445347, '2022-09-29 09:55:47'),
(45, 51, '2200057', 'Others', 'ryan testing', '', 'ryan testing', '20220929', '202209', 'September 29, 2022 - Thursday - 05:58 pm', 'September 29, 2022 - Thursday - 05:59 pm', 2, 1664445739, '2022-09-29 10:02:19'),
(46, 51, '2200057', 'others', 'ryan testing 101', 'little-ways-to-organize.jpg', 'ryan testing 101', '20221223', '202212', 'September 29, 2022 - Thursday - 06:00 pm', '', 2, 1665371925, '2022-10-10 03:18:45'),
(47, 51, '2150107', 'others', 'ryan testing 202', '', 'ryan testing 202', '20221228', '202212', 'September 29, 2022 - Thursday - 06:01 pm', 'September 29, 2022 - Thursday - 06:04 pm', 2, 1665371920, '2022-10-10 03:18:40'),
(48, 41, '2210903', '2200057', 'ryan testing 30sept2022', 'Ice Breaker Activity April 2022.jpg', 'ryan testing 30sept2022', '20220930', '202209', 'September 30, 2022 - Friday - 02:33 am', '', 2, 1665371930, '2022-10-10 03:18:50'),
(49, 51, '2220090,2210725', '2210040,2170052,2220090', 'GIT Training', 'git training logo (1).jpg', 'GIT Training', '20221010', '202210', 'October 10, 2022', 'October 18, 2022 - Tuesday - 07:40 pm', 0, 0, '2022-10-18 11:40:54'),
(50, 51, '2210903', 'Management Team and Leaders', 'October 2022 General Assembly', 'general-assembly.png', 'October 2022 General Assembly', '20221014', '202210', 'October 10, 2022', 'October 18, 2022 - Tuesday - 07:38 pm', 0, 0, '2022-10-18 11:38:26'),
(51, 51, '2210499', '2210476,2220179', 'October 2022 Team Bonding', 'ice-breaker.png', 'Ice Breaker Activity: Take a break and have some fun!', '20221014', '202210', 'October 10, 2022', 'October 18, 2022 - Tuesday - 07:39 pm', 0, 0, '2022-10-18 11:39:15'),
(52, 51, '2220090,2150107', '2200057,2220090,2210725', 'DX Info Hub Walkthrough', 'DXINFOHUB WALKTHROUG.jpg', 'DX Info Hub Walkthrough', '20230106', '202210', 'October 10, 2022', 'November 29, 2022 - Tuesday - 11:05 am', 0, 0, '2022-11-29 03:05:15'),
(53, 51, '2210817,2210725', '2170052,2220090', 'Project Related Reorientation', 'Project Related Orientation (2).png', 'Hi Team!\r\n\r\nProject Related Reorientation will start at 10:00 AM.\r\n\r\nThank you.', '20221123', '202210', 'October 12, 2022', 'November 29, 2022 - Tuesday - 11:04 am', 0, 0, '2022-11-29 03:04:53'),
(54, 45, '2210817,2210725', '2180223', 'Wevox Survey', 'Wevox Reorientation (3).png', 'Hi Team,\r\n\r\nWevox Reorientation will start at 10:00 AM.\r\nLink: https://meet.google.com/jet-znvb-oju\r\n\r\nSee you there!\r\n', '20221123', '202211', 'November 21, 2022', 'November 29, 2022 - Tuesday - 10:53 am', 0, 0, '2022-11-29 02:53:34'),
(55, 45, '2210725,2210817', '2180182', 'Design Principles', 'Design Principles (3).png', 'Hi Team, \r\n\r\nAnother webinar happening on November 23, at 10:30AM.\r\n\r\n▼Survey Link\r\nhttps://forms.gle/MKHUxxGbP7TwnkVM9\r\n\r\nSee you!', '20221123', '202211', 'November 21, 2022', 'November 29, 2022 - Tuesday - 10:54 am', 0, 0, '2022-11-29 02:54:43'),
(56, 45, '2210725,2210817', '2210903', 'Learning Japanese: How to get started', 'Learning Japanese.png', 'Hi Team, \r\n\r\nLearning Japanese: How to get started will start at 11:00AM\r\n\r\n▼Survey Link\r\nhttps://forms.gle/Js2ZMk1nhGCgWkaw5', '20221123', '202211', 'November 21, 2022', 'November 29, 2022 - Tuesday - 10:54 am', 0, 0, '2022-11-29 02:54:16'),
(57, 45, '2150107,2220090', '2210040', 'General Assembly', 'General Assembly_Ice Breaker (2).jpg', 'Hi Team!\r\n\r\nGeneral Assembly for January will start at 10:00 AM.\r\n\r\nThank you.', '20230113', '202302', 'November 28, 2022', 'November 29, 2022 - Tuesday - 10:58 am', 0, 0, '2022-11-29 02:58:30'),
(58, 45, '2210817,2210725', '2180223', 'General Assembly November', 'general-assembly (1).png', 'Hi Team!\r\n\r\nGeneral Assembly for November will start at 10:00 AM.\r\n\r\nThank you.', '20221111', '202211', 'November 29, 2022', 'November 29, 2022 - Tuesday - 11:01 am', 0, 0, '2022-11-29 03:01:08'),
(59, 45, '2210817,2210725', '2210817', 'Ice Breaker November', 'ice-breaker.png', 'Hi Team!\r\n\r\nIce Breaker will start at 10:45AM.\r\n\r\nThank you\r\n\r\nUpdate:\r\nHi everyone. Thank you for participating on our first ever DX henyo team bonding activity. Here are the winners po. Congratulations! ????\r\n\r\nWinner: Team 3\r\nPrize: PhP 1,000\r\n\r\nJulcess\r\nEnzo\r\nKnowell\r\nRaffy\r\n\r\nConsolation Winners: Team 2\r\nPrize: PhP 400\r\n\r\nJunel\r\nJessa\r\nJay\r\nAntipuesto\r\n\r\nConsolation Winners: Team 6\r\nPrize: PhP 400\r\n\r\nAlbert\r\nWina\r\nKen\r\nChristian', '20221111', '202211', 'November 29, 2022', 'November 29, 2022 - Tuesday - 11:04 am', 0, 0, '2022-11-29 03:04:33'),
(60, 45, '2210817,2210725', '2180223', 'Embracing Change: Why feedback matters', 'Embracing Changes Part 2 (2).jpg', 'Embracing Change: Why feedback matters will start at 9:30 AM', '20221108', '202211', 'November 29, 2022', '', 0, 0, '2022-11-29 03:07:01'),
(61, 45, '2210817,2210725', '2150107', 'Training Reorientation', 'Training Orientation (1).png', 'Training Reorientation', '20221123', '202211', 'November 29, 2022', '', 0, 0, '2022-11-29 03:08:17'),
(62, 45, '2180182,2210499', '2180223', 'General Assembly December 2022', 'General Assembly_Ice Breaker.jpg', 'Hi Team!\r\n\r\nGeneral Assembly for December 2022 will start at 10:00 AM.\r\n\r\nThank you.', '20221209', '202211', 'November 29, 2022', 'November 29, 2022 - Tuesday - 11:12 am', 0, 0, '2022-11-29 03:12:08');

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
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `webinarandevents`
--
ALTER TABLE `webinarandevents`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
