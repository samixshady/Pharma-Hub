-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2023 at 10:05 PM
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
-- Database: `Pharma_Hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `patient_list`
--

CREATE TABLE `patient_list` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patient_list`
--

INSERT INTO `patient_list` (`id`, `username`, `password`, `email`, `create_at`) VALUES
(2, 'testt', '$2y$10$UnNtulkrHlst1HU448K7oOcqnnUGSL1/Gp2aR2/E57rkVHnYNoSIy', 'testt@test.com', '2023-08-16 14:59:08'),
(5, 'test', '$2y$10$/Typs1y.v1W.63hTsQocoOsU89YkSd.AvC60Q2oAxkM1aqnf0Z5bi', 'test@test.com', '2023-08-18 18:39:14'),
(6, 'wee', '$2y$10$hHw8dJvBDoRw0TokpuioLOtCWuiO.2VKP9ElmdiI1JlmWcwtRVIx.', 'wee@wee.com', '2023-08-18 18:48:04'),
(7, 'yes', '$2y$10$zHpRxr79i26rXxCcPeBX6uuBW8Chlc/dC2Y.wnJp2PbEQFULK4vTG', 'yes@yes.com', '2023-08-18 19:16:40');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `username`, `comment`, `rating`) VALUES
(1, 'sami', 'thank u yes', 3),
(2, 'sami', 'thank u yes', 3),
(3, 'michael jackson', 'very good service nice nice', 5),
(4, 'ojnoj', 'vreve', 5),
(5, 'michael jackson', 'very good service nice nice', 5),
(6, 'yes', 'yes its good', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `age` int(2) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `address`, `phone`, `age`, `email`) VALUES
('64dfca794aa5a', 'Fahmida', 'odkodo', '1922681791', 45, 'fariha.fhf@gmail.com'),
('64dfca7b91954', '', '', '0', 0, ''),
('64dfcabf93636', 'Fahmida', 'asssr4eer', '1922681791', 66, 'fariha.fhf@gmail.com'),
('64dfcb7f9bdc5', 'Fahmida', 'dkkdkdkdk', '1922681791', 55, 'fariha.fhf@gmail.com'),
('64dfcc9202585', 'Fahmida', 'ejiweiuweui', '01922681791', 98, 'fariha.fhf@gmail.com'),
('64dfcdeab080b', 'test', 'test', '6969', 1, 'test@test.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_list`
--
ALTER TABLE `patient_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_list`
--
ALTER TABLE `patient_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
