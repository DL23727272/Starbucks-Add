-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2024 at 03:04 PM
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
  `type` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_table`
--

INSERT INTO `customer_table` (`customerID`, `customerName`, `customerPassword`, `customerEmail`, `type`) VALUES
(1, 'DL', '202cb962ac59075b964b07152d234b70', 'firstTest@gmail.com', 'user'),
(2, 'Angela', '202cb962ac59075b964b07152d234b70', '2ndTest@gmail.com', 'user'),
(3, 'Nicolle', '202cb962ac59075b964b07152d234b70', '3rdTest@gmail.com', 'user');

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
(4, 19, 13, 1, '320.00', '320.00');

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
(1, 1, '2024-03-28 13:08:37', '0.00', 'Pending'),
(2, 1, '2024-03-28 13:10:11', '341.00', 'Pending'),
(3, 1, '2024-03-28 13:12:19', '341.00', 'Pending'),
(4, 1, '2024-03-28 13:22:57', '201.00', 'Pending'),
(5, 1, '2024-03-28 13:23:02', '201.00', 'Pending'),
(6, 3, '2024-03-28 13:24:17', '280.00', 'Pending'),
(7, 3, '2024-03-28 13:30:15', '280.00', 'Pending'),
(8, 3, '2024-03-28 13:32:23', '280.00', 'Pending'),
(9, 3, '2024-03-28 13:32:25', '280.00', 'Pending'),
(10, 3, '2024-03-28 13:32:49', '280.00', 'Pending'),
(11, 3, '2024-03-28 13:35:00', '280.00', 'Pending'),
(12, 3, '2024-03-28 13:37:18', '0.00', 'Pending'),
(13, 3, '2024-03-28 13:37:37', '0.00', 'Pending'),
(14, 3, '2024-03-28 13:37:40', '0.00', 'Pending'),
(15, 3, '2024-03-28 13:38:05', '881.00', 'Pending'),
(16, 3, '2024-03-28 13:42:38', '280.00', 'Pending'),
(17, 3, '2024-03-28 13:43:39', '1020.00', 'Pending'),
(18, 1, '2024-03-28 14:01:55', '1422.00', 'Pending'),
(19, 1, '2024-03-28 14:03:13', '521.00', 'Pending');

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
(13, 'AdminTest', 'ADMIN ADD PRODUCT TEST LMAO', 320, '920529.png');

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
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items_table`
--
ALTER TABLE `order_items_table`
  MODIFY `orderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `productID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
