-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2017 at 08:41 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

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
('jason503', 'jctaurus503@gmail.com', 'jason503');

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

CREATE TABLE `cart_product` (
  `id` int(11) NOT NULL,
  `product_id` int(10) NOT NULL,
  `userid` varchar(12) NOT NULL,
  `product_quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_product`
--

INSERT INTO `cart_product` (`id`, `product_id`, `userid`, `product_quantity`) VALUES
(7, 2, 'jason503', 3);

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
  `product_policy` varchar(500) NOT NULL,
  `product_rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `product_tag` varchar(150) DEFAULT '',
  `product_stockQty` int(11) NOT NULL DEFAULT '0',
  `product_qtyOnHold` int(11) NOT NULL DEFAULT '0',
  `product_quantity_sold` int(11) NOT NULL DEFAULT '0',
  `product_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_category`, `product_name`, `product_desc`, `product_weight`, `product_price`, `product_policy`, `product_rating`, `product_tag`, `product_stockQty`, `product_qtyOnHold`, `product_quantity_sold`, `product_date_created`, `active`) VALUES
(1, 4, 'Diamond earrings', 'Shine bright like a diamond', '0.57', '580.00', '', '3.48', 'jewelry', 80, 0, 0, '2017-11-08 08:45:06', 1),
(2, 5, 'Super Mario Tanooki Soft Toy', 'Imported from Japan\r\nOfficially licensed product by Sanei\r\nMade from high-quality materials - rare, collectible and very cute\r\nLimited availability\r\nNew and sealed inside retail packaging', '4.60', '20.95', '', '4.87', 'toys', 45, 15, 0, '2017-11-08 08:49:28', 1),
(3, 7, 'Leondo Wedding Dress Veil Bridal Accessories Long 3M Ivory Veil Nocomb', 'Brand Name:Leondo Novia\r\nveil layer:One layer\r\ncomb:No\r\nLength:3m\r\nModel Number:LTS882\r\ncolor:Ivory', '0.38', '39.00', '', '4.00', 'wedding accessories', 30, 0, 0, '2017-11-08 09:00:54', 1),
(4, 6, 'Leonetto Cappiello Cognac Monnet Vintage Ad Art Print Poster - 24x36 Poster Print, 24x36', 'Decorate your home or office with high quality posters. Leonetto Cappiello Cognac Monnet Vintage Ad Art Print Poster - 24x36 is that perfect piece that matches your style, interests, and budget.', '4.00', '3.71', '', '3.66', 'vintage art', 50, 0, 0, '2017-11-08 09:05:39', 1),
(5, 3, '50 Pcs T2 Craft Paper Box Packing Box  ', 'Size: 19cm x 13cm x 3.5cm approx.\r\nMaterial: corrugated fiber board\r\nWidely used for packaging', '0.90', '36.90', '', '4.56', 'craft supplies', 1000, 0, 0, '2017-11-08 09:11:25', 1),
(6, 2, 'Modern Fashion Non-woven Wallpaper 3D Striped Wallpapers for Living Room Bedding Room (53CM * 1000CM) (Blue)  ', 'Size: 1000cm * 53cm\r\nColor: Blue\r\nMaterial: Environmental Natural Non-woven\r\nBeautiful visual perception\r\nFunction:Waterproof, Moisture-Proof, Mould-Proof, Smoke-Proof, Fireproof, Soundproof, Sound-Absorbing, Heat Insulation, Anti-static', '0.95', '88.50', '', '2.55', 'bedding/room décor', 65, 0, 0, '2017-11-08 09:15:26', 1),
(7, 1, 'Baby Boys Girls Infant Newborn Lovely Smile Face Cute Hats Spring Cotton Caps  ', 'Material: Cotton\r\nFor: Boys Girls\r\nSeason: Summer Spring\r\nPattern: Smile face\r\nQuality: High', '0.15', '16.50', '', '4.00', 'clothing & accessories', 30, 0, 0, '2017-11-08 09:20:02', 1),
(8, 1, 'a', '1', '3.00', '3.00', '12', '0.00', '', 3, 0, 0, '2017-11-09 14:51:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_seller`
--

CREATE TABLE `product_seller` (
  `product_id` int(50) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_seller`
--

INSERT INTO `product_seller` (`product_id`, `userid`, `created_at`, `updated_at`) VALUES
(8, 'jason503', '2017-11-09 22:51:39', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE `user_transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
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
-- Indexes for table `product_seller`
--
ALTER TABLE `product_seller`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`),
  ADD KEY `userid` (`userid`);

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
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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

--
-- Constraints for table `product_seller`
--
ALTER TABLE `product_seller`
  ADD CONSTRAINT `product_seller_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `account` (`userid`),
  ADD CONSTRAINT `product_seller_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `transaction_products`
--
ALTER TABLE `transaction_products`
  ADD CONSTRAINT `transaction_products_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `user_transactions` (`transaction_id`),
  ADD CONSTRAINT `transaction_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `userinfo_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `account` (`userid`);

--
-- Constraints for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD CONSTRAINT `user_transactions_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_products` (`transaction_id`),
  ADD CONSTRAINT `user_transactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `account` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
