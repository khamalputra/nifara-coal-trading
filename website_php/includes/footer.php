<?php
/**
 * Modular Footer Template (Version 1 Design)
 * PT. Nifara Coal Trading
 */

$basePath = $basePath ?? '.';
?>

<footer class="site-footer">
  <div class="wrap footer-wrap">
    <!-- Top 4-Column Grid -->
    <div class="footer-grid">
      <!-- Col 1: Profil & Identitas Perusahaan -->
      <div class="footer-col footer-about">
        <a href="<?= $basePath ?>/index.php" class="footer-logo-link" aria-label="PT. Nifara Coal Trading Beranda">
          <img src="<?= $basePath ?>/img/logo.png" alt="PT Nifara Coal Trading" class="footer-logo" height="48" style="height: 48px; width: auto; max-height: 48px; display: block;" loading="lazy">
        </a>
        <p class="footer-desc" data-en="PT. Nifara Coal Trading provides licensed thermal coal supplies for domestic industrial boilers and Asian export markets, backed by strict quality inspection and coordinated marine logistics.">
          PT. Nifara Coal Trading melayani pasokan batubara termal berizin resmi untuk industri dalam negeri dan ekspor Asia, didukung pengawasan mutu terukur dan logistik maritim terpadu.
        </p>
        <div class="footer-social-bar" style="margin: 12px 0 16px; display: flex; gap: 10px;">
          <a href="https://wa.me/6281280093234" target="_blank" rel="noopener" style="color: var(--gold-primary); text-decoration: none; font-size: 14px; font-weight: 600;" aria-label="WhatsApp Official">WhatsApp Official ↗</a>
          <span style="color: rgba(255,255,255,0.2);">|</span>
          <a href="https://www.linkedin.com/company/nifara-coal-trading" target="_blank" rel="noopener" style="color: var(--gold-primary); text-decoration: none; font-size: 14px; font-weight: 600;" aria-label="LinkedIn">LinkedIn ↗</a>
        </div>
        <div class="footer-cred-card">
          <div class="cred-card-header">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
            <span data-en="Verified Enterprise Legalities">Legalitas Badan Usaha Terdaftar</span>
          </div>
          <div class="cred-card-grid">
            <a href="<?= $basePath ?>/index.php#legalitas" class="cred-pill" title="Nomor Induk Berusaha">
              <span class="cred-k">NIB</span>
              <span class="cred-v">3108260031993</span>
            </a>
            <a href="<?= $basePath ?>/index.php#legalitas" class="cred-pill" title="Klasifikasi Baku Lapangan Usaha Indonesia">
              <span class="cred-k">KBLI</span>
              <span class="cred-v">46710</span>
            </a>
            <a href="<?= $basePath ?>/index.php#legalitas" class="cred-pill cred-pill-wide" title="Pengesahan Badan Hukum Menkumham RI">
              <span class="cred-k" data-en="Law Ministry Approval">SK Kemenkumham RI</span>
              <span class="cred-v" data-en="Deed No. 08 / 2026">Akta No. 08 / 2026</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Col 2: Navigasi Cepat (Quick Links) -->
      <div class="footer-col footer-nav">
        <h3 class="footer-col-title" data-en="Quick Links">Navigasi Halaman</h3>
        <ul class="footer-links">
          <li><a href="<?= $basePath ?>/index.php#tentang" data-en="About Us">Tentang Kami</a></li>
          <li><a href="<?= $basePath ?>/index.php#rantai" data-en="Value Chain">Rantai Nilai Pasokan</a></li>
          <li><a href="<?= $basePath ?>/index.php#visi" data-en="Vision &amp; Mission">Visi &amp; Misi</a></li>
          <li><a href="<?= $basePath ?>/index.php#pimpinan" data-en="Leadership">Pimpinan Perusahaan</a></li>
          <li><a href="<?= $basePath ?>/index.php#legalitas" data-en="Official Legalities">Legalitas &amp; Perizinan</a></li>
          <li><a href="<?= $basePath ?>/berita/index.php" data-en="News &amp; CSR">Kabar Berita &amp; CSR</a></li>
          <li><a href="<?= $basePath ?>/index.php#legalitas" data-en="Privacy Policy &amp; Terms">Kebijakan Privasi &amp; Kepatuhan</a></li>
          <li><a href="<?= $basePath ?>/index.php#kontak" data-en="Contact Us">Hubungi Kami</a></li>
        </ul>
      </div>

      <!-- Col 3: Layanan & Komoditas Batubara -->
      <div class="footer-col footer-services">
        <h3 class="footer-col-title" data-en="Services &amp; Supply">Layanan &amp; Komoditas</h3>
        <ul class="footer-links">
          <li><a href="<?= $basePath ?>/index.php#kontak" data-en="Power Plant (PLTU) Supply">Pasokan Batubara PLTU</a></li>
          <li><a href="<?= $basePath ?>/index.php#kontak" data-en="Industrial Steam Coal">Batubara Industri &amp; Pabrik</a></li>
          <li><a href="<?= $basePath ?>/index.php#rantai" data-en="Barge &amp; Vessel Logistics">Logistik Tongkang &amp; Kapal</a></li>
          <li><a href="<?= $basePath ?>/index.php#legalitas" data-en="Production Mining IUP Partners">Kemitraan IUP-OP Tambang</a></li>
          <li><a href="<?= $basePath ?>/index.php#kontak" data-en="Custom GAR Specification">Konsultasi Kalori &amp; GAR</a></li>
          <li><a href="<?= $basePath ?>/index.php#rantai" data-en="Domestic &amp; Export Market">Perdagangan Domestik &amp; Ekspor</a></li>
        </ul>
      </div>

      <!-- Col 4: Kantor & Kontak Resmi -->
      <div class="footer-col footer-contact">
        <h3 class="footer-col-title" data-en="Office &amp; Contact">Kantor &amp; Kontak</h3>
        <div class="footer-locations">
          <div class="footer-loc-item">
            <span class="footer-loc-tag" data-en="Head Office">Kantor Pusat (Payakumbuh)</span>
            <p class="footer-loc-addr" data-en="Jl. Diponegoro 2, Ngalau View Garden Blok C No. 22, West Payakumbuh, West Sumatra 26226">Jl. Diponegoro 2, Ngalau View Garden Blok C No. 22, Kec. Payakumbuh Barat, Sumatera Barat 26226</p>
          </div>
          <div class="footer-loc-item">
            <span class="footer-loc-tag" data-en="Operational Office">Lokasi Usaha (Jakarta)</span>
            <p class="footer-loc-addr" data-en="Jl. Letjen M.T. Haryono Kav. 10 GF A4/A, Jatinegara, East Jakarta 13330">Jl. Letjen M.T. Haryono Kav. 10 GF A4/A, Jatinegara, Jakarta Timur 13330</p>
          </div>
        </div>
        <ul class="footer-contact-list">
          <li>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            <a href="mailto:info@nifaracoaltrading.co.id">info@nifaracoaltrading.co.id</a>
          </li>
          <li>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <a href="tel:081280093234">+62 812-8009-3234</a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Bottom Bar (Sub-Footer) -->
    <div class="footer-bottom">
      <div class="footer-copy">
        <p data-en="&copy; 2026 PT. Nifara Coal Trading. All rights reserved.">&copy; 2026 PT. Nifara Coal Trading. Hak Cipta Dilindungi Undang-Undang.</p>
      </div>
      <div class="footer-bottom-meta">
        <span class="footer-compliance" data-en="Permit &amp; Trade Compliance: KBLI 46710 | IUP OP 44/1/IUP/PMA/2016">Kepatuhan Perizinan &amp; Niaga: KBLI 46710 | IUP OP 44/1/IUP/PMA/2016</span>
      </div>
    </div>
  </div>
