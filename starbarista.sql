-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 05:05 AM
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
(12, 'Iced Peach Green Tea', 'Chill out with our Iced Peach Green Tea. Refreshing green tea infused with juicy peach flavors and served over ice.', 230, '917225.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `productID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
