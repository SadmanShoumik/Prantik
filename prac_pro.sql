-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2021 at 02:57 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prac_pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `b_id` int(10) NOT NULL,
  `b_name` varchar(100) NOT NULL,
  `b_mail` varchar(100) NOT NULL,
  `b_pass` varchar(20) NOT NULL,
  `b_add` varchar(100) NOT NULL,
  `b_phn` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`b_id`, `b_name`, `b_mail`, `b_pass`, `b_add`, `b_phn`) VALUES
(35, 'Sadman Shoumik', 'sadman@gmail.com', '12341234', 'Savar', '01711111111');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `o_id` int(20) NOT NULL,
  `b_id` int(10) NOT NULL,
  `total_cost` int(20) NOT NULL,
  `ship_loc` varchar(100) NOT NULL,
  `flag` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`o_id`, `b_id`, `total_cost`, `ship_loc`, `flag`) VALUES
(46, 35, 350, 'Savar', 1),
(47, 35, 150, 'Savar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `o_info` int(11) NOT NULL,
  `o_id` int(20) NOT NULL,
  `b_id` int(20) NOT NULL,
  `p_id` int(20) NOT NULL,
  `s_id` int(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`o_info`, `o_id`, `b_id`, `p_id`, `s_id`, `quantity`, `price`) VALUES
(100, 46, 35, 36, 13, 1, 150),
(101, 46, 35, 37, 13, 1, 200),
(102, 47, 35, 36, 13, 1, 150);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `p_id` int(10) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_type` varchar(100) NOT NULL,
  `s_id` int(10) NOT NULL,
  `avl` int(100) NOT NULL,
  `ppu` int(11) NOT NULL,
  `img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`p_id`, `p_name`, `p_type`, `s_id`, `avl`, `ppu`, `img`) VALUES
(36, 'Designed Terracotta Pot', 'Terracotta', 13, 91, 150, 'Terracotta Pot 1.jpg'),
(37, 'Plant Pot', 'Terracotta', 13, 19, 200, 'Terracotta Pot 2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `s_id` int(10) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_mail` varchar(100) NOT NULL,
  `s_pass` varchar(20) NOT NULL,
  `s_add` varchar(100) NOT NULL,
  `s_phn` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`s_id`, `s_name`, `s_mail`, `s_pass`, `s_add`, `s_phn`) VALUES
(13, 'Nishat Nabila', 'nabila@gmail.com', '12341234', 'Tangail', '01722222222');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`o_info`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyer`
--
ALTER TABLE `buyer`
  MODIFY `b_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `o_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `o_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `s_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
