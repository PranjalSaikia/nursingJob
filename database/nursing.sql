-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2018 at 05:54 AM
-- Server version: 5.7.21
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nursing`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_change_req`
--

DROP TABLE IF EXISTS `email_change_req`;
CREATE TABLE IF NOT EXISTS `email_change_req` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_id` int(11) NOT NULL,
  `email` varchar(300) NOT NULL,
  `status` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_det`
--

DROP TABLE IF EXISTS `hospital_det`;
CREATE TABLE IF NOT EXISTS `hospital_det` (
  `h_id` int(11) NOT NULL,
  `h_des_short` text NOT NULL,
  `h_des_long` text NOT NULL,
  `region` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `district` varchar(300) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `dp` text NOT NULL,
  `letter_inc` text NOT NULL,
  `bank_det` text NOT NULL,
  `company_profile` text NOT NULL,
  `company_profile_status` int(11) NOT NULL,
  `videos_h` text NOT NULL,
  `videos_h_status` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_master`
--

DROP TABLE IF EXISTS `hospital_master`;
CREATE TABLE IF NOT EXISTS `hospital_master` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `h_name` text NOT NULL,
  `h_address` varchar(15) NOT NULL,
  `h_phn` varchar(100) NOT NULL,
  `h_email` varchar(200) NOT NULL,
  `h_username` text NOT NULL,
  `h_password` text NOT NULL,
  `access_token` text NOT NULL,
  `active_flag` int(11) NOT NULL,
  `is_verified` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interested`
--

DROP TABLE IF EXISTS `interested`;
CREATE TABLE IF NOT EXISTS `interested` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_id` int(11) NOT NULL,
  `n_id` int(11) NOT NULL,
  `seen` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interested_nurse`
--

DROP TABLE IF EXISTS `interested_nurse`;
CREATE TABLE IF NOT EXISTS `interested_nurse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  `seen` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_apply`
--

DROP TABLE IF EXISTS `job_apply`;
CREATE TABLE IF NOT EXISTS `job_apply` (
  `apply_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `n_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`apply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_exp_profile`
--

DROP TABLE IF EXISTS `job_exp_profile`;
CREATE TABLE IF NOT EXISTS `job_exp_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_id` int(11) NOT NULL,
  `job_title` text NOT NULL,
  `job_org` varchar(300) NOT NULL,
  `period` varchar(100) NOT NULL,
  `current` int(11) NOT NULL,
  `job_exp` varchar(100) NOT NULL,
  `job_det` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_h`
--

DROP TABLE IF EXISTS `job_post_h`;
CREATE TABLE IF NOT EXISTS `job_post_h` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `h_id` int(11) NOT NULL,
  `job_title` varchar(200) NOT NULL,
  `job_cat` int(11) NOT NULL,
  `job_des` text NOT NULL,
  `job_no` varchar(20) NOT NULL,
  `min_exp` varchar(20) NOT NULL,
  `min_sal` varchar(300) NOT NULL,
  `job_location` text NOT NULL,
  `send_post` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `direction` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

DROP TABLE IF EXISTS `nurse`;
CREATE TABLE IF NOT EXISTS `nurse` (
  `nurse_id` int(20) NOT NULL AUTO_INCREMENT,
  `nurse_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `address` text NOT NULL,
  `phno` varchar(15) NOT NULL,
  `license_no` varchar(50) NOT NULL,
  `exp_1` varchar(50) NOT NULL,
  `exp_2` varchar(10) NOT NULL,
  `image_resume` varchar(300) NOT NULL,
  `image_license` varchar(300) NOT NULL,
  PRIMARY KEY (`nurse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nurse_category`
--

DROP TABLE IF EXISTS `nurse_category`;
CREATE TABLE IF NOT EXISTS `nurse_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(200) NOT NULL,
  `cat_des` text NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nurse_category`
--

INSERT INTO `nurse_category` (`cat_id`, `cat_name`, `cat_des`) VALUES
(1, 'ANM', 'ANM'),
(2, 'GNM', 'GNM'),
(3, 'B.Sc. Nursing (Post Basic)', 'B.Sc. Nursing (Post Basic)'),
(4, 'B.Sc. Nursing', 'B.Sc. Nursing'),
(5, 'M.Sc. Nursing', 'M.Sc. Nursing'),
(6, 'PhD', 'PhD');

-- --------------------------------------------------------

--
-- Table structure for table `nurse_det`
--

DROP TABLE IF EXISTS `nurse_det`;
CREATE TABLE IF NOT EXISTS `nurse_det` (
  `n_id` int(11) NOT NULL,
  `n_des` text,
  `district` varchar(100) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `exp` varchar(20) DEFAULT NULL,
  `resume` text,
  `resume_status` int(11) NOT NULL DEFAULT '0',
  `slicense` text,
  `slicense_status` int(11) NOT NULL DEFAULT '0',
  `dp` text,
  `slink` text,
  `svideo` varchar(300) DEFAULT NULL,
  `svideo_status` int(11) NOT NULL DEFAULT '0',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nurse_master`
--

DROP TABLE IF EXISTS `nurse_master`;
CREATE TABLE IF NOT EXISTS `nurse_master` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `n_name` varchar(200) NOT NULL,
  `n_email` varchar(200) NOT NULL,
  `n_phn` varchar(15) NOT NULL,
  `n_username` text NOT NULL,
  `n_password` text NOT NULL,
  `access_token` text NOT NULL,
  `active_flag` int(11) NOT NULL,
  `is_verified` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nurse_master`
--

INSERT INTO `nurse_master` (`n_id`, `n_name`, `n_email`, `n_phn`, `n_username`, `n_password`, `access_token`, `active_flag`, `is_verified`, `time_stamp`) VALUES
(1, 'Pranjal', 'pop@gmail.com', '8876371354', 'pop@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '848096779d2594ec3318caedae69f969df56d02b', 0, 1, '2018-11-03 10:30:50');

-- --------------------------------------------------------

--
-- Table structure for table `quick_job`
--

DROP TABLE IF EXISTS `quick_job`;
CREATE TABLE IF NOT EXISTS `quick_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(200) NOT NULL,
  `category` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phno` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `session_log_hospital`
--

DROP TABLE IF EXISTS `session_log_hospital`;
CREATE TABLE IF NOT EXISTS `session_log_hospital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_token` text NOT NULL,
  `in_time` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL,
  `ip` varchar(300) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_log_hospital`
--

INSERT INTO `session_log_hospital` (`id`, `access_token`, `in_time`, `is_active`, `ip`, `time_stamp`) VALUES
(1, '41386294f2d74945cbdee4c73b0d73ef338b5a0f', '1524041309', 0, '127.0.0.1', '2018-04-18 08:53:41'),
(3, 'df60785a2df71aeb04248cf3c75f31c1e23f497b', '1529745143', 0, '127.0.0.1', '2018-06-23 10:57:00'),
(4, 'b14b1e96b42b2a0531314bfc5ee547b824e1127c', '1529483066', 0, '127.0.0.1', '2018-06-20 08:24:32'),
(5, '2f4d2c14466f8a43fc502c986235b152af5b0780', '1527696858', 0, '127.0.0.1', '2018-05-30 16:14:29'),
(6, '5c39e0f827877d8dd196bc72742a36f0518c452f', '1528527426', 0, '127.0.0.1', '2018-06-09 06:57:12'),
(7, '3a6aeb3f7eb378c502e16da985733be3bfdcaf41', '1529317785', 0, '127.0.0.1', '2018-06-18 10:31:19'),
(8, '7f1c9b254e4d511269c06ee4ff621a9bac5270c3', '1536048879', 1, '::1', '2018-09-04 08:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `session_log_nurse`
--

DROP TABLE IF EXISTS `session_log_nurse`;
CREATE TABLE IF NOT EXISTS `session_log_nurse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_token` text NOT NULL,
  `in_time` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL,
  `ip` varchar(300) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_log_nurse`
--

INSERT INTO `session_log_nurse` (`id`, `access_token`, `in_time`, `is_active`, `ip`, `time_stamp`) VALUES
(1, '973ffee093e46e36fe7376af97757b9a98d1f5b8', '1524823210', 0, '127.0.0.1', '2018-04-27 10:04:57'),
(2, 'a5acc2f6b4157ee2dcb727a1f055a871d27593e7', '1530350244', 0, '127.0.0.1', '2018-06-30 09:17:29'),
(3, '6bef7439839fdd5c012e184b9b83eb97f94946f3', '1525337190', 0, '127.0.0.1', '2018-05-03 08:48:00'),
(4, '3b4ca853925e3d18ed046c31acbb047dc2b5d759', '1528291466', 0, '127.0.0.1', '2018-06-06 13:56:38'),
(5, '17d98da932c007ac0ce7a69957e2befcee8dbcc8', '1536475773', 0, '::1', '2018-09-09 06:49:37'),
(6, '8c19a365edd896b1c828d2dbd534c66944cf2ddd', '1532500611', 1, '127.0.0.1', '2018-07-25 06:36:51'),
(7, '848096779d2594ec3318caedae69f969df56d02b', '1542174600', 1, '::1', '2018-11-14 05:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `skype_req`
--

DROP TABLE IF EXISTS `skype_req`;
CREATE TABLE IF NOT EXISTS `skype_req` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  `direction` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usermst`
--

DROP TABLE IF EXISTS `usermst`;
CREATE TABLE IF NOT EXISTS `usermst` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `category` int(11) NOT NULL,
  `active_flag` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usermst`
--

INSERT INTO `usermst` (`user_id`, `name`, `username`, `password`, `category`, `active_flag`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `verify_otp`
--

DROP TABLE IF EXISTS `verify_otp`;
CREATE TABLE IF NOT EXISTS `verify_otp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `otp` varchar(10) NOT NULL,
  `phn` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verify_otp`
--

INSERT INTO `verify_otp` (`id`, `otp`, `phn`) VALUES
(1, '443045', '8876371354');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
