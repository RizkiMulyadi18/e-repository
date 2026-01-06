# 📚 Sistem Repositori

**Sistem Repositori** adalah aplikasi berbasis web yang digunakan untuk mengelola dan menyimpan dokumen secara terpusat.  
Aplikasi ini dibangun menggunakan **Laravel 12** dan **Filament v4** sebagai panel admin, sehingga memudahkan proses pengelolaan dokumen, pengguna, dan aktivitas sistem.

---

## 🎯 Tujuan & Manfaat

Sistem ini dikembangkan untuk membantu institusi akademik, khususnya Program Studi atau Fakultas dalam:

- Mengelola dokumen skripsi, laporan, dan file akademik lainnya.
- Menyediakan repositori dokumen yang mudah dicari dan diakses.
- Mengatur hak akses pengguna agar sistem lebih aman dan terstruktur.
- Meningkatkan efisiensi dalam penyimpanan dan pencarian dokumen.

---

## 🚀 Fitur Utama

### 📄 Manajemen Dokumen
- Upload file **PDF** dengan metadata lengkap:
  - Judul
  - Slug unik
  - Abstrak
  - Penulis
  - Tahun
  - Institusi
  - Status (*draft / published*)
  - Kategori
- Setiap dokumen:
  - Berelasi dengan **kategori** dan **user**
  - Mendukung **soft delete**
  - Memiliki kolom `user_id` untuk pencatatan editor
- Fitur **unduh dokumen** dengan perhitungan jumlah download.

---

### 🗂️ Manajemen Kategori
- Tambah, edit, dan hapus kategori.
- Atribut kategori:
  - Nama
  - Slug unik
- Relasi **satu-ke-banyak** antara kategori dan dokumen.

---

### 👤 Manajemen Pengguna
- Sistem peran berbasis kolom `role` pada tabel `users`:
  - **Admin**
  - **Editor**
- Hak akses:
  - **Admin**: akses penuh ke semua modul
  - **Editor**: hanya mengelola dokumen dan kategori
- Mendukung **soft delete** pada user sehingga data tidak langsung terhapus permanen.

---

### ⚙️ Halaman Pengaturan
- Menggunakan **spatie/laravel-settings** untuk konfigurasi aplikasi:
  - Nama situs
  - Logo
  - Footer
  - Status aktif aplikasi
  - Tema warna
- Migrasi tambahan untuk:
  - Teks footer deskriptif
  - Alamat kampus
  - Email
  - Nomor telepon

---

### 📊 Dashboard Statistik & Widget
- **Stats Overview Widget** menampilkan:
  - Total dokumen
  - Dokumen menunggu review
  - Total kategori
  - Total unduhan (kolom `downloads`)
  - Jumlah pengguna
- **Latest Dokumen Widget**:
  - Menampilkan 5 dokumen terbaru
  - Informasi: judul, penulis, status, waktu unggah
  - Tombol cepat untuk melakukan review

---

## 🏗️ Teknologi yang Digunakan

| Teknologi | Keterangan |
|----------|------------|
| Laravel 12 | Framework backend |
| Filament v4 | Admin Panel & CRUD generator |
| MySQL | Database |
| PHP 8.4.13 | Bahasa pemrograman |
| Composer | Dependency management |
| Tailwind CSS | UI styling (bawaan Filament) |

---

## ⚙️ Cara Install & Menjalankan Project

Pastikan sudah terinstall:
- PHP 8.4.13
- Composer
- Node.js
- MySQL

```bash
# Clone repository
git clone https://github.com/RizkiMulyadi18/e-repository.git
cd e-repository

# Install dependencies
composer install

# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Migrasi database
php artisan migrate

# (Opsional) Jalankan seeder untuk data awal
php artisan db:seed

# Buat symbolic link untuk storage (upload dokumen)
php artisan storage:link

# Jalankan server
php artisan serve
