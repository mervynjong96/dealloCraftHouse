-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2017 at 06:27 PM
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_desc` varchar(750) NOT NULL,
  `product_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_price` decimal(10,2) NOT NULL,
  `product_color` varchar(200) NOT NULL,
  `product_size` varchar(200) NOT NULL,
  `product_shipping` varchar(200) NOT NULL,
  `product_policy` varchar(200) NOT NULL,
  `product_rating` decimal(3,2) DEFAULT NULL,
  `product_tag` varchar(150) DEFAULT NULL,
  `product_image` varchar(500) DEFAULT NULL,
  `product_quantity_sold` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_desc`, `product_date_created`, `product_price`, `product_color`, `product_size`, `product_shipping`, `product_policy`, `product_rating`, `product_tag`, `product_image`, `product_quantity_sold`) VALUES
(1, 'Paperback 1', 'A cute fluffy companion to have some fun with! Please remember to visit http://foxesforsale.com for advice and tips on how to rear a fox.', '2017-10-11 06:53:16', '1500.00', 'Radiation Orange', 'Small (8.77lb)', 'Only available in Malaysia and Singapore.', 'No returns', '5.00', 'fox', 'assets/images/products/sample1.jpg', 5),
(2, 'Ice Cream Soda', 'buymebuymebuymebuyme', '2017-10-11 07:56:34', '100.25', 'must be grey', 'lol idk', 'only in my.', 'stuff', '5.00', 'husky', 'assets/images/products/sample2.jpg', 2),
(3, 'CAT CAKE', 'this is a lynx. it is the most annoying piece of cat in the world. dont buy, will not refund', '2017-10-11 07:58:54', '50.00', 'colorfull', 'M, L', 'Here', 'no polies', '1.50', 'lynx, evil', 'assets/images/products/sample3.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `review_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `userid` varchar(12) NOT NULL,
  `review_desc` varchar(500) NOT NULL,
  `review_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `product_review_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `account` (`userid`),
  ADD CONSTRAINT `product_review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
