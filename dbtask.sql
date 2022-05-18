-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Apr 2022 pada 04.20
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtask`
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
(1, 'Peternakan', 1, NULL, NULL),
(2, 'Buah-Buahan', 1, NULL, NULL),
(3, 'Papapapaapapa', 1, '2022-04-04 13:13:44', '2022-04-04 13:13:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) NOT NULL,
  `perusahaan_id` bigint(20) NOT NULL,
  `kategori_client_id` bigint(20) NOT NULL,
  `nama_company` varchar(225) NOT NULL,
  `nama_client` varchar(225) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `logo` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `clients`
--

INSERT INTO `clients` (`id`, `perusahaan_id`, `kategori_client_id`, `nama_company`, `nama_client`, `no_telp`, `alamat`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 'GDV', 'Buahvita', '08827363', 'dhaydacadwq', 'img-client/lWGyscJpjWnnmvO8TttjUSldvtjMxO7xBVjzi3ly.jpg', 1, NULL, '2022-04-04 13:07:49'),
(4, 1, 1, 'GDV', 'Gogo', '092837324', 'sfdddsgg', 'img-client/EFniS4letWtu8d0k23K549ZKUaH2UmXm43KB1lNJ.jpg', 1, NULL, '2022-04-04 13:07:02');

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
(1, 'GDV', 1, NULL, NULL);

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
(1, 'Software', 1, NULL, NULL);

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

--
-- Dumping data untuk tabel `notes`
--

INSERT INTO `notes` (`id`, `project_id`, `user_id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'asdasdasdas', '2022-04-04 01:46:45', '2022-04-04 01:46:45'),
(2, 14, 7, 'dalsalsdkaksa;s\'as', '2022-04-04 16:07:21', '2022-04-04 16:07:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pics`
--

CREATE TABLE `pics` (
  `id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pics`
--

INSERT INTO `pics` (`id`, `project_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, NULL, NULL),
(2, 2, 7, 1, NULL, '2022-04-05 01:13:45'),
(5, 5, 7, 1, '2022-04-04 01:41:49', '2022-04-04 01:41:49'),
(6, 6, 6, 1, '2022-04-04 01:43:47', '2022-04-04 01:43:47'),
(7, 7, 2, 1, '2022-04-04 01:45:27', '2022-04-04 01:45:27'),
(8, 8, 2, 1, '2022-04-04 01:51:47', '2022-04-04 01:54:49'),
(9, 9, 6, 1, '2022-04-04 01:52:58', '2022-04-04 01:54:34'),
(10, 10, 7, 1, '2022-04-04 01:53:18', '2022-04-04 02:02:44'),
(11, 11, 6, 1, '2022-04-04 01:53:44', '2022-04-04 01:53:44'),
(12, 12, 6, 1, '2022-04-04 01:56:35', '2022-04-04 01:56:35'),
(13, 13, 5, 1, '2022-04-04 02:02:30', '2022-04-04 02:02:30'),
(14, 14, 7, 1, '2022-04-04 02:03:05', '2022-04-04 02:03:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `divisi_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `perusahaan_id` bigint(20) NOT NULL,
  `judul_project` varchar(225) NOT NULL,
  `detail_project` longtext NOT NULL,
  `tgl_input` date NOT NULL,
  `tgl_mulai` date NOT NULL,
  `estimasi` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `prioritas` int(11) NOT NULL,
  `total_revisi` int(11) NOT NULL,
  `laporan_project` longtext DEFAULT NULL,
  `debet` double NOT NULL,
  `kredit` double NOT NULL,
  `foto_hasil` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `projects`
--

INSERT INTO `projects` (`id`, `client_id`, `divisi_id`, `user_id`, `perusahaan_id`, `judul_project`, `detail_project`, `tgl_input`, `tgl_mulai`, `estimasi`, `tgl_selesai`, `status`, `prioritas`, `total_revisi`, `laporan_project`, `debet`, `kredit`, `foto_hasil`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 5, 1, 'Pembuatan Task Management', '1. Pembuatan Desain\r\n2. Pembuatan Fitur', '2022-04-02', '2022-04-02', '2022-04-05', '2022-04-05', 5, 1, 3, 'dsassasdadaas', 0, 0, 'adajdha.jpeg', NULL, '2022-04-04 01:50:33'),
(2, 4, 1, 7, 1, 'AJDHhd', 'FSAFSAFFSDCX', '2022-04-04', '2022-04-04', NULL, NULL, 2, 1, 0, NULL, 22112, 2111, 'SADFAF', NULL, '2022-04-05 01:13:45'),
(6, 3, 1, 6, 1, 'asdsasad', 'dfssrwefsegsgd', '2022-04-04', '2022-04-04', '2022-04-06', NULL, 7, 1, 0, NULL, 0, 0, NULL, '2022-04-04 01:43:47', '2022-04-04 01:46:19'),
(8, 4, 1, 2, 1, 'jsajkdalkdakalsd', 'laslaas;sdoedkm', '2022-04-04', '2022-04-05', '2022-04-09', NULL, 4, 1, 0, NULL, 0, 0, NULL, '2022-04-04 01:51:47', '2022-04-04 01:54:49'),
(9, 3, 1, 6, 1, 'sdasasas', 'dassdaaas', '2022-04-04', '2022-04-04', '2022-04-05', NULL, 2, 1, 0, NULL, 0, 0, 'WhatsAppImage2022-03-27at162317jpeg624ab46a10b321649063018.jpeg', '2022-04-04 01:52:58', '2022-04-04 09:03:38'),
(10, 4, 1, 7, 1, 'asdasasas', 'sdaassdsasasa', '2022-04-04', '2022-04-06', '2022-04-10', NULL, 4, 1, 0, NULL, 0, 0, NULL, '2022-04-04 01:53:18', '2022-04-04 02:02:44'),
(12, 3, 1, 6, 1, 'asdasasa', 'sdasasdsd', '2022-04-04', '2022-04-04', '2022-04-08', NULL, 6, 1, 0, NULL, 0, 0, NULL, '2022-04-04 01:56:35', '2022-04-04 02:03:42'),
(13, 4, 1, 5, 1, 'adsasassa', 'sasasassa', '2022-04-04', '2022-04-04', '2022-04-08', NULL, 3, 1, 0, NULL, 0, 0, NULL, '2022-04-04 02:02:30', '2022-04-04 02:02:30'),
(14, 3, 1, 7, 1, 'adaas', 'dasdad', '2022-04-04', '2022-04-03', '2022-04-05', NULL, 1, 1, 0, NULL, 0, 0, NULL, '2022-04-04 02:03:04', '2022-04-04 02:03:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `role`, `status`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Lisa Step', 'lisaa@gmail.com', 1, 1, '$2y$10$mhSJ6YZSIDq2b398lioisuLVREc6H9qpXZwAWuqKfmohk/veaccuC', '2022-03-23 01:03:48', '2022-04-04 12:27:22'),
(2, 'Andi Law Randi', 'Andiraa@gmail.com', 3, 1, '$2y$10$r2J3TqHnvEMj4TJI9Lpfruk60nEbGqfb0pYSPZeXzUKeW5CJKF2Dq', '2022-03-23 00:43:10', '2022-03-23 00:43:10'),
(5, 'Miguel Ten Five', 'minggy@gmail.com', 4, 1, '$2y$10$cA4l58vFKdlBJeQ/iaUL7Oue6zcKL8whbEgWnT1xg68fHkTD9BPOW', '2022-03-25 19:12:36', '2022-03-25 19:13:51'),
(6, 'Mickael Susanteo', 'micci@gmail.com', 2, 1, '$2y$10$J/FjnxkoJYRDi8Eg9NAE9eaqL5sw1BKoLR0iRLCVU0fYDAbsMdTxe', '2022-03-25 19:38:55', '2022-03-25 19:38:55'),
(7, 'Nathanel Mc', 'nael@gmail.com', 4, 1, '$2y$10$r2J3TqHnvEMj4TJI9Lpfruk60nEbGqfb0pYSPZeXzUKeW5CJKF2Dq', '2022-04-01 18:23:45', '2022-04-01 18:23:45');

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
  `no_telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `nip` varchar(225) NOT NULL,
  `foto` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `perusahaan_id`, `divisi_id`, `role`, `no_telp`, `alamat`, `nip`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 1, 1, '0885241312727', 'Jalan Rajawali No. 15', '11723613', 'users/mvPR9oFz9YWpuhrIyCH3LXbTyDHxDJ53uDw9JXTm.jpg', 1, NULL, '2022-04-04 12:31:03'),
(7, 2, 1, 1, 3, '088365272', 'Jalan Pulau Seribu, No. 52 Gang Merak', '1927345', 'jajhssd.jpeg', 1, NULL, NULL),
(10, 5, 1, 1, 4, '08887644', 'Br. KSjjadsaks', '198273613', 'users/v1AUKYfuOxPK67h5oxWJq1oNlA3XQyOBpEpRZDLA.jpg', 1, NULL, '2022-04-05 01:38:24'),
(11, 6, 1, 1, 2, '092872421', 'askdjasmnc', '19273720', 'users/ooOPSdUFyOzqJYqA28HenUj4hkBQTvd3xWmUF86F.jpg', 1, NULL, '2022-04-04 12:39:50'),
(12, 7, 1, 1, 4, '02373', 'wfeweff', '1029932813', 'sdasda.jpeg', 1, NULL, NULL);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pics`
--
ALTER TABLE `pics`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
