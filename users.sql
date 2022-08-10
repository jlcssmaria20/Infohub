-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2022 at 10:48 AM
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
(1, 'superadmin', '$2y$10$S5.Q9wYFOIpHKxFtO3pYs.FtMC0dsQVAl3bl5.kXba7mPsRB3bml6', '10001', 0, 0, 'Super', '', 'Admin', '0', '0', '', '', '', ',1,', '', 30, 1656487284, 0, 0, '', 0, '', 0),
(157, 'Dex_Macabangon', '$2y$10$Jce3H.NbAktkiHvnZDiZ3eD3YWE/Ns8lzPiR6IsLm2YMlo/ELGpF.', '2210784', 20220103, 0, 'Dexter', 'Guzman', 'Macabangon', 'Developer', 'I don\'t stop when I\'m tired. I only  stop when I\'m done', 'dexter-guzman.m1@trans-cosmos.co.jp', '09983544993', 'dextermacabangon.png', ',2,', '', 15, 1653904712, 0, 1654565805, 'Senior Associate', 0, 'Tech Team', 0),
(156, 'Angelo_Manaog', '$2y$10$JV5kvmWdLq6T93BF7Ks.tuidubCSegOaQjAzf2RoPBW8hfGIRGCDe', '2210200', 20210614, 0, 'Michael Angelo', 'Tribiana', 'Manaog', 'Assistant Lead Developer', 'What we fear doing most is usually what we most need to do.', 'michael-angelo.manaog@transcosmos.com.ph ', '09651574364', 'michaelangelomanaog.jpg', ',2,', '', 15, 0, 0, 0, 'Assistant Lead Developer', 0, 'Tech Team', 0),
(154, 'Jev_Longakit', '$2y$10$/sXhqOumLrmnh3Lu/2fO6uGfAgnSJyZE63Kctstuuow4sJ8DSNV66', '2210476', 20210920, 0, 'Maria Jeveca', 'Huyo-a', 'Longakit', 'QA', 'QA', 'jeveca.longakit1@trans-cosmos.co.jp ', '09686930865', 'marialongakit.jpg', ',1,', '', 15, 1654588264, 0, 0, 'QA', 0, 'Tech Team', 0),
(155, 'Ryan_Verba', '$2y$10$fJU3CUoWq6YpaHOCEIhhTO1q5QPnN4NGcbSqyDqKJBiK737dxLrOy', '2210725', 20211216, 0, 'John Ryan', 'Ting', 'Verba', 'QA', 'Do your best and God will do the rest.', 'john-ryan.verba1@trans-cosmos.co.jp', '09177761204', 'ryanverba.jpg', ',1,', '', 15, 1659061328, 0, 0, 'QA', 0, 'Tech Team', 0),
(152, 'Joel_Abunales', '$2y$10$11u0KAeLVTG.vzSaux1NDehGkvwYAdEP0zd/dGI2yJIjgEMuinnL2', '2190029', 20190401, 0, 'Joel ', 'Severo', 'Abunales', 'Developer', 'Developer', 'joel.abunales1@trans-cosmos.co.jp ', '09386672104', 'TOPemployee(1).png', ',2,', '', 15, 0, 1, 1653042113, 'Developer', 0, 'Tech Team', 0),
(153, 'Kari_Dado', '$2y$10$tUGK8et7v5VdFACJ6lJy9.HGYnAZBi5vETJqv4eI9Yc7Sg7o1xbt.', '2210413', 20220621, 0, 'Karrilene', 'Palo', 'Dado', 'QA', 'Breath, Enjoy, Let Go. Because everything always happen for a reason.', 'karrilene.dado1@trans-cosmos.co.jp ', '09167948190', 'karrilenedado.jpg', ',1,', '', 15, 1656379465, 0, 0, 'QA', 0, 'Tech Team', 0),
(151, 'Junel_Aceres', '$2y$10$E4ukO0zUHBZR7H0X/QKdQeizDDxzZ8TjLLgKp0WyiHU/8xV7INgvS', '2180182', 20180502, 0, 'Junel ', 'De Guzman', 'Aceres', 'Web Development, UI/UX Design, Quality Assurance, Project Management', 'Do not stress yourself on things you cannot control. It is what it is.', 'junel.aceres1@trans-cosmos.co.jp ', '09185190243', 'junelaceres.jpeg', ',1,', '', 15, 1654564412, 0, 0, 'Senior Front-End Web Developer / Designer', 0, 'Tech Team', 0),
(150, 'Ian_Nicolas', '$2y$10$OjaOCTyT9dCpUbJBl7LC.uoAyFSlFAeSUIRfSXFIAYETwE3xYLb6i', '2160046', 20160518, 0, 'Ian', 'Gutierez', 'Nicolas', 'Leadership Skills, Management Skills', 'None', 'ian.nicolas1@trans-cosmos.co.jp', '09235147117', 'iannicolas.jpg', ',1,', '', 15, 1654556947, 0, 1646623048, 'Lead Developer', 0, 'Tech Team', 0),
(158, 'Antonio_Aduna', '$2y$10$DRDu5zgsjROfJK.juf5oG.QFDJnBZmBl1Aw4K.ajxnTS2ZxUX5Sq.', '2150088', 20151016, 0, 'Antonio Jr.', 'Quimpo', 'Aduna', 'Lead Developer', 'If you want to be strong, learn to fight alone.', 'antonio.aduna1@trans-cosmos.co.jp', '09477087573', 'antonioaduna.jpg', ',2,', '', 15, 1659061471, 0, 0, 'Lead Developer', 0, 'Team B', 0),
(159, 'Joseph_Mondia', '$2y$10$e6b.XXsO0dZvHAYxRDG1cucncx5ICcdKm1QRA4993nMF6YAOxE7/y', '2150096', 20151102, 0, 'Joseph John', 'Tubongbanua', 'Mondia', 'Lead Developer', 'He who knows best knows how little he knows.', 'joseph-john.mondia1@trans-cosmos.co.jp ', '09214717729', 'josephmondia.jpg', ',2,', '', 15, 1653905259, 0, 0, 'Lead Developer', 0, 'Team B', 0),
(160, 'Julie_Monton', '$2y$10$Fc0khQzXqiEREwFvRKchiu7ryXzwD248.os8ZFkjIS8zBYEY/NwNa', '2190019', 20190301, 0, 'Julie Ann', 'Lipio ', 'Monton', 'Senior Associate', 'If you can dream it, you can do it.', 'monton.julie-ann1@trans-cosmos.co.jp ', '09364265720', 'juliemonton.jpg', ',2,', '', 15, 0, 0, 0, 'Senior Associate', 0, 'Team B', 0),
(161, 'Phillip_Ventura', '$2y$10$.f3zscHkdRQXi7aGu2x3sOobyoe.nXJuWkR4/iudl30sxZ0.Cd48O', '2200031', 20200203, 0, 'Phillip Carlo', 'Portinto', 'Ventura', 'Lead Developer', 'Lead Developer', 'philipcarlo.ventura1@trans-cosmos.co.jp', '09568809841', 'phillipventura.jpg', ',2,', '', 15, 0, 0, 0, 'Lead Developer', 0, 'Team B', 0),
(162, 'Erwina_Catacutan', '$2y$10$CXeQQ9FpGfNxPFJA665VqOd3MHb6VEsu7XAeg5ZG5Jba.WDZs6rDu', '2210339', 20210823, 0, 'Erwina', 'Dela Cruz', 'Catacutan', 'Associate', 'Associate', 'erwina.catacutan1@trans-cosmos.co.jp ', '09974250106', 'erwinacatacutan.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team C', 0),
(163, 'Matthew_Del Rosario', '$2y$10$Jdvli4GS/prhUI2m5YVpMOOpvG3tW60DTQXi/uFXId1DJe0.yFmPG', '2190031', 20190410, 0, 'Matthew', 'Gile', 'Del Rosario', 'Associate', 'Associate', 'matthew.del-rosario2@trans-cosmos.co.jp', '09260326287', 'user-avatar.jpg', ',2,', '', 15, 0, 1, 1652769493, 'Associate', 0, 'Team C', 0),
(164, 'Revin_Galindez', '$2y$10$LOsevTsC5arfBVWjRr4xcu4Kijzlt7J7LdoQYcdc9vhp1V0qQFALS', '2170244', 20171009, 0, 'Revin', 'Santos', 'Galindez', 'Associate', 'If you\'re not a good shot today, don\'t worry. There are other ways to be useful.', 'revin.galindez1@trans-cosmos.co.jp', '09106976227', 'revingalindez.JPG', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team C', 0),
(165, 'Essel_Luna', '$2y$10$Y3mLMRRPnIF2F.rNadFL6OqKkrgOAYn02pfRueLZJTOJ0zamxMLSy', '2210475', 20210921, 0, 'Essel May', 'Santiago', 'Luna', 'Associate', 'Fearlessly be yourself.', 'essel.luna1@trans-cosmos.co.jp ', '09559228343', 'esselluna.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team C', 0),
(166, 'John_Serminio', '$2y$10$dTF5Bh4BhLLUFl84bhB.zuKsXNz9eU/2tCTQfQFx7fKyRb1cb5iBC', '2190037', 20190506, 0, 'John Michael', 'Hibe ', 'Serminio', 'Associate', 'Associate', 'John-michael.S2@trans-cosmos.co.jp', '09166580688', 'johnmichaelserminio.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team C', 0),
(167, 'Jessa_Abulencia', '$2y$10$53/89TNaOa8Wst2Ng5AvUuoc9J28zm3jocnh/FGxCMDZx7JISppqW', '2170041', 20170529, 0, 'Jessa Faye', 'Joves', 'Abulencia', 'Senior Associate', 'Senior Associate', 'jessa-faye.abulencia1@trans-cosmos.co.jp', '09481364523', 'jessaabulencia.jpg', ',2,', '', 15, 1659079164, 0, 0, 'Senior Associate', 0, 'Team D', 0),
(168, 'David_Dela Cruz', '$2y$10$q/noZbFwLI8h4.3zuRseo..RuTR2/lvJudKMhempjtL58BsEWXs3W', '2190051', 20190524, 0, 'David Isaac', 'Baclayon', 'Dela Cruz', 'Associate', 'Slow down, but don’t stop.', 'david-isaac.d1@trans-cosmos.co.jp ', '09352477850', 'daviddelacruz.png', ',2,', '', 15, 1653959173, 0, 0, 'Associate', 0, 'Team D', 0),
(169, 'Rachel_Robles', '$2y$10$lCPGDPF2OywiM.FiMwlV8uFjsdu8cmvZiVGhpF1mrclOx9FWIjHR.', '2190046', 20190524, 0, 'Rachel', 'Ardeza', 'Robles', 'Associate', 'Associate', 'rachel.robles1@trans-cosmos.co.jp', '09387877246', 'rachelrobles.JPG', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team D', 0),
(170, 'James_Salva', '$2y$10$pnb7IdgBNIzQl1QmAjWaWepNEi.ztGs4jR3VT.CYmKCgg9OByJjN6', '2190030', 20190410, 0, 'James Albert', 'San Juan', 'Salva', 'Senior Associate', 'Senior Associate', 'james-albert.salva1@trans-cosmos.co.jp ', '09121733189', 'jamessalva.jpg', ',2,', '', 15, 0, 0, 0, 'Senior Associate', 0, 'Team D', 0),
(171, 'Joseph_Carpio', '$2y$10$eEUmkYAzppLdOnvc0AjzzeOvgf5sQwDhjGoSZsQ1WzrCSal96qFhC', '2150029', 20150616, 0, 'Joseph Anthony', 'Flores', 'Carpio', 'Lead Developer', 'Lead Developer', 'joseph-anthony.c1@trans-cosmos.co.jp', '09267291629', 'josephcarpio.jpg', ',2,', '', 15, 0, 0, 0, 'Lead Developer', 0, 'Team E', 0),
(172, 'Exequiel_Delfin', '$2y$10$WmNXp7tNKGDduW/04dN0SOEP9uO0X1r3EPALM/p30nN08ijZIpJtq', '2190048', 20190524, 0, 'Exequiel', 'Luces', 'Delfin', 'Senior Associate', 'Don\'t go through life, grow through life.', 'exequiel.delfin1@trans-cosmos.co.jp', '09176396869', 'exequieldelfin.jpeg', ',2,', '', 15, 0, 0, 0, 'Senior Associate', 0, 'Team E', 0),
(173, 'Alexandra_Marasigan', '$2y$10$gEJHKkUUr1y8bQATNa6BCOg.leFB/aH.0YHn3xVJPUgkOk2q2OyZm', '2190047', 20190524, 0, 'Alexandra', 'Casiple', 'Marasigan', 'Associate', 'Associate', 'alexandra.marasigan1@trans-cosmos.co.jp ', '09556335512', 'alexandramarasigan.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team E', 0),
(174, 'Raven_Reyes', '$2y$10$j1eoN6MLDD645xJZVZ1b2.3idMdBWwfk4gXGe6fOy6QuJPEZINIKu', '2210499', 20210927, 0, 'Raven Auriesh', 'Corpuz', 'Reyes', 'Associate', 'No matter how hard or impossible it is. Never lose sight of your goal.', 'raven.reyes1@trans-cosmos.co.jp ', '09050395896', 'ravenreyes.jpeg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team E', 0),
(175, 'Lerin_Sevenorio', '$2y$10$p4w5qqGVpf2wiFiqqROoeOfJIxBvIIzWoO4oK7XsljBMnF1/BcUOa', '2190195', 20191127, 0, 'Lerin John', 'Mendoza', 'Sevenorio', 'Associate', 'Associate', 'lerin-john.sevenorio1@trans-cosmos.co.jp', '09456722816', 'user-avatar.jpg', ',2,', '', 15, 0, 1, 1652773469, 'Associate', 0, 'Team E', 0),
(176, 'Michael_Antipuesto', '$2y$10$ohtZKCNuwIeUMTj0ojg/4O8J2e/BJDijlpqhnS5XmlCr3mLsMyAg2', '2210412', 20210909, 0, 'Michael Angelo', 'De Vera', 'Antipuesto', 'Associate', 'Don\'t be afraid to give up the good to go for the great.', 'Michael-angelo.A1@trans-cosmos.co.jp ', '09959325871', 'michaelangeloantipuesto.png', ',2,', '', 15, 1653957397, 0, 0, 'Associate', 0, 'Team Goop!', 0),
(177, 'Julcess_Mercado', '$2y$10$qLcbL2LoKS5RmFM4Zs6FBu7ZhMKgQDeoRDQSEczFQjT9vxqAuPHeO', '2200057', 20200218, 0, 'Julcess Marie', 'Papica', 'Mercado', 'Senior Associate', 'Appear as you are, be as you appear.', 'julcess-marie.m1@trans-cosmos.co.jp ', '09754310357', 'julcessmercado.jpg', ',1,', '', 15, 1659081583, 0, 0, 'Senior Associate', 0, 'Team Goop!', 0),
(178, 'Christian_Alde', '$2y$10$PPMyRY3A.o4MfA457rZojuvFTIa8e5wefZrA/6aMxsk6ZIzoPeBk.', '2170052', 20170613, 0, 'Christian', 'Viray', 'Alde', 'Lead Developer', 'Lead Developer', 'christian.alde1@trans-cosmos.co.jp ', '09956684009', 'christianalde.jpg', ',1,', '', 15, 1660107070, 0, 0, 'Lead Developer', 0, 'Team Management', 0),
(207, 'Bart_Tabusao', '$2y$10$c6DWPn0YciHwKBXgphr4jO743a1LaxUerMO4ur/yVhyrlQ/yetKmi', '2220005', 20220510, 0, 'Bart', 'Quilala', 'Tabusao', 'Associate', 'Everything is a learning experience.', 'bart.tabusao1@trans-cosmos.co.jp', '01234567891', 'barttabusao.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Trainees', 0),
(180, 'Yves_Batungbacal', '$2y$10$XVsJaoiFu7qtDlD57pQsNOdhGcmdINUVLdUI8O9USII9RW64qf/hW', '2210040', 20210301, 0, 'Yves Patrick', 'Valiente', 'Batungbacal', 'Team Leader', 'Things, somehow, have a way of working themselves out. Just keep going.', 'yves-patrick.b1@trans-cosmos.co.jp ', '09271276183', 'yvesbatungbacal.jpg', ',1,', '', 15, 1654564436, 0, 0, 'Team Leader', 0, 'Team Management', 0),
(181, 'Ashley_Felix', '$2y$10$vN8mVu4MSZBGI2E0DeqAM.0.GmYR4AoBCPSOVQIIzK2R4AF7xwr1G', '2150107', 20151116, 0, 'Jennica Ashley', 'Ortiz', 'Felix', 'Lead Developer', 'Don\'t be afraid to believe in YOURSELF', 'jennica-ashley.felix1@trans-cosmos.co.jp ', '09568044477', 'ashleyfelix.jpg', ',1,', '', 15, 1654565912, 0, 0, 'Lead Developer', 0, 'Team Management', 0),
(182, 'Jeffrey_Agregado', '$2y$10$WK31IJ0wmvX0HnTzVuGkX.7Fuv3BTpa9rStzFWQ5i6UedwnaPU806', '2210493', 20211025, 0, 'Jeffrey Andrew', 'Erice', 'Agregado', 'Associate', 'Work smart not harder.', 'jeffrey-andrew.a1@trans-cosmos.co.jp ', '09774096572', 'jeffreyagregado.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team F', 0),
(183, 'Rocky_Astor', '$2y$10$tbQX5k9GIabDGknPEhZ1SevJy2xTlwJnEBaRnwe6/vaVRq2zzHx8y', '2190012', 20190222, 0, 'Rocky', 'Padilla', 'Astor', 'Associate', 'Associate', 'astor.rocky1@trans-cosmos.co.jp ', '09159082042', '933-9332131_profile-picture-default-png.png', ',2,', '', 15, 0, 1, 1652763406, 'Associate', 0, 'Team Sony', 0),
(184, 'John_Monteagudo', '$2y$10$6hOzJMV1EHZmD7z2U62iPe4aEhmDhAwKVGpA91lKlL.Kvos7AOb4y', '2200058', 0, 0, 'John Juvir', 'Cabuga', 'Monteagudo', 'Associate', 'Associate', 'john-juvir.m1@trans-cosmos.co.jp ', '09454789167', 'johnjuvirmonteagudo.jpg', '', '', 15, 1657514024, 0, 0, 'Associate', 0, 'Team F', 0),
(185, 'Crisler_Vallo', '$2y$10$u0FGZzuY5BGo1ii0o9FXJexqFZoFPX8zCnw9ddc0io7TAQVUJqjI6', '2190210', 20191216, 0, 'Crisler', 'Billones', 'Vallo', 'Associate', 'Know your limitations, and defy them.', 'crisler-billones.v1@trans-cosmos.co.jp ', '09456020881', 'crislervallo.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team F', 0),
(186, 'Yumeka_Iino', '$2y$10$YTCH33p1c9c8558CHIRJVOuBMYPQvFVZF1Zj9tqxI7aHo7O2O9pua', '2210694', 20211115, 0, 'Yumeka', 'Sioco', 'Iino', 'BD - Associate', 'All praise to the most high, bless up.', 'iino.yumeka1@trans-cosmos.co.jp ', '09606095191', 'yumekalino.jpg', ',2,', '', 15, 1653959222, 0, 0, 'BD - Associate', 0, 'Team BD', 0),
(187, 'Rizza_Isla', '$2y$10$6YcBTFb2kpbjtYhwmGTTzuITNat.K1uAIJLSF1UWpxvcHzX/s3Wkm', '2210630', 20211103, 0, 'Rizza', 'Navato', 'Isla', 'Associate', 'Associate', 'Riza-joy.Isla1@trans-cosmos.co.jp', '09050395 896', '933-9332131_profile-picture-default-png.png', ',2,', '', 15, 0, 1, 1652763474, 'Associate', 0, 'Team BD', 0),
(188, 'Leonard_Lumbad', '$2y$10$7SMyPr4VZs/Xa2sblZbrJub8EPXuDwY5qNfgc4cruDXZ9kxotUvmu', '2210749', 20211115, 0, 'Leonard', 'Arcenilla', 'Lumbad', 'BD - Associate', 'I act today to improve my life tomorrow.', 'leonald.lumbad1@trans-cosmos.co.jp', '09054572752', 'leonardlumbad.jpg', ',2,', '', 15, 0, 0, 0, 'BD - Associate', 0, 'Team BD', 0),
(189, 'Gregorio_Mora', '$2y$10$E34JWInkPzlDMdVJ9ecOi.n2c94sSu2ty9tGu1Erp/GIziwyREsW6', '2200015', 20200120, 0, 'Gregorio II', 'Ramos', 'Mora', 'Associate', 'Time is Gold.', 'gregorio-r.moraiii1@trans-cosmos.co.jp ', '09770138908', 'gregoriomora.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Team BD', 0),
(190, 'Ron_Rillera', '$2y$10$dhVv2T16RijVaVEl7Q028e.tiAZu8gktB8ugphhuVD2lyDp478KlG', '2190050', 20190524, 0, 'Ron Lester', 'Vanta', 'Rillera', 'BD - Associate', 'BD - Associate', 'ron-lester.rillera1@trans-cosmos.co.jp ', '09214775354', 'ronrillera.png', ',2,', '', 15, 0, 0, 0, 'BD - Associate', 0, 'Team BD', 0),
(191, 'Sheila_Siongco', '$2y$10$DUrU.R35z/9kkiopu5khmei1IzIV8kpGL91mIWHNTBaj2w/cyxDpG', '2210785', 20211227, 0, 'Sheila Victoria', 'Cruz', 'Siongco', 'BD - Associate', 'Life doesn\'t always go as planned, but I am more thankful that it didn\'t.', 'sheila-victoria.s1@trans-cosmos.co.jp', 'NA', 'sheilasiongco.jpg', ',2,', '', 15, 0, 0, 0, 'BD - Associate', 0, 'Team BD', 0),
(192, 'Mary_Bolima', '$2y$10$AKbORCqUeLY8WeJFwgz3zeKpW/BF/LK4uk9NZKYrscQ0sHZdKncP2', '2210773', 20211227, 0, 'Mary Joy', 'Acabado', 'Bolima', 'BD - Associate', 'Nothing in nature blooms all year. Be patient with yourself.', 'mary-joy.bolima1@trans-cosmos.co.jp', 'NA', 'marybolima.jpg', ',2,', '', 15, 0, 0, 0, 'BD - Associate', 0, 'Team BD', 0),
(193, 'Marivic_Nayve', '$2y$10$zCEreJ2Ch//M2e5YBmHSI.Bvo8d9XA9ju7PM0144.dJydfYYo74mS', '2210791', 20220110, 0, 'Marivic', 'Mengorio', 'Nayve', 'BD - Associate', 'BD - Associate', 'Marivic.Nayve1@trans-cosmos.co.jp', '09275727586', 'girl employee.jpg', ',2,', '', 15, 0, 1, 1652688514, 'BD - Associate', 0, 'Team BD', 0),
(194, 'D_Paril', '$2y$10$9HQqitl1FEzvi5mMXTeKtOd7PjW5Vm7N053J5C5hQTAvBJhIfKhri', '2210813', 20220202, 0, 'D-pper Ken Hope ', 'Ponting', 'Paril', 'BD - Associate', 'Everything happens for a reason. Be adaptable to change because its inevitable.', 'Ken.Hopep-paril1@trans-cosmos.co.jp', '09455708169', 'kenparil.jpg', ',2,', '', 15, 0, 0, 0, 'BD - Associate', 0, 'Team BD', 0),
(195, 'Manuel_Bersamina', '$2y$10$PvOBFVikMPsga2HXoJzMaOkqVneTmdP47r45S1p5ywCHY2wwDz/vK', '2210894', 20220324, 0, 'Manuel', 'Dario', 'Bersamina', 'FE-Associate', 'The happiness on your life depends on the quality of your thoughts.', 'manuel.bersamina1@trans-cosmos.co.jp', '9670230302', 'manuelbersamina.jpg', ',2,', '', 15, 0, 0, 1647880736, 'FE-Associate', 0, 'Trainees', 0),
(201, 'Catiis_Joseph', '$2y$10$xWFbYlVSEtxLYXHalOGjEOJ.seR8IWvM7yBkzl3SNZqpXq0P7AxHC', '2210903', 20220401, 0, 'Joseph', 'de Guzman', 'Catiis', 'BD - Associate', 'BD - Associate', 'joseph.catiis1@trans-cosmos.co.jp', '0956143134', 'josephcatiis.jpg', ',2,', '', 15, 0, 0, 0, 'BD - Associate', 0, 'Trainees', 0),
(199, 'Jeremy_Dadua', '$2y$10$jkS9naXgmpvJ2X08IfKlROjGhO6b78bdLKduPWsl./obSJnUWG7aO', '2217400', 20220103, 0, 'Jeremy', 'Amadeo', 'Dadua', 'Associate', 'Associate', 'jeremy-amadeo.dadua1@trans-cosmos.co.jp', '093880088', 'jeremydudua.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Trainees', 0),
(200, 'Joan_Francisco', '$2y$10$F7zfaLILF5adKw6Sp/vPFOr.1xZeVtmPi/0sE8RLS8tqIHEfsCbUq', '2210817', 20220216, 0, 'Joan', 'Borcelis', 'Francisco', 'Associate', 'Life can be heavy, especially if you try to carry it all at once. Decide what is yours to hold and let the rest go.', 'joan.francisco1@trans-cosmos.co.jp', '093068032', 'joanfrancisco.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Trainees', 0),
(202, 'Gumapo_Raffy', '$2y$10$46VqIddKsX/D0y1IROX6Ben6eTLwwuhhSjmd7oElTYFo1/jqAoPfq', '2210909', 20220401, 0, 'Raffy', 'Hisola', 'Gumapo', 'FE-Associate', ' It is better to be hated for what you are, than to be loved for what you are not.', 'raffy.gumapo1@trans-cosmos.co.jp', '0945501228', 'raffygumapo.jpg', ',2,', '', 15, 0, 0, 0, 'FE-Associate', 0, 'Trainees', 0),
(205, 'Dexter_Nierva', '$2y$10$jm.aJjm0j0EyOJFeiLxauexm4lLjLsCYP.we.dmAUnSbJlOVRZqY.', '2210914', 20220411, 0, 'Dexter', 'Beray', 'Nierva', 'FE - Associate', 'Pursue what is meaningful not what is expedient.', 'dexter.nierva1@trans-cosmos.co.jp', '09664175776', 'dexternierva.jpg', ',2,', '', 15, 0, 0, 0, 'FE - Associate', 0, 'Trainees', 0),
(206, 'Lorenzo_Cruz', '$2y$10$jq3f9WC.0M3yZPG27.W66.qq.D1v4ia9MYEPg/RAMc1EwXWrpck92', '2210937', 20220510, 0, 'Lorenzo Jr.', 'Irinco', 'Cruz', 'Associate', 'Associate', 'lorenzo-jr.cruz1@trans-cosmos.co.jp', '0927324312', 'lorenzocruz.jpg', ',2,', '', 15, 0, 0, 0, 'Associate', 0, 'Trainees', 0),
(204, 'Morris_Ampioco', '$2y$10$O8ilaSmTuepCZ7RERc1Zf.jk1LtZdRj/ghZhFbhHZj9YfBjrUxWM.', '2180223', 20181022, 0, 'Morris John Louise', 'Guillan', 'Ampioco', 'Division Manager', 'No longer I who live, but it is Christ who lives in me. (Galatians 2:20)', 'ampioco.morris1@trans-cosmos.co.jp', '0998 841 9002', 'morrisampioco.jpg', ',1,', '', 15, 1656311161, 0, 0, 'Division Manager', 0, 'Team Management', 0),
(208, 'Neil_Magnanao', '$2y$10$a3qToWnrjv0K9XFCGZJo8u3bapuvlDOvzU3KPjPjE6qx9KU8tt8YC', '2210936', 20220310, 0, 'June Neil', 'Siao', 'Magnanao', 'Senior Associate', 'I am conquering my fears and becoming stronger each day.', 'juneneil.magnanao1@trans-cosmos.co.jp', '09639009857', 'junemagnanao.jpg', ',2,', '', 15, 0, 0, 0, 'Senior Associate', 0, 'Trainees', 0);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
