-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 12:58 PM
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
-- Database: `crud_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(8, 'Customer-1', 'customer1@gmail.com', '2024-04-19 16:50:38', NULL),
(9, 'Customer-2', 'customer2@gmail.com', '2024-04-19 16:51:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_meta`
--

CREATE TABLE `customer_meta` (
  `customer_id` int(255) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_meta`
--

INSERT INTO `customer_meta` (`customer_id`, `meta_field`, `meta_value`) VALUES
(3, 'phone', '01717479550'),
(3, 'text', 'Test-212'),
(3, 'new_1', 'fsdfd'),
(3, 'test', 'sdfsdf-45345'),
(3, 'dsfds', 'tttttt'),
(4, 'phone', '01717479560'),
(4, 'text', 'Test-2'),
(4, 'new_1', 'fsdfd-2'),
(4, 'test', 'sdfsdf-2'),
(4, 'dsfds', 'sdfsdf-2'),
(5, 'phone', '01717479550'),
(5, 'text', 'Test'),
(5, 'new_1', 'sdfsdf'),
(5, 'test', 'sdfsdf'),
(5, 'dsfds', 'sdfsdf'),
(6, 'phone', '01717479550'),
(6, 'present_address', 'Dhaka'),
(6, 'permanent_address', 'Ishwardi'),
(7, 'phone', '01922240718'),
(7, 'present_address', 'Ishwardi'),
(7, 'permanent_address', 'Pabna'),
(7, 'test', 'test field'),
(8, 'phone', '01717479550'),
(8, 'present_address', 'Dhaka\r\ndsfdsf'),
(9, 'phone', '01922240718'),
(9, 'present_address', 'Rajshahi'),
(9, 'permanent_address', 'Ishwardi'),
(10, 'phone', '01717479550'),
(10, 'present_address', 'Dhaka'),
(10, 'permanent_address', 'Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `form_fields`
--

CREATE TABLE `form_fields` (
  `field_label` text NOT NULL,
  `field_name` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_fields`
--

INSERT INTO `form_fields` (`field_label`, `field_name`, `type`) VALUES
('Phone', 'phone', 'number'),
('Present Address', 'present_address', 'long_text'),
('Permanent Address', 'permanent_address', 'long_text');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
