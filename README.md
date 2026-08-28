# 📚 E-Repository System

<p align="center">
  <img src="public/favicon.svg" alt="E-Repository Logo" width="80" height="80">
</p>

<p align="center">
  <strong>Sistem Repositori Digital & Manajemen Dokumen Akademik Terpusat</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/Livewire-3.x-FB70A9?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire 3">
  <img src="https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white" alt="Alpine.js">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

---

## 📖 Tentang Aplikasi

**E-Repository** adalah aplikasi berbasis web modern yang dirancang untuk mengarsipkan, mengelola, dan mempublikasikan karya ilmiah dan dokumen akademik secara terpusat (seperti skripsi, tesis, jurnal, tugas akhir, dan laporan penelitian). 

Dibangun dengan **Laravel 12**, **Livewire 3**, dan antarmuka bertema **Neobrutalism** yang responsif, aplikasi ini memberikan pengalaman pencarian yang interaktif dan cepat untuk publik, serta panel administrasi yang lengkap untuk pengelolaan data dokumen, kategori, pengguna, dan pengaturan sistem.

---

## ✨ Fitur Utama

### 🌐 1. Portal Publik (Frontend)
- 🔍 **Pencarian Real-Time**: Pencarian cepat dokumen berdasarkan judul, penulis, abstrak, atau institusi secara dinamis tanpa reload halaman.
- 🏷️ **Filter & Sorting**: Penyaringan dokumen berdasarkan kategori, tahun publikasi, dan urutan (*Terbaru*, *Terlama*, *A-Z*, *Paling Banyak Diunduh*).
- 📄 **Halaman Detail Dokumen**: Menampilkan abstrak lengkap, rincian metadata dokumen, badge status, dan counter jumlah unduhan (*download count*).
- 📥 **Unduh Dokumen PDF**: Akses langsung file dokumen dengan pelacakan statistik unduhan otomatis.
- 📱 **Desain Responsif & Modern**: UI bersih dan estetik dengan palet warna Neobrutalism yang nyaman diakses di perangkat desktop maupun mobile.

### 🛡️ 2. Panel Admin (Backend / Dashboard)
- 📊 **Dashboard Statistik**: Ringkasan data total dokumen, status dokumen (*Published* vs *Draft*), total kategori, total unduhan, dan daftar dokumen terbaru.
- 📑 **Manajemen Dokumen (CRUD)**:
  - Upload file PDF dengan validasi format dan ukuran file.
  - Auto-generate slug unik untuk SEO-friendly URL.
  - Pengaturan status publikasi (*Draft* / *Published*).
  - Pencatatan otomatis user pengunggah/editor dan dukungan *Soft Deletes*.
- 🗂️ **Manajemen Kategori (CRUD)**: Pengelompokan dokumen berdasarkan rumpun ilmu atau jenis karya ilmiah.
- 👥 **Manajemen Pengguna (RBAC)**:
  - **Admin**: Hak akses penuh ke seluruh modul, manajemen user, dan pengaturan sistem.
  - **Editor**: Hak akses untuk mengelola dokumen dan kategori.
- ⚙️ **Pengaturan Situs Dinamis**:
  - Konfigurasi nama aplikasi, teks footer deskriptif, alamat institusi, email, dan nomor telepon kontak via *Spatie Laravel Settings*.
- 🖨️ **Cetak Laporan PDF**: Fitur ekspor rekapitulasi data dokumen ke format PDF siap cetak.

---

## 🛠️ Tech Stack & Dependencies

