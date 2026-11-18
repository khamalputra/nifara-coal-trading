<?php
/**
 * Public Article & CSR Archive Page (Version 1 Theme)
 * PT. Nifara Coal Trading
 */

require_once __DIR__ . '/../config/database.php';

$db = getDB();
$basePath = '..';
$pageTitle = 'Publikasi, Berita & Program CSR | PT. Nifara Coal Trading';
$pageDesc = 'Informasi resmi seputar kegiatan operasional, program CSR pemberdayaan masyarakat, dan perkembangan industri energi batubara PT. Nifara Coal Trading.';

// Filter by category or search query
$category = isset($_GET['kategori']) ? trim($_GET['kategori']) : 'Semua';
$search = isset($_GET['q']) ? trim($_GET['q']) : '';

$sql = "SELECT * FROM articles WHERE status = 'published'";
$params = [];

if (!empty($category) && $category !== 'Semua') {
    $sql .= " AND category = ?";
    $params[] = $category;
}

if (!empty($search)) {
    $sql .= " AND (title LIKE ? OR excerpt LIKE ? OR content LIKE ?)";
    $searchTerm = "%{$search}%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
}

$sql .= " ORDER BY created_at DESC";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$articles = $stmt->fetchAll();

// List distinct categories
$catStmt = $db->query("SELECT DISTINCT category FROM articles WHERE status = 'published'");
$categories = $catStmt->fetchAll(PDO::FETCH_COLUMN);

$categoryMap = [
    'Semua' => 'All',
    'CSR' => 'CSR',
    'Operasional' => 'Operations',
    'Operasional & Rantai Pasok' => 'Operations & Supply Chain',
    'Regulasi & Kepatuhan' => 'Regulation & Compliance',
    'Tata Kelola & Legalitas' => 'Governance & Legal',
    'Wawasan Pasar' => 'Market Insights',
    'Berita' => 'News'
];

// Metadata & Canonical
$pageTitle = 'Publikasi & Program CSR | PT. Nifara Coal Trading';
$pageDesc = 'Arsip berita korporasi, kegiatan operasional maritim, dan inisiatif CSR PT. Nifara Coal Trading.';
$canonicalUrl = 'https://nifaracoaltrading.co.id/berita/';

include __DIR__ . '/../includes/header.php';
?>

<main id="main" tabindex="-1">

  <!-- Header Banner -->
  <section class="band dots" style="padding-top: 140px; padding-bottom: 50px;">
    <div class="wrap text-center" style="max-width: 900px; text-align: center;">
      <span class="kicker" data-en="INFORMATION & TRANSPARENCY">Wawasan & Keterbukaan Informasi</span>
      <h1 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: var(--paper); margin: 16px 0 20px;" data-en="Publications, News &amp; <span style='color: var(--gold);'>CSR Programs</span>">
        Publikasi, Berita &amp; <span style="color: var(--gold);">Program CSR</span>
      </h1>
      <p class="lead" style="margin: 0 auto 36px; max-width: 720px;" data-en="Official documentation of social initiatives, supply chain updates, and corporate governance transparency of PT. Nifara Coal Trading.">
        Dokumentasi resmi inisiatif sosial, pembaruan rantai pasok maritim, serta transparansi tata kelola korporat PT. Nifara Coal Trading.
      </p>

      <!-- Category Filter Pills -->
      <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; align-items: center;">
        <a href="/berita/" class="btn <?= ($category === 'Semua' && empty($search)) ? 'solid' : '' ?>" style="font-size: 0.85rem; padding: 8px 18px;" data-en="All Publications">Semua Publikasi</a>
        <?php foreach ($categories as $cat): ?>
          <a href="/berita/?kategori=<?= urlencode($cat) ?>" class="btn <?= ($category === $cat) ? 'solid' : '' ?>" style="font-size: 0.85rem; padding: 8px 18px;" data-en="<?= htmlspecialchars($categoryMap[$cat] ?? $cat) ?>">
            <?= htmlspecialchars($cat) ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Article Listing Grid -->
  <section class="band alt" style="padding: 60px 0 100px;">
    <div class="wrap">
      
      <?php if (empty($articles)): ?>
        <div style="text-align: center; padding: 60px 20px; background: rgba(1, 32, 52, 0.6); border: 1px solid var(--line); border-radius: 12px;">
          <h3 style="color: var(--paper); margin-bottom: 8px;" data-en="No Publications Yet">Belum Ada Publikasi</h3>
          <p style="color: var(--muted); margin-bottom: 24px;" data-en="No articles match your filter or search criteria.">Tidak ada artikel yang cocok dengan filter atau kriteria pencarian Anda.</p>
          <a href="/berita/" class="btn solid" data-en="View All Articles">Lihat Semua Artikel</a>
        </div>
      <?php else: ?>
        <div class="news-grid">
          <?php foreach ($articles as $art): ?>
            <?php 
              $artImg = !empty($art['image']) ? $basePath . '/' . ltrim($art['image'], '/') : $basePath . '/img/hero.jpg';
            ?>
            <article class="news-card">
              <a href="/berita/<?= urlencode($art['slug']) ?>" class="news-thumb-wrap">
                <img src="<?= htmlspecialchars($artImg) ?>" alt="<?= htmlspecialchars($art['title']) ?>" loading="lazy">
                <span class="news-tag <?= $art['category'] === 'CSR' ? 'csr' : '' ?>" data-en="<?= htmlspecialchars($categoryMap[$art['category']] ?? $art['category']) ?>"><?= htmlspecialchars($art['category']) ?></span>
              </a>
              <div class="news-body">
                <div class="news-date">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  <span><?= date('d M Y', strtotime($art['created_at'])) ?></span>
                  <span style="margin: 0 4px;">&bull;</span>
                  <span><?= htmlspecialchars($art['author'] ?? 'PT. Nifara Coal Trading') ?></span>
                </div>
                <h2 class="news-title" style="font-size: 1.18rem;">
                  <a href="/berita/<?= urlencode($art['slug']) ?>" data-en="<?= htmlspecialchars($art['title_en'] ?? $art['title']) ?>"><?= htmlspecialchars($art['title']) ?></a>
                </h2>
                <p class="news-snippet" data-en="<?= htmlspecialchars($art['excerpt_en'] ?? $art['excerpt']) ?>"><?= htmlspecialchars($art['excerpt'] ?? substr(strip_tags($art['content']), 0, 130) . '...') ?></p>
                <a href="/berita/<?= urlencode($art['slug']) ?>" class="news-readmore" aria-label="Baca artikel: <?= htmlspecialchars($art['title']) ?>" data-en-aria-label="Read article: <?= htmlspecialchars($art['title_en'] ?? $art['title']) ?>">
                  <span data-en="Read full article">Baca artikel lengkap</span>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

    </div>
  </section>

</main>

<?php
include __DIR__ . '/../includes/footer.php';
?>
