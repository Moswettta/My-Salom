-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 02:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin', 'admin', 'benjaminmosweta@gmail.com', 'd08e6a815f7f9aab031b0aa7fb02c2879cb9ceda');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `service` varchar(255) NOT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `service_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `c_id`, `date`, `time`, `service`, `status`, `created_at`, `service_name`, `price`, `employee_id`) VALUES
(38, 356999999, '2024-07-12', '19:24:00', '16', 'Approved', '2024-07-12 16:24:29', 'pedicure', 5000, 3),
(39, 356999999, '2024-07-12', '19:30:00', '16', 'Rejected', '2024-07-12 16:30:40', 'pedicure', 5000, NULL),
(40, 798758578, '2024-07-23', '22:27:00', '16', 'Approved', '2024-07-23 19:27:29', 'pedicure', 5000, 3),
(41, 77786868, '2024-07-24', '00:24:00', '16', 'Approved', '2024-07-23 21:24:59', 'pedicure', 5000, 3),
(42, 889989999, '2024-08-23', '12:18:00', '17', 'Approved', '2024-08-23 09:18:34', 'scrapping', 9000, 3),
(43, 77786868, '2024-09-04', '14:00:00', '16', 'Approved', '2024-09-04 11:00:21', 'pedicure', 5000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_completions`
--

CREATE TABLE `appointment_completions` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `completion_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `status` enum('Completed','Not Completed') NOT NULL DEFAULT 'Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_completions`
--

INSERT INTO `appointment_completions` (`id`, `appointment_id`, `employee_id`, `completion_date`, `client_name`, `service_name`, `status`) VALUES
(14, 41, 3, '2024-07-24', 'abu ', 'pedicure', 'Completed'),
(15, 43, 3, '2024-09-04', 'abu ', 'pedicure', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `checkout_details`
--

CREATE TABLE `checkout_details` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout_details`
--

INSERT INTO `checkout_details` (`id`, `appointment_id`, `client_id`, `amount`, `payment_status`, `payment_date`) VALUES
(11, 38, 356999999, 5000.00, 'Completed', '2024-07-12 16:28:51'),
(12, 41, 77786868, 5000.00, 'Completed', '2024-07-24 05:21:33'),
(13, 42, 889989999, 9000.00, 'Completed', '2024-08-23 09:31:06');

-- --------------------------------------------------------

--
-- Table structure for table `client_employee_allocation`
--

CREATE TABLE `client_employee_allocation` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`) VALUES
(3, 'ben', 'ben', 'ben@gmail.com', '0798458270', '$2y$10$.RU7t/iVQ3m/5MmGscZ2deqOrREfIuJ9jag2KOTyDLif5RyPf6iKi'),
(4, 'abu', 'abu', 'abu@gmail.com', '0798458270', '$2y$10$nPExy3f3GsGfxloMvAzvc.cwSWll6qsMUevU9p2iYH064/NMYg/Sa');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_c` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `reply` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_c`, `title`, `body`, `status`, `reply`) VALUES
(1, '32353534', '', 'hey', 0, ''),
(2, '32353534', '', 'hey', 1, 'hello'),
(3, '356999999', '', 'hello', 0, ''),
(4, '889989999', '', ',.k', 1, 'm');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `name`, `description`, `price`, `duration`, `type_id`) VALUES
(16, 'pedicure', 'pedicure', 5000.00, 20, 3),
(17, 'scrapping', 'g', 9000.00, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `name`) VALUES
(8, 'ficial'),
(3, 'Massage');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `c_id` int(11) NOT NULL,
  `c_tel` varchar(255) NOT NULL,
  `type` enum('Customer','Receptionist','Other') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `fname`, `sname`, `c_id`, `c_tel`, `type`, `created_at`) VALUES
(14, 'abu', 'abu@gmail.com', '73fddef46cbcf6b91b2a2da18643439a9b666f4f', 'abu', '', 77786868, '0798458270', 'Customer', '2024-07-23 21:24:38'),
(15, 'abu@gmail.com', 'abu@gmail.com', '73fddef46cbcf6b91b2a2da18643439a9b666f4f', 'Benjamin', '', 889989999, '0798458270', 'Customer', '2024-08-23 09:17:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_appointments_employees` (`employee_id`);

--
-- Indexes for table `appointment_completions`
--
ALTER TABLE `appointment_completions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_appointment_completions_appointments` (`appointment_id`),
  ADD KEY `fk_appointment_completions_employees` (`employee_id`);

--
-- Indexes for table `checkout_details`
--
ALTER TABLE `checkout_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_checkout_appointment` (`appointment_id`);

--
-- Indexes for table `client_employee_allocation`
--
ALTER TABLE `client_employee_allocation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `fk_services_types` (`type_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `appointment_completions`
--
ALTER TABLE `appointment_completions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `checkout_details`
--
ALTER TABLE `checkout_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `client_employee_allocation`
--
ALTER TABLE `client_employee_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_appointments_employees` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `appointment_completions`
--
ALTER TABLE `appointment_completions`
  ADD CONSTRAINT `fk_appointment_completions_appointments` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_appointment_completions_employees` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `checkout_details`
--
ALTER TABLE `checkout_details`
  ADD CONSTRAINT `fk_checkout_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_employee_allocation`
--
ALTER TABLE `client_employee_allocation`
  ADD CONSTRAINT `client_employee_allocation_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_employee_allocation_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
