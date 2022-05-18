-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 15 Apr 2022 pada 20.16
-- Versi server: 10.3.23-MariaDB-cll-lve
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `balinet_task`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_clients`
--

CREATE TABLE `category_clients` (
  `id` bigint(20) NOT NULL,
  `nama_kategori` varchar(225) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `category_clients`
--

INSERT INTO `category_clients` (`id`, `nama_kategori`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Event Organizer', 1, '2022-04-09 08:41:22', '2022-04-14 18:20:40'),
(2, 'Yayasan Sosial', 1, '2022-04-09 08:41:31', '2022-04-12 18:30:15'),
(3, 'Personal', 1, '2022-04-10 00:22:46', '2022-04-12 18:37:08'),
(4, 'Hotel & Villa', 1, '2022-04-13 21:05:54', '2022-04-13 21:05:54'),
(5, 'Industri', 1, '2022-04-13 21:06:19', '2022-04-13 21:06:19'),
(6, 'Perdagangan', 1, '2022-04-13 21:06:37', '2022-04-13 21:06:37'),
(7, 'Jasa', 1, '2022-04-13 21:06:49', '2022-04-13 21:06:49'),
(8, 'Perusahaan IT', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) NOT NULL,
  `perusahaan_id` bigint(20) NOT NULL,
  `kategori_client_id` bigint(20) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `nama_company` varchar(225) NOT NULL,
  `nama_client` varchar(225) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `clients`
--

INSERT INTO `clients` (`id`, `perusahaan_id`, `kategori_client_id`, `user_id`, `nama_company`, `nama_client`, `no_telp`, `alamat`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 19, 'Fairdy EO', 'Fairdy', '012345678', 'Sanur Denpasar', '', 1, '2022-04-12 17:37:18', '2022-04-14 03:22:39'),
(7, 1, 2, 20, 'Senyum Bali', 'Yayasan Senyum', '01234567', 'Denpasar', '', 1, '2022-04-12 18:17:13', '2022-04-12 18:17:35'),
(8, 1, 3, 21, 'Nia Cak Mat', 'Nia Cak mat', '0812345678', 'Denpasar', '', 1, '2022-04-12 18:39:27', '2022-04-12 18:39:27'),
(9, 1, 3, 23, 'Seventh Sky', 'Yunita Aryani', '012345678', 'Denpasar Bali', '', 1, '2022-04-13 15:23:58', '2022-04-13 15:23:59'),
(10, 1, 1, 28, 'Harmany Bali', 'Ngurah Dwi Putra', '12345678', 'Pure Demak Bali', '', 1, '2022-04-13 22:04:55', '2022-04-13 22:04:55'),
(11, 1, 1, 29, 'Kitara Indo Project', 'Teguh Otong', '12345678', 'Pure Demak Bali 76R', '', 1, '2022-04-13 22:20:49', '2022-04-14 18:38:49'),
(12, 1, 7, 30, 'Nusa Bari Studio', 'Berly', NULL, NULL, '', 1, '2022-04-14 19:10:27', '2022-04-14 19:10:27'),
(13, 1, 3, 31, 'NIgel Easton', 'Nigel Easton', NULL, NULL, '', 1, '2022-04-14 19:11:09', '2022-04-14 19:11:09'),
(14, 1, 3, 32, 'Wayan Darsana', 'Leo Darsana', NULL, NULL, '', 1, '2022-04-14 19:12:12', '2022-04-14 19:12:12'),
(15, 1, 8, 1, 'CV.Balinet Intermedia', 'CV.Balinet Intermedia', '081317747171', 'Jln pulau Ayu no 27', NULL, 1, NULL, NULL),
(16, 1, 8, 33, 'PT. Global Digital Verse', 'PT. Global Digital Verse', '081317747171', 'Jln Pulau Ayu no 27', '', 1, '2022-04-15 23:30:32', '2022-04-15 23:30:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) NOT NULL,
  `nama_perusahaan` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `companies`
--

INSERT INTO `companies` (`id`, `nama_perusahaan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CV. Balinet Intermedia', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `companyclients`
--

CREATE TABLE `companyclients` (
  `id` int(11) NOT NULL,
  `name` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) NOT NULL,
  `nama_divisi` varchar(80) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `divisions`
--

