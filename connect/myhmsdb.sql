-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2023 at 10:27 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myhmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintb`
--

CREATE TABLE `admintb` (
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admintb`
--

INSERT INTO `admintb` (`username`, `password`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `appointmenttb`
--

CREATE TABLE `appointmenttb` (
  `pid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `doctor` varchar(30) NOT NULL,
  `docFees` int(5) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `userStatus` int(5) NOT NULL,
  `doctorStatus` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(10) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `contact`, `message`) VALUES
('Anu', 'anu@gmail.com', '7896677554', 'Hey Admin'),
(' Viki', 'viki@gmail.com', '9899778865', 'Good Job, Pal'),
('Ananya', 'ananya@gmail.com', '9997888879', 'How can I reach you?'),
('Aakash', 'aakash@gmail.com', '8788979967', 'Love your site'),
('Mani', 'mani@gmail.com', '8977768978', 'Want some coffee?'),
('Karthick', 'karthi@gmail.com', '9898989898', 'Good service'),
('Abbis', 'abbis@gmail.com', '8979776868', 'Love your service'),
('Asiq', 'asiq@gmail.com', '9087897564', 'Love your service. Thank you!'),
('Jane', 'jane@gmail.com', '7869869757', 'I love your service!');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(255) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(1, 'Intensive Care Unit (ICU)'),
(2, 'Cardiology Department'),
(3, 'Oncology Department');

-- --------------------------------------------------------

--
-- Table structure for table `doctb`
--

CREATE TABLE `doctb` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `spec` varchar(50) NOT NULL,
  `docFees` int(10) NOT NULL,
  `department_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctb`
--

INSERT INTO `doctb` (`username`, `password`, `email`, `spec`, `docFees`, `department_id`) VALUES
('ashok', 'ashok123', 'ashok@gmail.com', 'General', 500, 0),
('arun', 'arun123', 'arun@gmail.com', 'Cardiologist', 600, 0),
('Dinesh', 'dinesh123', 'dinesh@gmail.com', 'General', 700, 0),
('Ganesh', 'ganesh123', 'ganesh@gmail.com', 'Pediatrician', 550, 0),
('Kumar', 'kumar123', 'kumar@gmail.com', 'Pediatrician', 800, 0),
('Amit', 'amit123', 'amit@gmail.com', 'Cardiologist', 1000, 0),
('Abbis', 'abbis123', 'abbis@gmail.com', 'Neurologist', 1500, 0),
('Tiwary', 'tiwary123', 'tiwary@gmail.com', 'Pediatrician', 450, 0);

-- --------------------------------------------------------

--
-- Table structure for table `grouptype`
--

CREATE TABLE `grouptype` (
  `group_id` int(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grouptype`
--

INSERT INTO `grouptype` (`group_id`, `user_type`) VALUES
(1, 'receptionist'),
(2, 'Doctor'),
(3, 'nuers'),
(4, 'patient');

-- --------------------------------------------------------

--
-- Table structure for table `patreg`
--

CREATE TABLE `patreg` (
  `pid` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `cpassword` varchar(30) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patreg`
--

INSERT INTO `patreg` (`pid`, `fname`, `lname`, `gender`, `email`, `contact`, `password`, `cpassword`, `department_id`) VALUES
(1, 'noha', 'alghamdi', 'famale', 'ram@gmail.com', '0587654321', 'ram123', 'ram123', 0),
(2, 'Alia', 'alshahri', 'Female', 'alia@gmail.com', '0576897689', 'alia123', 'alia123', 0),
(3, 'maha', 'alzahrani', 'famale', 'shahrukh@gmail.com', '0576898463', 'shahrukh123', 'shahrukh123', 0),
(4, 'Saed', 'alshahri', 'Male', 'kishansmart0@gmail.com', '0538489464', 'kishan123', 'kishan123', 0),
(7, 'Nancy', 'Deborah', 'Female', 'nancy@gmail.com', '0528972454', 'nancy123', 'nancy123', 0),
(8, 'Kenny', 'Sebastian', 'Male', 'kenny@gmail.com', '0580979868', 'kenny123', 'kenny123', 0),
(9, 'William', 'Blake', 'Male', 'william@gmail.com', '0586836191', 'william123', 'william123', 0),
(10, 'Peter', 'Norvig', 'Male', 'peter@gmail.com', '0596093628', 'peter123', 'peter123', 0),
(11, 'Shraddha', 'Kapoor', 'Female', 'shraddha@gmail.com', '0597689462', 'shraddha123', 'shraddha123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prestb`
--

CREATE TABLE `prestb` (
  `patient_file` int(50) NOT NULL,
  `pid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `disease` varchar(250) CHARACTER SET utf8 NOT NULL,
  `allergy` varchar(250) CHARACTER SET utf8 NOT NULL,
  `medicne_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `prescription` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `symptoms` varchar(255) CHARACTER SET utf8 NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prestb`
--

INSERT INTO `prestb` (`patient_file`, `pid`, `fname`, `lname`, `appdate`, `apptime`, `disease`, `allergy`, `medicne_name`, `prescription`, `symptoms`, `department_id`) VALUES
(1, 1, 'Noha', 'alzhrani', '0000-00-00', '00:00:00', 'Threat Inflammation', 'Free medical his', 'Amoxicillin 500\n', ' oral-TID', 'congestion swelling high temperature', 0),
(2, 2, 'Aliaa', '', '0000-00-00', '00:00:00', 'Dental Swelling', 'from amoxicillin', 'metronidazole 500', 'Oral-BTD', 'swelling throbbing pain', 0),
(3, 3, 'maha', 'alzahrani', '0000-00-00', '00:00:00', 'asthma', 'asthma Pt', '-albuterol 10.05\r\n-1/2 hour oxygen', '-TID\r\n-1/2 hour daily', 'Dyspna', 0),
(5, 3, 'maha', 'alzahrani', '2023-10-03', '06:25:21', 'asthma', 'asthma Pt', '-albuterol 10.05\r\n-1/2 hour oxygen', '-TID\r\n-1/2 hour daily', 'Dyspna ', 0),
(6, 4, 'Saed', 'alshahri', '2023-10-04', '13:30:54', 'Skin Rush', 'animals', '-topical\r\n-corticosteroids', '-0.1%\r\n-Ointment', 'Rednes pruritus-itching', 0),
(7, 7, 'Nancy', 'Deborah', '2023-08-16', '07:33:00', 'Pneumonia\r\n', 'no allergy', '-Azithromycin 500\r\n-ibuprofen 600\r\n-paracetamol 400\r\n', '-24 hours\r\n-BTD\r\n-BTD', 'Sputum cough high temp', 0),
(8, 9, 'william', 'blake', '2023-11-09', '07:25:45', 'Anemia Iron Deficiency', 'free allergy', '-iron\r\n-vit c\r\n-B12', 'Daily', 'tiredness cold hand feet dizziness shortness of breath', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(250) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `frist_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone_number` int(255) NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `group_id` int(255) NOT NULL,
  `user_code` int(255) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_acc`
--

CREATE TABLE `user_acc` (
  `user_id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `frist_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` int(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `group_id` int(255) NOT NULL,
  `user_code` int(255) NOT NULL,
  `department_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_acc`
--

INSERT INTO `user_acc` (`user_id`, `user_name`, `frist_name`, `last_name`, `email`, `password`, `phone_number`, `gender`, `group_id`, `user_code`, `department_id`) VALUES
(2, 'Mona', 'Mona', 'Alzahrani', 'Mona@gmail.com', 'Mona123', 508749381, 'Female', 1, 1545, NULL),
(3, 'Nada', 'Nada', 'Alzahrani', 'Nada@gmail.com', 'Nada123', 568943218, 'Female', 2, 1234, 1),
(4, 'Huda', 'Huda', 'Ahmed', 'Huda@gmail.com', 'Huda123', 578491001, 'Female', 2, 1101, 2),
(5, 'Soumaya', 'Soumaya', 'Alzahrani', 'Soumaya@gmail.com', 'Sou123', 508947638, 'Female', 2, 1111, 3),
(6, 'Waad', 'Waad', 'Alghamdi', 'Waad@gmail.com', 'Waad123', 587499182, 'Female', 3, 2112, 1),
(7, 'Ali', 'Ali', 'Alghamdi', 'Ali@gmail.com', 'Ali123', 564778839, 'Male', 3, 1451, 2),
(8, 'Ahmed', 'Ahmed', 'Alzahrani', 'Ahmed@gmail.com', 'Ahmed123', 576910012, 'Male', 3, 9119, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointmenttb`
--
ALTER TABLE `appointmenttb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `doctb`
--
ALTER TABLE `doctb`
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `grouptype`
--
ALTER TABLE `grouptype`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `patreg`
--
ALTER TABLE `patreg`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `prestb`
--
ALTER TABLE `prestb`
  ADD PRIMARY KEY (`patient_file`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_acc`
--
ALTER TABLE `user_acc`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointmenttb`
--
ALTER TABLE `appointmenttb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `grouptype`
--
ALTER TABLE `grouptype`
  MODIFY `group_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patreg`
--
ALTER TABLE `patreg`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `prestb`
--
ALTER TABLE `prestb`
  MODIFY `patient_file` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_acc`
--
ALTER TABLE `user_acc`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_acc`
--
ALTER TABLE `user_acc`
  ADD CONSTRAINT `user_acc_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `grouptype` (`group_id`),
  ADD CONSTRAINT `user_acc_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
