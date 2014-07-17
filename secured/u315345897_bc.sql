
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 15, 2014 at 11:57 AM
-- Server version: 5.1.66
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u315345897_bc`
--

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE IF NOT EXISTS `codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codes` varchar(30) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cot_code` varchar(100) NOT NULL,
  `imf_code` varchar(100) NOT NULL,
  `eu_transfer_cert` varchar(300) NOT NULL,
  `code_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `codes`, `time`, `cot_code`, `imf_code`, `eu_transfer_cert`, `code_type`) VALUES
(3, 'l*2a%cu(V845I&n0orSfxp6DGYJ_v$', '2013-09-27 12:40:10', '', '', '', 'COT Code'),
(4, '^Ec1rlXt2(_8wUi@mgFVe5x96jR!T#', '2013-09-27 12:40:34', '', '', '', 'IMF Code'),
(5, '^Ec1rlXt2(_8wU34mgFVe5x4rjR!T#', '2013-09-27 15:15:36', '', '', '', 'EU Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(512) NOT NULL,
  `user_level` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_code` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  `confirmed` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `suspended` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_type` varchar(100) NOT NULL,
  `account_no` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `accept` tinyint(1) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `str_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `jii` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `user_level`, `email`, `email_code`, `time`, `confirmed`, `ip`, `suspended`, `full_name`, `website`, `country`, `account_name`, `account_type`, `account_no`, `balance`, `accept`, `nickname`, `str_address`, `city`, `state`, `tel`, `email_address`, `image_url`, `jii`) VALUES
(1, 'manager', 'a54e4c3606c1b556bcb5dd430123f28ccc6b72de', 5, 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1377814216, 1, '::1', 1, 'Admin', 'admin.com', 'Admin', 'Admin', 'Admin', '0000000000000', '9999999999999', 1, 'Admin', '', '', '', '', '', '', ''),
(47, 'tester', 'ab4d8d2a5f480a137067da17100271cd176607a1', 1, 'email@amail.com', '', 1398791739, 1, '41.210.27.31', 1, 'James Tester', '', 'Ghana', 'James Tester', 'Fixed', '8899988765678', '77876', 0, '', '', '', '', '', '', '', ''),
(48, 'mb112', '81448fe273247b533b9f018e96c158cab7901247', 1, 'pinklady314@yahoo.com', '', 1398940026, 1, '41.210.27.31', 1, 'Michael Blair', '', 'USA', 'Michael Blair', 'Savings', '5369655555222', '3700000', 0, '', '', '', '', '', '', '', ''),
(49, 'jeanlinux', 'cd821ce7b453ba4c5676496d04adddd2299afac9', 1, 'jeanlinux@demo.com', '', 1400492144, 1, '41.66.229.84', 1, 'Giugni Roberto', '', 'modova', 'Giugni Roberto', 'Non Residential', '0008105009874', '4150000', 0, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transact`
--

CREATE TABLE IF NOT EXISTS `transact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `t_code` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `name` varchar(100) NOT NULL,
  `transfer_to` varchar(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `bank` varchar(140) NOT NULL,
  `account_no` varchar(40) NOT NULL,
  `routing_no` varchar(40) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `completed` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `transact`
--

INSERT INTO `transact` (`id`, `uid`, `t_code`, `username`, `name`, `transfer_to`, `amount`, `bank`, `account_no`, `routing_no`, `time`, `completed`) VALUES
(1, 48, 2147483647, 'mb112', 'Michael Blair', 'john Renner', 1000, 'Chase Bank', '5652454', '211522', '2014-05-01 10:28:09', 2),
(2, 49, 2147483647, 'Mrozone', 'Giugni Roberto', '', 4150000, '', '', '', '2014-05-20 09:26:26', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