INSERT INTO `divisions` (`id`, `nama_divisi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Management', 1, NULL, '2022-04-08 14:19:15'),
(2, 'Web Development', 1, '2022-04-09 08:12:27', '2022-04-12 17:33:27'),
(3, 'Software Development', 1, '2022-04-09 08:12:38', '2022-04-12 17:33:55'),
(4, 'IT Solutions', 1, '2022-04-09 08:14:28', '2022-04-12 17:34:11'),
(5, 'Design & Animation', 1, '2022-04-10 00:35:02', '2022-04-12 17:34:59'),
(6, 'Offset & Digital Print', 1, '2022-04-10 04:16:06', '2022-04-10 04:16:06'),
(7, 'Distribution', 1, '2022-04-14 17:53:58', '2022-04-14 17:53:58'),
(8, 'Accounting', 1, '2022-04-14 18:48:30', '2022-04-14 18:48:30'),
(9, 'Digital Marketing', 1, '2022-04-14 18:49:04', '2022-04-14 18:49:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_logs`
--

CREATE TABLE `login_logs` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ip_address` text NOT NULL,
  `mac_address` text NOT NULL,
  `browser` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `ip_address`, `mac_address`, `browser`, `created_at`, `updated_at`) VALUES
(1, 1, '140.213.234.23', '', 'Firefox', '2022-04-12 17:22:31', '2022-04-12 17:22:31'),
(2, 9, '140.213.234.23', '', 'Chrome', '2022-04-12 17:27:03', '2022-04-12 17:27:03'),
(3, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 17:28:24', '2022-04-12 17:28:24'),
(4, 1, '140.213.234.23', '', 'Firefox', '2022-04-12 17:29:10', '2022-04-12 17:29:10'),
(5, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 17:29:30', '2022-04-12 17:29:30'),
(6, 1, '140.213.234.23', '', 'Safari Browser', '2022-04-12 17:30:59', '2022-04-12 17:30:59'),
(7, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 17:35:39', '2022-04-12 17:35:39'),
(8, 1, '140.213.234.23', '', 'Firefox', '2022-04-12 17:39:58', '2022-04-12 17:39:58'),
(9, 1, '140.213.234.23', '', 'Safari Browser', '2022-04-12 17:40:58', '2022-04-12 17:40:58'),
(10, 9, '140.213.234.23', '', 'Safari Browser', '2022-04-12 17:46:21', '2022-04-12 17:46:21'),
(11, 9, '140.213.234.23', '', 'Chrome', '2022-04-12 17:46:38', '2022-04-12 17:46:38'),
(12, 9, '140.213.234.23', '', 'Chrome', '2022-04-12 17:47:35', '2022-04-12 17:47:35'),
(13, 9, '140.213.234.23', '', 'Chrome', '2022-04-12 17:47:36', '2022-04-12 17:47:36'),
(14, 9, '140.213.234.23', '', 'Firefox', '2022-04-12 17:47:52', '2022-04-12 17:47:52'),
(15, 17, '114.125.113.61', '', 'Safari Browser', '2022-04-12 17:49:31', '2022-04-12 17:49:31'),
(16, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 17:56:55', '2022-04-12 17:56:55'),
(17, 9, '140.213.234.23', '', 'Chrome', '2022-04-12 17:57:43', '2022-04-12 17:57:43'),
(18, 17, '140.213.234.23', '', 'Chrome', '2022-04-12 18:10:14', '2022-04-12 18:10:14'),
(19, 9, '140.213.234.23', '', 'Safari Browser', '2022-04-12 18:10:34', '2022-04-12 18:10:34'),
(20, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 18:11:07', '2022-04-12 18:11:07'),
(21, 9, '140.213.234.23', '', 'Chrome', '2022-04-12 18:13:22', '2022-04-12 18:13:22'),
(22, 1, '140.213.234.23', '', 'Firefox', '2022-04-12 18:15:31', '2022-04-12 18:15:31'),
(23, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 18:15:33', '2022-04-12 18:15:33'),
(24, 9, '140.213.234.23', '', 'Chrome', '2022-04-12 18:25:24', '2022-04-12 18:25:24'),
(25, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 18:27:27', '2022-04-12 18:27:27'),
(26, 9, '140.213.234.23', '', 'Chrome', '2022-04-12 18:46:23', '2022-04-12 18:46:23'),
(27, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 18:47:37', '2022-04-12 18:47:37'),
(28, 1, '140.213.234.23', '', 'Firefox', '2022-04-12 19:35:41', '2022-04-12 19:35:41'),
(29, 7, '140.213.234.23', '', 'Chrome', '2022-04-12 19:38:07', '2022-04-12 19:38:07'),
(30, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 19:53:40', '2022-04-12 19:53:40'),
(31, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 19:54:20', '2022-04-12 19:54:20'),
(32, 1, '140.213.234.23', '', 'Firefox', '2022-04-12 20:01:49', '2022-04-12 20:01:49'),
(33, 7, '140.213.234.23', '', 'Chrome', '2022-04-12 21:25:35', '2022-04-12 21:25:35'),
(34, 7, '140.213.234.23', '', 'Chrome', '2022-04-12 22:30:23', '2022-04-12 22:30:23'),
(35, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 22:47:28', '2022-04-12 22:47:28'),
(36, 7, '140.213.234.23', '', 'Chrome', '2022-04-12 22:48:00', '2022-04-12 22:48:00'),
(37, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 23:17:27', '2022-04-12 23:17:27'),
(38, 7, '140.213.234.23', '', 'Firefox', '2022-04-12 23:20:33', '2022-04-12 23:20:33'),
(39, 7, '140.213.234.23', '', 'Chrome', '2022-04-12 23:29:15', '2022-04-12 23:29:15'),
(40, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 23:29:58', '2022-04-12 23:29:58'),
(41, 7, '140.213.234.23', '', 'Chrome', '2022-04-12 23:36:29', '2022-04-12 23:36:29'),
(42, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 23:37:25', '2022-04-12 23:37:25'),
(43, 7, '140.213.234.23', '', 'Chrome', '2022-04-12 23:38:19', '2022-04-12 23:38:19'),
(44, 1, '140.213.234.23', '', 'Chrome', '2022-04-12 23:39:11', '2022-04-12 23:39:11'),
(45, 1, '140.213.234.23', '', 'Safari Browser', '2022-04-12 23:48:40', '2022-04-12 23:48:40'),
(46, 1, '140.213.234.23', '', 'Firefox', '2022-04-12 23:59:26', '2022-04-12 23:59:26'),
(47, 7, '175.158.39.148', '', 'Safari Browser', '2022-04-13 04:00:10', '2022-04-13 04:00:10'),
(48, 1, '180.252.68.42', '', 'Firefox', '2022-04-13 15:18:51', '2022-04-13 15:18:51'),
(49, 22, '180.252.68.42', '', 'Firefox', '2022-04-13 15:22:31', '2022-04-13 15:22:31'),
(50, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 15:49:40', '2022-04-13 15:49:40'),
(51, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 15:55:58', '2022-04-13 15:55:58'),
(52, 22, '140.213.234.23', '', 'Firefox', '2022-04-13 16:14:18', '2022-04-13 16:14:18'),
(53, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 16:17:15', '2022-04-13 16:17:15'),
(54, 1, '140.213.234.23', '', 'Chrome', '2022-04-13 16:18:12', '2022-04-13 16:18:12'),
(55, 7, '140.213.234.23', '', 'Chrome', '2022-04-13 16:31:51', '2022-04-13 16:31:51'),
(56, 22, '140.213.234.23', '', 'Firefox', '2022-04-13 16:35:58', '2022-04-13 16:35:58'),
(57, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 16:36:22', '2022-04-13 16:36:22'),
(58, 22, '140.213.234.23', '', 'Firefox', '2022-04-13 16:36:29', '2022-04-13 16:36:29'),
(59, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 16:37:47', '2022-04-13 16:37:47'),
(60, 7, '140.213.234.23', '', 'Firefox', '2022-04-13 16:40:24', '2022-04-13 16:40:24'),
(61, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 16:42:50', '2022-04-13 16:42:50'),
(62, 1, '140.213.234.23', '', 'Chrome', '2022-04-13 17:23:27', '2022-04-13 17:23:27'),
(63, 1, '140.213.234.23', '', 'Chrome', '2022-04-13 17:23:58', '2022-04-13 17:23:58'),
(64, 7, '140.213.234.23', '', 'Firefox', '2022-04-13 17:24:00', '2022-04-13 17:24:00'),
(65, 7, '140.213.234.23', '', 'Chrome', '2022-04-13 17:24:38', '2022-04-13 17:24:38'),
(66, 7, '140.213.234.23', '', 'Chrome', '2022-04-13 17:24:39', '2022-04-13 17:24:39'),
(67, 7, '140.213.234.23', '', 'Firefox', '2022-04-13 17:24:44', '2022-04-13 17:24:44'),
(68, 1, '140.213.234.23', '', 'Chrome', '2022-04-13 17:25:14', '2022-04-13 17:25:14'),
(69, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 17:32:50', '2022-04-13 17:32:50'),
(70, 1, '140.213.234.23', '', 'Chrome', '2022-04-13 17:36:23', '2022-04-13 17:36:23'),
(71, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 18:22:42', '2022-04-13 18:22:42'),
(72, 7, '140.213.234.23', '', 'Firefox', '2022-04-13 18:29:49', '2022-04-13 18:29:49'),
(73, 7, '140.213.234.23', '', 'Firefox', '2022-04-13 18:53:20', '2022-04-13 18:53:20'),
(74, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 19:15:39', '2022-04-13 19:15:39'),
(75, 7, '140.213.234.23', '', 'Firefox', '2022-04-13 19:16:02', '2022-04-13 19:16:02'),
(76, 27, '140.213.234.23', '', 'Chrome', '2022-04-13 19:27:08', '2022-04-13 19:27:08'),
(77, 24, '140.213.234.23', '', 'Chrome', '2022-04-13 19:27:19', '2022-04-13 19:27:19'),
(78, 1, '140.213.234.23', '', 'Chrome', '2022-04-13 19:28:54', '2022-04-13 19:28:54'),
(79, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 20:46:55', '2022-04-13 20:46:55'),
(80, 7, '140.213.234.23', '', 'Chrome', '2022-04-13 20:48:08', '2022-04-13 20:48:08'),
(81, 1, '140.213.234.23', '', 'Chrome', '2022-04-13 20:53:31', '2022-04-13 20:53:31'),
(82, 24, '140.213.234.23', '', 'Chrome', '2022-04-13 20:55:37', '2022-04-13 20:55:37'),
(83, 22, '140.213.234.23', '', 'Firefox', '2022-04-13 20:58:22', '2022-04-13 20:58:22'),
(84, 1, '140.213.234.23', '', 'Chrome', '2022-04-13 20:59:39', '2022-04-13 20:59:39'),
(85, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 21:01:01', '2022-04-13 21:01:01'),
(86, 22, '140.213.234.23', '', 'Firefox', '2022-04-13 21:48:21', '2022-04-13 21:48:21'),
(87, 22, '140.213.234.23', '', 'Firefox', '2022-04-13 21:53:31', '2022-04-13 21:53:31'),
(88, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 21:58:04', '2022-04-13 21:58:04'),
(89, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 22:01:17', '2022-04-13 22:01:17'),
(90, 7, '140.213.234.23', '', 'Firefox', '2022-04-13 22:02:21', '2022-04-13 22:02:21'),
(91, 1, '140.213.234.23', '', 'Firefox', '2022-04-13 22:05:14', '2022-04-13 22:05:14'),
(92, 1, '140.213.234.23', '', 'Chrome', '2022-04-13 23:49:20', '2022-04-13 23:49:20'),
(93, 1, '140.213.234.23', '', 'Chrome', '2022-04-13 23:52:42', '2022-04-13 23:52:42'),
(94, 1, '140.213.234.23', '', 'Chrome', '2022-04-13 23:54:49', '2022-04-13 23:54:49'),
(95, 27, '140.213.234.23', '', 'Chrome', '2022-04-13 23:55:28', '2022-04-13 23:55:28'),
(96, 1, '140.213.234.23', '', 'Chrome', '2022-04-13 23:56:26', '2022-04-13 23:56:26'),
(97, 27, '140.213.234.23', '', 'Chrome', '2022-04-13 23:59:20', '2022-04-13 23:59:20'),
(98, 27, '140.213.234.23', '', 'Chrome', '2022-04-14 00:25:32', '2022-04-14 00:25:32'),
(99, 1, '140.213.234.23', '', 'Chrome', '2022-04-14 00:31:31', '2022-04-14 00:31:31'),
(100, 1, '140.213.234.23', '', 'Chrome', '2022-04-14 00:37:33', '2022-04-14 00:37:33'),
(101, 1, '140.213.234.23', '', 'Chrome', '2022-04-14 00:41:21', '2022-04-14 00:41:21'),
(102, 7, '140.213.234.23', '', 'Chrome', '2022-04-14 00:42:25', '2022-04-14 00:42:25'),
(103, 7, '114.5.109.198', '', 'Safari Browser', '2022-04-14 01:16:48', '2022-04-14 01:16:48'),
(104, 7, '114.5.109.198', '', 'Safari Browser', '2022-04-14 01:30:00', '2022-04-14 01:30:00'),
(105, 1, '120.188.75.230', '', 'Firefox', '2022-04-14 02:09:51', '2022-04-14 02:09:51'),
(106, 1, '120.188.75.230', '', 'Chrome', '2022-04-14 02:30:25', '2022-04-14 02:30:25'),
(107, 1, '120.188.75.230', '', 'Chrome', '2022-04-14 03:09:28', '2022-04-14 03:09:28'),
(108, 1, '180.254.225.238', '', 'Firefox', '2022-04-14 03:43:01', '2022-04-14 03:43:01'),
(109, 1, '114.4.218.139', '', 'Chrome', '2022-04-14 06:38:51', '2022-04-14 06:38:51'),
(110, 7, '114.4.218.139', '', 'Chrome', '2022-04-14 06:39:35', '2022-04-14 06:39:35'),
(111, 22, '180.252.68.42', '', 'Firefox', '2022-04-14 15:24:58', '2022-04-14 15:24:58'),
(112, 1, '140.213.234.23', '', 'Chrome', '2022-04-14 16:09:20', '2022-04-14 16:09:20'),
(113, 1, '140.213.234.23', '', 'Firefox', '2022-04-14 16:09:28', '2022-04-14 16:09:28'),
(114, 1, '140.213.234.23', '', 'Chrome', '2022-04-14 16:23:15', '2022-04-14 16:23:15'),
(115, 1, '140.213.234.23', '', 'Chrome', '2022-04-14 16:33:54', '2022-04-14 16:33:54'),
(116, 1, '140.213.234.23', '', 'Firefox', '2022-04-14 16:38:10', '2022-04-14 16:38:10'),
(117, 22, '140.213.234.23', '', 'Firefox', '2022-04-14 17:07:43', '2022-04-14 17:07:43'),
(118, 7, '140.213.234.23', '', 'Chrome', '2022-04-14 17:33:45', '2022-04-14 17:33:45'),
(119, 1, '140.213.234.23', '', 'Safari Browser', '2022-04-14 17:39:14', '2022-04-14 17:39:14'),
(120, 27, '140.213.234.23', '', 'Chrome', '2022-04-14 17:40:25', '2022-04-14 17:40:25'),
(121, 1, '140.213.234.23', '', 'Chrome', '2022-04-14 17:40:51', '2022-04-14 17:40:51'),
(122, 1, '140.213.234.23', '', 'Chrome', '2022-04-14 17:41:42', '2022-04-14 17:41:42'),
(123, 1, '140.213.234.23', '', 'Chrome', '2022-04-14 18:06:39', '2022-04-14 18:06:39'),
(124, 1, '140.213.234.23', '', 'Chrome', '2022-04-14 18:34:40', '2022-04-14 18:34:40'),
(125, 1, '140.213.234.23', '', 'Firefox', '2022-04-14 18:34:57', '2022-04-14 18:34:57'),
(126, 9, '140.213.234.23', '', 'Safari Browser', '2022-04-14 18:50:30', '2022-04-14 18:50:30'),
(127, 9, '140.213.234.23', '', 'Safari Browser', '2022-04-14 19:02:47', '2022-04-14 19:02:47'),
(128, 9, '140.213.234.23', '', 'Chrome', '2022-04-14 19:11:59', '2022-04-14 19:11:59'),
(129, 1, '114.4.218.139', '', 'Safari Browser', '2022-04-14 19:16:26', '2022-04-14 19:16:26'),
(130, 1, '114.4.218.139', '', 'Safari Browser', '2022-04-14 19:17:20', '2022-04-14 19:17:20'),
(131, 1, '114.4.218.139', '', 'Chrome', '2022-04-14 19:17:58', '2022-04-14 19:17:58'),
(132, 9, '140.213.193.216', '', 'Chrome', '2022-04-14 19:24:22', '2022-04-14 19:24:22'),
(133, 1, '114.4.218.139', '', 'Firefox', '2022-04-14 19:24:49', '2022-04-14 19:24:49'),
(134, 9, '140.213.193.216', '', 'Chrome', '2022-04-14 19:24:49', '2022-04-14 19:24:49'),
(135, 9, '140.213.193.216', '', 'Chrome', '2022-04-14 19:25:24', '2022-04-14 19:25:24'),
(136, 1, '114.4.218.139', '', 'Firefox', '2022-04-14 19:32:48', '2022-04-14 19:32:48'),
(137, 1, '140.213.193.216', '', 'Chrome', '2022-04-14 19:56:41', '2022-04-14 19:56:41'),
(138, 7, '140.213.193.216', '', 'Chrome', '2022-04-14 20:31:18', '2022-04-14 20:31:18'),
(139, 1, '140.213.193.216', '', 'Firefox', '2022-04-14 20:40:06', '2022-04-14 20:40:06'),
(140, 9, '140.213.193.216', '', 'Safari Browser', '2022-04-14 21:16:51', '2022-04-14 21:16:52'),
(141, 1, '140.213.193.216', '', 'Firefox', '2022-04-14 21:21:23', '2022-04-14 21:21:23'),
(142, 7, '140.213.193.216', '', 'Firefox', '2022-04-14 21:25:39', '2022-04-14 21:25:39'),
(143, 9, '140.213.193.216', '', 'Chrome', '2022-04-14 21:30:12', '2022-04-14 21:30:12'),
(144, 7, '223.255.228.104', '', 'Safari Browser', '2022-04-14 21:30:16', '2022-04-14 21:30:16'),
(145, 7, '140.213.193.216', '', 'Firefox', '2022-04-14 21:35:21', '2022-04-14 21:35:21'),
(146, 1, '140.213.193.216', '', 'Firefox', '2022-04-14 21:36:39', '2022-04-14 21:36:39'),
(147, 7, '140.213.193.216', '', 'Chrome', '2022-04-14 21:44:58', '2022-04-14 21:44:58'),
(148, 1, '140.213.193.216', '', 'Chrome', '2022-04-14 21:57:55', '2022-04-14 21:57:55'),
(149, 1, '140.213.193.216', '', 'Chrome', '2022-04-14 22:22:39', '2022-04-14 22:22:39'),
(150, 1, '140.213.193.216', '', 'Chrome', '2022-04-14 23:26:46', '2022-04-14 23:26:46'),
(151, 1, '140.213.193.216', '', 'Chrome', '2022-04-14 23:30:26', '2022-04-14 23:30:26'),
(152, 1, '140.213.193.216', '', 'Chrome', '2022-04-14 23:31:36', '2022-04-14 23:31:36'),
(153, 1, '114.4.219.152', '', 'Safari Browser', '2022-04-14 23:33:01', '2022-04-14 23:33:01'),
(154, 1, '140.213.193.216', '', 'Chrome', '2022-04-14 23:35:41', '2022-04-14 23:35:41'),
(155, 1, '114.4.219.152', '', 'Chrome', '2022-04-14 23:38:48', '2022-04-14 23:38:48'),
(156, 7, '140.213.193.216', '', 'Chrome', '2022-04-15 00:01:24', '2022-04-15 00:01:24'),
(157, 27, '140.213.193.216', '', 'Chrome', '2022-04-15 00:08:04', '2022-04-15 00:08:04'),
(158, 1, '140.213.193.216', '', 'Chrome', '2022-04-15 00:08:53', '2022-04-15 00:08:53'),
(159, 7, '140.213.193.216', '', 'Chrome', '2022-04-15 00:09:45', '2022-04-15 00:09:45'),
(160, 1, '180.254.224.66', '', 'Chrome', '2022-04-15 01:42:08', '2022-04-15 01:42:08'),
(161, 22, '180.252.68.42', '', 'Firefox', '2022-04-15 14:54:19', '2022-04-15 14:54:19'),
(162, 22, '140.213.197.55', '', 'Firefox', '2022-04-15 20:24:34', '2022-04-15 20:24:34'),
(163, 1, '140.213.197.55', '', 'Firefox', '2022-04-15 22:12:44', '2022-04-15 22:12:44'),
(164, 9, '140.213.127.163', '', 'Safari Browser', '2022-04-15 22:54:18', '2022-04-15 22:54:18'),
(165, 17, '140.213.197.55', '', 'Firefox', '2022-04-15 23:11:14', '2022-04-15 23:11:14'),
(166, 1, '140.213.197.55', '', 'Firefox', '2022-04-15 23:22:27', '2022-04-15 23:22:27'),
(167, 9, '140.213.126.8', '', 'Safari Browser', '2022-04-15 23:26:41', '2022-04-15 23:26:41'),
(168, 17, '140.213.197.55', '', 'Firefox', '2022-04-15 23:40:06', '2022-04-15 23:40:06'),
(169, 9, '140.213.197.55', '', 'Chrome', '2022-04-16 00:08:00', '2022-04-16 00:08:00'),
(170, 9, '140.213.197.55', '', 'Chrome', '2022-04-16 16:11:37', '2022-04-16 16:11:37'),
(171, 17, '140.213.197.55', '', 'Firefox', '2022-04-16 16:17:52', '2022-04-16 16:17:52'),
(172, 7, '140.213.197.55', '', 'Firefox', '2022-04-16 16:20:32', '2022-04-16 16:20:32'),
(173, 1, '140.213.197.55', '', 'Firefox', '2022-04-16 16:21:35', '2022-04-16 16:21:35'),
(174, 7, '140.213.197.55', '', 'Chrome', '2022-04-16 16:28:15', '2022-04-16 16:28:15'),
(175, 7, '140.213.197.55', '', 'Firefox', '2022-04-16 16:31:31', '2022-04-16 16:31:31'),
(176, 7, '140.213.197.55', '', 'Firefox', '2022-04-16 16:38:31', '2022-04-16 16:38:31'),
(177, 1, '140.213.197.55', '', 'Firefox', '2022-04-16 16:49:31', '2022-04-16 16:49:31'),
(178, 22, '140.213.197.55', '', 'Firefox', '2022-04-16 18:08:39', '2022-04-16 18:08:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `keterangan` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pics`
--

CREATE TABLE `pics` (
  `id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pics`
--

INSERT INTO `pics` (`id`, `project_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 1, '2022-04-13 22:08:28', '2022-04-13 22:08:28'),
(2, 2, 7, 1, '2022-04-13 22:16:25', '2022-04-13 22:16:25'),
(3, 3, 7, 1, '2022-04-13 22:22:33', '2022-04-13 22:22:33'),
(4, 4, 7, 1, '2022-04-14 00:43:15', '2022-04-14 00:43:15'),
(5, 5, 7, 1, '2022-04-14 16:42:54', '2022-04-14 16:42:54'),
(6, 6, 9, 1, '2022-04-14 18:54:52', '2022-04-14 18:54:52'),
(9, 10, 7, 1, '2022-04-14 20:54:45', '2022-04-14 20:54:45'),
(10, 9, 9, 1, '2022-04-14 21:17:21', '2022-04-14 21:17:21'),
(11, 8, 9, 1, '2022-04-14 21:17:40', '2022-04-14 21:17:40'),
(12, 7, 9, 1, '2022-04-14 21:18:03', '2022-04-14 21:18:03'),
(13, 11, 7, 1, '2022-04-14 21:27:45', '2022-04-14 21:27:45'),
(14, 12, 22, 1, '2022-04-14 21:47:53', '2022-04-14 21:47:53'),
(15, 13, 7, 1, '2022-04-14 21:50:07', '2022-04-14 21:50:07'),
(16, 14, 24, 1, '2022-04-14 22:14:54', '2022-04-14 22:14:54'),
(17, 15, 27, 1, '2022-04-14 22:18:22', '2022-04-14 22:18:22'),
(18, 16, 9, 1, '2022-04-15 23:09:34', '2022-04-15 23:09:34'),
(19, 17, 9, 1, '2022-04-15 23:15:25', '2022-04-15 23:15:25'),
(20, 18, 7, 1, '2022-04-15 23:36:45', '2022-04-15 23:36:45'),
(21, 20, 17, 1, '2022-04-16 16:14:31', '2022-04-16 16:14:31'),
(22, 21, 7, 1, '2022-04-16 16:39:13', '2022-04-16 16:39:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `divisi_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `perusahaan_id` bigint(20) NOT NULL,
  `judul_project` varchar(225) NOT NULL,
  `detail_project` longtext NOT NULL,
  `tgl_input` date DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `estimasi` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `prioritas` int(11) NOT NULL,
  `total_revisi` int(11) NOT NULL,
  `laporan_project` longtext DEFAULT NULL,
  `debet` double DEFAULT NULL,
  `kredit` double DEFAULT NULL,
  `foto_hasil` text DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `is_parent` int(11) DEFAULT 0,
  `project_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `project_id_2` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `projects`
--

INSERT INTO `projects` (`id`, `client_id`, `divisi_id`, `user_id`, `perusahaan_id`, `judul_project`, `detail_project`, `tgl_input`, `tgl_mulai`, `estimasi`, `tgl_selesai`, `status`, `prioritas`, `total_revisi`, `laporan_project`, `debet`, `kredit`, `foto_hasil`, `type`, `is_parent`, `project_id`, `created_at`, `project_id_2`, `updated_at`) VALUES
(6, 6, 4, 9, 1, 'Pasang Cctv 2 Titik', 'Survey dan sekalian pasang cctv', '2022-04-13', '2022-04-13', '2022-04-13', '2022-04-13', 5, 2, 0, NULL, 0, 0, 'https://i.ibb.co/KNXKjxC/IMG-20220413-170244-jpg.jpg', 'Single', 0, NULL, '2022-04-14 18:53:43', NULL, '2022-04-14 19:06:42'),
(7, 12, 4, 9, 1, 'Service Printer', 'Ganti chip cartridge Isi tinta di cartridge\r\nCleaning dan maintenance hardware', '2022-04-14', '2022-04-14', '2022-04-14', NULL, 2, 1, 0, NULL, 0, 0, NULL, 'Single', 0, NULL, '2022-04-14 19:30:56', NULL, '2022-04-14 21:58:05'),
(8, 13, 4, 9, 1, 'Cleaning Cpu Gio', 'Cleaning Hardware dan\r\npenyemprotan dengan contact cleaner. Pemb By Danang', '2022-04-14', '2022-04-14', '2022-04-14', '2022-04-14', 3, 1, 0, 'pengerjaan komp gio sudah selesai \r\npembayaran', 0, 0, '', 'Single', 0, NULL, '2022-04-14 19:33:16', NULL, '2022-04-14 22:01:09'),
(9, 14, 4, 9, 1, 'Install Aplikasi Format Factory', 'Install aplikasi format factory Done. Pemb By Danang', '2022-04-14', '2022-04-14', '2022-04-14', '2022-04-14', 3, 1, 0, 'Install aplikasi format factory Done. Pemb By Danang', 0, 0, '', 'Single', 0, NULL, '2022-04-14 19:35:04', NULL, '2022-04-14 22:02:12'),
(12, 7, 1, 22, 1, 'Pindah Server Web + SSL', 'Migrasi Server + Setup SSL', '2022-04-14', '2022-04-14', '2022-04-14', '2022-04-14', 5, 2, 0, NULL, 0, 0, NULL, 'Single', 0, NULL, '2022-04-14 21:47:18', NULL, '2022-04-14 21:48:58'),
(16, 15, 4, 9, 1, 'CHEK 4 LAPTOP SECOND', 'Kondisi laptop \r\n1. Compaq cq40 kondisi LCD pecah dan ndak mau tampil \r\n2. ASUS X453 kondisi ndak ada harddisk dan keyboard nggk mau dipencet\r\n3. Acer aspire one kondisi normal keyboard rusak \r\n4. Lenovo G40 kondisi mati total', '2022-04-15', '2022-04-15', '2022-04-15', NULL, 2, 2, 0, NULL, 0, 0, NULL, 'Single', 0, NULL, '2022-04-15 23:08:22', NULL, '2022-04-15 23:09:09'),
(17, 15, 4, 9, 1, 'CHEK 2 LAPTOP SECOND', 'Kondisi terakhir 2 laptop kondisi normal dan siap pakai\r\n1. Asus X200CA di ganti battre dan cleaning harddware + thermal paste\r\n2. Toshiba satelite C640 Di ganti battre dan cleaning harddware + thermal paste', '2022-04-15', '2022-04-15', '2022-04-15', '2022-04-15', 3, 2, 0, 'Harga batre asus x200ca 230.000\r\nHarga batre toshiba c640 200.000\r\n.\r\nDan untuk kondisi thermal paste ke duannya kering', 0, 0, '', 'Single', 0, NULL, '2022-04-15 23:15:12', NULL, '2022-04-15 23:25:59'),
(18, 16, 2, 1, 1, 'WEB TASK MANAGEMENT', 'Mengembangkan Website Untuk Manajemen Task Versi 1. Yang Meliputi Fitur ( Pengelolaan User, Pengelolaan Client, Pengelolaan kategori Client, Pengelolaan TIM, Pengelolaan Company Client,  dan Pengelolaan Task)', '2022-04-15', '2022-04-15', '2022-04-19', NULL, 2, 2, 0, NULL, 0, 0, NULL, 'Group', 0, NULL, '2022-04-15 23:36:33', NULL, '2022-04-15 23:38:43'),
(19, 10, 2, 1, 1, 'WEB COMPANY PROFILE HARMANY-INDONESIA.COM', 'Membuat Website Company Profile Dengan Framework Codeigniter 4', '2022-04-15', NULL, '2022-04-27', NULL, 1, 1, 0, NULL, 0, 0, NULL, 'Single', 0, NULL, '2022-04-15 23:53:48', NULL, '2022-04-15 23:53:48'),
(20, 15, 4, 9, 1, 'INSTALL WINDOWS DAN APLIKASI', 'Instal windows + aplikasi standart', '2022-04-16', '2022-04-16', '2022-04-16', NULL, 2, 2, 0, NULL, 0, 0, NULL, 'Single', 0, NULL, '2022-04-16 16:14:19', NULL, '2022-04-16 16:15:33'),
(21, 16, 2, 7, 1, 'Update Tampilan Website Project Manajemen', 'Menghilangkan Tulisan Task Di Dasboard, Menghilangkan Breadcrumb Di Lead Tim & Tim, Ubah Task Collection Result Jadi Result', '2022-04-16', '2022-04-16', '2022-04-16', NULL, 2, 1, 0, NULL, 0, 0, NULL, 'Sub1', 0, NULL, '2022-04-16 16:36:23', NULL, '2022-04-16 16:39:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `password` text NOT NULL,
  `is_member` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `status`, `password`, `is_member`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 1, '$2y$10$DbRjI4X1YT3q33BtuxVPTONj0BV9.CvJzWVnXrj8vobeKhBszX4ry', 0, '2022-03-23 01:03:48', '2022-04-10 00:47:58'),
(2, 'Manajemen', 'manajemen@gmail.com', 1, '$2y$10$cU/52EaBFYl70erPdnxeLOygmhmf7xDGM8rk5R2bmXhiKIBp3R6PW', 0, '2022-04-09 08:15:25', '2022-04-12 16:53:25'),
(7, 'Arya', 'arya@gmail.com', 1, '$2y$10$LnezRbv.Mljricq8Pd1/Bu8rx2Yknn/9zYShcnxlYgCX.0XyrpBUq', 0, '2022-04-09 08:25:36', '2022-04-10 00:58:03'),
(9, 'Danang Sepprian Mukhti', 'danang@gmail.com', 1, '$2y$10$PuxHceK43.zTB6hjTwqETOyHauuxDrR5x87yRhRCXd/KXYedDa2eC', 0, '2022-04-09 08:32:40', '2022-04-14 19:39:41'),
(16, 'Sulis', 'suli@stikom.co', 1, '$2y$10$mkHamXW0mpkXWf9FxzcCR.EJ9c58NTILxq7jdI/WRvTYEUxorp9m2', 0, '2022-04-10 01:01:00', '2022-04-13 16:26:28'),
(17, 'Bagus Priatmaja', 'bagus@gmail.com', 1, '$2y$10$DbRjI4X1YT3q33BtuxVPTONj0BV9.CvJzWVnXrj8vobeKhBszX4ry', 0, '2022-04-10 01:04:44', '2022-04-15 23:12:05'),
(19, 'Fairdy', 'fairdy@gmail.com', 1, '$2y$10$WXB4GlffsCqB.yOt.Ckl5.P2wPcB6vMVzIpIXRCLoRnmNy1hldu5i', 1, '2022-04-12 17:37:18', '2022-04-12 17:37:18'),
(20, 'Yayasan Senyum', 'senyum@gmail.com', 1, '$2y$10$lYwjr80EaS8h5rqQurVFme.lNgSYpc.TDZLw.Y5NtKNiOYHLqMHvy', 1, '2022-04-12 18:17:13', '2022-04-12 18:17:13'),
(21, 'Nia Cak mat', 'nia@gmail.com', 1, '$2y$10$JoStBmsPmrzxdfTOBzo5z.zaqiaGKSduwun7tU3YXMYovuVBEW0li', 1, '2022-04-12 18:39:27', '2022-04-12 18:39:27'),
(22, 'Tatit Sulistyo Prabowo', 'tatit.prabowo@gmail.com', 1, '$2y$10$BEqohq/lLQBunlRPF1xtTuT8t0D8529bk83u8XTddzIHU6TJcQZLy', 0, '2022-04-13 15:22:11', '2022-04-14 18:51:50'),
(23, 'Yunita Aryani', 'yunita@gmail.com', 1, '$2y$10$hQT/CW.RX72f.Yjx33lQAuk35PVvelNEsstS5BElYoF8ZySsNlHmW', 1, '2022-04-13 15:23:59', '2022-04-13 15:23:59'),
(24, 'Krisna Adi', 'krisnaadi@gmail.com', 1, '$2y$10$bFqq1OHJAFSQtne1/ZPKC.L.ZUnbiSvD5u2sPeIbarBbF4fgfb1GW', 0, '2022-04-13 18:01:46', '2022-04-13 18:04:57'),
(25, 'Arlan', 'arlan@gmail.com', 1, '$2y$10$BB5Ng6if0Z2eGuPt2AakCe1kt5nPmLzfB1NSQ5G.grgRs2Qr3cxhu', 0, '2022-04-13 18:27:58', '2022-04-13 20:24:03'),
(26, 'Adi Warsa', 'adiwarsa@gmail.com', 1, '$2y$10$x674ba9QdNrw1lROXBVjCOFb7JWGScJijYR5rrktGcDQcZ/FpsgXy', 0, '2022-04-13 19:20:00', '2022-04-13 23:50:14'),
(27, 'Guswah', 'guswah@gmail.com', 1, '$2y$10$DbRjI4X1YT3q33BtuxVPTONj0BV9.CvJzWVnXrj8vobeKhBszX4ry', 0, '2022-04-13 19:21:10', '2022-04-14 03:22:55'),
(28, 'Ngurah Dwi Putra', 'ngurah@gmail.com', 1, '$2y$10$xgMsV4LrNUwP7.GhWwqQEeiI5cFgXoFXiFZFv9KjLc5jep3eUtq/m', 1, '2022-04-13 22:04:55', '2022-04-13 22:04:55'),
(29, 'Teguh Otong', 'teguh@gmail.com', 1, '$2y$10$hEAnYLI2l9g4tiP03rxnweDy1I0Fo3beWl7YTIBP9D2L6XvrLFHY2', 1, '2022-04-13 22:20:49', '2022-04-13 22:20:49'),
(30, 'Berly', 'berly@gmail.com', 1, '$2y$10$owBQY/0I5E.pHgPMmV7JS.2YX8mvTRrPdpxZQs7EWMD94xAVH73Lq', 1, '2022-04-14 19:10:27', '2022-04-14 19:10:27'),
(31, 'Nigel Easton', 'nigel@gmail.com', 1, '$2y$10$W4nC.8ZbeXx2B47CqtP1UOhexFkbbjl4ORKW/Ytf9g9c8MRNVuBWy', 1, '2022-04-14 19:11:09', '2022-04-14 19:11:09'),
(32, 'Leo Darsana', 'leo@gmail.com', 1, '$2y$10$431vz276TVJ5PQ08Obde9u9OJ0i6kRN8JjrCDa.fxIpIQyRlDrlVa', 1, '2022-04-14 19:12:12', '2022-04-14 19:12:12'),
(33, 'PT. Global Digital Verse', 'globaldigitalverse1@gmail.com', 1, '$2y$10$nN3GZsbtqdFkwCLutSeS7.E2dgWZE.1azCsc6j8ni5y2TI2Cx9Sgu', 1, '2022-04-15 23:30:32', '2022-04-15 23:30:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `perusahaan_id` bigint(20) NOT NULL,
  `divisi_id` bigint(20) NOT NULL,
  `role` int(11) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nip` varchar(225) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `perusahaan_id`, `divisi_id`, `role`, `no_telp`, `alamat`, `nip`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '0885241312727', 'Jalan Rajawali No. 15', '11723613', 'https://i.ibb.co/JBPWwRP/logo-Copy-png.png', 1, NULL, '2022-04-14 00:41:57'),
(2, 2, 1, 1, 2, '0882341567', 'Jl. Pulau Ayu', '1928334', 'PngItem_19051106251409d24f9b1649492125.png', 1, '2022-04-09 08:15:25', '2022-04-10 00:45:49'),
(4, 7, 1, 2, 3, '08872233311', 'Jalan Nangka', '1928932', 'PngItem_1243434625142ffeb5fb1649492735.png', 1, '2022-04-09 08:25:36', '2022-04-09 08:25:36'),
(8, 16, 1, 3, 4, '90789867', 'ini alamat saya', '1223', 'wingcom(8)6251595c4f9c11649498460.png', 1, '2022-04-10 01:01:00', '2022-04-13 16:26:28'),
(9, 17, 1, 4, 4, '0888723123', 'Jalan rajawali No. 21', '0918218', 'icons8-juice-6462515a3c47fd31649498684.png', 1, '2022-04-10 01:04:44', '2022-04-13 16:30:23'),
(11, 9, 1, 4, 3, '081338896229', 'Jln Pulau Ayu No. 27 Denpasar Bali', '3510042009970001', 'https://i.ibb.co/hg3DZGB/yzr-m1-engine-jpg.jpg', 1, NULL, '2022-04-14 19:39:41'),
(12, 22, 1, 1, 1, '081317747171', 'Denpasar Bali', '001', 'https://i.ibb.co/L1kWZLg/Tatit-jpg.jpg', 1, '2022-04-13 15:22:11', '2022-04-14 18:51:50'),
(13, 24, 1, 2, 4, '089162361', 'Jl. Pulau Ayu no.20', '190030888', 'teamwork-gc5a4b7b88_192062563d1a857e01649818906.jpg', 1, '2022-04-13 18:01:46', '2022-04-13 18:01:46'),
(14, 25, 1, 2, 4, '089518213', 'jl.Padang Sambian no.1', '1900129312', 'startup-gbfc902ace_19206256433e9dfa21649820478.jpg', 1, '2022-04-13 18:27:58', '2022-04-13 18:56:10'),
(15, 26, 1, 2, 4, '0891263167', 'Jl.Pulau Moyo no.56', '189023012', '', 1, '2022-04-13 19:20:00', '2022-04-13 19:20:00'),
(16, 27, 1, 2, 4, NULL, NULL, NULL, '', 1, '2022-04-13 19:21:10', '2022-04-14 18:29:38');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category_clients`
--
ALTER TABLE `category_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `companyclients`
--
ALTER TABLE `companyclients`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pics`
--
ALTER TABLE `pics`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category_clients`
--
ALTER TABLE `category_clients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `companyclients`
--
ALTER TABLE `companyclients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pics`
--
ALTER TABLE `pics`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
