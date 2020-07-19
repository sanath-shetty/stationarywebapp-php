-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 31, 2020 at 02:20 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stationery`
--

-- --------------------------------------------------------

--
-- Table structure for table `active`
--

DROP TABLE IF EXISTS `active`;
CREATE TABLE IF NOT EXISTS `active` (
  `act_id` int(11) NOT NULL AUTO_INCREMENT,
  `cst_id` int(11) NOT NULL,
  PRIMARY KEY (`act_id`),
  KEY `cst_id` (`cst_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active`
--

INSERT INTO `active` (`act_id`, `cst_id`) VALUES
(17, 2);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `a_id` int(10) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(20) NOT NULL,
  `a_pswd` varchar(20) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_pswd`, `status`) VALUES
(1, 'admin', 'sagar123', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `crt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cst_id` int(11) NOT NULL,
  `i_id` int(11) NOT NULL,
  PRIMARY KEY (`crt_id`),
  KEY `cst_id` (`cst_id`),
  KEY `i_id` (`i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Normal'),
(2, 'Combo');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cst_id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pswd` varchar(18) NOT NULL,
  PRIMARY KEY (`cst_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cst_id`, `userName`, `email`, `pswd`) VALUES
(2, 'sagar', 'sagar@gmail.com', 'sagar123');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` int(5) NOT NULL,
  `disp` longtext NOT NULL,
  PRIMARY KEY (`i_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`i_id`, `image`, `type`, `title`, `price`, `disp`) VALUES
(10, 'apsara.jpeg', 1, 'Apsara Platinum Extra Dark Pencils Pencil  (Black, Silver)', 95, '20 Pencils,1 Sharpener, 1 Eraser, 1 Scale.'),
(11, 'lunchbox.jpeg', 1, 'Lunch box, red and white', 650, 'Lunch Box description.'),
(12, 'apsara2.jpeg', 2, 'Apsara Stationery School Set', 139, '1Pc Matt Magic Pencil, 3Pc Triga Pencil, 3Pc Non Dust Colorful Eraser, 1Pc Non Dust Jumbo Eraser, 1Pc Spaceball Sharpener, 1 Deluxe Scale 15 cm, 1 Pack 16 Shades Wax Crayons, 1 Pack 8 Shades Half Size Color Pencils, 1Pc Skater Pen, 1Pc Long Point Sharpener');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `active`
--
ALTER TABLE `active`
  ADD CONSTRAINT `cusId` FOREIGN KEY (`cst_id`) REFERENCES `customer` (`cst_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `costm_id` FOREIGN KEY (`cst_id`) REFERENCES `customer` (`cst_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_id` FOREIGN KEY (`i_id`) REFERENCES `items` (`i_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat-type` FOREIGN KEY (`type`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
