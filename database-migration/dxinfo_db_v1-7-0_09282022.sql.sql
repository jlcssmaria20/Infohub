-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2022 at 05:22 AM
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
(1, 'superadmin', '$2y$10$V20FOs0HNEu/ggAzHF9dquhjf/472JyT6u4ioMl2LtQJeqH/TRHNK', 'Super', 'Admin', 0, 20, 1664325641, 2, NULL, 0, 0),
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
(3, 'Ambassador', 'documents,file-add,document-add,document-edit,document-delete,announcements,announcements-add,announcements-edit,announcements-delete,webinar-and-events,webinar-events-add,webinar-events-edit,webinar-events-delete,users,general', 0, 0);

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
(16, 'Team A', 0, 0, '2022-09-28 03:18:55');

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
(1, '2200057', 'julcess-marie.m1@trans-cosmos.co.jp', '$2y$10$SMpmeXR0kKN8yTY/wY/r8.lvG7ccRcIebe059ZvO2fkz6h4uzwn6.', 'Julcess Marie', 'Papica', 'Mercado', 'Cess', 'julcessmercado.jpg', ',3,', ',', 2, 2, '0', '09754310357', 1, 20220218, 20270101, 'Appear as you are, be as you appear.', 'Javascript jquery', 0, 20, 1664268381, 1, NULL, 0, 0),
(6, '2210040', 'yves-patrick.b1@trans-cosmos.co.jp', '$2y$10$rFIcHKIZmZcsgMhWJbktw.vOY04z56oo.ZSzLOd4WONMmIRl1ih/2', 'Yves Patrick', 'Valiente', 'Batungbacal', 'Patrick', 'avatar5.png', ',2,', ',', 4, 0, '0', '09123456789', 8, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663897420, NULL, NULL, 0, 0),
(3, '2180223', 'ampioco.morris1@trans-cosmos.co.jp', '$2y$10$NRbseewWCZ16GZB8SriFUOFBsPm1OEenUYM.SBPZHEHA0a3dxxFCu', 'Morris John Louise', 'Guillan', 'Ampioco', 'Morris', 'avatar5.png', ',2,3,', ',', 5, 5, '1', '09123456789', 8, 20220916, 20270101, 'To be announced', 'To be announced', 0, 20, 1664269217, NULL, NULL, 0, 0),
(8, '2150107', 'jennica-ashley.felix1@trans-cosmos.co.jp', '$2y$10$4W5FgcvzCScRBXYLgMkXUel5peXNkKE3n9VVzo5/unbZLDVHi.unq', 'Jennica Ashley', 'Ortiz', 'Felix', 'Ash', 'avatar2.png', ',2,3,', ',', 4, 0, '0', '09123456789', 8, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663898882, NULL, NULL, 0, 0),
(7, '2170052', 'christian.alde1@trans-cosmos.co.jp', '$2y$10$g0u1Fu8PhDrFGvUbhlmGsO975JRxKX//lGXYQmjcWhIpzjGLyR/AW', 'Christian', 'Viray', 'Alde', 'Tian', 'avatar5.png', ',2,', ',', 4, 0, '1', '09123456789', 8, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663897314, NULL, NULL, 0, 0),
(9, '2190048', 'exequiel.delfin1@trans-cosmos.co.jp', '$2y$10$q8CtevEOlf607BhX8VfIVOxTNdXHhhgOGgj2EhSfN7H.W8lAODW.i', 'Exequiel', 'Luces', 'Delfin', 'Exe', 'avatar5.png', ',1,', ',', 3, 0, '1', '09123456789', 16, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663898767, NULL, NULL, 0, 0),
(10, '2210909', 'raffy.gumapo1@trans-cosmos.co.jp', '$2y$10$Ux2K01ma5ID9G7yngn0LpuDvB7WrH4vhRzG9qHI3U4652rQvrpCpO', 'Raffy', '', 'Gumapo', 'Raffy', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 16, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899078, NULL, NULL, 0, 0),
(11, '2210475', 'essel.luna1@trans-cosmos.co.jp', '$2y$10$CdDC.T1TE8zR8RfRnBXhDu/cNcIR.IVeEHDBDoUWcp.mvya.TPJEa', 'Essel May', 'Santiago', 'Luna', 'Essel', 'avatar2.png', ',1,', ',', 1, 0, '0', '09123456789', 16, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899267, NULL, NULL, 0, 0),
(12, '2150088', 'antonio.aduna1@trans-cosmos.co.jp', '$2y$10$gLnK0i7HOfDidWMcxHeOJeXNSfT/g91jwSw1M.Tr3hSoTRdvoitOO', 'Antonio Jr.', 'Quimpo', 'Aduna', 'Antonio', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 2, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663896887, NULL, NULL, 0, 0),
(13, '2150096', 'joseph-john.mondia1@trans-cosmos.co.jp', '$2y$10$ncGlc1ifLmbpvd53FUfXzeOMQn0i5fPxiUyweqgkgGvw207QBWuYq', 'Joseph John', 'Tubongbanua', 'Mondia', 'Jj', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 2, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899779, NULL, NULL, 0, 0),
(14, '2190019', 'monton.julie-ann1@trans-cosmos.co.jp', '$2y$10$k.Fe7ed2xeYcYOU0PUQUmeCA19coa2yK6fxF/F02qDSWS2CHlSazq', 'Julie Ann', 'Lipio', 'Monton', 'Julie', 'avatar2.png', ',1,', ',', 1, 0, '0', '09123456789', 2, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899862, NULL, NULL, 0, 0),
(15, '2200031', 'philipcarlo.ventura1@trans-cosmos.co.jp', '$2y$10$n/qckiHPiFL2ZOMLqk4l8u/l5Zql7o0J/Hwk98BgO8UquepmhQwiW', 'Phillip Carlo', 'Portinto', 'Ventura', 'Phillip', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 2, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663900533, NULL, NULL, 0, 0),
(16, '2210339', 'erwina.catacutan1@trans-cosmos.co.jp', '$2y$10$Y8OmJQmhI27fN1FJCoqEQ.O0cUVPX3TIEamHkF8tF0TQdjWb7hci6', 'Erwina', 'Dela Cruz', 'Catacutan', 'Wina', 'avatar2.png', ',1,', ',', 1, 0, '0', '09123456789', 3, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663898266, NULL, NULL, 0, 0),
(17, '2210937', 'lorenzo-jr.cruz1@trans-cosmos.co.jp', '$2y$10$V2cnV5zV/P3HsHZwKaCsxuv4swNRcnUg8akyqUz5b5wEVx/4eqXou', 'Lorenzo Jr.', '', 'Cruz', 'Enzo', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 3, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663898488, NULL, NULL, 0, 0),
(18, '2217400', 'jeremy-amadeo.dadua1@trans-cosmos.co.jp', '$2y$10$V5olzESsEzA0MnUhbr21.ujB1cpi1iS01TJ2XkMwcUQEDu5oOjI06', 'Jeremy', 'Amadeo', 'Dadua', 'Jeremy', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 3, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663898660, NULL, NULL, 0, 0),
(19, '2170244', 'revin.galindez1@trans-cosmos.co.jp', '$2y$10$8CX02obxMQu8FvdoPjSRqOJ71h3ZluUoGCmRP1fzrXFGr0Fo2CDeC', 'Revin', 'Santos', 'Galindez', 'Revin', 'avatar5.png', ',1,', ',', 3, 0, '1', '09123456789', 3, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663898973, NULL, NULL, 0, 0),
(20, '2210773', 'mary-joy.bolima1@trans-cosmos.co.jp', '$2y$10$5R3NxFIYEsqWmHI1XfHWR.fbJQk2dub2nPM/DIGs0n5wUM5vssYia', 'Mary Joy', 'Acabado', 'Bolima', 'Mj', 'Pic.jpg', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899546, NULL, NULL, 0, 0),
(21, '2210903', 'joseph.catiis1@trans-cosmos.co.jp', '$2y$10$Tpx3GA3CL5VWOMTCGNo0LuiAoqQlO8y5.P/Sn69o7P/lioBrg7whW', 'Joseph', 'De Guzman', 'Catiis', 'Joseph', 'avatar5.png', ',3,', ',', 1, 0, '1', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664156259, NULL, NULL, 0, 0),
(22, '2210694', 'iino.yumeka1@trans-cosmos.co.jp', '$2y$10$.LfG2P.I4b77VyPWSFClP.7/27GX/CHWtymMkVOjq/g7Mil95NjdW', 'Yumeka', 'Sioco', 'Iino', 'Yumeka', 'avatar2.png', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899117, NULL, NULL, 0, 0),
(23, '2210749', 'leonald.lumbad1@trans-cosmos.co.jp', '$2y$10$IvpFzQ4J7/pTmkbGtDXcD.HpVCN3qK8Y1j6AOysA21GsTYMFtSbEu', 'Leonard', 'Arcenilla', 'Lumbad', 'Leona', 'avatar2.png', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899215, NULL, NULL, 0, 0),
(24, '2200015', 'gregorio-r.moraiii1@trans-cosmos.co.jp', '$2y$10$QlKFoxlvkDvfEBlh0tmMPO4/0Yiv5y.2u1X1G1Byl7EOmPQq4pAJe', 'Gregorio Ii', 'Ramos', 'Mora', 'Gary', 'avatar5.png', ',1,', ',', 3, 0, '1', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899937, NULL, NULL, 0, 0),
(25, '2210813', 'ken.hopep-paril1@trans-cosmos.co.jp', '$2y$10$8avO3B0/ZA/O3s9tIlWgC.3zX18gKL/BkPuLt8yAySYzL49GhYxHu', 'D-pper Ken Hope', 'Ponting', 'Paril', 'Ken', 'avatar2.png', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663900102, NULL, NULL, 0, 0),
(26, '2190050', 'ron-lester.rillera1@trans-cosmos.co.jp', '$2y$10$gC1aUqlhNWeR5R0o1YlBpu1ZPKIqaOQWerbJEz2is4LkGO1Mo3lui', 'Ron Lester', 'Vanta', 'Rillera', 'Ron', 'avatar5.png', ',1,', ',', 3, 0, '1', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663900250, NULL, NULL, 0, 0),
(27, '2210785', 'sheila-victoria.s1@trans-cosmos.co.jp', '$2y$10$RlX0X9CKMWQhYuLLJOBsA.ZtpEjqOY2tYBihC24bWxaZqVj0DsBLK', 'Sheila Victoria', 'Cruz', 'Siongco', 'Sheila', 'avatar2.png', ',1,', ',', 1, 0, '0', '09123456789', 7, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663900369, NULL, NULL, 0, 0),
(28, '2170041', 'jessa-faye.abulencia1@trans-cosmos.co.jp', '$2y$10$/fmor8xsguoAp2habTvVz.iC56T2b.DWe5a1oQwvOtMfuNAMlv6ra', 'Jessa Faye', 'Joves', 'Abulencia', 'Jessa', 'avatar2.png', ',1,', ',', 1, 0, '0', '09123456789', 4, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663915652, NULL, NULL, 0, 0),
(29, '2190051', 'david-isaac.d1@trans-cosmos.co.jp', '$2y$10$/f4zBStMf6d/oIwy1N/hVOuWE4jcw5ySrUMCT5MK2UHReJA.5Cqy6', 'David Isaac', 'Baclayon', 'Dela Cruz', 'David', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 4, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663898701, NULL, NULL, 0, 0),
(30, '2190046', 'rachel.robles1@trans-cosmos.co.jp', '$2y$10$IWo265c7vCP76DaAt790FOZiMyYjQTtvN9mYT1oJ2BwhZjWsfTvz.', 'Rachel', 'Ardeza', 'Robles', 'Rachel', 'avatar2.png', ',1,', ',', 1, 0, '0', '09123456789', 4, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663900297, NULL, NULL, 0, 0),
(31, '2190030', 'james-albert.salva1@trans-cosmos.co.jp', '$2y$10$NmWE6TwxVqDo8c3RDbaxuecEXYlIiHw6FQkWue7I3zQSLrVzD0X7K', 'James Albert', 'San Juan', 'Salva', 'Albert', 'avatar5.png', ',3,', ',', 3, 0, '1', '09123456789', 4, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663900336, NULL, NULL, 0, 0),
(32, '2150029', 'joseph-anthony.c1@trans-cosmos.co.jp', '$2y$10$Y6O0jk3KXFGvucvnhjZJbeZf3resVT2NYDDISIbWjVmjibPj0wS/a', 'Joseph Anthony', 'Flores', 'Carpio', 'Jay', 'avatar5.png', ',1,', ',', 3, 0, '1', '09123456789', 5, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663897681, NULL, NULL, 0, 0),
(33, '2210817', 'joan.francisco1@trans-cosmos.co.jp', '$2y$10$E4.70DzbuijaB1j7qNK/1.TqWb2ry3mQH39FB4Xz5iXgF1HlAG74W', 'Joan', 'Borcelis', 'Francisco', 'Joan', 'avatar2.png', ',1,', ',', 1, 0, '0', '09123456789', 5, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663898919, NULL, NULL, 0, 0),
(34, '2210914', 'dexter.nierva1@trans-cosmos.co.jp', '$2y$10$UQgCnHOjcWeJYDqf5yv5V.RK5NtYs/VarcnDwddies.NCwXag1at6', 'Dexter', '', 'Nierva', 'Dex N', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 5, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663900066, NULL, NULL, 0, 0),
(35, '2210499', 'raven.reyes1@trans-cosmos.co.jp', '$2y$10$7rZ.4/5QRkYO.L725ax36ephGnmmmeyIElgUuCsRAs6iNj0SOP8FK', 'Raven Auriesh', 'Corpuz', 'Reyes', 'Raven', 'avatar2.png', ',3,', ',', 1, 0, '0', '09123456789', 5, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663900152, NULL, NULL, 0, 0),
(36, '2210493', 'jeffrey-andrew.a1@trans-cosmos.co.jp', '$2y$10$F6dzaUOvVFNqdekCyL75Be9EoxhzX4W98CpDQYgxmcqU3d1sAJCTm', 'Jeffrey Andrew', 'Erice', 'Agregado', 'Jeffrey', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 6, 20220921, 20270101, 'To be announce', 'Skills To Be Announce During Testing', 0, 20, 1664156221, NULL, NULL, 0, 0),
(37, '2190047', 'alexandra.marasigan1@trans-cosmos.co.jp', '$2y$10$qyoZCrtgKYaMec9hiPSks.TrhMgv0p4SzehTeiBRvqDVWG0AGXts.', 'Alexandra', 'Casiple', 'Marasigan', 'Alex', 'avatar2.png', ',1,', ',', 1, 0, '0', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899377, NULL, NULL, 0, 0),
(38, '2200058', 'john-juvir.m1@trans-cosmos.co.jp', '$2y$10$VB2G.ViPzIyc.LsqnEsZg.kUuzV/Vp4XFxmXIMswbrWk6lMyHZJ1C', 'John Juvir', 'Cabuga', 'Monteagudo', 'Juvir', 'avatar5.png', ',1,', ',', 3, 0, '1', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899819, NULL, NULL, 0, 0),
(39, '2220005', 'bart.tabusao1@trans-cosmos.co.jp', '$2y$10$oBGg/nQmVankU07TmYhYWujPicaZbP5kZFyl7sPlR.H4.L4UoQm4S', 'Bart', '', 'Tabusao', 'Bart', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663900408, NULL, NULL, 0, 0),
(40, '2190210', 'crisler-billones.v1@trans-cosmos.co.jp', '$2y$10$5KEQPcFnhveJpcK2d26jmOtMAuf7tSYmuRnrahnR7pxD3qgNh5Vwu', 'Crisler', 'Billones', 'Vallo', 'Cj', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 6, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663900440, NULL, NULL, 0, 0),
(41, '2180182', 'junel.aceres1@trans-cosmos.co.jp', '$2y$10$dBDuPEmpCDaLfVM0Obc5Ie5LGaTVhUM2oOeJ/i364.FDrPkeYapsK', 'Junel', 'De Guzman', 'Aceres', 'Junel', 'avatar5.png', ',2,3,', ',', 3, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663896319, NULL, NULL, 0, 0),
(42, '2210412', 'michael-angelo.a1@trans-cosmos.co.jp', '$2y$10$O13rZ9hdMllkQ61ZsQWdxOovTL6jRtkCnuZBZWWJw.tAtv8icboY.', 'Michael Angelo', 'De Vera', 'Antipuesto', 'Mike', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 1, 20220921, 20270101, 'To be announce', 'Skills to be updated', 0, 20, 1663920924, NULL, NULL, 0, 0),
(43, '2220179', 'kemberly.carig1@trans-cosmos.co.jp', '$2y$10$LBBDUECJ/vlesCDuBVMjgO6Y3uDv0qsxjTrYOdQRlg3bsg4csw/Fi', 'Kemberly', '', 'Carig', 'Kc', 'avatar5.png', ',3,', ',', 1, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663897728, NULL, NULL, 0, 0),
(44, '2210413', 'karrilene.dado1@trans-cosmos.co.jp', '$2y$10$beXyptCq32uc8kWIHiHh7O2rsKBxBRe.PtCmJuTg/JpptCCAVZKie', 'Karrilene', 'Palo', 'Dado', 'Karri', 'avatar2.png', ',3,', ',', 1, 0, '0', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663898609, NULL, NULL, 0, 0),
(45, '2220090', 'kimberly.de-leon1@trans-cosmos.co.jp', '$2y$10$X520raanCTpie.LNIdiwjOSBWspKRkOiDDt0nZvfAdAcV74cdyfbS', 'Kimberly', 'Nelle', 'De Leon', 'Kim', 'avatar2.png', ',2,3,', ',', 1, 0, '0', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1664335302, NULL, NULL, 0, 0),
(46, '2210476', 'jeveca.longakit1@trans-cosmos.co.jp', '$2y$10$36xozTi284AEq3JhX/fwB.j7Qh3nH8i3cli6dHNXQ277AlPOBqEwi', 'Maria Jeveca', 'Huyo-a', 'Longakit', 'Jev', 'avatar2.png', ',2,3,', ',', 3, 0, '0', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899178, NULL, NULL, 0, 0),
(47, '2210784', 'dexter-guzman.m1@trans-cosmos.co.jp', '$2y$10$o66yHZu6i.XemYmICcirKOBczaEVy9eBh2p7LuyoH7lmkNsjiC.3G', 'Dexter', 'Guzman', 'Macabangon', 'Dex', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'Julcess Wants To See Skills Update', 0, 20, 1663899428, NULL, NULL, 0, 0),
(48, '2210936', 'juneneil.magnanao1@trans-cosmos.co.jp', '$2y$10$30Te3g2Ult6K1rIbCK6rROvo0eZdqMDE6CrPpayEiyOG/.YzMpNrC', 'June Neil', '', 'Magnanao', 'Neil', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899675, NULL, NULL, 0, 0),
(49, '2210200', 'angelo.tribiana1@trans-cosmos.co.jp', '$2y$10$U2cawdpzr8VphGW0beac0.mHLxJNaOI9SSsVCJbzfwR2hTy627vhK', 'Michael Angelo', 'Tribiana', 'Manaog', 'Gelo', 'avatar5.png', ',1,', ',', 1, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663899712, NULL, NULL, 0, 0),
(50, '2160046', 'ian.nicolas1@trans-cosmos.co.jp', '$2y$10$0xpMPduQQqpkxPvrDwtTX.IlTcUkHSnwGPpTTLSC7KkuaCpVnPzBa', 'Ian', 'Gutierez', 'Nicolas', 'Ian', 'avatar5.png', ',2,', ',', 3, 0, '1', '09123456789', 10, 20220921, 20270101, 'To be announce', 'To Be Announce', 0, 20, 1663900011, NULL, NULL, 0, 0),
(51, '2210725', 'john-ryan.verba1@trans-cosmos.co.jp', '$2y$10$8Dt7RIlH12chqtn9ujzH5.e0lGhezsLwXJN.g0QHXAs7n0akZSe9.', 'John Ryan', 'Ting', 'Verba', 'Ry', 'save 03837.JPG', ',2,3,', ',', 1, 0, '1', '09778021204', 10, 20220921, 20270101, 'To be announce', 'To be announced', 0, 20, 1664268769, NULL, NULL, 0, 0);

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
  MODIFY `role_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `webinarandevents`
--
ALTER TABLE `webinarandevents`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
