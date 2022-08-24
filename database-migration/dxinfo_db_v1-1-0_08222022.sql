-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2022 at 11:16 AM
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
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL,
  `announcements_title` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `announcements_details` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `announcements_img` varchar(255) CHARACTER SET utf8 NOT NULL,
  `announcements_count` int(1) NOT NULL DEFAULT 0,
  `date_edit` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `announcements_status` int(255) NOT NULL,
  `temp_del` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `user_id`, `announcements_title`, `announcements_details`, `announcements_img`, `announcements_count`, `date_edit`, `date_created`, `announcements_status`, `temp_del`, `timestamp`) VALUES
(1, 177, '2022 Philippine Holidays', 'Prepare for your next vacation in the Philippines with this detailed list and calendars of all the regular holidays, special non-working and working days, long weekends, and important festivals and events in the Philippines for 2022. \r\n\r\nMake a checklist, plan vacations with family and friends, and arrange tour packages all across the Philippines with the help of this guide that includes celebrations in the Philippines every month. Additionally, you may want to schedule your visit around top Philippines tourist spots and significant Philippine festivals and events for a much more enriching and immersive trip. Make sure to check the updated travel requirements in the Philippines and the best hotels in the Philippines to book when planning your trip to destinations.', '2022-National-Holiday-placeholder_CNNPH.jpg', 0, '', 'August 22, 2022 - Monday - 01:40 pm', 0, 0, '2022-08-22 05:40:17'),
(2, 177, 'Japanese Public Holidays In 2022!', 'After rearrangements to match the Olympics in 2020 and their rescheduled dates in 2021, Japan&rsquo;s national holidays will return to their normal schedule in 2022.', 'test.jpg', 0, '', 'August 22, 2022 - Monday - 01:43 pm', 0, 0, '2022-08-22 05:43:03'),
(3, 177, 'Word Press Basic', 'WordPress enables website owners to update page content and operate a blog page through a friendly interface (avoiding the need to learn web design skills).\r\n\r\nBefore beginning, it&rsquo;s really important to understand the difference between pages and posts.\r\n\r\nYour website will consist of any number of web pages containing updatable content. One of the pages is the blog page (unless you&rsquo;ve chosen not to run a blog/news page). The blog page can sometimes be set as the home page or it might be a completely separate page called News, instead of Blog.', 'Nature_Fresh_1.jpg', 0, '', 'August 22, 2022 - Monday - 01:46 pm', 0, 0, '2022-08-22 05:46:22'),
(4, 177, 'New Announcement! Edited', 'This is a new announcement, edited.', '2.jpg', 0, 'August 22, 2022 - Monday - 02:45 pm', 'August 22, 2022 - Monday - 01:51 pm', 1, 0, '2022-08-22 06:45:44'),
(5, 177, 'Longest Title. This Announcements Is About. Theeer', 'WordPress enables website owners to update page content and operate a blog page through a friendly interface (avoiding the need to learn web design skills) The blog page can sometimes be set as the home page or it might be a completely separate page called News, instead of Blog.\r\n\r\nWordPress enables website owners to update page content and operate a blog page through a friendly interface (avoiding the need to learn web design skills). Before beginning, it&rsquo;s really important to understand the difference between pages and posts. Your website will consist of any number of web pages containing updatable content. One of the pages is the blog page (unless you&rsquo;ve chosen not to run a blog/news page). The blog', '2.jpg', 0, 'August 22, 2022 - Monday - 03:16 pm', 'August 22, 2022 - Monday - 02:29 pm', 0, 0, '2022-08-22 07:16:44'),
(6, 177, 'Asdsad', '&lt;b&gt;&amp;nbsp;Bold Text&amp;nbsp;&lt;/b&gt;&amp;nbsp;this announcement s is &lt;font color=&quot;#000000&quot;&gt;&lt;span style=&quot;background-color: rgb(255, 255, 0);&quot;&gt;sdf fsdf&lt;/span&gt;&lt;/font&gt;', '16-120607.jpeg', 0, 'August 22, 2022 - Monday - 04:40 pm', 'August 22, 2022 - Monday - 04:02 pm', 0, 0, '2022-08-22 08:40:05'),
(7, 177, 'Summernoter Trial', '&lt;p&gt;this is a summer note template&lt;/p&gt;', '2.jpg', 0, '', 'August 22, 2022 - Monday - 04:32 pm', 0, 0, '2022-08-22 08:32:58'),
(8, 177, 'Asdasd', '&lt;p&gt;asdsd&lt;/p&gt;', 'dx2.jpg', 0, 'August 22, 2022 - Monday - 05:09 pm', 'August 22, 2022 - Monday - 05:09 pm', 2, 1661159516, '2022-08-22 09:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `announcements_old`
--

CREATE TABLE `announcements_old` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL,
  `announcment_details` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `announcment_title` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `announcment_img` varchar(255) CHARACTER SET utf8 NOT NULL,
  `announcment_count` int(1) NOT NULL DEFAULT 0,
  `date_edit` varchar(255) CHARACTER SET utf8 NOT NULL,
  `current_date` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `status` int(255) NOT NULL,
  `temp_del` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcements_old`
--

INSERT INTO `announcements_old` (`id`, `user_id`, `announcment_details`, `announcment_title`, `announcment_img`, `announcment_count`, `date_edit`, `current_date`, `status`, `temp_del`) VALUES
(37, 1, '<p>Any employee is looking forward to two things—paydays and holidays. Well, who doesn’t? Holidays in the Philippines allow people to spend some quality time with their loved ones, and that much-needed me-time before getting back to the daily grind. Start planning your vacations for next year by keeping tab of Philippines holidays in 2022. Here’s a quick guide to the Philippine holidays and long weekends that can help you plan your vacations wisely.</p><p>There are 239 working days and 16 holidays in the Philippines in 2022. According to research done by Gulf Business, the Philippines is one of the countries with the most public holidays in the world. India tops the list followed by Columbia and the Philippines. Holidays in the Philippines are also grouped into two—regular and special non-working holidays. Regular holidays typically have a fixed date, like New Year’s Da</p>', '2022 Philippine Holidays', '2022-National-Holiday-placeholder_CNNPH.jpg', 0, 'May 31, 2022 - Tuesday - 03:40 pm', 'March 28, 2022 - Monday - 12:41 pm', 0, 0),
(41, 204, '<br>', 'Japanese Public Holidays in 2022', 'mount fuji.JPG', 0, 'May 27, 2022 - Friday - 12:31 am', 'May 27, 2022 - Friday - 12:29 am', 0, 0),
(43, 155, '<p>asdasdasd<span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><span style=\"font-size: 1rem;\">asdasdasd</span><', 'Millenials In Workforceasdaasdas', 'WordPress Basics.png', 0, '', 'June 28, 2022 - Tuesday - 10:47 am', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `documentsquicklinks`
--

CREATE TABLE `documentsquicklinks` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL DEFAULT 0,
  `docu_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_added` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_edited` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `temp_del` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documentsquicklinks`
--

INSERT INTO `documentsquicklinks` (`id`, `user_id`, `docu_name`, `date_added`, `date_edited`, `temp_del`, `status`) VALUES
(1, 1, 'Dont delete', 'February 23, 2022 - Wednesday - 04:01 pm', '', 0, 0),
(116, 1, 'Developers Training Files', 'May 20, 2022 - Friday - 05:55 pm', '', 0, 0),
(117, 1, 'Information Security Files', 'May 23, 2022 - Monday - 12:21 pm', '', 0, 0),
(122, 155, 'Bridge Directors Training Files', 'June 27, 2022 - Monday - 10:45 am', '', 0, 0),
(123, 153, 'Important Files', 'June 28, 2022 - Tuesday - 09:31 am', '', 0, 0),
(124, 177, 'HMO', 'July 29, 2022 - Friday - 04:00 pm', '', 0, 0),
(125, 177, 'TEST FORMS', 'July 29, 2022 - Friday - 04:01 pm', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `documentstemplate`
--

CREATE TABLE `documentstemplate` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL DEFAULT 0,
  `docu_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `docu_id` int(10) NOT NULL DEFAULT 0,
  `docu_dl` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `files` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_added` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `temp_del` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documentstemplate`
--

INSERT INTO `documentstemplate` (`id`, `user_id`, `docu_name`, `docu_id`, `docu_dl`, `files`, `date_added`, `temp_del`, `status`) VALUES
(101, 1, 'TEST 101', 88, '1 RYAN 101', '030422_1130AM_MoM_Focus.pdf', 'March 4, 2022 - Friday - 05:19 pm', 0, 0),
(102, 1, 'TEST 101', 88, '2 RYAN 101 ', 'SELENIUM IDE.pptx', 'March 4, 2022 - Friday - 05:19 pm', 0, 0),
(104, 1, 'TEST 202', 89, '1 RYAN 202', 'SRSv2.pdf', 'March 4, 2022 - Friday - 05:19 pm', 0, 0),
(105, 1, 'TEST 202', 89, '2 RYAN 202', '030422_1130AM_MoM_Focus.docx', 'March 4, 2022 - Friday - 05:19 pm', 0, 0),
(106, 1, 'TEST 202', 89, '3 RYAN 202 ', 'tcap-focus-proposal-v1.pdf', 'March 4, 2022 - Friday - 05:19 pm', 0, 0),
(107, 1, 'TEST 303', 90, '1 RYAN 303', 'tcap-focus-proposal-v1.pdf', 'March 4, 2022 - Friday - 05:20 pm', 0, 0),
(108, 1, 'TEST 303', 90, '2 RYAN 303', 'Project Plan v2.pdf', 'March 4, 2022 - Friday - 05:20 pm', 0, 0),
(109, 1, 'RYAN 404', 91, '1 RYAN 404', 'SRSv2.pdf', 'March 4, 2022 - Friday - 05:26 pm', 0, 0),
(110, 1, 'RYAN 505', 92, '1 RYAN 505', 'Documents and Quick Links(DXIH) (1) (1) (1) (1).pdf', 'March 4, 2022 - Friday - 05:26 pm', 0, 0),
(111, 1, 'RYAN 505', 92, '2 RYAN 505', 'Documents and Quick Links(DXIH) (1) (1) (1) (1).pdf', 'March 4, 2022 - Friday - 05:26 pm', 0, 0),
(112, 1, 'RYAN 606', 93, '1 RYAN 606', 'Homepage PC2-compressed (3) (1).pdf', 'March 4, 2022 - Friday - 05:28 pm', 0, 0),
(113, 1, 'RYAN 707', 94, '1 RYAN 707', 'Project Plan v2.pdf', 'March 4, 2022 - Friday - 05:29 pm', 0, 0),
(114, 1, 'RYAN 707', 94, '2 RYAN 707', 'The Team(DXIH) (1) (1) (1).pdf', 'March 4, 2022 - Friday - 05:29 pm', 0, 0),
(115, 1, 'RYAN 808', 95, '1 RYAN 808', 'tcap-focus-proposal-v1.pdf', 'March 4, 2022 - Friday - 05:29 pm', 0, 0),
(116, 1, 'RYAN 909', 96, '1 RYAN 909', 'Webinar and Events(DXIH) (1) (2).pdf', 'March 4, 2022 - Friday - 05:30 pm', 0, 0),
(117, 1, 'TEST 101', 88, '3 RYAN 101 ', 'SRSv2 (1).pdf', 'March 7, 2022 - Monday - 11:25 am', 0, 0),
(118, 1, 'TEST 101', 88, '4 RYAN 101 ', '030422_1130AM_MoM_Focus.pdf', 'March 7, 2022 - Monday - 11:25 am', 0, 0),
(119, 1, 'TEST 101', 88, '4 RYAN 101 ', '030422_1130AM_MoM_Focus.pdf', 'March 7, 2022 - Monday - 11:26 am', 0, 0),
(120, 1, 'Budget Related Forms01', 97, 'TEXT01', 'MEMBERS ASSESSMENT (2).xlsx', 'March 8, 2022 - Tuesday - 09:21 am', 0, 0),
(122, 1, 'RYAN 909', 98, 'RYAN 909', 'Daily Time Records - 2150028 - transcosmos Asia Philippines, Inc..pdf', 'March 18, 2022 - Friday - 03:28 pm', 0, 0),
(123, 1, 'TEST101', 99, 'TEST101', 'DX INFOHUB - UAT.xlsx', 'March 21, 2022 - Monday - 11:40 am', 0, 0),
(124, 1, 'TEST101', 99, 'TEST102', 'tcap-focus-proposal-v1.pdf', 'March 21, 2022 - Monday - 11:40 am', 0, 0),
(125, 1, 'TEST101', 99, 'TEST103', 'Presentation-RPA AND Web Dev (1).pptx', 'March 21, 2022 - Monday - 11:40 am', 0, 0),
(126, 1, 'qqqqqqqqqqqq', 100, 'qqqqqqqqqqqqqqqqqqqqq', 'Presentation-RPA AND Web Dev (1) (1).pptx', 'March 21, 2022 - Monday - 11:50 am', 0, 0),
(127, 1, 'TEST 1010', 101, 'TEST 1010', 'Project Plan v2.pdf', 'March 21, 2022 - Monday - 03:15 pm', 0, 0),
(128, 1, 'TEST 1111', 102, 'TEST 1111', 'The Team(DXIH).pdf', 'March 21, 2022 - Monday - 03:17 pm', 0, 0),
(129, 1, 'TEST 1212', 103, 'TEST 1212', 'Webinar and Events(DXIH).pdf', 'March 21, 2022 - Monday - 03:20 pm', 0, 0),
(130, 1, 'TEST 1313', 104, 'TEST 1313', 'The Team(DXIH) (1) (1) (1).pdf', 'March 21, 2022 - Monday - 03:21 pm', 0, 0),
(131, 1, 'TEST 1414', 105, 'TEST 1414', 'Project Plan v2.pdf', 'March 21, 2022 - Monday - 03:22 pm', 0, 0),
(132, 1, 'TEST 1717', 106, 'TEST 1717', 'SRSv2.pdf', 'March 21, 2022 - Monday - 03:25 pm', 0, 0),
(133, 1, 'TEST 1818', 107, 'TEST 1818', 'The Team(DXIH) (1) (1) (1).pdf', 'March 21, 2022 - Monday - 03:26 pm', 0, 0),
(135, 1, 'DX Email Templates', 109, 'DX Email Templates', 'DX Email Templates.xlsx', 'March 29, 2022 - Tuesday - 09:34 am', 0, 0),
(136, 1, 'TEST', 110, 'TEST', 'ww.jpg', 'May 13, 2022 - Friday - 05:56 pm', 0, 0),
(137, 1, 'Budget Related Forms', 111, 'TEXT01', '【TCAP】WeeklyReport_033022_v2.0.pptx', 'May 13, 2022 - Friday - 05:58 pm', 0, 0),
(138, 1, 'Budget Related Formswqwqw', 112, 'TEXT01qwq', '【TCAP】WeeklyReport_033022_v2.0.pptx', 'May 13, 2022 - Friday - 05:58 pm', 0, 0),
(139, 179, 'DX Onboarding Plan', 113, 'DX Onboarding Plan', 'DX Onboarding Plan.pdf', 'May 13, 2022 - Friday - 05:59 pm', 0, 0),
(140, 1, 'Budget Related Formsw', 114, 'www', 'Presentation-RPA AND Web Dev (1) (1).pptx', 'May 13, 2022 - Friday - 06:03 pm', 0, 0),
(143, 179, 'DX Onboarding Files', 115, 'BD Orientation by Arisa', '[TCAP]BD_orientation_01.pptx', 'May 13, 2022 - Friday - 06:31 pm', 0, 0),
(152, 1, 'Developers Training Files', 116, '01_01_HTML CSS Learning point01', '01_01_HTML CSS Learning point01.pdf', 'May 23, 2022 - Monday - 11:24 am', 0, 0),
(153, 1, 'Developers Training Files', 116, '01_02_HTML CSS Learning point02', '01_02_HTML CSS Learning point02.pdf', 'May 23, 2022 - Monday - 11:24 am', 0, 0),
(154, 1, 'Developers Training Files', 116, '01_03_HTML CSS Learning point03', '01_03_HTML CSS Learning point03.pdf', 'May 23, 2022 - Monday - 11:24 am', 0, 0),
(155, 1, 'Developers Training Files', 116, '02_01_How to proceed with coding01', '02_01_How to proceed with coding01.pdf', 'May 23, 2022 - Monday - 11:25 am', 0, 0),
(156, 1, 'Developers Training Files', 116, '02_02_How to proceed with coding02', '02_02_How to proceed with coding02.pdf', 'May 23, 2022 - Monday - 11:25 am', 0, 0),
(157, 1, 'Developers Training Files', 116, '02_03_How to proceed with coding03', '02_03_How to proceed with coding03.pdf', 'May 23, 2022 - Monday - 11:25 am', 0, 0),
(158, 1, 'Developers Training Files', 116, '02_04_How to proceed with coding04', '02_04_How to proceed with coding04.pdf', 'May 23, 2022 - Monday - 11:25 am', 0, 0),
(159, 1, 'Developers Training Files', 116, '03_01_Understanding for coding knowledge01', '03_01_Understanding for coding knowledge01.pdf', 'May 23, 2022 - Monday - 11:25 am', 0, 0),
(160, 1, 'Developers Training Files', 116, '03_02_Understanding for coding knowledge02', '03_02_Understanding for coding knowledge02.pdf', 'May 23, 2022 - Monday - 11:25 am', 0, 0),
(161, 1, 'Developers Training Files', 116, '03_03_Understanding for coding knowledge03', '03_03_Understanding for coding knowledge03.pdf', 'May 23, 2022 - Monday - 11:25 am', 0, 0),
(162, 1, 'Developers Training Files', 116, '03_04_Understanding for coding knowledge04', '03_04_Understanding for coding knowledge04.pdf', 'May 23, 2022 - Monday - 11:26 am', 0, 0),
(163, 1, 'Developers Training Files', 116, '03_05_Understanding for coding knowledge05', '03_05_Understanding for coding knowledge05.pdf', 'May 23, 2022 - Monday - 11:26 am', 0, 0),
(164, 1, 'Developers Training Files', 116, '03_06_Understanding for coding knowledge06', '03_06_Understanding for coding knowledge06.pdf', 'May 23, 2022 - Monday - 11:26 am', 0, 0),
(165, 1, 'Developers Training Files', 116, '04_01_Smart phone coding01', '04_01_Smart phone coding01.pdf', 'May 23, 2022 - Monday - 11:42 am', 0, 0),
(166, 1, 'Developers Training Files', 116, '04_02_Smart phone coding02', '04_02_Smart phone coding02.pdf', 'May 23, 2022 - Monday - 11:42 am', 0, 0),
(167, 1, 'Developers Training Files', 116, '04_03_Smart phone coding03', '04_03_Smart phone coding03.pdf', 'May 23, 2022 - Monday - 11:42 am', 0, 0),
(168, 1, 'Developers Training Files', 116, '04_04_Smart phone coding04', '04_04_Smart phone coding04.pdf', 'May 23, 2022 - Monday - 11:42 am', 0, 0),
(169, 1, 'Developers Training Files', 116, '04_05_Smart phone coding05', '04_05_Smart phone coding05.pdf', 'May 23, 2022 - Monday - 11:43 am', 0, 0),
(170, 1, 'Developers Training Files', 116, '04_07_Introduction to jQuery 01', '04_07_Introduction to jQuery 01.pptx', 'May 23, 2022 - Monday - 11:51 am', 0, 0),
(171, 1, 'Developers Training Files', 116, '04_08_Introduction to jQuery 02', '04_08_Introduction to jQuery 02.pptx', 'May 23, 2022 - Monday - 12:06 pm', 0, 0),
(172, 1, 'Developers Training Files', 116, '04_09_Introduction to jQuery 03', '04_09_Introduction to jQuery 03.pptx', 'May 23, 2022 - Monday - 12:09 pm', 0, 0),
(173, 1, 'Developers Training Files', 116, 'OTK_01_Coding Guideline', 'OTK_01_Coding Guideline.pdf', 'May 23, 2022 - Monday - 12:09 pm', 0, 0),
(174, 1, 'Developers Training Files', 116, 'OTK_02_Coding Method', 'OTK_02_Coding Method.pdf', 'May 23, 2022 - Monday - 12:12 pm', 0, 0),
(175, 1, 'Developers Training Files', 116, 'OTK_07_Link_Mark_en', 'OTK_07_Link_Mark_en.pdf', 'May 23, 2022 - Monday - 12:12 pm', 0, 0),
(176, 1, 'Developers Training Files', 116, 'OTK_Coding_Rules_ver1.1', 'OTK_Coding_Rules_ver1.1.pdf', 'May 23, 2022 - Monday - 12:15 pm', 0, 0),
(177, 1, 'Developers Training Files', 116, 'OTK_Unified_Coding_Approach', 'OTK_Unified_Coding_Approach.pdf', 'May 23, 2022 - Monday - 12:15 pm', 0, 0),
(178, 1, 'Information Security Files', 117, 'Information Security Handbook ver1.3 (1. Basics)_EN', 'Information Security Handbook ver1.3 (1. Basics)_EN.pdf', 'May 23, 2022 - Monday - 12:21 pm', 0, 0),
(179, 1, 'Information Security Files', 117, 'Information Security Handbook ver1.3 (2. DM Services)_EN', 'Information Security Handbook ver1.3 (2. DM Services)_EN.pdf', 'May 23, 2022 - Monday - 12:21 pm', 0, 0),
(180, 204, 'Email Templates', 118, 'Email Templates', 'Email Templates.xlsx', 'May 31, 2022 - Tuesday - 12:43 pm', 0, 0),
(181, 204, 'Email Templates', 119, 'Email Templates', 'Email Templates.xlsx', 'May 31, 2022 - Tuesday - 02:07 pm', 0, 0),
(182, 204, 'DX Info Hub Documents', 120, 'Manual Guide for Users', 'DX INFOHUB-User Manual-v3.0.pdf', 'June 1, 2022 - Wednesday - 10:30 am', 0, 0),
(184, 153, 'Sample Document', 121, 'Sample', 'remoteonsite-2022-06-01.xlsx', 'June 7, 2022 - Tuesday - 09:42 am', 0, 0),
(185, 153, 'Sample Document', 121, 'Sample2', 'onsite-2022-05-27 (1).xlsx', 'June 7, 2022 - Tuesday - 09:42 am', 0, 0),
(186, 155, 'Important Files', 122, 'TEST', 'DX Onboarding Plan.pdf', 'June 27, 2022 - Monday - 10:45 am', 0, 0),
(192, 155, 'HMO', 124, 'TEST 33030', 'DX Onboarding Plan (3).pdf', 'June 28, 2022 - Tuesday - 10:45 am', 0, 0),
(193, 177, 'HMO', 124, 'DX Onboarding', 'DX Onboarding Plan (3) (1).pdf', 'July 29, 2022 - Friday - 04:00 pm', 0, 0),
(194, 177, 'TEST FORMS', 125, 'test', 'DX Onboarding Plan (3) (1).pdf', 'July 29, 2022 - Friday - 04:01 pm', 0, 0),
(195, 177, 'HMO', 124, 'test', 'Intellicare Orientation deck.pdf', 'August 3, 2022 - Wednesday - 01:37 pm', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `generals`
--

CREATE TABLE `generals` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pagination_set`
--

CREATE TABLE `pagination_set` (
  `id` int(255) UNSIGNED NOT NULL,
  `announcement` int(255) NOT NULL DEFAULT 0,
  `documentquicklinks` int(255) NOT NULL DEFAULT 0,
  `users` int(255) NOT NULL DEFAULT 0,
  `webinarandevents` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pagination_set`
--

INSERT INTO `pagination_set` (`id`, `announcement`, `documentquicklinks`, `users`, `webinarandevents`) VALUES
(1, 5, 5, 5, 6),
(2, 10, 10, 10, 10),
(3, 15, 15, 15, 15),
(4, 20, 20, 20, 20),
(5, 30, 30, 30, 30),
(6, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pagination_set_active`
--

CREATE TABLE `pagination_set_active` (
  `id` int(255) UNSIGNED NOT NULL,
  `pagination_active` int(2) NOT NULL DEFAULT 0,
  `pagination_name` varchar(255) CHARACTER SET utf16 NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pagination_set_active`
--

INSERT INTO `pagination_set_active` (`id`, `pagination_active`, `pagination_name`) VALUES
(1, 5, 'Webinar and Events'),
(2, 10, 'Users'),
(3, 30, 'Announcement'),
(4, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(255) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `permissions` varchar(20000) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT 0,
  `temp_del` int(20) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `permissions`, `status`, `temp_del`) VALUES
(1, 'Super Admin', 'all', 0, 0),
(2, 'View Only', 'View Only', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `search_tbl`
--

CREATE TABLE `search_tbl` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL,
  `team` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `search_tbl`
--

INSERT INTO `search_tbl` (`id`, `user_id`, `team`, `status`) VALUES
(2, 0, 'Team Goop!', 0),
(3, 0, 'Team B', 0),
(4, 0, 'Team C', 0),
(5, 0, 'Team D', 0),
(6, 0, 'Team E', 0),
(7, 0, 'Team F', 0),
(9, 0, 'Team BD', 0),
(10, 0, 'Team Management', 0),
(12, 0, 'Trainees', 0),
(16, 0, 'Tech Team', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teamviews`
--

CREATE TABLE `teamviews` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `carousel_img` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(255) NOT NULL,
  `date_edit` varchar(255) CHARACTER SET utf8 NOT NULL,
  `temp_del` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id` bigint(255) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `upass` varchar(200) NOT NULL,
  `employeeid` varchar(20) NOT NULL DEFAULT '',
  `date_start` int(8) NOT NULL DEFAULT 0,
  `date_end` int(8) NOT NULL DEFAULT 0,
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `middlename` varchar(50) NOT NULL DEFAULT '',
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `skills` varchar(255) NOT NULL DEFAULT '',
  `personal_details` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(150) NOT NULL DEFAULT '',
  `mobile` varchar(50) NOT NULL DEFAULT '',
  `photo` varchar(100) NOT NULL DEFAULT '',
  `roleids` varchar(500) NOT NULL DEFAULT ',',
  `permissions` varchar(20000) NOT NULL DEFAULT '',
  `data_per_page` int(3) NOT NULL DEFAULT 30,
  `last_login` int(20) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  `temp_del` int(20) NOT NULL DEFAULT 0,
  `position` text NOT NULL,
  `access_role` int(1) NOT NULL DEFAULT 0,
  `team` text NOT NULL,
  `language` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `upass`, `employeeid`, `date_start`, `date_end`, `firstname`, `middlename`, `lastname`, `skills`, `personal_details`, `email`, `mobile`, `photo`, `roleids`, `permissions`, `data_per_page`, `last_login`, `status`, `temp_del`, `position`, `access_role`, `team`, `language`) VALUES
(1, 'superadmin', '$2y$10$V20FOs0HNEu/ggAzHF9dquhjf/472JyT6u4ioMl2LtQJeqH/TRHNK', '10001', 0, 0, 'Super', '', 'Admin', '0', '0', '', '', '', ',1,', '', 30, 1660201937, 0, 0, '', 0, '', 0),
(157, 'Dex_Macabangon', '$2y$10$ONYBrC5pA1cxbyJRhvMSxezG/ccbpA1d/iFe.fXAYZdfvoqDgHgTm', '2210784', 20220103, 0, 'Dexter', 'Guzman', 'Macabangon', 'Developer', 'I don\'t stop when I\'m tired. I only  stop when I\'m done', 'dexter-guzman.m1@trans-cosmos.co.jp', '09983544993', 'dextermacabangon.png', ',2,', '', 15, 1653904712, 0, 1654565805, 'Senior Associate', 0, 'Tech Team', 0),
(156, 'Angelo_Manaog', '$2y$10$dqd8DFhzCbS51BrVXjs6o.8VwMMs6Wew0mGltMo5RuPBGevV7YdIO', '2210200', 20210614, 0, 'Michael Angelo', 'Tribiana', 'Manaog', 'Assistant Lead Developer', 'What we fear doing most is usually what we most need to do.', 'michael-angelo.manaog@transcosmos.com.ph ', '09651574364', 'michaelangelomanaog.jpg', ',2,', '', 15, 0, 0, 0, 'Assistant Lead Developer', 0, 'Tech Team', 0),
(154, 'Jev_Longakit', '$2y$10$bSld.cADVmH7WYKfYYjowuhaA9KHMUmN8HZHjzxsITKM18nU4ycUm', '2210476', 20210920, 0, 'Maria Jeveca', 'Huyo-a', 'Longakit', 'QA', 'QA', 'jeveca.longakit1@trans-cosmos.co.jp ', '09686930865', 'marialongakit.jpg', ',1,', '', 15, 1654588264, 0, 0, 'QA', 0, 'Tech Team', 0),
(155, 'Ryan_Verba', '$2y$10$5ZW3pukHyDy4.cKRM3f8Fe/IgAHUbzv9rxMZKFn2SHWuUs0McxTh6', '2210725', 20211216, 0, 'John Ryan', 'Ting', 'Verba', 'QA', 'Do your best and God will do the rest.', 'john-ryan.verba1@trans-cosmos.co.jp', '09177761204', 'ryanverba.jpg', ',1,', '', 15, 1659061328, 0, 0, 'QA', 0, 'Tech Team', 0),
(152, 'Joel_Abunales', '$2y$10$MVfHoh2Cgk2TUNWnoLC0u.o/X8sBhqApQuSJgxs5oWAzog2QpyRqa', '2190029', 20190401, 0, 'Joel ', 'Severo', 'Abunales', 'Developer', 'Developer', 'joel.abunales1@trans-cosmos.co.jp ', '09386672104', 'TOPemployee(1).png', ',2,', '', 15, 0, 1, 1653042113, 'Developer', 0, 'Tech Team', 0),
(153, 'Kari_Dado', '$2y$10$teUAQ2eQ5HidK1sV/t4A/uUBRM07kpG9t2QbKuFmzwN9TFl4jUMyu', '2210413', 20220621, 0, 'Karrilene', 'Palo', 'Dado', 'QA', 'Breath, Enjoy, Let Go. Because everything always happen for a reason.', 'karrilene.dado1@trans-cosmos.co.jp ', '09167948190', 'karrilenedado.jpg', ',1,', '', 15, 1656379465, 0, 0, 'QA', 0, 'Tech Team', 0),
(151, 'Junel_Aceres', '$2y$10$qvqaTMce5n5PhKv4zRHeluM5.9XHrCUIUiPJyRIhQnAZCol6pJ1uu', '2180182', 20180502, 0, 'Junel ', 'De Guzman', 'Aceres', 'Web Development, UI/UX Design, Quality Assurance, Project Management', 'Do not stress yourself on things you cannot control. It is what it is.', 'junel.aceres1@trans-cosmos.co.jp ', '09185190243', 'junelaceres.jpeg', ',1,', '', 15, 1654564412, 0, 0, 'Senior Front-End Web Developer / Designer', 0, 'Tech Team', 0),
(150, 'Ian_Nicolas', '$2y$10$MlAxlUdBV8qI/hDqvueBfOAZ6lIaJB6fwOxa/mZ1jr6peFNaBmvU6', '2160046', 20160518, 0, 'Ian', 'Gutierez', 'Nicolas', 'Leadership Skills, Management Skills', 'None', 'ian.nicolas1@trans-cosmos.co.jp', '09235147117', 'iannicolas.jpg', ',1,', '', 15, 1654556947, 0, 1646623048, 'Lead Developer', 0, 'Tech Team', 0),
(158, 'Antonio_Aduna', '$2y$10$i2FNCoc3zY4/b9gWJDQZf.uVTZ8ZJePmuwt1clUNoJyI5ZONua6Se', '2150088', 20151016, 0, 'Antonio Jr.', 'Quimpo', 'Aduna', 'Lead Developer', 'If you want to be strong, learn to fight alone.', 'antonio.aduna1@trans-cosmos.co.jp', '09477087573', 'antonioaduna.jpg', ',2,', '', 15, 1659061471, 0, 0, 'Lead Developer', 0, 'Team B', 0),
(159, 'Joseph_Mondia', '$2y$10$UUbiZKcf/sazbky9CxAbruSpr4NATC4.LWtUFs7tGIH/S/tYkD7Fa', '2150096', 20151102, 0, 'Joseph John', 'Tubongbanua', 'Mondia', 'Lead Developer', 'He who knows best knows how little he knows.', 'joseph-john.mondia1@trans-cosmos.co.jp ', '09214717729', 'josephmondia.jpg', ',2,', '', 15, 1653905259, 0, 0, 'Lead Developer', 0, 'Team B', 0),
(160, 'Julie_Monton', '$2y$10$CXVg2gCm2ac8kh1of8vGyu8jFxEGXmioR.EDPhnTe2gSuf0mq/vtm', '2190019', 20190301, 0, 'Julie Ann', 'Lipio ', 'Monton', 'Senior Associate', 'If you can dream it, you can do it.', 'monton.julie-ann1@trans-cosmos.co.jp ', '09364265720', 'juliemonton.jpg', ',2,', '', 15, 0, 0, 0, 'Senior Associate', 0, 'Team B', 0),
(161, 'Phillip_Ventura', '$2y$10$Rl1nOVqlDqHS4sKQ7yt9OexMBjuqgfsy4pXF9KNYv/OjCoXCfMlFy', '2200031', 20200203, 0, 'Phillip Carlo', 'Portinto', 'Ventura', 'Lead Developer', 'Lead Developer', 'philipcarlo.ventura1@trans-cosmos.co.jp', '09568809841', 'phillipventura.jpg', ',2,', '', 15, 0, 0, 0, 'Lead Developer', 0, 'Team B', 0),
(162, 'Erwina_Catacutan', '$2y$10$EjXE1Q3s.oeHWIOQ90EMY.EKufwyjgIovIFmoICj8QDlEndjOLai2', '2210339', 20210823, 0, 'Erwina', 'Dela Cruz', 'Catacutan', 'Associate', 'Associate', 'erwina.catacutan1@trans-cosmos.co.jp ', '09974250106', 'erwinacatacutan.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team C', 0),
(163, 'Matthew_Del Rosario', '$2y$10$PeFRf7uHhRP5vWgbDycvkuCRo9OXSQQCZpfrMzToh3/au4muuQb4e', '2190031', 20190410, 0, 'Matthew', 'Gile', 'Del Rosario', 'Associate', 'Associate', 'matthew.del-rosario2@trans-cosmos.co.jp', '09260326287', 'user-avatar.jpg', ',2,', '', 15, 0, 1, 1652769493, 'Associate', 0, 'Team C', 0),
(164, 'Revin_Galindez', '$2y$10$D/PAeaZiO.gBWSRiWpZZfOF/uJUF/7v4lWiEWH0JYuUyry/EMPEz2', '2170244', 20171009, 0, 'Revin', 'Santos', 'Galindez', 'Associate', 'If you\'re not a good shot today, don\'t worry. There are other ways to be useful.', 'revin.galindez1@trans-cosmos.co.jp', '09106976227', 'revingalindez.JPG', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team C', 0),
(165, 'Essel_Luna', '$2y$10$1jg8HaCzkGJwPCCzt7Y6TuaX2mON9FxpvFT1moyOPFzOG1sR1aWvC', '2210475', 20210921, 0, 'Essel May', 'Santiago', 'Luna', 'Associate', 'Fearlessly be yourself.', 'essel.luna1@trans-cosmos.co.jp ', '09559228343', 'esselluna.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team C', 0),
(166, 'John_Serminio', '$2y$10$0tZQNqDB0dXUyl.91LX3eOvrNB/vOBY8giwS954vVScJ1pvN5vfX2', '2190037', 20190506, 0, 'John Michael', 'Hibe ', 'Serminio', 'Associate', 'Associate', 'John-michael.S2@trans-cosmos.co.jp', '09166580688', 'johnmichaelserminio.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team C', 0),
(167, 'Jessa_Abulencia', '$2y$10$dpcN1JsUvEVaD1kZ56mQR.1iKCWgf67/7KLWwlC7kVCXT1OdUjjRe', '2170041', 20170529, 0, 'Jessa Faye', 'Joves', 'Abulencia', 'Senior Associate', 'Senior Associate', 'jessa-faye.abulencia1@trans-cosmos.co.jp', '09481364523', 'jessaabulencia.jpg', ',2,', '', 15, 1660203725, 0, 0, 'Senior Associate', 0, 'Team D', 0),
(168, 'David_Dela Cruz', '$2y$10$5Y/boemYJEDVkQViHA1pLO47fJ.5sVrg4x82oSTZCVK1AzQOMaItm', '2190051', 20190524, 0, 'David Isaac', 'Baclayon', 'Dela Cruz', 'Associate', 'Slow down, but don’t stop.', 'david-isaac.d1@trans-cosmos.co.jp ', '09352477850', 'daviddelacruz.png', ',2,', '', 15, 1653959173, 0, 0, 'Associate', 0, 'Team D', 0),
(169, 'Rachel_Robles', '$2y$10$T5GC/LybTuJxiRqi1RKFHOgzBFuq/cbOKPoyK/0VZV1D.ijvS5du.', '2190046', 20190524, 0, 'Rachel', 'Ardeza', 'Robles', 'Associate', 'Associate', 'rachel.robles1@trans-cosmos.co.jp', '09387877246', 'rachelrobles.JPG', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team D', 0),
(170, 'James_Salva', '$2y$10$BDjCjSdbP.j3.PBpRtOAJurD9C4Dd1UGzvyBVFWdYFQj.H83Y3CO6', '2190030', 20190410, 0, 'James Albert', 'San Juan', 'Salva', 'Senior Associate', 'Senior Associate', 'james-albert.salva1@trans-cosmos.co.jp ', '09121733189', 'jamessalva.jpg', ',2,', '', 15, 0, 0, 0, 'Senior Associate', 0, 'Team D', 0),
(171, 'Joseph_Carpio', '$2y$10$ykZ8SlyL7m3xLXl.yG.suOJmXs8E.Nte0vKShXPkh9kR6uVFsAXdO', '2150029', 20150616, 0, 'Joseph Anthony', 'Flores', 'Carpio', 'Lead Developer', 'Lead Developer', 'joseph-anthony.c1@trans-cosmos.co.jp', '09267291629', 'josephcarpio.jpg', ',2,', '', 15, 0, 0, 0, 'Lead Developer', 0, 'Team E', 0),
(172, 'Exequiel_Delfin', '$2y$10$XHIufvAP.eJjAnvDfmVsR.WIEiye8x3xeU9Ry/Xx2.9liPgO9LBPO', '2190048', 20190524, 0, 'Exequiel', 'Luces', 'Delfin', 'Senior Associate', 'Don\'t go through life, grow through life.', 'exequiel.delfin1@trans-cosmos.co.jp', '09176396869', 'exequieldelfin.jpeg', ',2,', '', 15, 0, 0, 0, 'Senior Associate', 0, 'Team E', 0),
(173, 'Alexandra_Marasigan', '$2y$10$SNyW.EJGnzytcx9L7HLjBuT5Nu4EtkvpR5YH9VpUuX/Q6oYRTRJ7C', '2190047', 20190524, 0, 'Alexandra', 'Casiple', 'Marasigan', 'Associate', 'Associate', 'alexandra.marasigan1@trans-cosmos.co.jp ', '09556335512', 'alexandramarasigan.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team E', 0),
(174, 'Raven_Reyes', '$2y$10$vgy7mXs1gI6.bujvQmDl0OF/SSyO3SXYjcHifnXsTfp03jb3avIzK', '2210499', 20210927, 0, 'Raven Auriesh', 'Corpuz', 'Reyes', 'Associate', 'No matter how hard or impossible it is. Never lose sight of your goal.', 'raven.reyes1@trans-cosmos.co.jp ', '09050395896', 'ravenreyes.jpeg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team E', 0),
(175, 'Lerin_Sevenorio', '$2y$10$eUl5OuT/jd0PL7MjoSj1HueAXy1cW.iAmy29JDYlCTFulyPHAsevm', '2190195', 20191127, 0, 'Lerin John', 'Mendoza', 'Sevenorio', 'Associate', 'Associate', 'lerin-john.sevenorio1@trans-cosmos.co.jp', '09456722816', 'user-avatar.jpg', ',2,', '', 15, 0, 1, 1652773469, 'Associate', 0, 'Team E', 0),
(176, 'Michael_Antipuesto', '$2y$10$duYS8K.ML2zO1RSNOP63UONhIJi6uTA7ZceXNAB5Wy7zuRDHJvqIq', '2210412', 20210909, 0, 'Michael Angelo', 'De Vera', 'Antipuesto', 'Associate', 'Don\'t be afraid to give up the good to go for the great.', 'Michael-angelo.A1@trans-cosmos.co.jp ', '09959325871', 'michaelangeloantipuesto.png', ',2,', '', 15, 1653957397, 0, 0, 'Associate', 0, 'Team Goop!', 0),
(177, 'Julcess_Mercado', '$2y$10$SD9bUMf7Uc.SSIAnQWvyK.2Dcx950nx81IbAWNFrpSovTek5tOJG2', '2200057', 20200218, 0, 'Julcess Marie', 'Papica', 'Mercado', 'Senior Associate', 'Appear as you are, be as you appear.', 'julcess-marie.m1@trans-cosmos.co.jp ', '09754310357', 'julcessmercado.jpg', ',1,', '', 15, 1661159641, 0, 0, 'Senior Associate', 0, 'Team Goop!', 0),
(178, 'Christian_Alde', '$2y$10$ZW9awjmXkY8mZIdycVCxdesK8KrpLI84sarv1FuAEIJm2PCZSGdnO', '2170052', 20170613, 0, 'Christian', 'Viray', 'Alde', 'Lead Developer', 'Lead Developer', 'christian.alde1@trans-cosmos.co.jp ', '09956684009', 'christianalde.jpg', ',1,', '', 15, 1660862128, 0, 0, 'Lead Developer', 0, 'Team Management', 0),
(207, 'Bart_Tabusao', '$2y$10$5AeHHVRQPafQQTnKRE6fh.KdnhsNL6UD2XqF1G7uCZicV2F9wqJEW', '2220005', 20220510, 0, 'Bart', 'Quilala', 'Tabusao', 'Associate', 'Everything is a learning experience.', 'bart.tabusao1@trans-cosmos.co.jp', '01234567891', 'barttabusao.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Trainees', 0),
(180, 'Yves_Batungbacal', '$2y$10$eo3HAafw8QN02NT1lRVpYe15hN.QLY3qdc8LKtJCN2dDHHndoWEgy', '2210040', 20210301, 0, 'Yves Patrick', 'Valiente', 'Batungbacal', 'Team Leader', 'Things, somehow, have a way of working themselves out. Just keep going.', 'yves-patrick.b1@trans-cosmos.co.jp ', '09271276183', 'yvesbatungbacal.jpg', ',1,', '', 15, 1654564436, 0, 0, 'Team Leader', 0, 'Team Management', 0),
(181, 'Ashley_Felix', '$2y$10$zthZC0Xo3bUT3xlaANwi.OMRurEsWZCirraYKwWwt6wij2vsnpXKu', '2150107', 20151116, 0, 'Jennica Ashley', 'Ortiz', 'Felix', 'Lead Developer', 'Don\'t be afraid to believe in YOURSELF', 'jennica-ashley.felix1@trans-cosmos.co.jp ', '09568044477', 'ashleyfelix.jpg', ',1,', '', 15, 1654565912, 0, 0, 'Lead Developer', 0, 'Team Management', 0),
(182, 'Jeffrey_Agregado', '$2y$10$MzpW49obVfHBoNyP6.WbCubTsyXZxudE8Q7HF5CqLor18qq.ULAYS', '2210493', 20211025, 0, 'Jeffrey Andrew', 'Erice', 'Agregado', 'Associate', 'Work smart not harder.', 'jeffrey-andrew.a1@trans-cosmos.co.jp ', '09774096572', 'jeffreyagregado.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team F', 0),
(183, 'Rocky_Astor', '$2y$10$/egAy0KK6T3LNtoSE/9WeOrVxgQC49dGHsBM36HCkDRpxu17LF2DW', '2190012', 20190222, 0, 'Rocky', 'Padilla', 'Astor', 'Associate', 'Associate', 'astor.rocky1@trans-cosmos.co.jp ', '09159082042', '933-9332131_profile-picture-default-png.png', ',2,', '', 15, 0, 1, 1652763406, 'Associate', 0, 'Team Sony', 0),
(184, 'John_Monteagudo', '$2y$10$jwBAVvDqQbXR2mjy6A7VEua9P2mVQh3QNBMKjl6oeuXRPZndyKFtC', '2200058', 0, 0, 'John Juvir', 'Cabuga', 'Monteagudo', 'Associate', 'Associate', 'john-juvir.m1@trans-cosmos.co.jp ', '09454789167', 'johnjuvirmonteagudo.jpg', '', '', 15, 1657514024, 0, 0, 'Associate', 0, 'Team F', 0),
(185, 'Crisler_Vallo', '$2y$10$2ZQUN8dNpBVE5RJSFVNi0OqELajwORmaL4yjr1X/yukTk21Xqlqc6', '2190210', 20191216, 0, 'Crisler', 'Billones', 'Vallo', 'Associate', 'Know your limitations, and defy them.', 'crisler-billones.v1@trans-cosmos.co.jp ', '09456020881', 'crislervallo.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team F', 0),
(186, 'Yumeka_Iino', '$2y$10$iPkRR583H8m1cKRYMUIp0ei/qdymWits8febbHUcmU5QVgqDJjK6W', '2210694', 20211115, 0, 'Yumeka', 'Sioco', 'Iino', 'BD - Associate', 'All praise to the most high, bless up.', 'iino.yumeka1@trans-cosmos.co.jp ', '09606095191', 'yumekalino.jpg', ',2,', '', 15, 1653959222, 0, 0, 'BD - Associate', 0, 'Team BD', 0),
(187, 'Rizza_Isla', '$2y$10$b4MzQgXK/eYKGlEDB.JamueFEOFK66NyMLz4KHGZBAFNn4RfA4xgG', '2210630', 20211103, 0, 'Rizza', 'Navato', 'Isla', 'Associate', 'Associate', 'Riza-joy.Isla1@trans-cosmos.co.jp', '09050395 896', '933-9332131_profile-picture-default-png.png', ',2,', '', 15, 0, 1, 1652763474, 'Associate', 0, 'Team BD', 0),
(188, 'Leonard_Lumbad', '$2y$10$wDrtBS6Nf0hI0BI6eIT4Hu3jaEKBHXZQLQQhoVn7bhntmWWn9cqia', '2210749', 20211115, 0, 'Leonard', 'Arcenilla', 'Lumbad', 'BD - Associate', 'I act today to improve my life tomorrow.', 'leonald.lumbad1@trans-cosmos.co.jp', '09054572752', 'leonardlumbad.jpg', ',2,', '', 15, 0, 0, 0, 'BD - Associate', 0, 'Team BD', 0),
(189, 'Gregorio_Mora', '$2y$10$bDWw75/E4rEO0qOh9urKNet2shfcQsjWUerwir.W9noYOARSTgK2m', '2200015', 20200120, 0, 'Gregorio II', 'Ramos', 'Mora', 'Associate', 'Time is Gold.', 'gregorio-r.moraiii1@trans-cosmos.co.jp ', '09770138908', 'gregoriomora.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team BD', 0),
(190, 'Ron_Rillera', '$2y$10$un2jMk2EU.y0bDwUQo17VOs4gz22a/vMlIQi14x76YCZ/DHeUJJl2', '2190050', 20190524, 0, 'Ron Lester', 'Vanta', 'Rillera', 'BD - Associate', 'BD - Associate', 'ron-lester.rillera1@trans-cosmos.co.jp ', '09214775354', 'ronrillera.png', ',2,', '', 15, 0, 0, 0, 'BD - Associate', 0, 'Team BD', 0),
(191, 'Sheila_Siongco', '$2y$10$qHRFG025ETCIz7AV3ZMMc.ANNVuMnPsgDOeShB52rut.aT7gOKnTe', '2210785', 20211227, 0, 'Sheila Victoria', 'Cruz', 'Siongco', 'BD - Associate', 'Life doesn\'t always go as planned, but I am more thankful that it didn\'t.', 'sheila-victoria.s1@trans-cosmos.co.jp', 'NA', 'sheilasiongco.jpg', ',2,', '', 15, 0, 0, 0, 'BD - Associate', 0, 'Team BD', 0),
(192, 'Mary_Bolima', '$2y$10$cvuqm6J86x0cuL3jLYTPkehOvxl/EHzjTYkWYBhMzGC98DXnRbMEK', '2210773', 20211227, 0, 'Mary Joy', 'Acabado', 'Bolima', 'BD - Associate', 'Nothing in nature blooms all year. Be patient with yourself.', 'mary-joy.bolima1@trans-cosmos.co.jp', 'NA', 'marybolima.jpg', ',2,', '', 15, 0, 0, 0, 'BD - Associate', 0, 'Team BD', 0),
(193, 'Marivic_Nayve', '$2y$10$f83x86gEXv5DdooT6qDkpeRr1HxUuhQzTR/u0OPCXhyvVlol96vEO', '2210791', 20220110, 0, 'Marivic', 'Mengorio', 'Nayve', 'BD - Associate', 'BD - Associate', 'Marivic.Nayve1@trans-cosmos.co.jp', '09275727586', 'girl employee.jpg', ',2,', '', 15, 0, 1, 1652688514, 'BD - Associate', 0, 'Team BD', 0),
(194, 'D_Paril', '$2y$10$9T5BvNvtaC1o14avCFgIiu1e8lACjqNMzsOK0JLsbb.vTgpEAve1i', '2210813', 20220202, 0, 'D-pper Ken Hope ', 'Ponting', 'Paril', 'BD - Associate', 'Everything happens for a reason. Be adaptable to change because its inevitable.', 'Ken.Hopep-paril1@trans-cosmos.co.jp', '09455708169', 'kenparil.jpg', ',2,', '', 15, 0, 0, 0, 'BD - Associate', 0, 'Team BD', 0),
(195, 'Manuel_Bersamina', '$2y$10$k092s00mdHiJPEYHIvfX5u0VSPxyIMvtIZ1qn1HyxpIPw29lP8EsG', '2210894', 20220324, 0, 'Manuel', 'Dario', 'Bersamina', 'FE-Associate', 'The happiness on your life depends on the quality of your thoughts.', 'manuel.bersamina1@trans-cosmos.co.jp', '9670230302', 'manuelbersamina.jpg', ',2,', '', 15, 0, 0, 1647880736, 'FE-Associate', 0, 'Trainees', 0),
(201, 'Catiis_Joseph', '$2y$10$MQhSJAuIKSbd8JOjlY14we0J1zckk0izgd6C9.Qy7FUtN8NkVTkjm', '2210903', 20220401, 0, 'Joseph', 'de Guzman', 'Catiis', 'BD - Associate', 'BD - Associate', 'joseph.catiis1@trans-cosmos.co.jp', '0956143134', 'josephcatiis.jpg', ',2,', '', 15, 0, 0, 0, 'BD - Associate', 0, 'Trainees', 0),
(199, 'Jeremy_Dadua', '$2y$10$hmL.RoaO5RubH1QzeB224e.k7ekce8jhUnXj1lOrO5dcjX.49ArI6', '2217400', 20220103, 0, 'Jeremy', 'Amadeo', 'Dadua', 'Associate', 'Associate', 'jeremy-amadeo.dadua1@trans-cosmos.co.jp', '093880088', 'jeremydudua.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Trainees', 0),
(200, 'Joan_Francisco', '$2y$10$c/bEsFB55vxmIt8i14k/AuTD7Ek1esOou5u3bQ3H2otjFWsj1gwYu', '2210817', 20220216, 0, 'Joan', 'Borcelis', 'Francisco', 'Associate', 'Life can be heavy, especially if you try to carry it all at once. Decide what is yours to hold and let the rest go.', 'joan.francisco1@trans-cosmos.co.jp', '093068032', 'joanfrancisco.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Trainees', 0),
(202, 'Gumapo_Raffy', '$2y$10$RardOjnGvU6Q8I3aC4j5ceQG/wCeAZDUlTcZvu03yRRGH2iVWEh3S', '2210909', 20220401, 0, 'Raffy', 'Hisola', 'Gumapo', 'FE-Associate', ' It is better to be hated for what you are, than to be loved for what you are not.', 'raffy.gumapo1@trans-cosmos.co.jp', '0945501228', 'raffygumapo.jpg', ',2,', '', 15, 0, 0, 0, 'FE-Associate', 0, 'Trainees', 0),
(205, 'Dexter_Nierva', '$2y$10$O2u4q8.t3EhauSzz.WANDuE.FrkpyGalaaGJxSsfMClaTFwsJPshm', '2210914', 20220411, 0, 'Dexter', 'Beray', 'Nierva', 'FE - Associate', 'Pursue what is meaningful not what is expedient.', 'dexter.nierva1@trans-cosmos.co.jp', '09664175776', 'dexternierva.jpg', ',2,', '', 15, 0, 0, 0, 'FE - Associate', 0, 'Trainees', 0),
(206, 'Lorenzo_Cruz', '$2y$10$zD3EEDqc1LPl2RStaJWcBe90/iLrObZtQb9jWGGA4Jr5UbQICgehi', '2210937', 20220510, 0, 'Lorenzo Jr.', 'Irinco', 'Cruz', 'Associate', 'Associate', 'lorenzo-jr.cruz1@trans-cosmos.co.jp', '0927324312', 'lorenzocruz.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Trainees', 0),
(204, 'Morris_Ampioco', '$2y$10$YPVgp6zVYFNjT3GUjgcf6OY9/82Mogk27gLw77uvTghc9IKJydGvq', '2180223', 20181022, 0, 'Morris John Louise', 'Guillan', 'Ampioco', 'Division Manager', 'No longer I who live, but it is Christ who lives in me. (Galatians 2:20)', 'ampioco.morris1@trans-cosmos.co.jp', '0998 841 9002', 'morrisampioco.jpg', ',1,', '', 15, 1656311161, 0, 0, 'Division Manager', 0, 'Team Management', 0),
(208, 'Neil_Magnanao', '$2y$10$nB0WmqHzkgTSI/YVUXBqSOauXub/nyL24VzCNKqWmGB6qpthSFY46', '2210936', 20220310, 0, 'June Neil', 'Siao', 'Magnanao', 'Senior Associate', 'I am conquering my fears and becoming stronger each day.', 'juneneil.magnanao1@trans-cosmos.co.jp', '09639009857', 'junemagnanao.jpg', ',2,', '', 15, 0, 0, 0, 'Senior Associate', 0, 'Trainees', 0);

-- --------------------------------------------------------

--
-- Table structure for table `webinarandevents`
--

CREATE TABLE `webinarandevents` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `img_count` int(1) NOT NULL DEFAULT 0,
  `images` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_set` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `month_set` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_now` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT 0,
  `temp_del` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `webinarandevents`
--

INSERT INTO `webinarandevents` (`id`, `user_id`, `title`, `img_count`, `images`, `description`, `date_set`, `month_set`, `date_now`, `status`, `temp_del`) VALUES
(80, 1, 'Enchanting Masquerade - TCAP Thanksgiving Party', 1, 'tcap-thanksgiving-party.jpg', '', '20211217', '202112', 'March 3, 2022 - Thursday - 04:17 pm', 0, 0),
(82, 1, 'DX Online Christmas Party', 1, 'dx-christmas-party.jpg', '', '20211215', '202112', 'March 3, 2022 - Thursday - 04:19 pm', 0, 0),
(84, 1, 'Little Ways You Can Organize', 1, 'little-ways-to-organize.jpg', '', '20220114', '202201', 'March 3, 2022 - Thursday - 04:27 pm', 0, 0),
(86, 1, 'The Art of Mutitasking', 1, 'art-of-multitask.jpg', '', '20220121', '202201', 'March 3, 2022 - Thursday - 04:32 pm', 0, 0),
(88, 1, 'January 2022 General Assembly', 1, 'jan2022GA.jpg', '', '20220114', '202201', 'March 4, 2022 - Friday - 10:28 am', 0, 0),
(90, 1, 'January 2022 Ice Breaker', 1, 'jan2022team-bonding.jpg', '', '20220114', '202201', 'March 4, 2022 - Friday - 10:33 am', 0, 0),
(91, 1, 'Connecting Passion with Purpose', 1, 'passion-with-purpose.jpg', '', '20220121', '202201', 'March 4, 2022 - Friday - 11:04 am', 0, 0),
(92, 1, 'RPA and Web Development', 1, 'rpa-vs-webdev.jpg', '', '20220121', '202201', 'March 4, 2022 - Friday - 11:05 am', 0, 0),
(94, 1, 'February 2022 Ice Breaker', 0, 'feb2022team-bonding.jpg', '', '20220210', '202202', 'March 24, 2022 - Thursday - 02:51 pm', 0, 0),
(95, 1, 'Importance of using Git in our JOs', 1, 'using-git-in-jo.jpg', '', '20220211', '202202', 'March 4, 2022 - Friday - 11:09 am', 0, 0),
(97, 1, 'How to protect yourself from Cyber Attacks', 1, 'cyber-attacks.jpg', '', '20220221', '202202', 'March 4, 2022 - Friday - 11:11 am', 0, 0),
(98, 1, 'March 2022 General Assembly', 1, 'mar2022GA.jpg', '', '20220311', '202203', 'March 4, 2022 - Friday - 12:17 pm', 0, 0),
(99, 1, 'March 2022 Ice Breaker', 1, 'mar2022team-bonding.jpg', '', '20220311', '202203', 'March 4, 2022 - Friday - 12:18 pm', 0, 0),
(100, 1, 'Clean Coding', 0, 'clean-coding.jpg', '<p>Clean Coding<br></p>', '20220302', '202203', 'April 4, 2022 - Monday - 11:39 am', 0, 0),
(111, 1, 'TEAM DYNAMIC', 0, 'dx1.jpg', '<p>TEAM DYNAMIC<br></p>', '20211202', '202112', 'March 24, 2022 - Thursday - 02:33 pm', 0, 0),
(118, 1, 'Adobe XD Workshop', 1, 'unnamed (4).jpg', '<p><b>Adobe XD Workshop</b><br></p>', '20220429', '202204', 'April 28, 2022 - Thursday - 10:11 am', 0, 0),
(119, 1, 'Millennials in Workforce', 1, 'unnamed (5).jpg', '<p><b>Millennials in Workforce</b><br></p>', '20220221', '202202', 'April 28, 2022 - Thursday - 10:23 am', 0, 0),
(122, 1, 'Ice Breaker Activity April 2022', 0, 'Ice Breaker Activity April 2022.jpg', '<p><b>Ice Breaker Activity April 2022</b><br></p>', '20220408', '202204', 'April 28, 2022 - Thursday - 10:43 am', 0, 0),
(123, 1, 'MAY 2022 GENERAL ASSEMBLY', 0, 'MAY 2022 GENERAL ASSEMBLY.png', '<p>MAY 2022 GENERAL ASSEMBLY<br></p>', '20220512', '202205', 'May 16, 2022 - Monday - 12:09 pm', 0, 0),
(126, 204, 'Team Quality', 1, 'team quality.png', '<p>Team Quality<br></p>', '20220527', '202205', 'May 27, 2022 - Friday - 10:58 am', 0, 0),
(129, 1, 'June 2022 General Assembly', 0, 'JUNE GA.png', '<p>General Assembly<br></p>', '20220610', '202206', 'June 6, 2022 - Monday - 09:27 am', 0, 0),
(130, 1, 'Email Etiquette', 1, 'EMAIL ETIQUETTE.png', '<p>Email Etiquette by Morris Ampioco<br></p>', '20220610', '202206', 'June 6, 2022 - Monday - 09:28 am', 0, 0),
(131, 1, 'June 2022 Ice Breaker Activity', 1, 'Ice Breaker.png', '<p>June 2022 Ice Breaker Activity<br></p>', '20220610', '202206', 'June 6, 2022 - Monday - 09:29 am', 0, 0),
(132, 1, 'Basics of Handling Wacoal Project', 1, 'Basics of Handling Wacoal Project.png', '<p>Basics of Handling Wacoal Project by: Revin Galindez<br></p>', '20220624', '202206', 'June 6, 2022 - Monday - 09:30 am', 0, 0),
(133, 1, 'Tips in Handling Multiple Projects', 1, 'Tips in Handling Multiple Projects.png', '<p>Tips in Handling Multiple Projects by Exequiel Delfin<br></p>', '20220624', '202206', 'June 6, 2022 - Monday - 09:31 am', 0, 0),
(134, 1, 'Work Under Pressure', 1, 'WORK UNDER PRESSURE 29July2022.png', '<p>Work Under Pressure by: David Dela Cruz<br></p>', '20220729', '202206', 'June 27, 2022 - Monday - 02:28 pm', 0, 0),
(144, 155, 'July 2022 General Assembly', 0, 'JULY GA.png', '<p>July 2022 General Assembly<br></p>', '20220708', '202207', 'June 27, 2022 - Monday - 10:47 am', 0, 0),
(145, 204, 'Wordpress Basics for MassPro Projects', 1, 'WordPress Basics.png', '<p><b>Wordpress Basics for MassPro Projects</b><br></p>', '20220729', '202207', 'June 28, 2022 - Tuesday - 11:07 am', 0, 0),
(146, 204, 'TailwindCSS: A Utility-First CSS Framework', 1, 'TailwindCSS 29July2022.png', '<p><b>TailwindCSS: A Utility-First CSS Framework</b></p><div><br></div>', '20220729', '202207', 'June 27, 2022 - Monday - 02:29 pm', 0, 0),
(147, 204, 'July 2022 Team Bonding - Ice Breaker Activity', 1, 'July Ice Breaker Activity (1).png', '<p><b>July 2022 Team Bonding - Ice Breaker Activity</b><br></p>', '20220708', '202207', 'June 27, 2022 - Monday - 02:31 pm', 0, 0),
(148, 155, 'How Front-end and Back-end Developers Work Together?', 1, 'How frontend and backend work together.png', '<p><b>How Front-end and Back-end Developers Work Together?</b><br></p>', '20220718', '202207', 'June 28, 2022 - Tuesday - 11:09 am', 0, 0),
(149, 155, 'SaaS Introduction', 1, 'SaaS Introduction.png', '<p><b>SaaS Introduction</b><br></p>', '20220718', '202207', 'June 28, 2022 - Tuesday - 11:10 am', 0, 0),
(150, 155, '8 Self Improvement Tips To Get Your Life Back on Track', 1, '8 Self Improvement Tips .png', '<p><b>8 Self Improvement Tips To Get Your Life Back on Track</b><br></p>', '20220718', '202207', 'June 28, 2022 - Tuesday - 11:11 am', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentsquicklinks`
--
ALTER TABLE `documentsquicklinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentstemplate`
--
ALTER TABLE `documentstemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagination_set`
--
ALTER TABLE `pagination_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagination_set_active`
--
ALTER TABLE `pagination_set_active`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_tbl`
--
ALTER TABLE `search_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teamviews`
--
ALTER TABLE `teamviews`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `employeeid` (`employeeid`),
  ADD KEY `firstname` (`firstname`),
  ADD KEY `lastname` (`lastname`),
  ADD KEY `email` (`email`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `webinarandevents`
--
ALTER TABLE `webinarandevents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `documentsquicklinks`
--
ALTER TABLE `documentsquicklinks`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `documentstemplate`
--
ALTER TABLE `documentstemplate`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `pagination_set`
--
ALTER TABLE `pagination_set`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pagination_set_active`
--
ALTER TABLE `pagination_set_active`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `search_tbl`
--
ALTER TABLE `search_tbl`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teamviews`
--
ALTER TABLE `teamviews`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `webinarandevents`
--
ALTER TABLE `webinarandevents`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
