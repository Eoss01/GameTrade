-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-11-16 02:47:57
-- 服务器版本： 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `adminEmail`, `adminName`, `password`, `creationDate`) VALUES
(1, 'admin@admin.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2018-11-11 08:41:19'),
(4, 'eoss01@outlook.com', 'eoss01', '25f9e794323b453885f5181f1b624d0b', '2018-10-09 00:47:23');

-- --------------------------------------------------------

--
-- 表的结构 `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text CHARACTER SET utf8 NOT NULL,
  `brand_desc` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lastest_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`, `brand_desc`, `lastest_edited`) VALUES
(1, 'Xbox', 'Xbox is a video gaming brand created and owned by Microsoft.', '2018-07-09 15:23:20'),
(2, 'PS4', 'The PlayStation 4 (PS4) is the latest video game console from Sony Computer Entertainment announced at a press conference on February 20, 2013.', '2018-07-09 15:23:20'),
(3, 'PS3', 'PlayStation 3 is a seventh generation game console from Sony. ', '2018-07-09 15:23:20'),
(4, 'NDS', 'The Nintendo DS,or simply DS, is a dual-screen handheld game console developed and released by Nintendo.', '2018-07-09 15:23:20'),
(5, 'PC', 'PC games, also known as computer games or personal computer games, are video games played on a personal computer rather than a dedicated video game console or arcade machine. ', '2018-07-09 15:23:20'),
(6, 'PS2', 'The PlayStation 2 (PS2) is a home video game console that was developed by Sony Computer Entertainment. ', '2018-11-12 12:37:38');

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `user_id`, `qty`) VALUES
(1, 3, '127.0.0.1', -1, 1),
(7, 3, '::1', 3, 1),
(12, 5, '::1', 10, 1);

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` text CHARACTER SET utf8 NOT NULL,
  `cat_desc` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lastest_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_desc`, `lastest_edited`) VALUES
(1, 'Action', 'hihi', '2018-09-25 03:07:54'),
(2, 'Simulations', 'These games involve taking control of real-world vehicles, including tanks, ships, and aircraft. ', '2018-07-09 15:23:44'),
(3, 'Combat', 'Fight one on one with opponents, up close and personal. ', '2018-07-09 15:23:44'),
(4, 'First Person Shooters ', 'You are the protagonist, and the game is viewed through your eyes. ', '2018-07-09 15:23:44'),
(5, 'Sports', 'Play real-world sports like baseball, basketball, soccer, and more. ', '2018-07-09 15:23:44'),
(6, 'Role-Playing', 'If you love fantasy, you will love role-playing games. ', '2018-07-09 15:23:44'),
(7, 'Adventure', 'These are usually single player games, and are often set in fantasy or adventure world.', '2018-07-09 15:23:44'),
(8, 'Third Person Shooter', 'Third-person shooter (TPS) is a subgenre of 3D shooter games in which the player character is visible on-screen during gaming, and the gameplay consists primarily of shooting.', '2018-11-12 12:33:58');

-- --------------------------------------------------------

--
-- 表的结构 `exchange_request`
--

