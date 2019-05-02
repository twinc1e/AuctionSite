-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 02, 2019 at 07:42 PM
-- Server version: 5.5.50
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidHistory`
--

CREATE TABLE IF NOT EXISTS `bidHistory` (
  `item_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `bidhistory_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bidHistory`
--

INSERT INTO `bidHistory` (`item_id`, `user_id`, `price`, `bidhistory_id`) VALUES
(18, 7, 233, 47),
(18, 5, 222, 46),
(18, 5, 111, 45),
(17, 7, 340, 42),
(17, 1, 300, 41),
(17, 1, 299, 40),
(17, 5, 201, 39),
(17, 5, 200, 38),
(21, 9, 1111, 48),
(21, 1, 2300, 49),
(18, 5, 244, 50),
(23, 10, 3100, 51),
(23, 7, 3200, 52),
(23, 9, 3300, 53),
(23, 7, 3400, 54),
(23, 9, 3500, 55),
(23, 7, 3600, 56),
(26, 10, 501, 57),
(26, 7, 502, 58),
(25, 11, 1211, 59),
(27, 5, 185, 60),
(27, 7, 187, 61),
(27, 5, 189, 62),
(27, 7, 190, 63),
(27, 5, 191, 64),
(20, 9, 110, 65),
(20, 7, 111, 66),
(20, 7, 112, 67),
(28, 1, 352, 68),
(28, 7, 353, 69),
(28, 5, 355, 70),
(28, 1, 380, 71),
(28, 7, 390, 72),
(28, 5, 391, 73),
(28, 7, 392, 74),
(28, 5, 393, 75),
(28, 7, 394, 76),
(28, 11, 410, 77),
(29, 9, 1005, 78),
(29, 7, 2000, 79);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(4, 'Arts, Antiques & Collectibles'),
(5, 'Baby, Kids & Mum '),
(6, 'Beauty & Personal Care'),
(7, 'Books & Comics'),
(8, 'Camera & Camcorder '),
(9, 'Cars & Transport '),
(10, 'Clothing & Accessories'),
(11, 'Computer & Software'),
(12, 'Electronics & Appliances'),
(13, 'General & Misc '),
(14, 'Handphone & Communication '),
(15, 'Health & Medical'),
(16, 'Home & Gardening '),
(17, 'House & Property '),
(18, 'Jewellery, Gemstone, Accessori'),
(19, 'Movies & Video '),
(20, 'Music & Song'),
(21, 'Office Equipment'),
(22, 'Toys & Games'),
(23, 'Watches, Pens & Clocks');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `description` text NOT NULL,
  `initialprice` double NOT NULL,
  `endtime` char(20) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `winner` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `itemname`, `photo`, `description`, `initialprice`, `endtime`, `category_id`, `user_id`, `winner`) VALUES
