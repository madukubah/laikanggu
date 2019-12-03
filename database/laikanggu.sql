-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2019 at 12:56 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laikanggu`
--

-- --------------------------------------------------------

--
-- Table structure for table `aid`
--

CREATE TABLE `aid` (
  `id` int(10) UNSIGNED NOT NULL,
  `civilization_id` int(10) UNSIGNED NOT NULL,
  `type_of_aid` varchar(200) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(10) UNSIGNED NOT NULL,
  `civilization_id` int(10) UNSIGNED NOT NULL,
  `type_of_aid` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `civilization`
--

CREATE TABLE `civilization` (
  `id` int(10) UNSIGNED NOT NULL,
  `village_id` int(10) UNSIGNED NOT NULL,
  `no_kk` varchar(100) NOT NULL,
  `chief_name` varchar(200) NOT NULL,
  `member_count` int(11) NOT NULL,
  `file_scan` text NOT NULL,
  `income` double NOT NULL,
  `age` int(5) NOT NULL,
  `job` varchar(200) NOT NULL,
  `study` varchar(200) NOT NULL,
  `civilization_card_scan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `civilization`
--

INSERT INTO `civilization` (`id`, `village_id`, `no_kk`, `chief_name`, `member_count`, `file_scan`, `income`, `age`, `job`, `study`, `civilization_card_scan`) VALUES
(23, 4, '1432', 'alan', 4, 'Civilization_1432_1575337250.jpg', 1500000, 30, 'Petani', 'sma', 'Civilization_KTP_1432_1575337250.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'uadmin', 'user admin'),
(3, 'village_officer', 'Aparatur Desa');

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `id` int(10) UNSIGNED NOT NULL,
  `civilization_id` int(10) UNSIGNED NOT NULL,
  `category` int(11) NOT NULL,
  `certificate_status` int(11) NOT NULL,
  `rt` varchar(20) NOT NULL,
  `dusun` varchar(100) NOT NULL,
  `images` text NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `file_scan` text NOT NULL,
  `floor_material` int(3) NOT NULL,
  `wall_material` int(3) NOT NULL,
  `roof_material` int(3) NOT NULL,
  `light_source` int(3) NOT NULL,
  `water_source` int(3) NOT NULL,
  `land_status` int(3) NOT NULL,
  `length` float DEFAULT NULL,
  `width` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`id`, `civilization_id`, `category`, `certificate_status`, `rt`, `dusun`, `images`, `latitude`, `longitude`, `file_scan`, `floor_material`, `wall_material`, `roof_material`, `light_source`, `water_source`, `land_status`, `length`, `width`) VALUES
(5, 23, 0, 1, '2', '3', 'front_1575337434.JPG;back_1575337434.JPG;left_1575337434.JPG;right_1575337434.JPG', '-3.5014330835094682', '122.10348308181318', 'file_scan_1575337434.jpg', 0, 0, 0, 0, 1, 1, 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(50) NOT NULL,
  `list_id` varchar(200) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `position` int(4) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `name`, `link`, `list_id`, `icon`, `status`, `position`, `description`) VALUES
