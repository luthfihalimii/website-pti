# Ringkasan Pengerjaan Website Apply Magang

Tanggal ringkasan: 9 Maret 2026  
Repository: `c:\magangSmk2\apply-magang`

## Ruang Lingkup

Pekerjaan difokuskan pada:

1. Perbaikan tampilan responsive untuk mobile lalu tablet.
2. Perbaikan error `404 Not Found` saat klik tombol **Lihat Poster** pada halaman lowongan.
3. Penyesuaian tampilan untuk area publik dan admin.
4. Penambahan pengujian (Feature Test) untuk memastikan perubahan aman.

## Perubahan Utama

### 1) Fix Error 404 "Lihat Poster"

- Sumber masalah: path poster tidak mengarah ke file yang benar.
- Solusi: update konfigurasi poster di `config/site.php` ke:
  - `assets/images/poster-lowongan.png`
- Dampak: tombol **Lihat Poster** sekarang membuka file poster dengan benar.

### 2) Responsive Mobile + Tablet (Public + Admin)

- Menyesuaikan layout, spacing, dan komponen navigasi di halaman publik.
- Menyesuaikan dashboard dan tabel admin agar tetap terbaca dan usable di layar kecil-menengah.
- Penyesuaian CSS dan interaksi frontend dilakukan di:
  - `resources/css/app.css`
  - `resources/js/app.js`

### 3) View yang Diupdate

- Komponen/layout:
  - `resources/views/components/navbar.blade.php`
  - `resources/views/components/footer.blade.php`
  - `resources/views/layouts/admin.blade.php`
- Halaman admin:
  - `resources/views/admin/dashboard.blade.php`
  - `resources/views/admin/categories/index.blade.php`
  - `resources/views/admin/products/index.blade.php`
  - `resources/views/admin/product-inquiries/index.blade.php`
  - `resources/views/admin/job-applications-index.blade.php`
  - `resources/views/admin/internship-applications-index.blade.php`
- Halaman publik:
  - `resources/views/pages/lowongan.blade.php`
  - `resources/views/pages/detail-lowongan.blade.php`
  - `resources/views/pages/form-lamaran.blade.php`
  - `resources/views/pages/layanan.blade.php`
  - `resources/views/pages/magang.blade.php`
  - `resources/views/pages/magang-tahap1.blade.php`
  - `resources/views/pages/magang-tahap2.blade.php`
  - `resources/views/pages/publikasi.blade.php`
  - `resources/views/pages/tentang.blade.php`
  - `resources/views/pages/kontak.blade.php`

## QA dan Pengujian

Pengujian yang dijalankan:

1. `npm.cmd run build`
2. `php artisan test` (full suite)
3. Targeted feature tests untuk responsiveness + link poster

Test tambahan yang dibuat:

- `tests/Feature/CareerPosterLinkTest.php`
- `tests/Feature/TabletResponsiveLayoutTest.php`

## Status Git dan Push

- Commit utama: `3f766fa`
- Pesan commit: `fix: resolve poster 404 and improve mobile-tablet responsiveness`
- Branch tujuan: `main`
- Remote: `origin/main`
- Catatan: folder `cypress` **tidak** ikut dipush.

## Hasil Akhir

1. Fitur **Lihat Poster** sudah tidak 404.
2. Tampilan web publik dan admin lebih stabil di mobile dan tablet.
3. Perubahan sudah diverifikasi lewat build + test, lalu dipush ke repository.
