-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 21, 2017 at 12:45 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dare2`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `work_phone` varchar(255) NOT NULL,
  `home_phone` varchar(255) NOT NULL,
  `mobile_phone` varchar(255) NOT NULL,
  `work_name` varchar(255) NOT NULL,
  `work_add1` varchar(255) NOT NULL,
  `work_add2` varchar(255) NOT NULL,
  `work_city` varchar(255) NOT NULL,
  `work_prov` varchar(255) NOT NULL,
  `work_post_code` varchar(255) NOT NULL,
  `home_name` varchar(255) NOT NULL,
  `home_add1` varchar(255) NOT NULL,
  `home_add2` varchar(255) NOT NULL,
  `home_city` varchar(255) NOT NULL,
  `home_prov` varchar(255) NOT NULL,
  `home_post_code` varchar(255) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `company`, `first_name`, `last_name`, `email`, `work_phone`, `home_phone`, `mobile_phone`, `work_name`, `work_add1`, `work_add2`, `work_city`, `work_prov`, `work_post_code`, `home_name`, `home_add1`, `home_add2`, `home_city`, `home_prov`, `home_post_code`, `note`) VALUES
(1, '1783408 Ontario Inc', 'John', 'Smith', 'htr@bellnet.ca', '705-789-3883', '', '', '', 'c/o Dave Hernen, Huntsville Truck Repair', '1-110 Lindgren Road West', 'Huntsville', 'Ontario', 'P1H 1Y2', '', '', '', '', '', '', ''),
(3, '365 Sports', 'Mike', 'Lambert', 'mike@365sports.ca', '', '', '', '', 'Mike Lambert', '71 Edwin Street East', 'Meadford', 'Ontario', 'N4L 1C4', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_job`
--

