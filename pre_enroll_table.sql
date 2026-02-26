-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2026 at 03:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enroll_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `pre_enroll_table`
--

CREATE TABLE `pre_enroll_table` (
  `Applicant_id` varchar(12) NOT NULL,
  `lrn_id` bigint(12) NOT NULL,
  `f_Name` text NOT NULL,
  `l_Name` text NOT NULL,
  `m_Name` text NOT NULL,
  `ext_name` text NOT NULL,
  `b_Day` date NOT NULL,
  `age` int(100) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `m_Tongue` text NOT NULL,
  `ip_community` enum('Yes','No') NOT NULL,
  `specific_com` text NOT NULL,
  `4ps` enum('Yes','No') NOT NULL,
  `4ps_id` int(150) NOT NULL,
  `disability` enum('Yes','No') NOT NULL,
  `specific_disability` text NOT NULL,
  `birth_cert_No` bigint(100) NOT NULL,
  `birth_place` varchar(200) NOT NULL,
  `house_no` int(255) NOT NULL,
  `st_name` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` int(10) NOT NULL,
  `perma_add` enum('Yes','No') NOT NULL,
  `p_house_no` int(255) NOT NULL,
  `p_st_name` varchar(255) NOT NULL,
  `p_brgy` varchar(255) NOT NULL,
  `p_city` varchar(255) NOT NULL,
  `p_province` varchar(255) NOT NULL,
  `p_country` varchar(255) NOT NULL,
  `p_zip_code` int(10) NOT NULL,
  `father_Lname` text NOT NULL,
  `father_Fname` text NOT NULL,
  `father_Mname` text NOT NULL,
  `father_contact` int(255) NOT NULL,
  `mother_Lname` text NOT NULL,
  `mother_Fname` text NOT NULL,
  `mother_Mname` text NOT NULL,
  `mother_contact` int(255) NOT NULL,
  `guardian_Lname` text NOT NULL,
  `guardian_Fname` text NOT NULL,
  `guardian_Mname` text NOT NULL,
  `guardian_contact` int(255) NOT NULL,
  `last_gr_complete` int(100) NOT NULL,
  `last_sch_attend` varchar(255) NOT NULL,
  `last_yr_complete` int(150) NOT NULL,
  `sch_id` int(100) NOT NULL,
  `grade_lvl` varchar(100) NOT NULL,
  `track` text NOT NULL,
  `pathway` text NOT NULL,
  `sem` enum('1st','2nd') NOT NULL,
  `learning_modality` text NOT NULL,
  `sch_yr` varchar(100) NOT NULL,
  `with_lrn` enum('Yes','No') NOT NULL,
  `returning` enum('Yes','No') NOT NULL,
  `pre_enroll_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pre_enroll_table`
--

INSERT INTO `pre_enroll_table` (`Applicant_id`, `lrn_id`, `f_Name`, `l_Name`, `m_Name`, `ext_name`, `b_Day`, `age`, `sex`, `m_Tongue`, `ip_community`, `specific_com`, `4ps`, `4ps_id`, `disability`, `specific_disability`, `birth_cert_No`, `birth_place`, `house_no`, `st_name`, `brgy`, `city`, `province`, `country`, `zip_code`, `perma_add`, `p_house_no`, `p_st_name`, `p_brgy`, `p_city`, `p_province`, `p_country`, `p_zip_code`, `father_Lname`, `father_Fname`, `father_Mname`, `father_contact`, `mother_Lname`, `mother_Fname`, `mother_Mname`, `mother_contact`, `guardian_Lname`, `guardian_Fname`, `guardian_Mname`, `guardian_contact`, `last_gr_complete`, `last_sch_attend`, `last_yr_complete`, `sch_id`, `grade_lvl`, `track`, `pathway`, `sem`, `learning_modality`, `sch_yr`, `with_lrn`, `returning`, `pre_enroll_date`) VALUES
('11', 12345, 'Stephen', 'Moncada', 'secret', 'hahaha', '2000-02-01', 26, 'Male', 'Korean', 'No', 'none', 'No', 0, 'No', '', 678832, 'lhs', 67, 'korea', 'japan', 'russia', 'masbate', 'kaligayahan', 6767, 'No', 89, 'uganda', 'opera', 'sonic x shadow', 'tgck', 'bkdk', 8989, 'lolo', 'lolo', 'lolo', 543465, 'lola', 'lola', 'lola', 23478, 'yehyeh', 'yehyeh', 'yehyeh', 875654, 11, 'Lagro High School', 2025, 12345678, 'Grade 12', 'TVL', 'ICT programming', '1st', 'online', '2025,2026', 'Yes', 'No', '2026-02-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pre_enroll_table`
--
ALTER TABLE `pre_enroll_table`
  ADD PRIMARY KEY (`Applicant_id`),
  ADD UNIQUE KEY `lrn_id` (`lrn_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
