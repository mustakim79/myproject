-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 10, 2020 at 05:52 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `addr_id` int(200) NOT NULL AUTO_INCREMENT,
  `flat_no` varchar(200) NOT NULL,
  `street_name` varchar(200) NOT NULL,
  `area` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`addr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addr_id`, `flat_no`, `street_name`, `area`, `city`, `user_id`, `date_time`) VALUES
(1, '12', 'khatrivad', 'kasbavad', 'amreli', 2, '2020-07-16 13:52:26'),
(2, '12', 'khatrivad', 'kasbavad', 'amreli', 1, '2020-07-16 14:23:59'),
(3, '12', 'asf2', 'afaf', 'rajkot', 3, '2020-11-07 13:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `canceled_order`
--

DROP TABLE IF EXISTS `canceled_order`;
CREATE TABLE IF NOT EXISTS `canceled_order` (
  `can_ord_id` int(200) NOT NULL AUTO_INCREMENT,
  `take_ord_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `reasion` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`can_ord_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(20) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) NOT NULL,
  `cat_img` varchar(20) NOT NULL,
  `display_status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `category_name`, `cat_img`, `display_status`) VALUES
(1, 'pizza', '4.jpg', 1),
(3, 'drink', 'soda-pop.jpg', 1),
(2, 'burger', 'burger2.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE IF NOT EXISTS `food` (
  `food_id` int(20) NOT NULL AUTO_INCREMENT,
  `food_img` varchar(20) NOT NULL,
  `food_name` varchar(20) NOT NULL,
  `food_descript` varchar(100) NOT NULL,
  `food_rs` int(15) NOT NULL,
  `category_id` int(200) NOT NULL,
  PRIMARY KEY (`food_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_img`, `food_name`, `food_descript`, `food_rs`, `category_id`) VALUES
(3, '4.jpg', 'Chicago Pizza', 'with russian garlic ', 280, 1),
(5, 'burger2.jpeg', 'burger', 'this is pure veg and very tasty burger ', 90, 2),
(6, 'pizza3.jpg', 'Cheeze pizza ', 'With 250g cheeze', 180, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detaile`
--

DROP TABLE IF EXISTS `order_detaile`;
CREATE TABLE IF NOT EXISTS `order_detaile` (
  `ord_id` int(200) NOT NULL AUTO_INCREMENT,
  `user_id` int(200) NOT NULL,
  `food_id` int(200) NOT NULL,
  `food_rs` int(200) NOT NULL,
  `food_qty` int(200) NOT NULL,
  `amount` int(200) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ord_status` varchar(200) NOT NULL DEFAULT 'not confirm',
  PRIMARY KEY (`ord_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detaile`
--

INSERT INTO `order_detaile` (`ord_id`, `user_id`, `food_id`, `food_rs`, `food_qty`, `amount`, `time`, `ord_status`) VALUES
(1, 1, 3, 280, 1, 280, '2020-11-10 05:42:20', 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `shop_close`
--

DROP TABLE IF EXISTS `shop_close`;
CREATE TABLE IF NOT EXISTS `shop_close` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `status` bit(1) NOT NULL,
  `msg` varchar(200) DEFAULT NULL,
  `start_shop` time NOT NULL,
  `end_shop` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_close`
--

INSERT INTO `shop_close` (`id`, `status`, `msg`, `start_shop`, `end_shop`) VALUES
(1, b'1', 'shop has been closed', '14:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `take_order`
--

DROP TABLE IF EXISTS `take_order`;
CREATE TABLE IF NOT EXISTS `take_order` (
  `take_ord_id` int(200) NOT NULL AUTO_INCREMENT,
  `ord_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`ord_id`)),
  `address_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `amount` int(200) NOT NULL,
  `msg` varchar(200) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`take_ord_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `take_order`
--

INSERT INTO `take_order` (`take_ord_id`, `ord_id`, `address_id`, `user_id`, `status`, `amount`, `msg`, `date_time`) VALUES
(1, '[\"1\"]', 2, 1, 'delivered', 280, 'waiting for restaurant confirmation', '2020-11-10 05:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(20) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `mobile` int(15) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `mobile`, `pass`, `datetime`) VALUES
(1, 'mustakim', 'kureshi', 'mustakim@gmail.com', 1212212121, 'aaaa', '2020-11-10 05:41:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
