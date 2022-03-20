-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2022 at 09:40 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lgtl_cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `service_comment`
--

CREATE TABLE `service_comment` (
  `service_comment_id` varchar(5) NOT NULL,
  `customer_id` varchar(15) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `contact_number` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `service_comment`
--
ALTER TABLE `service_comment`
  ADD PRIMARY KEY (`service_comment_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `service_comment`
--
ALTER TABLE `service_comment`
  ADD CONSTRAINT `service_comment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`cust_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
