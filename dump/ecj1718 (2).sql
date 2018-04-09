-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2018 at 01:43 AM
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
  `entity_description` varchar(255) NOT NULL,
  `allow_login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_entities`
--

INSERT INTO `system_entities` (`id`, `entity_name`, `entity_code`, `entity_description`, `allow_login`) VALUES
(5, 'Student', 'std', 'Students Records', 'no'),
(8, 'Teacher', 'tchr', 'Teacher  Instructor  Faculty', 'yes'),
(11, 'School Head', 'sh', 'School Heads', 'yes');

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
(32, 'First Name', 'first_name', 'Students First Name', 'text', '', 'any', 'required', '', '5', 1),
(33, 'Middle Name', 'middle_name', 'Students Middle Name', 'text', '', 'any', 'required', '', '5', 2),
(34, 'Last Name', 'last_name', 'Students Last Name', 'text', '', 'any', 'required', '', '5', 3),
(35, 'Student ID Code', 'std_code', 'Student ID Number (Learner''s Identification Number)', 'text', '', 'any', 'required', '', '5', 0),
(36, 'Teacher Code', 'tchr_code', 'Teacher unique code', 'text', '', 'any', 'required', '', '8', 0),
(37, 'Non Teaching Staff Code', 'nts_code', 'Non Teaching Staff unique code', 'text', '', 'any', 'required', '', '9', 0),
(38, 'First Name', 'tchr_firstname', 'First Name', 'text', '', 'any', '', '', '8', 1),
(39, 'Middle Name', 'tchr_middlename', 'Middle Name', 'text', '', 'any', '', '', '8', 2),
(40, 'Last Name', 'tchr_lastname', 'Last Name', 'text', '', 'any', '', '', '8', 3),
(41, 'Undergraduate Degree', 'tchr_undergraduate', 'Undergraduate Degree  Bachelors Degree', 'text', '', 'any', '', '', '8', 4),
(42, ' Code', '_code', ' unique code', 'text', '', 'any', 'required', '', '10', 0),
(43, 'School Code', 'school_code', 'School unique code', 'text', '', 'any', 'required', '', '11', 0),
(52, 'test field 1', 'test_frield_e', '', 'text', '', 'any', '', '', '', 0),
(53, 'test field 2', 'test_Field_2', 'sad', 'text', '', 'any', '', '', '', 0),
(54, 'Nickname', 'tchr_nickname', 'Teachers Nickname', 'text', '', 'any', 'required', '10', '', 0),
(55, 'Phone Number', 'tchr_phone_number', 'Teachers Phone Number', 'text', '', 'any', 'required', '10', '', 0),
(56, 'School Head Code', 'schoold_head_code', 'School Head unique code', 'text', '', 'any', 'required', '', '12', 0),
(57, 'School Head Code', 'sh_code', 'School Head unique code', 'text', '', 'any', 'required', '', '9', 0),
(58, 'Student Head Code', 'sh_code', 'Student Head unique code', 'text', '', 'any', 'required', '', '10', 0),
(59, 'School Head Code', 'sh_code', 'School Head unique code', 'text', '', 'any', 'required', '', '11', 0),
(61, 'Address', 'tchr_address', 'Address Line 1', 'text', '', 'any', 'required', '10', '', 0);

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
(3, 'Student Health', 'std_health', 'Student Health Status', '5'),
(10, 'Teachers Personal Information', 'tchr_personal_info', 'Personal Information of Teachers', '8');

-- --------------------------------------------------------

--
-- Table structure for table `system_permissions`
--

CREATE TABLE `system_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_permissions`
--

