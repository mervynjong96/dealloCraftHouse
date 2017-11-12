-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2017 at 11:25 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deallocrafthouse`
--
CREATE DATABASE IF NOT EXISTS `deallocrafthouse` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `deallocrafthouse`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `userid` varchar(12) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`userid`, `email`, `password`) VALUES
('jason503', 'jctaurus503@gmail.com', 'jason503');

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

DROP TABLE IF EXISTS `cart_product`;
CREATE TABLE IF NOT EXISTS `cart_product` (
  `id` int(11) NOT NULL,
  `product_id` int(10) NOT NULL,
  `userid` varchar(12) NOT NULL,
  `product_quantity` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_desc` varchar(750) NOT NULL,
  `product_weight` decimal(10,2) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_policy` varchar(500) NOT NULL,
  `product_rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `product_tag` varchar(150) DEFAULT '',
  `product_stockQty` int(11) NOT NULL DEFAULT '0',
  `product_qtyOnHold` int(11) NOT NULL DEFAULT '0',
  `product_quantity_sold` int(11) NOT NULL DEFAULT '0',
  `product_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_category`, `product_name`, `product_desc`, `product_weight`, `product_price`, `product_policy`, `product_rating`, `product_tag`, `product_stockQty`, `product_qtyOnHold`, `product_quantity_sold`, `product_date_created`, `active`) VALUES
(1, 4, 'Diamond earrings', 'Shine bright like a diamond', '0.57', '580.00', '', '3.48', 'jewelry', 80, 0, 0, '2017-11-08 08:45:06', 1),
(2, 5, 'Super Mario Tanooki Soft Toy', 'Imported from Japan\r\nOfficially licensed product by Sanei\r\nMade from high-quality materials - rare, collectible and very cute\r\nLimited availability\r\nNew and sealed inside retail packaging', '4.60', '20.95', '', '4.87', 'toys', 45, 12, 3, '2017-11-08 08:49:28', 1),
(3, 7, 'Leondo Wedding Dress Veil Bridal Accessories Long 3M Ivory Veil Nocomb', 'Brand Name:Leondo Novia\r\nveil layer:One layer\r\ncomb:No\r\nLength:3m\r\nModel Number:LTS882\r\ncolor:Ivory', '0.38', '39.00', '', '4.00', 'wedding accessories', 30, 0, 0, '2017-11-08 09:00:54', 1),
(4, 6, 'Leonetto Cappiello Cognac Monnet Vintage Ad Art Print Poster - 24x36 Poster Print, 24x36', 'Decorate your home or office with high quality posters. Leonetto Cappiello Cognac Monnet Vintage Ad Art Print Poster - 24x36 is that perfect piece that matches your style, interests, and budget.', '4.00', '3.71', '', '3.66', 'vintage art', 50, 0, 0, '2017-11-08 09:05:39', 1),
(5, 3, '50 Pcs T2 Craft Paper Box Packing Box  ', 'Size: 19cm x 13cm x 3.5cm approx.\r\nMaterial: corrugated fiber board\r\nWidely used for packaging', '0.90', '36.90', '', '4.56', 'craft supplies', 1000, 0, 0, '2017-11-08 09:11:25', 1),
(6, 2, 'Modern Fashion Non-woven Wallpaper 3D Striped Wallpapers for Living Room Bedding Room (53CM * 1000CM) (Blue)  ', 'Size: 1000cm * 53cm\r\nColor: Blue\r\nMaterial: Environmental Natural Non-woven\r\nBeautiful visual perception\r\nFunction:Waterproof, Moisture-Proof, Mould-Proof, Smoke-Proof, Fireproof, Soundproof, Sound-Absorbing, Heat Insulation, Anti-static', '0.95', '88.50', '', '2.55', 'bedding/room décor', 65, 0, 0, '2017-11-08 09:15:26', 1),
(7, 1, 'Baby Boys Girls Infant Newborn Lovely Smile Face Cute Hats Spring Cotton Caps  ', 'Material: Cotton\r\nFor: Boys Girls\r\nSeason: Summer Spring\r\nPattern: Smile face\r\nQuality: High', '0.15', '16.50', '', '4.00', 'clothing & accessories', 30, 0, 0, '2017-11-08 09:20:02', 1),
(8, 4, 'Jewelry', 'Jewelry that shine bright like a diamond', '3.00', '39.90', 'No refund', '0.00', '', 13, 0, 0, '2017-11-09 14:51:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

DROP TABLE IF EXISTS `product_review`;
CREATE TABLE IF NOT EXISTS `product_review` (
  `review_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `userid` varchar(12) NOT NULL,
  `product_rating` int(1) NOT NULL,
  `review_desc` varchar(500) NOT NULL,
  `review_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_seller`
--

DROP TABLE IF EXISTS `product_seller`;
CREATE TABLE IF NOT EXISTS `product_seller` (
  `product_id` int(50) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_seller`
--

INSERT INTO `product_seller` (`product_id`, `userid`, `created_at`, `updated_at`) VALUES
(1, 'jong96', '2017-11-12 18:09:35', NULL),
(8, 'jason503', '2017-11-09 22:51:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variation`
--

DROP TABLE IF EXISTS `product_variation`;
CREATE TABLE IF NOT EXISTS `product_variation` (
  `product_id` int(11) NOT NULL,
  `size_1` varchar(100) DEFAULT NULL,
  `color_1` varchar(11) DEFAULT NULL,
  `stockQty_1` int(11) DEFAULT NULL,
  `size_2` varchar(100) DEFAULT NULL,
  `color_2` varchar(11) DEFAULT NULL,
  `stockQty_2` int(11) DEFAULT NULL,
  `size_3` varchar(100) DEFAULT NULL,
  `color_3` varchar(11) DEFAULT NULL,
  `stockQty_3` int(11) DEFAULT NULL,
  `size_4` varchar(100) DEFAULT NULL,
  `color_4` varchar(11) DEFAULT NULL,
  `stockQty_4` int(11) DEFAULT NULL,
  `size_5` varchar(100) DEFAULT NULL,
  `color_5` varchar(11) DEFAULT NULL,
  `stockQty_5` int(11) DEFAULT NULL,
  `size_6` varchar(100) DEFAULT NULL,
  `color_6` varchar(11) DEFAULT NULL,
  `stockQty_6` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_products`
--

DROP TABLE IF EXISTS `transaction_products`;
CREATE TABLE IF NOT EXISTS `transaction_products` (
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_products`
--

INSERT INTO `transaction_products` (`transaction_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 3, '3.00'),
(2, 1, 2, '3.00'),
(3, 2, 3, '20.95');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE IF NOT EXISTS `userinfo` (
  `userid` varchar(12) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `country` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `shipping_address` varchar(256) NOT NULL,
  `postcode` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userid`, `name`, `gender`, `country`, `contact_number`, `shipping_address`, `postcode`) VALUES
('jason503', 'Jason Chan', 'm', 'Malaysia', '0127986432', 'Lot 123, Golden Street, Silver Town', 15992);

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

DROP TABLE IF EXISTS `user_transactions`;
CREATE TABLE IF NOT EXISTS `user_transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `date_paid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`transaction_id`, `user_id`, `total_amount`, `date_paid`) VALUES
(1, 'jong96', '9.00', '2017-11-12 18:11:06'),
(2, 'jong123', '6.00', '2017-11-12 18:16:15'),
(3, 'jason503', '62.85', '2017-11-12 18:24:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `product_id` (`product_id`) USING BTREE;

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_seller`
--
ALTER TABLE `product_seller`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indexes for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
