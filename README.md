# Explore Aceh — Blog Wisata Alam Aceh

Aplikasi blog pribadi berbasis **Laravel** yang memungkinkan seorang penulis (setelah login) untuk membuat, mengedit, dan menghapus artikel wisata alam miliknya sendiri, sementara pengunjung umum dapat membaca artikel yang sudah dipublikasikan tanpa perlu login.

Project ini dibuat sebagai tugas mata kuliah **Pemrograman Web Lanjut** — Program Studi Teknik Informatika, Universitas Malikussaleh.

## 📋 Deskripsi Aplikasi

Explore Aceh adalah platform blog wisata yang menampilkan informasi destinasi alam di Aceh (pantai, danau, air terjun, pegunungan, dan pulau) melalui artikel-artikel yang ditulis oleh penulis terdaftar. Aplikasi ini dibangun dengan konsep MVC menggunakan Laravel, dilengkapi sistem autentikasi, manajemen artikel & kategori (CRUD), serta halaman publik untuk pembaca umum.

### Fitur Utama
- **Autentikasi**: Registrasi, login, logout dengan validasi lengkap (Laravel Breeze)
- **Manajemen Artikel (CRUD)**: Tambah, edit, hapus artikel dengan upload thumbnail, kategori, dan status (draft/dipublikasi)
- **Manajemen Kategori (CRUD)**: Tambah, edit, hapus kategori milik masing-masing penulis
- **Halaman Publik**: Beranda dengan daftar artikel yang dipublikasikan, pencarian berdasarkan judul, filter berdasarkan kategori, dan halaman detail artikel — semua dapat diakses tanpa login

## 🛠️ Teknologi yang Digunakan

| Komponen | Teknologi |
|---|---|
| Backend | Laravel 12 |
| Database | SQLite / MySQL |
| Template Engine | Blade |
| Autentikasi | Laravel Breeze |
| CSS Framework | Tailwind CSS |
| Frontend Build | Vite |

## 📦 Cara Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & npm

### Langkah-langkah

1. **Clone repositori**
   ```bash
   git clone <url-repositori-ini>
   cd wisata-alam
   ```

2. **Install dependency PHP**
   ```bash
   composer install
   ```

3. **Install dependency JavaScript**
   ```bash
   npm install
   ```

4. **Salin file environment**
   ```bash
   cp .env.example .env
   ```
   *(Windows: `copy .env.example .env`)*

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Konfigurasi database**
   Secara default project ini menggunakan SQLite. Pastikan file `database/database.sqlite` sudah ada (buat file kosong jika belum ada), atau sesuaikan `.env` untuk menggunakan MySQL:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=wisata_alam
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. **Jalankan migration dan seeder**
   ```bash
   php artisan migrate:fresh --seed
   ```
   Perintah ini akan membuat seluruh tabel (users, categories, articles) sekaligus mengisi data contoh: 1 akun demo, 5 kategori (Pantai, Danau, Air Terjun, Pegunungan, Pulau), dan 5 artikel (semua berstatus dipublikasi).

   > **Catatan:** Jalankan perintah ini hanya jika Anda ingin memulai database dari kosong. Jika sudah mengisi data secara manual melalui aplikasi, perintah ini akan menghapus data tersebut dan menggantinya dengan data contoh dari seeder.

8. **Buat symbolic link untuk storage** (agar gambar thumbnail dapat diakses)
   ```bash
   php artisan storage:link
   ```

9. **Compile asset frontend**
   ```bash
   npm run dev
   ```
   *(biarkan proses ini tetap berjalan selama development, atau gunakan `npm run build` untuk build produksi)*

10. **Jalankan server Laravel** (di terminal terpisah)
    ```bash
    php artisan serve
    ```

11. Buka browser ke **http://127.0.0.1:8000**

## 🔑 Akun Demo

Gunakan akun berikut untuk mencoba fitur setelah login (dashboard, tambah/edit/hapus artikel & kategori):

| Email | Password |
|---|---|
| `demo@exploreaceh.com` | `password123` |

Akun ini sudah otomatis memiliki 5 kategori dan 5 artikel contoh (semua berstatus dipublikasi) hasil dari seeder.

## 📁 Struktur Database

- **users**: id, name, email (unique), password, timestamps
- **categories**: id, user_id (FK), name, slug, description, timestamps
- **articles**: id, user_id (FK), category_id (FK), title, slug, content, thumbnail, status (draft/published), timestamps

## 📚 Referensi

- Scaffolding autentikasi menggunakan [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze-and-blade)
- Dokumentasi resmi [Laravel](https://laravel.com/docs)
- Styling menggunakan [Tailwind CSS](https://tailwindcss.com/docs)

## 👤 Penulis

Dikerjakan sebagai Project Individu — Mata Kuliah Pemrograman Web Lanjut, Teknik Informatika, Universitas Malikussaleh.
