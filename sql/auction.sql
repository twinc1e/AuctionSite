-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 06 2019 г., 20:59
-- Версия сервера: 5.7.20
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `auction`
--
CREATE DATABASE IF NOT EXISTS `auction` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `auction`;

-- --------------------------------------------------------

--
-- Структура таблицы `bidHistory`
--

DROP TABLE IF EXISTS `bidHistory`;
CREATE TABLE IF NOT EXISTS `bidHistory` (
  `bidhistory_id` int(11) NOT NULL AUTO_INCREMENT,
  `price` double NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`bidhistory_id`),
  KEY `item_id` (`item_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `bidHistory`
--

TRUNCATE TABLE `bidHistory`;
--
-- Дамп данных таблицы `bidHistory`
--

INSERT IGNORE INTO `bidHistory` (`bidhistory_id`, `price`, `item_id`, `user_id`) VALUES
(38, 200, 17, 3),
(39, 201, 17, 5),
(40, 299, 17, 3),
(41, 300, 17, 1),
(42, 340, 17, 3),
(45, 111, 18, 5),
(46, 222, 18, 5),
(47, 233, 18, 3),
(48, 1111, 21, 4),
(49, 2300, 21, 1),
(50, 244, 18, 5),
(51, 3100, 23, 4),
(52, 3200, 23, 3),
(53, 3300, 23, 5),
(54, 3400, 23, 3),
(55, 3500, 23, 5),
(56, 3600, 23, 3),
(57, 501, 26, 4),
(58, 502, 26, 3),
(59, 1211, 25, 4),
(60, 185, 27, 5),
(61, 187, 27, 3),
(62, 189, 27, 5),
(63, 190, 27, 3),
(64, 191, 27, 5),
(65, 110, 20, 4),
(66, 111, 20, 3),
(67, 112, 20, 3),
(68, 352, 28, 1),
(69, 353, 28, 3),
(70, 355, 28, 5),
(71, 380, 28, 1),
(72, 390, 28, 3),
(73, 391, 28, 5),
(74, 392, 28, 3),
(75, 393, 28, 5),
(76, 394, 28, 3),
(77, 410, 28, 4),
(78, 1005, 29, 4),
(79, 2000, 29, 3),
(80, 60, 30, 4),
(81, 70, 30, 5),
(82, 70, 30, 5),
(83, 80, 30, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `category`
--

TRUNCATE TABLE `category`;
--
-- Дамп данных таблицы `category`
--

INSERT IGNORE INTO `category` (`category_id`, `category_name`) VALUES
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
-- Структура таблицы `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `itemname` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `description` text NOT NULL,
  `initialprice` double NOT NULL,
  `endtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `winner` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `item`
--

TRUNCATE TABLE `item`;
--
-- Дамп данных таблицы `item`
--

INSERT IGNORE INTO `item` (`item_id`, `itemname`, `photo`, `description`, `initialprice`, `endtime`, `category_id`, `user_id`, `winner`) VALUES
(17, 'ipad2', '../../asset/itemImg/step0-ipad-gallery-image4.png', 'this is an ipad2, top rate tablet device of 2010 and 2011, ranking 4-5(full star) across top review website. Bid now start from just RM23.33 ringit!!!', 23.33, '2019-03-22 11:00:00', 12, 2, 3),
(18, 'imac', '../../asset/itemImg/imac.jpg', 'Imac, the one stop desktop for all ppl ranging from student to pro carrer worker, bid now start from RM100', 100, '2019-03-12 14:12:00', 12, 2, 5),
(19, 'Macbook Pro', '../../asset/itemImg/macbookpro.jpg', 'Macbook Pro, ur fav laptop and top ranking laptop since appple release macbook pro.', 88.88, '2019-03-12 03:14:00', 11, 2, 0),
(20, 'HTC Desire', '../../asset/itemImg/HTC_Desire_HD.png', 'HTC lastest phone, htc desire, bid price start from RM100 only, bid now before to late', 100, '2019-03-16 05:05:00', 14, 2, 3),
(21, 'Hyundai example', '../../asset/itemImg/hundai.jpeg', 'Hyundai example, start price at RM1000, super offer, bid now and save ur money.', 1000, '2019-03-12 13:44:00', 9, 2, 1),
(22, 'Nissan Cefiro 2.5', '../../asset/itemImg/nissan.jpeg', 'Description:\r\nGreat Deal!\r\n\r\n* Genuine Dealer\r\n* High Trade In\r\n* Tip Top Condition\r\n* Well Maintained\r\n* Nice Interior\r\n* Special Promotion, \r\n* Ready Stock\r\n* Test Drive Available\r\n* Attractive Loan Package \r\n* Fast Loan, Low Interest\r\n\r\nWhat are You Waiting For? Do not Miss Out on This\r\nAmazing Offer!', 2000, '2019-03-12 15:13:00', 9, 2, 0),
(23, 'Nissan Cefiro ', '../../asset/itemImg/Nissan Cefiro 2.0 V6 Auto Excimo 2003.jpeg', 'Description:\r\nPrice : RM 49 800	\r\nMake: Nissan\r\nModel: Cefiro\r\nReg. year: 2003\r\nTransmission: Auto\r\nEngine Capacity: 2000 cc\r\nAccessories: Airbag driver, Airbag passenger, ABS\r\nBrakes, Sport rims, Alarm, Central lock\r\n', 3000, '2019-03-12 15:11:00', 9, 2, 3),
(24, 'kia forte', '../../asset/itemImg/kia forte.jpeg', 'Nice Car Good Service!! Model:	Forte, Variant:1.6L DOHC CVVT EX (A), Year: 2011', 4000, '2019-03-12 15:17:00', 9, 2, 0),
(25, 'Latitude E6410 Laptop Business-Class 14.1-Inch Laptop', '../../asset/itemImg/Latitude E6410 Laptop.png', 'Designed to increase productivity while reducing total cost of ownership, the Dellâ„¢ Latitudeâ„¢ E6410 laptop features dramatic advancements in durability, security and mobile collaboration.\r\n\r\nCentrally manageable with advanced security features\r\nGlobally available compatibility with Latitude E-Family product portfolio', 1200, '2019-03-16 16:06:00', 11, 2, 4),
(26, 'iphone 4 32gb', '../../asset/itemImg/iphone.jpeg', 'FaceTime. Video calling is a reality.\r\nSee family and friends while you talk to them. No other phone makes staying in touch so much fun.\r\nLearn more about FaceTime\r\n\r\nRetina display. 960 by 640 by Wow.\r\nWith a remarkable 960-by-640 resolution in a 3.5-inch screen, text and graphics look unbelievably crisp and sharp.\r\nLearn more about the Retina display\r\n\r\nHD video recording.\r\nLife looks better in HD.\r\niPhone 4 lets you record and edit stunning HD video. So itâ€™s the only phone â€” and camera â€” you need to carry with you.\r\nLearn more about HD video recording\r\n\r\n5-megapixel camera. Never miss a photo opportunity.\r\nTake beautiful, detailed photos using the 5-megapixel camera with built-in LED flash.', 500, '2019-03-12 17:21:00', 14, 2, 3),
(27, 'Charles-Hubert, Paris Stainless Steel Mechanical Pocket Watch', '../../asset/itemImg/51eIGLLgmWL.jpg', 'The Charles-Hubert, Paris Stainless Steel Mechanical Pocket Watch is a throwback to the era of elegant, fine-crafted pocket watches. The beautiful timepiece features a demi-hunter case made from polished stainless steel that opens with a simple push of the crown. Inside the case, the semi-exposed, skeleton dial displays the inner mechanics along with handsome, black-toned Roman numeral indexes. However, you can still tell time with the case closed--the demi-hunter case allows you to see the watch hands and there are finely-etched Roman numeral indexes on the outside of the case. The Charles-Hubert, Paris Stainless Steel Mechanical Pocket Watch comes with a matching, stainless steel curb chain and a deluxe gift box and is powered by 17-jewel mechanical movement.', 184.95, '2019-03-12 21:42:00', 23, 2, 5),
(28, 'HTC flyer', '../../asset/itemImg/htcflyer.png', 'A tablet like no other\r\nHTC Flyer is a portable 7-inch tablet with a magic pen that can do more for you than you can imagine. From creating masterpieces with a stroke of a paintbrush, to taking multimedia notes or even signing digital documents, HTC Flyer puts you in control of any situation. With streaming movies at a touch of your finger, HTC Flyer turns any moment into something special.', 350, '2019-03-21 08:10:00', 14, 2, 4),
(29, 'Bed', '../../asset/itemImg/GEn5RRBrLnw.jpg', 'Bed under floor 1meter. With ledder. Cool bed. You need to buy. Call me, I makes you happy.', 1000, '2019-03-11 00:00:00', 4, 2, 3),
(30, 'tardis', '../../asset/itemImg/00iHy.jpg', 'TARDIS. Doctor Who. Serials. Little box outside, bigger inside. Ohohoh. Fantaastiic!', 50, '2019-06-10 00:05:00', 4, 2, 0),
(31, 'Book about success', '../../asset/itemImg/book.jpg', 'Keys to Success - 50 secrets from a Business Maverick by John Timpson.', 20, '2019-06-20 08:00:00', 7, 2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `permission` int(11) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `user`
--

TRUNCATE TABLE `user`;
--
-- Дамп данных таблицы `user`
--

INSERT IGNORE INTO `user` (`user_id`, `username`, `name`, `email`, `password`, `permission`) VALUES
(1, 'dev', 'devlim', 'me@me.com', 'devdev', 3),
(2, 'devlim', 'lim', 'lim@lim.com', '1234', 2),
(3, 'don', 'donknow', 'don@don.com', 'dondon', 1),
(4, 'bito', 'bitoke', 'nadusha_28_97@mail.com', 'bit', 1),
(5, 'try', 'tryMe', 'tryme@me.com', 'try', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
