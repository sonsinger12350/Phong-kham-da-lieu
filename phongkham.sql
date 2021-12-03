-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2021 at 12:38 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phongkham`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `calendar_id` int(11) NOT NULL,
  `time` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`calendar_id`, `time`) VALUES
(1, '07:00am'),
(2, '08:00am'),
(3, '09:00am'),
(4, '10:00am'),
(5, '01:00pm'),
(6, '02:00pm'),
(7, '03:00pm'),
(8, '04:00pm');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `medicine_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `howtouse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`medicine_id`, `name`, `unit`, `howtouse`, `type`, `quantity`) VALUES
(1, 'Panadol', 'viên', '2 viên/ngày', 'Thuốc uống', 0),
(5, 'Vitamin C', 'viên', '1 viên/ngày', 'Thuốc uống', 5),
(8, 'Panagal', 'viên', '2 viên/ngày', 'Thuốc uống', 1),
(9, 'Oserol', 'gói', '2 gói/ngày', 'Thuốc uống', 5),
(10, 'ATROPIN SULFAT', 'ống', '1 ống/ngày', '', 44),
(11, 'Bupivacaine for Spinal Anaesthesia Aguettant 5mg/ml', 'ống', '2 ống/ngày', '', 46),
(12, 'Bupivacaine Aguettant 5mg/ml', 'ống', '1 ống/ngày', '', 49),
(13, 'Diazepam 10mg/2ml', 'ống', '2 ống/ngày', '', 19),
(14, 'Diazepam-Hameln 5mg/ml Injection', 'ống', '1 ống/ngày', '', 30),
(15, 'DIAZEPAM', 'viên', '2 viên/ngày', '', 96),
(16, 'Etomidate Lipuro', 'ống', '2 ống/ngày', '', 10),
(17, 'FENTANYL-HAMELN 50MCG/ML ', 'ống', '1 ống/ngày', '', 20);

-- --------------------------------------------------------

--
-- Table structure for table `patient_medical_record`
--

CREATE TABLE `patient_medical_record` (
  `record_id` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `patient_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `patient_phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `patient_year` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_sex` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `diagnose` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `descript` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient_medical_record`
--

INSERT INTO `patient_medical_record` (`record_id`, `date_created`, `patient_id`, `doctor_id`, `doctor_name`, `patient_name`, `patient_phone`, `patient_year`, `patient_sex`, `diagnose`, `descript`, `status`) VALUES
(25, '2021-11-30', 'BN1', 4, 'Dr.Lucas', 'Luong Son', '0123456987', '1999', 'Nam', 'Ngứa', 'Nổi ban', 'Đang theo dõi'),
(26, '2021-11-30', 'BN2', 4, 'Dr.Lucas', 'Bệnh nhân 1', '0123456789', '1999', 'Nam', '1', '', 'Đang theo dõi'),
(27, '2021-11-30', 'BN3', 4, 'Dr.Lucas', 'Bệnh nhân 1', '0223456789', '1999', 'Nam', '2', '', 'Đang theo dõi');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `doctor_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `patient_year` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `patient_sex` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `diagnose` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `reexamination` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescription_id`, `record_id`, `date_created`, `doctor_name`, `patient_id`, `patient_name`, `patient_year`, `patient_sex`, `diagnose`, `reexamination`) VALUES
(6, 25, '2021-11-30', 'Dr.Lucas', 'BN1', 'Luong Son', '1999', 'Nam', 'Ngứa', ''),
(7, 25, '2021-11-30', 'Dr.Lucas', 'BN1', 'Luong Son', '1999', 'Nam', 'Ngứa', '14');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_detail`
--

