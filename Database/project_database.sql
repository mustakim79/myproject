-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 01, 2020 at 09:50 AM
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
-- Database: `ajax_db`
--
CREATE DATABASE IF NOT EXISTS `ajax_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ajax_db`;

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

DROP TABLE IF EXISTS `data`;
CREATE TABLE IF NOT EXISTS `data` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `sirname` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `username`, `sirname`) VALUES
(1, 'mustakim', 'kureshi'),
(2, 'must', 'kureshi'),
(3, 'mustakim', 'kureshi'),
(4, 'mustakim', 'kureshi'),
(5, 'must', 'kureshi'),
(6, '', ''),
(7, '', ''),
(8, '', ''),
(9, 'mustakim', 'kureshi');

-- --------------------------------------------------------

--
-- Table structure for table `multi_data`
--

DROP TABLE IF EXISTS `multi_data`;
CREATE TABLE IF NOT EXISTS `multi_data` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(200) NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `item_price` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `multi_data`
--

INSERT INTO `multi_data` (`id`, `item_name`, `item_code`, `item_desc`, `item_price`) VALUES
(1, 'fsdfsads', 'item_code', 'sdfasfas', 'asfsa'),
(2, 'fsd', 'item_code', 'dsfsd', 'sdffsa'),
(3, 's', 'item_code', 's', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `multi_data_json`
--

DROP TABLE IF EXISTS `multi_data_json`;
CREATE TABLE IF NOT EXISTS `multi_data_json` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`json`)),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Database: `chat`
--
CREATE DATABASE IF NOT EXISTS `chat` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chat`;

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

DROP TABLE IF EXISTS `msg`;
CREATE TABLE IF NOT EXISTS `msg` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `msg` varchar(200) NOT NULL,
  `user_id` int(20) NOT NULL,
  `msgsnd_id` int(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`id`, `msg`, `user_id`, `msgsnd_id`, `time`) VALUES
(1, 'hello', 2, 1, '2020-03-26 07:19:16'),
(2, 'hello again', 2, 1, '2020-03-26 08:38:08'),
(3, 'hello again', 2, 1, '2020-03-26 08:39:13'),
(4, 'hello', 1, 2, '2020-03-26 08:43:45'),
(5, 'hii', 1, 2, '2020-03-26 08:46:44'),
(6, 'fsa', 2, 1, '2020-03-26 09:01:33'),
(8, 'what&#039;s up ', 2, 1, '2020-03-26 09:32:54'),
(9, 'what&#039;s up ?', 2, 1, '2020-03-26 09:34:00'),
(10, 'hello', 3, 2, '2020-03-26 12:03:54'),
(11, 'hello', 2, 3, '2020-03-26 12:04:40'),
(12, 'hi', 3, 2, '2020-03-26 12:19:23'),
(13, 'what&#039;s up ?', 2, 3, '2020-03-26 12:19:55'),
(14, 'hello again', 2, 3, '2020-03-26 12:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `usnm` varchar(20) NOT NULL,
  `img` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `usnm`, `img`, `pass`) VALUES
(1, 'mustakim', 'Hydrangeas.jpg', 'aaaa'),
(2, 'must', 'Desert.jpg', '123'),
(3, 'abcd', 'Lighthouse.jpg', '123');
--
-- Database: `data`
--
CREATE DATABASE IF NOT EXISTS `data` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `data`;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `post_id` int(20) NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) NOT NULL,
  `user_id` int(20) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`post_id`, `content`, `user_id`) VALUES
(1, 'this is first post', 1),
(2, 'hello there', 1),
(4, 'aaaaaaaaaaaaaaaaaa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(1, 'user1', 'aaaa'),
(2, 'user2', '123');
--
-- Database: `demo`
--
CREATE DATABASE IF NOT EXISTS `demo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `demo`;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `note_user` int(11) NOT NULL,
  `note_title` varchar(100) NOT NULL,
  `note_dis` varchar(500) NOT NULL,
  `note_users` varchar(1000) NOT NULL DEFAULT '[]',
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`note_id`, `note_user`, `note_title`, `note_dis`, `note_users`) VALUES
(7, 1, 'hello', 'Hey \r\n', '[\"3\",\"4\",\"5\",\"6\",\"7\",\"9\"]'),
(8, 1, 'This is 8th', 'This is 8th', '[]'),
(9, 2, 'This  is 9th Note', 'hello', '[]'),
(10, 2, 'Solve it. And Send me Your Code', 'Again Error', '[]'),
(11, 1, 'hello', 'hellos', '[]'),
(12, 1, 'Hello\'s', 'Hii \"How Are You\" <h1>hello</h1>', '[]'),
(13, 1, 'new Update', 'Featueres', '[\"2\",\"3\",\"8\",\"9\"]'),
(14, 2, 'This is my Note(tech2)', 'i Shared to tech', '[\"1\"]'),
(15, 9, 'This is ', 'Test7', '[\"1\",\"2\",\"3\"]'),
(16, 10, 'send by mst', 'this is just for checking ', '[\"1\"]'),
(17, 1, 'send by tech', 'to mustakim', '[\"10\"]');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`) VALUES
(1, 'tech', 'pass'),
(2, 'tech2', 'pass2'),
(3, 'test1', 'test'),
(4, 'test2\r\n                                           ', 'test'),
(5, 'test3', 'test'),
(6, 'test4', 'test'),
(7, 'test5', 'test'),
(8, 'test6', 'test'),
(9, 'test7', 'test'),
(10, 'mustakim', '123');
--
-- Database: `flask_prac`
--
CREATE DATABASE IF NOT EXISTS `flask_prac` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `flask_prac`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `mobile` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`) VALUES
(1, 'mustakim', 4345);
--
-- Database: `jsp_db`
--
CREATE DATABASE IF NOT EXISTS `jsp_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `jsp_db`;

-- --------------------------------------------------------

--
-- Table structure for table `student2`
--

DROP TABLE IF EXISTS `student2`;
CREATE TABLE IF NOT EXISTS `student2` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `mobile` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student2`
--

