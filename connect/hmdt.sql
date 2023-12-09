-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 09:17 PM
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
-- Database: `hmdt`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

CREATE TABLE `checkin` (
  `checkin_id` int(11) NOT NULL,
  `receptioniest_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `barcode_text` varchar(255) NOT NULL,
  `barcode_type` varchar(255) NOT NULL,
  `barcode_display` varchar(255) NOT NULL,
  `barcode_size` varchar(255) NOT NULL,
  `print_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`checkin_id`, `receptioniest_id`, `patient_id`, `barcode_text`, `barcode_type`, `barcode_display`, `barcode_size`, `print_text`) VALUES
(14, 7, 2, '4321', 'code39', 'horizontal', '20', 'true'),
(15, 7, 1, '1234', 'code39', 'horizontal', '20', 'true'),
(16, 7, 3, '2122', 'code39', 'horizontal', '20', 'true'),
(17, 7, 4, '2453', 'code39', 'horizontal', '20', 'true'),
(18, 7, 7, '8795', 'code39', 'horizontal', '20', 'true'),
(19, 7, 8, '0', 'code39', 'horizontal', '20', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(255) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(2, 'Cardiology Department'),
(1, 'Intensive Care Unit (ICU)'),
(3, 'Oncology Department');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `user_id`, `department_id`) VALUES
(7, 3, 1),
(8, 4, 2),
(9, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `follow_up_record`
--

CREATE TABLE `follow_up_record` (
  `follow_up_record_id` int(11) NOT NULL,
  `barcode_id` int(11) NOT NULL,
  `nurse_id` int(11) DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `date_note` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL,
  `meds_time` time NOT NULL,
  `meds` text NOT NULL,
  `entring_date` date DEFAULT NULL,
  `note_time` time DEFAULT NULL,
  `checkin_time` time DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `follow_up_record`
--

INSERT INTO `follow_up_record` (`follow_up_record_id`, `barcode_id`, `nurse_id`, `patient_id`, `notes`, `date_note`, `status`, `meds_time`, `meds`, `entring_date`, `note_time`, `checkin_time`, `Date`) VALUES
(123, 14, 7, 2, NULL, '2023-10-28 18:49:39', 2, '20:41:00', 'Lisinopril', '2023-10-28', NULL, NULL, '2023-10-28'),
(124, 14, 7, 2, NULL, '2023-10-28 18:49:41', 2, '20:41:00', 'Lisinopril', '2023-10-28', NULL, NULL, '2023-10-29'),
(125, 14, 7, 2, NULL, '2023-10-28 18:49:43', 2, '20:41:00', 'Lisinopril', '2023-10-28', NULL, NULL, '2023-10-30'),
(126, 14, 7, 2, NULL, '2023-10-28 18:49:45', 2, '20:41:00', 'Lisinopril', '2023-10-28', NULL, NULL, '2023-10-31'),
(127, 17, 7, 4, 'after 5 mins of taking the meds the patient developed a skin rash', '2023-10-28 19:16:48', 1, '20:45:00', 'Albuterol', '2023-10-28', '20:55:30', NULL, '2023-10-28'),
(128, 17, 7, 4, NULL, '2023-10-28 18:50:03', 0, '20:45:00', 'Albuterol', '2023-10-28', NULL, NULL, '2023-10-29'),
(129, 17, 7, 4, NULL, '2023-10-28 18:50:05', 0, '20:45:00', 'Albuterol', '2023-10-28', NULL, NULL, '2023-10-30'),
(130, 17, 7, 4, NULL, '2023-10-28 18:50:07', 0, '20:45:00', 'Albuterol', '2023-10-28', NULL, NULL, '2023-10-31'),
(131, 18, 7, 7, NULL, '2023-10-28 18:50:24', 0, '15:00:00', 'Amoxicillin', '2023-10-28', NULL, NULL, '2023-10-29'),
(132, 18, 7, 7, NULL, '2023-10-28 18:50:26', 0, '15:00:00', 'Amoxicillin', '2023-10-28', NULL, NULL, '2023-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `group_type`
--

CREATE TABLE `group_type` (
  `group_id` int(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `group_type`
--

INSERT INTO `group_type` (`group_id`, `user_type`) VALUES
(1, 'receptionist'),
(2, 'Doctor'),
(3, 'nuers'),
(4, 'patient');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicine_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `dose` varchar(255) NOT NULL,
  `frequency` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `Date` date DEFAULT NULL,
  `diagnosis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicine_id`, `doctor_id`, `file_id`, `medicine_name`, `dose`, `frequency`, `description`, `patient_id`, `time`, `Date`, `diagnosis`) VALUES
(130, 7, 448, 'Lisinopril', '4', 3, 'High blood pressure', 2, '20:41:00', '2023-10-28', 'Hypertension'),
(131, 7, 448, 'Lisinopril', '4', 3, 'High blood pressure', 2, '20:41:00', '2023-10-29', 'Hypertension'),
(132, 7, 448, 'Lisinopril', '4', 3, 'High blood pressure', 2, '20:41:00', '2023-10-30', 'Hypertension'),
(133, 7, 448, 'Lisinopril', '4', 3, 'High blood pressure', 2, '20:41:00', '2023-10-31', 'Hypertension'),
(134, 7, 451, 'Albuterol', '4', 1, NULL, 4, '20:45:00', '2023-10-28', 'Asthma'),
(135, 7, 451, 'Albuterol', '4', 1, NULL, 4, '20:45:00', '2023-10-29', 'Asthma'),
(136, 7, 451, 'Albuterol', '4', 1, NULL, 4, '20:45:00', '2023-10-30', 'Asthma'),
(137, 7, 451, 'Albuterol', '4', 1, NULL, 4, '20:45:00', '2023-10-31', 'Asthma'),
(138, 7, 452, 'Amoxicillin', '6', 2, NULL, 7, '15:00:00', '2023-10-29', 'Bacterial Infections'),
(139, 7, 452, 'Amoxicillin', '6', 2, NULL, 7, '15:00:00', '2023-10-30', 'Bacterial Infections');

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE `nurses` (
  `nurse_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nurses`
--

INSERT INTO `nurses` (`nurse_id`, `department_id`, `user_id`) VALUES
(7, 1, 6),
(8, 2, 7),
(9, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_phone` int(255) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `bed_number` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `patient_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `patient_name`, `patient_phone`, `department_id`, `bed_number`, `file_id`, `patient_code`) VALUES
(1, 'noha', 587654321, 1, 2, 447, 1234),
(2, 'Alia', 576897689, 1, 54, 448, 4321),
(3, 'maha', 576898463, 3, 5, 450, 2122),
(4, 'Saed', 538489464, 2, 98, 451, 2453),
(7, 'Nancy', 528972454, 1, 20, 452, 8795),
(8, 'Kenny', 580979868, 3, 10, NULL, 9344),
(9, 'William', 586836191, 2, 23, 453, 8763),
(10, 'Peter', 596093628, 2, 4, NULL, 3573),
(11, 'Shahd', 597689462, 2, 8, NULL, 6753);

-- --------------------------------------------------------

--
-- Table structure for table `patient_files`
--

CREATE TABLE `patient_files` (
  `file_id` int(11) NOT NULL,
  `meds` text NOT NULL,
  `diagnosis` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `allergies` varchar(255) DEFAULT NULL,
  `chronic_diseases` varchar(255) DEFAULT NULL,
  `symptoms` varchar(255) DEFAULT NULL,
  `department` int(255) DEFAULT NULL,
  `notes_date` date DEFAULT NULL,
  `notes_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `patient_files`
--

INSERT INTO `patient_files` (`file_id`, `meds`, `diagnosis`, `notes`, `patient_id`, `doctor_id`, `allergies`, `chronic_diseases`, `symptoms`, `department`, `notes_date`, `notes_time`) VALUES
(447, 'Amoxicillin 500', 'Pneumonia', NULL, 1, 7, 'Anaphylaxis', 'Threat Inflammation', 'congestion swelling high temperature', NULL, NULL, NULL),
(448, 'Lisinopril', 'Hypertension', NULL, 2, 8, 'from amoxicillin', 'Dental Swelling', 'swelling throbbing pain', NULL, NULL, NULL),
(450, '', NULL, NULL, 3, 7, 'Allergic rhinitis', 'asthma', 'Dyspna ', NULL, NULL, NULL),
(451, 'Albuterol', 'Asthma', NULL, 4, 8, 'Allergic conjunctivitis\n', 'Eczema', 'Rednes pruritus-itching', NULL, NULL, NULL),
(452, 'Amoxicillin', 'Bacterial Infections', 'After the dosage monitor the patient for 15 mins', 7, 9, 'no allergy', 'Pneumonia\r\n', 'Sputum cough high temp', NULL, '2023-10-31', '22:16:43'),
(453, '', NULL, NULL, 9, 7, 'Angioedema', 'Anemia Iron Deficiency', 'tiredness cold hand feet dizziness shortness of breath', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receptioniest`
--

CREATE TABLE `receptioniest` (
  `receptioniest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `receptioniest`
--

INSERT INTO `receptioniest` (`receptioniest_id`, `user_id`) VALUES
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_code` int(11) NOT NULL,
  `department_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `phone_number`, `firstname`, `lastname`, `email`, `gender`, `group_id`, `user_code`, `department_id`) VALUES
(2, 'Mona', 'Mona123', '508749381', 'Mona', 'Alzahrani', 'Mona@gmail.com', 'Female', 1, 1545, 0),
(3, 'Nada', 'Nada123', '568943218', 'Nada', 'Alzahrani', 'Nada@gmail.com', 'Female', 2, 1234, 1),
(4, 'Huda', 'Huda123', '578491001', 'Huda', 'Ahmed', 'Huda@gmail.com', 'Female', 2, 1101, 2),
(5, 'Soumaya', 'Sou123', '508947638', 'Soumaya', 'Alzahrani', 'Soumaya@gmail.com', 'Female', 2, 1111, 3),
(6, 'Waad', 'Waad123', '587499182', 'Waad', 'Alghamdi', 'Waad@gmail.com', 'Female', 3, 2112, 1),
(7, 'Ali', 'Ali123', '564778839', 'Ali', 'Alghamdi', 'Ali@gmail.com', 'Male', 3, 1451, 2),
(8, 'Ahmed', 'Ahmed123', '576910012', 'Ahmed', 'Alzahrani', 'Ahmed@gmail.com', 'Male', 3, 9119, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`checkin_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `receptioniest_id` (`receptioniest_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `department_name` (`department_name`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `follow_up_record`
--
ALTER TABLE `follow_up_record`
  ADD PRIMARY KEY (`follow_up_record_id`),
  ADD KEY `barcode_id` (`barcode_id`),
  ADD KEY `nurse_id` (`nurse_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `group_type`
--
ALTER TABLE `group_type`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicine_id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`nurse_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `patient_code` (`patient_code`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `file_id` (`file_id`);

--
-- Indexes for table `patient_files`
--
ALTER TABLE `patient_files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `department` (`department`),
  ADD KEY `department_2` (`department`);

--
-- Indexes for table `receptioniest`
--
ALTER TABLE `receptioniest`
  ADD PRIMARY KEY (`receptioniest_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_code` (`user_code`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkin`
--
ALTER TABLE `checkin`
  MODIFY `checkin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `follow_up_record`
--
ALTER TABLE `follow_up_record`
  MODIFY `follow_up_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `group_type`
--
ALTER TABLE `group_type`
  MODIFY `group_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `nurses`
--
ALTER TABLE `nurses`
  MODIFY `nurse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `patient_files`
--
ALTER TABLE `patient_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `receptioniest`
--
ALTER TABLE `receptioniest`
  MODIFY `receptioniest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkin`
--
ALTER TABLE `checkin`
  ADD CONSTRAINT `checkin_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkin_ibfk_2` FOREIGN KEY (`receptioniest_id`) REFERENCES `receptioniest` (`receptioniest_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `follow_up_record`
--
ALTER TABLE `follow_up_record`
  ADD CONSTRAINT `follow_up_record_ibfk_1` FOREIGN KEY (`barcode_id`) REFERENCES `checkin` (`checkin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follow_up_record_ibfk_2` FOREIGN KEY (`nurse_id`) REFERENCES `nurses` (`nurse_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follow_up_record_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `patient_files` (`file_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medicine_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medicine_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nurses`
--
ALTER TABLE `nurses`
  ADD CONSTRAINT `nurses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nurses_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  ADD CONSTRAINT `patients_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `patient_files` (`file_id`);

--
-- Constraints for table `patient_files`
--
ALTER TABLE `patient_files`
  ADD CONSTRAINT `patient_files_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `patient_files_ibfk_3` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`),
  ADD CONSTRAINT `patient_files_ibfk_4` FOREIGN KEY (`department`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `receptioniest`
--
ALTER TABLE `receptioniest`
  ADD CONSTRAINT `receptioniest_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group_type` (`group_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
