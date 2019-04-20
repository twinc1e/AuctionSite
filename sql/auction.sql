-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 13, 2011 at 05:01 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidHistory`
--

CREATE TABLE `bidHistory` (
  `item_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `bidhistory_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`bidhistory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `bidHistory`
--

INSERT INTO `bidHistory` VALUES(18, 7, 233, 47);
INSERT INTO `bidHistory` VALUES(18, 5, 222, 46);
INSERT INTO `bidHistory` VALUES(18, 5, 111, 45);
INSERT INTO `bidHistory` VALUES(17, 7, 340, 42);
INSERT INTO `bidHistory` VALUES(17, 1, 300, 41);
INSERT INTO `bidHistory` VALUES(17, 1, 299, 40);
INSERT INTO `bidHistory` VALUES(17, 5, 201, 39);
INSERT INTO `bidHistory` VALUES(17, 5, 200, 38);
INSERT INTO `bidHistory` VALUES(21, 9, 1111, 48);
INSERT INTO `bidHistory` VALUES(21, 1, 2300, 49);
INSERT INTO `bidHistory` VALUES(18, 5, 244, 50);
INSERT INTO `bidHistory` VALUES(23, 10, 3100, 51);
INSERT INTO `bidHistory` VALUES(23, 7, 3200, 52);
INSERT INTO `bidHistory` VALUES(23, 9, 3300, 53);
INSERT INTO `bidHistory` VALUES(23, 7, 3400, 54);
INSERT INTO `bidHistory` VALUES(23, 9, 3500, 55);
INSERT INTO `bidHistory` VALUES(23, 7, 3600, 56);
INSERT INTO `bidHistory` VALUES(26, 10, 501, 57);
INSERT INTO `bidHistory` VALUES(26, 7, 502, 58);
INSERT INTO `bidHistory` VALUES(25, 11, 1211, 59);
INSERT INTO `bidHistory` VALUES(27, 5, 185, 60);
INSERT INTO `bidHistory` VALUES(27, 7, 187, 61);
INSERT INTO `bidHistory` VALUES(27, 5, 189, 62);
INSERT INTO `bidHistory` VALUES(27, 7, 190, 63);
INSERT INTO `bidHistory` VALUES(27, 5, 191, 64);
INSERT INTO `bidHistory` VALUES(20, 9, 110, 65);
INSERT INTO `bidHistory` VALUES(20, 7, 111, 66);
INSERT INTO `bidHistory` VALUES(20, 7, 112, 67);
INSERT INTO `bidHistory` VALUES(28, 1, 352, 68);
INSERT INTO `bidHistory` VALUES(28, 7, 353, 69);
INSERT INTO `bidHistory` VALUES(28, 5, 355, 70);
INSERT INTO `bidHistory` VALUES(28, 1, 380, 71);
INSERT INTO `bidHistory` VALUES(28, 7, 390, 72);
INSERT INTO `bidHistory` VALUES(28, 5, 391, 73);
INSERT INTO `bidHistory` VALUES(28, 7, 392, 74);
INSERT INTO `bidHistory` VALUES(28, 5, 393, 75);
INSERT INTO `bidHistory` VALUES(28, 7, 394, 76);
INSERT INTO `bidHistory` VALUES(28, 11, 410, 77);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` VALUES(4, 'Arts, Antiques & Collectibles');
INSERT INTO `category` VALUES(5, 'Baby, Kids & Mum ');
INSERT INTO `category` VALUES(6, 'Beauty & Personal Care');
INSERT INTO `category` VALUES(7, 'Books & Comics');
INSERT INTO `category` VALUES(8, 'Camera & Camcorder ');
INSERT INTO `category` VALUES(9, 'Cars & Transport ');
INSERT INTO `category` VALUES(10, 'Clothing & Accessories');
INSERT INTO `category` VALUES(11, 'Computer & Software');
INSERT INTO `category` VALUES(12, 'Electronics & Appliances');
INSERT INTO `category` VALUES(13, 'General & Misc ');
INSERT INTO `category` VALUES(14, 'Handphone & Communication ');
INSERT INTO `category` VALUES(15, 'Health & Medical');
INSERT INTO `category` VALUES(16, 'Home & Gardening ');
INSERT INTO `category` VALUES(17, 'House & Property ');
INSERT INTO `category` VALUES(18, 'Jewellery, Gemstone, Accessori');
INSERT INTO `category` VALUES(19, 'Movies & Video ');
INSERT INTO `category` VALUES(20, 'Music & Song');
INSERT INTO `category` VALUES(21, 'Office Equipment');
INSERT INTO `category` VALUES(22, 'Toys & Games');
INSERT INTO `category` VALUES(23, 'Watches, Pens & Clocks');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `itemname` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `description` text NOT NULL,
  `initialprice` double NOT NULL,
  `endtime` char(20) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` VALUES(17, 'ipad2', 'asset/itemImg/step0-ipad-gallery-image4.png', 'this is an ipad2, top rate tablet device of 2010 and 2011, ranking 4-5(full star) across top review website. Bid now start from just RM23.33 ringit!!!', 23.33, '2011-09-22 11:00', 12, 1, 9, 0);
