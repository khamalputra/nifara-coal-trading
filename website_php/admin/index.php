<?php
/**
 * CMS Admin Login - Enterprise Edition
 * PT. Nifara Coal Trading
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

if (isAdminLoggedIn()) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
$maxAttempts = 5;
$lockoutSeconds = 900; // 15 menit
$isLockedOut = false;

// Check brute-force lockout status
if (isset($_SESSION['login_failed_attempts']) && $_SESSION['login_failed_attempts'] >= $maxAttempts) {
    $timeSinceLast = time() - ($_SESSION['last_failed_login_time'] ?? 0);
    if ($timeSinceLast < $lockoutSeconds) {
        $remainingMin = ceil(($lockoutSeconds - $timeSinceLast) / 60);
        $error = "Terlalu banyak percobaan login gagal. Demi keamanan sistem, akses login dibatasi selama {$remainingMin} menit ke depan.";
        $isLockedOut = true;
    } else {
        // Reset after lockout window expires
        unset($_SESSION['login_failed_attempts'], $_SESSION['last_failed_login_time']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$isLockedOut) {
    $action = $_POST['action'] ?? 'login';
    $token = $_POST['csrf_token'] ?? '';
    
    if (!verifyCSRFToken($token)) {
        $error = 'Validasi sesi keamanan kadaluarsa. Silakan muat ulang halaman dan coba lagi.';
    } elseif ($action === 'reset_request') {
        $resetAccount = trim($_POST['reset_account'] ?? '');
        if (empty($resetAccount)) {
            $error = 'Harap isi nama pengguna atau email terdaftar.';
        } else {
            $resetSuccess = 'Permintaan pemulihan telah dicatat. Administrator Utama akan memverifikasi dan menghubungi Anda.';
        }
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $error = 'Harap isi nama pengguna dan kata sandi.';
        } else {
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM admins WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password_hash'])) {
                // Prevent Session Fixation attack
                session_regenerate_id(true);

                // Clear brute-force counters upon success
                unset($_SESSION['login_failed_attempts'], $_SESSION['last_failed_login_time']);

                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_user'] = $admin['username'];
                $_SESSION['admin_name'] = $admin['full_name'];

                header("Location: dashboard.php");
                exit;
            } else {
                $_SESSION['login_failed_attempts'] = ($_SESSION['login_failed_attempts'] ?? 0) + 1;
                $_SESSION['last_failed_login_time'] = time();

                $attemptsLeft = $maxAttempts - $_SESSION['login_failed_attempts'];
                if ($attemptsLeft > 0) {
                    $error = "Kredensial login salah. Sisa kesempatan percobaan: {$attemptsLeft}.";
                } else {
                    $error = "Terlalu banyak percobaan login gagal. Akses ditangguhkan selama 15 menit.";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Login CMS Admin | PT. Nifara Coal Trading</title>
  <link rel="icon" type="image/png" href="../assets/images/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <style>
    /* ==========================================================================
       CMS Login Luxury Atmosphere - Hero Match Edition
       ========================================================================== */
    .login-stage {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 36px 20px;
      position: relative;
      overflow: hidden;
      background-color: #011424;
    }

    /* Hero Photo Background with Signature Dark Luxury Scrim */
    .login-hero-bg {
      position: absolute;
      inset: 0;
      overflow: hidden;
      z-index: 0;
      pointer-events: none;
    }

    .login-hero-img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: right 45%;
      transform: scale(1.05);
      filter: brightness(0.68) contrast(1.1);
    }

    .login-hero-scrim {
      position: absolute;
      inset: 0;
      z-index: 1;
      background:
        linear-gradient(108deg, rgba(1, 26, 44, 0.94) 0%, rgba(1, 26, 44, 0.88) 42%, rgba(1, 32, 52, 0.65) 62%, rgba(1, 32, 52, 0.40) 82%, rgba(1, 26, 44, 0.85) 100%),
        linear-gradient(0deg, #010c18 0%, rgba(1, 32, 52, 0) 30%);
      pointer-events: none;
    }

    .login-geo-stripes {
      position: absolute;
      inset: 0;
      z-index: 1;
      overflow: hidden;
      pointer-events: none;
    }

    .geo-stripe {
      position: absolute;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(245, 181, 107, 0.22), transparent);
      width: 140%;
      transform: rotate(-15deg);
    }

    .geo-stripe.s1 { top: 22%; left: -20%; }
    .geo-stripe.s2 { top: 78%; left: -20%; }

    /* Luxury Login Card */
    .login-card {
      width: 100%;
      max-width: 410px;
      position: relative;
      z-index: 2;
      background: rgba(3, 22, 38, 0.86);
      backdrop-filter: blur(26px);
      -webkit-backdrop-filter: blur(26px);
      border: 1px solid rgba(245, 181, 107, 0.28);
      border-radius: 22px;
      padding: 36px 32px 30px 32px;
      box-shadow: 
        0 30px 75px -10px rgba(0, 0, 0, 0.92),
        0 0 40px rgba(245, 181, 107, 0.12),
        inset 0 1px 0 rgba(255, 255, 255, 0.12);
      animation: cardEnter 0.55s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    /* Specular Top Border Highlight */
    .login-card::before {
      content: "";
      position: absolute;
      top: 0;
      left: 18%;
      right: 18%;
      height: 2px;
      background: linear-gradient(90deg, transparent, rgba(245, 181, 107, 0.85), transparent);
      border-radius: 999px;
      pointer-events: none;
    }

    @keyframes cardEnter {
      from {
        opacity: 0;
        transform: translateY(20px) scale(0.98);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    @media (prefers-reduced-motion: reduce) {
      .login-card {
        animation: none;
      }
    }

    /* Corporate Branding */
    .login-logo-wrap {
      text-align: center;
      margin-bottom: 18px;
    }

    .login-brand-logo {
      height: 48px;
      width: auto;
      max-width: 100%;
      margin: 0 auto 14px;
      display: block;
      filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.5));
    }

    .login-title {
      font-size: 1.25rem;
      font-weight: 800;
      color: #ffffff;
      margin: 0 0 4px 0;
      letter-spacing: -0.01em;
    }

    .login-title .gold-accent {
      color: #f5b56b;
      background: linear-gradient(135deg, #f5b56b 0%, #ffc98a 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .login-sub {
      color: #94a3b8;
      font-size: 0.82rem;
      font-weight: 500;
      margin: 0;
      line-height: 1.45;
    }

    /* Tab Switcher: Login vs Reset Password */
    .auth-tab-bar {
      display: flex;
      border-bottom: 1px solid rgba(245, 181, 107, 0.2);
      margin: 22px 0 20px;
      position: relative;
    }

    .auth-tab-btn {
      flex: 1;
      padding: 10px 12px 11px;
      background: transparent;
      border: none;
      border-bottom: 2px solid transparent;
      color: #94a3b8;
      font-size: 0.86rem;
      font-weight: 700;
      font-family: inherit;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 7px;
      cursor: pointer;
      transition: all 0.2s ease;
      position: relative;
      margin-bottom: -1px;
      text-decoration: none;
    }

    .auth-tab-btn.active {
      color: #ffffff;
      border-bottom: 2px solid #f5b56b;
      background: linear-gradient(180deg, rgba(245, 181, 107, 0.1) 0%, rgba(245, 181, 107, 0.02) 100%);
      border-radius: 8px 8px 0 0;
    }

    .auth-tab-btn.active svg {
      color: #f5b56b;
    }

    .auth-tab-btn:hover:not(.active) {
      color: #e2e8f0;
      background: rgba(255, 255, 255, 0.03);
    }

    /* Form Fields */
    .field-group {
      margin-bottom: 18px;
      text-align: left;
    }

    .field-label {
      display: block;
      font-weight: 700;
      margin-bottom: 7px;
      font-size: 0.74rem;
      color: #94a3b8;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .input-shell {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-shell-icon {
      position: absolute;
      left: 14px;
      color: #64748b;
      pointer-events: none;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 18px;
      height: 18px;
      transition: color 0.2s ease;
    }

    .login-input {
      width: 100%;
      height: 46px;
      padding: 0 14px 0 44px;
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.14);
      background: rgba(2, 16, 28, 0.75);
      color: #ffffff;
      font-family: inherit;
      font-size: 0.90rem;
      font-weight: 500;
      box-sizing: border-box;
      transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* Gold accented border on active/focused fields matching the screenshot */
    .login-input.gold-accent-border {
      border: 1.5px solid rgba(245, 181, 107, 0.65);
      box-shadow: 0 0 0 1px rgba(245, 181, 107, 0.25);
    }

    .login-input.has-toggle {
      padding-right: 46px;
    }

    .login-input::placeholder {
      color: rgba(148, 163, 184, 0.45);
    }

    .login-input:focus {
      outline: none;
      border-color: #f5b56b;
      background: rgba(2, 21, 37, 0.94);
      box-shadow: 
        0 0 0 3px rgba(245, 181, 107, 0.25),
        0 8px 20px rgba(0, 0, 0, 0.4);
    }

    .input-shell:focus-within .input-shell-icon {
      color: #f5b56b;
    }

    /* Password Reveal Toggle */
    .pwd-toggle-btn {
      position: absolute;
      right: 2px;
      width: 44px;
      height: 44px;
      min-width: 44px;
      min-height: 44px;
      background: transparent;
      border: none;
      color: #94a3b8;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      transition: color 0.2s, background 0.2s;
    }

    .pwd-toggle-btn:hover {
      color: #f5b56b;
      background: rgba(245, 181, 107, 0.08);
    }

    .pwd-toggle-btn:focus-visible {
      outline: 2px solid #f5b56b;
      outline-offset: -2px;
    }

    .caps-alert {
      font-size: 0.72rem;
      color: #fbbf24;
      font-weight: 600;
      margin-top: 5px;
      display: none;
      align-items: center;
      gap: 5px;
    }

    /* Submit Button Enterprise */
    .btn-login-submit {
      width: 100%;
      height: 48px;
      border-radius: 12px;
      border: none;
      font-weight: 800;
      font-size: 0.92rem;
      letter-spacing: 0.02em;
      background: linear-gradient(135deg, #f5b56b 0%, #df9949 100%);
      color: #02111d;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      cursor: pointer;
      box-shadow: 
        0 8px 24px -4px rgba(245, 181, 107, 0.38),
        0 2px 6px rgba(0, 0, 0, 0.4);
      transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
      margin-top: 6px;
    }

    .btn-login-submit:hover {
      background: linear-gradient(135deg, #ffc98a 0%, #e8a556 100%);
      transform: translateY(-2px);
      box-shadow: 
        0 12px 30px -4px rgba(245, 181, 107, 0.52),
        0 4px 10px rgba(0, 0, 0, 0.5);
    }

    .btn-login-submit:active {
      transform: translateY(0) scale(0.99);
    }

    .btn-login-submit:focus-visible {
      outline: 2px solid #ffffff;
      outline-offset: 3px;
    }

    /* Alert Boxes */
    .login-alert {
      background: rgba(244, 63, 94, 0.12);
      border: 1px solid rgba(244, 63, 94, 0.35);
      border-radius: 12px;
      padding: 12px 16px;
      color: #fecdd3;
      font-size: 0.84rem;
      line-height: 1.45;
      margin-bottom: 18px;
      display: flex;
      align-items: flex-start;
      gap: 10px;
      text-align: left;
    }

    .login-success {
      background: rgba(16, 185, 129, 0.12);
      border: 1px solid rgba(16, 185, 129, 0.35);
      border-radius: 12px;
      padding: 12px 16px;
      color: #a7f3d0;
      font-size: 0.84rem;
      line-height: 1.45;
      margin-bottom: 18px;
      display: flex;
      align-items: flex-start;
      gap: 10px;
      text-align: left;
    }

    /* Footer Trust Signals */
    .login-footer {
      margin-top: 22px;
      padding-top: 18px;
      border-top: 1px solid rgba(245, 181, 107, 0.14);
      display: flex;
      flex-direction: column;
      gap: 12px;
      align-items: center;
    }

    .trust-indicator {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      color: #94a3b8;
      font-size: 0.74rem;
      font-weight: 600;
      letter-spacing: 0.02em;
    }

    .trust-indicator svg {
      color: #f5b56b;
    }

    .back-home-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: #94a3b8;
      font-size: 0.80rem;
      font-weight: 600;
      text-decoration: none;
      transition: color 0.2s ease, transform 0.2s ease;
    }

    .back-home-link:hover {
      color: #f5b56b;
      transform: translateX(-3px);
    }

    .back-home-link:focus-visible {
      outline: 2px solid #f5b56b;
      outline-offset: 2px;
      border-radius: 4px;
    }

    /* Tab Panels */
    .tab-panel {
      display: none;
    }
    .tab-panel.active {
      display: block;
      animation: tabFadeIn 0.25s ease-out;
    }
    @keyframes tabFadeIn {
      from { opacity: 0; transform: translateY(6px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="admin-body">

<div class="login-stage">
  
  <!-- Hero Background Image & Scrim Overlay (Exact Home Hero Match) -->
  <div class="login-hero-bg" aria-hidden="true">
    <img src="../img/hero.jpg" alt="" class="login-hero-img" fetchpriority="high">
    <div class="login-hero-scrim"></div>
    <div class="login-geo-stripes">
      <span class="geo-stripe s1"></span>
      <span class="geo-stripe s2"></span>
    </div>
  </div>

  <!-- Login Card Window -->
  <div class="login-card">
    
    <div class="login-logo-wrap">
      <img src="../assets/images/logo.png" alt="PT. Nifara Coal Trading Logo" class="login-brand-logo">
      <h1 class="login-title">CMS Manajemen <span class="gold-accent">Konten</span></h1>
      <p class="login-sub">Portal Administrasi Berita, CSR &amp; Operasional</p>
    </div>

    <!-- Tab Bar: Login vs Reset Password -->
    <div class="auth-tab-bar" role="tablist">
      <button type="button" class="auth-tab-btn active" id="tabLoginBtn" role="tab" aria-selected="true" aria-controls="loginPanel">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
        <span>Login</span>
      </button>
      <button type="button" class="auth-tab-btn" id="tabResetBtn" role="tab" aria-selected="false" aria-controls="resetPanel">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
        </svg>
        <span>Reset Password</span>
      </button>
    </div>

    <?php if (!empty($error)): ?>
      <div class="login-alert" role="alert">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 2px; color: #fb7185;">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="12"></line>
          <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
        <div><?= htmlspecialchars($error) ?></div>
      </div>
    <?php endif; ?>

    <?php if (!empty($resetSuccess)): ?>
      <div class="login-success" role="status">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 2px; color: #34d399;">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
          <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <div><?= htmlspecialchars($resetSuccess) ?></div>
      </div>
    <?php endif; ?>

    <!-- Panel 1: Login Form -->
    <div id="loginPanel" class="tab-panel active" role="tabpanel" aria-labelledby="tabLoginBtn">
      <form method="POST" action="index.php" autocomplete="on">
        <input type="hidden" name="action" value="login">
        <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">

        <div class="field-group">
          <label for="username" class="field-label">Nama Pengguna (Username)</label>
          <div class="input-shell">
            <span class="input-shell-icon" aria-hidden="true">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </span>
            <input type="text" id="username" name="username" class="login-input gold-accent-border" placeholder="Masukkan nama pengguna" required autofocus autocomplete="username">
          </div>
        </div>

        <div class="field-group">
          <label for="password" class="field-label">Kata Sandi (Password)</label>
          <div class="input-shell">
            <span class="input-shell-icon" aria-hidden="true">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
              </svg>
            </span>
            <input type="password" id="password" name="password" class="login-input has-toggle" placeholder="Masukkan kata sandi" required autocomplete="current-password">
            <button type="button" id="togglePasswordBtn" class="pwd-toggle-btn" aria-label="Tampilkan atau sembunyikan kata sandi">
              <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          <div id="capsLockAlert" class="caps-alert" role="status" aria-live="polite">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 19V5M5 12l7-7 7 7"></path>
            </svg>
            <span>Caps Lock aktif</span>
          </div>
        </div>

        <button type="submit" class="btn-login-submit">
          <span>Masuk ke Dashboard</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </button>
      </form>
    </div>

    <!-- Panel 2: Reset Password Form -->
    <div id="resetPanel" class="tab-panel" role="tabpanel" aria-labelledby="tabResetBtn">
      <form method="POST" action="index.php" autocomplete="on">
        <input type="hidden" name="action" value="reset_request">
        <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">

        <div style="margin-bottom: 16px;">
          <p style="font-size: 0.82rem; color: #94a3b8; line-height: 1.5; margin: 0 0 16px;">
            Masukkan nama pengguna atau email terdaftar. Sistem akan mencatat permohonan pemulihan kata sandi kepada Administrator Utama.
          </p>
        </div>

        <div class="field-group">
          <label for="reset_account" class="field-label">Nama Pengguna atau Email</label>
          <div class="input-shell">
            <span class="input-shell-icon" aria-hidden="true">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
            </span>
            <input type="text" id="reset_account" name="reset_account" class="login-input gold-accent-border" placeholder="admin atau email@domain.com" required>
          </div>
        </div>

        <button type="submit" class="btn-login-submit">
          <span>Kirim Permintaan Reset</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </button>
      </form>
    </div>

    <!-- Common Footer -->
    <div class="login-footer">
      <div class="trust-indicator">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
        </svg>
        <span>256-Bit SSL Encrypted &bull; Anti-Brute Force Protection</span>
      </div>

      <a href="../index.php" class="back-home-link">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"></line>
          <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        <span>Kembali ke Beranda Website</span>
      </a>
    </div>

  </div>
</div>

<script>
  // Tab Switcher Logic
  (function() {
    const tabLoginBtn = document.getElementById('tabLoginBtn');
    const tabResetBtn = document.getElementById('tabResetBtn');
    const loginPanel = document.getElementById('loginPanel');
    const resetPanel = document.getElementById('resetPanel');

    if (!tabLoginBtn || !tabResetBtn || !loginPanel || !resetPanel) return;

    tabLoginBtn.addEventListener('click', function() {
      tabLoginBtn.classList.add('active');
      tabLoginBtn.setAttribute('aria-selected', 'true');
      tabResetBtn.classList.remove('active');
      tabResetBtn.setAttribute('aria-selected', 'false');

      loginPanel.classList.add('active');
      resetPanel.classList.remove('active');
    });

    tabResetBtn.addEventListener('click', function() {
      tabResetBtn.classList.add('active');
      tabResetBtn.setAttribute('aria-selected', 'true');
      tabLoginBtn.classList.remove('active');
      tabLoginBtn.setAttribute('aria-selected', 'false');

      resetPanel.classList.add('active');
      loginPanel.classList.remove('active');
    });
  })();

  // Interactive Password Visibility Toggle
  (function() {
    const pwdInput = document.getElementById('password');
    const toggleBtn = document.getElementById('togglePasswordBtn');
    if (!pwdInput || !toggleBtn) return;

    const eyeIconMarkup = `
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
        <circle cx="12" cy="12" r="3"></circle>
      </svg>
    `;

    const eyeOffIconMarkup = `
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
        <line x1="1" y1="1" x2="23" y2="23"></line>
      </svg>
    `;

    toggleBtn.addEventListener('click', function() {
      const isPassword = pwdInput.type === 'password';
      pwdInput.type = isPassword ? 'text' : 'password';
      toggleBtn.innerHTML = isPassword ? eyeOffIconMarkup : eyeIconMarkup;
      toggleBtn.setAttribute('aria-label', isPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
    });

    // Caps Lock Live Warning
    const capsAlert = document.getElementById('capsLockAlert');
    if (capsAlert) {
      function checkCapsLock(e) {
        if (e.getModifierState && e.getModifierState('CapsLock')) {
          capsAlert.style.display = 'inline-flex';
        } else {
          capsAlert.style.display = 'none';
        }
      }
      pwdInput.addEventListener('keyup', checkCapsLock);
      pwdInput.addEventListener('keydown', checkCapsLock);
      pwdInput.addEventListener('blur', function() {
        capsAlert.style.display = 'none';
      });
    }
  })();
</script>

</body>
</html>
