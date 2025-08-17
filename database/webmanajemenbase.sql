-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 17, 2025 at 01:40 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webmanajemenbase`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `score` int DEFAULT NULL,
  `week_start_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `content`, `score`, `week_start_date`, `created_at`, `updated_at`) VALUES
(1, 12, '🧪 Dummy Narasi Testing - Minggu Ini\r\n1. Desain & Koordinasi\r\n\r\nMinggu ini saya fokus membuat tampilan antarmuka halaman dashboard untuk project internal. Saya juga mengikuti rapat koordinasi dengan tim untuk pembagian tugas lanjutan.\r\n\r\n2. Debugging & Dokumentasi\r\n\r\nTelah menyelesaikan perbaikan pada bug fitur login yang menyebabkan redirect bermasalah. Selain itu saya melengkapi dokumentasi untuk modul autentikasi pengguna.\r\n\r\n3. Penulisan Proposal & Riset\r\n\r\nMenyusun draft proposal untuk kegiatan kampus base project dan membaca referensi teknis mengenai integrasi API. Juga sempat membantu tim lain dalam sesi brainstorming.\r\n\r\n4. Review & Uji Coba Fitur\r\n\r\nMelakukan testing terhadap fitur unggah file dan memberikan feedback ke developer utama. Saya juga mencoba menyusun test case untuk fitur-fitur baru yang akan dirilis.', 76, '2025-06-16', '2025-06-19 14:30:48', '2025-06-19 15:23:42'),
(6, 17, 'dawdadawdwa', 72, '2025-06-16', '2025-06-20 01:51:13', '2025-06-20 04:15:13'),
(7, 12, 'y5y5y5y5e', 70, '2025-06-23', '2025-06-23 00:09:42', '2025-06-23 00:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `campus_tasks`
--

CREATE TABLE `campus_tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `mata_kuliah` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tugas` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `deadline` date NOT NULL,
  `status` enum('On-going','Done') COLLATE utf8mb4_general_ci DEFAULT 'On-going',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campus_tasks`
--

INSERT INTO `campus_tasks` (`id`, `user_id`, `mata_kuliah`, `tugas`, `deadline`, `status`, `created_at`, `updated_at`) VALUES
(3, 5, 'testt', 'fedfe', '2025-06-16', 'On-going', '2025-06-15 09:53:29', '2025-06-15 09:53:29'),
(4, 5, 'testt', 'dw', '2025-06-25', 'Done', '2025-06-15 09:57:42', '2025-06-15 09:57:42'),
(7, 9, 'scm', 'jk', '2025-06-21', 'On-going', '2025-06-16 14:16:20', '2025-06-16 14:16:20'),
(8, 12, 'Pemrograman Web', 'Membuat Website', '2025-06-26', 'Done', '2025-06-16 17:42:27', '2025-06-24 01:18:50'),
(9, 12, 'wada', 'dawd', '2025-06-18', 'Done', '2025-06-17 05:09:42', '2025-06-20 03:35:18'),
(11, 12, 'dawdaw', 'dawdaw', '2025-06-30', 'Done', '2025-06-20 03:35:31', '2025-06-20 03:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_project` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fokus` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `skema` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `week` int NOT NULL,
  `komentar_awal` text COLLATE utf8mb4_general_ci,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'Belum Dimulai',
  `output` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `nama_project`, `pic`, `fokus`, `skema`, `tahun`, `start_date`, `end_date`, `week`, `komentar_awal`, `status`, `output`, `created_at`, `updated_at`) VALUES
(7, 'fa', 'fwa', 'faw', 'Pengabdian Masyarakat', 2025, NULL, '2025-06-20', 1, 'fwfa', 'Belum Dimulai', NULL, '2025-06-15 13:07:44', '2025-08-17 06:28:01'),
(8, 'faaw', 'fawf', 'fawf', 'Penelitian', 2025, NULL, '2025-06-26', 1, 'fawfaw', 'Belum Dimulai', NULL, '2025-06-15 13:09:19', '2025-08-17 06:27:59'),
(9, 'gdgdr', 'gdr', 'gdrg', 'Pengabdian Kepada Masyarakat', 2025, NULL, '2025-06-21', 1, 'gdrgd', 'Belum Dimulai', NULL, '2025-06-15 14:29:27', '2025-08-17 06:27:57'),
(10, 'dwa', 'awd', 'dwad', 'Penelitian', 2025, NULL, '2025-07-03', 1, 'dad', 'Belum Dimulai', NULL, '2025-06-16 16:36:27', '2025-08-17 06:27:54'),
(11, 'dadad', 'dawd', 'da', 'Penelitian', 2025, NULL, '2025-06-28', 1, 'dadawd', 'Belum Dimulai', NULL, '2025-06-16 16:37:18', '2025-08-17 06:27:52'),
(12, 'Akuakultur', 'Bima', 'UCT', 'Pengabdian Kepada Masyarakat', 2025, NULL, '2025-06-21', 1, 'Segera', 'Belum Dimulai', NULL, '2025-06-16 17:44:41', '2025-08-17 06:27:50'),
(13, 'dwad', 'dawd', 'dad', 'Pengabdian Kepada Masyarakat', 2025, NULL, '2025-06-26', 1, 'awdaw', 'Belum Dimulai', NULL, '2025-06-17 05:10:26', '2025-08-17 06:27:48'),
(14, 'fsef', 'fes', 'fse', 'Penelitian', 2025, NULL, '2025-07-05', 1, 'fesf', 'Belum Dimulai', NULL, '2025-06-20 02:40:10', '2025-08-17 06:27:45'),
(15, 'ss', 'awik', 'apa', 'Penelitian', 2025, NULL, '2025-07-22', 1, NULL, 'Belum Dimulai', NULL, '2025-07-22 02:58:02', '2025-08-17 06:27:41'),
(16, 'a', 'a', NULL, 'Penelitian', 2025, NULL, NULL, 1, NULL, 'Belum Dimulai', NULL, '2025-07-22 02:59:00', '2025-08-17 06:27:39'),
(20, 'Test Week 2', 'a', NULL, 'Penelitian', 2025, '2025-08-18', '2025-09-02', 3, NULL, 'Belum Dimulai', NULL, '2025-08-16 23:31:07', '2025-08-16 23:31:07'),
(21, 'Test Week 3', 'a', NULL, 'Penelitian', 2025, '2025-08-20', '2025-09-03', 3, NULL, 'Belum Dimulai', NULL, '2025-08-17 03:22:43', '2025-08-17 03:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `project_requests`
--

CREATE TABLE `project_requests` (
  `id` int NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','accepted','rejected') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_requests`
--

INSERT INTO `project_requests` (`id`, `project_id`, `user_id`, `status`, `created_at`) VALUES
(8, 7, 12, 'accepted', '2025-06-24 01:37:38'),
(9, 7, 19, 'accepted', '2025-07-22 03:01:26'),
(10, 8, 19, 'accepted', '2025-07-23 00:04:17'),
(11, 7, 20, 'accepted', '2025-08-11 23:56:29'),
(12, 21, 20, 'accepted', '2025-08-17 03:37:27');

-- --------------------------------------------------------

--
-- Table structure for table `project_submissions`
--

CREATE TABLE `project_submissions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `uraian` text COLLATE utf8mb4_general_ci NOT NULL,
  `files` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `komentar_admin` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_submissions`
--

INSERT INTO `project_submissions` (`id`, `user_id`, `project_id`, `uraian`, `files`, `created_at`, `updated_at`, `status`, `komentar_admin`) VALUES
(2, 9, 7, 'dwaaw', '[\"1750110253_bima nitip.docx\"]', '2025-06-16 14:44:13', '2025-06-16 14:44:13', NULL, NULL),
(3, 9, 8, 'dwqdw', '[\"1750116004_bima nitip.docx\"]', '2025-06-16 16:20:04', '2025-06-16 16:20:04', NULL, NULL),
(4, 17, 7, 'dwda', '[\"1750420295_7. Template Polimesin. Rev 1 (1).doc\"]', '2025-06-20 04:51:35', '2025-06-20 04:51:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`id`, `project_id`, `user_id`, `created_at`) VALUES
(1, 8, 19, '2025-07-23 07:14:11'),
(2, 7, 20, '2025-08-12 06:56:35'),
(3, 21, 20, '2025-08-17 10:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `project_weekly_tasks`
--

CREATE TABLE `project_weekly_tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `assigned_to` int DEFAULT NULL,
  `week_number` int DEFAULT NULL,
  `week_start_date` date NOT NULL,
  `week_end_date` date DEFAULT NULL,
  `task_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_weekly_tasks`
--

INSERT INTO `project_weekly_tasks` (`id`, `project_id`, `assigned_to`, `week_number`, `week_start_date`, `week_end_date`, `task_description`, `created_at`, `updated_at`) VALUES
(1, 7, NULL, NULL, '2025-06-25', NULL, 'dawdawd', '2025-06-24 13:34:01', '2025-06-24 13:34:01'),
(2, 7, NULL, NULL, '2025-06-25', NULL, 'dawdw', '2025-06-24 13:34:01', '2025-06-24 13:34:01'),
(4, 8, NULL, NULL, '2025-07-21', NULL, 'Membuat Tabel', '2025-07-23 00:15:26', '2025-07-23 00:15:26'),
(5, 8, NULL, NULL, '2025-07-21', NULL, 'Membuat Navbar', '2025-07-23 00:15:26', '2025-07-23 00:15:26'),
(6, 7, NULL, NULL, '2025-08-25', NULL, 'Membuat Tabel', '2025-08-16 23:08:07', '2025-08-16 23:08:07'),
(7, 7, NULL, NULL, '2025-08-25', NULL, 'Membuat Tabel2', '2025-08-16 23:08:07', '2025-08-16 23:08:07'),
(8, 21, 20, 1, '2025-08-15', '2025-08-17', 'Membuat Tabel', '2025-08-17 03:31:16', '2025-08-17 13:27:18'),
(9, 21, NULL, 2, '2025-08-25', '2025-08-31', 'Membuat Tabel 2', '2025-08-17 03:32:42', '2025-08-17 12:37:18'),
(10, 21, 20, 3, '2025-09-01', '2025-09-03', 'Membuat Tabel 3', '2025-08-17 03:33:13', '2025-08-17 06:27:48'),
(11, 21, 20, 2, '2025-08-25', '2025-08-31', 'Membuat Navbar 2', '2025-08-17 05:39:25', '2025-08-17 06:14:52'),
(12, 21, NULL, 2, '2025-08-25', '2025-08-31', 'Membuat Homepage 2', '2025-08-17 05:39:25', '2025-08-17 05:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `project_weekly_task_submissions`
--

CREATE TABLE `project_weekly_task_submissions` (
  `id` bigint UNSIGNED NOT NULL,
  `project_weekly_task_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identitas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `program_studi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile_photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','anggotabase') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'anggotabase'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `identitas`, `program_studi`, `profile_photo`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(5, 'ahmad', NULL, NULL, NULL, 'ahmad@gmail.com', NULL, '$2y$10$Bn/TrH.45LQXSAdoOBKyFOc2xx/3lqxXNc9CqF2Z9nA7q5wLPbd3K', NULL, '2025-06-14 05:50:49', '2025-06-14 05:50:49', 'admin'),
(9, 'ivann', NULL, NULL, 'profile_photos/mQoJtjfv2WAhqz5LzINCR6tKacCI5QhwL3mG10ML.jpg', 'ivannnn@gmail.com', NULL, '$2y$10$O7HPzlY/iYno1OzVtY4oheRlGTZR3kw0EwMFBmqfUQmpLe2HXDOpi', NULL, '2025-06-16 14:12:13', '2025-06-16 14:12:13', 'anggotabase'),
(12, 'Ivan Ahmad Wijaya', '2210512115', 's1 sistem informasi', 'profile_photos/WVrHZ7oNyiNENhDsyQnuysJW2M3aHZ1KFErQ8Y2q.jpg', '2210512115@mahasiswa.upnvj.ac.id', NULL, '$2y$10$BaWN6k4UnrXVX4zVDV0wDeqrmHS9bsofG1qe8OyquLKDAUvmXPh.u', NULL, '2025-06-16 17:41:00', '2025-06-16 17:41:00', 'anggotabase'),
(13, 'James Julian', '0987654321', 'Dosen FT', 'profile_photos/CsYI7rr1aWMTIyEaHJ4M20iYETitzZEmjPBsFnzg.jpg', 'jamesjulian@gmail.com', NULL, '$2y$10$VN5QkXEnqL6HIUUgrmHXiOjREsuer7fu5CokfHPwG3VwxLRnV8wWq', NULL, '2025-06-16 17:43:40', '2025-06-16 17:43:40', 'admin'),
(17, 'bimarakha', '2210512113', 'S1 teknik mesin', 'profile_photos/q9Nd4PxVyu6paqIFvaaV9TzGnZdmxfMGXXaAxXG2.jpg', 'bimarakha@gmail.com', NULL, '$2y$10$bS/TKe4ulKBLibcEAjQY2.2EbxQta8YqTRtzj35e6NW2NvCKJSc.O', NULL, '2025-06-20 01:51:01', '2025-06-20 01:51:01', 'anggotabase'),
(18, 'abdul', '2210512044', 'Sistem Informasi', 'profile_photos/ZkF53BopAPChP6D1p1f1VvKULdx3BuRml1giSDfA.jpg', 'abdulhakim54362@gmail.com', NULL, '$2y$10$PlZsTFeeKBtdgvFyIpQqQeDmeGSQoVkG1RRDTyu3qTpnzcobxVmVK', NULL, '2025-07-17 08:04:49', '2025-07-17 08:04:49', 'admin'),
(19, 'Pencari Projek', '2210512044', 'Sistem Informasi', NULL, 'p@gm', NULL, '$2y$10$Zg.XvpO3d17yTFnbKFG4AO9nkIC0hkvnVXWv0KE8j.Gtu1jnYdwJm', NULL, '2025-07-22 03:01:13', '2025-07-22 03:01:13', 'anggotabase'),
(20, 'Tester Projek', '2210512044', 'S1 Sistem Informasi', NULL, 'Test@gmail.com', NULL, '$2y$10$C2.w6xG5MsnUQOMWhal4TuUZil6MQ7omW2GOW3l9WAEUWCd1bmWN6', NULL, '2025-08-11 23:56:12', '2025-08-11 23:56:12', 'anggotabase');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `campus_tasks`
--
ALTER TABLE `campus_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_requests`
--
ALTER TABLE `project_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `project_submissions`
--
ALTER TABLE `project_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `project_weekly_tasks`
--
ALTER TABLE `project_weekly_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_weekly_task_project` (`project_id`);

--
-- Indexes for table `project_weekly_task_submissions`
--
ALTER TABLE `project_weekly_task_submissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_submission` (`project_weekly_task_id`,`user_id`),
  ADD KEY `fk_task_submission_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `campus_tasks`
--
ALTER TABLE `campus_tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `project_requests`
--
ALTER TABLE `project_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `project_submissions`
--
ALTER TABLE `project_submissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_weekly_tasks`
--
ALTER TABLE `project_weekly_tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `project_weekly_task_submissions`
--
ALTER TABLE `project_weekly_task_submissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `campus_tasks`
--
ALTER TABLE `campus_tasks`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_requests`
--
ALTER TABLE `project_requests`
  ADD CONSTRAINT `project_requests_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_requests_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_submissions`
--
ALTER TABLE `project_submissions`
  ADD CONSTRAINT `project_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_submissions_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `project_user_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_weekly_tasks`
--
ALTER TABLE `project_weekly_tasks`
  ADD CONSTRAINT `fk_weekly_task_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_weekly_task_submissions`
--
ALTER TABLE `project_weekly_task_submissions`
  ADD CONSTRAINT `fk_task_submission_task` FOREIGN KEY (`project_weekly_task_id`) REFERENCES `project_weekly_tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_task_submission_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
