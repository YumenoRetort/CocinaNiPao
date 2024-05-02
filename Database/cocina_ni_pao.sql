-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 12:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cocina_ni_pao`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `order_id` int(10) DEFAULT NULL,
  `food_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(10) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `img` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `order_id`, `food_id`, `name`, `qty`, `price`, `img`) VALUES
(54, 24, 13, 'Chicken', 1, 123, 0x696d616765732e6a7067),
(55, 25, 13, 'Chicken', 1, 123, 0x696d616765732e6a7067),
(56, 25, 13, 'Chicken', 1, 123, 0x696d616765732e6a7067),
(57, 25, 13, 'Chicken', 1, 123, 0x696d616765732e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `email`, `password`, `mobile`, `address`) VALUES
(1, 'Erin Reyes', 'ebmgreyes@mymail.mapua.edu.ph', 'Aliceiw@143', '0918989273', 'BLK 7A LOT 2 JOB STREET JUANA'),
(2, 'Tester 2', 'erin_bmreyes@yahoo.com', 'Aliceiw@143', '0918989273', 'BLK 7A LOT 2 JOB STREET JUANA');

-- --------------------------------------------------------

--
-- Table structure for table `food_products`
--

CREATE TABLE `food_products` (
  `food_id` int(10) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `food_price` int(255) NOT NULL,
  `food_description` text NOT NULL,
  `food_image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_products`
--

INSERT INTO `food_products` (`food_id`, `food_name`, `food_price`, `food_description`, `food_image`) VALUES
(13, 'Chicken', 123, 'Spicy Chicken', 0x696d616765732e6a7067),
(17, 'Pork Liempo', 120, 'Masarap', 0x696d61676573202831292e6a7067),
(18, 'Biryani', 200, 'Food', 0x696d616765732832292e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `staff_id` int(10) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `order_received` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `customer_id`, `staff_id`, `order_status`, `order_received`) VALUES
(24, 1, NULL, NULL, '2024-05-02 10:55:07.000000'),
(25, 1, NULL, NULL, '2024-05-02 12:01:31.000000');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `total_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `shipment_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `delivery_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(10) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `staff_email` varchar(255) NOT NULL,
  `staff_password` varchar(255) NOT NULL,
  `staff_mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_email`, `staff_password`, `staff_mobile`) VALUES
(3, 'Erin', 'erinreyes1431@gmail.com', 'Aliceiw@143', '0918989273');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `food_products`
--
ALTER TABLE `food_products`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`shipment_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `food_products`
--
ALTER TABLE `food_products`
  MODIFY `food_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `shipment_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food_products` (`food_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order_details` (`order_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
