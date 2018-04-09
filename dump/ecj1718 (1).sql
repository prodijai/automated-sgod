-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2018 at 12:20 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecj1718`
--

-- --------------------------------------------------------

--
-- Table structure for table `system_entities`
--

CREATE TABLE `system_entities` (
  `id` int(11) NOT NULL,
  `entity_name` varchar(255) NOT NULL,
  `entity_code` varchar(255) NOT NULL,
  `entity_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_entities`
--

INSERT INTO `system_entities` (`id`, `entity_name`, `entity_code`, `entity_description`) VALUES
(5, 'Student', 'std', 'Students Records'),
(8, 'Teacher', 'tchr', 'Teacher  Instructor  Faculty'),
(9, 'Non Teaching Staff', 'nts', 'Organizations Non Teaching Staff'),
(11, 'School', 'school', 'Name of School');

-- --------------------------------------------------------

--
-- Table structure for table `system_fields`
--

CREATE TABLE `system_fields` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `placeholder` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  `valid_char` varchar(255) NOT NULL,
  `required` varchar(255) NOT NULL,
  `form_link` varchar(255) NOT NULL,
  `entity_link` varchar(255) NOT NULL,
  `field_order` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_fields`
--

INSERT INTO `system_fields` (`id`, `name`, `code`, `placeholder`, `type`, `field_value`, `valid_char`, `required`, `form_link`, `entity_link`, `field_order`) VALUES
(7, 'First Name', 'tchr_first_name', 'Teacher First Name', 'text', '', 'any', '', '', '', 0),
(8, 'Last Name', 'tchr_last_name', 'Teacher Last Name', 'text', '', 'any', '', '', '', 0),
(9, 'Teacher ID Number', 'tchr_id_number', 'Teachers ID Number', 'text', '', 'any', '', '', '', 0),
(10, 'Address Line 1', 'std_address_line1', 'Student Address Line 1', 'text', '', 'any', '', '', '', 0),
(11, 'Address Line 2', 'std_address_line2', 'Student Address Line 2', 'text', '', 'any', '', '', '', 0),
(12, 'Grade Level', 'std_grade_level', 'Student Grade Level', 'select', '1,2,3,4,5,6,7,8,9,10,11,12', 'numbers-only', '', '', '', 0),
(13, 'School', 'std_school', 'Student School', 'text', '', 'any', '', '', '', 0),
(14, 'Complete Blood Count', 'tchr_ape_cbc', 'Blood Count', 'text', '', 'any', 'required', '2', '', 1),
(15, 'Fasting Blood Sugar', 'tchr_ape_fbs', 'Fasting Blood Sugar', 'text', '', 'any', 'required', '2', '', 2),
(16, 'BUN', 'tchr_ape_bun', 'Blood Urea Nitrogen (BUN) Test', 'text', '', 'any', 'required', '2', '', 4),
(17, 'Creatinine', 'tchr_ape_creatinine', 'Creatinine', 'text', '', 'any', 'required', '2', '', 4),
(18, 'Blood Uric Acid (BUA)', 'tchr_ape_bua', 'Blood Uric Acid (BUA)', 'text', '', 'any', 'required', '2', '', 5),
(19, 'Total Cholesterol', 'tchr_ape_cholesterol', 'Total Cholesterol Data', 'text', '', 'any', 'required', '2', '', 6),
(20, 'Height', 'std_sh_height', 'Students Height in CM', 'text', '', 'any', 'required', '3', '', 2),
(22, 'Weight', 'std_sh_weight', 'Student Weight in KG', 'text', '', 'any', 'required', '3', '', 2),
(23, 'Blood Pressure', 'std_sh_bp', 'Blood Pressure', 'text', '', 'any', 'required', '3', '', 3),
(26, 'Smoking', 'std_sh_smoking', 'Is student smoking?', 'select', 'Yes, No', 'any', 'required', '3', '', 4),
(27, 'Known Allergies', 'std_sh_allergies', 'List below all know allergies', 'textarea', '', 'any', 'required', '3', '', 6),
(28, 'Drinking Alcohol', 'std_sh_alcohol_drinking', 'Is student drinking alcohol?', 'radio', 'Yes, No', 'any', 'required', '3', '', 5),
(32, 'First Name', 'std_firstname', 'Students First Name', 'text', '', 'any', 'required', '', '5', 1),
(33, 'Middle Name', 'std_middlename', 'Students Middle Name', 'text', '', 'any', 'required', '', '5', 2),
(34, 'Last Name', 'std_lastname', 'Students Last Name', 'text', '', 'any', 'required', '', '5', 3),
(35, 'Student ID Code', 'std_code', 'Student ID Number (Learner''s Identification Number)', 'text', '', 'any', 'required', '', '5', 0),
(36, 'Teacher Code', 'tchr_code', 'Teacher unique code', 'text', '', 'any', 'required', '', '8', 0),
(37, 'Non Teaching Staff Code', 'nts_code', 'Non Teaching Staff unique code', 'text', '', 'any', 'required', '', '9', 0),
(38, 'First Name', 'tchr_firstname', 'First Name', 'text', '', 'any', '', '', '8', 1),
(39, 'Middle Name', 'tchr_middlename', 'Middle Name', 'text', '', 'any', '', '', '8', 2),
(40, 'Last Name', 'tchr_lastname', 'Last Name', 'text', '', 'any', '', '', '8', 3),
(41, 'Undergraduate Degree', 'tchr_undergraduate', 'Undergraduate Degree  Bachelors Degree', 'text', '', 'any', '', '', '8', 4),
(42, ' Code', '_code', ' unique code', 'text', '', 'any', 'required', '', '10', 0),
(43, 'School Code', 'school_code', 'School unique code', 'text', '', 'any', 'required', '', '11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `system_forms`
--

CREATE TABLE `system_forms` (
  `id` int(11) NOT NULL,
  `form_name` varchar(255) NOT NULL,
  `form_code` varchar(255) NOT NULL,
  `form_description` varchar(255) NOT NULL,
  `form_entity_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_forms`
--

INSERT INTO `system_forms` (`id`, `form_name`, `form_code`, `form_description`, `form_entity_link`) VALUES
(2, 'Teachers APE Form', 'tchr_ape', 'Annual Physical Exam for Teachers', '8'),
(3, 'Student Health', 'std_health', 'Student Health Status', '5');

-- --------------------------------------------------------

--
-- Table structure for table `system_reports`
--

CREATE TABLE `system_reports` (
  `id` int(11) NOT NULL,
  `report_code` varchar(255) NOT NULL,
  `report_name` varchar(255) NOT NULL,
  `report_description` text NOT NULL,
  `form_link` varchar(255) NOT NULL,
  `report_header` int(11) NOT NULL,
  `report_footer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_reports`
--

INSERT INTO `system_reports` (`id`, `report_code`, `report_name`, `report_description`, `form_link`, `report_header`, `report_footer`) VALUES
(1, 'std_health_summary', 'Student Health Summary', 'Student Health Report Summary', '3', 1, 0),
(2, 'std_health_shortened', 'Student Heigh Weight Blood Pressure', 'Student Height, Weight, Blood Pressure Only', '3', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `system_reports_config`
--

CREATE TABLE `system_reports_config` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `field_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_reports_config`
--

INSERT INTO `system_reports_config` (`id`, `report_id`, `field_id`, `field_order`) VALUES
(48, 1, 35, 1),
(49, 1, 32, 2),
(50, 1, 33, 3),
(51, 1, 34, 4),
(52, 1, 20, 5),
(53, 1, 22, 6),
(54, 1, 23, 7),
(55, 1, 26, 8),
(56, 1, 28, 9),
(57, 1, 27, 10),
(58, 2, 35, 1),
(59, 2, 32, 2),
(60, 2, 33, 3),
(61, 2, 34, 4),
(62, 2, 20, 5),
(63, 2, 22, 6),
(64, 2, 23, 7);

-- --------------------------------------------------------

--
-- Table structure for table `system_reports_hnf`
--

CREATE TABLE `system_reports_hnf` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_reports_hnf`
--

INSERT INTO `system_reports_hnf` (`id`, `name`, `content`, `type`, `user_id`) VALUES
(1, 'APE Summary', '<center>\nDepartment of Education	<br>\nRegion III<br>\n<strong>DIVISION OF CITY OF SAN FERNANDO</strong>	<br>\nSindalan, City of San Fernando (P)	<br>\n<strong>SUMMARY OF ANNUAL PHYSICAL EXAM S.Y. 2018-2019</strong><br>\n</center>', 'header', ''),
(3, 'SES', '<center>\r\nDepartment of Education	<br>\r\nRegion III<br>\r\n<strong>DIVISION OF CITY OF SAN FERNANDO</strong>	<br>\r\nSindalan, City of San Fernando (P)	<br>\r\n<strong>SINDALAN ELEMENTARY SCHOOL</strong><br>\r\n</center>', 'header', ''),
(4, 'ICTHS', '<center>\r\nDepartment of Education	<br>\r\nRegion III<br>\r\n<strong>DIVISION OF CITY OF SAN FERNANDO</strong>	<br>\r\nSindalan, City of San Fernando (P)	<br>\r\n<strong>INFORMATION AND COMMUNICATION TECHNOLOGY HIGH SCHOOL</strong><br>\r\n</center>', 'header', '');

-- --------------------------------------------------------

--
-- Table structure for table `system_users`
--

CREATE TABLE `system_users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_users`
--

INSERT INTO `system_users` (`id`, `username`, `password`, `first_name`, `last_name`, `role`, `email`, `mobile`) VALUES
(1, 'admin', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'Admin', 'User', 'test', 'ecj@mailinator.com', '0917 123 2234');

-- --------------------------------------------------------

--
-- Table structure for table `usr_nts`
--

CREATE TABLE `usr_nts` (
  `id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(255) NOT NULL,
  `nts_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usr_school`
--

CREATE TABLE `usr_school` (
  `id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(255) NOT NULL,
  `school_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usr_std`
--

CREATE TABLE `usr_std` (
  `id` int(11) NOT NULL,
  `std_firstname` varchar(255) NOT NULL,
  `std_middlename` varchar(255) NOT NULL,
  `std_lastname` varchar(255) NOT NULL,
  `std_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usr_std`
--

INSERT INTO `usr_std` (`id`, `std_firstname`, `std_middlename`, `std_lastname`, `std_code`) VALUES
(1, 'Jairenz', 'Tiongson', 'Batu', '1234'),
(2, 'Juan', 'Reyes', 'Dela Cruz', 'SF231-1245'),
(3, 'Jason', 'Garcia', 'Flores', 'SIN-9871');

-- --------------------------------------------------------

--
-- Table structure for table `usr_std_health`
--

CREATE TABLE `usr_std_health` (
  `id` int(11) NOT NULL,
  `std_code` varchar(255) NOT NULL,
  `std_sh_height` varchar(255) NOT NULL,
  `std_sh_weight` varchar(255) NOT NULL,
  `std_sh_bp` varchar(255) NOT NULL,
  `std_sh_smoking` text NOT NULL,
  `std_sh_allergies` text NOT NULL,
  `std_sh_alcohol_drinking` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usr_std_health`
--

INSERT INTO `usr_std_health` (`id`, `std_code`, `std_sh_height`, `std_sh_weight`, `std_sh_bp`, `std_sh_smoking`, `std_sh_allergies`, `std_sh_alcohol_drinking`) VALUES
(1, 'SIN-9871', '170', '50', '80-90', 'No', 'None', 'No'),
(2, 'SF231-1245', '145', '40', '90/80', 'Yes', 'None', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `usr_tbl_std_test_form`
--

CREATE TABLE `usr_tbl_std_test_form` (
  `id` int(11) NOT NULL,
  `std_first_name` varchar(255) DEFAULT NULL,
  `std_last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usr_tbl_std_test_form`
--

INSERT INTO `usr_tbl_std_test_form` (`id`, `std_first_name`, `std_last_name`) VALUES
(1, '', 'batu'),
(2, NULL, 'dela cruz');

-- --------------------------------------------------------

--
-- Table structure for table `usr_tchr`
--

CREATE TABLE `usr_tchr` (
  `id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(255) NOT NULL,
  `tchr_code` varchar(255) NOT NULL,
  `tchr_firstname` varchar(255) NOT NULL,
  `tchr_middlename` varchar(255) NOT NULL,
  `tchr_lastname` varchar(255) NOT NULL,
  `tchr_undergraduate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usr_tchr`
--

INSERT INTO `usr_tchr` (`id`, `date_added`, `user_id`, `tchr_code`, `tchr_firstname`, `tchr_middlename`, `tchr_lastname`, `tchr_undergraduate`) VALUES
(1, '0000-00-00 00:00:00', '', 'SF001-112', 'John', 'Smith', 'Doe', 'Bachelor of Secondary Education'),
(2, '0000-00-00 00:00:00', '', 'SF-11244', 'Jane', 'Suarez', 'Doe', 'BS Math'),
(3, '0000-00-00 00:00:00', '', 'SIN-13341', 'Matt', 'Davids', 'Smith', 'BS Physics'),
(4, '0000-00-00 00:00:00', '', 'UK-1123', 'David', 'Smith', 'Evans', 'BS Applied Physics');

-- --------------------------------------------------------

--
-- Table structure for table `usr_tchr_ape`
--

CREATE TABLE `usr_tchr_ape` (
  `id` int(11) NOT NULL,
  `tchr_ape_cbc` varchar(255) NOT NULL,
  `tchr_ape_fbs` varchar(255) NOT NULL,
  `tchr_ape_bun` varchar(255) NOT NULL,
  `tchr_ape_creatinine` varchar(255) NOT NULL,
  `tchr_ape_bua` varchar(255) NOT NULL,
  `tchr_ape_cholesterol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_entities`
--
ALTER TABLE `system_entities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_fields`
--
ALTER TABLE `system_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_forms`
--
ALTER TABLE `system_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_reports`
--
ALTER TABLE `system_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_reports_config`
--
ALTER TABLE `system_reports_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_reports_hnf`
--
ALTER TABLE `system_reports_hnf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_users`
--
ALTER TABLE `system_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_nts`
--
ALTER TABLE `usr_nts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_school`
--
ALTER TABLE `usr_school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_std`
--
ALTER TABLE `usr_std`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_std_health`
--
ALTER TABLE `usr_std_health`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_tbl_std_test_form`
--
ALTER TABLE `usr_tbl_std_test_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_tchr`
--
ALTER TABLE `usr_tchr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_tchr_ape`
--
ALTER TABLE `usr_tchr_ape`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_entities`
--
ALTER TABLE `system_entities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `system_fields`
--
ALTER TABLE `system_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `system_forms`
--
ALTER TABLE `system_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `system_reports`
--
ALTER TABLE `system_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `system_reports_config`
--
ALTER TABLE `system_reports_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `system_reports_hnf`
--
ALTER TABLE `system_reports_hnf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `system_users`
--
ALTER TABLE `system_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usr_nts`
--
ALTER TABLE `usr_nts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usr_school`
--
ALTER TABLE `usr_school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usr_std`
--
ALTER TABLE `usr_std`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usr_std_health`
--
ALTER TABLE `usr_std_health`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usr_tbl_std_test_form`
--
ALTER TABLE `usr_tbl_std_test_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usr_tchr`
--
ALTER TABLE `usr_tchr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usr_tchr_ape`
--
ALTER TABLE `usr_tchr_ape`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