INSERT INTO `student2` (`id`, `name`, `email`, `city`, `mobile`) VALUES
(1, 'must', 'mustakim@gmail.com', 'amreli', 5645135),
(2, 'mustakim', 'mustakim@gmail.com', 'rajkot', 44554335),
(3, 'mustakim', 'mustakim@gmail.com', 'amreli', 2),
(4, 'mustakim', 'mustakim@gmail.com', 'amreli', 2),
(5, 'mustakim', 'mustakim@gmail.com', 'amreli', 6),
(6, 'mustakim', 'mustakim@gmail.com', 'amreli', 6565);
--
-- Database: `laraveldemo`
--
CREATE DATABASE IF NOT EXISTS `laraveldemo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `laraveldemo`;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `sname` varchar(20) NOT NULL,
  `standard` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `sname`, `standard`) VALUES
(1, 'mustakim', 12),
(2, 'mustakim2', 12),
(3, 'mustakim2', 12),
(4, 'abc', 0),
(5, 'xyz', 0);
--
-- Database: `likedb`
--
CREATE DATABASE IF NOT EXISTS `likedb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `likedb`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `usnm` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `usnm`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `img` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `img`) VALUES
(1, 'the first ever post', 'Chrysanthemum.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `post_liked`
--

DROP TABLE IF EXISTS `post_liked`;
CREATE TABLE IF NOT EXISTS `post_liked` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user` int(20) NOT NULL,
  `post` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_liked`
--

INSERT INTO `post_liked` (`id`, `user`, `post`) VALUES
(7, 1, 1),
(8, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`) VALUES
(1, 'mustakim'),
(2, 'user1');
--
-- Database: `projectdb`
--
CREATE DATABASE IF NOT EXISTS `projectdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projectdb`;

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `category_name`, `cat_img`, `display_status`) VALUES
(1, 'pizza', '4.jpg', 1),
(3, 'drink', 'soda-pop.jpg', 1),
(2, 'burger', 'burger2.jpeg', 1),
(7, 'Cola', 'cola.jpg', 1);

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
  `display_status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`food_id`),
  KEY `fk_food_category` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_img`, `food_name`, `food_descript`, `food_rs`, `category_id`, `display_status`) VALUES
(3, '5.jpg', 'Chicago Pizza', 'with russian garlic ', 150, 1, 1),
(5, 'burger2.jpeg', 'burger', 'this is pure veg and very tasty burger ', 90, 2, 1),
(6, 'pizza3.jpg', 'Cheeze pizza ', 'With 250g cheeze', 180, 1, 1),
(9, '1.jpg', 'pizza 3', 'this is so tasty pizza', 100, 1, 1),
(10, '6.jpg', 'pizza 4`', 'this is pizza 5 tasty', 120, 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detaile`
--

INSERT INTO `order_detaile` (`ord_id`, `user_id`, `food_id`, `food_rs`, `food_qty`, `amount`, `time`, `ord_status`) VALUES
(2, 1, 6, 180, 1, 180, '2020-12-01 07:51:56', 'not confirm'),
(3, 1, 3, 150, 1, 150, '2020-12-01 07:55:38', 'not confirm');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `take_order`
--

INSERT INTO `take_order` (`take_ord_id`, `ord_id`, `address_id`, `user_id`, `status`, `amount`, `msg`, `date_time`) VALUES
(1, '[\"1\"]', 2, 1, 'delivered', 280, 'waiting for restaurant confirmation', '2020-11-10 05:42:25'),
(2, '[\"2\"]', 2, 1, 'pending', 90, 'waiting for restaurant confirmation', '2020-11-12 09:24:15');

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
--
-- Database: `soft`
--
CREATE DATABASE IF NOT EXISTS `soft` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `soft`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `usnm` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE IF NOT EXISTS `food` (
  `fid` int(20) NOT NULL AUTO_INCREMENT,
  `fimg` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `descr` varchar(200) NOT NULL,
  `rs` int(15) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`fid`, `fimg`, `fname`, `descr`, `rs`) VALUES
(1, '1.jpg', 'corn pizza', 'Sprikle with salt and pepper, let stand', 220),
(2, '2.jpg', 'corn pizza', 'Very tasty', 250),
(3, '3.jpg', 'italic pizza', 'with russian garlic ', 280);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `fnm` varchar(20) NOT NULL,
  `frs` int(20) NOT NULL,
  `qty` int(20) NOT NULL,
  `user_id` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_order`
--

DROP TABLE IF EXISTS `tmp_order`;
CREATE TABLE IF NOT EXISTS `tmp_order` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `fnm` varchar(20) NOT NULL,
  `frs` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_order`
--

INSERT INTO `tmp_order` (`id`, `fnm`, `frs`, `user_id`) VALUES
(1, 'corn pizza', 220, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `fnm` varchar(20) NOT NULL,
  `lsnm` varchar(20) NOT NULL,
  `eml` varchar(50) NOT NULL,
  `mob` int(15) NOT NULL,
  `pass` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fnm`, `lsnm`, `eml`, `mob`, `pass`) VALUES
(1, 'test', 'test', 'test@gmail.com', 12341546, 'aaaa'),
(3, 'a', 'b', 's@gmail.com', 42342, 'ttt');
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Table structure for table `stud`
--

DROP TABLE IF EXISTS `stud`;
CREATE TABLE IF NOT EXISTS `stud` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
