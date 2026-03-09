# Piramidasoft Company Profile Website

Website company profile berbasis Laravel 12 untuk halaman pemasaran, publikasi, program magang, dan lowongan kerja PT Piramida Teknologi Informasi.

## Stack

- PHP 8.2
- Laravel 12
- Tailwind CSS 4
- Vite 7
- Bun untuk workflow frontend
- PHPUnit untuk pengujian backend

## Fitur Utama

- Halaman publik untuk beranda, layanan, produk, publikasi, kontak, magang, dan lowongan.
- Viewer flipbook untuk dokumen publikasi dengan whitelist file PDF.
- Form lamaran kerja yang tervalidasi, menyimpan data ke database, dan mengunggah CV PDF ke storage lokal Laravel.
- Named routes untuk seluruh halaman publik utama agar navigasi dan testing lebih stabil.

## Menjalankan Project

1. Install dependency backend:

```bash
composer install
```

2. Install dependency frontend:

```bash
bun install
```

3. Siapkan environment:

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
```

4. Jalankan development server:

```bash
composer dev
```

Atau jika hanya butuh frontend watcher:

```bash
bun run dev
```

## Command Penting

- `composer setup` untuk setup awal project.
- `composer dev` untuk menjalankan server Laravel, worker, log tail, dan Vite.
- `composer lint` untuk mengecek formatting PHP via Pint.
- `bun run lint` untuk mengecek JavaScript frontend via ESLint.
- `php artisan test` untuk menjalankan test suite.
- `bun run check` untuk menjalankan lint frontend lalu memverifikasi asset tetap dapat dibuild.
- `bun run build` untuk build asset production.

## Struktur Penting

- `app/Http/Controllers` berisi controller halaman publik, publikasi, karir, dan submit lamaran.
- `app/Http/Requests/StoreJobApplicationRequest.php` berisi validasi submit lamaran.
- `config/site.php` adalah sumber data statis untuk konten marketing dan karir.
- `resources/views` berisi Blade templates untuk halaman publik.
- `tests/Feature` berisi smoke test halaman dan test behavior utama.

## Catatan Implementasi

- File CV lamaran disimpan di disk `local` Laravel.
- Data lamaran disimpan di tabel `job_applications`.
- Publikasi flipbook hanya menerima file PDF yang terdaftar di `config/site.php`.
