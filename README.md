# PT. Nifara Coal Trading - Official Website & CMS

Situs resmi dan sistem manajemen konten (CMS) PT. Nifara Coal Trading, perusahaan perdagangan dan logistik batu bara berizin resmi (IUP OPK / KBLI 46710) di Indonesia.

---

## Struktur Direktori

```text
├── website_php/              # Aplikasi web utama (target root public_html cPanel)
│   ├── admin/                # Portal CMS Admin (Dashboard, Kelola Berita, Akun)
│   ├── assets/               # File CSS, JavaScript, dan vendor library
│   ├── berita/               # Modul halaman indeks dan artikel berita publik
│   ├── config/               # Konfigurasi database & autentikasi sesi
│   │   ├── database.php      # Koneksi database (Auto-detect MySQL cPanel / SQLite)
│   │   └── auth.php          # Session guard & middleware keamanan
│   ├── data/                 # Penyimpanan data lokal (dilindungi .htaccess)
│   ├── img/                  # Aset gambar, logo, ikon, dan media profil
│   ├── includes/             # Template parsial modular (header.php, footer.php)
│   ├── uploads/              # Direktori upload media artikel/berita
│   ├── .htaccess             # Aturan rewrite, security headers, dan proteksi berkas
│   ├── 404.php               # Halaman error responsif
│   ├── index.php             # Beranda utama korporat
│   ├── robots.txt            # Aturan perayapan mesin pencari (SEO)
│   ├── sitemap.xml           # Peta situs terindeks Google
│   └── router.php            # Router untuk server uji coba PHP CLI lokal
├── database.sql              # Skema database MySQL & data awal untuk cPanel phpMyAdmin
└── .gitignore                # Berkas pengecualian Git
```

---

## Panduan Hosting ke Rumahweb (cPanel)

### 1. Persiapan Database MySQL di cPanel
1. Masuk ke cPanel Rumahweb Anda.
2. Buka menu **MySQL Databases**:
   - Buat database baru (contoh: `u1234567_nifara_db`).
   - Buat pengguna MySQL baru (contoh: `u1234567_nifara_user`) beserta *password* yang kuat.
   - Tambahkan pengguna ke database tersebut dengan hak akses **ALL PRIVILEGES**.
3. Buka menu **phpMyAdmin**:
   - Pilih database yang baru dibuat.
   - Masuk ke tab **Import**.
   - Pilih berkas `database.sql` dari repositori ini, lalu klik **Import**.

### 2. Pengunggahan Berkas Web (*Upload Files*)
1. Di cPanel, buka **File Manager** dan masuk ke direktori `public_html`.
2. Unggah seluruh isi berkas dan folder yang ada di dalam folder `website_php/` langsung ke dalam `public_html` (bukan folder `website_php`-nya, melainkan isinya agar `index.php` berada langsung di root `public_html`).
3. Pastikan izin akses folder:
   - Folder: `0755`
   - Berkas: `0644`
   - Folder `uploads/`: Pastikan memiliki izin tulis (`0755` atau `0775`).

### 3. Konfigurasi Koneksi Database
Buka berkas `config/database.php` di cPanel File Manager (atau atur via *Environment Variables*):
Sesuaikan nilai kredensial:
```php
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'u1234567_nifara_db');
define('DB_USER', 'u1234567_nifara_user');
define('DB_PASS', 'PasswordDatabaseAnda');
```

### 4. Aktivasi SSL (HTTPS)
1. Buka menu **SSL/TLS Status** di cPanel.
2. Pastikan sertifikat AutoSSL (Let's Encrypt / cPanel) telah aktif untuk domain `nifaracoaltrading.co.id`.
3. Pengalihan HTTP ke HTTPS sudah otomatis ditangani oleh berkas `.htaccess`.

---

## Menjalankan di Lingkungan Lokal (*Development*)

Prasyarat: PHP versi 8.1 atau lebih tinggi.

```bash
# Masuk ke direktori website_php
cd website_php

# Jalankan server bawaan PHP dengan router
php -S 127.0.0.1:8000 router.php
```

Buka peramban di: `http://127.0.0.1:8000`  
Portal Admin CMS: `http://127.0.0.1:8000/admin/login.php`
