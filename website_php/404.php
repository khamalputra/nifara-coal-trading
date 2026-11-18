<?php
/**
 * 404 Error Page (Version 1 Theme)
 * PT. Nifara Coal Trading
 */

if (!headers_sent()) {
    header("HTTP/1.0 404 Not Found");
}

$basePath = '.';
$pageTitle = '404 - Halaman Tidak Ditemukan | PT. Nifara Coal Trading';
$pageDesc = 'Halaman yang Anda cari tidak dapat ditemukan. Silakan kembali ke beranda atau akses publikasi PT. Nifara Coal Trading.';
$canonicalUrl = 'https://nifaracoaltrading.co.id/404.php';

require_once __DIR__ . '/includes/header.php';
?>

<main id="main" tabindex="-1">
  <section class="band dots" style="min-height: 75vh; display: flex; align-items: center; justify-content: center; padding: 140px 20px 80px;">
    <div class="wrap text-center" style="max-width: 680px; text-align: center; margin: 0 auto;">
      <div style="font-size: clamp(4.5rem, 12vw, 7rem); font-weight: 800; line-height: 1; color: var(--gold); margin-bottom: 16px;">
        404
      </div>
      <h1 style="font-size: clamp(1.6rem, 3.5vw, 2.2rem); font-weight: 800; color: var(--paper); margin-bottom: 18px;" data-en="Page Not Found">
        Halaman Tidak Ditemukan
      </h1>
      <p class="lead" style="margin: 0 auto 36px; max-width: 580px;" data-en="The link you requested may have moved, been deleted, or is temporarily unavailable. Please return to the homepage or access our services below.">
        Tautan yang Anda tuju mungkin telah berpindah, diubah, atau tidak lagi tersedia. Silakan kembali ke beranda utama atau akses tautan layanan di bawah ini.
      </p>
      <div style="display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; align-items: center;">
        <a href="/" class="btn solid" data-en="Return to Homepage">Menuju Beranda</a>
        <a href="/berita/" class="btn" data-en="News &amp; CSR">Publikasi &amp; CSR</a>
        <a href="/#kontak" class="btn" data-en="Contact Us">Hubungi Kami</a>
        <a href="https://wa.me/628116600026" class="btn" target="_blank" rel="noopener" data-en="WhatsApp Help">Bantuan WhatsApp</a>
      </div>
    </div>
  </section>
</main>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
