-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2026 at 08:46 AM
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
-- Database: `utop`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `city_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`, `city_id`) VALUES
(1, 'partap nagar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state_id`) VALUES
(1, 'Jaipur', 21),
(2, 'Jodhpur', 21),
(3, 'Udaipur', 21),
(4, 'Kota', 21),
(5, 'Bikaner', 21),
(6, 'Ajmer', 21),
(7, 'Mumbai', 14),
(8, 'Pune', 14),
(9, 'Nagpur', 14),
(10, 'Nashik', 14),
(11, 'Aurangabad', 14),
(12, 'Ahmedabad', 7),
(13, 'Surat', 7),
(14, 'Vadodara', 7),
(15, 'Rajkot', 7),
(16, 'Bhavnagar', 7),
(17, 'Bangalore', 11),
(18, 'Mysore', 11),
(19, 'Mangalore', 11),
(20, 'Hubli', 11),
(21, 'Belgaum', 11),
(22, 'Chennai', 23),
(23, 'Coimbatore', 23),
(24, 'Madurai', 23),
(25, 'Salem', 23),
(26, 'Trichy', 23),
(27, 'Lucknow', 26),
(28, 'Kanpur', 26),
(29, 'Varanasi', 26),
(30, 'Agra', 26),
(31, 'Meerut', 26),
(32, 'New Delhi', 29),
(33, 'Dwarka', 29),
(34, 'Rohini', 29),
(35, 'Saket', 29),
(36, 'Karol Bagh', 29),
(37, 'Kolkata', 28),
(38, 'Howrah', 28),
(39, 'Durgapur', 28),
(40, 'Asansol', 28),
(41, 'Hyderabad', 24),
(42, 'Warangal', 24),
(43, 'Visakhapatnam', 1),
(44, 'Vijayawada', 1),
(45, 'Guntur', 1),
(46, 'Kochi', 12),
(47, 'Trivandrum', 12),
(48, 'Kozhikode', 12),
(49, 'Amritsar', 20),
(50, 'Ludhiana', 20),
(51, 'Jalandhar', 20),
(52, 'Gurgaon', 8),
(53, 'Faridabad', 8),
(54, 'Panipat', 8),
(55, 'Bhopal', 13),
(56, 'Indore', 13),
(57, 'Gwalior', 13),
(58, 'Patna', 4),
(59, 'Gaya', 4),
(60, 'Bhubaneswar', 19),
(61, 'Cuttack', 19),
(62, 'Guwahati', 3),
(63, 'Ranchi', 10),
(64, 'Dehradun', 27),
(65, 'Shimla', 9),
(66, 'Panaji', 6);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'India'),
(2, 'United States'),
(3, 'United Kingdom'),
(4, 'Canada'),
(5, 'Australia'),
(6, 'Germany'),
(7, 'France'),
(8, 'Italy'),
(9, 'Spain'),
(10, 'Brazil'),
(11, 'China'),
(12, 'Japan'),
(13, 'Russia'),
(14, 'South Korea'),
(15, 'Mexico'),
(16, 'Indonesia'),
(17, 'Saudi Arabia'),
(18, 'South Africa'),
(19, 'Netherlands'),
(20, 'Switzerland'),
(21, 'Sweden'),
(22, 'Norway'),
(23, 'Denmark'),
(24, 'Finland'),
(25, 'New Zealand'),
(26, 'Singapore'),
(27, 'Malaysia'),
(28, 'Thailand'),
(29, 'Vietnam'),
(30, 'Philippines'),
(31, 'Pakistan'),
(32, 'Bangladesh'),
(33, 'Sri Lanka'),
(34, 'Nepal'),
(35, 'Afghanistan'),
(36, 'Turkey'),
(37, 'UAE'),
(38, 'Qatar'),
(39, 'Kuwait'),
(40, 'Oman'),
(41, 'Israel'),
(42, 'Egypt'),
(43, 'Nigeria'),
(44, 'Kenya'),
(45, 'Argentina'),
(46, 'Chile'),
(47, 'Colombia'),
(48, 'Peru'),
(49, 'Poland'),
(50, 'Belgium'),
(51, 'Austria'),
(52, 'Ireland'),
(53, 'Portugal'),
(54, 'Greece'),
(55, 'Czech Republic'),
(56, 'Hungary'),
(57, 'Romania'),
(58, 'Ukraine'),
(59, 'Belarus'),
(60, 'Kazakhstan');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`) VALUES
(1, 'Electrician'),
(2, 'Plumber'),
(3, 'Carpenter'),
(4, 'Painter'),
(5, 'AC Repair'),
(6, 'Fridge Repair'),
(7, 'Washing Machine Repair'),
(8, 'Mobile Repair'),
(9, 'Computer Repair'),
(10, 'Laptop Repair'),
(11, 'TV Repair'),
(12, 'CCTV Installation'),
(13, 'RO Service'),
(14, 'Home Cleaning'),
(15, 'Pest Control'),
(16, 'Driver'),
(17, 'Cook'),
(18, 'Gardener'),
(19, 'Mechanic'),
(20, 'Tailor'),
(21, 'Beautician'),
(22, 'Hair Stylist'),
(23, 'Makeup Artist'),
(24, 'Photographer'),
(25, 'Event Planner'),
(26, 'Packers & Movers'),
(27, 'Interior Designer'),
(28, 'Construction Worker'),
(29, 'Security Guard');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(1, 'Andhra Pradesh', 1),
(2, 'Arunachal Pradesh', 1),
(3, 'Assam', 1),
(4, 'Bihar', 1),
(5, 'Chhattisgarh', 1),
(6, 'Goa', 1),
(7, 'Gujarat', 1),
(8, 'Haryana', 1),
(9, 'Himachal Pradesh', 1),
(10, 'Jharkhand', 1),
(11, 'Karnataka', 1),
(12, 'Kerala', 1),
(13, 'Madhya Pradesh', 1),
(14, 'Maharashtra', 1),
(15, 'Manipur', 1),
(16, 'Meghalaya', 1),
(17, 'Mizoram', 1),
(18, 'Nagaland', 1),
(19, 'Odisha', 1),
(20, 'Punjab', 1),
(21, 'Rajasthan', 1),
(22, 'Sikkim', 1),
(23, 'Tamil Nadu', 1),
(24, 'Telangana', 1),
(25, 'Tripura', 1),
(26, 'Uttar Pradesh', 1),
(27, 'Uttarakhand', 1),
(28, 'West Bengal', 1),
(29, 'Andaman and Nicobar Islands', 1),
(30, 'Chandigarh', 1),
(31, 'Dadra and Nagar Haveli and Daman and Diu', 1),
(32, 'Delhi', 1),
(33, 'Jammu and Kashmir', 1),
(34, 'Ladakh', 1),
(35, 'Lakshadweep', 1),
(36, 'Puducherry', 1),
(37, 'kajakisthan', 35);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `user_type` varchar(10) NOT NULL DEFAULT 'u',
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