INSERT INTO `item` VALUES(18, 'imac', 'asset/itemImg/imac.jpg', 'Imac, the one stop desktop for all ppl ranging from student to pro carrer worker, bid now start from RM100', 100, '2011-09-12 14:12', 12, 0, 9, 5);
INSERT INTO `item` VALUES(19, 'Macbook Pro', 'asset/itemImg/macbookpro.jpg', 'Macbook Pro, ur fav laptop and top ranking laptop since appple release macbook pro.', 88.88, '2011-10-12 03:14', 11, 1, 5, 0);
INSERT INTO `item` VALUES(20, 'HTC Desire', 'asset/itemImg/HTC_Desire_HD.png', 'HTC lastest phone, htc desire, bid price start from RM100 only, bid now before to late', 100, '2011-09-16 05:05', 14, 1, 5, 0);
INSERT INTO `item` VALUES(21, 'Hyundai example', 'asset/itemImg/hundai.jpeg', 'Hyundai example, start price at RM1000, super offer, bid now and save ur money.', 1000, '2011-09-12 13:44', 9, 0, 10, 1);
INSERT INTO `item` VALUES(22, 'Nissan Cefiro 2.5', 'asset/itemImg/nissan.jpeg', 'Description:\r\nGreat Deal!\r\n\r\n* Genuine Dealer\r\n* High Trade In\r\n* Tip Top Condition\r\n* Well Maintained\r\n* Nice Interior\r\n* Special Promotion, \r\n* Ready Stock\r\n* Test Drive Available\r\n* Attractive Loan Package \r\n* Fast Loan, Low Interest\r\n\r\nWhat are You Waiting For? Do not Miss Out on This\r\nAmazing Offer!', 2000, '2011-09-12 15:13', 9, 0, 5, 0);
INSERT INTO `item` VALUES(23, 'Nissan Cefiro ', 'asset/itemImg/Nissan Cefiro 2.0 V6 Auto Excimo 2003.jpeg', 'Description:\r\nPrice : RM 49 800	\r\nMake: Nissan\r\nModel: Cefiro\r\nReg. year: 2003\r\nTransmission: Auto\r\nEngine Capacity: 2000 cc\r\nAccessories: Airbag driver, Airbag passenger, ABS\r\nBrakes, Sport rims, Alarm, Central lock\r\n', 3000, '2011-09-12 15:11', 9, 0, 5, 7);
INSERT INTO `item` VALUES(24, 'kia forte', 'asset/itemImg/kia forte.jpeg', 'Nice Car Good Service!! Model:	Forte, Variant:1.6L DOHC CVVT EX (A), Year: 2011', 4000, '2011-09-12 15:17', 9, 0, 9, 0);
INSERT INTO `item` VALUES(25, 'Latitude E6410 Laptop Business-Class 14.1-Inch Laptop', 'asset/itemImg/Latitude E6410 Laptop.png', 'Designed to increase productivity while reducing total cost of ownership, the Dellâ„¢ Latitudeâ„¢ E6410 laptop features dramatic advancements in durability, security and mobile collaboration.\r\n\r\nCentrally manageable with advanced security features\r\nGlobally available compatibility with Latitude E-Family product portfolio', 1200, '2011-09-16 16:06', 11, 1, 1, 0);
INSERT INTO `item` VALUES(26, 'iphone 4 32gb', 'asset/itemImg/iphone.jpeg', 'FaceTime. Video calling is a reality.\r\nSee family and friends while you talk to them. No other phone makes staying in touch so much fun.\r\nLearn more about FaceTime\r\n\r\nRetina display. 960 by 640 by Wow.\r\nWith a remarkable 960-by-640 resolution in a 3.5-inch screen, text and graphics look unbelievably crisp and sharp.\r\nLearn more about the Retina display\r\n\r\nHD video recording.\r\nLife looks better in HD.\r\niPhone 4 lets you record and edit stunning HD video. So itâ€™s the only phone â€” and camera â€” you need to carry with you.\r\nLearn more about HD video recording\r\n\r\n5-megapixel camera. Never miss a photo opportunity.\r\nTake beautiful, detailed photos using the 5-megapixel camera with built-in LED flash.', 500, '2011-09-12 17:21', 14, 0, 1, 7);
INSERT INTO `item` VALUES(27, 'Charles-Hubert, Paris Stainless Steel Mechanical Pocket Watch', 'asset/itemImg/51eIGLLgmWL.jpg', 'The Charles-Hubert, Paris Stainless Steel Mechanical Pocket Watch is a throwback to the era of elegant, fine-crafted pocket watches. The beautiful timepiece features a demi-hunter case made from polished stainless steel that opens with a simple push of the crown. Inside the case, the semi-exposed, skeleton dial displays the inner mechanics along with handsome, black-toned Roman numeral indexes. However, you can still tell time with the case closed--the demi-hunter case allows you to see the watch hands and there are finely-etched Roman numeral indexes on the outside of the case. The Charles-Hubert, Paris Stainless Steel Mechanical Pocket Watch comes with a matching, stainless steel curb chain and a deluxe gift box and is powered by 17-jewel mechanical movement.', 184.95, '2011-09-12 21:42', 23, 0, 11, 5);
INSERT INTO `item` VALUES(28, 'HTC flyer', 'asset/itemImg/htcflyer.png', 'A tablet like no other\r\nHTC Flyer is a portable 7-inch tablet with a magic pen that can do more for you than you can imagine. From creating masterpieces with a stroke of a paintbrush, to taking multimedia notes or even signing digital documents, HTC Flyer puts you in control of any situation. With streaming movies at a touch of your finger, HTC Flyer turns any moment into something special.', 350, '2011-09-21 08:10', 14, 1, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES(1, 'dev', 'devlim', 'me@me.com', '8888');
INSERT INTO `user` VALUES(5, 'devlim', 'lim', 'lim@lim.com', '88888');
INSERT INTO `user` VALUES(7, 'don', 'donknow', 'don@don.com', 'dondon');
INSERT INTO `user` VALUES(9, 'bito', 'bitoke', 'bitoke@gmail.com', '88888');
INSERT INTO `user` VALUES(10, 'try', 'tryMe', 'tryme@me.com', '88888');
INSERT INTO `user` VALUES(11, 'devo', 'devo', 'devo@gmail.com', '88888');
