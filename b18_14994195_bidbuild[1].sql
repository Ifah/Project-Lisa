-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql204.byethost18.com
-- Generation Time: Nov 11, 2014 at 10:59 AM
-- Server version: 5.6.21-70.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b18_14994195_bidbuild`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `trade_id` int(11) NOT NULL,
  `giver` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `message` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `date_left` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items_available`
--

CREATE TABLE IF NOT EXISTS `items_available` (
  `item_number` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `date_listed` datetime NOT NULL,
  `date_ending` datetime NOT NULL,
  `title` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `image_path1` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image_path2` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image_path3` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image_path4` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image_path5` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `item_location` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `items_wanted` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`item_number`),
  FULLTEXT KEY `title` (`title`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items_traded`
--

CREATE TABLE IF NOT EXISTS `items_traded` (
  `item_number` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `date_listed` datetime NOT NULL,
  `date_ending` datetime NOT NULL,
  `title` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `image_path1` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image_path2` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image_path3` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image_path4` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image_path5` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `item_location` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `items_wanted` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date_traded` datetime NOT NULL,
  PRIMARY KEY (`item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_statistics`
--

CREATE TABLE IF NOT EXISTS `item_statistics` (
  `item_number` int(11) NOT NULL,
  `amount_offers` int(11) NOT NULL,
  PRIMARY KEY (`item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `subject` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `body` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `date_sent` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `offers_accepted`
--

CREATE TABLE IF NOT EXISTS `offers_accepted` (
  `trade_id` int(11) NOT NULL,
  `offerers_id` int(11) NOT NULL,
  `offerers_item` int(11) NOT NULL,
  `receivers_id` int(11) NOT NULL,
  `receivers_item` int(11) NOT NULL,
  `date_offered` datetime NOT NULL,
  `date_expired` datetime NOT NULL,
  `date_accepted` datetime NOT NULL,
  `copy_for` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers_declined`
--

CREATE TABLE IF NOT EXISTS `offers_declined` (
  `trade_id` int(11) NOT NULL,
  `offerers_id` int(11) NOT NULL,
  `offerers_item` int(11) NOT NULL,
  `receivers_id` int(11) NOT NULL,
  `receivers_item` int(11) NOT NULL,
  `date_offered` datetime NOT NULL,
  `date_expired` datetime NOT NULL,
  `date_declined` datetime NOT NULL,
  PRIMARY KEY (`trade_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers_open`
--

CREATE TABLE IF NOT EXISTS `offers_open` (
  `trade_id` int(11) NOT NULL AUTO_INCREMENT,
  `offerers_id` int(11) NOT NULL,
  `offerers_item` int(11) NOT NULL,
  `receivers_id` int(11) NOT NULL,
  `receivers_item` int(11) NOT NULL,
  `date_offered` datetime NOT NULL,
  `date_expired` datetime NOT NULL,
  PRIMARY KEY (`trade_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_info`
--

CREATE TABLE IF NOT EXISTS `shipping_info` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `add1` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `add2` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tempusers`
--

CREATE TABLE IF NOT EXISTS `tempusers` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `activation` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `credits` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_statistics`
--

CREATE TABLE IF NOT EXISTS `user_statistics` (
  `user_id` int(11) NOT NULL,
  `items_available` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