INSERT INTO `system_permissions` (`id`, `name`, `code`, `description`, `category`) VALUES
(1, 'New Form', 'new-form', 'Add New Form', 'Management & Administration'),
(2, 'New Entity', 'new-entity', 'Create new entity', 'Management & Administration'),
(3, 'List Fields', 'list-fields', 'List All Fields', 'Management & Administration'),
(4, 'View Reports', 'list-reports', 'List All Reports', 'Data Output Management'),
(5, 'Headers & Footers', 'new-template', 'Create new header or footer', 'Data Output Management'),
(6, 'List Entities', 'list-entities', 'List All Entities', 'Entities'),
(7, 'Add New Field', 'add-new-field-form', 'Add New Field in Form', 'Right Bar'),
(8, 'Add New Field', 'add-new-field-entity', 'Add New Field in Entity', 'Right Bar'),
(9, 'Input Form Data', 'input-form', 'Input Data in Form', 'Data Input Management'),
(10, 'List Form Data', 'list-form-data', 'View Data in Form', 'List Menu'),
(11, 'Edit Form', 'edit-form', 'Edit Form', 'List Menu'),
(12, 'Delete Form', 'delete-form', 'Delete Form', 'List Menu'),
(13, 'View Report', 'view-report', 'View Reports', 'List Menu'),
(14, 'Edit Report', 'configure-report', 'Edit Report Configuration', 'List Menu'),
(15, 'Delete Report', 'delete-report', 'Delete Report', 'List Menu'),
(16, 'Edit Header or Footer', 'edit-header-footer', 'Edit Header or Footer', 'List Menu'),
(17, 'Delete Header or Footer', 'delete-header-footer', 'Delete Header or Footer', 'List Menu'),
(18, 'View Entities', 'view-entities', 'View Entities', 'List Menu'),
(19, 'Edit Entities', 'edit-entities', 'Edit Entities', 'List Menu'),
(20, 'Delete Entities', 'delete-entities', 'Delete Entities', 'List Menu'),
(21, 'Edit Field', 'edit-field', 'Edit Field', 'List Menu'),
(22, 'Delete Field', 'delete-field', 'Delete Field', 'List Menu'),
(23, 'Input Entity', 'input-entity', 'Input Entities', 'Entities'),
(24, 'List Forms', 'list-forms', 'List Existing Forms', 'Data Input Management'),
(25, 'List Entity Data', 'list-entity-data', 'List Entity Data', 'Entities'),
(26, 'List Header or Footer', 'list-template', 'List available headers and footers', 'Data Output Management'),
(27, 'Delete Form Data', 'delete-form-data', 'Delete Inputs on Form', 'Data Input Management');

-- --------------------------------------------------------

--
-- Table structure for table `system_permissions_config`
--

CREATE TABLE `system_permissions_config` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_permissions_config`
--

INSERT INTO `system_permissions_config` (`id`, `permission_id`, `entity_id`) VALUES
(476, 1, 11),
(477, 3, 8),
(478, 3, 11),
(479, 4, 8),
(480, 4, 11),
(481, 5, 8),
(482, 5, 11),
(483, 6, 8),
(484, 6, 11),
(485, 7, 8),
(486, 8, 8),
(487, 8, 11),
(488, 9, 8),
(489, 9, 11),
(490, 10, 8),
(491, 10, 11),
(492, 11, 8),
(493, 11, 11),
(494, 12, 11),
(495, 13, 8),
(496, 13, 11),
(497, 14, 8),
(498, 14, 11),
(499, 15, 8),
(500, 15, 11),
(501, 16, 8),
(502, 16, 11),
(503, 17, 8),
(504, 17, 11),
(505, 18, 8),
(506, 18, 11),
(507, 19, 11),
(508, 20, 11),
(509, 21, 8),
(510, 21, 11),
(511, 22, 8),
(512, 22, 11),
(513, 23, 11),
(514, 24, 11),
(515, 25, 8),
(516, 25, 11);

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
(2, 'std_health_shortened', 'Student Heigh Weight Blood Pressure', 'Student Height, Weight, Blood Pressure Only', '3', 1, 0),
(5, 'tchr_personal_info_rpt', 'Teachers Personal Information', 'Teachers Personal Information', '10', 4, 0),
(6, 'std_rpt_health', 'Summary Student Health', 'Student Health Summary', '3', 3, 0);

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
(62, 2, 20, 5),
(63, 2, 22, 6),
(64, 2, 23, 7),
(77, 5, 36, 1),
(78, 5, 38, 2),
(79, 5, 39, 3),
(80, 5, 40, 4),
(81, 5, 54, 5),
(82, 5, 55, 6),
(87, 6, 20, 5),
(88, 6, 22, 6),
(89, 6, 23, 7),
(90, 6, 26, 8),
(91, 6, 28, 9),
(92, 6, 27, 10);

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
(3, 'SES', '<center>\nDepartment of Education	<br>\nRegion III<br>\n<strong>DIVISION OF CITY OF SAN FERNANDO</strong>	<br>\nSindalan, City of San Fernando (P)	<br>\n<strong>SINDALAN ELEMENTARY SCHOOL</strong><br>\n</center>', 'header', ''),
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
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `unique_code` varchar(255) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_users`
--

