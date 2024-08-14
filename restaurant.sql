-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2024 at 09:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `food_id` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `food_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, '3', '2', '3', '2024-07-31 01:07:43', '2024-07-31 01:07:51'),
(2, '3', '3', '3', '2024-07-31 01:07:58', '2024-07-31 01:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `title`, `image`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Chocolate Cake', '1722406972.jpg', '14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedii do eiusmod teme.', '2024-07-31 00:52:52', '2024-07-31 00:52:52'),
(2, 'Klassy Pancake', '1722407006.jpg', '22', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedii do eiusmod teme.', '2024-07-31 00:53:26', '2024-07-31 00:53:26'),
(3, 'Tall Klassy Bread', '1722407450.jpg', '18', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedii do eiusmod teme.', '2024-07-31 01:00:50', '2024-07-31 01:00:50'),
(4, 'Blueberry CheeseCake', '1722407482.jpg', '10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedii do eiusmod teme.', '2024-07-31 01:01:22', '2024-07-31 01:01:22'),
(5, 'Klassy Cup Cake', '1722407507.jpg', '8.50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedii do eiusmod teme.', '2024-07-31 01:01:47', '2024-07-31 01:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `food_chefs`
--

CREATE TABLE `food_chefs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `speciality` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_chefs`
--

INSERT INTO `food_chefs` (`id`, `name`, `speciality`, `image`, `created_at`, `updated_at`) VALUES
(1, 'David Martin', 'Cookie Chef', '1722407580.jpg', '2024-07-31 01:03:00', '2024-07-31 01:03:00'),
(2, 'Peter Perkson', 'Pancake Chef', '1722407608.jpg', '2024-07-31 01:03:28', '2024-07-31 01:03:28'),
(3, 'Randy Walker', 'Pastry Chef', '1722407639.jpg', '2024-07-31 01:03:59', '2024-07-31 01:03:59');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_07_26_081646_create_sessions_table', 1),
(5, '2024_07_26_082454_create_password_resets_table', 1),
(6, '2024_07_26_082512_create_failed_jobs_table', 1),
(7, '2024_07_26_132107_create_food_table', 1),
(8, '2024_07_27_070834_create_reservations_table', 1),
(9, '2024_07_27_075238_create_foodchefs_table', 1),
(10, '2024_07_27_111137_create_carts_table', 1),
(12, '2024_07_28_142208_create_orders_table', 1),
(13, '2024_08_10_112939_add_phone_and_address_to_users_table', 2),
(14, '2024_08_11_143640_create_plans_table', 3),
(15, '2024_08_11_143717_create_stripe_users_table', 3),
(16, '2024_08_11_143748_create_user_subscription_table_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `food_id`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '1', 'paid', '2024-08-10 04:35:43', '2024-08-10 04:35:43'),
(2, 2, 4, '2', 'paid', '2024-08-10 04:35:43', '2024-08-10 04:35:43'),
(3, 2, 2, '1', 'paid', '2024-08-10 04:36:54', '2024-08-10 04:36:54'),
(4, 2, 1, '1', 'paid', '2024-08-10 04:47:47', '2024-08-10 04:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `stripe_plan_id` varchar(200) DEFAULT NULL,
  `plan_name` varchar(200) NOT NULL,
  `plan_price` double DEFAULT NULL,
  `plan_type` tinyint(4) NOT NULL COMMENT '1 for monthly, 2 yearly',
  `status` tinyint(4) NOT NULL COMMENT '0 for inactive, 1 for active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `uuid`, `stripe_plan_id`, `plan_name`, `plan_price`, `plan_type`, `status`, `created_at`, `updated_at`) VALUES
(1, '56dba066-3060-4459-b8b4-329449b14857', 'price_1PmcoTBvltxMBr80XYilI0cN', 'Gold Monthly', 10, 1, 1, '2024-08-11 09:35:47', '2024-08-11 09:35:47'),
(2, '335a498d-caf0-4d41-b933-b5be1e5f649e', 'price_1Pmd9bBvltxMBr80UVkSpoce', 'Gold Yearly', 100, 2, 1, '2024-08-11 09:35:47', '2024-08-11 09:35:47');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `guest` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `email`, `phone`, `guest`, `date`, `time`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Shivangi Gupta', 'shigigupta@gmail.com', '8978675645', '5', '31.07.2024', '14:04', 'please make reservation for 5 members.', '2024-07-31 01:05:03', '2024-07-31 01:05:03'),
(2, 'Aman Gupta', 'aman@gmail.com', '7867789876', '2', '15.07.2024', '10:05', 'please make my order fast', '2024-07-31 01:06:09', '2024-07-31 01:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pzNf0BF2pZacQ5mJjJNjXPeKNzBINkCKpTE1IgJr', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidmNCck0zczRvSjBsblFUeHBHZm1MZzhXSTRvOElDV1Jwa1hxWURHaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1723447688),
('vAvberMrdEHuClNn7YWgsBM9ga1MVwOf7vroImPP', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTnhPOG91TGR5SWM4RGJMeXRWUEdiNnZjd2wzbVJISlBzTTNvcWZFZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcmRlcnMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1723293601),
('wQpMnN1FChD5uaOdbTSSYViDSdp6BWnQDkTUVDhq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiTEpla1l2V3U2dzZuZWZjNnJXOWRxajBQT1kwaTZOSUlKQkFVZkZMMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1723386290);

-- --------------------------------------------------------

--
-- Table structure for table `stripe_users`
--

CREATE TABLE `stripe_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Relation with user table',
  `stripe_customer_id` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `phone`, `address`, `usertype`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, '', 'Admin', 'admin@gmail.com', '9876543213', 'lucknow', '1', NULL, '$2y$10$TeF4r//cpfdO3oc4qmcz2ubTT4Il4lljQpZ2IYitvKqESaSKdPrEK', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-31 00:49:37', '2024-07-31 00:49:37'),
