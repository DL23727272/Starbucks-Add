-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 12:00 PM
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
(4, 'admin', '202cb962ac59075b964b07152d234b70', 'DatabaseTest@gmail.com', 'admin', '', ''),
(5, 'admin1', '202cb962ac59075b964b07152d234b70', 'admin@gmail.com', 'admin', '09456221399', ''),
(6, 'rachel', '202cb962ac59075b964b07152d234b70', 'rachelBagtit@gmail.com', 'user', NULL, NULL),
(7, 'DL2', '202cb962ac59075b964b07152d234b70', 'test3@gmail.com', 'admin', '09', 'asdas'),
(8, 'acc', '202cb962ac59075b964b07152d234b70', 'account@gmail.com', 'user', '', ''),
(9, 'num', '202cb962ac59075b964b07152d234b70', 'test@gmail.com', 'user', '09456221399', 'Candon City, ilocos'),
(10, 'DL3', '202cb962ac59075b964b07152d234b70', 'firstTest@gmail.com', 'user', '12213', 'sadad'),
(11, 'test', '202cb962ac59075b964b07152d234b70', 'Test@gmail.com', 'user', '09456221399', 'candon city, is'),
(12, 'jeriel', '202cb962ac59075b964b07152d234b70', 'jeriel@gmail.com', 'user', '0999', 'sta maria, IS'),
(13, 'sweet', '202cb962ac59075b964b07152d234b70', 'firstTest@gmail.com', 'user', '12313', 'candon city'),
(14, 'testnewform', '202cb962ac59075b964b07152d234b70', 'test@gmail.com', 'user', '123', 'fsdf'),
(15, 'acc5', '202cb962ac59075b964b07152d234b70', 'test@gmail.com', 'user', '21', 'sada');

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
(1, 87, 2, 1, '140.00', '140.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `totalPrice` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `paymentStatus` varchar(50) NOT NULL DEFAULT 'Pending',
  `paymentMethod` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`orderID`, `customerID`, `orderDate`, `totalPrice`, `status`, `paymentStatus`, `paymentMethod`) VALUES
(87, 1, '2024-07-13 09:53:19', '140.00', 'Pending', 'Pending | MOP: Cash', '0');

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `productID` int(3) NOT NULL,
  `productName` varchar(250) NOT NULL,
  `productDesc` varchar(255) NOT NULL,
  `productPrice` int(155) NOT NULL,
  `productImage` varchar(100) NOT NULL,
  `productType` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`productID`, `productName`, `productDesc`, `productPrice`, `productImage`, `productType`) VALUES
(1, 'Mocha Madness Blend', 'Dive into the rich flavors of chocolate and espresso with our Mocha Madness Blend. Perfectly balanced and irresistibly smooth.', 201, '178813.png', 'drink'),
(2, 'Caramel Dream Latte', 'Indulge in the velvety sweetness of caramel combined with our signature espresso, topped with steamed milk. A dreamy delight.', 140, '258036.png', 'drink'),
(3, 'Matcha Zen Frappuccino', 'Discover inner peace with our Matcha Zen Frappuccino. A harmonious blend of matcha green tea, creamy milk, and a hint of sweetness.', 340, '376500.png', 'drink'),
(4, 'Vanilla Bean Macchiato', 'Experience pure bliss with our Vanilla Bean Macchiato. Smooth vanilla meets bold espresso, topped with a dollop of foams.', 230, '440392.png', 'drink'),
(12, 'Iced Peach Green Tea', 'Chill out with our Iced Peach Green Tea. Refreshing green tea infused with juicy peach flavors and served over ice.', 230, '917225.png', 'drink'),
(36, 'Food 1', 'dsad', 123, 'food186972.png', 'food'),
(37, 'Food 2 ', 'Food test', 1232, 'food268927.png', 'food'),
(38, 'Food 3', 'wq', 123, 'food328672.png', 'food'),
(39, 'Dessert 1', 'sad', 123, 'dessert140716.png', 'dessert'),
(40, 'Dessert 2', 'asd', 120, 'dessert265958.png', 'dessert'),
(41, 'Dessert 3', 'asdsa', 123, 'dessert355743.png', 'dessert');

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
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_items_table`
--
ALTER TABLE `order_items_table`
  MODIFY `orderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `productID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