CREATE TABLE IF NOT EXISTS `customer_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `cr_date` datetime NOT NULL,
  `job_insert_by` int(11) NOT NULL,
  `temp_po` varchar(255) NOT NULL,
  `pno` varchar(255) DEFAULT NULL,
  `closing_date` date NOT NULL,
  `closing_notes` text,
  `photo_1` varchar(255) DEFAULT NULL,
  `photo_1_caption` varchar(255) DEFAULT NULL,
  `photo_2` varchar(255) DEFAULT NULL,
  `photo_2_caption` varchar(255) DEFAULT NULL,
  `photo_3` varchar(255) DEFAULT NULL,
  `photo_3_caption` varchar(255) DEFAULT NULL,
  `closed_by` int(11) DEFAULT NULL,
  `job_notes` text NOT NULL,
  `material` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `customer_job`
--

INSERT INTO `customer_job` (`id`, `name`, `cust_id`, `po`, `from_date`, `to_date`, `status`, `vendor_id`, `cr_date`, `job_insert_by`, `temp_po`, `pno`, `closing_date`, `closing_notes`, `photo_1`, `photo_1_caption`, `photo_2`, `photo_2_caption`, `photo_3`, `photo_3_caption`, `closed_by`, `job_notes`, `material`) VALUES
(9, 'job without images', '1', '1000', '2017-06-27', '2017-06-29', 1, '0', '2017-06-27 11:40:07', 1, '1000', NULL, '0000-00-00', NULL, '', '', '', '', '', '', NULL, 'job without images', 'a:12:{i:0;s:1:"2";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"5";i:4;s:1:"6";i:5;s:1:"7";i:6;s:2:"11";i:7;s:2:"14";i:8;s:2:"17";i:9;s:2:"19";i:10;s:2:"20";i:11;s:2:"25";}'),
(10, 'job with images', '3', '1001', '2017-06-27', '2017-06-30', 1, '0', '2017-06-27 11:47:02', 1, '1001', NULL, '0000-00-00', NULL, '20170627114702DMG111-Leeds-1624-96-2.png', '', '20170627114702DN08-32-3.png', '', '20170627114702F28-BT-SM-9680.jpg', '', NULL, 'job with images', '0'),
(11, 'new job', '3', '1002', '2017-06-27', '2017-06-27', 1, '0', '2017-06-27 13:14:23', 1, '1002', NULL, '0000-00-00', NULL, '', '', '', '', '', '', NULL, 'new job', 'a:4:{i:0;s:1:"2";i:1;s:1:"3";i:2;s:1:"6";i:3;s:1:"7";}'),
(12, 'new job', '3', '1002', '2017-06-27', '2017-06-27', 1, '0', '2017-06-27 13:14:54', 1, '1002', NULL, '0000-00-00', NULL, '', '', '', '', '', '', NULL, 'new job', 'a:4:{i:0;s:1:"2";i:1;s:1:"3";i:2;s:1:"6";i:3;s:1:"7";}'),
(13, 'testing', '1', '1003', '2017-06-27', '2017-06-27', 1, '0', '2017-06-27 13:19:24', 1, '1003', NULL, '0000-00-00', NULL, '', '', '', '', '', '', NULL, 'testing', 'a:6:{i:0;s:1:"2";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"5";i:4;s:1:"6";i:5;s:1:"7";}'),
(14, 'new job test richard', '1', '1004', '2017-06-27', '2017-06-27', 1, '0', '2017-06-27 14:27:56', 1, '1004', NULL, '0000-00-00', NULL, '20170627142845weathered-concrete-background_1149-1289.jpg', '', '', '', '', '', NULL, 'new job richard', 'a:4:{i:0;s:1:"2";i:1;s:1:"4";i:2;s:1:"8";i:3;s:2:"25";}'),
(15, 'Adam''s Job', '1', '1005', '2017-06-28', '2017-07-10', 1, '0', '2017-06-28 12:22:23', 1, '1005', NULL, '0000-00-00', NULL, '20170628122223logo.png', '', '20170704121749land4.jpg', '', '20170704124551contact_banner.jpg', '', NULL, 'Test', 'a:4:{i:0;s:1:"2";i:1;s:1:"4";i:2;s:2:"12";i:3;s:2:"25";}'),
(16, 'this is neww', '1', '1006', '2017-07-11', '2017-07-27', 1, '0', '2017-07-11 17:14:00', 1, '1006', NULL, '0000-00-00', NULL, '20170711171400Portfolio.jpg', 'caption 1', '20170711171400services.jpg', 'caption 2', '20170711171400services.jpg', 'caption 3', NULL, 'this is new job', 'a:13:{i:0;s:1:"2";i:1;s:1:"3";i:2;s:1:"6";i:3;s:1:"7";i:4;s:2:"12";i:5;s:2:"13";i:6;s:2:"14";i:7;s:2:"15";i:8;s:2:"16";i:9;s:2:"17";i:10;s:2:"23";i:11;s:2:"24";i:12;s:2:"25";}');

-- --------------------------------------------------------

--
-- Table structure for table `job_last_updated`
--

CREATE TABLE IF NOT EXISTS `job_last_updated` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `last_updated` datetime NOT NULL,
  `last_email_sent` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `job_last_updated`
--

INSERT INTO `job_last_updated` (`id`, `job_id`, `status`, `last_updated`, `last_email_sent`) VALUES
(8, 10, 1, '2017-06-27 11:47:02', '2017-06-27 11:47:02'),
(7, 9, 1, '2017-06-27 11:40:07', '2017-06-27 11:40:07'),
(9, 11, 1, '2017-06-27 13:14:23', '2017-06-27 13:14:23'),
(10, 12, 1, '2017-06-27 13:14:54', '2017-06-27 13:14:54'),
(11, 13, 1, '2017-06-27 13:19:24', '2017-06-27 13:19:24'),
(12, 14, 1, '2017-06-27 14:27:56', '2017-06-27 14:27:56'),
(13, 15, 1, '2017-06-28 12:22:23', '2017-06-28 12:22:23'),
(14, 16, 1, '2017-07-11 17:14:00', '2017-07-11 17:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `job_piece`
--

CREATE TABLE IF NOT EXISTS `job_piece` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `piece_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `job_piece`
--

