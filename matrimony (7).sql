-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2021 at 09:58 AM
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
CREATE DATABASE IF NOT EXISTS `matrimony` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `matrimony`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `a_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `pin` int(6) NOT NULL,
  `landmark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `caste_religion`
--

CREATE TABLE `caste_religion` (
  `caste_id` int(11) NOT NULL,
  `caste` varchar(30) NOT NULL,
  `religion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `caste_religion`
--

INSERT INTO `caste_religion` (`caste_id`, `caste`, `religion`) VALUES
(500, 'Aiyyer', 'Hindu'),
(501, 'Ambalavasi', 'Hindu'),
(502, 'Araya', 'Hindu'),
(503, 'Brahmin', 'Hindu'),
(504, 'Cheramar', 'Hindu'),
(505, 'Cheruman', 'Hindu'),
(506, 'Dheevara', 'Hindu'),
(507, 'Embranthiri', 'Hindu'),
(508, 'Ezhava', 'Hindu'),
(509, 'Ezhavathy', 'Hindu'),
(510, 'Ezhuthachan', 'Hindu'),
(511, 'Ganaka', 'Hindu'),
(512, 'Kalari Kurup', 'Hindu'),
(513, 'Kalari Panicker', 'Hindu'),
(514, 'Kalladi', 'Hindu'),
(515, 'Kanakkan', 'Hindu'),
(516, 'Kaniyan', 'Hindu'),
(517, 'Kavuthiyya', 'Hindu'),
(518, 'Kudumbi', 'Hindu'),
(519, 'Kusava', 'Hindu'),
(520, 'Mannan', 'Hindu'),
(521, 'Marar', 'Hindu'),
(522, 'Mukkuva', 'Hindu'),
(523, 'Nadar', 'Hindu'),
(524, 'Nair', 'Hindu'),
(525, 'Nambeesan', 'Hindu'),
(526, 'Namboodiri', 'Hindu'),
(527, 'Not Specified', 'Hindu'),
(528, 'Others', 'Hindu'),
(529, 'Panan', 'Hindu'),
(530, 'Paravan', 'Hindu'),
(531, 'Paraya', 'Hindu'),
(532, 'Pathiyan', 'Hindu'),
(533, 'Perumannan', 'Hindu'),
(534, 'Peruvannan', 'Hindu'),
(535, 'Pisharody', 'Hindu'),
(536, 'Potti', 'Hindu'),
(537, 'Pulaya', 'Hindu'),
(538, 'Pulluva', 'Hindu'),
(539, 'Saliya', 'Hindu'),
(540, 'Sambava', 'Hindu'),
(541, 'Siddanar', 'Hindu'),
(542, 'Thandan', 'Hindu'),
(543, 'Thevar', 'Hindu'),
(544, 'Thiyya', 'Hindu'),
(545, 'Unnithan', 'Hindu'),
(546, 'Valluvan', 'Hindu'),
(547, 'Vanika Vysya', 'Hindu'),
(548, 'Vaniyan', 'Hindu'),
(549, 'Vannan', 'Hindu'),
(550, 'Varma', 'Hindu'),
(551, 'Veera Shyva', 'Hindu'),
(552, 'Velan', 'Hindu'),
(553, 'Velar', 'Hindu'),
(554, 'Vellala Pillai', 'Hindu'),
(555, 'Vettuva', 'Hindu'),
(556, 'Vill Kurup', 'Hindu'),
(557, 'Vishwakarma', 'Hindu'),
(558, 'Vysya', 'Hindu'),
(559, 'Warrier', 'Hindu'),
(560, 'Yadhava', 'Hindu'),
(561, 'Yogigurukkal', 'Hindu'),
(562, 'abcde', 'Hindu'),
(563, 'Nambiar', 'Hindu');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `contact_id` int(11) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `mail_id` varchar(80) DEFAULT NULL,
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
  `fOcc` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mOcc` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
  `height` varchar(30) DEFAULT NULL,
  `physique` varchar(30) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `family_id` int(11) DEFAULT NULL,
  `occupation` varchar(130) DEFAULT NULL,
  `qualification` varchar(200) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `a_id` int(10) DEFAULT NULL,
  `complexion` varchar(30) DEFAULT NULL,
  `star` varchar(30) DEFAULT NULL,
  `horoscope` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`horoscope`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `member_details`
-- (See below for the actual view)
--
CREATE TABLE `member_details` (
`id` int(11)
,`join_date` date
,`name` varchar(100)
,`dob` date
,`height` varchar(30)
,`physique` varchar(30)
,`gender` varchar(10)
,`caste_rel_id` int(11)
,`occupation` varchar(130)
,`qualification` varchar(200)
,`photo` varchar(50)
,`complexion` varchar(30)
,`star` varchar(30)
,`horoscope` longtext
,`religion` varchar(50)
,`caste` varchar(30)
,`mobile_no` varchar(50)
,`mail_id` varchar(80)
,`landline` int(11)
,`address` varchar(100)
,`city` varchar(100)
,`district` varchar(100)
,`pin` int(6)
,`landmark` varchar(100)
,`father` varchar(50)
,`fOcc` varchar(200)
,`F_mobile` varchar(50)
,`F_mail` varchar(80)
,`F_landline` int(11)
,`mother` varchar(50)
,`mOcc` varchar(200)
,`M_mobile` varchar(50)
,`M_mail` varchar(80)
,`M_landline` int(11)
,`siblings` longtext
);

-- --------------------------------------------------------

--
-- Table structure for table `sibling`
--

CREATE TABLE `sibling` (
  `s_id` int(11) NOT NULL,
  `f_id` int(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `marital_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sl` int(4) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sl`, `username`, `password`, `roleId`) VALUES
(1, 'user', 'user', 1),
(3, 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Structure for view `member_details`
--
DROP TABLE IF EXISTS `member_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`vaichu`@`localhost` SQL SECURITY DEFINER VIEW `member_details`  AS SELECT `members`.`id` AS `id`, `members`.`join_date` AS `join_date`, `members`.`name` AS `name`, `members`.`dob` AS `dob`, `members`.`height` AS `height`, `members`.`physique` AS `physique`, `members`.`gender` AS `gender`, `members`.`caste_rel_id` AS `caste_rel_id`, `members`.`occupation` AS `occupation`, `members`.`qualification` AS `qualification`, `members`.`photo` AS `photo`, `members`.`complexion` AS `complexion`, `members`.`star` AS `star`, `members`.`horoscope` AS `horoscope`, `caste_religion`.`religion` AS `religion`, `caste_religion`.`caste` AS `caste`, `contact_details`.`mobile_no` AS `mobile_no`, `contact_details`.`mail_id` AS `mail_id`, `contact_details`.`landline` AS `landline`, `address`.`address` AS `address`, `address`.`city` AS `city`, `address`.`district` AS `district`, `address`.`pin` AS `pin`, `address`.`landmark` AS `landmark`, `family`.`fName` AS `father`, `family`.`fOcc` AS `fOcc`, `Fcon`.`F_mobile` AS `F_mobile`, `Fcon`.`F_mail` AS `F_mail`, `Fcon`.`F_landline` AS `F_landline`, `family`.`mName` AS `mother`, `family`.`mOcc` AS `mOcc`, `Mcon`.`M_mobile` AS `M_mobile`, `Mcon`.`M_mail` AS `M_mail`, `Mcon`.`M_landline` AS `M_landline`, `sibling_det`.`sibling_json` AS `siblings` FROM (((((((`members` left join `caste_religion` on(`caste_religion`.`caste_id` = `members`.`caste_rel_id`)) left join `contact_details` on(`members`.`contact_id` = `contact_details`.`contact_id`)) left join `address` on(`members`.`a_id` = `address`.`a_id`)) left join `family` on(`members`.`family_id` = `family`.`pId`)) left join (select `family`.`pId` AS `pId`,`contact_details`.`mobile_no` AS `F_mobile`,`contact_details`.`mail_id` AS `F_mail`,`contact_details`.`landline` AS `F_landline` from (`family` left join `contact_details` on(`family`.`fCId` = `contact_details`.`contact_id`))) `Fcon` on(`Fcon`.`pId` = `members`.`family_id`)) left join (select `family`.`pId` AS `pId`,`contact_details`.`mobile_no` AS `M_mobile`,`contact_details`.`mail_id` AS `M_mail`,`contact_details`.`landline` AS `M_landline` from (`family` left join `contact_details` on(`family`.`mCId` = `contact_details`.`contact_id`))) `Mcon` on(`Mcon`.`pId` = `members`.`family_id`)) left join (select `sibling_det_tmp`.`f_id` AS `f_id`,concat('[',`sibling_det_tmp`.`sib_json`,']') AS `sibling_json` from (select `sibling`.`f_id` AS `f_id`,group_concat(json_object('age',`sibling`.`age`,'gender',`sibling`.`sex`,'marital_status',`sibling`.`marital_status`) separator ',') AS `sib_json` from `sibling` group by `sibling`.`f_id`) `sibling_det_tmp`) `sibling_det` on(`sibling_det`.`f_id` = `members`.`family_id`)) ;

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
  ADD KEY `fk_famId` (`f_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sl`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `caste_religion`
--
ALTER TABLE `caste_religion`
  MODIFY `caste_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=564;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `pId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sibling`
--
ALTER TABLE `sibling`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sl` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `fk_famId` FOREIGN KEY (`f_id`) REFERENCES `family` (`pId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