</footer>

<!-- Lightbox Document Viewer Dialog -->
<dialog class="viewer" id="viewer" aria-labelledby="v-title" closedby="any">
  <form method="dialog">
    <button class="close" type="submit" aria-label="Tutup" data-en-aria-label="Close" autofocus>
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
  </form>
  <div class="viewer-grid">
    <div class="viewer-img">
      <div class="viewer-img-frame">
        <img id="v-img" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 400'%3E%3Crect width='100%25' height='100%25' fill='%23021a2d'/%3E%3C/svg%3E" alt="Pratinjau dokumen resmi PT Nifara Coal Trading" width="600" height="400">
      </div>
      <a class="viewer-zoom-btn" id="v-full-link" href="<?= $basePath ?>/img/hero.jpg" target="_blank" rel="noopener">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
        <span data-en="Open Full Resolution">Buka Resolusi Penuh</span>
      </a>
    </div>
    <div class="viewer-info">
      <div class="viewer-meta-top">
        <span class="viewer-badge">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
          <span data-en="Verified Legal Record">Dokumen Legal Terverifikasi</span>
        </span>
        <span class="viewer-counter" id="v-counter">01 / 07</span>
      </div>

      <div class="viewer-header">
        <span class="viewer-bar" aria-hidden="true"></span>
        <h3 id="v-title" data-en="Legal Document Details">Pratinjau Dokumen Legalitas</h3>
      </div>
      <p id="v-desc" data-en="Select a document to inspect verified corporate legal parameters.">Pilih dokumen untuk melihat rincian parameter legalitas resmi perusahaan.</p>

      <div class="viewer-specs-box">
        <div class="viewer-specs-top">
          <span class="viewer-specs-heading" data-en="Official Parameters">Rincian Dokumen</span>
          <span class="viewer-tag" id="v-short-tag"></span>
        </div>
        <dl class="specs" id="v-specs"></dl>
      </div>

      <div class="viewer-nav">
        <button class="btn btn-nav prev" type="button" id="vPrev" aria-label="Dokumen sebelumnya" data-en-aria-label="Previous document">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
          <span data-en="Previous">Sebelumnya</span>
        </button>
        <div class="viewer-dots" id="v-dots" aria-label="Navigasi nomor dokumen"></div>
        <button class="btn btn-nav next" type="button" id="vNext" aria-label="Dokumen berikutnya" data-en-aria-label="Next document">
          <span data-en="Next">Berikutnya</span>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
        </button>
      </div>
    </div>
  </div>