INSERT INTO `job_piece` (`id`, `job_id`, `piece_name`, `status`) VALUES
(1, 15, 'new piece', 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_piece_component`
--

CREATE TABLE IF NOT EXISTS `job_piece_component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `piece_id` int(11) NOT NULL,
  `component` varchar(255) NOT NULL,
  `thick` varchar(255) NOT NULL,
  `length` varchar(255) NOT NULL,
  `width` varchar(255) NOT NULL,
  `cubic_sq` varchar(255) NOT NULL,
  `cubic_sq_int` varchar(255) NOT NULL,
  `weight` text NOT NULL,
  `cost` text NOT NULL,
  `total_weight` varchar(255) NOT NULL,
  `total_cost` varchar(255) NOT NULL,
  `tot_abs_vol` varchar(255) NOT NULL,
  `cr_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `job_piece_component`
--

INSERT INTO `job_piece_component` (`id`, `job_id`, `piece_id`, `component`, `thick`, `length`, `width`, `cubic_sq`, `cubic_sq_int`, `weight`, `cost`, `total_weight`, `total_cost`, `tot_abs_vol`, `cr_date`, `status`) VALUES
(1, 15, 1, '1', '0.75', '12', '12', '0.063', '0.066', 'a:11:{i:0;s:2:"10";i:1;s:2:"10";i:2;s:2:"10";i:3;s:2:"10";i:4;s:2:"10";i:5;s:2:"10";i:6;s:2:"10";i:7;s:2:"10";i:8;s:2:"10";i:9;s:2:"20";i:10;s:2:"10";}', 'a:11:{i:0;s:3:"100";i:1;s:3:"200";i:2;s:3:"100";i:3;s:3:"500";i:4;s:3:"200";i:5;s:1:"0";i:6;s:1:"0";i:7;s:1:"0";i:8;s:1:"0";i:9;s:4:"1000";i:10;s:1:"0";}', '120', '4300', '0.05,0.05,0.06,0,0,0,0,0.06,0,0.11,0', '2017-07-11 10:19:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `water` varchar(255) NOT NULL,
  `descp` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `cr_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `vendor`, `category`, `weight`, `water`, `descp`, `price`, `cr_date`, `status`) VALUES