(101, 1, 'Beranda', 'admin/', 'home_index', 'home', 1, 1, '-'),
(102, 1, 'Group', 'admin/group', 'group_index', 'home', 1, 2, '-'),
(103, 1, 'Setting', 'admin/menus', '-', 'cogs', 1, 3, '-'),
(104, 1, 'User', 'admin/user_management', 'user_management_index', 'users', 1, 4, '-'),
(106, 103, 'Menu', 'admin/menus', 'menus_index', 'circle', 1, 1, '-'),
(107, 2, 'Beranda', 'uadmin/home', 'home_index', 'home', 1, 1, '-'),
(108, 2, 'Pengguna', 'uadmin/users', 'users_index', 'home', 1, 2, '-'),
(109, 2, 'Desa', 'uadmin/village', 'village_index', 'home', 1, 1, '-'),
(110, 2, 'Olah Kartu Keluarga', 'uadmin/civilization', 'civilization_index', 'home', 1, 1, '-'),
(111, 2, 'Olah Perumahan', 'uadmin/housing', 'housing_index', 'home', 1, 1, '-'),
(112, 2, 'Penerima Bantuan', 'uadmin/aid', '_aid_index', 'home', 1, 1, '-'),
(113, 3, 'Beranda', 'officer/home', 'home_index', 'home', 1, 1, '-'),
(114, 3, 'Tentang Desa', 'officer/village', 'village_index', 'home', 1, 1, '-'),
(115, 3, 'Olah Kartu Keluarga', 'officer/civilization', 'civilization_index', 'home', 1, 1, '-'),
(116, 3, 'Olah Perumahan', 'officer/housing', 'housing_index', 'home', 1, 1, '-'),
(117, 112, 'Cari Calon Penerima Bantuan', 'uadmin/candidate', 'candidate_index', 'home', 1, 1, '-'),
(119, 112, 'Data Bantuan', 'uadmin/aid', 'aid_index', 'home', 1, 3, '-'),
(120, 112, 'Kandidat Penerima Bantuan', 'uadmin/candidate/candidates', 'candidate_candidates', 'home', 1, 2, '-');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` text NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `image`, `address`) VALUES
(1, '127.0.0.1', 'admin@fixl.com', '$2y$12$XpBgMvQ5JzfvN3PTgf/tA.XwxbCOs3mO0a10oP9/11qi1NUpv46.u', 'admin@fixl.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1575371656, 1, 'Admin', 'istrator', '081342989185', 'USER_1_1569750691.PNG', 'admin'),
(13, '::1', 'dinas@gmail.com', '$2y$10$xbDFfxFWEv2vFuxytqXIOuBX3bIFzRXZRbvrc9DCiaNJsl34gTvOi', 'dinas@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1568678256, 1575361363, 1, 'admin', 'Dinas', '00', 'USER_13_1568678463.jpg', 'jln mutiara no 8'),
(20, '::1', 'Desa_A@gmail.com', '$2y$10$Vn63erqUb38mp/.960/mcOJ290jnP96GDv.obZ6.nQiNh.xP9Mso6', 'Desa_A@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1570807835, 1575369406, 1, 'admin', 'Desa A', '0', 'default.jpg', 'Alamat');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(29, 13, 2),
(32, 20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `village`
--

CREATE TABLE `village` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `polygon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `village`
--

INSERT INTO `village` (`id`, `user_id`, `name`, `description`, `polygon`) VALUES
(4, 20, 'Desa A', 'ringkasan', 'polygon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aid`
--
ALTER TABLE `aid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `civilization_id` (`civilization_id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `civilization_id` (`civilization_id`);

--
-- Indexes for table `civilization`
--
ALTER TABLE `civilization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `village_id` (`village_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`id`),
  ADD KEY `civilization_id` (`civilization_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aid`
--
ALTER TABLE `aid`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `civilization`
--
ALTER TABLE `civilization`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `village`
--
ALTER TABLE `village`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aid`
--
ALTER TABLE `aid`
  ADD CONSTRAINT `aid_ibfk_1` FOREIGN KEY (`civilization_id`) REFERENCES `civilization` (`id`);

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`civilization_id`) REFERENCES `civilization` (`id`);

--
-- Constraints for table `civilization`
--
ALTER TABLE `civilization`
  ADD CONSTRAINT `civilization_ibfk_1` FOREIGN KEY (`village_id`) REFERENCES `village` (`id`);

--
-- Constraints for table `house`
--
ALTER TABLE `house`
  ADD CONSTRAINT `house_ibfk_1` FOREIGN KEY (`civilization_id`) REFERENCES `civilization` (`id`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `village`
--
ALTER TABLE `village`
  ADD CONSTRAINT `village_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
