-- ==========================================================
-- PT. NIFARA COAL TRADING
-- Production Database Schema for MySQL 8.x / MariaDB
-- Optimized for cPanel Rumahweb
-- ==========================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------
-- Table structure for `articles`
-- ----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Berita',
  `excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'PT. Nifara Coal Trading',
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`slug`),
  KEY `idx_category` (`category`),
  KEY `idx_status_created` (`status`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------
-- Table structure for `admins`
-- ----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------
-- Initial Seed Data: Default Admin Account
-- Catatan: Kredensial default wajib segera diperbarui setelah instalasi.
-- ----------------------------------------------------------
INSERT INTO `admins` (`id`, `username`, `password_hash`, `full_name`, `email`, `created_at`) 
VALUES (1, 'admin', '$2y$10$w81.m8qKq/rDk2O5yK0xU.k1Lq9q9gT1Z9p9U7xU0Z1Z9p9U7xU0Z', 'Administrator Nifara Coal', 'nifaracoaltrading@gmail.com', NOW())
ON DUPLICATE KEY UPDATE `id`=`id`;

-- ----------------------------------------------------------
-- Initial Seed Data: Corporate Articles & CSR
-- ----------------------------------------------------------
INSERT INTO `articles` (`title`, `slug`, `category`, `excerpt`, `content`, `image`, `author`, `status`, `created_at`) VALUES
('Program CSR: Komitmen Pemberdayaan Masyarakat Sentra Pertambangan Sumatera Barat', 'program-csr-pemberdayaan-masyarakat-sumatera-barat', 'CSR', 'PT. Nifara Coal Trading menyalurkan program pemberdayaan ekonomi masyarakat dan beasiswa pendidikan bagi talenta lokal di Payakumbuh.', '<p>Sebagai bagian dari komitmen keberlanjutan dan kepedulian sosial korporat, PT. Nifara Coal Trading meluncurkan inisiatif CSR terpadu yang berfokus pada peningkatan taraf hidup masyarakat di sekitar sentra logistik dan operasional.</p><p>Program ini mencakup pelatihan keterampilan wirausaha lokal, perbaikan infrastruktur jalan desa, dan penyediaan fasilitas air bersih guna menciptakan dampak ekonomi positif yang berkelanjutan.</p>', 'assets/images/port.jpg', 'Tim Humas & CSR', 'published', '2026-11-10 09:30:00'),
('PT. Nifara Coal Trading Perkuat Efisiensi Rantai Pasok Maritim Lintas Sumatera', 'efisiensi-rantai-pasok-maritim-lintas-sumatera', 'Operasional', 'Optimalisasi siklus muat tongkang dan sistem koordinasi dermaga berhasil memangkas cycle time pengapalan hingga 20%.', '<p>Melalui implementasi sistem koordinasi terintegrasi antara pit tambang, hauling jalan darat, hingga dermaga jetty, perseroan berhasil meningkatkan efisiensi waktu muat tongkang 300 feet secara signifikan.</p><p>Langkah ini memastikan setiap pengiriman kargo batubara kepada klien industri dan pembangkit listrik selalu tiba tepat waktu sesuai jadwal kontrak jual-beli.</p>', 'assets/images/barge.jpg', 'Divisi Operasional & Logistik', 'published', '2026-10-28 14:15:00'),
('Penerapan Standar Transparansi B2B Berbasis Risk-Based OSS dalam Industri Komoditas', 'penerapan-standar-transparansi-b2b-risk-based-oss', 'Regulasi & Kepatuhan', 'Perseroan menegaskan kepatuhan menyeluruh terhadap regulasi Minerba dan pelaporan terpadu guna membangun ekosistem trading yang aman bagi mitra.', '<p>Transparansi perizinan merupakan fondasi terpenting dalam transaksi komoditas bernilai tinggi. PT. Nifara Coal Trading memastikan seluruh perizinan, mulai dari KBLI 46710, NIB OSS-RBA, hingga konfirmasi SK Menkumham, dapat diverifikasi secara terbuka oleh tim procurement mitra usaha.</p>', 'assets/images/dermaga.jpg', 'Corporate Legal', 'published', '2026-09-15 11:00:00');

SET FOREIGN_KEY_CHECKS = 1;