CREATE TABLE `exchange_request` (
  `exchange_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exchanger_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `eproduct_id` int(11) NOT NULL,
  `eproduct_title` varchar(255) NOT NULL,
  `eproduct_image` text NOT NULL,
  `status_detail` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `exchange_request`
--

INSERT INTO `exchange_request` (`exchange_id`, `user_id`, `exchanger_id`, `product_id`, `product_title`, `product_image`, `eproduct_id`, `eproduct_title`, `eproduct_image`, `status_detail`, `request_date`) VALUES
(3, 1, 9, 21, 'NBA', '02f3a5ec4bce7076943714353c74a42e0b090103db1dc5a768aabddaf1e07534 1.jpg', 3, 'Grand Theft Auto V PS3', 'GTA PS3.jpg', 2, '2018-11-15 15:27:31'),
(4, 9, 1, 7, 'The Sims 4 PS4', 'The Sims 4 PS4.jpg', 20, 'Red Dead Redemption 2 Can Exchange Oh', 'Amboseli NP, Kenya 1920x1080.jpg', 1, '2018-11-15 11:15:01');

-- --------------------------------------------------------

--
-- 表的结构 `item_rating`
--

CREATE TABLE `item_rating` (
  `ratingId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ratingNumber` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Block, 0 = Unblock'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `item_rating`
--

INSERT INTO `item_rating` (`ratingId`, `itemId`, `userId`, `username`, `ratingNumber`, `title`, `comments`, `created`, `modified`, `status`) VALUES
(1, 1, 1, 'Rizwan', 5, 'hihi', 'fqavqvqv', '2018-09-24 20:17:15', '2018-09-30 11:05:58', 1),
(4, 1, 3, 'eoss', 2, 'vsbdb', 'dbsbsbdfncd', '2018-09-25 02:31:31', '2018-09-30 11:06:01', 1),
(5, 2, 3, 'eoss', 5, 'q', 'gbfbf', '2018-09-29 10:27:06', '2018-09-30 11:06:03', 1),
(6, 3, 3, 'eoss', 3, 'fbdb', 'nbfdn d', '2018-09-29 10:34:38', '2018-09-30 11:06:05', 1),
(7, 1, 3, 'eoss', 1, 'fbdb', 'gjngdn', '2018-09-29 12:27:47', '2018-09-30 11:06:07', 1),
(8, 4, 3, 'eoss', 5, 'hihi', 'vsijvsnvisnvsvn', '2018-09-30 05:06:35', '2018-09-30 05:06:35', 1),
(9, 4, 1, 'Rizwan', 1, 'svvsvwv', 'wrwenbnwn w', '2018-09-30 05:06:58', '2018-09-30 05:06:58', 1),
(10, 1, 2, 'Rizwan', 5, 'ooooo', 'v ab nabma', '2018-09-30 05:18:34', '2018-09-30 05:18:34', 1),
(11, 3, 1, 'Rizwan', 4, 'fbdb', 'bjvjuvu', '2018-11-11 01:18:51', '2018-11-11 01:18:51', 1),
(13, 3, 9, 'Customer', 5, 'good job', 'good product', '2018-11-11 01:37:33', '2018-11-11 01:37:33', 1),
(14, 20, 1, 'Rizwan', 5, 'Good', 'good product', '2018-11-13 00:23:38', '2018-11-13 00:23:38', 1);

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `trx_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `p_status` varchar(20) CHARACTER SET utf8 NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `qty`, `trx_id`, `p_status`, `creation_date`) VALUES
(1, 2, 7, 1, '07M47684BS5725041', 'Completed', '2018-11-12 14:04:50'),
(2, 2, 16, 1, '07M47684BS5725041', 'Completed', '2018-11-12 14:04:50');

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_bprice` int(100) NOT NULL,
  `product_rentprice` int(255) NOT NULL,
  `product_desc` text CHARACTER SET utf8 NOT NULL,
  `product_image` text CHARACTER SET utf8 NOT NULL,
  `product_quantity` int(255) NOT NULL,
  `product_stype` varchar(255) CHARACTER SET utf8 NOT NULL,
  `product_keywords` text CHARACTER SET utf16 NOT NULL,
  `lastest_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`product_id`, `user_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_bprice`, `product_rentprice`, `product_desc`, `product_image`, `product_quantity`, `product_stype`, `product_keywords`, `lastest_edited`) VALUES
(3, 9, 1, 3, 'Grand Theft Auto V PS3', 1000, 2000, 12, 'PSGrand Theft Auto V PS3', 'GTA PS3.jpg', 60, 'Sales, Rent and Exchange', 'GTA5 PS3', '2018-11-16 00:50:15'),
(4, 9, 1, 5, 'Grand Theft Auto V PC', 1000, 2000, 0, 'Grand Theft Auto V PC', 'GTA PC.jpg', 80, 'Sales Only', 'GTA5 PC', '2018-11-13 07:42:24'),
(5, 9, 6, 2, 'The Elder Scrolls V: Skyrim', 1000, 2000, 4, 'The Elder Scrolls V: Skyrim Special Edition', 'Skyrim PS4.jpg', 20, 'Sales and Rent', 'The Elder Scrolls V: Skyrim PC', '2018-11-16 01:41:16'),
(6, 9, 3, 2, 'Tekken 7 Deluxe Edition ', 1000, 2000, 6, 'Tekken 7 Deluxe Edition ', 'Tekken 7 Deluxe Edition.jpg', 20, 'Sales, Rent and Exchange', 'Tekken 7 PS4', '2018-11-16 00:54:36'),
(7, 9, 2, 2, 'The Sims 4 PS4', 1000, 2000, 0, 'The Sims 4 PS4', 'The Sims 4 PS4.jpg', 40, 'Sales Only', 'The Sims 4 PC', '2018-11-13 07:44:05'),
(15, 9, 2, 5, 'The Sims 4 PC', 1000, 2000, 5, 'The Sims 4 PC', 'The Sims 4 PC.jpg', 58, 'Sales and Rent', 'The Sims 4 PS4', '2018-11-16 01:31:23'),
(16, 9, 5, 2, 'FIFA 18 PS4', 1000, 2000, 10, 'FIFA 18 PS4', 'FIFA 18 PS4.jpg', 70, 'Sales, Rent and Exchange', 'FIFA 18 PS4', '2018-11-16 00:54:49'),
(17, 9, 5, 5, 'FIFA 18 PC', 1000, 2000, 6, 'FIFA 18 PC', 'FIFA 18 PC.png', 38, 'Sales and Rent', 'FIFA 18 PC', '2018-11-16 00:54:55'),
(19, 9, 8, 2, 'Red Dead Redemption 2', 240, 350, 9, 'Red Dead Redemption 2', 'rdr2-fob-ps4-eng.jpg', 50, 'Sales, Rent and Exchange', 'Red Dead Redemption 2 PS4', '2018-11-16 00:55:00'),
(20, 1, 8, 2, 'Red Dead Redemption 2 Can Exchange Oh', 100, 350, 12, 'an action-adventure game developed and published by Rockstar Games. ', 'Amboseli NP, Kenya 1920x1080.jpg', 40, 'Sales, Rent and Exchange', 'Red Dead Redemption 2 PS4', '2018-11-16 01:41:12');

