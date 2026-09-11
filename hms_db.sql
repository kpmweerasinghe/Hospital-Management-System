-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2026 at 08:19 PM
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
-- Database: `hms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` varchar(30) DEFAULT 'Scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `patient_id`, `doctor_id`, `appointment_date`, `appointment_time`, `status`, `created_at`) VALUES
(1, 1, 1, '2026-12-09', '10:00:00', 'Cancelled', '2026-09-10 10:02:23'),
(2, 1, 1, '2026-09-14', '11:00:00', 'Scheduled', '2026-09-10 10:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `bill_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `bill_date` date NOT NULL,
  `consultation_charge` decimal(10,2) DEFAULT 0.00,
  `laboratory_charge` decimal(10,2) DEFAULT 0.00,
  `pharmacy_charge` decimal(10,2) DEFAULT 0.00,
  `admission_charge` decimal(10,2) DEFAULT 0.00,
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `payment_status` varchar(30) DEFAULT 'Pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`bill_id`, `patient_id`, `bill_date`, `consultation_charge`, `laboratory_charge`, `pharmacy_charge`, `admission_charge`, `total_amount`, `payment_status`, `payment_method`, `payment_date`) VALUES
(1, 1, '2026-09-10', 2000.00, 1500.00, 1000.00, 0.00, 4500.00, 'Paid', 'Cash', '2026-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(1, 'Cardiology'),
(2, 'General Medicine'),
(3, 'Pediatrics'),
(4, 'Orthopedics'),
(5, 'Neurology'),
(6, 'Emergency');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `doctor_name`, `specialization`, `phone`, `email`, `department_id`) VALUES
(1, 'Dr. John Fernando', 'Cardiologist', '0773691201', 'john@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedules`
--

CREATE TABLE `doctor_schedules` (
  `schedule_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day_of_week` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_schedules`
--

INSERT INTO `doctor_schedules` (`schedule_id`, `doctor_id`, `day_of_week`, `start_time`, `end_time`) VALUES
(1, 1, 'Wednesday', '10:00:00', '13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_tests`
--

CREATE TABLE `laboratory_tests` (
  `test_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `sample_status` varchar(50) DEFAULT 'Pending',
  `result` text DEFAULT NULL,
  `test_status` varchar(50) DEFAULT 'Requested',
  `requested_date` date DEFAULT NULL,
  `result_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laboratory_tests`
--

INSERT INTO `laboratory_tests` (`test_id`, `patient_id`, `doctor_id`, `test_name`, `sample_status`, `result`, `test_status`, `requested_date`, `result_date`) VALUES
(1, 1, 1, 'Full Blood Count', 'Collected', 'WBC: 3.4\r\nHB: 12\r\nPLT: 320000', 'Result Ready', '2026-09-10', '2026-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `record_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `diagnosis` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `prescription` text DEFAULT NULL,
  `visit_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_records`
--

INSERT INTO `medical_records` (`record_id`, `patient_id`, `doctor_id`, `diagnosis`, `treatment`, `prescription`, `visit_date`) VALUES
(1, 1, 1, '    Fever', '    Rest and adequate fluids', '    paracetamol 500mg', '2026-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `unit_price` decimal(10,2) DEFAULT 0.00,
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`medicine_id`, `medicine_name`, `category`, `quantity`, `unit_price`, `expiry_date`, `created_at`) VALUES
(1, 'Paracetamol', 'Painkiller', 100, 25.00, '2027-12-31', '2026-09-10 13:53:15'),
(2, 'azithromycin', 'antibiotic', 50, 80.00, '2028-03-31', '2026-09-10 13:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `first_name`, `last_name`, `dob`, `gender`, `phone`, `email`, `address`, `blood_group`, `created_at`) VALUES
(1, 'Pavani', 'Weerasinghe', '2003-11-09', 'Female', '0766769200', 'malindipawani11@gmail.com', 'No:32/3, Maligathanna, Veyangoda.', 'B+', '2026-09-10 08:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `patient_documents`
--

CREATE TABLE `patient_documents` (
  `document_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_documents`
--

INSERT INTO `patient_documents` (`document_id`, `patient_id`, `document_name`, `file_path`, `uploaded_at`) VALUES
(1, 1, 'NIC.pdf', 'uploads/patient_1_1789064068_6aa2f3845fb6c.pdf', '2026-09-10 18:14:28');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_prescriptions`
--

CREATE TABLE `pharmacy_prescriptions` (
  `prescription_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `prescription_date` date NOT NULL,
  `status` varchar(30) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Doctor'),
(3, 'Nurse'),
(4, 'Receptionist'),
(5, 'Lab Staff'),
(6, 'Pharmacist'),
(7, 'Accountant');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role_id`, `status`) VALUES
(1, 'admin', '$2y$10$A3KksETorZcdddrkRXo9M.448UFRoOFsQ9ZwiZUwIl/FQtGAsIvgS', 1, 'Active'),
(2, 'doctor1', '$2y$10$/wpHefmn3jylI2yfmCDTt.eC/WGVGfZBhA0Vw4I1.Q0uYTe31mZtu', 2, 'Active'),
(3, 'nurse1', '$2y$10$umpeZVc0TRghLEx0pFdAku3daakk7sw1LjQDgSF0veh4RuH1OwvwW', 3, 'Active'),
(4, 'reception1', '$2y$10$yUN/JcvtRHY6LCN0Gvyy6.rzqfgeXDw.mhRd37xol0WCo4KcMkxrC', 4, 'Active'),
(5, 'lab1', '$2y$10$SDKyAOKulY174b19v/Q7D.E88cDNyVxasNrzAzSiHxBg/5wn4TmZC', 5, 'Active'),
(6, 'pharmacy1', '$2y$10$bVcBRtvIW5JmI7wGceWiY.vd5ZT6T/tB41LwZ9OdnORjPeN4bfVTi', 6, 'Active'),
(7, 'accountant1', '$2y$10$oBOVmfAUq8gp/g5yBZ8UTeZLzF/ZfPjevO.VHIfmGO3L0.do86B.6', 7, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `laboratory_tests`
--
ALTER TABLE `laboratory_tests`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `fk_medical_doctor` (`doctor_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `patient_documents`
--
ALTER TABLE `patient_documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `pharmacy_prescriptions`
--
ALTER TABLE `pharmacy_prescriptions`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laboratory_tests`
--
ALTER TABLE `laboratory_tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_documents`
--
ALTER TABLE `patient_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pharmacy_prescriptions`
--
ALTER TABLE `pharmacy_prescriptions`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`);

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD CONSTRAINT `doctor_schedules_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`);

--
-- Constraints for table `laboratory_tests`
--
ALTER TABLE `laboratory_tests`
  ADD CONSTRAINT `laboratory_tests_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `laboratory_tests_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`);

--
-- Constraints for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `fk_medical_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`),
  ADD CONSTRAINT `medical_records_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);

--
-- Constraints for table `patient_documents`
--
ALTER TABLE `patient_documents`
  ADD CONSTRAINT `patient_documents_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);

--
-- Constraints for table `pharmacy_prescriptions`
--
ALTER TABLE `pharmacy_prescriptions`
  ADD CONSTRAINT `pharmacy_prescriptions_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `pharmacy_prescriptions_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`medicine_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
