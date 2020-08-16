-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-06-25 17:13:51
-- 服务器版本： 10.1.31-MariaDB
-- PHP Version: 7.2.4

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
  `adminName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `adminName`, `password`, `creationDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2018-06-23 11:24:44'),
(4, 'eoss01', '25f9e794323b453885f5181f1b624d0b', '2018-06-23 14:20:10');

-- --------------------------------------------------------

--
-- 表的结构 `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL,
  `brand_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`, `brand_desc`) VALUES
(1, 'Xbox', 'Xbox is a video gaming brand created and owned by Microsoft.'),
(2, 'PS4', 'The PlayStation 4 (PS4) is the latest video game console from Sony Computer Entertainment announced at a press conference on February 20, 2013.'),
(3, 'PS3', 'PlayStation 3 is a seventh generation game console from Sony. '),
(4, 'NDS', 'The Nintendo DS,or simply DS, is a dual-screen handheld game console developed and released by Nintendo.'),
(5, 'PC', 'PC games, also known as computer games or personal computer games, are video games played on a personal computer rather than a dedicated video game console or arcade machine. ');

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL,
  `cat_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_desc`) VALUES
(1, 'Action', 'You need to be fast to enjoy these fast-paced games, and you need to have excellent reflexes. '),
(2, 'Simulations', 'These games involve taking control of real-world vehicles, including tanks, ships, and aircraft. '),
(3, 'Combat', 'Fight one on one with opponents, up close and personal. '),
(4, 'First Person Shooters ', 'You are the protagonist, and the game is viewed through your eyes. '),
(5, 'Sports', 'Play real-world sports like baseball, basketball, soccer, and more. '),
(6, 'Role-Playing', 'If you love fantasy, you will love role-playing games. '),
(7, 'Adventure', 'These are usually single player games, and are often set in fantasy or adventure worlds.');

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES
(1, 1, 1, 'Grand Theft Auto V XBOX', 1000, 'Grand Theft Auto V is an action-adventure video game developed by Rockstar North and published by Rockstar Games.', 'GTA XBOX.jpg', 'GTA Grand Theft Auto V XBOX\r\n'),
(2, 1, 2, 'Grand Theft Auto V PS4', 1000, 'Grand Theft Auto V is an action-adventure video game developed by Rockstar North and published by Rockstar Games.', 'GTA V PS4.jpg', 'GTA Grand Theft Auto V PS4'),
(3, 1, 3, 'Grand Theft Auto V PS3', 1000, 'Grand Theft Auto V is an action-adventure video game developed by Rockstar North and published by Rockstar Games.', 'GTA PS3.jpg', 'GTA Grand Theft Auto V PS3'),
(4, 1, 5, 'Grand Theft Auto V PC', 1000, 'Grand Theft Auto V is an action-adventure video game developed by Rockstar North and published by Rockstar Games.', 'GTA PC.jpg', 'GTA Grand Theft Auto V PC');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactNo` bigint(11) NOT NULL,
  `address` longtext NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `contactNo`, `address`, `regDate`) VALUES
(1, 'eoss01', '25f9e794323b453885f5181f1b624d0b', 'eoss01@outlook.com', 13, '123', '2018-06-22 07:49:48'),
(8, 'nwncoc', '25f9e794323b453885f5181f1b624d0b', 'vsvsvsv@neo.com', 12345678912, 'nbdxndxndmn', '2018-06-23 14:13:09');

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