(2, 8, 1, 'lb', '', 'White', '10', '2017-06-27 09:40:40', 1),
(3, 8, 1, 'lb', '', 'Grey', '20', '2017-06-27 10:13:04', 1),
(4, 9, 2, 'lb', '', 'Stock', '10', '2017-06-27 10:13:31', 1),
(5, 9, 2, 'lb', '', 'White Lightning', '20', '2017-06-27 10:13:58', 1),
(6, 9, 2, 'lb', '', 'Snow White', '30', '2017-06-27 10:14:20', 1),
(7, 9, 2, 'lb', '', 'Absolute Black', '40', '2017-06-27 10:14:40', 1),
(12, 10, 3, 'g', '2', 'White Titanium Oxide', '50', '2017-06-27 10:19:01', 1),
(13, 10, 3, 'g', '2.5', 'Chromium Green', '60', '2017-06-27 10:19:25', 1),
(14, 11, 3, 'g', '2.5', 'Yellow Iron Oxide', '60.5', '2017-06-27 10:19:56', 1),
(15, 21, 3, 'lb', '2.5', 'Desert Tan', '65', '2017-06-27 10:20:21', 1),
(16, 14, 3, 'g', '2.5', 'Altra Marine', '64', '2017-06-27 10:20:44', 1),
(17, 13, 3, 'lb', '2.5', 'Red', '55', '2017-06-27 10:21:14', 1),
(18, 21, 3, 'lb', '2.5', 'Smoke', '64', '2017-06-27 10:21:47', 1),
(19, 15, 3, 'lb', '2.5', 'White Portland, No Pigment', '101', '2017-06-27 10:22:20', 1),
(20, 21, 4, 'lb', '', 'H12 Sealer - Part A', '5', '2017-06-27 10:23:29', 1),
(21, 14, 4, 'lb', '', 'H12 Sealer - Part B', '9', '2017-06-27 10:23:48', 1),
(22, 13, 4, 'lb', '', 'SB Sealer - Part A', '21', '2017-06-27 10:24:06', 1),
(23, 18, 4, 'lb', '', 'SB Sealer - Part A', '54', '2017-06-27 10:24:23', 1),
(24, 20, 4, 'lb', '', 'LS-Lockup', '45', '2017-06-27 10:24:38', 1),
(25, 15, 4, 'lb', '', 'Stamp Shield', '20', '2017-06-27 10:25:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `material_category`
--

CREATE TABLE IF NOT EXISTS `material_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `water` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `sg` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `material_category`
--

INSERT INTO `material_category` (`id`, `name`, `water`, `price`, `weight`, `sg`, `status`) VALUES
(1, 'Portland Concrete', '', '', '', '3.15', 0),
(2, 'Sand', '', '', '', '2.65', 0),
(3, 'Pigments', '2', '', '', '', 0),
(4, 'Sealer', '', '', '', '', 0),
(17, 'GFRC Admix', '', '20', '', '', 1),
(18, 'Glass Fibre', '', '70', '', '', 1),
(19, 'Silica Fume', '', '30', '', '2.62', 1),
(20, 'Plasticizer', '', '40', '', '', 1),
(21, 'CSA', '', '50', '', '3.00', 1),
(22, 'Stage II Accelerator', '', '60', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_components`
--

CREATE TABLE IF NOT EXISTS `recipe_components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `recipe_components`
--

INSERT INTO `recipe_components` (`id`, `name`) VALUES
(1, 'Self-Consolidating Face Coat'),
(2, 'Hand Press Face Coat'),
(3, 'Spray Coat'),
(4, 'Self-Consolidating Back Coat '),
(5, 'Miscellaneous');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `last_logged_in` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `first_name`, `last_name`, `email`, `phone`, `status`, `last_logged_in`, `created`) VALUES
(1, 'CreativeOne', 'f92418816c7f1848d3921c18f24777c8', 'admin', 'Daniel', 'Bradbury', 'daniel@creativeone.ca', '', 1, '2017-06-13 11:11:14', '2017-06-13 11:11:14'),
(2, 'Chris Galashan', '6411bcd6bb021e98bedb1993a30663ff', 'staff', 'Chris', 'Galashan', 'chriswgalashan@protonmail.com', '0', 1, '0000-00-00', '2017-06-13 07:58:19'),
(3, 'Chris Long', 'e10adc3949ba59abbe56e057f20f883e', 'staff', 'Chris', 'Long', 'fishbc4@gmail.com', '0', 1, '0000-00-00', '2017-06-13 08:01:39'),
(4, 'Scott Aitchison', '822c0e08577ce4bd17b4633db98b830b', 'staff', 'Scott', 'Aitchison', 'scotta@vianet.ca', '0', 1, '0000-00-00', '2017-06-13 08:31:08'),
(5, 'Ben Galashan', '822c0e08577ce4bd17b4633db98b830b', 'staff', 'Ben', 'Galashan', 'ben.galashan@dare2bdifferent.ca', '(222) 222-2222', 1, '0000-00-00', '2017-06-13 09:53:53'),
(6, 'Will Hicks', '822c0e08577ce4bd17b4633db98b830b', 'admin', 'Will', 'Hicks', 'will.hicks@dare2bdifferent.ca', '0', 1, '0000-00-00', '2017-06-13 09:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `prov` varchar(255) NOT NULL,
  `post_code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `name`, `email`, `phone`, `address`, `city`, `prov`, `post_code`) VALUES
(8, 'Electrical Safety Authority', 'esa.correspondence@electricalsafety.on.ca', '000-000-0000', '', '', '', ''),
(9, 'Generac''s', 'donotreply@generac.com', '', '', '', '', ''),
(10, 'Huntsville Aggregates', 'jamie@muskokarockcompany.com', '', '', '', '', ''),
(11, 'Ideal Supply', 'sysgen@IDEALSUPPLY.COM', '', '', '', '', ''),
(12, 'Muskoka Rent All', 'accounting@muskokarentall.com', '', '', '', '', ''),
(13, 'Nedco & Westburne', 'Invoicing@rexel.ca', '', '', '', '', ''),
(14, 'The Fireplace King', 'info@fireplaceking.com', '', '', '', '', ''),
(15, 'Torbram Electric (Jim)', 'imsmail@torbramelectric.com', '', '', '', '', ''),
(17, 'Wolseley', 'wolseleycanada@billtrust.com', '', '', '', '', ''),
(18, 'Stock Material', 'Julie@ronprattelectric.com', '', '', '', '', ''),
(20, 'Torbram Electric (Neil)', 'NSparling@torbramelectric.com', '', '', '', '', ''),
(21, 'Rolston Home Hardware', 'rhbc@rolstonhomebuilding.ca', '', '', 'Huntsville', '', ''),
(22, 'Trobram (jim 2)', 'jrussell@torbramelectric.com', '', '', '', '', '');