(2, '', 'User', 'user@gmail.com', '8978675645', 'pune', '0', NULL, '$2y$10$824YlHh/PASKBTEEoWwNEejBlsiAWCvGaOb7Kr8QU2akYejNsIlrS', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-31 00:50:16', '2024-07-31 00:50:16'),
(3, '', 'Shivangi Gupta', 'shigigupta@gmail.com', NULL, NULL, '0', NULL, '$2y$10$1wjbfyUYH5UTr2glR4GOGeFJNya5AD7THFa12peDB5H6Yuc2mEZga', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-31 01:07:30', '2024-07-31 01:07:30'),
(4, '56dba066-3060-4459-b8b4-329449b14857', 'john doe', 'johndoe@gmail.com', NULL, NULL, '0', NULL, '$2y$10$fc.X43pSe/vohCMRmRSv.uWkdGWrGuribMPNB9yowrlckuobNpizi', NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-12 01:20:16', '2024-08-12 01:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `pi_intent_id` varchar(255) DEFAULT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Relation with plan table',
  `user_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone_number` varchar(200) DEFAULT NULL,
  `current_status` varchar(255) NOT NULL DEFAULT '0' COMMENT '0 cancel,1 active',
  `subscription_id` varchar(200) DEFAULT NULL,
  `stripe_user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Relation with plan table',
  `plan_amount` double DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `description` text DEFAULT NULL,
  `payment_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 for subscription 2 for one time payment 3 for aditional payment',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_chefs`
--
ALTER TABLE `food_chefs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_food_id_foreign` (`food_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plans_uuid_unique` (`uuid`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stripe_users`
--
ALTER TABLE `stripe_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stripe_users_uuid_unique` (`uuid`),
  ADD KEY `stripe_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_subscriptions_uuid_unique` (`uuid`),
  ADD KEY `user_subscriptions_plan_id_foreign` (`plan_id`),
  ADD KEY `user_subscriptions_stripe_user_id_foreign` (`stripe_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food_chefs`
--
ALTER TABLE `food_chefs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stripe_users`
--
ALTER TABLE `stripe_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stripe_users`
--
ALTER TABLE `stripe_users`
  ADD CONSTRAINT `stripe_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD CONSTRAINT `user_subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_subscriptions_stripe_user_id_foreign` FOREIGN KEY (`stripe_user_id`) REFERENCES `stripe_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
