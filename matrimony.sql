-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2020 at 07:24 PM
-- Server version: 10.5.8-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matrimony`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `a_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `locality` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `pin` int(6) NOT NULL,
  `landmark` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `caste_religion`
--

CREATE TABLE `caste_religion` (
  `caste_id` int(11) NOT NULL,
  `caste` int(11) NOT NULL,
  `religion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `contact_id` int(11) NOT NULL,
  `mobile_no` int(11) NOT NULL,
  `mail_id` int(11) NOT NULL,
  `landline` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `pId` int(11) NOT NULL,
  `fName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fCId` int(11) DEFAULT NULL,
  `mCId` int(11) DEFAULT NULL,
  `fOcc` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mOcc` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `join_date` date NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `caste_rel_id` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `physique` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `family_id` int(11) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `qualification` varchar(30) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `complexion` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sibling`
--

CREATE TABLE `sibling` (
  `s_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `caste_religion`
--
ALTER TABLE `caste_religion`
  ADD PRIMARY KEY (`caste_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`pId`),
  ADD KEY `fk_fcontact` (`fCId`),
  ADD KEY `fk_mcontact` (`mCId`) USING BTREE;

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_caste` (`caste_rel_id`),
  ADD KEY `fk_memcontact` (`contact_id`);

--
-- Indexes for table `sibling`
--
ALTER TABLE `sibling`
  ADD PRIMARY KEY (`s_id`),
  ADD UNIQUE KEY `f_id` (`f_id`),
  ADD KEY `fk_scontact` (`contact_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `fk_contact` FOREIGN KEY (`mCId`) REFERENCES `contact_details` (`contact_id`),
  ADD CONSTRAINT `fk_fcontact` FOREIGN KEY (`fCId`) REFERENCES `contact_details` (`contact_id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `caste_fk` FOREIGN KEY (`caste_rel_id`) REFERENCES `caste_religion` (`caste_id`),
  ADD CONSTRAINT `fk_caste` FOREIGN KEY (`caste_rel_id`) REFERENCES `caste_religion` (`caste_id`),
  ADD CONSTRAINT `fk_memcontact` FOREIGN KEY (`contact_id`) REFERENCES `contact_details` (`contact_id`);

--
-- Constraints for table `sibling`
--
ALTER TABLE `sibling`
  ADD CONSTRAINT `fk_scontact` FOREIGN KEY (`contact_id`) REFERENCES `contact_details` (`contact_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
