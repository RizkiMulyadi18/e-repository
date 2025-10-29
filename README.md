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

## 🧩 Fitur Utama

### 📁 Manajemen Dokumen
- Upload dokumen dengan metadata (judul, kategori, tahun, penulis, institusi).
- Fitur pencarian dan filter.
- Soft Delete (Recycle Bin): Pulihkan atau hapus permanen dokumen.
- Menampilkan informasi pengguna yang mengupload dokumen.

### 👤 Manajemen Pengguna *(Admin Only)*
- Tambah pengguna baru.
- Atur peran pengguna: **Admin** dan **Editor**.
- Reset password pengguna.
- Admin dapat melihat semua pengguna.

### 🔐 Kontrol Akses
- Admin: akses penuh ke semua fitur.
- Editor: hanya dapat mengelola dokumen.
- Menu Pengguna hanya terlihat untuk Admin.

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
git clone https://github.com/USERNAME/NAMA_REPO.git
cd NAMA_REPO

# Install dependencies
composer install

# Copy .env dan atur konfigurasi database
cp .env.example .env

# Generate key
php artisan key:generate

# Migrasi database & seeder
php artisan migrate --seed

# Jalankan server
php artisan serve