INSERT INTO `system_users` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `unique_code`, `entity_id`, `email`, `mobile`) VALUES
(1, 'admin', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'Admin', '', 'User', '', 0, 'ecj@mailinator.com', '0917 123 2234'),
(3, 'jairenz@gmail.com', 'Batu_SA-asdad', 'Jairenz', 'Tiongson', 'Batu', 'SA-asdad', 5, 'jairenz@gmail.com', '1232131'),
(4, 'jm@gial.com', 'Dela Cruz_TA-1231', 'Juan', 'Dela Cruz', 'Dela Cruz', 'TA-1231', 8, 'jm@gial.com', '123123'),
(6, 'jairenzbatu@live.com', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'Jairenz', 'Tiongson', 'Batu', 'HAU-JAIRENZ123', 5, 'jairenzbatu@live.com', '12313233'),
(7, 'jd@gmail.com', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'John', 'Doe', 'Doe', 'SH-1234', 11, 'jd@gmail.com', '12313');

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
  `unique_code` varchar(255) NOT NULL,
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

INSERT INTO `usr_std_health` (`id`, `unique_code`, `std_sh_height`, `std_sh_weight`, `std_sh_bp`, `std_sh_smoking`, `std_sh_allergies`, `std_sh_alcohol_drinking`) VALUES
(1, 'SIN-9871', '170', '50', '80-90', 'No', 'None', 'No'),
(2, 'SF231-1245', '145', '40', '90/80', 'Yes', 'None', 'No'),
(4, 'SA-asdad', '177', '76', '90/180', 'No', 'none', 'No');

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
-- Table structure for table `usr_tchr_personal_info`
--

CREATE TABLE `usr_tchr_personal_info` (
  `id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(255) NOT NULL,
  `unique_code` varchar(255) NOT NULL,
  `tchr_nickname` varchar(255) NOT NULL,
  `tchr_phone_number` varchar(255) NOT NULL,
  `tchr_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usr_tchr_personal_info`
--

INSERT INTO `usr_tchr_personal_info` (`id`, `date_added`, `user_id`, `unique_code`, `tchr_nickname`, `tchr_phone_number`, `tchr_address`) VALUES
(1, '0000-00-00 00:00:00', '', 'SF001-112', 'Gil', '0917 400 1111', '');

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
-- Indexes for table `system_permissions`
--
ALTER TABLE `system_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_permissions_config`
--
ALTER TABLE `system_permissions_config`
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
-- Indexes for table `usr_tchr`
--
ALTER TABLE `usr_tchr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_tchr_personal_info`
--
ALTER TABLE `usr_tchr_personal_info`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `system_forms`
--
ALTER TABLE `system_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `system_permissions`
--
ALTER TABLE `system_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `system_permissions_config`
--
ALTER TABLE `system_permissions_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=517;
--
-- AUTO_INCREMENT for table `system_reports`
--
ALTER TABLE `system_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `system_reports_config`
--
ALTER TABLE `system_reports_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `system_reports_hnf`
--
ALTER TABLE `system_reports_hnf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `system_users`
--
ALTER TABLE `system_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `usr_std`
--
ALTER TABLE `usr_std`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usr_std_health`
--
ALTER TABLE `usr_std_health`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usr_tchr`
--
ALTER TABLE `usr_tchr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usr_tchr_personal_info`
--
ALTER TABLE `usr_tchr_personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