(17, 'ipad2', '../../asset/itemImg/step0-ipad-gallery-image4.png', 'this is an ipad2, top rate tablet device of 2010 and 2011, ranking 4-5(full star) across top review website. Bid now start from just RM23.33 ringit!!!', 23.33, '2011-09-22 11:00', 12, 9, 7),
(18, 'imac', '../../asset/itemImg/imac.jpg', 'Imac, the one stop desktop for all ppl ranging from student to pro carrer worker, bid now start from RM100', 100, '2011-09-12 14:12', 12, 9, 5),
(19, 'Macbook Pro', '../../asset/itemImg/macbookpro.jpg', 'Macbook Pro, ur fav laptop and top ranking laptop since appple release macbook pro.', 88.88, '2011-10-12 03:14', 11, 5, 0),
(20, 'HTC Desire', '../../asset/itemImg/HTC_Desire_HD.png', 'HTC lastest phone, htc desire, bid price start from RM100 only, bid now before to late', 100, '2011-09-16 05:05', 14, 5, 7),
(21, 'Hyundai example', '../../asset/itemImg/hundai.jpeg', 'Hyundai example, start price at RM1000, super offer, bid now and save ur money.', 1000, '2011-09-12 13:44', 9, 10, 1),
(22, 'Nissan Cefiro 2.5', '../../asset/itemImg/nissan.jpeg', 'Description:\r\nGreat Deal!\r\n\r\n* Genuine Dealer\r\n* High Trade In\r\n* Tip Top Condition\r\n* Well Maintained\r\n* Nice Interior\r\n* Special Promotion, \r\n* Ready Stock\r\n* Test Drive Available\r\n* Attractive Loan Package \r\n* Fast Loan, Low Interest\r\n\r\nWhat are You Waiting For? Do not Miss Out on This\r\nAmazing Offer!', 2000, '2011-09-12 15:13', 9, 5, 0),
(23, 'Nissan Cefiro ', '../../asset/itemImg/Nissan Cefiro 2.0 V6 Auto Excimo 2003.jpeg', 'Description:\r\nPrice : RM 49 800	\r\nMake: Nissan\r\nModel: Cefiro\r\nReg. year: 2003\r\nTransmission: Auto\r\nEngine Capacity: 2000 cc\r\nAccessories: Airbag driver, Airbag passenger, ABS\r\nBrakes, Sport rims, Alarm, Central lock\r\n', 3000, '2011-09-12 15:11', 9, 5, 7),
(24, 'kia forte', '../../asset/itemImg/kia forte.jpeg', 'Nice Car Good Service!! Model:	Forte, Variant:1.6L DOHC CVVT EX (A), Year: 2011', 4000, '2011-09-12 15:17', 9, 9, 0),
(25, 'Latitude E6410 Laptop Business-Class 14.1-Inch Laptop', '../../asset/itemImg/Latitude E6410 Laptop.png', 'Designed to increase productivity while reducing total cost of ownership, the Dellâ„¢ Latitudeâ„¢ E6410 laptop features dramatic advancements in durability, security and mobile collaboration.\r\n\r\nCentrally manageable with advanced security features\r\nGlobally available compatibility with Latitude E-Family product portfolio', 1200, '2011-09-16 16:06', 11, 1, 11),
(26, 'iphone 4 32gb', '../../asset/itemImg/iphone.jpeg', 'FaceTime. Video calling is a reality.\r\nSee family and friends while you talk to them. No other phone makes staying in touch so much fun.\r\nLearn more about FaceTime\r\n\r\nRetina display. 960 by 640 by Wow.\r\nWith a remarkable 960-by-640 resolution in a 3.5-inch screen, text and graphics look unbelievably crisp and sharp.\r\nLearn more about the Retina display\r\n\r\nHD video recording.\r\nLife looks better in HD.\r\niPhone 4 lets you record and edit stunning HD video. So itâ€™s the only phone â€” and camera â€” you need to carry with you.\r\nLearn more about HD video recording\r\n\r\n5-megapixel camera. Never miss a photo opportunity.\r\nTake beautiful, detailed photos using the 5-megapixel camera with built-in LED flash.', 500, '2011-09-12 17:21', 14, 1, 7),
(27, 'Charles-Hubert, Paris Stainless Steel Mechanical Pocket Watch', '../../asset/itemImg/51eIGLLgmWL.jpg', 'The Charles-Hubert, Paris Stainless Steel Mechanical Pocket Watch is a throwback to the era of elegant, fine-crafted pocket watches. The beautiful timepiece features a demi-hunter case made from polished stainless steel that opens with a simple push of the crown. Inside the case, the semi-exposed, skeleton dial displays the inner mechanics along with handsome, black-toned Roman numeral indexes. However, you can still tell time with the case closed--the demi-hunter case allows you to see the watch hands and there are finely-etched Roman numeral indexes on the outside of the case. The Charles-Hubert, Paris Stainless Steel Mechanical Pocket Watch comes with a matching, stainless steel curb chain and a deluxe gift box and is powered by 17-jewel mechanical movement.', 184.95, '2011-09-12 21:42', 23, 11, 5),
(28, 'HTC flyer', '../../asset/itemImg/htcflyer.png', 'A tablet like no other\r\nHTC Flyer is a portable 7-inch tablet with a magic pen that can do more for you than you can imagine. From creating masterpieces with a stroke of a paintbrush, to taking multimedia notes or even signing digital documents, HTC Flyer puts you in control of any situation. With streaming movies at a touch of your finger, HTC Flyer turns any moment into something special.', 350, '2011-09-21 08:10', 14, 10, 11),
(29, 'Bed', '../../asset/itemImg/GEn5RRBrLnw.jpg', 'Bed under floor 1meter. With ledder. Cool bed. You need to buy. Call me, I makes you happy.', 1000, '2019-03-11 00:00', 4, 1, 7),
(30, 'tardis', '../../asset/itemImg/00iHy.jpg', 'TARDIS. Doctor Who. Serials. Little box outside, begger inside. Ohohoh. Fantaastiic!', 50, '2019-03-10 00:05', 4, 7, 0),
(0, '???????', '../../asset/itemImg/bob.png', 'sddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddds', 322, '2019-04-30 21:11', 4, 7, 0),
(0, '???????', '../../asset/itemImg/bob.png', 'jkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjkjk', 322, '2019-05-02 10:45', 22, 5, 0),
(0, 'kek', '../../asset/itemImg/bob.png', 'fgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfg', 322, '2019-05-03 11:11', 22, 5, 0),
(0, '???????', '../../asset/itemImg/bob.png', 'dssssssssssssssssssdsssssssssssssssssdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsd', 322, '2019-05-02 19:53', 22, 1, 0),
(0, '???????', '../../asset/itemImg/bob.png', '????????????????????????????????????????????????????????????????????????????????????????', 322, '2019-05-02 19:29', 4, 1, 0),
(0, '???????', '../../asset/itemImg/bob.png', '????????????????????????????????????????????????????????????????????????????????', 322, '2019-05-02 21:32', 22, 1, 0),
(222, '111', '', '?????????????????????????????????????????????????????????????????????????????????????', 322, NULL, 0, 0, 0),
(222, '111', '', '?????????????????????????????????????????????????????????????????????????????????????', 322, NULL, 1, 0, 0),
(0, 'Джамиль', '../../asset/itemImg/bogomol33.jpg', 'вававававававававававававававававававававававававававававававававававававававава', 322, '2019-05-03 03:33', 22, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `permission` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `name`, `email`, `password`, `permission`) VALUES
(1, 'dev', 'devlim', 'me@me.com', 'devdev', 2),
(5, 'devlim', 'lim', 'lim@lim.com', '1234', 1),
(7, 'don', 'donknow', 'don@don.com', 'dondon', 0),
(9, 'bito', 'bitoke', 'bitoke@gmail.com', 'bit', 0),
(10, 'try', 'tryMe', 'tryme@me.com', 'try', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidHistory`
--
ALTER TABLE `bidHistory`
  ADD PRIMARY KEY (`bidhistory_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidHistory`
--
ALTER TABLE `bidHistory`
  MODIFY `bidhistory_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=80;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
