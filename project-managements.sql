-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 02, 2022 at 04:44 AM
-- Server version: 5.7.18
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-managements`
--

-- --------------------------------------------------------

--
-- Table structure for table `amount`
--

CREATE TABLE `amount` (
  `id` int(11) NOT NULL,
  `budget_id` int(50) NOT NULL,
  `amount_name` varchar(100) NOT NULL,
  `amount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amount`
--

INSERT INTO `amount` (`id`, `budget_id`, `amount_name`, `amount`) VALUES
(1, 2, 'Biaya membuat server dan database', 1000000),
(2, 2, 'membeli domain satu tahun', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` int(10) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'ACTIVE',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `name`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `deleted_by`) VALUES
(1, 'lukman', 'lukman1@gmail.com', '$2y$10$xEO99TdFOdFEy5RqxPmzduiq5mlBAEw0YnRUWuX072eUouZejAWTO', 1, 'ACTIVE', '2022-10-04 16:09:53', NULL, NULL, 'admin', NULL),
(2, 'aaaaa', 'aaa@gmail.com', '$2y$10$5IGUIzvjwKdwR7aziTwcQOv1fdv.zC7Kg.bltL2hdL09ef6a4Aftq', 2, 'ACTIVE', '2022-10-04 16:30:18', NULL, NULL, 'admin', NULL),
(3, 'jyocho', 'jyocho1@gmail.com', '$2y$10$t7B5lkGZ4Jphgj9q21mJve1C2l..i8kXcTG0mlzLJ43Ffm64dyGm6', 3, 'DELETED', '2022-10-05 23:42:00', '2022-10-06 08:32:23', '2022-10-06 08:32:23', 'admin', '0'),
(4, 'jaja', 'jaja@raharja.com', '$2y$10$900yFu9RFs8N77k6POYwZuDiaFxhtRCbNApFXUvuqK2E6lAmsBmDO', 5, 'ACTIVE', '2022-10-07 19:22:16', NULL, NULL, 'admin', NULL),
(5, 'boril', 'boril@gmail.com', '$2y$10$RJmyciykhS6kwpt1OcB6we/AoOV2GO5BXbfoDE3eIIlUXn5r2ijfK', 2, 'ACTIVE', '2022-10-07 19:23:34', NULL, NULL, 'admin', NULL),
(6, 'nobita', 'nobita@dora.com', '$2y$10$GpP4ulVCOsGmQ9gcGYi68Opa89Y/84PlPEXea/x9aIvJbhoyQz5d.', 3, 'ACTIVE', '2022-10-07 20:12:46', NULL, NULL, 'admin', NULL),
(7, 'nami', 'nami@gmail.com', '$2y$10$.iMJAc4ni3c.Ziu0GZJftuJPNpaWOeB6v.TJACmHclOSjRp5jeUIK', 4, 'ACTIVE', '2022-10-07 20:15:04', NULL, NULL, 'admin', NULL),
(8, 'Phoebe Haley', 'pfeffer.elyse@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(9, 'Lenna Kling', 'frances48@connelly.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(10, 'Dorothea Wilkinson', 'aschoen@hagenes.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(11, 'Shannon Lynch Jr.', 'albina99@goldner.com', '$2y$10$5C2ty3VaOVf8akwBtCFS/O1HHQB8.WI2hQXeVjNkw.7GWCUqS3852', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(12, 'Juwan Skiles', 'vwolff@prosacco.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(13, 'Andreane Kilback', 'daniella.kautzer@lindgren.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(14, 'Dr. Vladimir Corkery I', 'cruickshank.woodrow@gmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(15, 'Rhiannon Romaguera', 'camryn17@larkin.org', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(16, 'Ephraim Klocko', 'owisoky@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(17, 'Blanca Herzog', 'maida.mills@dare.com', '$2y$10$3p/HQqM0W4wfaa8gz4ClUuOBfx1zeJ/oEFUBX0fweZiA24IH7ZQAq', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(18, 'Cassandre Mitchell', 'jschuppe@lemke.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(19, 'Prof. Eulalia Marvin DDS', 'lorena.turcotte@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(20, 'Dr. Rahul Gorczany MD', 'durgan.cara@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(21, 'Imani Luettgen', 'mohamed.lakin@mcdermott.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(22, 'Dr. Filomena Wuckert', 'tierra.jacobs@gmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(23, 'Laura Durgan', 'annalise76@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(24, 'Ava Kunze', 'dgoyette@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(25, 'Jimmie Turcotte', 'kertzmann.stuart@gmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(26, 'Dr. Emery Eichmann', 'isaiah.beier@gmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(27, 'Amira Bartoletti', 'eichmann.seth@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(28, 'Dr. Santina Sanford', 'kcarroll@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(29, 'Ernestina Wisoky', 'ross.gislason@steuber.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(30, 'Amari Wolf III', 'yhilpert@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(31, 'Brock Schoen', 'kozey.jalen@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(32, 'Freeman Langworth DDS', 'major00@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(33, 'Wilma Kilback', 'becker.shyann@wolff.org', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(34, 'Jennings Mayer', 'dillan44@padberg.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(35, 'Iliana Barton IV', 'cstark@jenkins.biz', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(36, 'Reba O\'Kon', 'ian81@kling.org', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(37, 'Julian Volkman', 'ewillms@gmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(38, 'Dr. Helmer Goyette V', 'pohara@walter.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(39, 'Ashleigh Sanford', 'towne.mae@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(40, 'Simeon Rohan', 'zakary.howe@bogisich.net', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(41, 'Frederique Bogan', 'goyette.freida@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(42, 'Aurore Hegmann', 'camille04@schaden.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(43, 'Amelia Koelpin', 'garnet96@batz.biz', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(44, 'Miss Maia Wunsch Jr.', 'dkassulke@kemmer.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(45, 'Amalia Green', 'botsford.lottie@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(46, 'Leslie Labadie', 'ljohnson@schmidt.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(47, 'Muhammad Thompson', 'neal99@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(48, 'Prof. Jalyn Roob', 'xgleason@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(49, 'Kaia Cronin', 'corkery.lily@kutch.info', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(50, 'Eleanore Carter IV', 'sebastian98@wolf.info', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(51, 'Rod Kessler', 'alvina.lueilwitz@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(52, 'Desiree Farrell', 'twila78@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(53, 'Cordell Ebert', 'milo68@watsica.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(54, 'Mr. Stan Daniel PhD', 'lsmith@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(55, 'Edd Koch', 'joanie43@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(56, 'Melissa Effertz', 'krajcik.holly@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(57, 'Timmothy Kovacek', 'jpollich@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(58, 'Emilia Leuschke', 'velva.beier@weissnat.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(59, 'Wyatt Gorczany', 'wcronin@gmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(60, 'Prof. Israel Schneider IV', 'avonrueden@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(61, 'Mr. Heber Lockman Sr.', 'watsica.winona@spencer.org', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(62, 'Johnnie Carroll', 'genevieve.graham@gmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(63, 'Euna Stehr', 'carley.quigley@gmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(64, 'Araceli D\'Amore', 'qwhite@murray.org', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(65, 'Dr. Bertha Kutch', 'friesen.pierre@ebert.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(66, 'Lavern Dooley Jr.', 'jherzog@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(67, 'Dr. Perry Von II', 'fbechtelar@gmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(68, 'Lynn McCullough', 'daniel.ricky@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(69, 'Mrs. Erna Shields', 'sheathcote@senger.info', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(70, 'Shanie Nitzsche DDS', 'fleta97@hettinger.net', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(71, 'Sydney Runolfsson', 'robb.kuphal@koss.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(72, 'Luther Howe', 'rweimann@lind.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(73, 'Dr. Eve Hagenes DVM', 'billie.sauer@douglas.biz', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(74, 'Mr. Jennings Lesch PhD', 'elias90@gmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(75, 'Prof. Triston Pfeffer', 'hickle.keshaun@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(76, 'Eulalia Simonis', 'lprosacco@bernier.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(77, 'Lily Kunde', 'rlakin@berge.biz', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(78, 'Cristina Heaney', 'emmanuel97@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(79, 'Cooper Dare V', 'rose37@metz.org', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(80, 'Rowan Bernhard', 'celia.tremblay@zemlak.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(81, 'Jakayla Pacocha', 'evangeline39@adams.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(82, 'Conner D\'Amore', 'ymohr@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(83, 'Prof. Sheridan Morissette Jr.', 'ferry.maxime@gmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(84, 'Rey Kunde', 'fhansen@boyer.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(85, 'Adella Terry', 'roxane87@kris.biz', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(86, 'Prof. Wilhelm Larkin', 'vonrueden.antonia@kirlin.org', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(87, 'Braeden Franecki', 'kristy.wintheiser@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(88, 'Leif Turcotte', 'wilfrid48@bosco.biz', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(89, 'Trisha Kemmer', 'cecelia.kuhlman@greenholt.net', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(90, 'Ms. Eldridge Kreiger', 'darron.morissette@cummings.info', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(91, 'Miss Iva Braun III', 'krystel17@mclaughlin.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(92, 'Mr. Paris Upton Jr.', 'wking@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 5, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(93, 'Miss Anne Ziemann', 'ibrown@smitham.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(94, 'Brett Goodwin', 'vokuneva@schaefer.org', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(95, 'Alanis Lemke', 'vgottlieb@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(96, 'Dr. Bret Buckridge III', 'lina12@gmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 1, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(97, 'Melissa Wiegand', 'caroline.mertz@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(98, 'Prof. Ethelyn Quitzon DVM', 'yfahey@schinner.biz', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(99, 'Mr. Stewart Kemmer', 'romaguera.michelle@muller.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 3, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(100, 'Gladyce Maggio PhD', 'kunde.tina@hotmail.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 2, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL),
(101, 'Miss Haylee Wiza', 'hadley.sanford@yahoo.com', '$2y$10$3LYdxRuPmD4I6.3LKWOeN.J2FomAWlHZa6spvhh.w5ntVjXKyFfe2', 4, 'ACTIVE', '2022-10-08 21:29:08', NULL, NULL, 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(50) NOT NULL,
  `estimated_budget` int(20) NOT NULL,
  `total_amount` int(20) NOT NULL DEFAULT '0',
  `estimated_duration` int(20) NOT NULL,
  `project_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `estimated_budget`, `total_amount`, `estimated_duration`, `project_id`) VALUES
(2, 10000000, 2000000, 2, 7),
(3, 10000000, 1000000, 2, 8),
(4, 8000000, 0, 3, 9),
(5, 12000000, 0, 4, 10),
(6, 8000000, 0, 4, 11),
(7, 9000000, 0, 3, 12),
(8, 8000000, 0, 4, 13),
(9, 7000000, 0, 4, 14),
(10, 8000000, 0, 3, 15),
(11, 6000000, 0, 3, 16),
(12, 7000000, 0, 3, 17),
(13, 8000000, 0, 4, 18),
(14, 7000000, 0, 3, 19),
(15, 5000000, 0, 3, 20),
(16, 5000000, 0, 4, 21),
(17, 4000000, 0, 3, 22);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(50) NOT NULL,
  `project_id` int(50) NOT NULL,
  `name_file` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'ACTIVE',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `project_id`, `name_file`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `deleted_by`) VALUES
(14, 7, 'PROJECT 7 - logo.jpg', 'ACTIVE', '2022-10-23 02:38:30', NULL, NULL, 'boril', NULL),
(15, 7, 'PROJECT 7 - contract-2022-10-23.pdf', 'ACTIVE', '2022-10-23 02:56:01', NULL, NULL, 'boril', NULL),
(16, 11, 'PROJECT 11 - logo.jpg', 'ACTIVE', '2022-10-23 03:07:15', NULL, NULL, 'boril', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `log_text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `log_text`, `user_id`, `created_at`) VALUES
(1, 'PROJECT TASK SAVE |  project_id: 7 | task_name: membuat tampilan chat | task_description: membuat tampilan chat interaktif dengan orang lain | created_by: boril | Date Create: 2022-10-23 03:11:48', 5, '2022-10-23 03:11:48'),
(2, 'USER MANAGEMENT DELETE |  ID : 17 | Date Create: 2022-10-23 22:00:01', 5, '2022-10-23 22:00:01'),
(3, 'PROJECT UPDATE TEAM |  project_id: 7 | designer: 6 | developer: 7 | tester: 4 | Date Create: 2022-10-23 22:01:45', 5, '2022-10-23 22:01:45'),
(4, 'PROJECT UPDATE TEAM |  project_id: 9 | designer: 20 | developer: 12 | tester: 30 | Date Create: 2022-10-23 22:06:49', 5, '2022-10-23 22:06:49'),
(5, 'PROJECT UPDATE TEAM |  project_id: 9 | designer: 6 | developer: 7 | tester: 4 | Date Create: 2022-10-23 22:07:15', 5, '2022-10-23 22:07:15'),
(6, 'PROJECT UPDATE TEAM |  project_id: 9 | designer: 17 | developer: 18 | tester: 23 | Date Create: 2022-10-23 22:07:38', 5, '2022-10-23 22:07:38'),
(7, 'PROJECT TIMELINE SAVE |  project_id: 7 | timeline_header: membuat code chat | timeline_body: membuat code chat menggunakan react-chat-element | link: www.github.com/lorem/ipsum | attachment:  | task_id: 5 | position: 4 | Date Create: 2022-10-23 22:40:31', 7, '2022-10-23 22:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1663936712, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1663936712, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1663936712, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(50) NOT NULL,
  `auth_id` int(50) NOT NULL,
  `project_id` int(50) DEFAULT NULL,
  `task_id` int(50) DEFAULT NULL,
  `notification_body` varchar(150) DEFAULT NULL,
  `redirect` varchar(150) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'UNREAD',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `auth_id`, `project_id`, `task_id`, `notification_body`, `redirect`, `status`, `created_at`) VALUES
(1, 6, 7, NULL, NULL, 'project/project_detail/7', 'READ', '2022-10-08 20:10:04'),
(2, 7, 7, NULL, NULL, 'project/project_detail/7', 'READ', '2022-10-08 20:10:04'),
(3, 4, 7, NULL, NULL, 'project/project_detail/7', 'UNREAD', '2022-10-08 20:10:04'),
(4, 5, 7, NULL, NULL, 'project/project_detail/7', 'READ', '2022-10-08 20:10:04'),
(6, 70, 8, NULL, NULL, 'project/project_detail/8', 'UNREAD', '2022-10-08 22:46:51'),
(7, 89, 8, NULL, NULL, 'project/project_detail/8', 'UNREAD', '2022-10-08 22:46:51'),
(8, 5, 8, NULL, NULL, 'project/project_detail/8', 'READ', '2022-10-08 22:46:51'),
(9, 6, 7, 3, 'aaaaa Membuat Task Membuat Sidebar', 'project/project_detail/7', 'UNREAD', '2022-10-12 21:50:42'),
(10, 7, 7, 3, 'aaaaa Membuat Task Membuat Sidebar', 'project/project_detail/7', 'UNREAD', '2022-10-12 21:50:42'),
(11, 4, 7, 3, 'aaaaa Membuat Task Membuat Sidebar', 'project/project_detail/7', 'UNREAD', '2022-10-12 21:50:42'),
(12, 5, 7, 3, 'aaaaa Membuat Task Membuat Sidebar', 'project/project_detail/7', 'UNREAD', '2022-10-12 21:50:42'),
(13, 6, 7, 2, 'aaaaa Membuat Task membuat design login', 'project/project_task/2', 'UNREAD', '2022-10-13 23:12:53'),
(14, 7, 7, 2, 'aaaaa Membuat Task membuat design login', 'project/project_task/2', 'UNREAD', '2022-10-13 23:12:53'),
(15, 4, 7, 2, 'aaaaa Membuat Task membuat design login', 'project/project_task/2', 'UNREAD', '2022-10-13 23:12:53'),
(16, 5, 7, 2, 'aaaaa Membuat Task membuat design login', 'project/project_task/2', 'READ', '2022-10-13 23:12:53'),
(17, 6, 7, 2, 'jaja Membuat Task mengecek fitur login', 'project/project_task/2', 'UNREAD', '2022-10-14 15:42:06'),
(18, 7, 7, 2, 'jaja Membuat Task mengecek fitur login', 'project/project_task/2', 'UNREAD', '2022-10-14 15:42:06'),
(19, 4, 7, 2, 'jaja Membuat Task mengecek fitur login', 'project/project_task/2', 'UNREAD', '2022-10-14 15:42:06'),
(20, 5, 7, 2, 'jaja Membuat Task mengecek fitur login', 'project/project_task/2', 'READ', '2022-10-14 15:42:06'),
(21, 5, 9, NULL, 'boril Membuat Proyek PPDB SDN Setia Asih 03', 'project/project_detail/9', 'READ', '2022-10-18 19:35:23'),
(22, 6, 9, NULL, 'boril Membuat Proyek PPDB SDN Setia Asih 03', 'project/project_detail/9', 'UNREAD', '2022-10-18 19:35:23'),
(23, 7, 9, NULL, 'boril Membuat Proyek PPDB SDN Setia Asih 03', 'project/project_detail/9', 'UNREAD', '2022-10-18 19:35:23'),
(24, 4, 9, NULL, 'boril Membuat Proyek PPDB SDN Setia Asih 03', 'project/project_detail/9', 'UNREAD', '2022-10-18 19:35:23'),
(25, 5, 10, NULL, 'boril Membuat Proyek POS PT Sayur Segar', 'project/project_detail/10', 'READ', '2022-10-18 19:39:14'),
(26, 17, 10, NULL, 'boril Membuat Proyek POS PT Sayur Segar', 'project/project_detail/10', 'UNREAD', '2022-10-18 19:39:14'),
(27, 11, 10, NULL, 'boril Membuat Proyek POS PT Sayur Segar', 'project/project_detail/10', 'UNREAD', '2022-10-18 19:39:14'),
(28, 14, 10, NULL, 'boril Membuat Proyek POS PT Sayur Segar', 'project/project_detail/10', 'UNREAD', '2022-10-18 19:39:14'),
(29, 5, 11, NULL, 'boril Membuat Proyek API For PPDB SDN Setia Asih 03', 'project/project_detail/11', 'READ', '2022-10-18 19:41:33'),
(30, 20, 11, NULL, 'boril Membuat Proyek API For PPDB SDN Setia Asih 03', 'project/project_detail/11', 'UNREAD', '2022-10-18 19:41:33'),
(31, 12, 11, NULL, 'boril Membuat Proyek API For PPDB SDN Setia Asih 03', 'project/project_detail/11', 'UNREAD', '2022-10-18 19:41:33'),
(32, 23, 11, NULL, 'boril Membuat Proyek API For PPDB SDN Setia Asih 03', 'project/project_detail/11', 'UNREAD', '2022-10-18 19:41:33'),
(33, 5, 12, NULL, 'boril Membuat Proyek Web Pemesanan Desain Interior Dan Exterior Rumah CV  Graha Anggun Abadi', 'project/project_detail/12', 'READ', '2022-10-18 19:51:13'),
(34, 20, 12, NULL, 'boril Membuat Proyek Web Pemesanan Desain Interior Dan Exterior Rumah CV  Graha Anggun Abadi', 'project/project_detail/12', 'UNREAD', '2022-10-18 19:51:13'),
(35, 12, 12, NULL, 'boril Membuat Proyek Web Pemesanan Desain Interior Dan Exterior Rumah CV  Graha Anggun Abadi', 'project/project_detail/12', 'UNREAD', '2022-10-18 19:51:13'),
(36, 30, 12, NULL, 'boril Membuat Proyek Web Pemesanan Desain Interior Dan Exterior Rumah CV  Graha Anggun Abadi', 'project/project_detail/12', 'UNREAD', '2022-10-18 19:51:13'),
(37, 5, 13, NULL, 'boril Membuat Proyek Pengolahan Data Nilai Siswa SMPN 1 Tarumajaya', 'project/project_detail/13', 'READ', '2022-10-18 19:54:07'),
(38, 43, 13, NULL, 'boril Membuat Proyek Pengolahan Data Nilai Siswa SMPN 1 Tarumajaya', 'project/project_detail/13', 'UNREAD', '2022-10-18 19:54:07'),
(39, 24, 13, NULL, 'boril Membuat Proyek Pengolahan Data Nilai Siswa SMPN 1 Tarumajaya', 'project/project_detail/13', 'UNREAD', '2022-10-18 19:54:07'),
(40, 30, 13, NULL, 'boril Membuat Proyek Pengolahan Data Nilai Siswa SMPN 1 Tarumajaya', 'project/project_detail/13', 'UNREAD', '2022-10-18 19:54:07'),
(41, 5, 14, NULL, 'boril Membuat Proyek Mobile Apps Penjualan Obat Apotek Jati Farma Arjosari', 'project/project_detail/14', 'UNREAD', '2022-10-18 20:49:21'),
(42, 47, 14, NULL, 'boril Membuat Proyek Mobile Apps Penjualan Obat Apotek Jati Farma Arjosari', 'project/project_detail/14', 'UNREAD', '2022-10-18 20:49:21'),
(43, 26, 14, NULL, 'boril Membuat Proyek Mobile Apps Penjualan Obat Apotek Jati Farma Arjosari', 'project/project_detail/14', 'UNREAD', '2022-10-18 20:49:21'),
(44, 33, 14, NULL, 'boril Membuat Proyek Mobile Apps Penjualan Obat Apotek Jati Farma Arjosari', 'project/project_detail/14', 'UNREAD', '2022-10-18 20:49:21'),
(45, 5, 15, NULL, 'boril Membuat Proyek Web Pemetaan Pariwisata Geografis', 'project/project_detail/15', 'READ', '2022-10-18 20:58:05'),
(46, 57, 15, NULL, 'boril Membuat Proyek Web Pemetaan Pariwisata Geografis', 'project/project_detail/15', 'UNREAD', '2022-10-18 20:58:05'),
(47, 38, 15, NULL, 'boril Membuat Proyek Web Pemetaan Pariwisata Geografis', 'project/project_detail/15', 'UNREAD', '2022-10-18 20:58:05'),
(48, 63, 15, NULL, 'boril Membuat Proyek Web Pemetaan Pariwisata Geografis', 'project/project_detail/15', 'UNREAD', '2022-10-18 20:58:05'),
(49, 5, 16, NULL, 'boril Membuat Proyek Mobile Apps Sistem Bimbingan Tugas Akhir ', 'project/project_detail/16', 'UNREAD', '2022-10-18 20:59:57'),
(50, 61, 16, NULL, 'boril Membuat Proyek Mobile Apps Sistem Bimbingan Tugas Akhir ', 'project/project_detail/16', 'UNREAD', '2022-10-18 20:59:57'),
(51, 40, 16, NULL, 'boril Membuat Proyek Mobile Apps Sistem Bimbingan Tugas Akhir ', 'project/project_detail/16', 'UNREAD', '2022-10-18 20:59:57'),
(52, 56, 16, NULL, 'boril Membuat Proyek Mobile Apps Sistem Bimbingan Tugas Akhir ', 'project/project_detail/16', 'UNREAD', '2022-10-18 20:59:57'),
(53, 5, 17, NULL, 'boril Membuat Proyek Web Pendaftaran Calon Anggota Legislatif ', 'project/project_detail/17', 'UNREAD', '2022-10-18 21:01:47'),
(54, 17, 17, NULL, 'boril Membuat Proyek Web Pendaftaran Calon Anggota Legislatif ', 'project/project_detail/17', 'UNREAD', '2022-10-18 21:01:47'),
(55, 46, 17, NULL, 'boril Membuat Proyek Web Pendaftaran Calon Anggota Legislatif ', 'project/project_detail/17', 'UNREAD', '2022-10-18 21:01:47'),
(56, 48, 17, NULL, 'boril Membuat Proyek Web Pendaftaran Calon Anggota Legislatif ', 'project/project_detail/17', 'UNREAD', '2022-10-18 21:01:47'),
(57, 5, 18, NULL, 'boril Membuat Proyek Web Penjualan Batik', 'project/project_detail/18', 'UNREAD', '2022-10-18 21:03:36'),
(58, 6, 18, NULL, 'boril Membuat Proyek Web Penjualan Batik', 'project/project_detail/18', 'UNREAD', '2022-10-18 21:03:36'),
(59, 7, 18, NULL, 'boril Membuat Proyek Web Penjualan Batik', 'project/project_detail/18', 'UNREAD', '2022-10-18 21:03:36'),
(60, 4, 18, NULL, 'boril Membuat Proyek Web Penjualan Batik', 'project/project_detail/18', 'UNREAD', '2022-10-18 21:03:36'),
(61, 5, 19, NULL, 'boril Membuat Proyek Web Manajemen Bimbingan Skripsi', 'project/project_detail/19', 'READ', '2022-10-18 21:12:32'),
(62, 17, 19, NULL, 'boril Membuat Proyek Web Manajemen Bimbingan Skripsi', 'project/project_detail/19', 'UNREAD', '2022-10-18 21:12:32'),
(63, 11, 19, NULL, 'boril Membuat Proyek Web Manajemen Bimbingan Skripsi', 'project/project_detail/19', 'UNREAD', '2022-10-18 21:12:32'),
(64, 14, 19, NULL, 'boril Membuat Proyek Web Manajemen Bimbingan Skripsi', 'project/project_detail/19', 'UNREAD', '2022-10-18 21:12:32'),
(65, 5, 20, NULL, 'boril Membuat Proyek Sistem Administrasi Sekolah', 'project/project_detail/20', 'UNREAD', '2022-10-18 21:13:44'),
(66, 6, 20, NULL, 'boril Membuat Proyek Sistem Administrasi Sekolah', 'project/project_detail/20', 'UNREAD', '2022-10-18 21:13:44'),
(67, 7, 20, NULL, 'boril Membuat Proyek Sistem Administrasi Sekolah', 'project/project_detail/20', 'UNREAD', '2022-10-18 21:13:44'),
(68, 4, 20, NULL, 'boril Membuat Proyek Sistem Administrasi Sekolah', 'project/project_detail/20', 'UNREAD', '2022-10-18 21:13:44'),
(69, 5, 21, NULL, 'boril Membuat Proyek Web Bursa Kerja Khusus', 'project/project_detail/21', 'READ', '2022-10-18 21:15:49'),
(70, 20, 21, NULL, 'boril Membuat Proyek Web Bursa Kerja Khusus', 'project/project_detail/21', 'UNREAD', '2022-10-18 21:15:49'),
(71, 12, 21, NULL, 'boril Membuat Proyek Web Bursa Kerja Khusus', 'project/project_detail/21', 'UNREAD', '2022-10-18 21:15:49'),
(72, 30, 21, NULL, 'boril Membuat Proyek Web Bursa Kerja Khusus', 'project/project_detail/21', 'UNREAD', '2022-10-18 21:15:49'),
(73, 5, 22, NULL, 'boril Membuat Proyek Aplikasi Pelayanan Dan Pengelolaan Data Bengkel ', 'project/project_detail/22', 'UNREAD', '2022-10-18 22:45:15'),
(74, 17, 22, NULL, 'boril Membuat Proyek Aplikasi Pelayanan Dan Pengelolaan Data Bengkel ', 'project/project_detail/22', 'UNREAD', '2022-10-18 22:45:15'),
(75, 24, 22, NULL, 'boril Membuat Proyek Aplikasi Pelayanan Dan Pengelolaan Data Bengkel ', 'project/project_detail/22', 'UNREAD', '2022-10-18 22:45:15'),
(76, 29, 22, NULL, 'boril Membuat Proyek Aplikasi Pelayanan Dan Pengelolaan Data Bengkel ', 'project/project_detail/22', 'UNREAD', '2022-10-18 22:45:15'),
(77, 17, 7, 4, 'boril Membuat Task membuat tampilan chat', 'project/project_task/4', 'UNREAD', '2022-10-23 03:10:55'),
(78, 11, 7, 4, 'boril Membuat Task membuat tampilan chat', 'project/project_task/4', 'UNREAD', '2022-10-23 03:10:55'),
(79, 23, 7, 4, 'boril Membuat Task membuat tampilan chat', 'project/project_task/4', 'UNREAD', '2022-10-23 03:10:55'),
(80, 5, 7, 4, 'boril Membuat Task membuat tampilan chat', 'project/project_task/4', 'UNREAD', '2022-10-23 03:10:55'),
(81, 17, 7, 5, 'boril Membuat Task membuat tampilan chat', 'project/project_task/5', 'UNREAD', '2022-10-23 03:11:48'),
(82, 11, 7, 5, 'boril Membuat Task membuat tampilan chat', 'project/project_task/5', 'UNREAD', '2022-10-23 03:11:48'),
(83, 23, 7, 5, 'boril Membuat Task membuat tampilan chat', 'project/project_task/5', 'UNREAD', '2022-10-23 03:11:48'),
(84, 5, 7, 5, 'boril Membuat Task membuat tampilan chat', 'project/project_task/5', 'READ', '2022-10-23 03:11:48'),
(85, 6, 7, 5, 'nobita Membuat Task membuat sketsa tampilan chat', 'project/project_task/5', 'READ', '2022-10-23 22:19:39'),
(86, 7, 7, 5, 'nobita Membuat Task membuat sketsa tampilan chat', 'project/project_task/5', 'READ', '2022-10-23 22:19:39'),
(87, 4, 7, 5, 'nobita Membuat Task membuat sketsa tampilan chat', 'project/project_task/5', 'UNREAD', '2022-10-23 22:19:39'),
(88, 5, 7, 5, 'nobita Membuat Task membuat sketsa tampilan chat', 'project/project_task/5', 'UNREAD', '2022-10-23 22:19:39'),
(89, 6, 7, 5, 'nobita Membuat Task membuat sketsa tampilan chat', 'project/project_task/5', 'READ', '2022-10-23 22:21:53'),
(90, 7, 7, 5, 'nobita Membuat Task membuat sketsa tampilan chat', 'project/project_task/5', 'READ', '2022-10-23 22:21:53'),
(91, 4, 7, 5, 'nobita Membuat Task membuat sketsa tampilan chat', 'project/project_task/5', 'UNREAD', '2022-10-23 22:21:53'),
(92, 5, 7, 5, 'nobita Membuat Task membuat sketsa tampilan chat', 'project/project_task/5', 'UNREAD', '2022-10-23 22:21:53'),
(93, 6, 7, 5, 'nobita Membuat Task membuat sketsa tampilan chat', 'project/project_task/5', 'READ', '2022-10-23 22:23:27'),
(94, 7, 7, 5, 'nobita Membuat Task membuat sketsa tampilan chat', 'project/project_task/5', 'READ', '2022-10-23 22:23:27'),
(95, 4, 7, 5, 'nobita Membuat Task membuat sketsa tampilan chat', 'project/project_task/5', 'UNREAD', '2022-10-23 22:23:27'),
(96, 5, 7, 5, 'nobita Membuat Task membuat sketsa tampilan chat', 'project/project_task/5', 'UNREAD', '2022-10-23 22:23:27'),
(97, 6, 7, 5, 'nami Membuat Task membuat code chat', 'project/project_task/5', 'UNREAD', '2022-10-23 22:40:31'),
(98, 7, 7, 5, 'nami Membuat Task membuat code chat', 'project/project_task/5', 'READ', '2022-10-23 22:40:31'),
(99, 4, 7, 5, 'nami Membuat Task membuat code chat', 'project/project_task/5', 'UNREAD', '2022-10-23 22:40:31'),
(100, 5, 7, 5, 'nami Membuat Task membuat code chat', 'project/project_task/5', 'UNREAD', '2022-10-23 22:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(50) NOT NULL,
  `project_name` text NOT NULL,
  `project_description` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'ACTIVE',
  `project_client` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_name`, `project_description`, `status`, `project_client`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `deleted_by`) VALUES
(7, 'CRM PT Dimas Maju Sejahtera', 'membuat real time chat app menggunakan codeigniter', 'ACTIVE', 'PT Dimas Maju Sejahtera', '2022-10-08 20:10:04', '2022-10-19 07:15:27', NULL, NULL, NULL),
(8, 'CMS for PT Arman Maulana', 'cms untuk manajemen PT Arman Maulana', 'ACTIVE', 'PT Arman Maulana', '2022-10-08 22:46:51', NULL, NULL, NULL, NULL),
(9, 'PPDB SDN Setia Asih 03', 'Membuat website PPDB yang terintegrasi dengan guru, murid dan wali murid.', 'ACTIVE', 'SDN Setia Asih 03', '2022-10-18 19:35:23', NULL, NULL, NULL, NULL),
(10, 'POS PT Sayur Segar', 'Membuat aplikasi kasir untuk penggunaan tiap Outlet', 'ACTIVE', 'PT Sayur Segar', '2022-10-18 19:39:14', NULL, NULL, NULL, NULL),
(11, 'API For PPDB SDN Setia Asih 03', 'Membuat sebuah API dengan menggunakan Codeigniter4', 'ACTIVE', 'SDN Setia Asih 03', '2022-10-18 19:41:33', NULL, NULL, NULL, NULL),
(12, 'Web Pemesanan Desain Interior Dan Exterior Rumah C', 'Website untuk mengelola pemesanan desain interior exterior rumah', 'ACTIVE', 'CV  Graha Anggun Abadi', '2022-10-18 19:51:13', NULL, NULL, NULL, NULL),
(13, 'Pengolahan Data Nilai Siswa SMPN 1 Tarumajaya', 'mengelola data nilai ujian siswa SMPN 1 Tarumajaya', 'ACTIVE', 'SMPN 1 Tarumajaya', '2022-10-18 19:54:07', NULL, NULL, NULL, NULL),
(14, 'Mobile Apps Penjualan Obat Apotek Jati Farma Arjosari', 'Aplikasi Penjual obat menggunakan React Native', 'ACTIVE', 'Apotek Jati Farma Arjosar', '2022-10-18 20:49:21', NULL, NULL, NULL, NULL),
(15, 'Web Pemetaan Pariwisata Geografis', 'Website pengembangan geolocation untuk kabupaten gianyar', 'ACTIVE', 'Dinas Pariwisata Kabupate', '2022-10-18 20:58:05', NULL, NULL, NULL, NULL),
(16, 'Mobile Apps Sistem Bimbingan Tugas Akhir ', 'aplikasi android untuk menhubungkan mahasiswa dan dosen pembimbing', 'ACTIVE', 'Fakultas Teknologi Inform', '2022-10-18 20:59:57', NULL, NULL, NULL, NULL),
(17, 'Web Pendaftaran Calon Anggota Legislatif ', 'website untuk pendaftaran Calon Anggota Legislatif menggunakan Laravel', 'ACTIVE', 'KPU Kabupaten Kudus', '2022-10-18 21:01:47', NULL, NULL, NULL, NULL),
(18, 'Web Penjualan Batik', 'Point Of Sell batik menggunakan Flask', 'ACTIVE', 'Gerai Adhiwastra Jakarta', '2022-10-18 21:03:36', NULL, NULL, NULL, NULL),
(19, 'Web Manajemen Bimbingan Skripsi', 'Menajemen Bimbingan Skripsi', 'ACTIVE', 'STMIK Jayakarta', '2022-10-18 21:12:32', NULL, NULL, NULL, NULL),
(20, 'Sistem Administrasi Sekolah', 'Sistem Administrasi Sekolah Dengan SMS Gateway', 'ACTIVE', 'SMK LPI Semarang', '2022-10-18 21:13:44', NULL, NULL, NULL, NULL),
(21, 'Web Bursa Kerja Khusus', 'Web Bursa Kerja Khusus Dengan Php Dan Mysql ', 'ACTIVE', 'Smk Negeri  1 Tarumajaya', '2022-10-18 21:15:49', NULL, NULL, NULL, NULL),
(22, 'Aplikasi Pelayanan Dan Pengelolaan Data Bengkel ', 'Aplikasi Pelayanan Dan Pengelolaan Data Bengkel menggunakan flutter', 'ACTIVE', 'Bengkel Panca', '2022-10-18 22:45:15', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super User', 'ACTIVE', '2022-10-05 23:08:08', NULL),
(2, 'Project Leader', 'ACTIVE', '2022-10-05 23:08:08', NULL),
(3, 'Designer', 'ACTIVE', '2022-10-05 23:08:27', NULL),
(4, 'Developer', 'ACTIVE', '2022-10-05 23:08:27', NULL),
(5, 'Tester', 'ACTIVE', '2022-10-05 23:08:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(50) NOT NULL,
  `project_id` int(20) NOT NULL,
  `task_name` varchar(50) NOT NULL,
  `task_description` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'ACTIVE',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `project_id`, `task_name`, `task_description`, `status`, `created_at`, `updated_at`, `deleted_at`, `finished_at`, `created_by`, `deleted_by`) VALUES
(2, 7, 'Membuat Akses Login', 'Membuat akses login menggunakan PHP dengan validasi email dan password. enkripsi yang digunakan  sha1.', 'FINISHED', '2022-10-12 15:37:35', NULL, NULL, '2022-10-14 15:37:35', 'aaaaa', NULL),
(3, 7, 'Membuat Sidebar', 'Membuat dinamis sidebar sesuai dengan level fungsi', 'ACTIVE', '2022-10-12 21:50:42', NULL, NULL, NULL, 'aaaaa', NULL),
(5, 7, 'membuat tampilan chat', 'membuat tampilan chat interaktif dengan orang lain', 'ACTIVE', '2022-10-23 03:11:48', NULL, NULL, NULL, 'boril', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(50) NOT NULL,
  `project_id` int(50) NOT NULL,
  `auth_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `project_id`, `auth_id`) VALUES
(1, 7, 6),
(2, 7, 7),
(3, 7, 4),
(4, 7, 5),
(6, 8, 70),
(7, 8, 89),
(8, 8, 5),
(9, 9, 5),
(10, 9, 17),
(11, 9, 18),
(12, 9, 23),
(13, 10, 5),
(14, 10, 6),
(15, 10, 7),
(16, 10, 14),
(17, 11, 5),
(18, 11, 20),
(19, 11, 12),
(20, 11, 4),
(21, 12, 5),
(22, 12, 20),
(23, 12, 12),
(24, 12, 30),
(25, 13, 5),
(26, 13, 43),
(27, 13, 24),
(28, 13, 30),
(29, 14, 5),
(30, 14, 47),
(31, 14, 26),
(32, 14, 33),
(33, 15, 5),
(34, 15, 57),
(35, 15, 38),
(36, 15, 63),
(37, 16, 5),
(38, 16, 61),
(39, 16, 40),
(40, 16, 56),
(41, 17, 5),
(42, 17, 6),
(43, 17, 46),
(44, 17, 48),
(45, 18, 5),
(46, 18, 6),
(47, 18, 7),
(48, 18, 4),
(49, 19, 5),
(50, 19, 6),
(51, 19, 7),
(52, 19, 14),
(53, 20, 5),
(54, 20, 6),
(55, 20, 7),
(56, 20, 4),
(57, 21, 5),
(58, 21, 20),
(59, 21, 12),
(60, 21, 30),
(61, 22, 5),
(62, 22, 6),
(63, 22, 24),
(64, 22, 29);

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE `timeline` (
  `id` int(50) NOT NULL,
  `timeline_header` varchar(50) NOT NULL,
  `timeline_body` text NOT NULL,
  `attachment` varchar(150) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `position` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `task_id` int(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeline`
--

INSERT INTO `timeline` (`id`, `timeline_header`, `timeline_body`, `attachment`, `link`, `status`, `position`, `user_id`, `task_id`, `created_at`) VALUES
(1, 'membuat design login', 'aaaaaaaaaaa', NULL, 'www.figma.com/my-design/login', 'ACTIVE', 3, 0, 2, '2022-10-13 23:12:22'),
(2, 'membuat design login', 'aaaaaaaaaaa', NULL, 'www.figma.com/my-design/login', 'ACTIVE', 4, 0, 2, '2022-10-13 23:12:53'),
(3, 'mengecek fitur login', 'tidak ada kendala', NULL, NULL, 'ACTIVE', 5, 0, 2, '2022-10-14 15:42:06'),
(6, 'membuat sketsa tampilan chat', 'membuat tampilan sketsa menggunakan figma', 'TASK 5 - lazcart.png', 'www.figma.com/lorem/ipsum', 'ACTIVE', 3, 6, 5, '2022-10-23 22:23:27'),
(7, 'membuat code chat', 'membuat code chat menggunakan react-chat-element', NULL, 'www.github.com/lorem/ipsum', 'ACTIVE', 4, 7, 5, '2022-10-23 22:40:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amount`
--
ALTER TABLE `amount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification` (`auth_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team to project` (`project_id`),
  ADD KEY `team to auth` (`auth_id`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amount`
--
ALTER TABLE `amount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `Role` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification` FOREIGN KEY (`auth_id`) REFERENCES `auth` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `Project To Task` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team to auth` FOREIGN KEY (`auth_id`) REFERENCES `auth` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team to project` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
