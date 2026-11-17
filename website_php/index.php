<?php
/**
 * Main Landing Page (Version 1 Design + Dynamic Articles)
 * PT. Nifara Coal Trading
 */

require_once __DIR__ . '/config/database.php';

// Fetch latest 3 published articles for the homepage
$articles = [];
try {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM articles WHERE status = 'published' ORDER BY created_at DESC LIMIT 3");
    $stmt->execute();
    $articles = $stmt->fetchAll();
} catch (Exception $e) {
    // Silently continue if table empty or query fails
    $articles = [];
}

$pageTitle = 'PT. Nifara Coal Trading | Perdagangan Batu Bara';
$basePath = '.';
require_once __DIR__ . '/includes/header.php';
?>

<main id="main" tabindex="-1">

  <section class="hero" id="hero" aria-labelledby="h1">
    <div class="hero-photo-wrap">
      <picture>
        <source srcset="img/hero.webp" type="image/webp">
        <img class="hero-photo" src="img/hero.jpg" alt="Truk pengangkut batubara di tambang PT Nifara Coal Trading" width="400" height="238" style="max-width: 100%; height: auto;" fetchpriority="high">
      </picture>
      <div class="hero-scrim"></div>
      <div class="hero-geo-stripes" aria-hidden="true">
        <span class="geo-stripe s1"></span>
        <span class="geo-stripe s2"></span>
      </div>
    </div>

    <div class="wrap hero-wrap">
      <div class="hero-content">
        <h1 id="h1" class="hero-title" data-en="<span class='line-nowrap'>Coal from the source</span><br>of production to<br><span class='gold-highlight'>the end consumer</span>">
          <span class="line-nowrap">Batubara dari sumber</span><br>produksi hingga<br><span class="gold-highlight">konsumen akhir</span>
        </h1>

        <p class="hero-desc" data-en="An officially licensed coal trading and logistics enterprise ensuring reliable, high-grade thermal coal supply for domestic industrial needs and Asian export markets.">
          Badan usaha niaga dan logistik batubara berizin resmi yang menjamin keandalan pasokan energi termal berkualitas untuk kebutuhan industri domestik dan pasar Asia.
        </p>

        <div class="hero-cta">
          <a class="hero-btn solid" href="#rantai">
            <span data-en="Explore our value chain">Lihat rantai nilai kami</span>
            <svg class="hero-btn-arrow" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
          </a>
          <a class="hero-btn outline" href="#legalitas">
            <span data-en="Verify legal documents">Verifikasi dokumen legal</span>
            <svg class="hero-btn-arrow" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
          </a>
        </div>
      </div>

      <a href="#tentang" class="hero-scroll" aria-label="Gulir ke bawah" data-en-aria-label="Scroll down">
        <span class="mouse-icon" aria-hidden="true"><span class="mouse-wheel"></span></span>
        <span class="scroll-sep" aria-hidden="true"></span>
        <span class="scroll-text" data-en="Scroll down">Gulir ke bawah</span>
      </a>
    </div>
  </section>

  <!-- Facts Transition Band -->
  <section class="facts-band" aria-label="Ringkasan Perusahaan" data-en-aria-label="Company Overview">
    <div class="wrap">
      <dl class="facts">
        <div>
          <dt data-en="Year founded">Tahun berdiri</dt>
          <dd data-en="2026, National private">2026, Swasta nasional</dd>
        </div>
        <div>
          <dt data-en="Offices">Kantor perwakilan</dt>
          <dd data-en="Head: Payakumbuh | Ops: Jakarta">Pusat: Payakumbuh | Ops: Jakarta</dd>
        </div>
        <div>
          <dt data-en="Supply support">Dukungan pasokan</dt>
          <dd data-en="10,000 MT coal supply">10.000 MT batubara</dd>
        </div>
      </dl>
    </div>
  </section>

  <section class="band dots" id="tentang" aria-labelledby="h-tentang">
    <div class="wrap about">
      <div class="about-text">
        <span class="about-bar" aria-hidden="true"></span>
        <h2 class="about-title" id="h-tentang" data-en="About <span class='gold-highlight'>us</span>">
          Tentang <span class="gold-highlight">kami</span>
        </h2>
        <p class="about-lead" data-en="PT. Nifara Coal Trading holds official coal transport and trading licenses to supply industrial users across Indonesia and Asia, the primary thermal coal import destination worldwide.">
          PT. Nifara Coal Trading memegang izin usaha resmi Pengangkutan dan Penjualan Batubara untuk melayani kebutuhan pabrik dan industri di Indonesia serta pasar Asia yang merupakan importir batubara termal terbesar di dunia.
        </p>
        <p class="about-body" data-en="With seasoned field specialists and direct mine partnerships, we secure reliable coal deliveries from origin pits straight to end-user facilities.">
          Didukung tim operasional berpengalaman dan relasi langsung di sepanjang rantai pasok, kami menjaga kepastian pasokan batubara mulai dari mulut tambang hingga sampai di fasilitas pabrik Anda.
        </p>
      </div>
      <figure class="figure about-card" style="margin:0">
        <div class="about-card-img">
          <picture>
            <source srcset="img/port.webp" type="image/webp">
            <img src="img/port.jpg" alt="Grab pemuat batubara di pelabuhan dengan alat berat dan laut di latar belakang" data-en-alt="Coal grab loader at a port with heavy equipment and the sea in the background" width="400" height="200" style="max-width: 100%; height: auto;" loading="lazy">
          </picture>
        </div>
        <figcaption class="about-card-body">
          <div class="about-card-header">
            <span class="about-card-bar" aria-hidden="true"></span>
            <strong class="about-card-title" data-en="Our company">Perusahaan kami</strong>
          </div>
          <p class="about-card-desc" data-en="PT. Nifara Coal Trading was founded in 2026. Leveraging trusted mining partnerships and integrated marine transport, we manage raw commodity sourcing through to final site reception.">
            PT. Nifara Coal Trading didirikan pada tahun 2026. Melalui kemitraan tambang tepercaya dan armada logistik maritim terpadu, kami menangani pengadaan komoditas batubara hingga tiba di dermaga penerima konsumen.
          </p>
        </figcaption>
      </figure>
    </div>
  </section>

  <section class="band alt dots" id="rantai" aria-labelledby="h-rantai">
    <div class="wrap">
      <div class="chain-head">
        <span class="chain-bar" aria-hidden="true"></span>
        <h2 class="chain-title" id="h-rantai" data-en="Coal value <span class='gold-highlight'>chain</span>">
          Rantai nilai <span class="gold-highlight">batubara</span>
        </h2>
        <p class="chain-lead" data-en="Select any supply chain stage to review our operational role, verified licensing documents, and recorded technical specifications.">
          Pilih tahapan rantai pasok untuk meninjau peran operasional kami, verifikasi dokumen perizinan, dan spesifikasi teknis yang tercatat.
        </p>
      </div>
      <div class="route" id="route" role="tablist" aria-label="Tahap rantai nilai" data-en-aria-label="Value chain stages">
        <button class="stop" type="button" role="tab" id="tab-0" aria-selected="true" data-i="0">
          <span class="node"></span>
          <span class="stop-label" data-en="Production source">Sumber produksi</span>
        </button>
        <button class="stop" type="button" role="tab" id="tab-1" aria-selected="false" tabindex="-1" data-i="1">
          <span class="node"></span>
          <span class="stop-label" data-en="Transport and sales">Pengangkutan dan penjualan</span>
        </button>
        <button class="stop" type="button" role="tab" id="tab-2" aria-selected="false" tabindex="-1" data-i="2">
          <span class="node"></span>
          <span class="stop-label" data-en="End consumers">Konsumen akhir</span>
        </button>
      </div>
      <div class="panel" id="panel" role="tabpanel" aria-labelledby="tab-0">
        <div class="panel-main">
          <div class="panel-header">
            <span class="panel-bar" aria-hidden="true"></span>
            <h3 id="p-title">Sumber produksi</h3>
          </div>
          <p class="desc" id="p-desc">Pasokan batubara kami didukung oleh PT Seluma Prima Coal, pemegang Izin Usaha Pertambangan Operasi Produksi (IUP OP). Komitmen pasokan resmi tertuang dalam surat perjanjian pasokan jangka panjang.</p>
          <div class="actions" id="p-actions">
            <button class="btn btn-panel" type="button">
              <span>Lihat surat dukungan</span>
              <svg class="btn-arrow-circle" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="11 8 15 12 11 16"/></svg>
            </button>
          </div>
        </div>
        <dl class="specs" id="p-specs">
          <div><dt>Pemasok</dt><dd>PT Seluma Prima Coal</dd></div>
          <div><dt>Volume dukungan</dt><dd>10.000 MT</dd></div>
          <div><dt>Periode</dt><dd>November dan Desember 2026</dd></div>
          <div><dt>IUP OP</dt><dd>44/1/IUP/PMA/2016, 13 Desember 2016</dd></div>
          <div><dt>Luas wilayah</dt><dd>1.116 hektar</dd></div>
          <div><dt>Surat dukungan</dt><dd>No. 119/SPC-MD/XI/2026, Jambi, 11 November 2026</dd></div>
        </dl>
      </div>
    </div>
  </section>

  <section class="band dots" id="visi" aria-labelledby="h-visi">
    <div class="wrap">
      <div class="vm-head">
        <span class="vm-bar" aria-hidden="true"></span>
        <h2 class="vm-title" id="h-visi" data-en="Vision &amp; <span class='gold-highlight'>mission</span>">
          Visi &amp; <span class="gold-highlight">misi</span>
        </h2>
        <p class="vm-lead" data-en="Our operational commitment and directed actions to safeguard domestic and regional energy resilience.">
          Arah kebijakan dan komitmen nyata kami dalam mengawal ketahanan energi industri nasional maupun regional.
        </p>
      </div>

      <div class="vm-grid">
        <!-- Kartu 1: Visi Perusahaan -->
        <article class="vm-card">
          <div class="vm-card-img">
            <picture>
              <source srcset="img/barge-card.webp" type="image/webp">
              <img src="img/barge-card.jpg" alt="Tongkang pengangkut batubara berlayar saat matahari terbenam" data-en-alt="Coal barge sailing at sunset" width="400" height="250" style="max-width: 100%; height: auto;" loading="lazy">
            </picture>
            <span class="vm-badge" data-en="Vision">Visi</span>
          </div>
          <div class="vm-card-body">
            <div class="vm-card-header">
              <span class="vm-card-bar" aria-hidden="true"></span>
              <h3 class="vm-card-title" data-en="Corporate vision">Visi perusahaan</h3>
            </div>
            <p class="vm-statement" data-en="To build a reliable independent coal trading and transport network across Indonesia and Asia, delivering consistent commodity quality while maintaining accountable, long-term buyer relationships.">
              Menjadi mitra niaga dan pengangkutan batubara independen terpercaya di Indonesia, memasok komoditas berkalori stabil untuk kebutuhan industri domestik maupun ekspor, serta mengutamakan akuntabilitas kemitraan jangka panjang.
            </p>
            <div class="vm-tags">
              <span class="vm-tag" data-en="Independent trading">Niaga independen</span>
              <span class="vm-tag" data-en="High-grade coal">Batubara berkualitas</span>
              <span class="vm-tag" data-en="Trusted partnership">Kemitraan tepercaya</span>
            </div>
          </div>
        </article>

        <!-- Kartu 2: Misi Strategis -->
        <article class="vm-card">
          <div class="vm-card-img">
            <picture>
              <source srcset="img/dermaga-card.webp" type="image/webp">
              <img src="img/dermaga-card.jpg" alt="Truk batubara antre di dermaga dengan tongkang bermuatan" data-en-alt="Coal trucks queueing at a jetty with a loaded barge" width="400" height="250" style="max-width: 100%; height: auto;" loading="lazy">
            </picture>
            <span class="vm-badge" data-en="Mission">Misi</span>
          </div>
          <div class="vm-card-body">
            <div class="vm-card-header">
              <span class="vm-card-bar" aria-hidden="true"></span>
              <h3 class="vm-card-title" data-en="Strategic mission">Misi operasional</h3>
            </div>
            <div class="vm-pillars">
              <div class="vm-pillar">
                <span class="vm-num">01</span>
                <div>
                  <h4 class="vm-pillar-title" data-en="Energy security &amp; power generation">Ketahanan energi industri &amp; pembangkit</h4>
                  <p class="vm-pillar-desc" data-en="Supplying thermal coal to domestic power facilities and manufacturing plants, ensuring dependable fuel flow that keeps production running without interruption.">
                    Menyuplai bahan bakar batubara bagi pembangkit listrik dan sentra industri nasional, memastikan pasokan energi stabil untuk menjaga kontinuitas operasional dan manufaktur.
                  </p>
                </div>
              </div>
              <div class="vm-pillar">
                <span class="vm-num">02</span>
                <div>
                  <h4 class="vm-pillar-title" data-en="Economic &amp; community empowerment">Penguatan ekonomi kawasan</h4>
                  <p class="vm-pillar-desc" data-en="Driving local economic vitality along mining and transport corridors by creating employment and collaborating with regional logistics partners responsibly.">
                    Mendorong perputaran ekonomi daerah di sekitar koridor logistik dan dermaga dengan membuka kesempatan kerja serta merangkul mitra usaha lokal secara berkelanjutan.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="band alt dots" id="pimpinan" aria-labelledby="h-pimpinan">
    <div class="wrap">
      <div class="leader-head">
        <span class="leader-bar" aria-hidden="true"></span>
        <h2 class="leader-title" id="h-pimpinan" data-en="Company <span class='gold-highlight'>leadership</span>">
          Pimpinan <span class="gold-highlight">perusahaan</span>
        </h2>
        <p class="leader-lead" data-en="Commitment and strategic direction from the Board of Commissioners and Directors of PT. Nifara Coal Trading.">
          Komitmen dan arahan strategis dari jajaran Dewan Komisaris serta Direksi PT. Nifara Coal Trading.
        </p>
      </div>

      <div class="leaders-grid">
        <div class="leaders-people">
          <article class="leader-card">
            <div class="leader-card-frame">
              <div class="leader-photo-wrap">
                <picture>
                  <source srcset="img/niha.webp" type="image/webp">
                  <img class="leader-bg-img" src="img/niha.jpg" alt="Latar foto Niha Meisya Maharani, Komisaris PT Nifara Coal Trading" data-en-alt="Background portrait of Niha Meisya Maharani, Commissioner" width="400" height="432" loading="lazy">
                </picture>
                <picture>
                  <source srcset="img/niha-cutout.webp" type="image/webp">
                  <img class="leader-cutout-img" src="img/niha-cutout.png" alt="Niha Meisya Maharani, Komisaris PT Nifara Coal Trading" data-en-alt="Niha Meisya Maharani, Commissioner of PT Nifara Coal Trading" width="400" height="432" loading="lazy">
                </picture>
              </div>
              <div class="leader-info">
                <h3 class="leader-name">Niha Meisya Maharani</h3>
                <p class="leader-role" data-en="Commissioner">Komisaris</p>
              </div>
            </div>
          </article>

          <article class="leader-card">
            <div class="leader-card-frame">
              <div class="leader-photo-wrap">
                <picture>
                  <source srcset="img/rizki.webp" type="image/webp">
                  <img class="leader-bg-img" src="img/rizki.jpg" alt="Latar foto Rizki Abdian Putra, Direktur PT Nifara Coal Trading" data-en-alt="Background portrait of Rizki Abdian Putra, Director" width="400" height="432" loading="lazy">
                </picture>
                <picture>
                  <source srcset="img/rizki-cutout.webp" type="image/webp">
                  <img class="leader-cutout-img" src="img/rizki-cutout.png" alt="Rizki Abdian Putra, Direktur PT Nifara Coal Trading" data-en-alt="Rizki Abdian Putra, Director of PT Nifara Coal Trading" width="400" height="432" loading="lazy">
                </picture>
              </div>
              <div class="leader-info">
                <h3 class="leader-name">Rizki Abdian Putra</h3>
                <p class="leader-role" data-en="Director">Direktur</p>
              </div>
            </div>
          </article>
        </div>

        <article class="letter-card">
          <div class="letter-header">
            <div class="letter-header-left">
              <span class="letter-bar" aria-hidden="true"></span>
              <h3 class="letter-title" data-en="Message from the board">Sambutan manajemen</h3>
            </div>
            <div class="letter-quote-icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
              </svg>
            </div>
          </div>
          <div class="letter-body">
            <p data-en="We express our sincere gratitude to Almighty God for His blessings, allowing PT. Nifara Coal Trading to advance steadily and provide dependable energy supplies across the Indonesian and Asian coal markets.">
              Puji syukur kami panjatkan ke hadirat Tuhan Yang Maha Esa atas limpahan rahmat-Nya, sehingga PT. Nifara Coal Trading dapat terus bertumbuh dan memberi solusi energi yang andal bagi pasar batubara nasional maupun regional Asia.
            </p>
            <p data-en="Indonesia stands as a central pillar in the global coal trade. Supplying this demand requires strict discipline in calorific specifications, transparent documentation, and smooth logistics from mine mouth to harbor.">
              Sebagai salah satu pilar penggerak ekonomi nasional dan lumbung energi dunia, sektor batubara Indonesia membutuhkan mitra niaga yang disiplin. Fokus utama kami tertuju pada ketepatan spesifikasi kalori, kelancaran logistik tambang, serta kepatuhan kontrak jual-beli.
            </p>
            <p data-en="PT. Nifara Coal Trading continually refines its supply chain management, trains dedicated operational teams, and honors every commercial agreement from origin pits directly to your industrial receiving yards.">
              PT. Nifara Coal Trading berfokus menyempurnakan manajemen rantai pasok, memperkuat kecakapan personel di lapangan, serta menjaga integritas pengiriman mulai dari mulut tambang hingga sampai di fasilitas pabrik Anda.
            </p>
          </div>
          <div class="letter-sign">
            <div class="sign-meta">
              <span class="sign-greeting" data-en="Sincerely,">Hormat kami,</span>
              <strong class="sign-author" data-en="The Board of Directors of PT. Nifara Coal Trading">Direksi PT. Nifara Coal Trading</strong>
            </div>
            <div class="sign-badge">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
              <span data-en="Verified Board">Kepemimpinan Resmi</span>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="band dots" id="legalitas" aria-labelledby="h-legal">
    <div class="wrap">
      <div class="legal-header">
        <span class="legal-bar" aria-hidden="true"></span>
        <h2 class="legal-title" id="h-legal" data-en="Company legal &amp; licensing <span class='gold-highlight'>documents</span>">
          Legalitas &amp; perizinan <span class="gold-highlight">perusahaan</span>
        </h2>
        <p class="legal-lead" data-en="Our company incorporation, licensing, taxation, and supply support documents. Select any document to read its official summary and view its copy.">
          Dokumen pendirian, perizinan, perpajakan, dan surat dukungan pasokan kami. Pilih dokumen untuk membaca ringkasan dan melihat salinan resminya.
        </p>
      </div>
      <ul class="docs" id="docs"></ul>
    </div>
  </section>

  

  <!-- Berita & Inisiatif CSR (Dynamic CMS Integration) -->
  <section class="band alt" id="berita" aria-labelledby="h-berita">
    <div class="wrap">
      <div class="news-header-wrap">
        <div>
          <h2 id="h-berita" data-en="Latest News &amp; CSR Initiatives">Kabar Terkini &amp; Inisiatif CSR</h2>
          <p class="lead" data-en="Publication of official operational activities and social environmental responsibility.">Publikasi aktivitas operasional resmi dan tanggung jawab sosial lingkungan&nbsp;perusahaan.</p>
        </div>
        <div>
          <a class="btn" href="berita/">
            <span data-en="View all articles">Lihat semua artikel</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
          </a>
        </div>
      </div>

      <div class="news-grid">
        <?php if (!empty($articles)): ?>
          <?php foreach ($articles as $art): ?>
            <article class="news-card">
              <a href="berita/<?= urlencode($art['slug']) ?>" class="news-thumb-wrap">
                <img src="<?= htmlspecialchars(!empty($art['image']) ? $art['image'] : 'img/hero.jpg') ?>" alt="<?= htmlspecialchars($art['title']) ?>" width="400" height="267" style="max-width: 100%; height: auto;" loading="lazy">
                <span class="news-tag <?= $art['category'] === 'CSR' ? 'csr' : '' ?>"><?= htmlspecialchars($art['category']) ?></span>
              </a>
              <div class="news-body">
                <div class="news-date">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  <span><?= date('d M Y', strtotime($art['created_at'])) ?></span>
                </div>
                <h3 class="news-title">
                  <a href="berita/<?= urlencode($art['slug']) ?>"><?= htmlspecialchars(mb_strimwidth($art['title'], 0, 58, '...')) ?></a>
                </h3>
                <p class="news-snippet"><?= htmlspecialchars($art['excerpt'] ?? substr(strip_tags($art['content']), 0, 120) . '...') ?></p>
                <a href="berita/<?= urlencode($art['slug']) ?>" class="news-readmore" aria-label="Baca selengkapnya mengenai <?= htmlspecialchars($art['title']) ?>">
                  <span data-en="Read full story">Baca selengkapnya</span>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
              </div>
            </article>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="muted" style="grid-column: 1 / -1; text-align: center; padding: 40px 0;">Belum ada artikel publikasi.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