CREATE TABLE `prescription_detail` (
  `detail_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `medicine` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prescription_detail`
--

INSERT INTO `prescription_detail` (`detail_id`, `prescription_id`, `medicine`) VALUES
(28, 6, '[{\"name\":\"Oserol\",\"use\":\"2 gói/ngày\",\"quantity\":\"1 gói\",\"note\":\"\"},{\"name\":\"Bupivacaine for Spinal Anaesthesia Aguettant 5mg/ml\",\"use\":\"2 ống/ngày\",\"quantity\":\"1 ống\",\"note\":\"\"}]'),
(29, 7, '[{\"name\":\"Bupivacaine Aguettant 5mg/ml\",\"use\":\"1 ống/ngày\",\"quantity\":\"1 ống\",\"note\":\"\"},{\"name\":\"Diazepam 10mg/2ml\",\"use\":\"2 ống/ngày\",\"quantity\":\"1 ống\",\"note\":\"Cẩn thận\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `patient_year` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_sex` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `doctor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `paid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time_create` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `user_id`, `patient_id`, `patient_name`, `patient_phone`, `patient_year`, `patient_sex`, `doctor`, `date`, `time`, `paid`, `time_create`, `status`) VALUES
(14, 6, '', 'Bệnh nhân 1', '0123456789', '1999', 'Nam', 'Dr.Lucas', '2021-11-18', '07:00am', 'Đã thanh toán', '2021-11-17 10:45:40', 'Chưa khám'),
(15, 6, '', 'Bệnh nhân 1', '0123456789', '1999', 'Nam', 'Dr.Lucas', '2021-11-24', '', '', '2021-11-17 10:47:29', 'Đã khám'),
(17, 2, '', 'Luong Son', '0123456987', '1999', 'Nam', 'Dr.Lucas', '2021-11-18', '09:00am', 'Đã thanh toán', '2021-11-17 11:03:29', 'Chưa khám'),
(19, 2, '', 'Luong Son', '0123456789', '1999', 'Nam', 'Dr.Son', '2021-11-24', '07:00am', '', '2021-11-23 09:10:38', 'Chưa khám'),
(20, 6, '', 'Bệnh nhân 1', '0223456789', '1999', 'Nam', 'Dr.Lucas', '2021-11-24', '07:00am', '', '2021-11-23 09:10:58', 'Đã khám'),
(22, 2, '', 'Luong Son', '0123456987', '1999', 'Nam', 'Dr.Lucas', '2021-11-30', '', '', '2021-11-27 12:04:30', 'Đã khám'),
(26, 0, 'BN1', 'Luong Son', '0123456987', '1999', 'Nam', 'Dr.Lucas', '2021-12-14', '', '', '2021-11-30 13:18:04', 'Tái khám');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `patient_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `patient_year` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `patient_sex` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `result` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `record_id`, `date`, `patient_name`, `patient_year`, `patient_sex`, `type`, `result`) VALUES
(3, 25, '2021-11-30 13:45:03', 'Luong Son', '1999', 'Nam', 'Máu lắng', ''),
(4, 25, '2021-11-30 13:46:01', 'Luong Son', '1999', 'Nam', 'Tổng phân tích tế bào máu ngoại vi', '[\"backgroundLogin.jpg\",\"banner.jpg\"]');

-- --------------------------------------------------------

--
-- Table structure for table `test_type`
--

CREATE TABLE `test_type` (
  `type_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test_type`
--

INSERT INTO `test_type` (`type_id`, `name`) VALUES
(3, 'Tổng phân tích nước tiểu'),
(4, 'Máu lắng'),
(5, 'Tổng phân tích tế bào máu ngoại vi'),
(6, 'HIV AB test nhanh'),
(7, 'HBsAg test nhanh'),
(8, 'Vi khuẩn nhuộm soi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `verify_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `verified` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `verify_code`, `verified`, `permission`, `patient_id`) VALUES
(1, 'ADMIN', 'admin@gmail.com', '1', '', '', '5', '0'),
(2, 'Le Son', 'leluongson99@gmail.com', '1', '69xislptqo', 'yes', '0', 'BN1'),
(3, 'Dr.Son', 'sonsinger.sl@gmail.com', '1', '', 'yes', '2', '0'),
(4, 'Dr.Lucas', 'lucas', '1', '', 'yes', '2', '0'),
(5, 'Dr.Strange', 'strange', '1', '', 'yes', '2', '0'),
(6, 'Bệnh nhân 1', 'bn1', '1', '', 'yes', '0', 'BN2'),
(8, 'Receptionist', 'receptionist', '1', '', 'yes', '1', '0'),
(9, 'Medicine Management', 'medicine', '1', '', 'yes', '3', '0'),
(10, 'Test Doctor', 'test', '1', '', 'yes', '4', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`calendar_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `patient_medical_record`
--
ALTER TABLE `patient_medical_record`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`);

--
-- Indexes for table `prescription_detail`
--
ALTER TABLE `prescription_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `test_type`
--
ALTER TABLE `test_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `calendar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `patient_medical_record`
--
ALTER TABLE `patient_medical_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prescription_detail`
--
ALTER TABLE `prescription_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test_type`
--
ALTER TABLE `test_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