-- --------------------------------------------------------

--
-- 表的结构 `rent_request`
--

CREATE TABLE `rent_request` (
  `rent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `renter_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `rent_price` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `rent_status` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `rent_request`
--

INSERT INTO `rent_request` (`rent_id`, `user_id`, `renter_id`, `product_id`, `product_title`, `qty`, `rent_price`, `start_date`, `end_date`, `rent_status`, `request_date`) VALUES
(10, 9, 1, 6, 'Tekken 7 Deluxe Edition ', 1, 5, '2018-11-22', '2018-11-23', 1, '2018-11-16 01:19:43'),
(11, 9, 1, 15, 'The Sims 4 PC', 1, 105, '2018-11-30', '2018-12-21', 2, '2018-11-16 01:30:51'),
(13, 9, 0, 16, 'FIFA 18 PS4', 5, 400, '2018-11-16', '2018-11-24', 1, '2018-11-16 01:01:09');

-- --------------------------------------------------------

--
-- 表的结构 `status`
--

CREATE TABLE `status` (
  `status_id` int(20) NOT NULL,
  `status_detail` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `status`
--

INSERT INTO `status` (`status_id`, `status_detail`, `creation_date`) VALUES
(1, 'Pending by seller, Please wait.', '2018-11-15 03:13:19'),
(2, 'Your request have been Accepted! Please wait for the delivery.', '2018-11-13 02:06:25'),
(3, 'Your request have been Decline! Please try again.', '2018-11-09 01:15:11'),
(4, 'Successfully delivery.', '2018-11-13 02:06:04'),
(5, 'None', '2018-11-12 11:55:53');

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(300) CHARACTER SET utf8 NOT NULL,
  `password` varchar(300) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(10) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `note` varchar(255) CHARACTER SET utf8 NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address`, `note`, `regDate`) VALUES
(1, 'Rizwan', 'Khan', 'rizwankhan.august16@gmail.com', '25f9e794323b453885f5181f1b624d0b', '8389080183', 'No.47 Jalan Durian, Taman Rambutan 52 , 82000, Skudai johor', '', '2018-11-15 11:53:32'),
(2, 'Rizwan', 'Khan', 'rizwankhan.august16@yahoo.com', '25f9e794323b453885f5181f1b624d0b', '8389080183', 'No.47 Jalan Durian, Taman Rambutan 52 , 82000, Skudai johor', '', '2018-11-15 11:53:35'),
(3, 'eoss', 'olysits', 'eoss01@outlook.com', '25f9e794323b453885f5181f1b624d0b', '0167019490', 'No.47 Jalan Durian, Taman Rambutan 52 , 82000, Skudai johor', '278613658978691', '2018-11-15 11:53:38'),
(4, 'hihi', 'hihi', 'hihi@outlook.com', '25f9e794323b453885f5181f1b624d0b', '1234567890', 'No.47 Jalan Durian, Taman Rambutan 52 , 82000, Skudai johor', '', '2018-11-15 11:53:41'),
(7, 'hihi', 'hihi', 'hihi@gma.com', '25f9e794323b453885f5181f1b624d0b', '1234567890', 'No.47 Jalan Durian, Taman Rambutan 52 , 82000, Skudai johor', '', '2018-11-15 11:53:43'),
(8, 'okok', 'okok', 'okok@gmail.com', '25f9e794323b453885f5181f1b624d0b', '1234567890', 'No.47 Jalan Durian, Taman Rambutan 52 , 82000, Skudai johor', '', '2018-11-15 11:53:45'),
(9, 'Customer', 'Customers', 'customer@customer.com', '41d280f49cef01c5ae33eb28b4c3d699', '1234567890', 'No.47 Jalan Durian, Taman Rambutan 52 , 82000, Skudai johor', '', '2018-11-15 11:53:47'),
(10, 'okok', 'okok', 'okok@okok.com', '25f9e794323b453885f5181f1b624d0b', '1234567890', 'No 47 Jalan Kemuliaan 37', '', '2018-11-15 23:27:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `exchange_request`
--
ALTER TABLE `exchange_request`
  ADD PRIMARY KEY (`exchange_id`);

--
-- Indexes for table `item_rating`
--
ALTER TABLE `item_rating`
  ADD PRIMARY KEY (`ratingId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `rent_request`
--
ALTER TABLE `rent_request`
  ADD PRIMARY KEY (`rent_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用表AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `exchange_request`
--
ALTER TABLE `exchange_request`
  MODIFY `exchange_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `item_rating`
--
ALTER TABLE `item_rating`
  MODIFY `ratingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用表AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用表AUTO_INCREMENT `rent_request`
--
ALTER TABLE `rent_request`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
