-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2025 at 07:51 AM
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
-- Database: `disaster_relief`
--

-- --------------------------------------------------------

--
-- Table structure for table `disasters`
--

CREATE TABLE `disasters` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `severity` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disasters`
--

INSERT INTO `disasters` (`id`, `name`, `location`, `severity`, `date`) VALUES
(1, 'Flood 2025', 'Sylhet', 'High', '2025-08-10'),
(2, 'Cyclone Remal', 'Khulna', 'Severe', '2025-06-15'),
(3, 'Earthquake', 'Chattogram', 'Medium', '2025-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `distribution`
--

CREATE TABLE `distribution` (
  `id` int(11) NOT NULL,
  `victim_id` int(11) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `quantity_given` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` enum('Pending','Delivered') DEFAULT 'Pending',
  `volunteer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distribution`
--

INSERT INTO `distribution` (`id`, `victim_id`, `resource_id`, `quantity_given`, `date`, `status`, `volunteer_id`) VALUES
(1, 1, 1, 5, '2025-08-11', 'Delivered', 2),
(2, 1, 2, 2, '2025-08-11', 'Delivered', 2),
(3, 2, 1, 3, '2025-08-11', 'Pending', 2),
(4, 3, 3, 1, '2025-06-16', 'Delivered', 3),
(5, 4, 2, 2, '2025-06-16', 'Delivered', 3),
(6, 5, 4, 1, '2025-07-21', 'Pending', 2),
(7, 6, 5, 1, '2025-07-21', 'Delivered', 3);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `name`, `quantity`, `description`) VALUES
(1, 'Rice', 500, 'Relief rice packets'),
(2, 'Drinking Water', 300, 'Bottled water'),
(3, 'Medicine', 200, 'First aid medicines'),
(4, 'Blanket', 150, 'Winter blankets'),
(5, 'Dry Food', 400, 'Biscuits and dry food');

-- --------------------------------------------------------

--
-- Table structure for table `shelters`
--

CREATE TABLE `shelters` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `available_slots` int(11) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shelters`
--

INSERT INTO `shelters` (`id`, `name`, `location`, `capacity`, `available_slots`, `contact`) VALUES
(5, 'Flood Relief Camp', 'Sylhet', 300, 80, '01810000002'),
(6, 'Cyclone Shelter', 'Chattogram', 400, 200, '01910000003'),
(7, 'Riverbank Shelter', 'Barishal', 250, 50, '01710000004'),
(8, 'Storm Relief Camp', 'Khulna', 350, 100, '01810000005'),
(9, 'Hill Area Shelter', 'Rangpur', 200, 70, '01910000006'),
(10, 'Eastern Flood Shelter', 'Cox\'s Bazar', 300, 90, '01710000007'),
(11, 'Northern Shelter', 'Rajshahi', 400, 150, '01810000008'),
(12, 'Urban Emergency Shelter', 'Dhaka', 600, 180, '01910000009'),
(13, 'Sylhet Flood Camp', 'Sylhet', 350, 120, '01710000010');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','volunteer') DEFAULT 'volunteer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'saif islam sohan', 'saif@gmail.com', '$2y$10$YQXFCAyFrbWRHLJxH8pC3OKfnMt/3xSj9wly/4o8rOYg39agNUJme', 'admin'),
(2, 'Towhidur Rahman Faham', 'faham@gmail.com', '$2y$10$wMx7CSmJRH2eeLHrieKkN.9Cbx6Y8rznhNJczOoy1PKdQ0zSRuYmm', 'volunteer'),
(3, 'Mohibur Rahman', 'mohib@gmail.com', '$2y$10$k9orpsL5l3QXyw0n/BUefO9rU0U9sHBZtEEJYBziX37FQKVaPutQ.', 'volunteer');

-- --------------------------------------------------------

--
-- Table structure for table `victims`
--

CREATE TABLE `victims` (
  `id` int(11) NOT NULL,
  `disaster_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `victims`
--

INSERT INTO `victims` (`id`, `disaster_id`, `name`, `age`, `contact`, `address`) VALUES
(1, 1, 'Rahim Uddin', 35, '01711111111', 'Sylhet Sadar'),
(2, 1, 'Karim Mia', 50, '01722222222', 'Beanibazar'),
(3, 2, 'Ayesha Begum', 28, '01833333333', 'Khulna City'),
(4, 2, 'Salma Akter', 40, '01844444444', 'Paikgacha'),
(5, 3, 'Hasan Ali', 60, '01955555555', 'Pahartali'),
(6, 3, 'Rafiq Ahmed', 45, '01966666666', 'Agrabad');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_assign`
--

CREATE TABLE `volunteer_assign` (
  `id` int(11) NOT NULL,
  `volunteer_id` int(11) DEFAULT NULL,
  `disaster_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteer_assign`
--

INSERT INTO `volunteer_assign` (`id`, `volunteer_id`, `disaster_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 3, 2),
(4, 3, 3),
(5, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disasters`
--
ALTER TABLE `disasters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distribution`
--
ALTER TABLE `distribution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `victim_id` (`victim_id`),
  ADD KEY `resource_id` (`resource_id`),
  ADD KEY `volunteer_id` (`volunteer_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shelters`
--
ALTER TABLE `shelters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `victims`
--
ALTER TABLE `victims`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disaster_id` (`disaster_id`);

--
-- Indexes for table `volunteer_assign`
--
ALTER TABLE `volunteer_assign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `volunteer_id` (`volunteer_id`),
  ADD KEY `disaster_id` (`disaster_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disasters`
--
ALTER TABLE `disasters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `distribution`
--
ALTER TABLE `distribution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shelters`
--
ALTER TABLE `shelters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `victims`
--
ALTER TABLE `victims`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `volunteer_assign`
--
ALTER TABLE `volunteer_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `distribution`
--
ALTER TABLE `distribution`
  ADD CONSTRAINT `distribution_ibfk_1` FOREIGN KEY (`victim_id`) REFERENCES `victims` (`id`),
  ADD CONSTRAINT `distribution_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`),
  ADD CONSTRAINT `distribution_ibfk_3` FOREIGN KEY (`volunteer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `victims`
--
ALTER TABLE `victims`
  ADD CONSTRAINT `victims_ibfk_1` FOREIGN KEY (`disaster_id`) REFERENCES `disasters` (`id`);

--
-- Constraints for table `volunteer_assign`
--
ALTER TABLE `volunteer_assign`
  ADD CONSTRAINT `volunteer_assign_ibfk_1` FOREIGN KEY (`volunteer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `volunteer_assign_ibfk_2` FOREIGN KEY (`disaster_id`) REFERENCES `disasters` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
