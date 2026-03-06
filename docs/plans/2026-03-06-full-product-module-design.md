# Full Product Module Design

## Goal

Mengubah halaman produk dari katalog statis berbasis `config/site.php` menjadi modul produk B2B lengkap dengan:
- public catalog berbasis database,
- detail produk per slug,
- inquiry per produk,
- admin login,
- CRUD kategori dan produk,
- pengelolaan feature produk,
- pengelolaan media dan attachment produk,
- dashboard inquiry admin.

## Scope

Modul ini adalah product CMS untuk website perusahaan, bukan e-commerce. Tidak ada cart, checkout, stok, atau payment. Fokusnya adalah katalog produk, presentasi detail solusi, dan lead capture.

## Architecture

- Laravel monolith + Blade tetap dipertahankan.
- Public routes dan admin routes dipisah.
- Data produk dipindah ke database dan di-seed dari dataset statis lama.
- Admin memakai session auth Laravel bawaan dengan middleware admin khusus.
- Upload file memakai storage lokal Laravel.

## Data Model

### Users

Tambahkan kolom `is_admin` pada `users` untuk membedakan akun admin.

### Product Categories

Kolom utama:
- `name`
- `slug`
- `description`
- `sort_order`
- `is_active`

### Products

Kolom utama:
- `product_category_id`
- `name`
- `slug`
- `excerpt`
- `description`
- `status` (`draft`, `published`)
- `is_featured`
- `cover_image_path`
- `cover_image_disk`
- `seo_title`
- `seo_description`
- `sort_order`

### Product Features

Satu produk dapat memiliki banyak feature:
- `product_id`
- `title`
- `description`
- `sort_order`

### Product Media

Untuk gallery image:
- `product_id`
- `path`
- `disk`
- `alt_text`
- `sort_order`

### Product Attachments

Untuk brosur atau dokumen:
- `product_id`
- `title`
- `path`
- `disk`
- `mime_type`
- `sort_order`

### Product Inquiries

Lead per produk:
- `product_id`
- `name`
- `email`
- `phone`
- `company`
- `message`

## Public UX

### Catalog

`/produk` menampilkan:
- daftar produk published,
- filter kategori via query string,
- pencarian keyword via query string,
- featured badge,
- CTA menuju detail produk.

### Detail

`/produk/{slug}` menampilkan:
- identitas produk,
- excerpt dan description,
- feature list,
- gallery image,
- attachment/brosur,
- related products,
- inquiry form.

### Inquiry

Form inquiry tersimpan ke `product_inquiries` dan redirect kembali dengan flash success.

## Admin UX

### Auth

Route:
- `GET /admin/login`
- `POST /admin/login`
- `POST /admin/logout`

Hanya user `is_admin = true` yang boleh masuk area admin.

### Dashboard

Dashboard sederhana berisi metrik:
- total kategori,
- total produk,
- total produk published,
- total inquiry produk.

### Category Management

CRUD kategori dengan slug unik dan pengurutan.

### Product Management

CRUD produk dengan:
- kategori,
- status draft/published,
- featured flag,
- SEO fields,
- cover image upload,
- feature repeater,
- gallery image upload,
- attachment upload.

### Inquiry Management

Halaman list inquiry untuk review lead yang masuk dari halaman detail produk.

## Migration Strategy

Dataset produk lama dari `config/site.php` dipakai sebagai source awal untuk seeder. Setelah itu:
- public catalog membaca database,
- home featured products membaca database,
- `config/site.php` tidak lagi jadi source of truth untuk produk.

## Security Rules

- Semua admin route dilindungi auth + middleware admin.
- Slug kategori dan produk unik.
- Upload divalidasi `image` untuk gallery/cover, dan file document untuk attachment.
- Hanya produk `published` yang boleh tampil di public side.

## Testing Strategy

Feature tests:
- public catalog menampilkan produk published dari DB,
- detail produk published bisa diakses via slug,
- produk draft tidak tampil di public,
- inquiry produk tersimpan,
- admin login berhasil untuk admin,
- non-admin ditolak dari route admin,
- admin bisa CRUD kategori,
- admin bisa CRUD produk,
- dashboard inquiry bisa diakses admin.

## Delivery Notes

Default admin lokal akan di-seed untuk pengembangan. Kredensial awal harus diganti bila modul ini dipakai di environment selain local preview.
