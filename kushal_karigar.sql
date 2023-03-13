-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2023 at 01:58 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kushal_karigar`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_data`
--

CREATE TABLE `employee_data` (
  `id` int(11) NOT NULL,
  `auth_token` text NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `type_of_job_required` text NOT NULL,
  `skill_set` text NOT NULL,
  `work_experience` text NOT NULL,
  `name` text NOT NULL,
  `gender` int(11) NOT NULL COMMENT '0 = Male, 1 = Female',
  `self_picture` text DEFAULT NULL,
  `age` text DEFAULT NULL,
  `education` text DEFAULT NULL,
  `documents` text DEFAULT NULL,
  `type_of_employement` text DEFAULT NULL,
  `expected_salary_range` text DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Enable = 0, Disable = 1',
  `is_block` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Active, 1 = Blocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employer_data`
--

CREATE TABLE `employer_data` (
  `id` int(11) NOT NULL,
  `auth_token` text NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `employer_name` text NOT NULL,
  `designation` text NOT NULL,
  `organization_name` text NOT NULL,
  `organization_type` text NOT NULL,
  `organization_email_id` text DEFAULT NULL,
  `gst_number` text DEFAULT NULL,
  `gst_certificate` text DEFAULT NULL,
  `organization_headquarters` text DEFAULT NULL,
  `organization_size` text DEFAULT NULL,
  `product_type` text DEFAULT NULL,
  `categories_hiring` text DEFAULT NULL,
  `cities_hiring` text DEFAULT NULL,
  `unit_hiring_for` text DEFAULT NULL,
  `unit_name` text DEFAULT NULL,
  `unit_address` text DEFAULT NULL,
  `unit_poc_name` text DEFAULT NULL,
  `unit_poc_contact_number` varchar(10) DEFAULT NULL,
  `unit_poc_email_id` text DEFAULT NULL,
  `unit_gst_number` text DEFAULT NULL,
  `unit_location_latitude` varchar(255) DEFAULT NULL,
  `unit_location_longitude` varchar(255) NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Enable = 0, Disable = 1',
  `is_block` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Active, 1 = Block'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expected_salary_range`
--

CREATE TABLE `expected_salary_range` (
  `id` int(11) NOT NULL,
  `salary_range` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `created_by` tinyint(1) NOT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `updated_by` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expected_salary_range`
--

INSERT INTO `expected_salary_range` (`id`, `salary_range`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(1, '5000+', '2023-03-09 18:22:00.000000', 1, NULL, NULL, 0),
(2, '10000+', '2023-03-09 18:22:00.000000', 1, NULL, NULL, 0),
(3, '15000+', '2023-03-09 18:23:00.000000', 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_name` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `created_by` tinyint(1) NOT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `updated_by` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(1, 'Process Engineer', '2023-03-01 10:47:00.000000', 1, '2023-03-01 11:23:00.000000', 1, 0),
(2, 'Operations Trainee', '2023-03-01 10:48:00.000000', 1, '0000-00-00 00:00:00.000000', NULL, 0),
(3, 'Finishing and Processing', '2023-03-01 10:48:00.000000', 1, NULL, NULL, 0),
(4, 'Textile Designer', '2023-03-01 10:48:00.000000', 1, NULL, NULL, 0),
(5, 'Asistant Stylist', '2023-03-01 10:49:00.000000', 1, '2023-03-01 11:24:00.000000', 1, 0),
(6, 'test', '2023-03-02 06:25:00.000000', 1, '2023-03-02 12:51:00.000000', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_job_data`
--

CREATE TABLE `post_job_data` (
  `id` int(11) NOT NULL,
  `auth_token` text NOT NULL,
  `job_role` text NOT NULL,
  `specialization` text NOT NULL,
  `no_of_job_openings_for_this_role` text NOT NULL,
  `salary_range` varchar(255) NOT NULL,
  `organization_name` text NOT NULL,
  `job_type` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `state_domicile` text NOT NULL,
  `do_you_want_to_share_contact_no_with_employee` text NOT NULL,
  `mode_of_contact` text NOT NULL,
  `poc_name` text NOT NULL,
  `poc_contact_number` text NOT NULL,
  `poc_email_id` text NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Disable, 0 = Enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_job_data`
--

INSERT INTO `post_job_data` (`id`, `auth_token`, `job_role`, `specialization`, `no_of_job_openings_for_this_role`, `salary_range`, `organization_name`, `job_type`, `latitude`, `longitude`, `state_domicile`, `do_you_want_to_share_contact_no_with_employee`, `mode_of_contact`, `poc_name`, `poc_contact_number`, `poc_email_id`, `is_del`) VALUES
(1, 'Zj8pCvkAwzblKp7', 'c dc', 'cd', 'xcsc', 'csc', 'cdcd', 'cdc', 'cdcdcc', '', 'cdcd', 'cdcc', 'cdcdc', 'cdcd', 'cdcd', 'cd', 0),
(2, '1DvbzJcIkBBtYfT', 'c dc', 'cd', 'xcsc', 'csc', 'cdcd', 'cdc', 'cdcdcc', 'cxcxcx', 'cdcd', 'cdcc', 'cdcdc', 'cdcd', 'cdcd', 'cd@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `skill_name` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `created_by` tinyint(1) NOT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `updated_by` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill_name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(1, 'Single Needle', '2023-03-01 13:52:00.000000', 1, NULL, NULL, 0),
(2, 'Double Needle', '2023-03-01 13:53:00.000000', 1, NULL, NULL, 0),
(3, 'Overlock', '2023-03-01 13:53:00.000000', 1, NULL, NULL, 0),
(4, 'Flatlock', '2023-03-01 13:53:00.000000', 1, NULL, NULL, 0),
(5, 'Special Machines', '2023-03-01 13:53:00.000000', 1, NULL, NULL, 0),
(6, 'Febric Checker', '2023-03-01 13:54:00.000000', 1, NULL, NULL, 0),
(7, 'Cutting Checker', '2023-03-01 13:54:00.000000', 1, NULL, NULL, 0),
(8, 'Sewing Checker', '2023-03-01 13:54:00.000000', 1, NULL, NULL, 0),
(9, 'Finishing Checker', '2023-03-01 13:54:00.000000', 1, NULL, NULL, 0),
(10, 'Measurement Checker', '2023-03-01 13:55:00.000000', 1, NULL, NULL, 0),
(11, 'Fabric Loading/Unloading', '2023-03-01 13:55:00.000000', 1, NULL, NULL, 0),
(12, 'Cutting Helper', '2023-03-01 13:56:00.000000', 1, NULL, NULL, 0),
(13, 'Sewing Helper', '2023-03-01 13:56:00.000000', 1, NULL, NULL, 0),
(14, 'Washing Helper', '2023-03-01 13:57:00.000000', 1, NULL, NULL, 0),
(15, 'Finishing Helper', '2023-03-01 13:57:00.000000', 1, NULL, NULL, 0),
(16, 'Folder', '2023-03-01 13:57:00.000000', 1, NULL, NULL, 0),
(17, 'Packer Helper', '2023-03-01 13:58:00.000000', 1, NULL, NULL, 0),
(18, 'Thread Cutting Helper', '2023-03-01 13:58:00.000000', 1, NULL, NULL, 0),
(19, 'Others', '2023-03-01 13:59:00.000000', 1, NULL, NULL, 0),
(20, 'Sampling Tailor', '2023-03-01 13:59:00.000000', 1, NULL, NULL, 0),
(21, 'Pressman', '2023-03-01 14:03:00.000000', 1, NULL, NULL, 0),
(22, 'Spotter', '2023-03-01 14:03:00.000000', 1, NULL, NULL, 0),
(23, 'Stitching Line Supervisor', '2023-03-01 14:03:00.000000', 1, NULL, NULL, 0),
(24, 'Finishing Supervisor', '2023-03-01 14:03:00.000000', 1, NULL, NULL, 0),
(25, 'Packing Supervisor', '2023-03-01 14:04:00.000000', 1, NULL, NULL, 0),
(26, 'Line QC', '2023-03-01 14:04:00.000000', 1, NULL, NULL, 0),
(27, 'Cutting QA', '2023-03-01 14:04:00.000000', 1, NULL, NULL, 0),
(28, 'Floor QA', '2023-03-01 14:04:00.000000', 1, NULL, NULL, 0),
(29, 'Layer Man', '2023-03-01 14:04:00.000000', 1, NULL, NULL, 0),
(30, 'Cutting Master', '2023-03-01 14:04:00.000000', 1, NULL, NULL, 0),
(31, 'Pantry Boy', '2023-03-01 14:04:00.000000', 1, '2023-03-01 14:06:00.000000', 1, 0),
(32, 'test', '2023-03-02 06:29:00.000000', 1, '2023-03-02 12:50:00.000000', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `timest` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_name` text NOT NULL,
  `password` text NOT NULL,
  `request_token` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1 = adminuser, 2 = normaluser'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `timest`, `user_name`, `password`, `request_token`, `type`) VALUES
(1, '2023-03-01 05:29:35', 'admin', '$2y$10$vFajGFE2OSJNIiMRmlBtxOoCMo8BCX9GjsMlnUxjszgG4fNT7jlma', 'IMXfgUSO9pKZm5j', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `phone_number` decimal(10,0) NOT NULL,
  `auth_token` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Disable, 0 = Enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `uid`, `phone_number`, `auth_token`, `created_at`, `updated_at`, `is_del`) VALUES
(2, 1, '7041022045', '1DvbzJcIkBBtYfT', '2023-03-11 08:10:27', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `work_experiences`
--

CREATE TABLE `work_experiences` (
  `id` int(11) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `created_by` tinyint(1) NOT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `updated_by` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_experiences`
--

INSERT INTO `work_experiences` (`id`, `experience`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(1, '1 - 3 years experience', '2023-03-06 11:01:00.000000', 1, NULL, NULL, 0),
(4, '3 - 5 years experience', '2023-03-06 11:08:00.000000', 1, '2023-03-06 11:15:00.000000', 1, 0),
(6, '5 - 10 years experience', '2023-03-06 11:18:00.000000', 1, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_data`
--
ALTER TABLE `employee_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer_data`
--
ALTER TABLE `employer_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expected_salary_range`
--
ALTER TABLE `expected_salary_range`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_job_data`
--
ALTER TABLE `post_job_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_experiences`
--
ALTER TABLE `work_experiences`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_data`
--
ALTER TABLE `employee_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employer_data`
--
ALTER TABLE `employer_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expected_salary_range`
--
ALTER TABLE `expected_salary_range`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_job_data`
--
ALTER TABLE `post_job_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_experiences`
--
ALTER TABLE `work_experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
