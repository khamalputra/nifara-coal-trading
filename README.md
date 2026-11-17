# PT. Nifara Coal Trading - Official Website & CMS

Situs resmi dan sistem manajemen konten (CMS) PT. Nifara Coal Trading, perusahaan perdagangan dan logistik batu bara berizin resmi (IUP OPK / KBLI 46710) di Indonesia.

---

## Struktur Direktori

```text
├── website_php/              # Aplikasi web utama (target root web server / public_html)
│   ├── admin/                # Portal CMS Admin (Dashboard, Kelola Publikasi & CSR)
│   ├── assets/               # Aset CSS, JavaScript, dan vendor library
│   ├── berita/               # Modul halaman indeks dan artikel berita publik
│   ├── config/               # Konfigurasi database & autentikasi sesi
│   │   ├── database.php      # Koneksi database (Auto-detect MySQL / Portable SQLite)
│   │   └── auth.php          # Session guard, proteksi CSRF & sanitizer konten
│   ├── data/                 # Penyimpanan database lokal (dilindungi .htaccess)
│   ├── img/                  # Aset gambar, logo perusahaan, dan media profil
│   ├── includes/             # Template parsial modular (header.php, footer.php)
│   ├── uploads/              # Direktori upload media artikel/berita
│   ├── .htaccess             # Aturan rewrite, security headers, dan proteksi berkas
│   ├── 404.php               # Halaman error responsif
│   ├── index.php             # Beranda utama korporat
│   ├── robots.txt            # Aturan perayapan mesin pencari (SEO)
│   ├── sitemap.xml           # Peta situs XML terindeks Google
│   └── router.php            # Router untuk server uji coba PHP CLI lokal
├── database.sql              # Skema DDL MySQL untuk deployment server produksi
├── .env.example              # Template variabel lingkungan (Environment Variables)
└── .gitignore                # Berkas pengecualian Git
```

---

## Menjalankan di Lingkungan Lokal (*Development*)

Sistem dirancang dengan fitur *zero-config portable SQLite* sehingga dapat langsung dijalankan tanpa perlu mengonfigurasi database tambahan.

**Prasyarat:** PHP versi 8.1 atau lebih tinggi dengan ekstensi `pdo_sqlite` aktif.

```bash
# 1. Masuk ke direktori website_php
cd website_php

# 2. Jalankan server bawaan PHP menggunakan router
php -S 127.0.0.1:8000 router.php
```

* **Beranda Website**: `http://127.0.0.1:8000`
* **Portal Admin CMS**: `http://127.0.0.1:8000/admin/`

> **Inisialisasi Pertama Kali:** Saat pertama kali mengakses `/admin/`, sistem akan menampilkan wizard aman untuk membuat akun Administrator Utama pertama Anda.

---

## Panduan Deployment Server Produksi (MySQL / LAMP / cPanel)

### 1. Impor Skema Basis Data
1. Buat basis data MySQL kosong di server hosting Anda.
2. Buat pengguna basis data dengan hak akses penuh ke basis data tersebut.
3. Buka phpMyAdmin (atau terminal MySQL), pilih basis data Anda, lalu impor berkas [`database.sql`](database.sql).

### 2. Pengunggahan Berkas Web
1. Salin seluruh isi di dalam direktori `website_php/` langsung ke direktori dokumen web server Anda (misal: `public_html` atau `/var/www/html`).
2. Pastikan izin akses berkas dan folder:
   * Direktori: `0755`
   * Berkas PHP / CSS / JS: `0644`
   * Direktori `uploads/`: Pastikan memiliki izin tulis (`0755` atau `0775`).

### 3. Konfigurasi Kredensial Basis Data
Aplikasi mendukung konfigurasi fleksibel melalui *Environment Variables* di server Anda:

| Variabel | Deskripsi | Nilai Default |
|---|---|---|
| `DB_HOST` | Host server database | `localhost` |
| `DB_PORT` | Port server database | `3306` |
| `DB_NAME` | Nama database MySQL | (Kustom server Anda) |
| `DB_USER` | Nama pengguna database | (Kustom server Anda) |
| `DB_PASS` | Kata sandi database | (Kustom server Anda) |

*Contoh konfigurasi dapat merujuk pada berkas [`.env.example`](.env.example).*

### 4. Aktivasi Sertifikat SSL (HTTPS)
Pastikan sertifikat SSL (Let's Encrypt atau AutoSSL) telah aktif pada domain Anda. Pengalihan otomatis HTTP ke HTTPS serta *Security Headers* (HSTS, X-Content-Type-Options, X-Frame-Options) telah dikonfigurasi melalui berkas `.htaccess`.

---

## Lisensi & Hak Cipta

&copy; 2026 PT. Nifara Coal Trading. Hak cipta dilindungi undang-undang.
