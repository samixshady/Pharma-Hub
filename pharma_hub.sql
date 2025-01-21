-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2023 at 09:20 PM
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
-- Database: `pharma_hub`
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
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `lifeline_pharmacy`
--

CREATE TABLE `lifeline_pharmacy` (
  `drug_ID` int(11) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lifeline_pharmacy`
--

INSERT INTO `lifeline_pharmacy` (`drug_ID`, `medicine_name`, `price`, `stock`) VALUES
(101, 'Paracetamol 500 mg', 10, 20),
(103, 'Amoxicillin 500 mg', 60, 30);

-- --------------------------------------------------------

--
-- Table structure for table `medicare_pharmacy`
--

CREATE TABLE `medicare_pharmacy` (
  `drug_ID` int(11) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicare_pharmacy`
--

INSERT INTO `medicare_pharmacy` (`drug_ID`, `medicine_name`, `price`, `stock`) VALUES
(101, 'Paracetamol 500 mg', 10, 50),
(102, 'Omeprazole 500mg', 20, 50);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `manufacturing_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `description`, `price`, `manufacturer`, `manufacturing_date`, `expiry_date`, `quantity`, `category`, `image_url`) VALUES
(1, 'Panadol', 'Fever and pain reliever', 30.99, 'Square Pharmaceuticals', '2022-01-01', '2024-12-31', 100, 'Fever and Pain', 'images/Panadol-Advance.jpg'),
(2, 'Napa', 'Pain relief medication', 15.49, 'Beximco Pharmaceuticals', '2021-11-15', '2025-05-31', 150, 'Pain Relief', 'images/ace-500-1631364310354.webp'),
(3, 'Augmentin', 'Antibiotic medication', 40.25, 'Incepta Pharmaceuticals', '2022-03-05', '2025-04-30', 200, 'Antibiotics', 'images/pczpgdubgtwpef5d67c2a22ec7b.webp'),
(4, 'Metronidazole', 'Antibiotic medication', 20.99, 'Square Pharmaceuticals', '2022-06-20', '2025-03-15', 50, 'Antibiotics', 'images/Metronidazole-400-Tablet-3.jpg'),
(5, 'Atorvastatin', 'Cholesterol-lowering medication', 35.75, 'Beximco Pharmaceuticals', '2021-09-10', '2025-02-28', 30, 'Cholesterol Control', 'images/1bbaa0e5-a623-466f-8c44-d1f0c12825e7-500x500.webp'),
(6, 'Sertraline', 'Antidepressant medication', 28.75, 'ACI Limited', '2022-02-15', '2024-11-14', 40, 'Antidepressants', 'images/serta-100-mg-500x500-500x500.webp'),
(7, 'Vitamin B Complex', 'Essential vitamin supplement', 10.99, 'Renata Limited', NULL, NULL, 100, 'Vitamins', 'images/natures-aid-vitamin-b-complex-p124-63_image-1.webp'),
(8, 'Cetirizine', 'Allergy relief medication', 8.49, 'Square Pharmaceuticals', '2022-04-10', '2025-01-09', 80, 'Allergy Relief', 'images/91v4-3E3AlL._AC_UF1000,1000_QL80_.jpg'),
(9, 'Doxycycline', 'Antibiotic medication', 28.25, 'Incepta Pharmaceuticals', '2021-08-05', '2024-10-04', 60, 'Antibiotics', 'images/20220511_081406_321618_doxycyclin-100mg.max-1800x1800.png'),
(10, 'Montelukast', 'Allergy relief medication', 12.99, 'Beximco Pharmaceuticals', '2022-03-20', '2025-02-19', 70, 'Allergy Relief', 'images/montiar.webp'),
(11, 'Amlodipine', 'Blood pressure medication', 24.50, 'ACI Limited', '2022-05-12', '2024-06-11', 25, 'Heart Health', 'images/amlodipine.jpg'),
(12, 'Gliclazide', 'Diabetes medication', 18.25, 'Square Pharmaceuticals', '2021-10-18', '2025-01-17', 30, 'Diabetes', 'images/Gliclazide-80-Tablets.jpg'),
(13, 'Omeprazole', 'Acid reflux medication', 30.75, 'Beximco Pharmaceuticals', '2022-07-03', '2024-12-02', 40, 'Digestive Health', 'images/omeprazole.webp'),
(14, 'Levothyroxine', 'Thyroid hormone replacement', 20.99, 'ACI Limited', '2021-12-15', '2025-01-14', 20, 'Hormone Replacement', 'images/levoth.png'),
(15, 'Mefenamic Acid', 'Pain relief medication', 12.49, 'Square Pharmaceuticals', '2022-09-08', '2025-04-07', 60, 'Pain Relief', 'images/mefmic-p-tablets-mefenamic-acid-paracetamol-tablets.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_list`
--

CREATE TABLE `medicine_list` (
  `drug_ID` int(11) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_list`
--

INSERT INTO `medicine_list` (`drug_ID`, `medicine_name`, `price`) VALUES
(101, 'Paracetamol 500 mg', 10),
(102, 'Omeprazole 500 mg', 20),
(103, 'Amoxicillin 500 mg', 60),
(104, 'Fluconazole 150 mg', 40),
(105, 'Azithromycin 500 mg', 150),
(106, 'Ciprofloxacin 500 mg', 60),
(107, 'Diclofenac 50 mg', 40),
(108, 'Metronidazole 200 mg', 20),
(109, 'Ranitidine 150 mg', 40),
(110, 'Amlodipine 5 mg', 30),
(111, 'Atorvastatin 10 mg', 60),
(112, 'Metformin 500 mg', 40),
(113, 'Glimepiride 2 mg', 60),
(114, 'Fluconazole 150 mg', 35),
(115, 'Ibuprofen 400 mg', 45);

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
(5, 'test', '$2y$10$dnmrLrlhxcFG6wDawzGbPuJg2/uZgh8tGb1JpVkKdAsWzgpVuJgpa', 'test@test.com', '2023-08-25 18:57:43'),
(6, 'wee', '$2y$10$hHw8dJvBDoRw0TokpuioLOtCWuiO.2VKP9ElmdiI1JlmWcwtRVIx.', 'wee@wee.com', '2023-08-18 18:48:04'),
(7, 'yes', '$2y$10$zHpRxr79i26rXxCcPeBX6uuBW8Chlc/dC2Y.wnJp2PbEQFULK4vTG', 'yes@yes.com', '2023-08-18 19:16:40'),
(8, 'sam', '$2y$10$GGLhh9vAbcywzI84ceaXSe7RnhFsq0i6KBCkKtF3a5ZopMNXGhrM2', 'sam@gmail.com', '2023-08-21 05:26:48'),
(10, 'Ferrari', '$2y$10$YxNCm.dhEK.UODrZVIFHCezZoI6QgoJKKaysEmSLljLnycBUlhSlO', 'Ferrari@Ferrari', '2023-08-25 19:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `store_ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`store_ID`, `name`, `phone_number`, `location`) VALUES
(1001, 'MediCare Pharmacy', 1912345675, 'Uttara'),
(1002, 'LifeLine Pharmacy', 1711223344, 'Gulshan'),
(1003, 'Prime Pharmacy', 1601336627, 'Dhanmondi');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_stores_medicine`
--

CREATE TABLE `pharmacy_stores_medicine` (
  `store_ID` int(11) NOT NULL,
  `drug_ID` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_stores_medicine`
--

INSERT INTO `pharmacy_stores_medicine` (`store_ID`, `drug_ID`, `stock`) VALUES
(1001, 101, 50),
(1002, 101, 30),
(1003, 102, 20),
(1002, 103, 30),
(1001, 106, 25),
(1001, 107, 40),
(1001, 106, 25),
(1001, 107, 40),
(1002, 108, 45),
(1002, 107, 20),
(1003, 101, 70),
(1003, 109, 40),
(1003, 110, 15),
(1001, 111, 35),
(1001, 112, 55),
(1003, 113, 45),
(1003, 112, 20),
(1002, 113, 25),
(1002, 115, 30),
(1001, 114, 60);

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
(6, 'yes', 'yes its good', 4),
(7, 'yesss', 'yessss', 5);

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
('u001', 'Fariha', 'Uttara', '01922681791', 22, 'fariha.fhf@gmail.com'),
('u002', 'Joseph', 'Dhamnondi', '3893923739', 56, 'joe.azwad@gmail.com'),
('u003', 'Jamie', 'Dhanmondi', '3939398', 65, 'jamie@gmail.com'),
('u004', 'cena', 'massachussets', '01144444', 12, 'cena@cena'),
('u005', 'test', 'testtt', 'test', 69, 'test@test.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_carts`
--

CREATE TABLE `user_carts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_carts`
--

INSERT INTO `user_carts` (`id`, `username`, `medicine_id`, `medicine_name`, `quantity`) VALUES
(48, 'wee', 8, 'Maow', 2),
(49, 'wee', 9, 'Woof', 2),
(50, 'wee', 10, 'harry', 2),
(51, 'yes', 8, 'Maow', 1),
(52, 'yes', 9, 'Woof', 1),
(53, 'yes', 10, 'harry', 2),
(55, 'sam', 10, 'harry', 1),
(57, '', 2, 'Napa', 3),
(61, 'test', 2, 'Napa', 6),
(62, 'test', 1, 'Panadol', 10),
(63, 'sam', 2, 'Napa', 4),
(64, 'sam', 1, 'Panadol', 2),
(65, 'sam', 7, 'Vitamin B Complex', 6),
(66, 'admin', 1, 'Panadol', 2),
(67, 'admin', 2, 'Napa', 4),
(68, 'cena', 1, 'Panadol', 29),
(69, 'cena', 2, 'Napa', 2),
(70, 'test', 3, 'Augmentin', 1),
(71, 'test', 11, 'Amlodipine', 1),
(78, 'Ferrari', 1, 'Panadol', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
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
-- Indexes for table `user_carts`
--
ALTER TABLE `user_carts`
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
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `patient_list`
--
ALTER TABLE `patient_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_carts`
--
ALTER TABLE `user_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