<section class="band dots" id="kontak" aria-labelledby="h-kontak">
    <div class="wrap">
      <h2 class="title contact-title" id="h-kontak" data-en="Contact <span class='gold-highlight'>us</span>">Hubungi <span class="gold-highlight">kami</span></h2>
      <p class="lead" data-en="Direct communication channels and coal specification consultation for your industrial needs.">Saluran komunikasi langsung dan konsultasi spesifikasi batubara untuk kebutuhan industri Anda.</p>
      <div class="contact">
        <div class="reach-col">
          <dl class="reach">
            <div class="reach-item">
              <div class="reach-icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
              </div>
              <div class="reach-content">
                <dt>Email</dt>
                <dd><span id="v-email">info@nifaracoaltrading.co.id</span><span class="copy"><button class="copy-btn" type="button" command="--copy" commandfor="v-email" aria-label="Salin email" data-en-aria-label="Copy email" data-en="Copy">Salin</button><span class="tip" role="status"></span></span></dd>
              </div>
            </div>
            <div class="reach-item">
              <div class="reach-icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              </div>
              <div class="reach-content">
                <dt data-en="Phone">Telepon</dt>
                <dd><span id="v-tel">08116600026</span><span class="copy"><button class="copy-btn" type="button" command="--copy" commandfor="v-tel" aria-label="Salin nomor telepon" data-en-aria-label="Copy phone number" data-en="Copy">Salin</button><span class="tip" role="status"></span></span></dd>
              </div>
            </div>
          </dl>

          <!-- Interactive Google Maps Switcher Widget -->
          <div class="reach-map-widget" id="peta-lokasi">
            <div class="map-widget-tabs" role="tablist" aria-label="Pilihan Lokasi Peta">
              <button type="button" class="map-tab-btn active" id="mapTabPayakumbuh" role="tab" aria-selected="true" aria-controls="mapPanePayakumbuh">
                <span data-en="Head Office">Kantor Pusat</span>
              </button>
              <button type="button" class="map-tab-btn" id="mapTabJakarta" role="tab" aria-selected="false" aria-controls="mapPaneJakarta">
                <span data-en="Business Office">Lokasi Usaha</span>
              </button>
            </div>

            <div class="map-panes-deck">
              <!-- Pane 1: Kantor Pusat (Payakumbuh) -->
              <div class="map-pane active" id="mapPanePayakumbuh" role="tabpanel" aria-labelledby="mapTabPayakumbuh">
                <div class="map-pane-info">
                  <span class="map-pane-tag" data-en="Registered Head Office">Kantor Pusat Resmi</span>
                  <p class="map-pane-addr" data-en="Jl. Diponegoro 2, Ngalau View Garden Blok C No. 22, Kel. Kubu Gadang, Kec. Payakumbuh Barat, Kota Payakumbuh, Sumatera Barat 26226">Jl. Diponegoro 2, Ngalau View Garden Blok C No. 22, Kel. Kubu Gadang, Kec. Payakumbuh Barat, Kota Payakumbuh, Sumatera Barat 26226</p>
                </div>
                <div class="map-pane-frame">
                  <iframe
                    src="https://maps.google.com/maps?q=Ngalau+View+Garden+Payakumbuh&t=&z=15&ie=UTF8&iwloc=&output=embed"
                    title="Peta Lokasi Kantor Pusat PT Nifara Coal Trading di Payakumbuh"
                    data-en-title="Map of PT Nifara Coal Trading Head Office in Payakumbuh"
                    width="100%"
                    height="220"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                  </iframe>
                </div>
                <div class="map-pane-foot">
                  <a class="map-pane-link" href="https://www.google.com/maps/search/?api=1&query=Ngalau+View+Garden+Payakumbuh+Sumatera+Barat" target="_blank" rel="noopener" aria-label="Buka di Google Maps (Kantor Pusat Payakumbuh)" data-en-aria-label="Open in Google Maps (Payakumbuh Head Office)">
                    <span data-en="Open in Google Maps">Buka di Google Maps</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                  </a>
                </div>
              </div>

              <!-- Pane 2: Lokasi Usaha (Jakarta) -->
              <div class="map-pane" id="mapPaneJakarta" role="tabpanel" aria-labelledby="mapTabJakarta" hidden>
                <div class="map-pane-info">
                  <span class="map-pane-tag" data-en="Operational Business Location">Lokasi Usaha Operasional</span>
                  <p class="map-pane-addr" data-en="Jalan Letjen M.T. Haryono Kav. 10 GF A4/A, Kel. Bidara Cina, Kec. Jatinegara, Jakarta Timur, DKI Jakarta 13330">Jalan Letjen M.T. Haryono Kav. 10 GF A4/A, Kel. Bidara Cina, Kec. Jatinegara, Jakarta Timur, DKI Jakarta 13330</p>
                </div>
                <div class="map-pane-frame">
                  <iframe
                    src="https://maps.google.com/maps?q=Jalan+Letjen+M.T.+Haryono+Kav.+10+Jatinegara+Jakarta+Timur&t=&z=15&ie=UTF8&iwloc=&output=embed"
                    title="Peta Lokasi Usaha PT Nifara Coal Trading di Jakarta Timur"
                    data-en-title="Map of PT Nifara Coal Trading Business Location in East Jakarta"
                    width="100%"
                    height="220"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                  </iframe>
                </div>
                <div class="map-pane-foot">
                  <a class="map-pane-link" href="https://www.google.com/maps/search/?api=1&query=Jalan+Letjen+M.T.+Haryono+Kav.+10+Jatinegara+Jakarta+Timur" target="_blank" rel="noopener" aria-label="Buka di Google Maps (Lokasi Usaha Jakarta)" data-en-aria-label="Open in Google Maps (Jakarta Business Office)">
                    <span data-en="Open in Google Maps">Buka di Google Maps</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <form class="msg" id="msgForm" method="POST" action="javascript:void(0);" aria-labelledby="h-kontak">
          <div class="form-header">
            <h3 class="form-title" data-en="Formulate Requirements">Formulir Kebutuhan Batubara</h3>
            <p class="form-desc" data-en="Fill in your specifications to send an inquiry directly to our official email.">Lengkapi rincian spesifikasi untuk langsung terhubung ke email resmi kami.</p>
          </div>
          <div class="field"><label for="f-name" data-en="Name">Nama</label><input id="f-name" name="name" type="text" autocomplete="name" placeholder="Nama lengkap Anda" data-en-placeholder="Your full name"></div>
          <div class="field"><label for="f-co" data-en="Company">Perusahaan</label><input id="f-co" name="company" type="text" autocomplete="organization" placeholder="Nama institusi atau PT" data-en-placeholder="Company or institution name"></div>
          <div class="field field-note">
            <label for="f-note"><span data-en="Your needs">Kebutuhan Anda</span> <span class="req" data-en="(required)">(wajib diisi)</span></label>
            <textarea id="f-note" name="note" required aria-describedby="f-note-hint" placeholder="Contoh: Kebutuhan batubara GAR 4200 kkal/kg sebanyak 50.000 MT per bulan untuk PLTU/pabrik..." data-en-placeholder="e.g. Requirement of GAR 4200 kcal/kg coal of 50,000 MT per month for power plant/factory..."></textarea>
            <p class="hint" id="f-note-hint" data-en="State the type of need, the volume, and the delivery location.">Sebutkan jenis kebutuhan, volume, dan lokasi pengiriman.</p>
          </div>
          <button class="form-submit-btn" type="submit">
            <span data-en="Send to Email">Kirim ke Email</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
          </button>
          <div class="result" id="result" hidden>
            <p id="resultNote" data-en="Your inquiry draft is prepared. Click your preferred email platform below to send:">Draf surat resmi telah disiapkan. Klik platform email yang ingin Anda gunakan untuk mengirim:</p>
            <div class="email-actions">
              <a class="email-action-btn gmail" id="gmailLink" href="https://mail.google.com/mail/?view=cm&fs=1&to=info@nifaracoaltrading.co.id" target="_blank" rel="noopener">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                <span data-en="Open in Gmail">Buka di Gmail</span>
              </a>
              <a class="email-action-btn outlook" id="outlookLink" href="https://outlook.live.com/owa/?path=/mail/action/compose&to=info@nifaracoaltrading.co.id" target="_blank" rel="noopener">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h16v16H4z"/><path d="M4 8l8 5 8-5"/></svg>
                <span data-en="Open in Outlook">Buka di Outlook</span>
              </a>
              <a class="email-action-btn default" id="mailLink" href="mailto:info@nifaracoaltrading.co.id">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10z"/><polyline points="2,7 12,13 22,7"/></svg>
                <span data-en="Default Mail App">Aplikasi Email</span>
              </a>
              <span class="copy">
                <button class="email-action-btn copy-btn" type="button" command="--copy" commandfor="resultText">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                  <span data-en="Copy Draft">Salin Draf</span>
                </button>
                <span class="tip" role="status"></span>
              </span>
            </div>
            <textarea id="resultText" name="result" readonly aria-label="Pesan yang siap disalin" data-en-aria-label="Message ready to copy"></textarea>
          </div>
        </form>
      </div>
    </div>
  </section>

</main>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
