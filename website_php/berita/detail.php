<?php
/**
 * Public Article Detail Page (Version 1 Theme)
 * PT. Nifara Coal Trading
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

$db = getDB();
$basePath = '..';
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if (empty($slug)) {
    header("Location: index.php");
    exit;
}

// Fetch article by slug
$stmt = $db->prepare("SELECT * FROM articles WHERE slug = ? AND status = 'published' LIMIT 1");
$stmt->execute([$slug]);
$article = $stmt->fetch();

if (!$article) {
    header("HTTP/1.0 404 Not Found");
    include __DIR__ . '/../404.php';
    exit;
}

// Increment views counter
$db->prepare("UPDATE articles SET views = views + 1 WHERE id = ?")->execute([$article['id']]);

// Meta tags & Canonical (SEO title strictly <= 68 characters for Bing & Google)
$brandSuffix = ' | Nifara Coal';
$maxTitleLen = 68 - strlen($brandSuffix);
$cleanTitle = $article['title'];
if (mb_strlen($cleanTitle) > $maxTitleLen) {
    $cleanTitle = mb_substr($cleanTitle, 0, $maxTitleLen);
    $lastSpace = mb_strrpos($cleanTitle, ' ');
    if ($lastSpace !== false) {
        $cleanTitle = mb_substr($cleanTitle, 0, $lastSpace);
    }
}
$pageTitle = $cleanTitle . $brandSuffix;
$pageDesc = $article['excerpt'];
$canonicalUrl = 'https://nifaracoaltrading.co.id/berita/' . $article['slug'];
$artDate = date('d F Y', strtotime($article['created_at']));
$artIsoDate = date('c', strtotime($article['created_at']));
$artImg = !empty($article['image']) ? $basePath . '/' . ltrim($article['image'], '/') : $basePath . '/img/hero.jpg';
$pageImage = !empty($article['image']) ? 'https://nifaracoaltrading.co.id/' . ltrim($article['image'], '/') : 'https://nifaracoaltrading.co.id/img/hero.jpg';

// Fetch related articles
$relStmt = $db->prepare("SELECT * FROM articles WHERE id != ? AND status = 'published' ORDER BY created_at DESC LIMIT 2");
$relStmt->execute([$article['id']]);
$relatedArticles = $relStmt->fetchAll();

include __DIR__ . '/../includes/header.php';
?>

<!-- Article Schema.org Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": <?= json_encode($article['title']) ?>,
  "description": <?= json_encode($article['excerpt']) ?>,
  "image": <?= json_encode($pageImage) ?>,
  "datePublished": <?= json_encode($artIsoDate) ?>,
  "dateModified": <?= json_encode($artIsoDate) ?>,
  "author": {
    "@type": "Organization",
    "name": <?= json_encode($article['author'] ?? 'Tim Humas & CSR PT. Nifara Coal Trading') ?>,
    "url": "https://nifaracoaltrading.co.id/"
  },
  "publisher": {
    "@type": "Organization",
    "name": "PT. Nifara Coal Trading",
    "logo": {
      "@type": "ImageObject",
      "url": "https://nifaracoaltrading.co.id/img/logo.png"
    }
  },
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": <?= json_encode($canonicalUrl) ?>
  }
}
</script>

<main id="main" tabindex="-1">

  <!-- Article Header Banner -->
  <section class="band dots" style="padding-top: 130px; padding-bottom: 40px; border-bottom: 1px solid var(--line);">
    <div class="wrap" style="max-width: 860px;">
      <a href="index.php" style="color: var(--gold); text-decoration: none; font-size: 0.9rem; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 24px;">
        &larr; Kembali ke Semua Publikasi
      </a>
      
      <div style="display: flex; gap: 12px; align-items: center; margin-bottom: 18px; flex-wrap: wrap;">
        <span class="news-tag <?= $article['category'] === 'CSR' ? 'csr' : '' ?>" style="position: static;"><?= htmlspecialchars($article['category']) ?></span>
        <span style="color: var(--muted); font-size: 0.88rem;"><?= $artDate ?></span>
        <span style="color: var(--muted); font-size: 0.88rem;">&bull;</span>
        <span style="color: var(--muted); font-size: 0.88rem;">Oleh: <?= htmlspecialchars($article['author'] ?? 'PT. Nifara Coal Trading') ?></span>
      </div>

      <h1 style="font-size: clamp(1.8rem, 4vw, 2.7rem); line-height: 1.25; font-weight: 800; color: var(--paper); margin-bottom: 20px;">
        <?= htmlspecialchars($article['title']) ?>
      </h1>

      <p style="font-size: 1.12rem; line-height: 1.7; color: var(--text); font-weight: 400; border-left: 3px solid var(--gold); padding-left: 18px;">
        <?= htmlspecialchars($article['excerpt']) ?>
      </p>
    </div>
  </section>

  <!-- Article Content Body -->
  <section class="band alt" style="padding: 50px 0 80px;">
    <div class="wrap" style="max-width: 860px;">
      
      <?php if (!empty($article['image'])): ?>
        <img src="<?= htmlspecialchars($artImg) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="article-hero-img">
      <?php endif; ?>

      <div class="article-prose">
        <?= sanitizeArticleHtml($article['content']) ?>
      </div>

      <!-- Share & Back Actions -->
      <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <a href="/berita/" class="btn solid">&larr; Kembali ke Arsip Berita</a>
        <a href="https://wa.me/?text=<?= urlencode($article['title'] . ' - Baca selengkapnya di PT. Nifara Coal Trading') ?>" target="_blank" rel="noopener" class="btn">
          Bagikan via WhatsApp
        </a>
      </div>

      <!-- Related Articles -->
      <?php if (!empty($relatedArticles)): ?>
        <div style="margin-top: 70px;">
          <span class="kicker">ARTIKEL LAINNYA</span>
          <h3 style="font-size: 1.5rem; color: var(--paper); margin: 8px 0 24px;">Publikasi Terkait</h3>
          <div class="news-grid">
            <?php foreach ($relatedArticles as $rel): ?>
              <?php $relImg = !empty($rel['image']) ? $basePath . '/' . ltrim($rel['image'], '/') : $basePath . '/img/hero.jpg'; ?>
              <article class="news-card">
                <a href="/berita/<?= urlencode($rel['slug']) ?>" class="news-thumb-wrap">
                  <img src="<?= htmlspecialchars($relImg) ?>" alt="<?= htmlspecialchars($rel['title']) ?>" loading="lazy">
                  <span class="news-tag <?= $rel['category'] === 'CSR' ? 'csr' : '' ?>"><?= htmlspecialchars($rel['category']) ?></span>
                </a>
                <div class="news-body">
                  <div class="news-date">
                    <span><?= date('d M Y', strtotime($rel['created_at'])) ?></span>
                  </div>
                  <h4 class="news-title">
                    <a href="/berita/<?= urlencode($rel['slug']) ?>"><?= htmlspecialchars($rel['title']) ?></a>
                  </h4>
                  <a href="/berita/<?= urlencode($rel['slug']) ?>" class="news-readmore">
                    <span>Baca selengkapnya &rarr;</span>
                  </a>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </section>

</main>

<?php
include __DIR__ . '/../includes/footer.php';
?>
