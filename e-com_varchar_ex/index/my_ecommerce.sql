-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2026 at 07:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_order` int(20) NOT NULL,
  `total_price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `product_name`, `price`, `total_order`, `total_price`) VALUES
(1, 2, 'crayola', 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(20) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_name` text NOT NULL,
  `price` int(20) NOT NULL,
  `stocks` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_image`, `product_name`, `price`, `stocks`) VALUES
(2, 'salita.jpeg', 'crayola', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(20) NOT NULL,
  `product_image` blob NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `price` int(20) NOT NULL,
  `stocks` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_image`, `product_name`, `price`, `stocks`) VALUES
(2, '', 'lol', 20, -2);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `p_id` int(10) NOT NULL,
  `p_name` varchar(20) NOT NULL,
  `p_type` text NOT NULL,
  `ordered_by` text NOT NULL,
  `total_price` int(10) NOT NULL,
  `date_ordered` date NOT NULL,
  `received` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_received`
--

CREATE TABLE `product_received` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(20) NOT NULL,
  `p_type` text NOT NULL,
  `p_s/m` varchar(10) NOT NULL,
  `total_price` int(10) NOT NULL,
  `date_received` date NOT NULL,
  `received_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(20) NOT NULL,
  `p_type` text NOT NULL,
  `p_s/m` varchar(20) NOT NULL,
  `max` int(20) NOT NULL,
  `min` int(10) NOT NULL,
  `total_stock` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_interface`
--

CREATE TABLE `user_interface` (
  `user_id` int(10) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `user_contact_email` varchar(20) NOT NULL,
  `user_address` varchar(20) NOT NULL,
  `user_pass` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `product_received`
--
ALTER TABLE `product_received`
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `user_interface`
--
ALTER TABLE `user_interface`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product_table` (`p_id`);

--
-- Constraints for table `product_received`
--
ALTER TABLE `product_received`
  ADD CONSTRAINT `product_received_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product_table` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
