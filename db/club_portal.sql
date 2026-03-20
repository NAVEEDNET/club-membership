-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2026 at 06:44 AM
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
-- Database: `club_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@club.com', '$2y$12$Ks7UaOQTrp4YYBfAnB2aVOa6ulrTtxZUI/XH4TMscUKLYY7jlfMii', '2026-03-07 06:12:40', '2026-03-07 06:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `nic` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `membership_type` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `status` enum('active','expired') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_id`, `full_name`, `nic`, `date_of_birth`, `membership_type`, `email`, `phone`, `address`, `photo`, `qr_code`, `start_date`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(3, 'MB003', 'mohammed naveed', '1234567', '2025-08-01', 'Junior', 'admin@example.com', '0774648456', 'gqadghk', 'members/photos/Hz0gTE9FudokTSIeAXUE7SipQgg3XWbrI9yxhyJX.jpg', NULL, '2026-03-07', '2027-03-07', 'active', '2026-03-07 06:31:37', '2026-03-07 06:31:37'),
(4, 'MB004', 'Mohammed  Nawas', '1234567', '2025-08-01', 'Senior', 'admin@example.com', '0774648456', 'wanahapuwa', 'members/photos/vi6rZZIBTnjbleINxBkHXFd7UoA27IVjFhtwmAOj.png', NULL, '2026-03-07', '2027-03-07', 'active', '2026-03-07 06:56:22', '2026-03-07 06:56:22'),
(5, 'MB005', 'Mohammed  Nawas', '20010702000', '2025-04-01', 'Senior', 'naveed123@gmail.com', '0774859632', 'gqadghk', 'members/photos/raS9oDxvG7CPaO4sTdbWOVUejv7DOFIwZPEX1V90.png', NULL, '2026-03-08', '2027-03-08', 'active', '2026-03-07 23:27:57', '2026-03-07 23:27:57'),
(7, 'MB007', 'farhan', '20010702000', '1990-05-06', 'Junior', 'naveed123@gmail.com', '0774859632', 'gqadghk', 'members/photos/N5EESEefbFs8r78bUXFHJqjLMIADTSOqwXHeTQvK.jpg', 'member_7.svg', '2026-03-08', '2026-04-08', 'active', '2026-03-08 00:24:52', '2026-03-08 00:24:53'),
(8, 'MB008', 'mohamed zumry', '1234567', '2001-10-19', 'silver', '123zumry@gmail.com', '0778965432', 'wanahapuwa', 'members/photos/Th4nIhkllMBKp0rSUotzm4ZcS7PIk3zOufOVemcV.png', 'member_8.svg', '2026-03-19', '2027-01-19', 'active', '2026-03-18 18:31:18', '2026-03-18 18:31:27'),
(9, 'MB009', 'mohammed mifras', '123455698', '1996-09-15', 'Gold', '123zumry@gmail.com', '0778965432', 'bopitiya', 'members/photos/NITF1449UIueUwqMcNZMmSwo6JgSKgoZgS33Ikwh.png', 'member_9.svg', '2026-03-20', '2027-03-20', 'active', '2026-03-20 00:12:37', '2026-03-20 00:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `membership_cards`
--

CREATE TABLE `membership_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `qr_code_path` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, 'club_create_admins_table', 1),
(2, 'club_create_members_table', 1),
(3, 'club_create_membership_cards_table', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_member_id_unique` (`member_id`);

--
-- Indexes for table `membership_cards`
--
ALTER TABLE `membership_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_cards_member_id_foreign` (`member_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `membership_cards`
--
ALTER TABLE `membership_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membership_cards`
--
ALTER TABLE `membership_cards`
  ADD CONSTRAINT `membership_cards_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
