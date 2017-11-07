-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2017 at 01:58 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deallocrafthouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `userid` varchar(12) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`userid`, `email`, `password`) VALUES
('Pawlice', '100061722@students.swinburne.edu.my', 'lagoon96');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_desc` varchar(750) NOT NULL,
  `product_weight` decimal(10,2) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_shipping` varchar(200) DEFAULT NULL,
  `product_policy` varchar(500) NOT NULL,
  `product_rating` decimal(3,2) DEFAULT NULL,
  `product_tag` varchar(150) DEFAULT NULL,
  `product_stockQty` int(11) DEFAULT NULL,
  `product_quantity_sold` int(50) DEFAULT NULL,
  `product_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_category`, `product_name`, `product_desc`, `product_weight`, `product_price`, `product_shipping`, `product_policy`, `product_rating`, `product_tag`, `product_stockQty`, `product_quantity_sold`, `product_date_created`, `approved`) VALUES
(1, 5, 'Fox Plushies', 'A very cute and lovable fox plushy! It\'s so cute and fluffy!\nBuy one today.', '0.21', '6.21', NULL, 'No refunds will be provided. Shipping is included to furries ;33', NULL, 'fox plush', 6, NULL, '2017-11-07 04:04:34', 0),
(2, 6, 'Husky & Lynx Photos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit ess', '0.05', '5.00', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim ve', NULL, 'photo artwork husky lynx', 3, NULL, '2017-11-07 04:08:34', 0),
(3, 3, 'Boxsona', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit ess', '12.15', '24.99', NULL, 'Lorem ipsum dolor sit amet, cons', NULL, 'boxsona', 1, NULL, '2017-11-07 04:10:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `review_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `userid` varchar(12) NOT NULL,
  `product_rating` int(1) NOT NULL,
  `review_desc` varchar(500) NOT NULL,
  `review_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_variation`
--

CREATE TABLE `product_variation` (
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

CREATE TABLE `transaction_products` (
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_products`
--

INSERT INTO `transaction_products` (`transaction_id`, `product_id`, `quantity`, `price`) VALUES
(1, 2, 1, '5.00'),
(1, 3, 1, '24.99'),
(2, 1, 1, '6.21');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
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
('Pawlice', 'Eugene Chiang', 'm', 'MY', '+600165256911', 'Kuching, Sarawak', 93100);

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE `user_transactions` (
  `transaction_id` int(11) NOT NULL,
  `userid` varchar(12) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `date_paid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`transaction_id`, `userid`, `total_amount`, `date_paid`) VALUES
(1, 'Pawlice', '29.99', '2017-11-07 20:38:03'),
(2, 'Pawlice', '6.21', '2017-11-07 20:39:37');

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
-- Indexes for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `transaction_products`
--
ALTER TABLE `transaction_products`
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `product_id` (`product_id`);

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
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction_products`
--
ALTER TABLE `transaction_products`
  ADD CONSTRAINT `transaction_products_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `user_transactions` (`transaction_id`),
  ADD CONSTRAINT `transaction_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD CONSTRAINT `user_transactions_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `account` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
