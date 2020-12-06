-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2020 at 06:20 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

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
-- Table structure for table `caste_religion`
--

CREATE TABLE `caste_religion` (
  `caste_id` int(11) NOT NULL,
  `caste` int(11) NOT NULL,
  `religion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caste_religion`
--
ALTER TABLE `caste_religion`
  ADD PRIMARY KEY (`caste_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_caste` (`caste_rel_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `caste_fk` FOREIGN KEY (`caste_rel_id`) REFERENCES `caste_religion` (`caste_id`),
  ADD CONSTRAINT `fk_caste` FOREIGN KEY (`caste_rel_id`) REFERENCES `caste_religion` (`caste_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
