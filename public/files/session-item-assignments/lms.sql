-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2024 at 10:02 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-06-23 08:17:06', '2024-06-23 08:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `grade` int NOT NULL,
  `major` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `order` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `code`, `grade`, `major`, `order`, `created_at`, `updated_at`) VALUES
(1, 'X IPA 1', 10, 'IPA', 1, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(2, 'X IPA 2', 10, 'IPA', 2, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(3, 'X IPA 3', 10, 'IPA', 3, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(4, 'X IPA 4', 10, 'IPA', 4, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(5, 'X IPS 1', 10, 'IPS', 1, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(6, 'X IPS 2', 10, 'IPS', 2, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(7, 'X IPS 3', 10, 'IPS', 3, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(8, 'X IPS 4', 10, 'IPS', 4, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(9, 'XI IPA 1', 11, 'IPA', 1, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(10, 'XI IPA 2', 11, 'IPA', 2, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(11, 'XI IPA 3', 11, 'IPA', 3, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(12, 'XI IPA 4', 11, 'IPA', 4, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(13, 'XI IPS 1', 11, 'IPS', 1, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(14, 'XI IPS 2', 11, 'IPS', 2, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(15, 'XI IPS 3', 11, 'IPS', 3, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(16, 'XI IPS 4', 11, 'IPS', 4, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(17, 'XII IPA 1', 12, 'IPA', 1, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(18, 'XII IPA 2', 12, 'IPA', 2, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(19, 'XII IPA 3', 12, 'IPA', 3, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(20, 'XII IPA 4', 12, 'IPA', 4, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(21, 'XII IPS 1', 12, 'IPS', 1, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(22, 'XII IPS 2', 12, 'IPS', 2, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(23, 'XII IPS 3', 12, 'IPS', 3, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(24, 'XII IPS 4', 12, 'IPS', 4, '2024-06-23 08:17:06', '2024-06-23 08:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-05-01-043134', 'App\\Database\\Migrations\\CreateRole', 'default', 'App', 1719130622, 1),
(2, '2024-05-01-060351', 'App\\Database\\Migrations\\CreateUser', 'default', 'App', 1719130622, 1),
(3, '2024-05-01-062038', 'App\\Database\\Migrations\\CreateAdmin', 'default', 'App', 1719130622, 1),
(4, '2024-05-01-062041', 'App\\Database\\Migrations\\CreateTeacher', 'default', 'App', 1719130622, 1),
(5, '2024-05-01-062045', 'App\\Database\\Migrations\\CreateSubject', 'default', 'App', 1719130623, 1),
(6, '2024-05-01-062047', 'App\\Database\\Migrations\\CreateTeacherSubject', 'default', 'App', 1719130623, 1),
(7, '2024-05-01-062050', 'App\\Database\\Migrations\\CreateClass', 'default', 'App', 1719130623, 1),
(8, '2024-05-01-062055', 'App\\Database\\Migrations\\CreateStudent', 'default', 'App', 1719130623, 1),
(9, '2024-05-04-155104', 'App\\Database\\Migrations\\CreateSemester', 'default', 'App', 1719130623, 1),
(10, '2024-05-07-142223', 'App\\Database\\Migrations\\CreateSchedule', 'default', 'App', 1719130623, 1),
(11, '2024-05-23-091545', 'App\\Database\\Migrations\\CreateSession', 'default', 'App', 1719130623, 1),
(12, '2024-05-25-050355', 'App\\Database\\Migrations\\SiteSetting', 'default', 'App', 1719130623, 1),
(13, '2024-05-26-033709', 'App\\Database\\Migrations\\CreateSessionItem', 'default', 'App', 1719130623, 1),
(14, '2024-05-26-093215', 'App\\Database\\Migrations\\CreateSessionItemComment', 'default', 'App', 1719130623, 1),
(15, '2024-06-17-043522', 'App\\Database\\Migrations\\CreateStudentClass', 'default', 'App', 1719130623, 1),
(16, '2024-06-17-183754', 'App\\Database\\Migrations\\CreateStudentAssignment', 'default', 'App', 1719130623, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(2, 'Guru', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(3, 'Siswa', '2024-06-23 08:17:06', '2024-06-23 08:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `teacher_id` int UNSIGNED NOT NULL,
  `teacher_subject_id` int UNSIGNED NOT NULL,
  `semester_id` int UNSIGNED NOT NULL,
  `day` int NOT NULL,
  `start_period` int NOT NULL,
  `end_period` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `code`, `class_id`, `teacher_id`, `teacher_subject_id`, `semester_id`, `day`, `start_period`, `end_period`, `created_at`, `updated_at`) VALUES
(3, 'SCH-1111913', 1, 1, 19, 1, 1, 1, 3, '2024-06-23 09:23:27', '2024-06-23 09:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int UNSIGNED NOT NULL,
  `semester` int NOT NULL,
  `semester_year` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester`, `semester_year`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-2021', '2024-06-23 08:17:07', '2024-06-23 08:17:07'),
(2, 2, '2021-2022', '2024-06-23 08:17:07', '2024-06-23 08:17:07'),
(3, 3, '2022-2023', '2024-06-23 08:17:07', '2024-06-23 08:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `schedule_id` int UNSIGNED NOT NULL,
  `week` int NOT NULL,
  `date` date DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `code`, `description`, `schedule_id`, `week`, `date`, `banner`, `created_at`, `updated_at`) VALUES
(41, 'SS-3-1111913-1', NULL, 3, 1, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(42, 'SS-3-1111913-2', NULL, 3, 2, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(43, 'SS-3-1111913-3', NULL, 3, 3, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(44, 'SS-3-1111913-4', NULL, 3, 4, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(45, 'SS-3-1111913-5', NULL, 3, 5, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(46, 'SS-3-1111913-6', NULL, 3, 6, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(47, 'SS-3-1111913-7', NULL, 3, 7, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(48, 'SS-3-1111913-8', NULL, 3, 8, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(49, 'SS-3-1111913-9', NULL, 3, 9, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(50, 'SS-3-1111913-10', NULL, 3, 10, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(51, 'SS-3-1111913-11', NULL, 3, 11, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(52, 'SS-3-1111913-12', NULL, 3, 12, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(53, 'SS-3-1111913-13', NULL, 3, 13, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(54, 'SS-3-1111913-14', NULL, 3, 14, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(55, 'SS-3-1111913-15', NULL, 3, 15, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(56, 'SS-3-1111913-16', NULL, 3, 16, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(57, 'SS-3-1111913-17', NULL, 3, 17, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(58, 'SS-3-1111913-18', NULL, 3, 18, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(59, 'SS-3-1111913-19', NULL, 3, 19, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27'),
(60, 'SS-3-1111913-20', NULL, 3, 20, NULL, NULL, '2024-06-23 09:23:27', '2024-06-23 09:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `session_items`
--

CREATE TABLE `session_items` (
  `id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` int NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session_item_comments`
--

CREATE TABLE `session_item_comments` (
  `id` int UNSIGNED NOT NULL,
  `session_item_id` int UNSIGNED NOT NULL,
  `comment_text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `slug`, `value`, `created_at`, `updated_at`) VALUES
(1, 'CURRENT_SEMESTER_ID', '1', '2024-06-23 08:17:07', '2024-06-23 08:17:07'),
(2, 'TOTAL_SESSION', '20', '2024-06-23 08:17:07', '2024-06-23 08:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `nisn` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `nisn`, `created_at`, `updated_at`) VALUES
(1, 3, '1823456002', '2024-06-23 08:17:07', '2024-06-23 08:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `student_assignments`
--

CREATE TABLE `student_assignments` (
  `id` int UNSIGNED NOT NULL,
  `session_item_id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `grade` int DEFAULT NULL,
  `feedback` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_classes`
--

CREATE TABLE `student_classes` (
  `id` int UNSIGNED NOT NULL,
  `semester_id` int UNSIGNED NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'AGM', 'Agama', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(2, 'BND', 'Bahasa Indonesia', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(3, 'BNG', 'Bahasa Inggris', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(4, 'BIO', 'Biologi', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(5, 'EKO', 'Ekonomi', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(6, 'FIS', 'Fisika', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(7, 'GEO', 'Geografi', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(8, 'KIM', 'Kimia', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(9, 'MKM', 'Matematika Minat', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(10, 'MKW', 'Matematika Wajib', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(11, 'PKW', 'Pendidikan Kewirausahaan', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(12, 'PJK', 'Penjaskes', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(13, 'PKN', 'PKN', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(14, 'SJM', 'Sejarah Minat', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(15, 'SJW', 'Sejarah Wajib', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(16, 'SNM', 'Seni Musik', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(17, 'SNR', 'Seni Rupa', '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(18, 'SOS', 'Sosiologi', '2024-06-23 08:17:06', '2024-06-23 08:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `nip`, `created_at`, `updated_at`) VALUES
(1, 2, '199205142023052008', '2024-06-23 08:17:06', '2024-06-23 09:48:25'),
(2, 4, '123123213213213213213', '2024-06-23 09:15:21', '2024-06-23 09:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `teachers_subjects`
--

CREATE TABLE `teachers_subjects` (
  `id` int UNSIGNED NOT NULL,
  `teacher_id` int UNSIGNED NOT NULL,
  `subject_id` int UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers_subjects`
--

INSERT INTO `teachers_subjects` (`id`, `teacher_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(19, 1, 1, '2024-06-23 09:23:04', '2024-06-23 09:23:04'),
(25, 2, 2, '2024-06-23 09:48:56', '2024-06-23 09:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `full_name`, `role_id`, `profile_picture`, `phone_number`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'maldini@example.com', '$2y$10$Hs.yZv9hGFO8yuvWjQNgqOlSJ78mS9KEKtJxsly9hVYfHbgn0QLam', 'Admin Maldini', 1, 'undraw_profile.svg', '081285483572', 1, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(2, 'eko@example.com', '$2y$10$jnzz61WlDuJ3F61DYTWAb.3jEBIYltmKfacti3P8eSdQP5LtyX6Jy', 'Susilo Eko', 2, 'undraw_profile.svg', '081285483572', 1, '2024-06-23 08:17:06', '2024-06-23 09:48:25'),
(3, 'pradyanti@example.com', '$2y$10$U3s2LoGeA7xdRfv..h4jlOk5sB5QyGRNWYMz9Dn4UzmtWZSpV59Lq', 'Pradyanti', 3, 'undraw_profile.svg', '081285483572', 1, '2024-06-23 08:17:06', '2024-06-23 08:17:06'),
(4, 'bagus@example.com', '$2y$10$cx.wTMAuqFykChMM/.Gzf.uxQlEQm4FfbujMB3PQ8BwgMPe3j6TsO', 'Bagus Nugraha', 2, 'undraw_profile.svg', '081285483501', 1, '2024-06-23 09:15:21', '2024-06-23 09:48:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `schedules_class_id_foreign` (`class_id`),
  ADD KEY `schedules_teacher_id_foreign` (`teacher_id`),
  ADD KEY `schedules_teacher_subject_id_foreign` (`teacher_subject_id`),
  ADD KEY `schedules_semester_id_foreign` (`semester_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `semester` (`semester`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `sessions_schedule_id_foreign` (`schedule_id`);

--
-- Indexes for table `session_items`
--
ALTER TABLE `session_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_items_session_id_foreign` (`session_id`),
  ADD KEY `session_items_user_id_foreign` (`user_id`);

--
-- Indexes for table `session_item_comments`
--
ALTER TABLE `session_item_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_item_comments_session_item_id_foreign` (`session_item_id`),
  ADD KEY `session_item_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD KEY `students_user_id_foreign` (`user_id`);

--
-- Indexes for table `student_assignments`
--
ALTER TABLE `student_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_assignments_session_item_id_foreign` (`session_item_id`),
  ADD KEY `student_assignments_student_id_foreign` (`student_id`);

--
-- Indexes for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_classes_semester_id_foreign` (`semester_id`),
  ADD KEY `student_classes_class_id_foreign` (`class_id`),
  ADD KEY `student_classes_student_id_foreign` (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `teachers_user_id_foreign` (`user_id`);

--
-- Indexes for table `teachers_subjects`
--
ALTER TABLE `teachers_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_subjects_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teachers_subjects_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `session_items`
--
ALTER TABLE `session_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session_item_comments`
--
ALTER TABLE `session_item_comments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_assignments`
--
ALTER TABLE `student_assignments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_classes`
--
ALTER TABLE `student_classes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers_subjects`
--
ALTER TABLE `teachers_subjects`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `schedules_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `schedules_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `schedules_teacher_subject_id_foreign` FOREIGN KEY (`teacher_subject_id`) REFERENCES `teachers_subjects` (`id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `session_items`
--
ALTER TABLE `session_items`
  ADD CONSTRAINT `session_items_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `session_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `session_item_comments`
--
ALTER TABLE `session_item_comments`
  ADD CONSTRAINT `session_item_comments_session_item_id_foreign` FOREIGN KEY (`session_item_id`) REFERENCES `session_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `session_item_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_assignments`
--
ALTER TABLE `student_assignments`
  ADD CONSTRAINT `student_assignments_session_item_id_foreign` FOREIGN KEY (`session_item_id`) REFERENCES `session_items` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `student_assignments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD CONSTRAINT `student_classes_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_classes_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_classes_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `teachers_subjects`
--
ALTER TABLE `teachers_subjects`
  ADD CONSTRAINT `teachers_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `teachers_subjects_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
