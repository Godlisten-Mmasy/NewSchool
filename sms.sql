-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2021 at 06:45 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(191) NOT NULL,
  `attendance_id` varchar(191) CHARACTER SET ascii NOT NULL,
  `student_id` varchar(191) CHARACTER SET ascii NOT NULL,
  `attendance_status` varchar(191) NOT NULL,
  `attendance_comment` varchar(191) DEFAULT NULL,
  `attendance_date` date NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `attendance_id`, `student_id`, `attendance_status`, `attendance_comment`, `attendance_date`, `created_at`, `updated_at`) VALUES
(29, '60e903c27aa0b', '60aa326b4be3b', 'present', NULL, '2021-07-09', '2021-07-10 06:19:46', '2021-07-10 06:19:46'),
(30, '60e903c2832fb', '60aa327e73ac7', 'absent', 'Parrent Should Come', '2021-07-09', '2021-07-10 06:19:46', '2021-07-10 06:34:43'),
(31, '60e903c28aed4', '60aa99966b6ce', 'absent', NULL, '2021-07-09', '2021-07-10 06:19:46', '2021-07-10 06:34:43'),
(32, '60ebbc060b4f0', '60aa326b4be3b', 'present', NULL, '2021-07-11', '2021-07-12 07:50:30', '2021-07-12 07:50:30'),
(33, '60ebbc06145af', '60aa327e73ac7', 'absent', 'Parrent Should Come', '2021-07-11', '2021-07-12 07:50:30', '2021-07-12 07:57:45'),
(34, '60ebbc062c4e6', '60aa99966b6ce', 'absent', NULL, '2021-07-11', '2021-07-12 07:50:30', '2021-07-12 07:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(191) CHARACTER SET ascii NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_id`, `name`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, '60a36b2870c24', 'FORM I ART', '60a39712a4605', '2021-05-18 14:22:16', '2021-05-18 14:22:16'),
(2, '60a36b8691e8a', 'FORM II ART', '60a39712a4605', '2021-05-18 14:23:50', '2021-05-18 14:23:50'),
(3, '60a36b8e4457e', 'FORM III ART', '60a2dc18d10c8', '2021-05-18 14:23:58', '2021-07-08 00:19:18'),
(4, '60a36b94b5b47', 'FORM IV ART', '60a39712a4605', '2021-05-18 14:24:04', '2021-05-18 14:24:04'),
(5, '60a36b9d2295d', 'FORM I SCIENCE', '60a39712a4605', '2021-05-18 14:24:13', '2021-05-18 14:49:02'),
(6, '60a36bac690cb', 'FORM II SCIENCE', '60a2dc18d10c8', '2021-05-18 14:24:28', '2021-07-08 00:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2021_05_05_182237_create_articles_table', 1),
(9, '2021_05_10_112900_create_subjectsps_table', 1),
(10, '2021_05_10_113037_create_subjects_table', 1),
(11, '2021_05_10_113054_create_classes_table', 1),
(12, '2021_05_10_113113_create_teachers_table', 1),
(13, '2021_05_10_113152_create_timetables_table', 1),
(14, '2021_05_23_094544_results', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(191) NOT NULL,
  `result_id` varchar(191) NOT NULL,
  `class_id` varchar(191) CHARACTER SET armscii8 NOT NULL,
  `student_id` varchar(191) CHARACTER SET ascii NOT NULL,
  `subject_id` varchar(191) CHARACTER SET ascii NOT NULL,
  `score` int(3) NOT NULL,
  `total_score` int(11) DEFAULT NULL,
  `result_status` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `result_id`, `class_id`, `student_id`, `subject_id`, `score`, `total_score`, `result_status`, `created_at`, `updated_at`) VALUES
(258, '60ddf48dd8e7b', '60a36b2870c24', '60aa99966b6ce', '60a36ad34c749', 80, 498, '', '2021-07-01 20:59:57', '2021-07-02 03:57:35'),
(259, '60ddf48ddb03b', '60a36b2870c24', '60aa326b4be3b', '60a36ad34c749', 100, 240, '', '2021-07-01 20:59:57', '2021-07-02 10:06:06'),
(260, '60ddf49980395', '60a36b2870c24', '60aa327e73ac7', '60a36ad34c749', 40, 610, '', '2021-07-01 21:00:09', '2021-07-02 03:57:35'),
(261, '60ddf55c49321', '60a36b2870c24', '60aa99966b6ce', '60a36dd40eb25', 80, NULL, '', '2021-07-01 21:03:24', '2021-07-02 05:03:08'),
(262, '60ddf55c5bafa', '60a36b2870c24', '60aa326b4be3b', '60a36dd40eb25', 91, NULL, '', '2021-07-01 21:03:24', '2021-07-05 22:44:07'),
(263, '60ddf6081b72a', '60a36b2870c24', '60aa327e73ac7', '60a36dd40eb25', 6, NULL, '', '2021-07-01 21:06:16', '2021-07-01 21:06:16'),
(279, '60de4f2b56662', '60a36b2870c24', '60aa326b4be3b', '60c2c364be7a8', 23, NULL, '', '2021-07-02 03:26:35', '2021-07-12 07:21:33'),
(280, '60de4f2b5d8c0', '60a36b2870c24', '60aa326b4be3b', '60c2c32001a9a', 34, NULL, '', '2021-07-02 03:26:35', '2021-07-02 03:32:09'),
(281, '60de4f2b75d79', '60a36b2870c24', '60aa326b4be3b', '60a369700b6c9', 78, NULL, '', '2021-07-02 03:26:35', '2021-07-12 07:22:50'),
(282, '60de4f2b7e252', '60a36b2870c24', '60aa326b4be3b', '60a36e0d0d937', 44, NULL, '', '2021-07-02 03:26:35', '2021-07-02 03:32:37'),
(283, '60de4f2b869b8', '60a36b2870c24', '60aa326b4be3b', '60a36df918d39', 90, NULL, '', '2021-07-02 03:26:35', '2021-07-12 07:23:51'),
(284, '60de4f2b8fa34', '60a36b2870c24', '60aa99966b6ce', '60c2c364be7a8', 10, NULL, '', '2021-07-02 03:26:35', '2021-07-12 07:21:34'),
(285, '60de4f2b96d44', '60a36b2870c24', '60aa99966b6ce', '60c2c32001a9a', 33, NULL, '', '2021-07-02 03:26:35', '2021-07-02 03:32:09'),
(286, '60de4f2b9f025', '60a36b2870c24', '60aa99966b6ce', '60a369700b6c9', 87, NULL, '', '2021-07-02 03:26:35', '2021-07-12 07:22:50'),
(287, '60de4f2ba72c9', '60a36b2870c24', '60aa99966b6ce', '60a36e0d0d937', 65, NULL, '', '2021-07-02 03:26:35', '2021-07-02 03:32:38'),
(288, '60de4f2baf6a9', '60a36b2870c24', '60aa99966b6ce', '60a36df918d39', 78, NULL, '', '2021-07-02 03:26:35', '2021-07-12 07:23:51'),
(289, '60de4f2bb8b2d', '60a36b2870c24', '60aa327e73ac7', '60c2c364be7a8', 56, NULL, '', '2021-07-02 03:26:35', '2021-07-12 07:21:34'),
(290, '60de4f2bc29b5', '60a36b2870c24', '60aa327e73ac7', '60c2c32001a9a', 54, NULL, '', '2021-07-02 03:26:35', '2021-07-02 03:32:09'),
(291, '60de4f2bcaebf', '60a36b2870c24', '60aa327e73ac7', '60a369700b6c9', 11, NULL, '', '2021-07-02 03:26:35', '2021-07-12 07:22:50'),
(292, '60de4f2bd2fe5', '60a36b2870c24', '60aa327e73ac7', '60a36e0d0d937', 12, NULL, '', '2021-07-02 03:26:35', '2021-07-02 03:32:38'),
(293, '60de4f2bdb187', '60a36b2870c24', '60aa327e73ac7', '60a36df918d39', 18, NULL, '', '2021-07-02 03:26:35', '2021-07-12 07:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(10) NOT NULL,
  `student_id` varchar(191) CHARACTER SET ascii NOT NULL,
  `fname` varchar(191) NOT NULL,
  `sname` varchar(191) NOT NULL,
  `tname` varchar(191) NOT NULL,
  `class` varchar(191) NOT NULL,
  `phone` int(10) NOT NULL,
  `total_score` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `fname`, `sname`, `tname`, `class`, `phone`, `total_score`, `created_at`, `updated_at`) VALUES
(16, '60aa326b4be3b', 'Emmanuel', 'Sammba', 'Magari', '60a36b2870c24', 769314295, 460, '2021-07-12 03:23:58', '2021-07-12 07:23:58'),
(17, '60aa327e73ac7', 'Juma', 'Petro', 'Jackson', '60a36b2870c24', 769314295, 197, '2021-07-12 03:23:58', '2021-07-12 07:23:58'),
(20, '60aa99966b6ce', 'Andrew', 'M', 'Mjuni', '60a36b2870c24', 769314295, 433, '2021-07-12 03:23:58', '2021-07-12 07:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_id`, `name`, `created_at`, `updated_at`) VALUES
(1, '60a369700b6c9', 'GEOGRAPHY', '2021-05-18 14:14:56', '2021-05-18 14:56:00'),
(2, '60a36ad34c749', 'HISTORY', '2021-05-18 14:20:51', '2021-05-18 14:20:51'),
(3, '60a36dd40eb25', 'BIOLOGY', '2021-05-18 14:33:40', '2021-05-18 14:33:40'),
(4, '60a36df918d39', 'MATHEMATICS', '2021-05-18 14:34:17', '2021-05-18 14:34:17'),
(5, '60a36e0d0d937', 'ENGLISH', '2021-05-18 14:34:37', '2021-05-18 14:34:37'),
(9, '60c2c32001a9a', 'CIVICS', '2021-06-11 05:57:52', '2021-06-11 05:57:52'),
(10, '60c2c364be7a8', 'KISWAHILI', '2021-06-11 05:59:00', '2021-06-11 05:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `subjectsps`
--

CREATE TABLE `subjectsps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_id`, `fname`, `sname`, `tname`, `phone`, `email`, `created_at`, `last_login`, `updated_at`) VALUES
(4, '60a2dc18d10c8', 'Faraja', 'Samba', 'Magari', '+255769314295', 'faraja@gmail.com', '2021-05-18 04:11:52', NULL, '2021-05-18 04:17:28'),
(5, '60a39712a4605', 'Emmanuel', 'Masawe', 'Magari', '+255769800800', 'masawe@gmail.com', '2021-05-18 17:29:38', NULL, '2021-05-18 17:29:38'),
(6, '60e61b5f92efc', 'Manyigu', 'Masandu', 'Manyigu', '788778845', 'manyigu@gmail.com', '2021-07-08 01:23:43', NULL, '2021-07-08 01:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `timetable_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` time NOT NULL,
  `to_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `timetable_id`, `teacher_id`, `subject_id`, `class_id`, `day`, `time`, `to_time`, `created_at`, `updated_at`) VALUES
(1, '60beb8a6bd4bc', '60a2dc18d10c8', '60a36ad34c749', '60a36b2870c24', 'Monday', '08:00:00', '10:00:00', '2021-06-08 04:24:06', '2021-07-10 17:48:58'),
(2, '60beb9e5de911', '60a39712a4605', '60a369700b6c9', '60a36bac690cb', 'Monday', '08:00:00', '10:00:00', '2021-06-08 04:29:25', '2021-07-10 17:49:30'),
(3, '60e351cd34186', '60a39712a4605', '60a36dd40eb25', '60a36b2870c24', 'Monday', '17:00:00', '19:00:00', '2021-07-05 22:39:09', '2021-07-10 18:11:10'),
(4, '60e61ac52e08c', '60a2dc18d10c8', '60a36dd40eb25', '60a36b8691e8a', 'Monday', '18:00:00', '20:00:00', '2021-07-08 01:21:09', '2021-07-10 17:49:19'),
(5, '60e6264ce1ce7', '60e61b5f92efc', '60c2c364be7a8', '60a36b8691e8a', 'Monday', '15:00:00', '17:00:00', '2021-07-08 02:10:20', '2021-07-10 17:46:22'),
(6, '60e628a6a8bf6', '60e61b5f92efc', '60c2c364be7a8', '60e60795bc3d2', 'Monday', '13:02:00', '15:57:00', '2021-07-08 02:20:22', '2021-07-08 02:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Pedro Jackson', 'Head Master', 'petrojackson5@gmail.com', NULL, '$2y$10$G/S9VBL9Cybp8Sn3iyVOxe4JlxmNTRzoIr63CVnu08ZSVUxzCLBrq', NULL, '12-07-2021 16:07:35', '2021-05-10 18:51:58', '2021-07-12 20:35:05'),
(2, 'issa', 'Head Master', 'issa@sms', NULL, '$2y$10$vQw5tVn3Of5TEoM0bA0Y0eX4aYFUJaZB/Y6kqZcVxNtFChi4IM.ce', NULL, '12-07-2021 03:07:29', '2021-05-12 00:36:14', '2021-07-12 07:29:20'),
(7, 'Faraja Samba Magari', '', 'faraja@gmail.com', NULL, '$2y$10$.8vCqIvNQCSwXZQLOIM1Eu75cNe7PmhWV8nSVbDL0mX.ECfHW3xzy', NULL, NULL, '2021-05-18 04:11:52', '2021-05-18 04:17:28'),
(8, 'Emmanuel Masawe Magari', '', 'masawe@gmail.com', NULL, '$2y$10$.8vCqIvNQCSwXZQLOIM1Eu75cNe7PmhWV8nSVbDL0mX.ECfHW3xzy', NULL, '12-07-2021 16:07:42', '2021-05-18 17:29:38', '2021-07-12 20:42:28'),
(11, 'Manyigu Masandu Manyigu', '', 'manyigu@gmail.com', NULL, '$2y$10$JBOoShDXFX0RfwCDwIbFtenOgeDvAn8NtYJM1LF.nzf3/WUg3saru', NULL, NULL, '2021-07-08 01:23:43', '2021-07-08 01:23:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `subjectsps`
--
ALTER TABLE `subjectsps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjectsps`
--
ALTER TABLE `subjectsps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
