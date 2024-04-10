-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2024 at 06:45 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `starbarista`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_table`
--

CREATE TABLE `customer_table` (
  `customerID` int(11) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `customerPassword` varchar(255) NOT NULL,
  `customerEmail` varchar(255) NOT NULL,
  `type` enum('admin','user') NOT NULL DEFAULT 'user',
  `phoneNumber` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_table`
--

INSERT INTO `customer_table` (`customerID`, `customerName`, `customerPassword`, `customerEmail`, `type`, `phoneNumber`, `address`) VALUES
(1, 'DL', '202cb962ac59075b964b07152d234b70', 'firstTest@gmail.com', 'user', NULL, NULL),
(2, 'barista', '202cb962ac59075b964b07152d234b70', '2ndTest@gmail.com', 'user', '09456221399', ''),
(3, 'nicolle', '202cb962ac59075b964b07152d234b70', '3rdTest@gmail.com', 'user', '09', 'banayoyo'),
(4, 'admin', '202cb962ac59075b964b07152d234b70', 'DatabaseTest@gmail.com', 'user', NULL, NULL),
(5, 'admin1', '202cb962ac59075b964b07152d234b70', 'admin@gmail.com', 'admin', '09456221399', ''),
(6, 'rachel', '202cb962ac59075b964b07152d234b70', 'rachelBagtit@gmail.com', 'user', NULL, NULL),
(7, 'DL2', '202cb962ac59075b964b07152d234b70', 'test3@gmail.com', 'admin', '09', 'asdas'),
(8, 'acc', '202cb962ac59075b964b07152d234b70', 'account@gmail.com', 'user', '', ''),
(9, 'num', '202cb962ac59075b964b07152d234b70', 'test@gmail.com', 'user', '09456221399', 'Candon City, ilocos'),
(10, 'DL3', '202cb962ac59075b964b07152d234b70', 'firstTest@gmail.com', 'user', '12213', 'sadad');

-- --------------------------------------------------------

--
-- Table structure for table `order_items_table`
--

