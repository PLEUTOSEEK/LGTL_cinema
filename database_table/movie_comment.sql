-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2022 at 11:06 AM
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
-- Table structure for table `movie_comment`
--

CREATE TABLE `movie_comment` (
  `movie_comment_id` varchar(5) NOT NULL,
  `customer_id` varchar(5) DEFAULT NULL,
  `movie_id` varchar(5) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `contact_number` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie_comment`
--
ALTER TABLE `movie_comment`
  ADD PRIMARY KEY (`movie_comment_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie_comment`
--
ALTER TABLE `movie_comment`
  ADD CONSTRAINT `movie_comment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `movie_comment_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
