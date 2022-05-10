-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2022 at 04:30 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtinc`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cid` int(11) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cid`, `cname`, `zip`, `phone_number`, `email`) VALUES
(1, 'GUEST', 0, '(555)-555-5555', 'NONE@NOMAIL.com');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `eid` int(11) NOT NULL,
  `ename` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`eid`, `ename`, `phone_number`, `email`) VALUES
(1, 'Anthony Fattal', '4043843999', 'fattalanthony@gmail.com'),
(2, 'Dev Patel', '(678)-313-2200', 'devdp2001@gmail.com'),
(3, 'Carter Gluck', '(678)-773-6578', 'ckg82383@uga.edu'),
(4, 'Kel Timbrook', '(678)-324-5667', 'keltimbrook@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `odate` date NOT NULL,
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `odate`, `pid`, `cid`, `eid`, `count`) VALUES
(1, '2022-05-03', 1, 1, 1, 1),
(2, '2022-05-04', 6, 1, 1, 11),
(5, '2022-05-04', 6, 1, 1, 1),
(7, '2022-05-04', 1, 1, 1, 70),
(10, '2022-05-04', 5, 1, 1, 1),
(21, '2022-05-09', 5, 1, 1, 1),
(22, '2022-05-09', 5, 1, 1, 1);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `stockcalculator` AFTER INSERT ON `orders` FOR EACH ROW update products set stock = stock - (select count from orders order by oid desc limit 1) where pid = (select pid from orders order by oid desc limit 1)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `sid` int(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `psize` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `stock`, `price`, `category`, `sid`, `color`, `psize`) VALUES
(1, 'sketchers', 70, '187.40', 'shoe', 1, 'blue', 'size 11'),
(5, '2015 adidas yeezy boost 350', 9, '550.00', 'shoe', 3, 'pirate black', '13'),
(6, 'tshirt', 11, '12.00', 'shirt', 4, 'blue', 'L'),
(7, 'Nike Sportswear Max 90', 26, '45.00', 'tshirt', 2, 'blue', 'L'),
(8, 'Sportswear Tech Fleece Utility Pants', 8, '120.00', 'pants', 2, 'grey', 'M'),
(9, 'NMD_R1 PRIMEBLUE SHOES', 58, '150.00', 'shoe', 3, 'black', '9'),
(10, 'ULTRABOOST 4.0 DNA SHOES', 35, '190.00', 'shoe', 3, 'white', '12'),
(11, 'ADICOLOR ESSENTIALS TREFOIL HOODIE', 40, '55.00', 'hoodie', 3, 'black', 'L'),
(12, 'Arch Fit Motley SD - Verlander', 15, '85.00', 'shoe', 1, 'brown', '10');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sid` int(11) NOT NULL,
  `sname` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`sid`, `sname`) VALUES
(1, 'skechers'),
(2, 'NIKE'),
(3, 'adidas'),
(4, 'erm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
