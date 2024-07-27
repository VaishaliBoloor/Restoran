-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 24, 2023 at 06:36 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `a_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'e6e061838856bf47e1de730719fb2609');

-- --------------------------------------------------------

--
-- Table structure for table `carrier`
--

DROP TABLE IF EXISTS `carrier`;
CREATE TABLE IF NOT EXISTS `carrier` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `u_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `resume` varchar(100) NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `p_id` int NOT NULL,
  `u_id` int NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `p_id` (`p_id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`c_id`, `p_id`, `u_id`, `qty`) VALUES
(2, 1, 3, 1),
(3, 2, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE IF NOT EXISTS `checkout` (
  `co_id` int NOT NULL AUTO_INCREMENT,
  `u_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` int NOT NULL,
  `address` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pin` int NOT NULL,
  `total` int NOT NULL,
  `transid` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `transdate` datetime NOT NULL,
  `approval` int NOT NULL,
  PRIMARY KEY (`co_id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`co_id`, `u_id`, `name`, `phone`, `address`, `city`, `pin`, `total`, `transid`, `transdate`, `approval`) VALUES
(1, 1, 'Nevil Serrao', 2147483647, 'Little Flower, Near Durga High School,\r\nKukkundoor(p), Karkala(t)', 'Udupi', 576117, 180, 'wheihq i 9812482374', '2023-05-12 12:47:28', 1),
(2, 2, 'Vaishali', 2147483647, 'Gagandeep aprt,c-block,3rd cross, Bejai kapikad', 'Mangalore', 575004, 220, 'vajishak', '2023-05-31 15:46:39', 1),
(3, 2, 'Vaishali', 2147483647, 'Gagandeep aprt,c-block,3rd cross, Bejai kapikad', 'Mangalore', 575004, 180, '3wuifuwogtiw', '2023-06-02 16:13:23', 1),
(4, 2, 'Vaishali', 2147483647, 'Gagandeep aprt,c-block,3rd cross, Bejai kapikad', 'Mangalore', 575004, 230, '2345678id', '2023-06-16 16:39:39', 1),
(5, 2, 'Vaishali', 2147483647, 'Gagandeep aprt,c-block,3rd cross, Bejai kapikad', 'Mangalore', 575004, 210, '13123hq', '2023-06-16 17:22:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `f_id` int NOT NULL AUTO_INCREMENT,
  `u_id` int NOT NULL,
  `feedback` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`f_id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`f_id`, `u_id`, `feedback`) VALUES
(1, 1, 'Really good');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `o_id` int NOT NULL AUTO_INCREMENT,
  `c_id` int NOT NULL,
  `p_id` int NOT NULL,
  `u_id` int NOT NULL,
  `qty` int NOT NULL,
  `delivery` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`o_id`),
  KEY `p_id` (`p_id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `c_id`, `p_id`, `u_id`, `qty`, `delivery`) VALUES
(1, 1, 1, 1, 3, 'deliverd'),
(2, 2, 2, 1, 3, 'deliverd'),
(3, 4, 3, 2, 1, 'deliverd'),
(4, 5, 2, 2, 1, 'deliverd'),
(5, 7, 1, 2, 1, 'deliverd'),
(6, 8, 2, 2, 1, 'deliverd'),
(7, 9, 2, 2, 2, 'deliverd'),
(8, 10, 3, 2, 2, 'deliverd');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `discount` int DEFAULT NULL,
  `discription` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `name`, `category`, `price`, `discount`, `discription`, `image`) VALUES
(1, 'maggi', 'breakfast', 50, 0, 'rich cheese maggi', 'menu-3.jpg'),
(2, 'Frecnch lunch', 'lunch', 100, 0, 'french lunch menu', 'menu-6.jpg'),
(3, 'poha', 'breakfast', 90, 0, 'north cuisine', '17.png'),
(4, 'huwdku', 'dinner', 45, 0, 'ehioguejIO', '17.png');

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

DROP TABLE IF EXISTS `reserve`;
CREATE TABLE IF NOT EXISTS `reserve` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `u_id` int NOT NULL,
  `reservetime` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `people` int NOT NULL,
  `description` varchar(246) COLLATE utf8mb4_general_ci NOT NULL,
  `approval` int DEFAULT NULL,
  PRIMARY KEY (`r_id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `name`, `phone`, `email`, `password`) VALUES
(1, 'Nevil Serrao', 2147483647, 'nevilserrao1234@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'vaishu', 2147483647, 'vaishukotian2277@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'vaishali', 2147483647, '20435@sdmcbm.ac.in', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `reserve`
--
ALTER TABLE `reserve`
  ADD CONSTRAINT `reserve_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
