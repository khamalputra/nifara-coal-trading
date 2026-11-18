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
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_en` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- Catatan: Akun Administrator dibuat melalui inisialisasi awal CMS
-- atau via environment variable ADMIN_USER & ADMIN_PASS.
-- ----------------------------------------------------------

-- ----------------------------------------------------------
-- Initial Seed Data: Corporate Articles & CSR
-- ----------------------------------------------------------
INSERT INTO `articles` (`title`, `slug`, `category`, `excerpt`, `content`, `image`, `author`, `status`, `created_at`) VALUES
('Program CSR: Pelatihan Wirausaha Pemuda dan Dukungan Pendidikan Payakumbuh', 'program-csr-pemberdayaan-masyarakat-sumatera-barat', 'CSR', 'PT Nifara Coal Trading menggelar pelatihan kewirausahaan mandiri dan bantuan pendidikan bagi pemuda di kawasan Payakumbuh.', '<p>Sebagai wujud kepedulian sosial di wilayah kantor pusat, PT Nifara Coal Trading menggulirkan program CSR terarah untuk memperkuat perekonomian masyarakat Payakumbuh.</p><p>Fokus program meliputi lokakarya keterampilan usaha mikro, bantuan sarana belajar bagi pelajar berprestasi, serta perbaikan fasilitas umum desa. Manajemen berharap langkah ini mendorong kemandirian warga di sekitar sentra operasional perusahaan.</p>', 'assets/images/port.jpg', 'Tim Humas & CSR', 'published', '2026-11-10 09:30:00'),
('Efisiensi Distribusi Maritim: Waktu Sandar Tongkang Dipangkas 20%', 'efisiensi-rantai-pasok-maritim-lintas-sumatera', 'Operasional', 'Penyelarasan jadwal truk hauling dari tambang menuju dermaga muat mempercepat perputaran tongkang 300 kaki di perairan Sumatera.', '<p>Kelancaran distribusi batubara bertumpu pada disiplin jadwal antara mulut tambang, armada hauling darat, dan kesiapan tongkang di dermaga jetty. Melalui koordinasi operasional yang lebih ketat, PT Nifara Coal Trading menekan waktu tunggu kapal hingga 20% sepanjang kuartal terakhir.</p><p>Percepatan ini menjamin kargo batubara bagi pabrik semen, tekstil, dan pembangkit listrik selalu tiba tepat waktu sesuai toleransi jadwal kontrak.</p>', 'assets/images/barge.jpg', 'Divisi Operasional & Logistik', 'published', '2026-10-28 14:15:00'),
('Keterbukaan Legalitas Jadi Kunci Keamanan Pengadaan Batubara B2B', 'penerapan-standar-transparansi-b2b-risk-based-oss', 'Regulasi & Kepatuhan', 'PT Nifara Coal Trading membuka akses verifikasi NIB OSS-RBA dan SK Kemenkumham guna menjamin keamanan hukum pembeli industri.', '<p>Dalam transaksi komoditas bernilai tinggi, keabsahan perizinan adalah instrumen perlindungan utama bagi tim pengadaan (procurement). PT Nifara Coal Trading memfasilitasi keterbukaan seluruh izin usaha, mulai dari KBLI 46710, legalitas NIB 3108260031993, hingga SK Pengesahan Badan Hukum Kemenkumham RI.</p><p>Akses verifikasi ini memudahkan divisi audit pembeli menuntaskan proses due diligence secara cepat dan terukur.</p>', 'assets/images/dermaga.jpg', 'Corporate Legal', 'published', '2026-09-15 11:00:00');

SET FOREIGN_KEY_CHECKS = 1;
