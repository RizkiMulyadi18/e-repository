# 📚 Sistem Repositori

Sistem Repositori adalah aplikasi berbasis web yang digunakan untuk mengelola dan menyimpan dokumen secara terpusat. Aplikasi ini dibangun menggunakan **Laravel 12** dan **Filament v4** sebagai panel admin, sehingga memudahkan proses pengelolaan dokumen, pengguna, dan aktivitas sistem.

---

## 🎯 Tujuan & Manfaat

Sistem ini dikembangkan untuk membantu institusi akademik, khususnya Program Studi/Fakultas dalam:

- Mengelola dokumen skripsi, laporan, dan file akademik lainnya.
- Menyediakan repositori dokumen yang mudah dicari dan diakses.
- Mengatur hak akses pengguna agar sistem lebih aman dan terstruktur.
- Meningkatkan efisiensi dalam penyimpanan dan pencarian dokumen.

---

Fitur Utama

Manajemen Dokumen

Upload file PDF dengan metadata lengkap: judul, slug unik, abstrak, penulis, tahun, institusi, status (draft/published/rejected) dan kategori

.

Setiap dokumen memiliki hubungan dengan kategori dan user serta mendukung soft delete dan kolom user_id untuk pencatatan editor

.

Fitur unduh dokumen dengan perhitungan jumlah download.

Manajemen Kategori

Tambah, edit dan hapus kategori dengan atribut nama, slug unik dan warna badge (primary, info, success, warning, danger, gray)
.

Kategori terkait dengan dokumen secara relasi satu-ke-banyak.

Manajemen Pengguna

Peran admin dan editor ditentukan oleh kolom role pada tabel users
.

Admin mempunyai akses penuh ke semua modul, sedangkan editor hanya boleh mengelola dokumen dan kategori
.

Mendukung fungsi soft delete pada user sehingga data tidak langsung hilang.

Halaman Pengaturan

Menggunakan spatie/laravel-settings untuk menyimpan konfigurasi aplikasi, seperti nama situs, logo, footer, status aktif dan tema warna
.

Migrasi tambahan menambahkan teks footer deskriptif
 serta alamat kampus, email dan nomor telepon
.

Dashboard Statistik & Widget

Widget Stats Overview menampilkan statistik penting seperti total dokumen, jumlah dokumen menunggu review, total kategori, total unduhan (kolom downloads) dan jumlah pengguna
.

Widget Latest Dokumen menampilkan lima dokumen terbaru beserta judul, penulis, status dan waktu unggah serta menyediakan tombol cepat untuk mereview
.
---

## 🏗️ Teknologi yang Digunakan

| Teknologi | Keterangan |
|-----------|-------------|
| Laravel 12 | Framework backend |
| Filament v4 | Admin Panel & CRUD generator |
| MySQL | Database |
| PHP 8.4.13 | Bahasa pemrograman |
| Composer | Dependency Management |
| TailwindCSS | UI Styling (bawaan Filament) |

---

## ⚙️ Cara Install & Menjalankan Project

Pastikan sudah terinstall: PHP 8.4.13, Composer, Node.js, dan MySQL.

```bash
# Clone repository
git clone https://github.com/RizkiMulyadi18/e-repository.git
cd e-repository


# Install dependencies
composer install

# Copy .env dan atur konfigurasi database
cp .env.example .env

# Generate key
php artisan key:generate

# Migrasi database & seeder
php artisan migrate
php artisan db:seed   # opsional: seeder untuk data awal (user admin/editor)

# Buat symlink ke direktori penyimpanan publik untuk upload dokumen
php artisan storage:link

# Jalankan server
php artisan serve
