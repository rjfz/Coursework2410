-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2020 at 01:07 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.3.17-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u_180087914_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'pets', NULL, NULL),
(2, 'phones', NULL, NULL),
(3, 'jewellery', NULL, NULL),
(4, 'other', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `item_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, '1587901323.jpg', '2020-04-26 10:42:03', '2020-04-26 10:42:03'),
(2, 2, '1587901420.jpeg', '2020-04-26 10:43:40', '2020-04-26 10:43:40'),
(3, 3, '1587902048.jpg', '2020-04-26 10:54:08', '2020-04-26 10:54:08'),
(4, 4, '1587902404.jpg', '2020-04-26 11:00:04', '2020-04-26 11:00:04'),
(5, 4, '1587902407.png', '2020-04-26 11:00:07', '2020-04-26 11:00:07'),
(6, 5, '1587902824.jpg', '2020-04-26 11:05:26', '2020-04-26 11:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_lost_on` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `found_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approval_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `date_reported` date NOT NULL,
  `date_found` date NOT NULL,
  `reported_by` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `description`, `route_lost_on`, `found_location`, `approval_state`, `date_reported`, `date_found`, `reported_by`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Joker Ollie', 'Route 66', 'Aston', 'approved', '2020-04-23', '2020-04-21', 2, 1, '2020-04-26 10:41:54', '2020-04-26 10:43:55'),
(2, 'iPhone 6', 'London -> Birmingham 11:05', 'New Street Station', 'pending', '2020-04-05', '2020-04-04', 2, 2, '2020-04-26 10:42:44', '2020-04-26 10:42:44'),
(3, 'Castafiore Emerald', 'Paris Eurostar', 'The Floor™', 'approved', '2020-04-24', '2020-04-20', 1, 3, '2020-04-26 10:53:08', '2020-04-26 11:00:15'),
(4, 'Louis Vuitton Handbag', 'Private Jet to Calais', 'Pilot\'s chair', 'approved', '2020-04-20', '2020-04-18', 1, 4, '2020-04-26 10:59:07', '2020-04-26 11:00:16'),
(5, 'Nokia 3310', 'Old Street', 'Coronation Street', 'approved', '2020-04-29', '2020-04-27', 1, 2, '2020-04-26 11:05:06', '2020-04-26 11:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2020_04_23_224804_create_categories_table', 1),
(13, '2020_04_23_224805_create_items_table', 1),
(14, '2020_04_23_224806_create_images_table', 1),
(15, '2020_04_23_224807_create_requests_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `approval_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `item_id`, `user_id`, `approval_status`, `details`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'pending', 'I want it, it\'s fluffy', '2020-04-26 11:00:33', '2020-04-26 11:00:33'),
(2, 3, 2, 'pending', 'It\'s worth bank, it must be mine', '2020-04-26 11:00:56', '2020-04-26 11:00:56'),
(3, 4, 2, 'pending', 'Can\'t relate', '2020-04-26 11:01:32', '2020-04-26 11:01:32'),
(4, 1, 7, 'pending', 'Pretty please', '2020-04-26 11:03:06', '2020-04-26 11:03:06'),
(5, 3, 7, 'pending', 'I saw it last', '2020-04-26 11:03:13', '2020-04-26 11:03:13'),
(6, 4, 7, 'pending', 'Tea', '2020-04-26 11:03:26', '2020-04-26 11:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'frog', 'admin', '180087914@aston.ac.uk', '$2y$10$h3KU6jq3sK/veZ7zLN79Je9n22lR9mtLmidGeW94uSQ.9/5D7uHqe', 'cx3k5jIQltVpgviR3y7HkTKtan6DaAgTOyF6cXBF5D9XH1gV0ibSpiJgFYbD', '2020-04-25 18:40:38', '2020-04-25 18:40:38'),
(2, 'toad', 'user', '180087914_2@aston.ac.uk', '$2y$10$RekH0Cj2A8g5lgXL4EUOHe6VkgKPrVgOuMZzUFDZgXwrtJnnwnJze', NULL, '2020-04-25 18:41:10', '2020-04-25 18:41:10'),
(7, 'newt', 'user', 'newt@google.com', '$2y$10$WjTSJ4t9jD8blzgYfmDVX.yZluJSPyV6QhYoNqg0rwjr8V6usiWPC', NULL, '2020-04-26 11:02:55', '2020-04-26 11:02:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_item_id_foreign` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_reported_by_foreign` (`reported_by`),
  ADD KEY `items_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_item_id_foreign` (`item_id`),
  ADD KEY `requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `items_reported_by_foreign` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