CREATE TABLE `order_items_table` (
  `orderItemID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `pricePerItem` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items_table`
--

INSERT INTO `order_items_table` (`orderItemID`, `orderID`, `productID`, `quantity`, `pricePerItem`, `subtotal`) VALUES
(1, 18, 1, 2, '201.00', '402.00'),
(2, 18, 3, 3, '340.00', '1020.00'),
(3, 19, 1, 1, '201.00', '201.00'),
(4, 19, 13, 1, '320.00', '320.00'),
(5, 20, 1, 1, '201.00', '201.00'),
(6, 20, 3, 2, '340.00', '680.00'),
(7, 20, 4, 1, '230.00', '230.00'),
(8, 21, 1, 1, '201.00', '201.00'),
(9, 22, 1, 2, '201.00', '402.00'),
(10, 22, 2, 1, '140.00', '140.00'),
(11, 23, 2, 1, '140.00', '140.00'),
(12, 23, 4, 1, '230.00', '230.00'),
(13, 24, 3, 1, '340.00', '340.00'),
(14, 24, 12, 1, '230.00', '230.00'),
(15, 25, 13, 1, '320.00', '320.00'),
(16, 26, 1, 1, '201.00', '201.00'),
(17, 27, 2, 1, '140.00', '140.00'),
(18, 28, 1, 1, '201.00', '201.00'),
(19, 29, 13, 2, '320.00', '640.00'),
(20, 30, 2, 1, '140.00', '140.00'),
(21, 31, 18, 2, '111.00', '222.00'),
(22, 32, 18, 1, '111.00', '111.00'),
(23, 33, 1, 3, '201.00', '603.00'),
(24, 34, 1, 1, '201.00', '201.00'),
(25, 35, 2, 1, '140.00', '140.00'),
(26, 35, 1, 1, '201.00', '201.00'),
(27, 36, 13, 1, '320.00', '320.00'),
(28, 37, 2, 1, '140.00', '140.00'),
(29, 37, 12, 1, '230.00', '230.00'),
(30, 38, 1, 3, '201.00', '603.00'),
(31, 39, 2, 1, '140.00', '140.00'),
(32, 39, 21, 1, '123.00', '123.00'),
(33, 40, 3, 2, '340.00', '680.00'),
(34, 40, 22, 1, '123.00', '123.00'),
(35, 41, 12, 1, '230.00', '230.00'),
(36, 42, 22, 2, '123.00', '246.00'),
(37, 43, 2, 2, '140.00', '280.00'),
(38, 44, 2, 1, '140.00', '140.00'),
(39, 45, 4, 1, '230.00', '230.00'),
(40, 45, 1, 1, '201.00', '201.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `totalPrice` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`orderID`, `customerID`, `orderDate`, `totalPrice`, `status`) VALUES
(18, 1, '2024-03-28 14:01:55', '1422.00', 'Processing'),
(20, 4, '2024-03-28 14:10:28', '1111.00', 'Completed'),
(23, 2, '2024-03-29 06:04:43', '370.00', 'Completed'),
(24, 3, '2024-03-29 06:06:25', '570.00', 'Processing'),
(27, 1, '2024-03-29 09:05:54', '140.00', 'Processing'),
(28, 1, '2024-03-29 09:06:42', '201.00', 'Processing'),
(29, 1, '2024-03-29 12:17:25', '640.00', 'Completed'),
(30, 1, '2024-03-29 12:38:12', '140.00', 'Completed'),
(31, 1, '2024-03-29 13:28:29', '222.00', 'Completed'),
(32, 4, '2024-03-29 13:29:47', '111.00', 'Processing'),
(33, 1, '2024-03-30 00:10:54', '603.00', 'Processing'),
(34, 1, '2024-03-30 00:15:42', '201.00', 'Pending'),
(35, 6, '2024-03-30 04:43:02', '341.00', 'Processing'),
(36, 6, '2024-03-30 16:45:46', '320.00', 'Pending'),
(37, 7, '2024-03-31 10:10:42', '370.00', 'Processing'),
(38, 1, '2024-04-01 02:45:30', '603.00', 'Completed'),
(39, 2, '2024-04-03 08:30:59', '263.00', 'Pending'),
(40, 1, '2024-04-07 18:46:44', '803.00', 'Pending'),
(41, 1, '2024-04-07 18:50:58', '230.00', 'Pending'),
(42, 1, '2024-04-07 18:51:39', '246.00', 'Pending'),
(43, 1, '2024-04-07 18:52:07', '280.00', 'Pending'),
(44, 1, '2024-04-07 18:53:16', '140.00', 'Pending'),
(45, 1, '2024-04-08 02:46:44', '431.00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `productID` int(3) NOT NULL,
  `productName` varchar(250) NOT NULL,
  `productDesc` varchar(255) NOT NULL,
  `productPrice` int(155) NOT NULL,
  `productImage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`productID`, `productName`, `productDesc`, `productPrice`, `productImage`) VALUES
(1, 'Mocha Madness Blend', 'Dive into the rich flavors of chocolate and espresso with our Mocha Madness Blend. Perfectly balanced and irresistibly smooth.', 201, '178813.png'),
(2, 'Caramel Dream Latte', 'Indulge in the velvety sweetness of caramel combined with our signature espresso, topped with steamed milk. A dreamy delight.', 140, '258036.png'),
(3, 'Matcha Zen Frappuccino', 'Discover inner peace with our Matcha Zen Frappuccino. A harmonious blend of matcha green tea, creamy milk, and a hint of sweetness.', 340, '376500.png'),
(4, 'Vanilla Bean Macchiato', 'Experience pure bliss with our Vanilla Bean Macchiato. Smooth vanilla meets bold espresso, topped with a dollop of foam.', 230, '440392.png'),
(12, 'Iced Peach Green Tea', 'Chill out with our Iced Peach Green Tea. Refreshing green tea infused with juicy peach flavors and served over ice.', 230, '917225.png'),
(13, 'AdminTest', 'ADMIN ADD PRODUCT TEST LMAO', 320, '920529.png'),
(18, 'AdminTest3', 'test march 29 2024 9:24', 111, '1039267.png'),
(21, 'Product1test', 'asdasd', 123, '587306.png'),
(22, 'testNewModal', 'adsad', 123, '586953.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `order_items_table`
--
ALTER TABLE `order_items_table`
  ADD PRIMARY KEY (`orderItemID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items_table`
--
ALTER TABLE `order_items_table`
  MODIFY `orderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `productID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items_table`
--
ALTER TABLE `order_items_table`
  ADD CONSTRAINT `order_items_table_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `order_table` (`orderID`),
  ADD CONSTRAINT `order_items_table_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product_table` (`productID`);

--
-- Constraints for table `order_table`
--
ALTER TABLE `order_table`
  ADD CONSTRAINT `order_table_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer_table` (`customerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
