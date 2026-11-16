<?php
/**
 * 404 Error Page
 * PT. Nifara Coal Trading
 */

header("HTTP/1.0 404 Not Found");
$basePath = isset($basePath) ? $basePath : '.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Halaman Tidak Ditemukan | PT. Nifara Coal Trading</title>
  <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/images/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $basePath ?>/assets/css/style.css">
  <style>
    .error-wrapper {
      min-height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 120px 20px 60px;
    }
    .error-card {
      max-width: 660px;
      padding: clamp(32px, 5vw, 60px);
      background: rgba(10, 37, 60, 0.7);
      border: 1px solid var(--navy-border);
      border-radius: var(--radius-lg);
      backdrop-filter: blur(16px);
      box-shadow: 0 10px 40px rgba(0,0,0,0.6);
    }
    .error-code {
      font-size: clamp(4rem, 10vw, 6.5rem);
      font-weight: 800;
      line-height: 1;
      margin-bottom: 16px;
      color: var(--gold-primary);
    }
    .error-title {
      font-size: clamp(1.4rem, 3vw, 2rem);
      margin-bottom: 16px;
      color: #fff;
    }
    .error-text {
      color: var(--text-muted);
      font-size: 1.05rem;
      margin-bottom: 32px;
      line-height: 1.7;
    }
    .error-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      justify-content: center;
    }
  </style>
</head>
<body>

  <div class="bg-ambient" aria-hidden="true"></div>

  <div class="site-wrap">
    <header class="site-header scrolled">
      <div class="container header-inner">
        <a href="<?= $basePath ?>/index.php" class="brand-logo" aria-label="Beranda Nifara Coal Trading">
          <img src="<?= $basePath ?>/assets/images/logo.png" alt="PT. Nifara Coal Trading" width="180" height="44">
        </a>
        <div class="header-actions">
          <a href="<?= $basePath ?>/index.php" class="btn btn-outline btn-sm">Kembali ke Beranda</a>
        </div>
      </div>
    </header>

    <main class="error-wrapper">
      <div class="container">
        <div class="error-card">
          <div class="error-code">404</div>
          <h1 class="error-title">Halaman Tidak Ditemukan</h1>
          <p class="error-text">
            Tautan yang Anda tuju mungkin telah berpindah, diubah, atau tidak lagi tersedia. Silakan kembali ke beranda utama atau akses tautan layanan di bawah ini.
          </p>
          <div class="error-actions">
            <a href="<?= $basePath ?>/index.php" class="btn btn-primary">Menuju Beranda</a>
            <a href="<?= $basePath ?>/berita/index.php" class="btn btn-outline">Publikasi & CSR</a>
            <a href="<?= $basePath ?>/index.php#rfq" class="btn btn-outline">Minta Penawaran</a>
            <a href="https://wa.me/6281280093234" class="btn btn-outline" target="_blank" rel="noopener">Bantuan WhatsApp</a>
          </div>
        </div>
      </div>
    </main>

    <footer class="site-footer" style="padding-top:40px;">
      <div class="container text-center">
        <p style="color:var(--text-dim); font-size:0.88rem;">
          &copy; 2026 PT. Nifara Coal Trading. Hak Cipta Dilindungi Undang-Undang.
        </p>
      </div>
    </footer>
  </div>

</body>
</html>
