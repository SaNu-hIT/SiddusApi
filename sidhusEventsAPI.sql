-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 06, 2017 at 11:00 PM
-- Server version: 5.6.35-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sidhusEventsAPI`
--

-- --------------------------------------------------------

--
-- Table structure for table `sidhus_category`
--

CREATE TABLE IF NOT EXISTS `sidhus_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sidhus_category`
--

INSERT INTO `sidhus_category` (`category_id`, `cat_name`) VALUES
(1, 'Stage Activity'),
(2, 'Fun Activity'),
(3, 'Fun Eateries'),
(4, 'Stall Games'),
(5, 'Photo & Video'),
(6, 'Sounds/Lightings'),
(7, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `sidhus_event_type`
--

CREATE TABLE IF NOT EXISTS `sidhus_event_type` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(50) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `sidhus_event_type`
--

INSERT INTO `sidhus_event_type` (`event_id`, `event_name`) VALUES
(1, 'Birthday Party'),
(2, 'Naming Ceremony'),
(3, 'Baby Shower'),
(4, 'wedding'),
(5, 'Sangeet Party'),
(6, 'Corporate Event'),
(7, 'Adult Party'),
(8, 'Get to gether party'),
(9, 'Anniversary'),
(10, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `sidhus_invoice`
--

CREATE TABLE IF NOT EXISTS `sidhus_invoice` (
  `INVOICE_NO` bigint(30) NOT NULL AUTO_INCREMENT,
  `cust_fullname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cust_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `theme_name` varchar(520) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `color_combo` varchar(700) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cust_mobileno` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cust_alternate_mobileno` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cust_emailId` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `event_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `event_pincode` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `event_location` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `event_landmark` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `event_id` int(11) NOT NULL,
  `subcat_id` varchar(500) NOT NULL,
  `venue_type` varchar(30) NOT NULL,
  `eventDate` date NOT NULL,
  `eventTime` varchar(30) NOT NULL,
  `concept_type` varchar(30) NOT NULL,
  `notes_or_Remarks` varchar(80) NOT NULL,
  `special_notes` varchar(1000) NOT NULL,
  `transportation_Rate` varchar(20) NOT NULL,
  `Tax_percentage` decimal(10,2) NOT NULL,
  `Advance` decimal(10,2) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `user_id` int(10) NOT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `event_Details` varchar(720) NOT NULL,
  `name_on_board` varchar(1000) NOT NULL,
  PRIMARY KEY (`INVOICE_NO`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=303302 ;

-- --------------------------------------------------------

--
-- Table structure for table `sidhus_invoice_reference_images`
--

CREATE TABLE IF NOT EXISTS `sidhus_invoice_reference_images` (
  `ImageId` int(11) NOT NULL AUTO_INCREMENT,
  `INVOICE_NO` int(11) NOT NULL,
  `imageUrl` varchar(800) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ImageId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table `Sidhus_Login_credentials`
--

CREATE TABLE IF NOT EXISTS `Sidhus_Login_credentials` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pincode` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobileno` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `emailId` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `FRID` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `mobileno` (`mobileno`),
  UNIQUE KEY `emailId` (`emailId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Sidhus_Login_credentials`
--

INSERT INTO `Sidhus_Login_credentials` (`user_id`, `fullname`, `address`, `pincode`, `city`, `mobileno`, `emailId`, `password`, `FRID`, `role`) VALUES
(1, 'Venkat', 'SIDHUS EVENTS', '560075', 'Banglor', '9886499658', 'siddutef73@gmail.com', 'siddu9886499658', '', 'admin'),
(2, 'Manjesh', 'Sidhus Events', '560075', 'Banglore', '9611165814', 'manjesh.sidduevents@gmail.com', 'Manjesh9611165814', 'NA', 'user'),
(3, 'Booking', 'Sidhus Events', '560075', 'Banglore', '8884337770', 'Bookingsidhus@gmail.com', 'Booking@sidhus101', 'NA', 'user'),
(4, 'Sales Team', 'Sidhus Events', '560075', 'Banglore', '9008514133', 'siddusalesteam@gmail.com', 'sales@sidhus', 'NA', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `sidhus_subcategory`
--

CREATE TABLE IF NOT EXISTS `sidhus_subcategory` (
  `subcat_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `subcat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`subcat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `sidhus_subcategory`
--

INSERT INTO `sidhus_subcategory` (`subcat_id`, `category_id`, `subcat_name`) VALUES
(1, 1, 'Magic Show'),
(2, 1, 'Magic Show (Pro)'),
(3, 1, 'Clown Magic'),
(4, 2, 'Tattoo artist'),
(5, 2, 'Face Painting'),
(6, 3, 'Cotton Candy'),
(7, 3, 'Pop Corn'),
(8, 4, 'Baloon Shooting'),
(9, 4, 'Archery'),
(10, 5, 'Photography (Std)'),
(11, 5, 'Photography (Pro)'),
(12, 6, 'Basic Sound System'),
(13, 6, 'Sound System'),
(14, 7, 'Food'),
(15, 7, 'Snacks'),
(16, 7, 'Chat Items'),
(17, 7, 'Live Singer'),
(18, 7, 'Guitarist'),
(19, 1, 'Close-up-Magic'),
(20, 1, 'Emcee'),
(21, 1, 'Emcee(Pro)'),
(22, 1, 'Juggling'),
(23, 1, 'Sand Art'),
(24, 1, 'Mimicry Artist'),
(25, 1, 'Shadow Play'),
(26, 1, 'Ventriloquist'),
(27, 1, 'Others'),
(28, 2, 'Caricature'),
(29, 2, 'Mug Caricature'),
(30, 2, 'Nail Art'),
(31, 2, 'Balloon Modeling'),
(32, 2, 'Live Cartoon'),
(33, 2, 'Balloon Man'),
(34, 2, 'Clown'),
(35, 2, 'Clay Modeling'),
(36, 2, 'Bouncing Castle(Small)'),
(37, 2, 'Bouncing Castle(Medium)'),
(38, 2, 'Bouncing Castle(Big)'),
(39, 2, 'Hair beading'),
(40, 2, 'Hair Styling'),
(41, 2, 'Live Pottery'),
(42, 2, 'Mehndi Artist'),
(43, 2, 'Pot Painting'),
(44, 2, 'Photo booth & Props'),
(45, 3, 'Ice Gola'),
(46, 3, 'Chocolate Fountain'),
(47, 3, 'Golgappa'),
(48, 3, 'Juice Corner'),
(49, 3, 'Snacks Corner'),
(50, 3, 'Sweet Corn'),
(51, 3, 'Bambay Candy'),
(52, 3, 'Others'),
(53, 4, 'Fishing'),
(54, 4, 'Hoopla'),
(55, 4, 'Ball Pool'),
(56, 4, 'Ball Pool & Slider'),
(57, 4, 'Angry Bird Game'),
(58, 4, 'Kids play area'),
(59, 4, 'Hit the rat'),
(60, 4, 'Dot Game'),
(61, 4, 'Others'),
(62, 5, 'Candid (Pro)'),
(63, 5, 'Photo shoot (Std)'),
(64, 5, 'Photo shoot(Pro)'),
(65, 5, 'VIdeo Coverage (CCD)'),
(66, 5, 'LED Wall'),
(67, 5, 'Projector & Tripod'),
(68, 5, 'Karishma Album 10x18 (Std)'),
(69, 5, 'Canvera Album'),
(70, 5, 'Others'),
(71, 6, 'Sound System (Pro)'),
(72, 6, 'DJ Setup (Std)'),
(73, 6, 'DJ Setup (Pro)'),
(74, 6, 'DJ (LS)'),
(75, 6, 'DJ (Pro)'),
(76, 6, 'Serial Lights'),
(77, 6, 'LED par cans'),
(78, 6, 'Halogen'),
(79, 6, 'Focus light'),
(80, 6, 'Laser Light'),
(81, 6, 'Disco Light'),
(82, 6, 'Mirror Ball'),
(83, 6, 'Spot Light'),
(84, 6, 'Bubble Machine'),
(85, 6, 'Smoke Machine'),
(86, 7, 'Arkistra'),
(87, 7, 'Welcome girls'),
(88, 7, 'Chear Girls'),
(89, 7, 'Promoters'),
(90, 5, 'Video Coverage (HD)'),
(96, 5, 'Video Coverage (HD)'),
(97, 5, 'FHD Video Coverage (Blu-rey)'),
(98, 5, 'Candid Video (Pro)'),
(99, 5, 'Candid Video (Std)'),
(100, 5, 'Candid Video (HD)'),
(101, 5, 'Drone Video Coverage(Pro)');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
