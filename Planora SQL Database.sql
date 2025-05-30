-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 30, 2025 at 09:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `planora`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventdetail`
--

CREATE TABLE `eventdetail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `number_of_guests` int(11) NOT NULL,
  `dietary_preferences` text DEFAULT NULL,
  `type_of_event` varchar(100) DEFAULT NULL,
  `cuisines` text DEFAULT NULL,
  `expensive_level` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events_detail`
--

CREATE TABLE `events_detail` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(100) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '""'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_detail`
--

INSERT INTO `events_detail` (`id`, `event_name`, `event_date`, `created_at`, `status`, `email`) VALUES
(113, 'Few', '2025-05-30', '2025-05-30 03:53:58', 0, 'test@gmail.com'),
(114, 'Asdf', '2025-05-30', '2025-05-30 03:54:10', 0, 'test@gmail.com'),
(117, 'Adda', '2025-05-30', '2025-05-30 04:17:12', 0, 'harini@gmail.com'),
(118, 'Codas', '2025-05-30', '2025-05-30 04:33:57', 0, 'harini@gmail.com'),
(120, 'Test', '2025-05-30', '2025-05-30 04:38:16', 0, 'test@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `event_requests`
--

CREATE TABLE `event_requests` (
  `id` int(11) NOT NULL,
  `guest_count` int(11) NOT NULL,
  `event_type` varchar(50) DEFAULT NULL,
  `cuisine` varchar(50) DEFAULT NULL,
  `dietary_preference` varchar(50) DEFAULT NULL,
  `price_range` enum('Basic','Medium','Premium') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_requests`
--

INSERT INTO `event_requests` (`id`, `guest_count`, `event_type`, `cuisine`, `dietary_preference`, `price_range`, `created_at`) VALUES
(1, 25, 'Birthday', 'American', 'Vegetarian', 'Medium', '2025-05-15 09:58:56'),
(14, 15, 'Wedding', 'American,Chinese', 'Vegetarian,Gluten-Free', 'Medium', '2025-05-28 04:18:01'),
(15, 15, 'Wedding', 'American,Chinese', 'Vegetarian,Gluten-Free', 'Medium', '2025-05-28 07:17:05'),
(16, 15, 'Wedding', 'American,Chinese', 'Vegetarian,Gluten-Free', 'Medium', '2025-05-29 04:52:11'),
(17, 15, 'Wedding', 'American,Chinese', 'Vegetarian,Gluten-Free', 'Medium', '2025-05-29 09:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `grocery_list`
--

CREATE TABLE `grocery_list` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_checked` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grocery_list`
--

INSERT INTO `grocery_list` (`id`, `name`, `is_checked`, `created_at`) VALUES
(22, 'Added', 1, '2025-05-10 04:25:46'),
(25, 'Fdafdsf', 0, '2025-05-10 04:28:27'),
(27, 'Ffgd', 1, '2025-05-10 04:31:49'),
(28, 'Milk', 0, '2025-05-10 09:05:45'),
(29, 'Test5', 0, '2025-05-10 09:15:44'),
(30, 'Test 8 unchecked', 0, '2025-05-10 09:16:16'),
(31, 'Direct test', 0, '2025-05-10 09:17:48'),
(32, 'Test 19', 0, '2025-05-10 09:35:03'),
(33, 'Milk', 0, '2025-05-15 06:51:56'),
(34, 'Oniontest', 0, '2025-05-15 10:36:17'),
(35, 'Bun', 0, '2025-05-16 05:22:03'),
(36, 'Onion', 0, '2025-05-16 05:47:40'),
(37, 'Potato', 0, '2025-05-16 05:47:44'),
(38, 'Potato', 0, '2025-05-16 08:01:22'),
(39, 'Chicken', 0, '2025-05-16 08:01:26'),
(40, 'Onion', 0, '2025-05-16 08:01:30'),
(41, 'Chicken 500 g', 0, '2025-05-29 10:25:47'),
(42, 'Potato', 0, '2025-05-29 10:45:54'),
(43, 'Adf', 0, '2025-05-30 03:08:44'),
(44, 'FD', 0, '2025-05-30 03:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `leftover_ideas`
--

CREATE TABLE `leftover_ideas` (
  `id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leftover_ideas`
--

INSERT INTO `leftover_ideas` (`id`, `food_name`, `created_at`) VALUES
(1, 'Rice', '2025-05-09 03:58:45'),
(2, 'Rice', '2025-05-09 07:20:04'),
(3, 'chicken', '2025-05-10 08:25:26'),
(4, 'Test 5', '2025-05-10 08:41:48'),
(5, 'Test100', '2025-05-10 09:34:46'),
(6, 'chicken', '2025-05-15 06:51:59'),
(7, 'chicken', '2025-05-15 10:30:57'),
(8, 'Chicjen', '2025-05-16 05:21:42'),
(9, 'Rice', '2025-05-16 05:47:18'),
(10, 'Chicken', '2025-05-16 07:27:33'),
(11, 'Chicken', '2025-05-16 07:36:06'),
(12, 'Panner', '2025-05-16 07:41:04'),
(13, 'Chicken', '2025-05-16 07:41:15'),
(14, 'Rice', '2025-05-16 07:41:24'),
(15, 'Beef', '2025-05-16 07:41:37'),
(16, 'Paneer', '2025-05-16 07:41:46'),
(17, 'Rice', '2025-05-16 07:42:06'),
(18, 'Chicken', '2025-05-16 08:00:40'),
(19, 'Rice', '2025-05-16 08:01:48'),
(20, 'Rice', '2025-05-28 02:38:16'),
(21, 'Rice', '2025-05-28 02:38:23'),
(22, 'Chicken', '2025-05-28 02:38:31'),
(23, 'Chicken', '2025-05-28 02:49:19'),
(24, 'Chicken', '2025-05-28 02:52:03'),
(25, 'Rice', '2025-05-28 02:54:29'),
(26, 'Rice', '2025-05-29 07:49:54'),
(27, 'Chicken', '2025-05-29 07:54:40'),
(28, 'Dosa', '2025-05-29 10:24:38'),
(29, 'Chiecken', '2025-05-29 10:24:50'),
(30, 'Chicken', '2025-05-29 10:25:02'),
(31, 'Chicken', '2025-05-29 10:44:08'),
(32, 'Rice', '2025-05-30 03:07:09'),
(33, 'Fish', '2025-05-30 03:07:21'),
(34, 'Pulao', '2025-05-30 03:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `value`) VALUES
(1, 'Pizza', 12.99),
(2, 'Pizza', 9.99),
(3, 'Pizza', 10.00),
(4, 'Pizza', 10.00),
(5, 'Pizza', 10.00),
(6, 'Pizza', 10.00),
(7, 'Test10', 100.00),
(8, 'Test10', 100.35),
(9, 'Test 11', 156.00),
(10, 'Test 11', 156.65),
(11, 'Pizza', 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `party_notes`
--

CREATE TABLE `party_notes` (
  `id` int(11) NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `party_notes`
--

INSERT INTO `party_notes` (`id`, `note`, `created_at`) VALUES
(1, 'This was the best party ever!', '2025-05-09 04:02:18'),
(2, 'Don\'t forget the balloons!', '2025-05-09 07:22:33'),
(3, 'Don\'t forget the balloons!', '2025-05-09 07:22:35'),
(4, 'Don\'t forget the balloons!', '2025-05-10 07:42:30'),
(5, 'Today the event is v', '2025-05-10 08:04:40'),
(6, 'Test the backend', '2025-05-10 09:34:32'),
(7, 'I am very happy', '2025-05-16 05:21:55'),
(8, 'Hi i am harini today i felt great', '2025-05-16 05:45:43'),
(9, 'Hi i am harini today i am celebrating my birthday and i am so happy for this day', '2025-05-16 08:01:12'),
(10, 'Swedes', '2025-05-29 10:45:44'),
(11, 'Happy', '2025-05-30 03:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Elamaran G', '1', '1'),
(2, 'harini', 'harini@example.com', '123456'),
(3, 'John Doe', 'lavanya@example.com', '123456'),
(4, 'Pome', 'pome@gmail.com', '123456'),
(5, 'Pome', 'pome09@gmail.com', 'Jun09_2005'),
(6, 'Pome', 'pome0999@gmail.com', 'Jun09_2005'),
(7, 'Harini', 'AlluHarini@gmail.com', '789456123'),
(8, 'Test', 'test@test.com', '1'),
(9, 'Harini allu', 'allu@gmail.com', '1'),
(10, 'Raja', 'test@gmail.om', '123'),
(11, 'Harini', 'harini@gmail.com', '0609');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventdetail`
--
ALTER TABLE `eventdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_detail`
--
ALTER TABLE `events_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_requests`
--
ALTER TABLE `event_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grocery_list`
--
ALTER TABLE `grocery_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leftover_ideas`
--
ALTER TABLE `leftover_ideas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `party_notes`
--
ALTER TABLE `party_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventdetail`
--
ALTER TABLE `eventdetail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `events_detail`
--
ALTER TABLE `events_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `event_requests`
--
ALTER TABLE `event_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `grocery_list`
--
ALTER TABLE `grocery_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `leftover_ideas`
--
ALTER TABLE `leftover_ideas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `party_notes`
--
ALTER TABLE `party_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
