-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2018 at 05:59 AM
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
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `entity_name` varchar(255) NOT NULL,
  `entity_code` varchar(255) NOT NULL,
  `entity_description` varchar(255) NOT NULL,
  `allow_login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_entities`
--

INSERT INTO `system_entities` (`id`, `date_added`, `created_by`, `entity_name`, `entity_code`, `entity_description`, `allow_login`) VALUES
(5, '2018-05-06 03:04:25', '', 'Student', 'std', 'Students Records in the System All', 'no'),
(8, '2018-05-06 03:04:25', '', 'Teacher', 'tchr', 'Teacher  Instructor  Faculty', 'yes'),
(11, '2018-05-06 03:04:25', '', 'School Head', 'sh', 'School Heads', 'yes'),
(12, '2018-05-06 03:04:25', '', 'SGOD Officers', 'sgod', 'DepEd Officers', 'yes'),
(13, '2018-05-06 03:04:48', '9', 'tesdadcf', 'adafdsf', 'safdf', 'no');

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
(10, 'Address Line 1', 'std_address_line1', 'Student Address Line 1', 'text', '', 'any', '', '', '', 0),
(11, 'Address Line 2', 'std_address_line2', 'Student Address Line 2', 'text', '', 'any', '', '', '', 0),
(12, 'Grade Level', 'std_grade_level', 'Student Grade Level', 'select', '1,2,3,4,5,6,7,8,9,10,11,12', 'numbers-only', '', '', '', 0),
(13, 'School', 'std_school', 'Student School', 'text', '', 'any', '', '', '', 0),
(14, 'Complete Blood Count', 'tchr_ape_cbc', 'Blood Count', 'text', '', 'any', 'required', '2', '', 1),
(15, 'Fasting Blood Sugar', 'tchr_ape_fbs', 'Fasting Blood Sugar', 'text', '', 'any', 'required', '2', '', 2),
(16, 'BUN', 'tchr_ape_bun', 'Blood Urea Nitrogen (BUN) Test 2', 'text', '', 'any', 'required', '2', '', 4),
(17, 'Creatinine', 'tchr_ape_creatinine', 'Creatinine', 'text', '', 'any', 'required', '2', '', 4),
(18, 'Blood Uric Acid (BUA)', 'tchr_ape_bua', 'Blood Uric Acid (BUA)', 'text', '', 'any', 'required', '2', '', 5),
(19, 'Total Cholesterol', 'tchr_ape_cholesterol', 'Total Cholesterol Data', 'text', '', 'any', 'required', '2', '', 6),
(20, 'Height', 'std_sh_height', 'Students Height in CM', 'text', '', 'any', 'required', '3', '', 2),
(22, 'Weight', 'std_sh_weight', 'Student Weight in KG', 'text', '', 'any', 'required', '3', '', 2),
(23, 'Blood Pressure', 'std_sh_bp', 'Blood Pressure', 'text', '', 'any', 'required', '3', '', 3),
(26, 'Smoking', 'std_sh_smoking', 'Is student smoking?', 'select', 'Yes, No', 'any', 'required', '3', '', 4),
(28, 'Drinking Alcohol', 'std_sh_alcohol_drinking', 'Is student drinking alcohol?', 'radio', 'Yes, No', 'any', 'required', '3', '', 5),
(37, 'Non Teaching Staff Code', 'nts_code', 'Non Teaching Staff unique code', 'text', '', 'any', 'required', '', '9', 1),
(41, 'Undergraduate Degree', 'tchr_undergraduate', 'Undergraduate Degree  Bachelors Degree', 'text', '', 'any', '', '', '8', 4),
(43, 'School Code', 'school_code', 'School unique code', 'text', '', 'any', 'required', '', '11', 0),
(54, 'Nickname', 'tchr_nickname', 'Teachers Nickname', 'text', '', 'any', 'required', '10', '', 0),
(55, 'Phone Number', 'tchr_phone_number', 'Teachers Phone Number', 'text', '', 'any', 'required', '10', '', 0),
(56, 'School Head Code', 'schoold_head_code', 'School Head unique code', 'text', '', 'any', 'required', '', '12', 0),
(57, 'School Head Code', 'sh_code', 'School Head unique code', 'text', '', 'any', 'required', '', '9', 0),
(58, 'Student Head Code', 'sh_code', 'Student Head unique code', 'text', '', 'any', 'required', '', '10', 0),
(59, 'School Head Code', 'sh_code', 'School Head unique code', 'text', '', 'any', 'required', '', '11', 0),
(61, 'Address', 'tchr_address', 'Address Line 1', 'text', '', 'any', 'required', '10', '', 0),
(62, 'SGOD Officers Code', 'sgod_code', 'SGOD Officers unique code', 'text', '', 'any', 'required', '', '12', 0),
(63, 'Marital Status', 'tchr_marital_status', 'Marital Status', 'select', 'Single, Married, Widowed', 'any', 'required', '10', '', 0),
(64, 'test Code 4', 'test_code', 'test unique code', 'text', '', 'any', 'required', '', '13', 0),
(65, 'Remarks', 'tchr_rem', 'Other details', 'text', '', 'any', '', '10', '', 0),
(66, 'Test Entity Code', 'test_ent_code', 'Test Entity unique code', 'text', '', 'any', 'required', '', '13', 0),
(67, 'Color Blindness', 'std_color_blindness', 'Is the student color blind?', 'radio', 'Yes, No', 'any', 'required', '3', '', 7);

