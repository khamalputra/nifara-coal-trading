<?php
/**
 * CMS Edit Article / CSR - Enterprise Console
 * PT. Nifara Coal Trading
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

requireAdminAuth();

$db = getDB();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $db->prepare("SELECT * FROM articles WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$article = $stmt->fetch();

if (!$article) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $error = 'Validasi sesi keamanan kadaluarsa. Silakan muat ulang halaman.';
    } else {
        $title = trim($_POST['title'] ?? '');
        $category = trim($_POST['category'] ?? 'CSR');
        $excerpt = trim($_POST['excerpt'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $author = trim($_POST['author'] ?? 'Tim Humas & CSR PT. Nifara Coal Trading');

        if (empty($title) || empty($excerpt) || empty($content)) {
            $error = 'Judul publikasi, ringkasan, dan isi artikel wajib diisi.';
        } else {
            $imagePath = $article['image'];
            $uploadError = '';

            // Handle new image upload with robust MIME and size validation
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['image']['tmp_name'];
                $fileName = basename($_FILES['image']['name']);
                $fileSize = $_FILES['image']['size'] ?? 0;
                $maxSize = 5 * 1024 * 1024; // 5 MB

                if ($fileSize > $maxSize) {
                    $uploadError = 'Ukuran berkas gambar maksimal adalah 5 MB.';
                } else {
                    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $allowedExts = ['jpg', 'jpeg', 'png', 'webp'];

                    // Binary MIME type verification
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mimeType = finfo_file($finfo, $fileTmp);
                    finfo_close($finfo);

                    $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];

                    if (in_array($ext, $allowedExts, true) && in_array($mimeType, $allowedMimes, true)) {
                        $newFileName = 'news-' . time() . '-' . mt_rand(1000, 9999) . '.' . $ext;
                        $uploadDir = dirname(__DIR__) . '/uploads/news/';
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }
                        if (move_uploaded_file($fileTmp, $uploadDir . $newFileName)) {
                            $imagePath = 'uploads/news/' . $newFileName;
                        } else {
                            $uploadError = 'Gagal menyimpan berkas gambar ke server.';
                        }
                    } else {
                        $uploadError = 'Format berkas tidak valid. Hanya berkas gambar asli (JPG, PNG, WebP) yang diizinkan.';
                    }
                }
            }

            if (!empty($uploadError)) {
                $error = $uploadError;
            } else {
                // Sanitize content with XSS allowlist
                $cleanContent = sanitizeArticleHtml($content);

                // Update DB
                $stmt = $db->prepare("UPDATE articles SET title = ?, category = ?, excerpt = ?, content = ?, image = ?, author = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
                $stmt->execute([$title, $category, $excerpt, $cleanContent, $imagePath, $author, $id]);

                header("Location: dashboard.php?msg=updated");
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Publikasi | PT. Nifara Coal Trading</title>
  <link rel="icon" type="image/png" href="../assets/images/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="admin-body">

<!-- Hero Background Image & Scrim Overlay (Exact Home Hero Match) -->
<div class="dashboard-hero-bg" aria-hidden="true">
  <img src="../img/hero.jpg" alt="" class="dashboard-hero-img" fetchpriority="high">
  <div class="dashboard-hero-scrim"></div>
  <div class="dashboard-geo-stripes">
    <span class="geo-stripe s1"></span>
    <span class="geo-stripe s2"></span>
  </div>
</div>

<!-- Accessibility Bypass Link (WCAG 2.4.1) -->
<a href="#main" class="skip-to-content">Lewati ke konten utama</a>

<header class="admin-header">
  <a href="dashboard.php" class="admin-brand">
    <img src="../assets/images/logo.png" alt="PT. Nifara Coal Trading Logo">
    <div class="admin-brand-meta">
      <span class="admin-brand-title">
        PT. Nifara Coal Trading
        <span class="brand-badge">CMS Enterprise</span>
      </span>
      <span class="admin-brand-sub">Portal Administrasi Berita, CSR &amp; Operasional</span>
    </div>
  </a>

  <div class="admin-user-menu">
    <div class="sys-health-pill" title="Koneksi server dan basis data aktif normal">
      <span class="health-pulse-dot"></span>
      <span class="health-val">Sistem Aktif</span>
    </div>

    <div class="user-chip">
      <div class="user-avatar"><?= strtoupper(substr($_SESSION['admin_name'] ?? 'A', 0, 1)) ?></div>
      <div class="user-info">
        <span class="user-name"><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Administrator') ?></span>
        <span class="user-role">Super Admin</span>
      </div>
    </div>

    <a href="dashboard.php" class="nav-action-btn nav-preview-btn">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline>
      </svg>
      <span>Kembali ke Daftar</span>
    </a>
    <a href="logout.php" class="nav-action-btn nav-logout-btn">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" y1="12" x2="9" y2="12"></line>
      </svg>
      <span>Keluar</span>
    </a>
  </div>
</header>

<main id="main" class="admin-container" tabindex="-1">

  <!-- Breadcrumb Navigation -->
  <div class="admin-breadcrumb">
    <a href="dashboard.php">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
      Konsol CMS
    </a>
    <span class="sep">/</span>
    <a href="dashboard.php">Publikasi &amp; CSR</a>
    <span class="sep">/</span>
    <span class="current">Edit Artikel #<?= sprintf('%02d', $id) ?></span>
  </div>

  <div class="admin-card">
    <div class="admin-title-row" style="margin-bottom: 20px;">
      <div class="admin-card-header-left">
        <h1>Edit Publikasi: <?= htmlspecialchars($article['title']) ?></h1>
        <p>Perbarui naskah berita, kategori, atau foto dokumentasi kegiatan di bawah ini.</p>
      </div>
    </div>

    <?php if (!empty($error)): ?>
      <div class="alert-box alert-error">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
        <span><?= htmlspecialchars($error) ?></span>
      </div>
    <?php endif; ?>

    <form method="POST" action="artikel-edit.php?id=<?= $id ?>" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">

      <div class="form-layout-grid">

        <!-- Left Column: Primary Content -->
        <div class="form-left-col">
          
          <!-- Title & Permalink Card -->
          <div class="form-panel">
            <h3 class="form-panel-title">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
              Informasi Utama Publikasi
            </h3>

            <div class="form-group">
              <div class="form-label-with-icon">
                <span class="form-label-title">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h7"></path></svg>
                  Judul Publikasi / Kegiatan CSR
                </span>
                <span class="form-label-badge">Wajib diisi</span>
              </div>
              <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($article['title']) ?>" required>
              
              <!-- Permalink Bar -->
              <div class="slug-preview-bar">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                <span>Tautan Permanen: /berita/<span class="slug-highlight"><?= htmlspecialchars($article['slug']) ?></span></span>
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
              <div class="form-label-with-icon">
                <span class="form-label-title">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="21" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="7" y2="18"></line></svg>
                  Ringkasan Singkat (Lead Paragraph)
                </span>
                <span class="form-label-badge">Tampil pada kartu daftar</span>
              </div>
              <textarea id="excerpt" name="excerpt" class="form-control" style="min-height: 90px;" required><?= htmlspecialchars($article['excerpt']) ?></textarea>
            </div>
          </div>

          <!-- Article Body & Rich Tools -->
          <div class="form-panel">
            <h3 class="form-panel-title">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
              Isi Lengkap Artikel
            </h3>

            <!-- Toolbar -->
            <div class="editor-toolbar">
              <button type="button" class="editor-btn" onclick="formatText('bold')" title="Teks Tebal">
                <strong>B</strong> Tebal
              </button>
              <button type="button" class="editor-btn" onclick="formatText('italic')" title="Teks Miring">
                <em>I</em> Miring
              </button>
              <button type="button" class="editor-btn" onclick="formatText('h2')" title="Sub-Judul H2">
                H2
              </button>
              <button type="button" class="editor-btn" onclick="formatText('h3')" title="Sub-Judul H3">
                H3
              </button>
              <button type="button" class="editor-btn" onclick="formatText('ul')" title="Daftar Poin">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                Poin
              </button>
              <button type="button" class="editor-btn" onclick="formatText('quote')" title="Kutipan">
                Kutipan
              </button>
              <button type="button" class="editor-btn" onclick="formatText('p')" title="Paragraf Baru">
                &para; Paragraf
              </button>
            </div>

            <textarea id="content" name="content" class="form-control editor-textarea" style="min-height: 280px;" required><?= htmlspecialchars($article['content']) ?></textarea>
            <div class="form-hint">Mendukung format paragraf HTML terstruktur secara otomatis saat dipublikasikan.</div>
          </div>

        </div>

        <!-- Right Column: Settings & Media -->
        <div class="form-right-col">

          <!-- Publish Card -->
          <div class="form-panel" style="background: rgba(2, 26, 45, 0.7); border-color: rgba(245, 181, 107, 0.25);">
            <h3 class="form-panel-title">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 14 14"></polyline></svg>
              Pembaruan Rilis
            </h3>

            <div style="margin-bottom: 18px; font-size: 0.82rem; color: var(--admin-dim);">
              <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                <span>Status Artikel:</span>
                <span class="status-pill"><span class="status-pill-dot"></span> Publik</span>
              </div>
              <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                <span>Total Penayangan:</span>
                <strong style="color: #c084fc;"><?= number_format($article['views'] ?? 0) ?>x tayang</strong>
              </div>
              <div style="display: flex; justify-content: space-between;">
                <span>Terdaftar Sejak:</span>
                <span style="color: #fff; font-variant-numeric: tabular-nums;"><?= date('d M Y', strtotime($article['created_at'])) ?></span>
              </div>
            </div>

            <button type="submit" class="btn-admin btn-admin-gold" style="width: 100%; justify-content: center; padding: 12px 18px; font-size: 0.9rem;">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
              Simpan Perubahan Artikel
            </button>

            <a href="dashboard.php" class="btn-admin btn-admin-outline" style="width: 100%; justify-content: center; margin-top: 10px; padding: 10px 16px;">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
              Batal
            </a>
          </div>

          <!-- Category Selector Card -->
          <div class="form-panel">
            <h3 class="form-panel-title">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 9h16M4 15h16M10 3L8 21M16 3l-2 18"></path></svg>
              Kategori Publikasi
            </h3>

            <div class="category-pill-group">
              <label class="category-radio-label <?= $article['category'] === 'CSR' ? 'active' : '' ?>">
                <input type="radio" name="category" value="CSR" <?= $article['category'] === 'CSR' ? 'checked' : '' ?> onchange="updateCategoryActive(this)">
                <span>CSR &amp; Lingkungan</span>
              </label>

              <label class="category-radio-label <?= $article['category'] === 'Operasional' ? 'active' : '' ?>">
                <input type="radio" name="category" value="Operasional" <?= $article['category'] === 'Operasional' ? 'checked' : '' ?> onchange="updateCategoryActive(this)">
                <span>Operasional</span>
              </label>

              <label class="category-radio-label <?= $article['category'] === 'Regulasi & Kepatuhan' ? 'active' : '' ?>">
                <input type="radio" name="category" value="Regulasi &amp; Kepatuhan" <?= $article['category'] === 'Regulasi & Kepatuhan' ? 'checked' : '' ?> onchange="updateCategoryActive(this)">
                <span>Regulasi Tata Kelola</span>
              </label>

              <label class="category-radio-label <?= $article['category'] === 'Ekspansi Pasar' ? 'active' : '' ?>">
                <input type="radio" name="category" value="Ekspansi Pasar" <?= $article['category'] === 'Ekspansi Pasar' ? 'checked' : '' ?> onchange="updateCategoryActive(this)">
                <span>Ekspansi Pasar</span>
              </label>
            </div>
          </div>

          <!-- Author Info Card -->
          <div class="form-panel">
            <h3 class="form-panel-title">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
              Penulis / Penanggung Jawab
            </h3>

            <div class="form-group" style="margin-bottom: 0;">
              <input type="text" id="author" name="author" class="form-control" value="<?= htmlspecialchars($article['author']) ?>" required>
              <div class="form-hint">Ditampilkan sebagai rujukan tim penulis resmi.</div>
            </div>
          </div>

          <!-- Image Upload Dropzone Card -->
          <div class="form-panel">
            <h3 class="form-panel-title">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
              Dokumentasi Foto Utama
            </h3>

            <?php if (!empty($article['image'])): ?>
              <div style="margin-bottom: 12px; font-size: 0.76rem; color: var(--admin-dim);">
                <span>Foto Saat Ini:</span>
                <div class="image-preview-box" style="margin-top: 6px;">
                  <img src="../<?= htmlspecialchars($article['image']) ?>" alt="Foto Berita">
                </div>
              </div>
            <?php endif; ?>

            <div class="upload-dropzone" id="dropzone-area">
              <input type="file" id="image" name="image" accept="image/*" onchange="previewImageFile(this)">
              <div class="dropzone-content">
                <div class="dropzone-icon">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                </div>
                <p class="dropzone-text" id="dropzone-filename">Ganti Foto Banner Baru</p>
                <p class="dropzone-sub">Biarkan kosong jika tetap menggunakan foto yang ada</p>
              </div>
            </div>

            <div class="image-preview-box" id="preview-box" style="display: none;">
              <span style="font-size: 0.72rem; color: var(--admin-gold); display: block; padding: 4px 8px;">Foto Pengganti Terpilih:</span>
              <img id="preview-img" src="" alt="Pratinjau Foto Pengganti">
            </div>
          </div>

        </div>

      </div>
    </form>
  </div>

</main>

<script>
// Category radio active class toggle
function updateCategoryActive(radio) {
  document.querySelectorAll('.category-radio-label').forEach(label => {
    label.classList.remove('active');
  });
  radio.closest('.category-radio-label').classList.add('active');
}

// Image Dropzone Preview Handler
function previewImageFile(input) {
  if (input.files && input.files[0]) {
    const file = input.files[0];
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('preview-img').src = e.target.result;
      document.getElementById('preview-box').style.display = 'block';
      document.getElementById('dropzone-filename').textContent = file.name;
    };
    reader.readAsDataURL(file);
  }
}

// Rich Text Helper Tools
function formatText(type) {
  const textarea = document.getElementById('content');
  const start = textarea.selectionStart;
  const end = textarea.selectionEnd;
  const selected = textarea.value.substring(start, end);

  let replacement = '';
  switch (type) {
    case 'bold':
      replacement = `<b>${selected || 'Teks Tebal'}</b>`;
      break;
    case 'italic':
      replacement = `<i>${selected || 'Teks Miring'}</i>`;
      break;
    case 'h2':
      replacement = `\n<h2>${selected || 'Sub Judul H2'}</h2>\n`;
      break;
    case 'h3':
      replacement = `\n<h3>${selected || 'Sub Judul H3'}</h3>\n`;
      break;
    case 'ul':
      replacement = `\n<ul>\n  <li>${selected || 'Poin pertama'}</li>\n  <li>Poin kedua</li>\n</ul>\n`;
      break;
    case 'quote':
      replacement = `\n<blockquote>${selected || 'Kutipan penting...'}</blockquote>\n`;
      break;
    case 'p':
      replacement = `\n<p>${selected || 'Tuliskan paragraf baru di sini...'}</p>\n`;
      break;
  }

  textarea.setRangeText(replacement, start, end, 'end');
  textarea.focus();
}
</script>

</body>
</html>