-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2017 at 11:02 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

DROP TABLE IF EXISTS `cart_product`;
CREATE TABLE IF NOT EXISTS `cart_product` (
  `product_id` int(10) NOT NULL,
  `userid` varchar(12) NOT NULL,
  `product_quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `product_rating` decimal(3,2) DEFAULT NULL,
  `product_tag` varchar(150) DEFAULT NULL,
  `product_stockQty` int(11) DEFAULT NULL,
  `product_qtyOnHold` int(11) NOT NULL,
  `product_quantity_sold` int(50) DEFAULT NULL,
  `product_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

DROP TABLE IF EXISTS `user_transactions`;
CREATE TABLE IF NOT EXISTS `user_transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `date_paid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD KEY `userid` (`userid`),
  ADD KEY `product_id` (`product_id`) USING BTREE;

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `cart_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `cart_product_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `account` (`userid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