</dialog>

<!-- Floating Action Buttons: WhatsApp & Scroll To Top -->
<aside class="floating-motion-bar" aria-label="Aksi Cepat">
  <button type="button" class="float-btn scroll-top" id="motionScrollTop" aria-label="Kembali ke atas" data-en-aria-label="Back to top">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
    <span class="float-tooltip" data-en="Back to top">Ke atas</span>
  </button>
  
  <a href="https://wa.me/6281280093234?text=Halo%20PT.%20Nifara%20Coal%20Trading,%20saya%20tertarik%20untuk%20mengetahui%20lebih%20lanjut%20mengenai%20penawaran%20batubara." 
     target="_blank" 
     rel="noopener" 
     class="float-btn whatsapp" 
     aria-label="Hubungi WhatsApp Bisnis"
     data-en-aria-label="Contact via WhatsApp">
    <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor">
      <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm.01 1.67c2.2 0 4.26.86 5.82 2.41a8.204 8.204 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.196 8.196 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24zm4.52 11.66c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.25-.75-.67-1.26-1.5-1.4-1.76-.15-.25-.02-.39.11-.51.11-.11.25-.29.38-.44.13-.15.17-.25.25-.42.08-.17.04-.32-.02-.44-.06-.13-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.32-.23.25-.88.86-.88 2.1 0 1.24.9 2.44 1.03 2.61.13.17 1.77 2.7 4.29 3.79.6.26 1.07.41 1.44.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.11-.22-.18-.47-.3z"/>
    </svg>
    <span class="float-tooltip" data-en="Chat WhatsApp">Chat WhatsApp</span>
  </a>
</aside>

<!-- Main JS & Micro-Interactions -->
<script src="<?= $basePath ?>/assets/js/main.js"></script>
</body>
</html>
