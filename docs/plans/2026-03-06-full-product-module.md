# Full Product Module Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Membangun modul produk berbasis database dengan public catalog, product detail, inquiry, admin auth, dan CRUD kategori/produk lengkap.

**Architecture:** Laravel monolith + Blade. Public catalog dan admin dashboard berbagi domain model yang sama, dengan admin route dilindungi session auth Laravel dan middleware admin. Dataset produk lama dipindahkan ke database lewat seeder.

**Tech Stack:** Laravel 12, Blade, Eloquent, PHPUnit, SQLite/MySQL, Bun/Vite.

---

### Task 1: Domain Tests

**Files:**
- Create: `tests/Feature/ProductCatalogPublicTest.php`
- Create: `tests/Feature/ProductInquirySubmissionTest.php`
- Create: `tests/Feature/AdminAuthenticationTest.php`
- Create: `tests/Feature/AdminProductManagementTest.php`
- Create: `tests/Feature/AdminCategoryManagementTest.php`

**Step 1: Write the failing tests**
- Tambahkan test public catalog/detail/filter.
- Tambahkan test inquiry produk.
- Tambahkan test login admin dan proteksi route admin.
- Tambahkan test CRUD kategori dan produk.

**Step 2: Run test to verify it fails**

Run: `php artisan test tests/Feature/ProductCatalogPublicTest.php tests/Feature/ProductInquirySubmissionTest.php tests/Feature/AdminAuthenticationTest.php tests/Feature/AdminCategoryManagementTest.php tests/Feature/AdminProductManagementTest.php`

Expected: FAIL karena route/model/table/controller belum ada.

### Task 2: Product Domain Foundation

**Files:**
- Create: `database/migrations/*create_product_categories_table.php`
- Create: `database/migrations/*create_products_table.php`
- Create: `database/migrations/*create_product_features_table.php`
- Create: `database/migrations/*create_product_media_table.php`
- Create: `database/migrations/*create_product_attachments_table.php`
- Create: `database/migrations/*create_product_inquiries_table.php`
- Create: `database/migrations/*add_is_admin_to_users_table.php`
- Create: `app/Models/ProductCategory.php`
- Create: `app/Models/Product.php`
- Create: `app/Models/ProductFeature.php`
- Create: `app/Models/ProductMedia.php`
- Create: `app/Models/ProductAttachment.php`
- Create: `app/Models/ProductInquiry.php`
- Create: `database/factories/ProductCategoryFactory.php`
- Create: `database/factories/ProductFactory.php`

**Step 1: Implement minimal schema and relations**
- Tambahkan semua table dan relasi.
- Tambahkan fillable/casts/scope.

**Step 2: Run failing tests again**
- Pastikan gagal pindah ke route/controller, bukan schema error.

### Task 3: Admin Auth

**Files:**
- Create: `app/Http/Controllers/Admin/Auth/LoginController.php`
- Create: `app/Http/Middleware/EnsureUserIsAdmin.php`
- Create: `resources/views/admin/auth/login.blade.php`
- Modify: `app/Models/User.php`
- Modify: `routes/web.php`

**Step 1: Implement failing auth tests**
- Login admin berhasil.
- Non-admin tidak bisa akses route admin.

**Step 2: Implement minimal auth flow**
- Route login/logout admin.
- Middleware admin.

### Task 4: Admin Categories

**Files:**
- Create: `app/Http/Controllers/Admin/CategoryController.php`
- Create: `app/Http/Requests/Admin/StoreProductCategoryRequest.php`
- Create: `app/Http/Requests/Admin/UpdateProductCategoryRequest.php`
- Create: `resources/views/admin/categories/index.blade.php`
- Create: `resources/views/admin/categories/create.blade.php`
- Create: `resources/views/admin/categories/edit.blade.php`

**Step 1: Implement category CRUD tests**
- Create/update category.

**Step 2: Implement minimal CRUD**
- Validasi slug unik.

### Task 5: Admin Products

**Files:**
- Create: `app/Http/Controllers/Admin/ProductController.php`
- Create: `app/Http/Requests/Admin/StoreProductRequest.php`
- Create: `app/Http/Requests/Admin/UpdateProductRequest.php`
- Create: `resources/views/admin/products/index.blade.php`
- Create: `resources/views/admin/products/create.blade.php`
- Create: `resources/views/admin/products/edit.blade.php`

**Step 1: Implement product CRUD tests**
- Create/update published product.
- Persist features, gallery, attachments.

**Step 2: Implement minimal CRUD**
- Cover upload.
- Feature arrays.
- Gallery image upload.
- Attachment upload.

### Task 6: Public Catalog and Inquiry

**Files:**
- Create: `app/Http/Controllers/ProductCatalogController.php`
- Create: `app/Http/Controllers/ProductInquiryController.php`
- Create: `app/Http/Requests/StoreProductInquiryRequest.php`
- Create: `resources/views/pages/produk-detail.blade.php`
- Modify: `resources/views/pages/produk.blade.php`
- Modify: `resources/views/pages/home.blade.php`
- Modify: `routes/web.php`

**Step 1: Implement public tests**
- Catalog memakai DB.
- Detail by slug.
- Draft hidden.
- Inquiry tersimpan.

**Step 2: Implement public UI and controllers**
- Query filter kategori dan search.
- Related products.
- Inquiry form.

### Task 7: Seeders and Legacy Migration

**Files:**
- Create: `database/seeders/AdminUserSeeder.php`
- Create: `database/seeders/ProductCatalogSeeder.php`
- Modify: `database/seeders/DatabaseSeeder.php`
- Modify: `config/site.php`

**Step 1: Seed initial categories/products from legacy config**
- Jadikan config lama hanya fallback non-product.

**Step 2: Verify public pages still render**
- `/`
- `/produk`
- `/produk/{slug}`

### Task 8: Verification

**Files:**
- Review all modified files

**Step 1: Run full tests**

Run: `php artisan test`

Expected: PASS

**Step 2: Run frontend build**

Run: `bun run build`

Expected: PASS
