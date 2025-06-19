-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 09:42 AM
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
-- Database: `brahman_solution`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `uniqcode` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `aadhaar_no` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `aadhaar_image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `uniqcode`, `name`, `email`, `phone`, `password`, `address`, `city`, `state`, `pincode`, `aadhaar_no`, `image`, `aadhaar_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tK2FpWq9LeMdN7YxBvAZ', 'Sharukh Kane', 'sharukh.khan@example.com', '9775218508', '25d55ad283aa400af464c76d713c07ad', 'Habibpur, Sultanpur, Kalna', 'Purba Bardhaman', 'West Bengal', '713146', '961935602067', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'http://127.0.0.1/brahman-solution/public/upload/brahman/aadhaar-image/tK2FpWq9LeMdN7YxBvAZ.png', 'active', '2025-06-17 12:03:51', '2025-06-18 11:32:54'),
(2, 'tK2FpWq9LeMdN7YxBvAk', 'Sharukh Kane', 'sharukh1.khan@example.com', '9064472563', '25d55ad283aa400af464c76d713c07ad', 'Habibpur, Sultanpur, Kalna', 'Purba Bardhaman', 'West Bengal', '713146', '961935602068', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'http://127.0.0.1/brahman-solution/public/upload/brahman/aadhaar-image/tK2FpWq9LeMdN7YxBvAZ.png', 'active', '2025-06-17 12:03:51', '2025-06-17 13:16:05'),
(3, 'tK2FpWq9LeMdN7YxBvA3', 'Sharukh Khan', 'sharukh2.khan@example.com', '9775218500', '25d55ad283aa400af464c76d713c07ad', 'Habibpur, Sultanpur, Kalna', 'Purba Bardhaman', 'West Bengal', '713146', '961935602060', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'http://127.0.0.1/brahman-solution/public/upload/brahman/aadhaar-image/tK2FpWq9LeMdN7YxBvAZ.png', 'active', '2025-06-17 12:03:51', '2025-06-17 13:01:20'),
(4, 'tK2FpWq9LeMdN7YxBvA2', 'Sharukh Khan', 'sharukh4.khan@example.com', '9775218503', '25d55ad283aa400af464c76d713c07ad', 'Habibpur, Sultanpur, Kalna', 'Purba Bardhaman', 'West Bengal', '713146', '961935602062', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'http://127.0.0.1/brahman-solution/public/upload/brahman/aadhaar-image/tK2FpWq9LeMdN7YxBvAZ.png', 'active', '2025-06-17 12:03:51', '2025-06-17 13:01:20'),
(5, 'tK2FpWq9LeMdN7YxBvA1', 'Sharukh Khan', 'sharukh3.khan@example.com', '9775218502', '25d55ad283aa400af464c76d713c07ad', 'Habibpur, Sultanpur, Kalna', 'Purba Bardhaman', 'West Bengal', '713146', '961935602061', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'http://127.0.0.1/brahman-solution/public/upload/brahman/aadhaar-image/tK2FpWq9LeMdN7YxBvAZ.png', 'active', '2025-06-17 12:03:51', '2025-06-17 13:01:20'),
(6, 'tK2FpWq9LeMdN7YxBvA4', 'Sharukh Khan', 'sharukh5.khan@example.com', '9775218504', '25d55ad283aa400af464c76d713c07ad', 'Habibpur, Sultanpur, Kalna', 'Purba Bardhaman', 'West Bengal', '713146', '961935602064', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'http://127.0.0.1/brahman-solution/public/upload/brahman/aadhaar-image/tK2FpWq9LeMdN7YxBvAZ.png', 'active', '2025-06-17 12:03:51', '2025-06-17 13:24:25'),
(7, 'tK2FpWq9LeMdN7YxBvA5', 'Sharukh Khan', 'sharukh6.khan@example.com', '9775218505', '25d55ad283aa400af464c76d713c07ad', 'Habibpur, Sultanpur, Kalna', 'Purba Bardhaman', 'West Bengal', '713146', '961935602065', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'http://127.0.0.1/brahman-solution/public/upload/brahman/aadhaar-image/tK2FpWq9LeMdN7YxBvAZ.png', 'active', '2025-06-17 12:03:51', '2025-06-17 13:24:56'),
(8, 'tK2FpWq9LeMdN7YxBvA6', 'Sharukh Khan', 'sharukh7.khan@example.com', '9775218506', '25d55ad283aa400af464c76d713c07ad', 'Habibpur, Sultanpur, Kalna', 'Purba Bardhaman', 'West Bengal', '713146', '961935602069', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'http://127.0.0.1/brahman-solution/public/upload/brahman/aadhaar-image/tK2FpWq9LeMdN7YxBvAZ.png', 'active', '2025-06-17 12:03:51', '2025-06-17 13:24:56'),
(9, 'tK2FpWq9LeMdN7YxBvA9', 'Sharukh Khan', 'sharukh9.khan@example.com', '9775218509', '25d55ad283aa400af464c76d713c07ad', 'Habibpur, Sultanpur, Kalna', 'Purba Bardhaman', 'West Bengal', '713146', '961935602070', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'http://127.0.0.1/brahman-solution/public/upload/brahman/aadhaar-image/tK2FpWq9LeMdN7YxBvAZ.png', 'active', '2025-06-17 12:03:51', '2025-06-17 13:24:56'),
(10, 'tK2FpWq9LeMdN7YxBvb0', 'Sharukh Khan', 'sharukh10.khan@example.com', '9775218510', '25d55ad283aa400af464c76d713c07ad', 'Habibpur, Sultanpur, Kalna', 'Purba Bardhaman', 'West Bengal', '713146', '961935602080', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'http://127.0.0.1/brahman-solution/public/upload/brahman/aadhaar-image/tK2FpWq9LeMdN7YxBvAZ.png', 'active', '2025-06-17 12:03:51', '2025-06-17 13:24:56'),
(11, 'tK2FpWq9LeMdN7YxBvb1', 'Sharukh Khan', 'sharukh11.khan@example.com', '9775218511', '25d55ad283aa400af464c76d713c07ad', 'Habibpur, Sultanpur, Kalna', 'Purba Bardhaman', 'West Bengal', '713146', '961935602081', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'http://127.0.0.1/brahman-solution/public/upload/brahman/aadhaar-image/tK2FpWq9LeMdN7YxBvAZ.png', 'inactive', '2025-06-17 12:03:51', '2025-06-17 16:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id` int(11) NOT NULL,
  `uniqcode` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `button_text` varchar(50) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `id` int(11) NOT NULL,
  `uniqcode` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `brahman_id` int(11) NOT NULL,
  `charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `booking_start_date` datetime NOT NULL,
  `booking_end_date` datetime NOT NULL,
  `status` enum('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  `payment_status` enum('pending','completed','failed','refunded') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE `tbl_event` (
  `id` int(11) NOT NULL,
  `uniqcode` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` enum('puja','event') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`id`, `uniqcode`, `name`, `description`, `image`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tK2FpWq9LeMdN7YxBvAZ', 'Test 5', 'Test Description', 'http://localhost/brahman-solution/public/uploads/events/1750238412_23fa78f191f3e636cf71.jpg', 'event', 'active', '2025-06-18 14:50:12', '2025-06-18 19:24:15'),
(6, 'nzeLkGXr62GjU97hLc65', 'Test 1', 'Test 1 Description', 'http://localhost/brahman-solution/public/uploads/events/1750241155_0de6acf9cf925d24e117.png', 'puja', 'active', '2025-06-18 15:35:55', NULL),
(7, 'u2AX7szIbFCOMzJ1mfJ7', 'Test 2', 'Test 2 Description', 'http://localhost/brahman-solution/public/uploads/events/1750241435_d19bcdb245caefa827a5.png', 'event', 'active', '2025-06-18 15:40:35', NULL),
(8, 'Gwmi2kMstazLxY6hjBpX', 'Test 3', 'Test 3 Description', 'http://localhost/brahman-solution/public/uploads/events/1750242104_7cca34eb14e0b7217f81.png', 'event', 'active', '2025-06-18 15:51:44', NULL),
(10, 'RjGlppU61zqddCB6IHvhjZexiUVSgk', 'Test 5', 'fasfas', 'uploads/events/1750318494_f47d9db8b2e82bdc58f2.png', 'puja', 'active', '2025-06-19 13:04:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `id` int(11) NOT NULL,
  `uniqcode` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` enum('general','puja','event','booking','other') NOT NULL DEFAULT 'general',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `id` int(11) NOT NULL,
  `uniqcode` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`id`, `uniqcode`, `name`, `email`, `password`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A7xLpQ93ZnVtKbE1RmYwDfT5HsCuXg', 'Admin', 'admin@example.com', '25d55ad283aa400af464c76d713c07ad', NULL, 'active', '2025-06-12 02:22:33', '2025-06-17 11:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `uniqcode` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `uniqcode`, `name`, `email`, `phone`, `password`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tK2FpWq9LeMdN7YxBvAZ', 'Sharukh Kkan', 'sharukh.khan@example.com', '9775218500', '25d55ad283aa400af464c76d713c07ad', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'active', '2025-06-17 19:01:09', '2025-06-18 11:33:49'),
(2, 'tK2FpWq9LeMdN7YxBvA1', 'Sharukh Kkan', 'sharukh1.khan@example.com', '9775218501', '25d55ad283aa400af464c76d713c07ad', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'active', '2025-06-17 19:01:09', NULL),
(3, 'tK2FpWq9LeMdN7YxBvA2', 'Sharukh Kkan', 'sharukh2.khan@example.com', '9775218502', '25d55ad283aa400af464c76d713c07ad', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'active', '2025-06-17 19:01:09', NULL),
(4, 'tK2FpWq9LeMdN7YxBvA3', 'Sharukh Kkan', 'sharukh3.khan@example.com', '9775218503', '25d55ad283aa400af464c76d713c07ad', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'active', '2025-06-17 19:01:09', NULL),
(5, 'tK2FpWq9LeMdN7YxBvA4', 'Sharukh Kkan', 'sharukh4.khan@example.com', '9775218504', '25d55ad283aa400af464c76d713c07ad', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'active', '2025-06-17 19:01:09', NULL),
(6, 'tK2FpWq9LeMdN7YxBvA5', 'Sharukh Kkan', 'sharukh5.khan@example.com', '9775218505', '25d55ad283aa400af464c76d713c07ad', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'active', '2025-06-17 19:01:09', NULL),
(7, 'tK2FpWq9LeMdN7YxBvA6', 'Sharukh Kkan', 'sharukh6.khan@example.com', '9775218506', '25d55ad283aa400af464c76d713c07ad', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'active', '2025-06-17 19:01:09', NULL),
(8, 'tK2FpWq9LeMdN7YxBvA7', 'Sharukh Kkan', 'sharukh7.khan@example.com', '9775218507', '25d55ad283aa400af464c76d713c07ad', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'active', '2025-06-17 19:01:09', NULL),
(9, 'tK2FpWq9LeMdN7YxBvA8', 'Sharukh Kkan', 'sharukh8.khan@example.com', '9775218508', '25d55ad283aa400af464c76d713c07ad', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'active', '2025-06-17 19:01:09', NULL),
(10, 'tK2FpWq9LeMdN7YxBvA9', 'Sharukh Kkan', 'sharukh9.khan@example.com', '9775218509', '25d55ad283aa400af464c76d713c07ad', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'active', '2025-06-17 19:01:09', NULL),
(11, 'tK2FpWq9LeMdN7YxBvb0', 'Sharukh Kkan', 'sharukh10.khan@example.com', '9775218510', '25d55ad283aa400af464c76d713c07ad', 'http://127.0.0.1/brahman-solution/public/upload/brahman/image/tK2FpWq9LeMdN7YxBvAZ.jpg', 'active', '2025-06-17 19:01:09', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqcode` (`uniqcode`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD UNIQUE KEY `aadhaar_no` (`aadhaar_no`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqcode` (`uniqcode`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `brahman_id` (`brahman_id`);

--
-- Indexes for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqcode` (`uniqcode`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqcode` (`uniqcode`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `uniqcode` (`uniqcode`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqcode` (`uniqcode`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_event`
--
ALTER TABLE `tbl_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD CONSTRAINT `tbl_booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_booking_ibfk_3` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tbl_booking_ibfk_4` FOREIGN KEY (`brahman_id`) REFERENCES `tbl_admin` (`id`) ON DELETE CASCADE;
COMMIT;

-- Create tbl_about_us table
CREATE TABLE `tbl_about_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniqcode` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniqcode` (`uniqcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert initial data
INSERT INTO `tbl_about_us` (`uniqcode`, `description`) VALUES
('ABOUT_001', 'Welcome to our About Us page. Please add your content here.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
