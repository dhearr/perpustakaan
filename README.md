<p align="center">
  <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" height="50">
  <img src="[https://filamentadmin.com/images/logo.svg](https://filamentphp.com/build/assets/rocket-0d392ed0.webp)" alt="Filament" height="50" style="margin-left: 20px;">
  <img src="[https://tailwindcss.com/_next/static/media/tailwindcss-mark.1f65924cf7196c59e741ad5b4f43e3f1.svg](https://tailwindcss.com/_next/static/media/tailwindcss-mark.3c5441fc7a190fb1800d4a5c7f07ba4b1345a9c8.svg)" alt="Tailwind CSS" height="50" style="margin-left: 20px;">
</p>

Selamat datang di aplikasi ini! Aplikasi ini dibangun menggunakan **Laravel 11**, **Filament** untuk admin panel, dan **Tailwind CSS** untuk styling front-end. Panduan ini akan membantu Anda untuk mengkloning dan menjalankan aplikasi ini di perangkat Anda.

## Fitur

-   **Framework Modern**: Dibangun menggunakan Laravel 11.
-   **Admin Panel**: Menggunakan Filament untuk manajemen data yang cepat dan mudah.
-   **Front-End Styling**: Menggunakan Tailwind CSS untuk desain yang modern dan responsif.
-   **Mudah Dikembangkan**: Struktur kode yang rapi dan mudah diadaptasi.

## Persyaratan

Pastikan perangkat Anda telah memiliki:

-   **PHP** versi 8.2 atau lebih baru
-   **Composer** versi terbaru
-   **Node.js** dan **npm** (untuk build front-end)
-   **Database**: MySQL, PostgreSQL, atau database lain yang anda gunakan

## Cara Menjalankan Aplikasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di perangkat Anda:

#### 1. Clone Repository

Clone repository ini menggunakan perintah berikut:

```bash
git clone https://github.com/dhearr/perpustakaan.git
```

Buka file yang baru saja anda clone tadi di code editor kesukaan anda.

#### 2. Install Dependensi

Jalankan perintah berikut untuk menginstal dependensi PHP:

```bash
composer install
```

```bash
npm install
```

#### 3. Konfigurasi File .env

Salin file .env.example ke .env:

```bash
cp .env.example .env
```

Sesuaikan konfigurasi database Anda di file .env.

#### 4. Migrasi Database

Jalankan migrasi untuk membuat tabel-tabel yang diperlukan:

```bash
php artisan migrate
```

#### 5. Build Asset Front-End

Jalankan perintah berikut untuk membuild asset dengan Tailwind CSS:

```bash
npm run dev
```

#### 6. Jalankan Server

Jalankan aplikasi menggunakan perintah:

```bash
php artisan serve
```

Akses aplikasi Anda di http://localhost:8000. Anda sudah dapat menggunakan aplikasi ini.

## Kontribusi

Kami menyambut kontribusi dari anda. Jika anda menemukan masalah atau memiliki ide untuk fitur baru, silakan buat issue atau ajukan pull request di repository ini.