| Layer | Teknologi / Paket | Deskripsi |
| :--- | :--- | :--- |
| **Backend** | [Laravel 12](https://laravel.com/) | Framework PHP modern dan tangguh |
| **Frontend Reactive** | [Livewire 3](https://livewire.laravel.com/) & [Alpine.js](https://alpinejs.dev/) | Interaktivitas dinamis tanpa framework JS yang rumit |
| **Styling** | [Tailwind CSS 4](https://tailwindcss.com/) | Utility-first CSS framework dengan tema Neobrutalism |
| **Database** | MySQL / MariaDB / SQLite | Relational Database Management System |
| **PDF Generator** | [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf) | Render laporan dokumen ke file PDF |
| **Settings Manager** | [spatie/laravel-settings](https://github.com/spatie/laravel-settings) | Manajemen konfigurasi aplikasi dinamis |
| **Asset Bundler** | [Vite 7](https://vitejs.dev/) | Build tool & HMR (Hot Module Replacement) |

---

## 🚀 Panduan Instalasi & Menjalankan Project

### Prasyarat Sistem
Pastikan perangkat Anda telah terpasang:
- **PHP** `>= 8.2` (dengan ekstensi `pdo`, `mbstring`, `fileinfo`, `gd`/`imagick`)
- **Composer** `>= 2.x`
- **Node.js** `>= 18.x` & **NPM**
- **MySQL** / **MariaDB**

---

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/RizkiMulyadi18/e-repository.git
   cd e-repository
   ```

2. **Install Dependensi PHP & Node.js**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment (`.env`)**
   Salin file contoh konfigurasi dan sesuaikan database:
   ```bash
   cp .env.example .env
   ```
   Buka file `.env` dan atur koneksi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=e_repository
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Migrasi Database & Seeder Data Awal**
   Jalankan migrasi tabel beserta akun default:
   ```bash
   php artisan migrate --seed
   ```

6. **Buat Storage Link**
   Wajib dijalankan agar file PDF dan logo yang diunggah dapat diakses publik:
   ```bash
   php artisan storage:link
   ```

7. **Build Aset Frontend**
   Untuk mode pengembangan (dev):
   ```bash
   npm run dev
   ```
   Atau untuk build produksi:
   ```bash
   npm run build
   ```

8. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   ```
   Buka browser dan akses aplikasi di: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🔑 Akun Default (Hasil Seeder)

Setelah menjalankan `php artisan db:seed`, Anda dapat masuk ke panel admin di `/admin/login` menggunakan kredensial berikut:

| Peran (Role) | Email | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Administrator** | `rizki@gmail.com` | `admin123` | Akses penuh (Dashboard, Dokumen, Kategori, User, Settings, Cetak Laporan) |
| **Editor** | `budi@gmail.com` | `editor123` | Pengelolaan Dokumen & Kategori |

---

## 📁 Struktur Direktori Utama

```text
e-repository/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/AuthController.php      # Autentikasi Admin
│   │   ├── PublicController.php          # Controller Halaman Pengunjung
│   │   └── ReportController.php          # Export / Cetak Laporan PDF
│   ├── Livewire/
│   │   ├── Admin/                        # Komponen Livewire Panel Admin
│   │   │   ├── CategoryIndex.php
│   │   │   ├── Dashboard.php
│   │   │   ├── DokumenIndex.php
│   │   │   ├── SettingsIndex.php
│   │   │   └── UserIndex.php
│   │   └── HomeSearch.php                # Komponen Pencarian Dinamis Publik
│   ├── Models/
│   │   ├── Category.php
│   │   ├── Dokumen.php
│   │   └── User.php
│   └── Settings/
│       └── GeneralSettings.php           # Schema Pengaturan Situs
├── database/
│   ├── migrations/                       # Struktur Tabel Database
│   └── seeders/                          # Data Awal Pengguna & Pengaturan
├── resources/
│   ├── views/
│   │   ├── admin/                        # View Template Admin & Login
│   │   ├── frontend/                     # View Template Pengunjung & Detail
│   │   ├── layouts/                      # Layout Master (admin & frontend)
│   │   └── livewire/                     # Template Komponen Livewire
├── routes/
│   └── web.php                           # Definisi Route Aplikasi
└── README.md
```

---

## 📄 Lisensi

Proyek ini dirilis di bawah lisensi [MIT License](LICENSE).
