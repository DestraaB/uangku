-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2026 at 10:18 AM
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
-- Database: `uangku`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_kategori` int(11) UNSIGNED NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Primer'),
(2, 'Sekunder'),
(3, 'Tersier');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id_expense` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `id_kategori` int(11) UNSIGNED NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto_struk` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id_expense`, `id_user`, `id_kategori`, `nominal`, `deskripsi`, `foto_struk`, `tanggal`, `created_at`) VALUES
(1, 1, 1, 10000, 'makan siang', '693ad62a412375ff83fa29fff3efbe68.png', '2026-09-21', '2026-09-21 15:51:47'),
(2, 1, 2, 5000, 'beli batagor', '0c9885133341912820da1e37878d8ab0.png', '2026-09-21', '2026-09-21 15:58:28'),
(4, 1, 3, 60000, 'beli spotify premium', 'c9a01691b1f78241456cce5c4d3256fb.png', '2026-09-23', '2026-09-23 14:33:12'),
(5, 1, 2, 10000, 'beli cimol', '1fde9a149e90f8cc15e900a4df086516.png', '2026-09-23', '2026-09-23 14:43:43'),
(6, 1, 2, 44000, 'beli rokok sama jajan', '16eab9539d7dbae45f3a5e611d111486.png', '2026-09-23', '2026-09-23 14:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `reset_token`, `created_at`, `updated_at`) VALUES
(1, 'destra', 'destrajaya11@gmail.com', '$2y$10$I2egZe4Y0gdcj25GivcI0O2cb4RpVobdGV4SNT0W69avYK/m7BF4u', '3c739c323fc027f2df70dac4922aef03b75b6fa33eeb73fe0a019a1f6f3c36da', '2026-09-21 15:27:02', '2026-09-22 08:30:33'),
(2, 'wijaya', 'destra@gmail.com', '$2y$10$kw9WINtIk.SKzuRXLQeAGO5zn2Qbay12xP4ft9OHcTzIDsRtgJGZC', NULL, '2026-09-21 15:53:33', '2026-09-21 15:53:33'),
(3, 'bintangg', 'bintangwjaya@gmail.com', '$2y$10$Q6z4sBR0DxGRJbzQgw4/Je2/ECVxqJpexPJ8kSzzw.pTIZBUaejzm', NULL, '2026-09-22 08:46:08', '2026-09-22 08:49:05'),
(4, 'wijaya', 'destra1@gmail.com', '$2y$10$1CUU2vkqCjLY9z2.aN6CKe.1kR0CjMwrUqdYTrdwdxbE3VaOdxoZK', NULL, '2026-09-22 13:30:13', '2026-09-22 13:30:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id_expense`),
  ADD KEY `fk_expense_user` (`id_user`),
  ADD KEY `fk_expense_kategori` (`id_kategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_kategori` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id_expense` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `fk_expense_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `categories` (`id_kategori`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_expense_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
