<?php
/**
 * PT. Nifara Coal Trading
 * Database Configuration & Connection Handler
 * Compatible with cPanel MySQL (Rumahweb) & Local SQLite
 */

// Production cPanel MySQL Configuration
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'nifara_coal_db');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_CHARSET', 'utf8mb4');

/**
 * Get Database Connection instance (PDO)
 * Automatically falls back to SQLite if MySQL is not available.
 *
 * @return PDO
 */
function getDB() {
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $sqlitePath = dirname(__DIR__) . '/data/database.sqlite';

    // 1. Try MySQL Connection if configured
    if (!empty(DB_NAME) && DB_NAME !== 'sqlite') {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
            return $pdo;
        } catch (PDOException $e) {
            // Log or fallback to SQLite for zero-config portability
        }
    }

    // 2. Portable Fallback: SQLite
    if (!is_dir(dirname($sqlitePath))) {
        mkdir(dirname($sqlitePath), 0755, true);
    }

    $dsn = "sqlite:" . $sqlitePath;
    $pdo = new PDO($dsn, null, null, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Ensure schema exists on SQLite
    initDatabaseSchema($pdo, 'sqlite');
    return $pdo;
}

/**
 * Initialize database tables if not already created
 */
function initDatabaseSchema(PDO $db, string $driver = 'mysql') {
    if ($driver === 'sqlite') {
        $db->exec("
            CREATE TABLE IF NOT EXISTS articles (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT NOT NULL,
                slug TEXT NOT NULL UNIQUE,
                category TEXT NOT NULL,
                excerpt TEXT NOT NULL,
                content TEXT NOT NULL,
                image TEXT,
                author TEXT DEFAULT 'PT. Nifara Coal Trading',
                status TEXT DEFAULT 'published',
                views INTEGER DEFAULT 0,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS admins (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL UNIQUE,
                password_hash TEXT NOT NULL,
                full_name TEXT NOT NULL,
                email TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );
        ");

        // Seed default admin if empty
        $stmt = $db->query("SELECT COUNT(*) as count FROM admins");
        if ($stmt->fetch()['count'] == 0) {
            $defaultPass = password_hash('NifaraAdmin2026!', PASSWORD_BCRYPT);
            $stmt = $db->prepare("INSERT INTO admins (username, password_hash, full_name, email) VALUES (?, ?, ?, ?)");
            $stmt->execute(['admin', $defaultPass, 'Administrator Nifara Coal', 'nifaracoaltrading@gmail.com']);
        }

        // Seed initial articles if empty
        $stmt = $db->query("SELECT COUNT(*) as count FROM articles");
        if ($stmt->fetch()['count'] == 0) {
            $seedArticles = [
                [
                    'title' => 'Program CSR: Komitmen Pemberdayaan Masyarakat Sentra Pertambangan Sumatera Barat',
                    'slug' => 'program-csr-pemberdayaan-masyarakat-sumatera-barat',
                    'category' => 'CSR',
                    'excerpt' => 'PT. Nifara Coal Trading menyalurkan program pemberdayaan ekonomi masyarakat dan beasiswa pendidikan bagi talenta lokal di Payakumbuh.',
                    'content' => '<p>Sebagai bagian dari komitmen keberlanjutan dan kepedulian sosial korporat, PT. Nifara Coal Trading meluncurkan inisiatif CSR terpadu yang berfokus pada peningkatan taraf hidup masyarakat di sekitar sentra logistik dan operasional.</p><p>Program ini mencakup pelatihan keterampilan wirausaha lokal, perbaikan infrastruktur jalan desa, dan penyediaan fasilitas air bersih guna menciptakan dampak ekonomi positif yang berkelanjutan.</p>',
                    'image' => 'assets/images/port.jpg',
                    'author' => 'Tim Humas & CSR',
                    'created_at' => '2026-11-10 09:30:00'
                ],
                [
                    'title' => 'PT. Nifara Coal Trading Perkuat Efisiensi Rantai Pasok Maritim Lintas Sumatera',
                    'slug' => 'efisiensi-rantai-pasok-maritim-lintas-sumatera',
                    'category' => 'Operasional',
                    'excerpt' => 'Optimalisasi siklus muat tongkang dan sistem koordinasi dermaga berhasil memangkas cycle time pengapalan hingga 20%.',
                    'content' => '<p>Melalui implementasi sistem koordinasi terintegrasi antara pit tambang, hauling jalan darat, hingga dermaga jetty, perseroan berhasil meningkatkan efisiensi waktu muat tongkang 300 feet secara signifikan.</p><p>Langkah ini memastikan setiap pengiriman kargo batubara kepada klien industri dan pembangkit listrik selalu tiba tepat waktu sesuai jadwal kontrak jual-beli.</p>',
                    'image' => 'assets/images/barge.jpg',
                    'author' => 'Divisi Operasional & Logistik',
                    'created_at' => '2026-10-28 14:15:00'
                ],
                [
                    'title' => 'Penerapan Standar Transparansi B2B Berbasis Risk-Based OSS dalam Industri Komoditas',
                    'slug' => 'penerapan-standar-transparansi-b2b-risk-based-oss',
                    'category' => 'Regulasi & Kepatuhan',
                    'excerpt' => 'Perseroan menegaskan kepatuhan menyeluruh terhadap regulasi Minerba dan pelaporan terpadu guna membangun ekosistem trading yang aman bagi mitra.',
                    'content' => '<p>Transparansi perizinan merupakan fondasi terpenting dalam transaksi komoditas bernilai tinggi. PT. Nifara Coal Trading memastikan seluruh perizinan, mulai dari KBLI 46710, NIB OSS-RBA, hingga konfirmasi SK Menkumham, dapat diverifikasi secara terbuka oleh tim procurement mitra usaha.</p>',
                    'image' => 'assets/images/dermaga.jpg',
                    'author' => 'Corporate Legal',
                    'created_at' => '2026-09-15 11:00:00'
                ]
            ];

            $insert = $db->prepare("INSERT INTO articles (title, slug, category, excerpt, content, image, author, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            foreach ($seedArticles as $a) {
                $insert->execute([$a['title'], $a['slug'], $a['category'], $a['excerpt'], $a['content'], $a['image'], $a['author'], $a['created_at']]);
            }
        }
    }
}
