<?php
/**
 * CMS Admin Dashboard - Modern Minimalist Executive Edition
 * PT. Nifara Coal Trading
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

requireAdminAuth();

$db = getDB();

// Fetch all articles
$stmt = $db->query("SELECT * FROM articles ORDER BY created_at DESC");
$articles = $stmt->fetchAll();

// Statistics
$totalArticles = count($articles);
$csrCount = 0;
$opCount = 0;
$regCount = 0;
$totalViews = 0;
foreach ($articles as $a) {
    if ($a['category'] === 'CSR') $csrCount++;
    elseif ($a['category'] === 'Operasional') $opCount++;
    else $regCount++;
    $totalViews += (int)($a['views'] ?? 0);
}

$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Dashboard Kelola Artikel | PT. Nifara Coal Trading</title>
  <link rel="icon" type="image/png" href="../assets/images/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <style>
    /* ==========================================================================
       Modern Minimalist Executive Dashboard System - Hero Atmosphere Edition
       ========================================================================== */
    body.admin-body {
      background-color: #011424;
      color: #f8fafc;
      font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
      min-height: 100vh;
      margin: 0;
      position: relative;
      -webkit-font-smoothing: antialiased;
    }

    /* Hero Photo Background with Signature Dark Luxury Scrim (Fixed Wallpaper) */
    .dashboard-hero-bg {
      position: fixed;
      inset: 0;
      overflow: hidden;
      z-index: 0;
      pointer-events: none;
    }

    .dashboard-hero-img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: right 45%;
      transform: scale(1.04);
      filter: brightness(0.60) contrast(1.12);
    }

    .dashboard-hero-scrim {
      position: absolute;
      inset: 0;
      z-index: 1;
      background:
        linear-gradient(108deg, rgba(1, 26, 44, 0.94) 0%, rgba(1, 26, 44, 0.88) 42%, rgba(1, 32, 52, 0.68) 65%, rgba(1, 32, 52, 0.45) 82%, rgba(1, 26, 44, 0.88) 100%),
        linear-gradient(0deg, #010c18 0%, rgba(1, 20, 35, 0.45) 45%, rgba(1, 15, 27, 0.85) 100%);
      pointer-events: none;
    }

    .dashboard-geo-stripes {
      position: absolute;
      inset: 0;
      z-index: 1;
      overflow: hidden;
      pointer-events: none;
    }

    .dashboard-geo-stripes .geo-stripe {
      position: absolute;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(245, 181, 107, 0.20), transparent);
      width: 140%;
      transform: rotate(-15deg);
    }

    .dashboard-geo-stripes .geo-stripe.s1 { top: 20%; left: -20%; }
    .dashboard-geo-stripes .geo-stripe.s2 { top: 70%; left: -20%; }

    /* Modern Minimalist Navigation Bar */
    .admin-header {
      position: sticky;
      top: 0;
      z-index: 50;
      background: rgba(1, 15, 27, 0.88);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(245, 181, 107, 0.16);
      padding: 12px 32px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: background 0.2s ease;
    }

    .admin-brand {
      display: flex;
      align-items: center;
      gap: 14px;
      text-decoration: none;
    }

    .admin-brand img {
      height: 38px;
      width: auto;
      display: block;
      filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.4));
    }

    .admin-brand-meta {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .admin-brand-title {
      font-size: 0.96rem;
      font-weight: 800;
      color: #ffffff;
      letter-spacing: -0.01em;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .brand-badge {
      font-size: 0.65rem;
      font-weight: 700;
      letter-spacing: 0.05em;
      padding: 2px 7px;
      border-radius: 999px;
      background: rgba(245, 181, 107, 0.12);
      border: 1px solid rgba(245, 181, 107, 0.28);
      color: var(--admin-gold);
      text-transform: uppercase;
    }

    .admin-brand-sub {
      font-size: 0.72rem;
      font-weight: 600;
      color: #94a3b8;
    }

    .admin-user-menu {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .sys-health-pill {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 5px 12px;
      border-radius: 999px;
      background: rgba(16, 185, 129, 0.08);
      border: 1px solid rgba(16, 185, 129, 0.22);
      font-size: 0.74rem;
      font-weight: 600;
      color: #34d399;
    }

    .health-pulse-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: #10b981;
      box-shadow: 0 0 8px #10b981;
    }

    .user-chip {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 4px 12px 4px 5px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .user-avatar {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--admin-gold) 0%, #d49347 100%);
      color: #011424;
      font-size: 0.76rem;
      font-weight: 800;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .user-info {
      display: flex;
      flex-direction: column;
    }

    .user-name {
      font-size: 0.78rem;
      font-weight: 700;
      color: #ffffff;
      line-height: 1.2;
    }

    .user-role {
      font-size: 0.68rem;
      color: #94a3b8;
    }

    .nav-action-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 7px 14px;
      border-radius: 8px;
      font-size: 0.78rem;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .nav-preview-btn {
      background: rgba(245, 181, 107, 0.08);
      border: 1px solid rgba(245, 181, 107, 0.22);
      color: var(--admin-gold);
    }

    .nav-preview-btn:hover {
      background: rgba(245, 181, 107, 0.16);
      border-color: var(--admin-gold);
      color: #ffffff;
      transform: translateY(-1px);
    }

    .nav-logout-btn {
      background: rgba(244, 63, 94, 0.08);
      border: 1px solid rgba(244, 63, 94, 0.22);
      color: #fb7185;
    }

    .nav-logout-btn:hover {
      background: rgba(244, 63, 94, 0.16);
      border-color: #f43f5e;
      color: #ffffff;
      transform: translateY(-1px);
    }

    /* Container Layout */
    .admin-container {
      max-width: 1240px;
      margin: 28px auto 60px;
      padding: 0 24px;
      position: relative;
      z-index: 2;
    }

    /* Page Hero Banner */
    .dashboard-hero {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      margin-bottom: 24px;
      flex-wrap: wrap;
      gap: 16px;
    }

    .dashboard-title-wrap h1 {
      font-size: 1.5rem;
      font-weight: 800;
      color: #ffffff;
      margin: 0 0 6px 0;
      letter-spacing: -0.015em;
    }

    .dashboard-title-wrap p {
      margin: 0;
      font-size: 0.86rem;
      color: #94a3b8;
    }

    .btn-create-article {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 20px;
      background: linear-gradient(135deg, #f5b56b 0%, #df9949 100%);
      color: #02111d;
      font-weight: 800;
      font-size: 0.86rem;
      border-radius: 10px;
      text-decoration: none;
      box-shadow: 0 6px 20px -2px rgba(245, 181, 107, 0.35);
      transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-create-article:hover {
      background: linear-gradient(135deg, #ffc98a 0%, #e8a556 100%);
      box-shadow: 0 10px 26px -2px rgba(245, 181, 107, 0.5);
      transform: translateY(-2px);
    }

    /* Minimalist Metrics Grid */
    .metrics-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
      margin-bottom: 24px;
    }

    .metric-card {
      background: rgba(3, 24, 42, 0.65);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(245, 181, 107, 0.16);
      border-radius: 16px;
      padding: 20px 22px;
      position: relative;
      overflow: hidden;
      transition: border-color 0.22s ease, transform 0.22s ease, box-shadow 0.22s ease;
    }

    .metric-card:hover {
      border-color: rgba(245, 181, 107, 0.35);
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(0, 0, 0, 0.4);
    }

    .metric-card::before {
      content: "";
      position: absolute;
      top: 0;
      left: 12%;
      right: 12%;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--card-accent, var(--admin-gold)), transparent);
      opacity: 0.7;
    }

    .metric-head {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 12px;
    }

    .metric-label {
      font-size: 0.74rem;
      font-weight: 700;
      color: #94a3b8;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .metric-icon-wrap {
      width: 34px;
      height: 34px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(255, 255, 255, 0.04);
      color: var(--card-accent, var(--admin-gold));
      border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .metric-val {
      font-size: 2.1rem;
      font-weight: 800;
      color: #ffffff;
      line-height: 1;
      font-variant-numeric: tabular-nums;
      margin: 0;
      letter-spacing: -0.02em;
    }

    .metric-sub {
      margin-top: 8px;
      font-size: 0.74rem;
      color: #94a3b8;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    /* Table & Filter Toolbar Card */
    .admin-card {
      background: rgba(3, 22, 38, 0.7);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border: 1px solid rgba(245, 181, 107, 0.18);
      border-radius: 18px;
      padding: 24px;
      box-shadow: 0 16px 45px rgba(0, 0, 0, 0.5);
    }

    /* Interactive Search & Filter Toolbar */
    .toolbar-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 14px;
      margin-bottom: 18px;
      padding-bottom: 18px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }

    .filter-pills {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .filter-btn {
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(255, 255, 255, 0.08);
      color: #94a3b8;
      font-size: 0.78rem;
      font-weight: 600;
      padding: 6px 14px;
      border-radius: 999px;
      cursor: pointer;
      font-family: inherit;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .filter-btn:hover {
      color: #ffffff;
      background: rgba(255, 255, 255, 0.07);
    }

    .filter-btn.active {
      background: rgba(245, 181, 107, 0.15);
      border-color: var(--admin-gold);
      color: var(--admin-gold);
    }

    .filter-count {
      font-size: 0.68rem;
      padding: 1px 6px;
      border-radius: 999px;
      background: rgba(0, 0, 0, 0.3);
    }

    .search-box-wrap {
      position: relative;
      min-width: 260px;
    }

    .search-input {
      width: 100%;
      height: 38px;
      padding: 0 14px 0 36px;
      border-radius: 999px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      background: rgba(1, 15, 27, 0.8);
      color: #ffffff;
      font-size: 0.82rem;
      font-family: inherit;
      box-sizing: border-box;
      transition: all 0.2s ease;
    }

    .search-input:focus {
      outline: none;
      border-color: var(--admin-gold);
      background: rgba(2, 21, 37, 0.95);
      box-shadow: 0 0 0 2px rgba(245, 181, 107, 0.2);
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #64748b;
      pointer-events: none;
      display: flex;
    }

    /* Minimalist Data Table */
    .table-responsive {
      overflow-x: auto;
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.06);
      background: rgba(1, 15, 27, 0.4);
    }

    .admin-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      font-size: 0.86rem;
    }

    .admin-table th {
      background: rgba(2, 22, 38, 0.85);
      color: #94a3b8;
      font-weight: 700;
      font-size: 0.72rem;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      padding: 14px 18px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      text-align: left;
    }

    .admin-table td {
      padding: 14px 18px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.04);
      vertical-align: middle;
      color: #f8fafc;
    }

    .admin-table tbody tr {
      transition: background-color 0.18s ease;
    }

    .admin-table tbody tr:hover {
      background-color: rgba(245, 181, 107, 0.035);
    }

    .admin-table tbody tr:last-child td {
      border-bottom: none;
    }

    .col-idx {
      font-weight: 700;
      color: #64748b;
      font-variant-numeric: tabular-nums;
      width: 50px;
    }

    .art-title-cell {
      max-width: 420px;
    }

    .art-title-link {
      color: #ffffff;
      font-weight: 700;
      font-size: 0.90rem;
      text-decoration: none;
      display: block;
      line-height: 1.4;
      margin-bottom: 4px;
      transition: color 0.18s ease;
    }

    .art-title-link:hover {
      color: var(--admin-gold);
    }

    .art-slug-box {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: 0.72rem;
      color: #64748b;
      font-family: monospace;
    }

    /* Category Badges */
    /* Unified Subtle Category Badges */
    .badge-cat {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.72rem;
      font-weight: 600;
      padding: 3px 10px;
      border-radius: 999px;
      white-space: nowrap;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.10);
      color: #e2e8f0;
      transition: all 0.18s ease;
    }

    .badge-dot {
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: var(--admin-gold);
      box-shadow: 0 0 5px rgba(245, 181, 107, 0.4);
    }

    .badge-csr {
      border-color: rgba(245, 181, 107, 0.22);
      color: #f1f5f9;
    }

    .badge-op {
      border-color: rgba(255, 255, 255, 0.14);
      color: #cbd5e1;
    }

    .badge-reg {
      border-color: rgba(245, 181, 107, 0.35);
      color: var(--admin-gold);
    }

    /* Status Pill */
    .status-pill {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: 0.74rem;
      font-weight: 700;
      color: #34d399;
      background: rgba(16, 185, 129, 0.08);
      border: 1px solid rgba(16, 185, 129, 0.22);
      padding: 3px 9px;
      border-radius: 999px;
    }

    .status-pill-dot {
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: #34d399;
    }

    /* Views Counter */
    .views-chip {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: 0.76rem;
      font-weight: 600;
      color: #94a3b8;
      font-variant-numeric: tabular-nums;
    }

    /* Action Buttons Group */
    .action-group {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 6px;
    }

    .btn-action {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 5px 10px;
      border-radius: 6px;
      font-size: 0.74rem;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      border: 1px solid rgba(255, 255, 255, 0.08);
      background: rgba(255, 255, 255, 0.03);
      color: #94a3b8;
      transition: all 0.18s ease;
      font-family: inherit;
    }

    .btn-action-view:hover {
      background: rgba(255, 255, 255, 0.08);
      color: #ffffff;
      border-color: rgba(255, 255, 255, 0.25);
    }

    .btn-action-edit:hover {
      background: rgba(245, 181, 107, 0.12);
      border-color: var(--admin-gold);
      color: var(--admin-gold);
    }

    .btn-action-delete:hover {
      background: rgba(244, 63, 94, 0.12);
      border-color: #f43f5e;
      color: #fb7185;
    }

    .form-action-delete {
      margin: 0;
      display: inline-flex;
    }

    /* Modern Alert Boxes */
    .alert-box {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 18px;
      border-radius: 12px;
      font-size: 0.84rem;
      margin-bottom: 22px;
      animation: alertSlideDown 0.3s ease;
    }
    @keyframes alertSlideDown {
      from { opacity: 0; transform: translateY(-8px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .alert-success {
      background: rgba(16, 185, 129, 0.12);
      border: 1px solid rgba(16, 185, 129, 0.3);
      color: #a7f3d0;
    }

    /* Responsive Queries & Mobile Touch Target Adaptation */
    @media (max-width: 1024px) {
      .metrics-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    @media (max-width: 640px) {
      .admin-header {
        padding: 10px 14px;
        flex-wrap: wrap;
        gap: 10px;
      }
      .admin-brand img {
        height: 32px;
      }
      .admin-brand-title {
        font-size: 0.88rem;
      }
      .brand-badge {
        display: none;
      }
      .admin-user-menu {
        width: 100%;
        justify-content: space-between;
      }
      .sys-health-pill {
        padding: 4px 9px;
        font-size: 0.70rem;
      }
      .nav-action-btn {
        padding: 8px 12px;
        min-height: 38px;
        touch-action: manipulation;
      }

      .admin-container {
        padding: 0 14px;
        margin: 18px auto 44px;
      }

      .dashboard-hero {
        flex-direction: column;
        align-items: stretch;
        gap: 14px;
        margin-bottom: 20px;
      }
      .btn-create-article {
        width: 100%;
        height: 44px;
        justify-content: center;
        font-size: 0.88rem;
        touch-action: manipulation;
      }

      .metrics-grid {
        grid-template-columns: 1fr;
        gap: 12px;
      }
      .metric-card {
        padding: 16px 18px;
      }

      .admin-card {
        padding: 16px 12px;
        border-radius: 14px;
      }
      .toolbar-row {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
        margin-bottom: 14px;
        padding-bottom: 14px;
      }
      .filter-pills {
        gap: 6px;
      }
      .filter-btn {
        padding: 8px 14px;
        min-height: 38px;
        font-size: 0.80rem;
        touch-action: manipulation;
      }
      .search-box-wrap {
        width: 100%;
      }
      .search-input {
        height: 42px;
        font-size: 0.86rem;
      }

      .admin-table th,
      .admin-table td {
        padding: 12px 14px;
      }
      .admin-table th:last-child,
      .admin-table td:last-child {
        min-width: 230px;
      }
      .action-group {
        gap: 8px;
        justify-content: flex-start;
      }
      .btn-action {
        padding: 8px 14px;
        min-height: 38px;
        font-size: 0.80rem;
        border-radius: 8px;
        touch-action: manipulation;
      }
      .btn-action svg {
        width: 14px;
        height: 14px;
      }
    }

    /* Accessibility: Intentional Reduced Motion (WCAG AAA SC 2.3.3) */
    @media (prefers-reduced-motion: reduce) {
      .alert-box {
        animation: none;
      }
      .dashboard-hero-img {
        transform: none;
      }
      .metric-card:hover,
      .btn-create-article:hover,
      .nav-action-btn:hover,
      .btn-action:hover,
      .filter-btn:hover {
        transform: none;
      }
      .admin-table tbody tr,
      .btn-action,
      .filter-btn,
      .nav-action-btn,
      .btn-create-article,
      .search-input {
        transition-duration: 0.05s;
      }
    }
  </style>
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

<!-- Modern Minimalist Top Navigation -->
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
      <span>Sistem Aktif</span>
    </div>

    <div class="user-chip">
      <div class="user-avatar"><?= strtoupper(substr($_SESSION['admin_name'] ?? 'A', 0, 1)) ?></div>
      <div class="user-info">
        <span class="user-name"><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Administrator') ?></span>
        <span class="user-role">Super Admin</span>
      </div>
    </div>

    <a href="../index.php" target="_blank" class="nav-action-btn nav-preview-btn">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
        <polyline points="15 3 21 3 21 9"></polyline>
        <line x1="10" y1="14" x2="21" y2="3"></line>
      </svg>
      <span>Pratinjau Web</span>
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

  <!-- Feedback Alerts -->
  <?php if ($msg === 'created'): ?>
    <div class="alert-box alert-success" role="alert">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
      <span>Publikasi artikel baru berhasil ditambahkan!</span>
    </div>
  <?php elseif ($msg === 'updated'): ?>
    <div class="alert-box alert-success" role="alert">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
      <span>Perubahan artikel berhasil disimpan!</span>
    </div>
  <?php elseif ($msg === 'deleted'): ?>
    <div class="alert-box alert-success" role="alert">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
      <span>Artikel telah berhasil dihapus dari sistem.</span>
    </div>
  <?php endif; ?>

  <!-- Hero Header & Quick Action -->
  <div class="dashboard-hero">
    <div class="dashboard-title-wrap">
      <h1>Overview &amp; Manajemen Publikasi</h1>
      <p>Pantau performa artikel korporat, inisiatif CSR, dan pembaruan logistik maritim.</p>
    </div>
    <a href="artikel-tambah.php" class="btn-create-article">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      <span>Tambah Artikel Baru</span>
    </a>
  </div>

  <!-- Minimalist KPI Metrics Grid -->
  <div class="metrics-grid">
    <div class="metric-card" style="--card-accent: var(--admin-gold);">
      <div class="metric-head">
        <span class="metric-label">Total Publikasi</span>
        <div class="metric-icon-wrap" style="color: var(--admin-gold);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path>
            <path d="M18 14h-8"></path><path d="M15 18h-5"></path><path d="M10 6h8v4h-8V6Z"></path>
          </svg>
        </div>
      </div>
      <div class="metric-val"><?= $totalArticles ?></div>
      <div class="metric-sub">Koleksi terbitan aktif</div>
    </div>

    <div class="metric-card" style="--card-accent: var(--admin-gold);">
      <div class="metric-head">
        <span class="metric-label">Program CSR</span>
        <div class="metric-icon-wrap" style="color: var(--admin-gold);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg>
        </div>
      </div>
      <div class="metric-val"><?= $csrCount ?></div>
      <div class="metric-sub">Inisiatif sosial &amp; bina lingkungan</div>
    </div>

    <div class="metric-card" style="--card-accent: var(--admin-gold);">
      <div class="metric-head">
        <span class="metric-label">Berita Operasional</span>
        <div class="metric-icon-wrap" style="color: var(--admin-gold);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"></path>
            <path d="M15 18H9"></path>
            <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14v10Z"></path>
            <circle cx="17" cy="18.5" r="2.5"></circle><circle cx="7" cy="18.5" r="2.5"></circle>
          </svg>
        </div>
      </div>
      <div class="metric-val"><?= $opCount ?></div>
      <div class="metric-sub">Rantai pasok &amp; logistik maritim</div>
    </div>

    <div class="metric-card" style="--card-accent: var(--admin-gold);">
      <div class="metric-head">
        <span class="metric-label">Total Pembaca</span>
        <div class="metric-icon-wrap" style="color: var(--admin-gold);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 3v18h18"></path>
            <path d="M18 17V9"></path><path d="M13 17V5"></path><path d="M8 17v-3"></path>
          </svg>
        </div>
      </div>
      <div class="metric-val"><?= number_format($totalViews) ?></div>
      <div class="metric-sub">Akumulasi tayangan artikel</div>
    </div>
  </div>

  <!-- Articles Table Container -->
  <div class="admin-card">
    
    <!-- Interactive Search & Filter Toolbar -->
    <div class="toolbar-row">
      <div class="filter-pills" role="tablist" aria-label="Filter Kategori">
        <button type="button" class="filter-btn active" role="tab" id="tab-cat-all" aria-selected="true" aria-controls="articlesTable" tabindex="0" data-category="ALL">
          <span>Semua</span>
          <span class="filter-count" id="countAll"><?= $totalArticles ?></span>
        </button>
        <button type="button" class="filter-btn" role="tab" id="tab-cat-csr" aria-selected="false" aria-controls="articlesTable" tabindex="-1" data-category="CSR">
          <span>CSR</span>
          <span class="filter-count"><?= $csrCount ?></span>
        </button>
        <button type="button" class="filter-btn" role="tab" id="tab-cat-op" aria-selected="false" aria-controls="articlesTable" tabindex="-1" data-category="Operasional">
          <span>Operasional</span>
          <span class="filter-count"><?= $opCount ?></span>
        </button>
        <?php if ($regCount > 0): ?>
          <button type="button" class="filter-btn" role="tab" id="tab-cat-reg" aria-selected="false" aria-controls="articlesTable" tabindex="-1" data-category="Regulasi">
            <span>Regulasi</span>
            <span class="filter-count"><?= $regCount ?></span>
          </button>
        <?php endif; ?>
      </div>

      <div class="search-box-wrap">
        <span class="search-icon" aria-hidden="true">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </span>
        <input type="text" id="articleSearchInput" class="search-input" placeholder="Cari judul artikel atau slug..." aria-label="Cari artikel">
      </div>
    </div>

    <?php if (empty($articles)): ?>
      <div style="text-align: center; color: #94a3b8; padding: 50px 20px;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 12px; opacity: 0.5;">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
        </svg>
        <p style="margin: 0; font-size: 0.95rem;">Belum ada artikel publikasi yang terdaftar.</p>
        <p style="margin: 6px 0 0; font-size: 0.8rem; color: #64748b;">Klik tombol di atas untuk membuat artikel pertama Anda.</p>
      </div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="admin-table" id="articlesTable">
          <thead>
            <tr>
              <th style="width: 50px;">No</th>
              <th>Judul Publikasi</th>
              <th style="width: 140px;">Kategori</th>
              <th style="width: 130px;">Tanggal Rilis</th>
              <th style="width: 100px;">Status</th>
              <th style="width: 90px;">Dilihat</th>
              <th style="width: 185px; text-align: right;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($articles as $idx => $art): ?>
              <tr class="article-row" data-title="<?= strtolower(htmlspecialchars($art['title'])) ?>" data-slug="<?= strtolower(htmlspecialchars($art['slug'])) ?>" data-category="<?= htmlspecialchars($art['category']) ?>">
                <td class="col-idx">#<?= sprintf('%02d', $idx + 1) ?></td>
                <td class="art-title-cell">
                  <a href="/berita/<?= urlencode($art['slug']) ?>" target="_blank" class="art-title-link">
                    <?= htmlspecialchars($art['title']) ?>
                  </a>
                  <div class="art-slug-box">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                      <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                    </svg>
                    <span>/berita/<?= htmlspecialchars($art['slug']) ?></span>
                  </div>
                </td>
                <td>
                  <?php if ($art['category'] === 'CSR'): ?>
                    <span class="badge-cat badge-csr"><span class="badge-dot"></span>CSR</span>
                  <?php elseif ($art['category'] === 'Operasional'): ?>
                    <span class="badge-cat badge-op"><span class="badge-dot"></span>Operasional</span>
                  <?php else: ?>
                    <span class="badge-cat badge-reg"><span class="badge-dot"></span><?= htmlspecialchars($art['category']) ?></span>
                  <?php endif; ?>
                </td>
                <td>
                  <span style="color: #94a3b8; font-size: 0.82rem; white-space: nowrap; font-variant-numeric: tabular-nums;">
                    <?= date('d M Y', strtotime($art['created_at'])) ?>
                  </span>
                </td>
                <td>
                  <span class="status-pill">
                    <span class="status-pill-dot"></span>
                    <span>Terbit</span>
                  </span>
                </td>
                <td>
                  <span class="views-chip">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                      <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <span><?= number_format($art['views']) ?></span>
                  </span>
                </td>
                <td>
                  <div class="action-group">
                    <a href="/berita/<?= urlencode($art['slug']) ?>" target="_blank" class="btn-action btn-action-view" title="Lihat di Website">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                      </svg>
                      <span>Lihat</span>
                    </a>
                    <a href="artikel-edit.php?id=<?= $art['id'] ?>" class="btn-action btn-action-edit" title="Edit Artikel">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                      </svg>
                      <span>Edit</span>
                    </a>
                    <form method="POST" action="artikel-hapus.php" class="form-action-delete" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.');">
                      <input type="hidden" name="id" value="<?= $art['id'] ?>">
                      <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
                      <button type="submit" class="btn-action btn-action-delete" title="Hapus Artikel">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <polyline points="3 6 5 6 21 6"></polyline>
                          <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        <span>Hapus</span>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- No matching search result indicator -->
      <div id="noSearchMatch" style="display: none; text-align: center; color: #94a3b8; padding: 40px 20px;">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 8px; opacity: 0.5;">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <p style="margin: 0; font-size: 0.90rem;">Tidak ada artikel yang cocok dengan pencarian.</p>
      </div>
    <?php endif; ?>

  </div>

</main>

<script>
  // Real-Time Client-Side Filter & Search
  (function() {
    const searchInput = document.getElementById('articleSearchInput');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const rows = document.querySelectorAll('.article-row');
    const noMatch = document.getElementById('noSearchMatch');

    let currentCategory = 'ALL';
    let searchQuery = '';

    function applyFilters() {
      let visibleCount = 0;

      rows.forEach(row => {
        const title = row.getAttribute('data-title') || '';
        const slug = row.getAttribute('data-slug') || '';
        const category = row.getAttribute('data-category') || '';

        const matchesCategory = (currentCategory === 'ALL' || category.toLowerCase() === currentCategory.toLowerCase());
        const matchesSearch = (!searchQuery || title.includes(searchQuery) || slug.includes(searchQuery));

        if (matchesCategory && matchesSearch) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      if (noMatch) {
        noMatch.style.display = (visibleCount === 0 && rows.length > 0) ? 'block' : 'none';
      }
    }

    // Accessible Filter Tabs: Click & WAI-ARIA Sync with Keyboard Navigation
    function selectTab(btn, shouldFocus = false) {
      if (!btn) return;
      filterButtons.forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-selected', 'false');
        b.setAttribute('tabindex', '-1');
      });
      btn.classList.add('active');
      btn.setAttribute('aria-selected', 'true');
      btn.setAttribute('tabindex', '0');
      if (shouldFocus) {
        btn.focus();
      }
      currentCategory = btn.getAttribute('data-category') || 'ALL';
      applyFilters();
    }

    filterButtons.forEach((btn, index) => {
      btn.addEventListener('click', function() {
        selectTab(this, false);
      });

      // Keyboard navigation for WAI-ARIA tabs (ArrowLeft, ArrowRight, Home, End)
      btn.addEventListener('keydown', function(e) {
        let targetIndex = index;
        if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
          e.preventDefault();
          targetIndex = (index + 1) % filterButtons.length;
          selectTab(filterButtons[targetIndex], true);
        } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
          e.preventDefault();
          targetIndex = (index - 1 + filterButtons.length) % filterButtons.length;
          selectTab(filterButtons[targetIndex], true);
        } else if (e.key === 'Home') {
          e.preventDefault();
          selectTab(filterButtons[0], true);
        } else if (e.key === 'End') {
          e.preventDefault();
          selectTab(filterButtons[filterButtons.length - 1], true);
        }
      });
    });

    // Search Input handler
    if (searchInput) {
      searchInput.addEventListener('input', function(e) {
        searchQuery = e.target.value.trim().toLowerCase();
        applyFilters();
      });
    }
  })();
</script>

</body>
</html>
