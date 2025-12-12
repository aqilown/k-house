-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2025 at 06:42 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `kamar_id` int NOT NULL,
  `tanggal_checkin` date NOT NULL,
  `tanggal_checkout` date NOT NULL,
  `durasi_bulan` int NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status` enum('pending','aktif','selesai','dibatalkan') DEFAULT 'pending',
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `catatan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int NOT NULL,
  `kost_id` int NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foto_kost`
--

CREATE TABLE `foto_kost` (
  `id` int NOT NULL,
  `kost_id` int NOT NULL,
  `foto` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id` int NOT NULL,
  `kost_id` int NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `harga_bulanan` decimal(10,2) NOT NULL,
  `ukuran` varchar(50) DEFAULT NULL,
  `jumlah_tersedia` int DEFAULT '0',
  `deskripsi` text,
  `foto_kamar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `kost_id`, `tipe_kamar`, `harga_bulanan`, `ukuran`, `jumlah_tersedia`, `deskripsi`, `foto_kamar`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kamar Tipe 1', '1300000.00', '5x5', 2, 'Kamar mandi dalam + AC', 'uploads/kamar/1765247596_Screenshot 2025-10-09 220849.png', '2025-12-08 19:33:16', '2025-12-08 19:33:16'),
(2, 3, 'Kamar Tipe 1', '800000.00', '3x4', 1, NULL, 'uploads/kamar/1765268776_srigading(1).jpeg', '2025-12-09 01:26:16', '2025-12-09 01:26:16'),
(3, 2, 'Kamar Tipe 1', '850000.00', '4x4', 1, NULL, 'uploads/kamar/1765268832_langiteduh1.jpeg', '2025-12-09 01:27:12', '2025-12-09 01:27:12'),
(4, 4, 'Kamar Tipe 1', '900000.00', '5x5', 3, 'kamar mandi dalam', 'uploads/kamar/1765268970_joyogrand.jpeg', '2025-12-09 01:29:30', '2025-12-09 01:29:30'),
(5, 5, 'Kamar Tipe 1', '1500000.00', '3x4', 3, 'Kamar Mandi Dalam', 'uploads/kamar/1765428568_Screenshot 2025-12-11 113904.png', '2025-12-10 21:49:28', '2025-12-10 21:49:49');

-- --------------------------------------------------------

--
-- Table structure for table `kost`
--

CREATE TABLE `kost` (
  `id` int NOT NULL,
  `nama_kost` varchar(255) NOT NULL,
  `kategori` enum('putra','putri','campur') NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `peraturan` text,
  `foto_utama` varchar(255) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT '0.0',
  `jumlah_review` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kost`
--

INSERT INTO `kost` (`id`, `nama_kost`, `kategori`, `alamat`, `kota`, `kecamatan`, `deskripsi`, `peraturan`, `foto_utama`, `rating`, `jumlah_review`, `created_at`, `updated_at`) VALUES
(1, 'GRHA Cemara', 'putra', 'Jl. Bunga Kumis Kucing No.39-45, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141', 'Malang', 'Lowokwaru', 'Kost putra nyaman', 'tidak boleh bawa perempuan', 'uploads/kost/1765247519_Screenshot 2025-10-09 213434.png', '5.0', 1, '2025-12-08 19:31:59', '2025-12-10 21:19:24'),
(2, 'Langiteduh Premium Kost', 'putra', 'Jl. Papa Biru 3 No.8, Tulusrejo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141', 'Malang', 'Lowokwaru', NULL, NULL, 'uploads/kost/1765268717_Screenshot 2025-12-09 152301.png', '0.0', 0, '2025-12-09 01:20:03', '2025-12-09 01:25:17'),
(3, 'Kost Putra Srigading', 'putra', 'Jl. Ters. Srigading No.26, Lowokwaru, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141', 'Malang', 'Lowokwaru', 'Kost Putra di Malang', '-', 'uploads/kost/1765268537_Screenshot 2025-12-09 152126.png', '0.0', 0, '2025-12-09 01:22:17', '2025-12-09 01:22:17'),
(4, 'Joyo Grand Kost', 'putra', 'Merjosari, Kec. Lowokwaru, Kota Malang, Jawa Timur 65144', 'Malang', 'Lowokwaru', 'Kost nyaman untuk putra di Malang', '-', 'uploads/kost/1765268910_langiteduh.jpeg', '0.0', 0, '2025-12-09 01:28:30', '2025-12-09 01:28:30'),
(5, 'Kost Singgahsini Kertajaya Utimami', 'putri', 'PQ94+X27, Gubeng Kertajaya VI C, Kertajaya, Kec. Gubeng, Surabaya, Jawa Timur 60282', 'Surabaya', 'Gubeng', 'Kost Putri nyaman', NULL, 'uploads/kost/1765428507_Screenshot 2025-12-11 113849.png', '0.0', 0, '2025-12-10 21:48:27', '2025-12-10 21:48:27'),
(6, 'Kopstud Sigura', 'campur', 'Jl. Sigura - Gura No.33, Karangbesuki, Kec. Sukun, Kota Malang, Jawa Timur 65149', 'Malang', 'Sigura gura', NULL, NULL, 'uploads/kost/1765434099_image_2025-12-11_132135910.png', '0.0', 0, '2025-12-10 23:21:39', '2025-12-10 23:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int NOT NULL,
  `kost_id` int NOT NULL,
  `user_id` int NOT NULL,
  `booking_id` int DEFAULT NULL,
  `rating` int NOT NULL,
  `komentar` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `kost_id`, `user_id`, `booking_id`, `rating`, `komentar`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 5, 'Kost ternyaman dan ter worth it!', '2025-12-09 01:31:40', '2025-12-09 01:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT 'default-avatar.png',
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `no_telepon`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `pekerjaan`, `foto_profil`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin K.House', 'admin@gmail.com', '$2y$12$SKuVdxQR3fMehFxTmG78Dem2Bp26nWIr/JZPCLbnDx8oOLY3d9CH.', NULL, NULL, NULL, NULL, NULL, 'default-avatar.png', 'admin', '2025-12-09 02:15:48', '2025-12-09 01:17:01'),
(2, 'Muhamad Aqilla Umara Yusuf', 'aqil@gmail.com', '$2y$12$E95C.xzPqVva9u2e9B8GnOADQBDXIwzLJe2U.tUAZKaKmvSHIKIPu', '08123456789', '2000-01-01', NULL, 'Laki-laki', 'CEO Google', 'uploads/profiles/profile_2_1765427784.jpg', 'user', '2025-12-09 01:09:46', '2025-12-10 21:36:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kamar_id` (`kamar_id`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kost_id` (`kost_id`);

--
-- Indexes for table `foto_kost`
--
ALTER TABLE `foto_kost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kost_id` (`kost_id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kost_id` (`kost_id`);

--
-- Indexes for table `kost`
--
ALTER TABLE `kost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kost_id` (`kost_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `booking_id` (`booking_id`);

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
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto_kost`
--
ALTER TABLE `foto_kost`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kost`
--
ALTER TABLE `kost`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`kamar_id`) REFERENCES `kamar` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD CONSTRAINT `fasilitas_ibfk_1` FOREIGN KEY (`kost_id`) REFERENCES `kost` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `foto_kost`
--
ALTER TABLE `foto_kost`
  ADD CONSTRAINT `foto_kost_ibfk_1` FOREIGN KEY (`kost_id`) REFERENCES `kost` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`kost_id`) REFERENCES `kost` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`kost_id`) REFERENCES `kost` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
