-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 08:29 AM
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
-- Database: `carseller`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `make` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `mileage` int(11) DEFAULT NULL,
  `fuel_type` varchar(20) DEFAULT NULL,
  `transmission` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `make`, `model`, `year`, `color`, `mileage`, `fuel_type`, `transmission`, `price`, `status`) VALUES
(1, 'Toyota', 'Corolla', 2020, 'White', 25000, 'Petrol', 'Automatic', 18000.00, 'Available'),
(2, 'Honda', 'Civic', 2019, 'Black', 30000, 'Petrol', 'Manual', 16500.00, 'Sold'),
(3, 'Tesla', 'Model 3', 2022, 'Red', 5000, 'Electric', 'Automatic', 35000.00, 'Sold'),
(4, 'Nissan', 'Altima', 2018, 'Silver', 40000, 'Diesel', 'Automatic', 15000.00, 'Reserved'),
(5, 'Toyota', 'Axio', 2016, 'Gray', 20000, 'Hybrid', 'Automatic', 5000.00, 'Available'),
(6, 'Hyundai', 'Elantra', 2021, 'Blue', 18000, 'Petrol', 'Automatic', 17500.00, 'Available'),
(7, 'BMW', 'X5', 2020, 'Black', 22000, 'Diesel', 'Automatic', 50000.00, 'Available'),
(8, 'Mercedes-Benz', 'C-Class', 2019, 'White', 35000, 'Petrol', 'Automatic', 42000.00, 'Available'),
(9, 'Ford', 'Mustang', 2022, 'Red', 7000, 'Petrol', 'Manual', 39000.00, 'Reserved'),
(10, 'Chevrolet', 'Malibu', 2018, 'Gray', 45000, 'Petrol', 'Automatic', 14500.00, 'Available'),
(11, 'Toyota', 'Camry', 2021, 'Silver', 16000, 'Hybrid', 'Automatic', 28000.00, 'Sold'),
(12, 'Honda', 'Accord', 2020, 'White', 19000, 'Petrol', 'Manual', 26000.00, 'Available'),
(13, 'Mazda', 'CX-5', 2022, 'Blue', 12000, 'Petrol', 'Automatic', 31000.00, 'Available'),
(14, 'Volkswagen', 'Passat', 2017, 'Black', 52000, 'Diesel', 'Manual', 13800.00, 'Available'),
(15, 'Nissan', 'Sentra', 2019, 'Red', 28000, 'Petrol', 'Automatic', 15800.00, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `cashflow`
--

CREATE TABLE `cashflow` (
  `transaction_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` enum('Income','Expense') NOT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reference` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashflow`
--

INSERT INTO `cashflow` (`transaction_id`, `date`, `type`, `description`, `amount`, `reference`) VALUES
(1, '2024-03-10', 'Income', 'Car sale: Tesla Model 3', 35000.00, 'Sale ID: 1'),
(2, '2024-03-15', 'Expense', 'Salary paid to Karim Khan', 35000.00, 'Emp ID: 2'),
(3, '2024-03-16', 'Expense', 'Office electricity bill', 3200.00, 'Bill Ref: EB2303'),
(4, '2024-03-17', 'Expense', 'Purchased cleaning kits', 1200.00, 'Vendor: AutoClean BD'),
(5, '2025-04-03', 'Income', 'Car sale: Honda Civic', 16500.00, 'Sale ID: 2');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `phone`, `email`, `address`) VALUES
(1, 'Alice Rahman', '01711112222', 'alice@example.com', 'Dhaka'),
(2, 'Bob Karim', '01833334444', 'bob@example.com', 'Chittagong'),
(3, 'Sadia Akter', '01655556666', 'sadia@example.com', 'Sylhet'),
(4, 'Prithbiraj Sarker', '01797644233', 'bishalsarkerdhaka@gmail.com', 'Not Provided');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `name`, `position`, `phone`, `email`, `hire_date`, `salary`) VALUES
(1, 'Rahim Uddin', 'Sales Executive', '01712345678', 'rahim@company.com', '2022-06-01', 20000.00),
(2, 'Karim Khan', 'Manager', '01823456789', 'karim@company.com', '2021-03-15', 35000.00),
(3, 'Sadia Akter', 'Technician', '01634567890', 'sadia@company.com', '2023-01-10', 18000.00);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `sale_id`, `amount_paid`, `payment_date`, `payment_method`) VALUES
(1, 1, 35000.00, '2024-03-10', 'Cash'),
(2, 2, 16500.00, '2025-04-03', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `car_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `car_id`, `customer_id`, `sale_date`, `sale_price`, `payment_method`) VALUES
(1, 3, 1, '2024-03-10', 35000.00, 'Cash'),
(2, 2, 4, '2025-04-03', 16500.00, 'Cash');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `cashflow`
--
ALTER TABLE `cashflow`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cashflow`
--
ALTER TABLE `cashflow`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sale_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
