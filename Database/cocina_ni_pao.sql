-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 03:20 PM
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
(54, 24, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(55, 25, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(56, 25, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(57, 25, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(58, 26, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(59, 26, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(60, 27, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(61, 27, 17, 'Pork Liempo', 2, 120, 0x696d61676573202831292e6a7067),
(62, 27, 18, 'Biryani', 1, 200, 0x696d616765732832292e6a7067),
(63, 28, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(64, 29, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(65, 29, 17, 'Pork Liempo', 2, 120, 0x696d61676573202831292e6a7067),
(66, 30, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(67, 31, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(71, 33, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(72, 34, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(73, 35, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(74, 36, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(75, 37, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(76, 38, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(77, 39, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(78, 40, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(82, 41, 13, 'Chicken', 3, 123, 0x696d616765732e6a7067),
(83, 41, 17, 'Pork Liempo', 2, 120, 0x696d61676573202831292e6a7067);

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
(25, 1, NULL, NULL, '2024-05-02 12:01:31.000000'),
(26, 1, NULL, NULL, '2024-05-02 14:09:07.000000'),
(27, 1, NULL, NULL, '2024-05-02 15:23:38.000000'),
(28, 1, NULL, NULL, '2024-05-02 16:24:00.000000'),
(29, 2, NULL, NULL, '2024-05-02 17:48:08.000000'),
(30, 2, NULL, NULL, '2024-05-02 18:52:57.000000'),
(31, 2, NULL, NULL, '2024-05-03 01:58:43.000000'),
(32, 2, NULL, NULL, '2024-05-06 09:24:23.000000'),
(33, 2, NULL, NULL, '2024-05-06 13:26:19.000000'),
(34, 1, NULL, NULL, '2024-05-06 13:41:07.000000'),
(35, 1, NULL, NULL, '2024-05-06 13:43:21.000000'),
(36, 1, NULL, NULL, '2024-05-06 13:44:20.000000'),
(37, 1, NULL, NULL, '2024-05-06 13:53:30.000000'),
(38, 1, NULL, NULL, '2024-05-06 13:54:38.000000'),
(39, 1, NULL, NULL, '2024-05-06 13:56:39.000000'),
(40, 1, NULL, NULL, '2024-05-06 14:29:53.000000'),
(41, 1, NULL, NULL, '2024-05-07 14:49:20.000000');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `total_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `order_id`, `total_amount`) VALUES
(1, 29, 123),
(2, 39, 123),
(3, 40, 123),
(4, 41, 609);

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
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

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
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
