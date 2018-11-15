-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2018 at 12:24 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `construction`
--

-- --------------------------------------------------------

--
-- Table structure for table `consumtion`
--

CREATE TABLE `consumtion` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `unit_perameter` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumtion`
--

INSERT INTO `consumtion` (`id`, `date`, `item_id`, `qty`, `unit`, `unit_perameter`, `remark`, `is_active`) VALUES
(1, '2018-09-24', 1, '50', '50', 'KG', 'shyam', 1),
(2, '2018-09-24', 2, '60', '1', 'TON', 'ram', 1),
(3, '2018-09-24', 1, '550', '50', 'KG', 'cha', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_master`
--

CREATE TABLE `item_master` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `unit_perameter` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_master`
--

INSERT INTO `item_master` (`id`, `item_name`, `unit`, `unit_perameter`, `is_active`) VALUES
(1, 'Cement', '50', '1', 1),
(2, 'TMT Steel', '1', '2', 1),
(3, 'Red Bricks', '1', '5', 1),
(4, 'Concrete Blocks', '1', '5', 1),
(5, 'M Sand', '1', '5', 1),
(6, 'River Sand', '1', '7', 1),
(7, 'demo', '50', '7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `perameter`
--

CREATE TABLE `perameter` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perameter`
--

INSERT INTO `perameter` (`id`, `name`, `is_active`) VALUES
(1, 'KG', 1),
(2, 'TON', 1),
(3, 'LITER', 1),
(4, 'truck', 0),
(5, 'TRUCK', 1),
(6, 'TROLLY', 1),
(7, 'APE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(11) NOT NULL,
  `purchase_master_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `unit_perameter` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_master_id`, `date`, `item_id`, `unit`, `unit_perameter`, `qty`, `amount`, `discount`, `total`, `is_active`) VALUES
(1, 1, '2018-09-24', 1, '50', 'KG', '100', '250', NULL, '25000', 1),
(2, 1, '2018-09-24', 2, '1', 'TON', '100', '100', NULL, '10000', 1),
(3, 1, '2018-09-24', 3, '1', 'TRUCK', '500', '600', NULL, '300000', 1),
(4, 1, '2018-09-24', 4, '1', 'TRUCK', '600', '650', NULL, '390000', 1),
(5, 2, '2018-09-24', 1, '50', 'KG', '500', '250', NULL, '125000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_master`
--

CREATE TABLE `purchase_master` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `disscount` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_master`
--

INSERT INTO `purchase_master` (`id`, `vendor_id`, `date`, `invoice`, `amount`, `disscount`, `total`, `created_at`, `is_active`) VALUES
(1, 1, '2018-09-24', '1', 725000, 0, 725000, '2018-09-24 11:20:30', 1),
(2, 1, '2018-09-24', '3', 125000, 0, 125000, '2018-09-24 14:15:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(233) NOT NULL,
  `number` varchar(233) NOT NULL,
  `username` varchar(233) NOT NULL,
  `password` varchar(233) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `number`, `username`, `password`, `type`, `is_active`) VALUES
(1, 'Admin', '7000545273', 'admin', '123456', 'admin', 1),
(6, 'lalu', '8000545273', 'lalu', '123456', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vender_master`
--

CREATE TABLE `vender_master` (
  `id` int(11) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vender_master`
--

INSERT INTO `vender_master` (`id`, `vendor_name`, `mobile`, `address`, `is_active`) VALUES
(1, 'ADITYA', '7000545273', 'GARHA, JABALPUR', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consumtion`
--
ALTER TABLE `consumtion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_master`
--
ALTER TABLE `item_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perameter`
--
ALTER TABLE `perameter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_master`
--
ALTER TABLE `purchase_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vender_master`
--
ALTER TABLE `vender_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consumtion`
--
ALTER TABLE `consumtion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_master`
--
ALTER TABLE `item_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `perameter`
--
ALTER TABLE `perameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_master`
--
ALTER TABLE `purchase_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vender_master`
--
ALTER TABLE `vender_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
