-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2021 at 06:26 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `token`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `address` varchar(300) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'branch_created_by_user',
  `status` varchar(30) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `address`, `contact`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Gulistan-e-Johar', '03415015616', 1, 'Active', '2021-10-02', '2021-10-02'),
(7, 'North Karachi', '034821451633', 7, 'Active', '2021-10-02', '2021-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_number` varchar(30) NOT NULL,
  `token_time` varchar(20) NOT NULL,
  `token_link` varchar(300) NOT NULL,
  `token_price` int(11) NOT NULL,
  `token_number` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `user_id`, `branch_id`, `company_id`, `customer_name`, `customer_number`, `token_time`, `token_link`, `token_price`, `token_number`, `status`, `created_at`, `updated_at`) VALUES
(21, 6, 6, 1, 'fafafa', '124141', '09:36 AM', 'rx1OGUJDbJ93jo7', 141, 1, 'Completed', '2021-10-02', '2021-10-02'),
(22, 6, 6, 1, 'fafasf', '414124', '09:48 AM', 'DiIAy2bf9LWfcaw', 414, 2, 'Waiting', '2021-10-02', '2021-10-02'),
(24, 8, 7, 7, 'Mohsin', '4141', '18:53 PM', 'clw4SSW03eUeFI0', 414, 1, 'Completed', '2021-10-02', '2021-10-02'),
(25, 6, 6, 1, 'Mohsin Javed', '923480214310', '09:19 AM', 'vmg7KORvG8LhdgJ', 150, 1, 'Completed', '2021-10-03', '2021-10-03'),
(26, 6, 6, 1, 'fafa', '923480214310', '09:38 AM', 'RXfmyWTpfgD9dhf', 123, 2, 'Waiting', '2021-10-03', '2021-10-03'),
(27, 6, 6, 1, 'fasfafs', '923480214310', '09:38 AM', 'aML3B1IHylXHYCw', 11, 3, 'Completed', '2021-10-03', '2021-10-03'),
(28, 6, 6, 1, 'fafafagagahah', '923480214310', '09:38 AM', 'tYfCxsMQ5IkIaSR', 144, 4, 'Waiting', '2021-10-03', '2021-10-03'),
(29, 6, 6, 1, 'ddfkgk', '923480214310', '09:38 AM', '1tp8roaGM9b5azk', 122, 5, 'Waiting', '2021-10-03', '2021-10-03'),
(30, 6, 6, 1, 'gagag', '923480214310', '09:39 AM', 'soCVbYlMr4ccyTr', 41415, 6, 'Waiting', '2021-10-03', '2021-10-03'),
(31, 6, 6, 1, 'LAst Customer', '923480214310', '09:39 AM', 'vqYAoA8IGlhTWKm', 123, 7, 'Waiting', '2021-10-03', '2021-10-03'),
(32, 6, 6, 1, 'Ahsan Javed', '923472084741', '09:59 AM', 'jKj2ZkPVQZxQAb6', 150, 8, 'Waiting', '2021-10-03', '2021-10-03'),
(33, 6, 6, 1, 'Mohsin', '531515151', '19:32 PM', 'pm6DzfLmd2koHcm', 150, 1, 'Completed', '2021-10-13', '2021-10-13'),
(34, 6, 6, 1, 'mmmmqew3q', '666', '20:14 PM', 'mXkRvqeW80PtuxI', 44, 2, 'Waiting', '2021-10-13', '2021-10-13'),
(35, 6, 6, 1, 'Mohsin Javed', '3480214310', '16:01 PM', 'tDyga6vAzgLOwEN', 150, 1, 'Completed', '2021-10-19', '2021-10-19');

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`id`, `name`, `cnic`, `contact`, `user_id`, `branch_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Fahad Ahmed', '421014162362362', '03495151626', 6, 6, 1, '2021-10-02', '2021-10-02'),
(2, 'Rauf Khan', '420141632121515', '03451613621', 8, 7, 7, '2021-10-02', '2021-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Operator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Active',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hamid clinic', 'hamid@gmail.com', '$2y$10$l8Y3eCtzNhpaGFPfuNL5augabyTaxKvhtrFkSiZTCCjC1WPYYiuXu', 1, 'Active', '2021-09-10', '2021-10-02'),
(6, 'Fahad Ahmed', 'f@gmail.com', '$2y$10$rMp3M103P2neoIXIwGoIQ.xqtYLfDGtyK41JjK3TSx/adfy9v054.', 2, 'Active', '2021-10-02', '2021-10-02'),
(7, 'The Barber Shop', 'b@gmail.com', '$2y$10$rMp3M103P2neoIXIwGoIQ.xqtYLfDGtyK41JjK3TSx/adfy9v054.', 1, 'Active', '2021-10-02', '2021-10-02'),
(8, 'Rauf Khan', 'r@gmail.com', '$2y$10$bCrUf7dCdCGvMJy0i/37T.C49T3trg6UlnJfvpRH3fbj.StAAo2BW', 2, 'Active', '2021-10-02', '2021-10-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `address` (`address`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `counters`
--
ALTER TABLE `counters`
  ADD CONSTRAINT `counters_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `counters_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `counters_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `operators`
--
ALTER TABLE `operators`
  ADD CONSTRAINT `operators_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `operators_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `operators_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
