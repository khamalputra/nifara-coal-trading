<?php
/**
 * Modular Header Template (Version 1 Design)
 * PT. Nifara Coal Trading
 */

if (!headers_sent()) {
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");
    header("Cross-Origin-Opener-Policy: same-origin");
    header("Content-Security-Policy: default-src 'self' https:; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; img-src 'self' data: https:; font-src 'self' https://fonts.gstatic.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; frame-src 'self' https://www.google.com https://maps.google.com;");
    header_remove("X-Powered-By");
}

$basePath = $basePath ?? '.';
$pageTitle = $pageTitle ?? 'PT. Nifara Coal Trading | Perdagangan Batu Bara';
$pageDesc = $pageDesc ?? 'Pedagang batu bara resmi di Indonesia. Menyediakan GAR 3800-5800 kkal/kg dengan rantai pasok maritim untuk industri & PLTU.';
$canonicalUrl = $canonicalUrl ?? 'https://nifaracoaltrading.co.id/';
$pageImage = $pageImage ?? ($basePath . '/img/hero.jpg');
$absoluteImage = str_starts_with($pageImage, 'http') ? $pageImage : ('https://nifaracoaltrading.co.id/' . ltrim($pageImage, './'));
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>">
  <meta name="keywords" content="Nifara Coal Trading, batubara Indonesia, jual batubara, pengangkutan batubara, coal trading, IUP OP, KBLI 46710, batubara sumatera">
  <meta name="author" content="PT. Nifara Coal Trading">
  <meta name="robots" content="index, follow">
  <meta name="google-site-verification" content="google19fd1744191acb17">

  <!-- Canonical URL -->
  <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
  <meta property="og:site_name" content="PT. Nifara Coal Trading">
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($pageDesc) ?>">
  <meta property="og:image" content="<?= htmlspecialchars($absoluteImage) ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:locale" content="id_ID">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@nifaracoal">
  <meta name="twitter:creator" content="@nifaracoal">
  <meta name="twitter:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
  <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($pageDesc) ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($absoluteImage) ?>">

  <!-- AI Discoverability -->
  <link rel="llms" href="<?= $basePath ?>/llms.txt">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?= $basePath ?>/img/logo.png">

  <!-- Performance & Resource Hints -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" as="image" href="<?= ($basePath === '.' ? 'img/hero.jpg' : $basePath . '/img/hero.jpg') ?>" fetchpriority="high">

  <!-- Google Fonts: Nunito & Plus Jakarta Sans -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400&family=Plus+Jakarta+Sans:wght@600;700&display=swap">

  <!-- Motion Library (Deferred for Performance) -->
  <script defer src="https://cdn.jsdelivr.net/npm/motion@10.18.0/dist/motion.umd.js"></script>

  <!-- Modular CSS -->
  <link rel="stylesheet" href="<?= $basePath ?>/assets/css/style.css">

  <!-- Structured Data: Organization & WebSite (JSON-LD) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@graph": [
      {
        "@type": "Organization",
        "@id": "https://nifaracoaltrading.co.id/#organization",
        "name": "PT. Nifara Coal Trading",
        "legalName": "PT. Nifara Coal Trading",
        "url": "https://nifaracoaltrading.co.id/",
        "logo": {
          "@type": "ImageObject",
          "url": "https://nifaracoaltrading.co.id/img/logo.png",
          "width": 900,
          "height": 526
        },
        "description": "Perusahaan perdagangan dan logistik batu bara berizin resmi (IUP OPK / KBLI 46710) di Indonesia.",
        "telephone": "+62-811-6600-026",
        "email": "info@nifaracoaltrading.co.id",
        "sameAs": [
          "https://wa.me/628116600026",
          "https://www.linkedin.com/company/nifara-coal-trading"
        ],
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Jl. Diponegoro 2, Ngalau View Garden Blok C No. 22, Kel. Kubu Gadang, Kec. Payakumbuh Barat",
          "addressLocality": "Kota Payakumbuh",
          "addressRegion": "Sumatera Barat",
          "postalCode": "26226",
          "addressCountry": "ID"
        },
        "contactPoint": {
          "@type": "ContactPoint",
          "telephone": "+62-811-6600-026",
          "contactType": "sales",
          "availableLanguage": ["Indonesian", "English"]
        }
      },
      {
        "@type": "WebSite",
        "@id": "https://nifaracoaltrading.co.id/#website",
        "url": "https://nifaracoaltrading.co.id/",
        "name": "PT. Nifara Coal Trading",
        "description": "Perdagangan dan Logistik Batu Bara Berkualitas di Indonesia",
        "publisher": {
          "@id": "https://nifaracoaltrading.co.id/#organization"
        },
        "inLanguage": ["id", "en"],
        "potentialAction": {
          "@type": "SearchAction",
          "target": {
            "@type": "EntryPoint",
            "urlTemplate": "https://nifaracoaltrading.co.id/berita/?q={search_term_string}"
          },
          "query-input": "required name=search_term_string"
        }
      }
    ]
  }
  </script>

  <script>document.documentElement.lang = "id";</script>
</head>
<body>

<!-- Accessibility Bypass Link (WCAG 2.4.1) -->
<a href="#main" class="skip-to-content" data-en="Skip to main content">Lewati ke konten utama</a>

<!-- Top Scroll Progress Indicator -->
<div class="motion-scroll-progress" id="motionScrollProgress"></div>

<!-- Header Sticky -->
<header class="site-header" id="top">
  <div class="wrap bar" id="headerInner">
    <a class="brand" id="brandLogo" href="<?= $basePath ?>/index.php#hero" aria-label="PT. Nifara Coal Trading" data-en-aria-label="PT. Nifara Coal Trading">
      <img src="<?= $basePath ?>/img/logo.png" alt="PT. Nifara Coal Trading Logo" height="46" style="height: 46px; width: auto; max-height: 46px; display: block;">
    </a>
    <div class="tools">
      <nav class="site-nav" aria-label="Menu utama" data-en-aria-label="Main menu">
        <button class="menu-btn" id="menuBtn" type="button" popovertarget="site-menu" popovertargetaction="toggle" aria-controls="site-menu" aria-label="Buka menu" data-en-aria-label="Open menu">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
          <span class="sr-only">Menu</span>
        </button>
        <ul id="site-menu" class="site-menu" popover="auto">
          <li><a class="link" href="<?= $basePath ?>/index.php#tentang" data-en="About">Tentang</a></li>
          <li><a class="link" href="<?= $basePath ?>/index.php#rantai" data-en="Value chain">Rantai nilai</a></li>
          <li><a class="link" href="<?= $basePath ?>/index.php#visi" data-en="Vision and mission">Visi dan misi</a></li>
          <li><a class="link" href="<?= $basePath ?>/index.php#pimpinan" data-en="Leadership">Pimpinan</a></li>
          <li><a class="link" href="<?= $basePath ?>/index.php#legalitas" data-en="Legal documents">Legalitas</a></li>
          <li><a class="link" href="<?= $basePath ?>/index.php#berita" data-en="News & CSR">Berita & CSR</a></li>
          <li><a class="btn solid" href="<?= $basePath ?>/index.php#kontak" data-en="Contact us">Hubungi kami</a></li>
        </ul>
      </nav>
      <div class="lang" role="group" aria-label="Pilihan Bahasa / Language Selection">
        <button type="button" data-lang="id" lang="id" aria-pressed="true" aria-label="ID - Bahasa Indonesia">ID</button>
        <button type="button" data-lang="en" lang="en" aria-pressed="false" aria-label="EN - English">EN</button>
      </div>
    </div>
  </div>
</header>