-- --------------------------------------------------------

--
-- Table structure for table `system_forms`
--

CREATE TABLE `system_forms` (
  `id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `form_name` varchar(255) NOT NULL,
  `form_code` varchar(255) NOT NULL,
  `form_description` varchar(255) NOT NULL,
  `form_entity_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_forms`
--

INSERT INTO `system_forms` (`id`, `date_added`, `created_by`, `form_name`, `form_code`, `form_description`, `form_entity_link`) VALUES
(3, '2018-05-06 03:00:45', '', 'Student Health', 'std_health', 'Student Health Status A', '5'),
(10, '2018-05-06 03:00:45', '9', 'Teachers Personal Information', 'tchr_personal_info', 'Personal Information of Teachers', '8'),
(11, '2018-05-06 03:05:20', '', 'adsf', 'afsdf', 'adf', '13'),
(12, '2018-05-06 03:07:10', '9', 'sfsaf', 'fadfasf', 'sfdsf', '13');

-- --------------------------------------------------------

--
-- Table structure for table `system_permissions`
--

CREATE TABLE `system_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `permission_type` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_permissions`
--

INSERT INTO `system_permissions` (`id`, `name`, `code`, `description`, `category`, `permission_type`) VALUES
(1, 'New Form', 'new-form', 'Add New Form', 'Management & Administration', 0),
(2, 'New Entity', 'new-entity', 'Create new entity', 'Management & Administration', 0),
(3, 'List Fields', 'list-fields', 'List All Fields', 'Management & Administration', 0),
(4, 'View Reports', 'list-reports', 'List Reports', 'Data Output Management', 0),
(5, 'Headers & Footers', 'new-template', 'Create new header or footer', 'Data Output Management', 0),
(7, 'Add New Field', 'add-new-field-form', 'Add New Field in Form', 'Right Bar', 1),
(9, 'Input Form Data', 'input-form', 'Input Data in Form', 'Data Input Management', 1),
(10, 'List Inputted Data', 'list-form-data', 'View Data in Form', 'List Menu', 1),
(11, 'Edit Form', 'edit-form', 'Edit Form', 'List Menu', 0),
(12, 'Delete Form', 'delete-form', 'Delete Form', 'Data Input Management', 0),
(19, 'Edit Entities', 'edit-entity', 'Edit Entities', 'List Menu', 0),
(20, 'Delete Entities', 'delete-entity', 'Delete Entities', 'Data Input Management', 0),
(21, 'Edit Field', 'edit-field', 'Edit Field', 'List Menu', 0),
(22, 'Delete Field', 'delete-field', 'Delete Field', 'List Menu', 0),
(23, 'Input Entity', 'input-entity', 'Input Entities', 'Entities', 2),
(24, 'View Form', 'list-forms', 'List Existing Forms', 'Data Input Management', 1),
(26, 'List Header or Footer', 'list-template', 'List available headers and footers', 'Data Output Management', 0),
(28, 'Delete Form Field', 'delete-form-field', 'Remove Field from Form', 'List Menu', 0),
(30, 'Create School', 'new-school', 'Create New School', 'Management & Administration', 0),
(31, 'Edit School', 'edit-school', 'Edit School Details', 'Management & Administration', 0),
(32, 'List Schools', 'list-schools', 'List Schools', 'Management & Administration', 0),
(33, 'Delete School', 'delete-school', 'Delete School', 'Management & Administration', 0),
(34, 'Edit Form Data', 'edit-form-data', 'Edit Existing Data in Form', 'Data Input Management', 1),
(35, 'Delete Form Data', 'delete-form-data', 'Delete Existing Data in Form', 'Data Input Management', 1),
(36, 'Set Form Permissions', 'list-form-permissions', 'Set Permission Control in Form', 'Security', 0),
(37, 'List All Data', 'list-all-form-data', 'List All Data Inputted in Form', 'Data Input Management', 1),
(38, 'List School''s Data', 'list-school-form-data', 'List Data of the School', 'Data Input Management', 1),
(39, 'Delete Entity Data', 'delete-entity-data', 'Delete Inputted Entity', 'Data Input Management', 2),
(40, 'Edit Entity Data', 'edit-entity-data', 'Edit Inputted Entity Data', 'Data Input Management', 2),
(41, 'List All Data', 'list-all-entity-data', 'List All Data of Entity', 'Data Output Management', 2),
(42, 'List School Data', 'list-school-entity-data', 'List All Entity Data of School', 'Data Output Management', 2),
(43, 'List Inputted Data', 'list-entity-data', 'List Data Inputted by User', 'Data Output Management', 2),
(44, 'View Entity', 'list-entities', 'View Entity', 'Data Output Management', 2),
(45, 'View and Print Report', 'view-report', 'View and Print Report', 'Data Output Management', 3),
(46, 'Edit Report', 'edit-report', 'Edit Report', 'Data Output Management', 3),
(47, 'Delete Report', 'delete-report', 'Delete Report', 'Data Output Management', 3),
(48, 'View Template', 'view-template', 'View Header or Footer', 'Data Output Management', 4),
(49, 'Edit Template', 'edit-template', 'Edit Header or Footer', 'Data Output Management', 4),
(50, 'Delete Template', 'delete-template', 'Delete Header or Footer', 'Data Output Management', 4),
(51, 'Set Global Permissions', 'list-permissions', 'Set Global Permissions', 'Security', 0),
(52, 'Set Entity Permissions', 'list-entity-permissions', 'Set Entity Permissions', 'Security', 0),
(53, 'Set Report Permissions', 'list-report-permissions', 'Set Report Permissions', 'Security', 0),
(54, 'Set Template Permissions', 'list-template-permissions', 'Set Template Permission', 'Security', 0),
(55, 'New Report', 'new-report', 'Create New Report', 'Data Output Management', 0),
(56, 'List Entities', 'list-entities', 'View Existing Entities', 'Data Input Management', 0),
(57, 'List Forms', 'list-forms', 'View Existing Forms', 'Data Input Management', 0),
(58, 'Configure Report Fields', 'configure-report', 'Configure Fields on Report', 'Data Output Management', 3);

-- --------------------------------------------------------

--
-- Table structure for table `system_permissions_config`
--

CREATE TABLE `system_permissions_config` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL DEFAULT '0',
  `school_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_permissions_config`
--

INSERT INTO `system_permissions_config` (`id`, `permission_id`, `entity_id`, `link_id`, `school_id`) VALUES
(1159, 9, 8, 10, 1),
(1160, 24, 11, 10, 3),
(1280, 8, 12, 11, 3),
(1281, 8, 12, 12, 3),
(1337, 23, 11, 8, 3),
(1338, 40, 11, 8, 3),
(1339, 42, 11, 8, 3),
(1340, 43, 11, 8, 3),
(1341, 44, 11, 8, 3),
(1346, 47, 11, 6, 3),
(1349, 45, 11, 5, 3),
(1359, 41, 12, 12, 3),
(1386, 48, 11, 3, 3),
(1387, 49, 11, 3, 3),
(1416, 4, 11, 0, 3),
(1473, 48, 11, 1, 3),
(1474, 49, 8, 1, 3),
(1475, 49, 11, 1, 3),
(1476, 50, 11, 1, 3),
(1880, 44, 11, 13, 1),
(1881, 44, 11, 14, 1),
(1901, 44, 11, 15, 1),
(1935, 48, 11, 5, 1),
(1936, 49, 11, 5, 1),
(1937, 50, 11, 5, 1),
(1939, 48, 11, 6, 1),
(1940, 50, 11, 6, 1),
(1941, 48, 11, 7, 1),
(1942, 48, 8, 8, 1),
(1943, 48, 11, 8, 1),
(1944, 50, 11, 8, 1),
(2147, 44, 11, 11, 1),
(2148, 41, 12, 11, 3),
(2201, 1, 11, 0, 1),
(2202, 2, 11, 0, 1),
(2203, 3, 11, 0, 1),
(2204, 4, 11, 0, 1),
(2205, 5, 11, 0, 1),
(2206, 11, 11, 0, 1),
(2207, 12, 11, 0, 1),
(2208, 19, 11, 0, 1),
(2209, 20, 11, 0, 1),
(2210, 21, 11, 0, 1),
(2211, 22, 11, 0, 1),
(2212, 26, 11, 0, 1),
(2213, 28, 11, 0, 1),
(2214, 30, 11, 0, 1),
(2215, 31, 11, 0, 1),
(2216, 32, 11, 0, 1),
(2217, 33, 11, 0, 1),
(2218, 36, 11, 0, 1),
(2219, 51, 11, 0, 1),
(2220, 52, 11, 0, 1),
(2221, 53, 11, 0, 1),
(2222, 54, 11, 0, 1),
(2223, 55, 11, 0, 1),
(2224, 56, 11, 0, 1),
(2225, 57, 11, 0, 1),
(2226, 48, 11, 9, 1),
(2227, 49, 11, 9, 1),
(2233, 45, 11, 2, 1),
(2234, 46, 11, 2, 1),
(2235, 58, 11, 2, 1),
(2236, 45, 11, 2, 3),
(2237, 46, 11, 2, 3),
(2238, 47, 11, 2, 3),
(2312, 23, 11, 5, 1),
(2313, 42, 8, 5, 1),
(2314, 43, 8, 5, 1),
(2315, 43, 11, 5, 1),
(2316, 44, 8, 5, 1),
(2317, 44, 11, 5, 1),
(2318, 23, 11, 5, 3),
(2319, 40, 8, 5, 3),
(2320, 41, 8, 5, 3),
(2321, 41, 12, 5, 3),
(2322, 42, 12, 5, 3),
(2323, 43, 8, 5, 3),
(2324, 43, 12, 5, 3),
(2339, 7, 11, 3, 1),
(2340, 9, 8, 3, 1),
(2341, 9, 11, 3, 1),
(2342, 10, 11, 3, 1),
(2343, 10, 12, 3, 1),
(2344, 24, 8, 3, 1),
(2345, 24, 11, 3, 1),
(2346, 35, 8, 3, 1),
(2347, 7, 11, 3, 3),
(2348, 9, 11, 3, 3),
(2349, 10, 11, 3, 3),
(2350, 24, 11, 3, 3),
(2351, 34, 11, 3, 3),
(2352, 35, 11, 3, 3),
(2353, 38, 11, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `system_reports`
--

CREATE TABLE `system_reports` (
  `id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
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

INSERT INTO `system_reports` (`id`, `date_added`, `created_by`, `report_code`, `report_name`, `report_description`, `form_link`, `report_header`, `report_footer`) VALUES
(2, '2018-04-22 08:19:39', '9', 'std_health_shortened', 'Student Height Weight Blood Pressure', 'Student Height, Weight, Blood Pressure Only', '3', 1, 0),
(5, '2018-04-22 08:19:39', '9', 'tchr_personal_info_rpt', 'Teachers Personal Information', 'Teachers Personal Information', '10', 4, 0),
(6, '2018-04-22 08:19:39', '4', 'std_rpt_health', 'Summary Student Health', 'Student Health Summary', '3', 3, 0);

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
(77, 5, 36, 1),
(78, 5, 38, 2),
(79, 5, 39, 3),
(80, 5, 40, 4),
(81, 5, 54, 5),
(82, 5, 55, 6),
(105, 6, 20, 1),
(106, 6, 22, 2),
(107, 6, 23, 3),
(108, 6, 26, 4),
(109, 6, 28, 5),
(110, 2, 20, 1),
(111, 2, 22, 2),
(112, 2, 23, 3),
(113, 2, 26, 4),
(114, 2, 28, 5);

-- --------------------------------------------------------

--
-- Table structure for table `system_reports_hnf`
--

CREATE TABLE `system_reports_hnf` (
  `id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_reports_hnf`
--

INSERT INTO `system_reports_hnf` (`id`, `date_added`, `created_by`, `name`, `content`, `type`) VALUES
(1, '2018-05-06 03:09:56', '', 'APE Summary', '<center>\nDepartment of Education	<br>\nRegion III<br>\n<strong>DIVISION OF CITY OF SAN FERNANDO</strong>	<br>\nSindalan, City of San Fernando (P)	<br>\n<strong>SUMMARY OF ANNUAL PHYSICAL EXAM S.Y. 2018-2019</strong><br>\n</center>', 'header'),
(3, '2018-05-06 03:09:56', '', 'SES', '<center>\nDepartment of Education	<br>\nRegion III<br>\n<strong>DIVISION OF CITY OF SAN FERNANDO</strong>	<br>\nSindalan, City of San Fernando (P)	<br>\n<strong>SINDALAN ELEMENTARY SCHOOL</strong><br>\n</center>', 'header'),
(4, '2018-05-06 03:09:56', '', 'ICTHS', '<center>\r\nDepartment of Education	<br>\r\nRegion III<br>\r\n<strong>DIVISION OF CITY OF SAN FERNANDO</strong>	<br>\r\nSindalan, City of San Fernando (P)	<br>\r\n<strong>INFORMATION AND COMMUNICATION TECHNOLOGY HIGH SCHOOL</strong><br>\r\n</center>', 'header'),
(10, '2018-05-06 03:11:28', '9', 'Test Header 6', '<p style="text-align: center;"><em><strong>dadad</strong></em>&nbsp;</p>', 'footer');

-- --------------------------------------------------------

--
-- Table structure for table `system_schools`
--

CREATE TABLE `system_schools` (
  `id` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_code` varchar(255) NOT NULL,
  `school_acronym` varchar(255) NOT NULL,
  `school_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_schools`
--

INSERT INTO `system_schools` (`id`, `school_name`, `school_code`, `school_acronym`, `school_description`) VALUES
(1, 'Default School', 'DEFAULT', 'DEFAULT', 'DEFAULT SYSTEM SCHOOL'),
(2, 'Calulut Integrated School', 'CIS-CSFP', 'CIS', 'Calulut Primary School'),
(3, 'Information and Communication Technology High School', 'ICTHS-CSFP', 'ICTHS', 'ICT High School Sindalan CSFP');

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
  `school_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_users`
--

INSERT INTO `system_users` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `unique_code`, `school_id`, `entity_id`, `email`, `mobile`, `created_by`, `date_added`) VALUES
(1, 'admin', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'Admin', '', 'User', '', 0, 0, 'ecj@mailinator.com', '0917 123 2234', 0, '2018-04-21 04:33:14'),
(3, 'jairenz@gmail.com', 'Batu_SA-asdad', 'Jairenz', 'Tiongson', 'Batu', 'SA-asdad', 3, 5, 'jairenz@gmail.com', '12321310', 0, '2018-04-21 04:33:14'),
(4, 'jm@gmail.com', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'Juan', 'Miguel', 'Dela Cruz', 'TA-1231', 3, 11, 'jm@gial.com', '123123', 0, '2018-04-21 04:33:14'),
(6, 'jairenzbatu@live.com', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'Jairenz', 'Tiongson', 'Batu', 'HAU-JAIRENZ123', 1, 5, 'jairenzbatu@live.com', '12313233', 0, '2018-04-21 04:33:14'),
(7, 'jd@gmail.com', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'John', 'Doe', 'Doe Jr.', 'SH-1234', 1, 11, 'jd@gmail.com', '12313', 0, '2018-04-21 04:33:14'),
(8, 'emc@gmail.com', 'e69e55f966edfcf67691a36d2802775a1c5a486e', 'Ed', 'Canlas', 'Canlas', 'CIS-ED1', 1, 8, 'emc@gmail.com', '12312312', 0, '2018-04-21 04:33:14'),
(9, 'rsw@gmail.com', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'Rose', 'Wijangco', 'Wijangco', 'CIS-ROSE', 1, 11, 'rsw@gmail.com', '132123123123', 0, '2018-04-21 04:33:14'),
(10, 'crc@gmail.com', 'ec4eface3edd12dee07252f073e9421e92dd4b44', 'Courtney', 'Ross', 'Cunningham', 'STUDENT-1315', 3, 5, 'crc@gmail.com', '1221313123123', 0, '2018-04-21 04:33:14'),
(11, 'lbs@gmail.com', '9c463180f88c5373b14e213e23ecea46e90ad351', 'Leroy', 'Bell', 'Smith', 'STUDENT-2556', 3, 5, 'lbs@gmail.com', '1231231231', 0, '2018-04-21 04:33:14'),
(12, 'dhs@gmail.com', '978c7a607f5ba669b07a643b69ff66607ca94fe3', 'Dora', 'Howard', 'Silva', 'TEACHER-0013', 3, 8, 'dhs@gmail.com', '231321312323', 0, '2018-04-21 04:33:14'),
(13, 'rbw@gmail.com', '077fea66a9cb5188834e2543967fc7be52c640c2', 'Roxanne', 'Boone', 'Woods', 'STUDENT-3579', 1, 5, 'rbw@gmail.com', '123132132113', 9, '2018-04-21 04:33:14'),
(14, 'btj@gmail.com', '7c6fbe1ce614ee630334168936fc813a8f7ee874', 'Brook', 'Thomas', 'Jones', 'ICT-1235', 1, 5, 'btj@gmail.com', '12313', 9, '2018-05-06 02:35:47'),
(15, 'mrg@gmail.com', 'fe6c7649ea8facd9253ab1d8a33012931bda0356', 'Misty', 'Riddle', 'Green', 'SFC-1099', 1, 5, 'mrg@gmail.com', '123112321313', 9, '2018-05-06 02:38:17'),
(16, 'asd@gmail.com', 'ad69eb5ce820c6721cfe323b8802c9e0d5aa593b', 'adasd', 'dasd', 'asdasd', 'dasdasd', 1, 13, 'asd@gmail.com', 'ad', 9, '2018-05-06 03:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `usr_afsdf`
--

CREATE TABLE `usr_afsdf` (
  `id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `unique_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usr_fadfasf`
--

CREATE TABLE `usr_fadfasf` (
  `id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `unique_code` varchar(255) NOT NULL
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
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `unique_code` varchar(255) NOT NULL,
  `std_sh_height` varchar(255) NOT NULL,
  `std_sh_weight` varchar(255) NOT NULL,
  `std_sh_bp` varchar(255) NOT NULL,
  `std_sh_smoking` text NOT NULL,
  `std_sh_alcohol_drinking` text NOT NULL,
  `std_color_blindness` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usr_std_health`
--

INSERT INTO `usr_std_health` (`id`, `date_added`, `created_by`, `unique_code`, `std_sh_height`, `std_sh_weight`, `std_sh_bp`, `std_sh_smoking`, `std_sh_alcohol_drinking`, `std_color_blindness`) VALUES
(1, '2018-04-21 03:11:09', '0', 'SIN-9871', '170', '50', '80-90', 'No', 'No', ''),
(2, '2018-04-21 03:11:09', '0', 'SF231-1245', '145', '40', '90/80', 'Yes', 'No', ''),
(4, '2018-04-21 03:11:09', '0', 'SA-asdad', '170', '77', '90/180', 'No', 'Yes', ''),
(8, '2018-04-21 03:11:09', '0', 'SA-T1231', '123', '34', 'iuo', 'No', 'No', ''),
(15, '2018-04-21 03:11:09', '0', 'STUDENT-2556', '188', '70', '90/100', 'No', 'No', ''),
(16, '0000-00-00 00:00:00', '0', 'STUDENT-3579', '190', '80', '2313', 'No', 'No', ''),
(18, '0000-00-00 00:00:00', '9', 'SFC-1099', '180', '70', '3123', 'No', 'No', 'No'),
(20, '0000-00-00 00:00:00', '1', 'HAU-JAIRENZ123', 'adasd', 'asd', 'asd', 'No', 'No', 'No');

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
  `tchr_address` varchar(255) NOT NULL,
  `tchr_marital_status` text NOT NULL,
  `tchr_rem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usr_tchr_personal_info`
--

INSERT INTO `usr_tchr_personal_info` (`id`, `date_added`, `user_id`, `unique_code`, `tchr_nickname`, `tchr_phone_number`, `tchr_address`, `tchr_marital_status`, `tchr_rem`) VALUES
(1, '0000-00-00 00:00:00', '', 'SF001-112', 'Gil', '0917 400 1111', '', '', ''),
(2, '0000-00-00 00:00:00', '', 'CIS-ED1', 'Ed', '09123131313', 'Calulut', 'Married', 'none'),
(3, '0000-00-00 00:00:00', '', 'CIS-AIZ1', 'Aiza', '1231313123', 'Calulut', 'Married', ''),
(5, '0000-00-00 00:00:00', '0', 'TEACHER-0013', 'Dora', 'asdsd', 'adasd', 'Married', 'adasd');

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
-- Indexes for table `system_schools`
--
ALTER TABLE `system_schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_users`
--
ALTER TABLE `system_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_afsdf`
--
ALTER TABLE `usr_afsdf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_fadfasf`
--
ALTER TABLE `usr_fadfasf`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `system_fields`
--
ALTER TABLE `system_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `system_forms`
--
ALTER TABLE `system_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `system_permissions`
--
ALTER TABLE `system_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `system_permissions_config`
--
ALTER TABLE `system_permissions_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2354;
--
-- AUTO_INCREMENT for table `system_reports`
--
ALTER TABLE `system_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `system_reports_config`
--
ALTER TABLE `system_reports_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `system_reports_hnf`
--
ALTER TABLE `system_reports_hnf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `system_schools`
--
ALTER TABLE `system_schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `system_users`
--
ALTER TABLE `system_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `usr_afsdf`
--
ALTER TABLE `usr_afsdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usr_fadfasf`
--
ALTER TABLE `usr_fadfasf`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `usr_tchr`
--
ALTER TABLE `usr_tchr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usr_tchr_personal_info`
--
ALTER TABLE `usr_tchr_personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
