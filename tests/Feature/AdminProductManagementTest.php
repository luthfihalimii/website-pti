<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductAttachment;
use App\Models\ProductCategory;
use App\Models\ProductFeature;
use App\Models\ProductMedia;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProductManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admins_can_create_products_with_features_media_and_attachments(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $category = ProductCategory::factory()->create();

        $response = $this->actingAs($admin)->post(route('admin.products.store'), [
            'product_category_id' => $category->id,
            'name' => 'Procurement Planning',
            'slug' => 'procurement-planning',
            'excerpt' => 'Platform perencanaan pengadaan terintegrasi.',
            'description' => 'Modul untuk mengelola paket pekerjaan, anggaran, dan approval pengadaan secara menyeluruh.',
            'status' => 'published',
            'is_featured' => '1',
            'seo_title' => 'Procurement Planning',
            'seo_description' => 'Solusi perencanaan pengadaan untuk organisasi modern.',
            'sort_order' => 10,
            'cover_image' => UploadedFile::fake()->image('cover.jpg'),
            'feature_titles' => ['Planning Dashboard', 'Approval Workflow'],
            'feature_descriptions' => [
                'Dashboard perencanaan lintas unit.',
                'Approval workflow berlapis dan terdokumentasi.',
            ],
            'gallery_images' => [
                UploadedFile::fake()->image('gallery-1.jpg'),
            ],
            'attachment_titles' => ['Brosur Produk'],
            'attachment_files' => [
                UploadedFile::fake()->create('brochure.pdf', 512, 'application/pdf'),
            ],
        ]);

        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'Procurement Planning',
            'slug' => 'procurement-planning',
            'status' => 'published',
        ]);

        $this->assertDatabaseHas('product_features', [
            'title' => 'Planning Dashboard',
        ]);

        $this->assertDatabaseCount('product_media', 1);
        $this->assertDatabaseCount('product_attachments', 1);
    }

    public function test_updating_product_without_new_media_or_attachments_keeps_existing_assets(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
            'name' => 'Tendering',
            'slug' => 'tendering',
            'excerpt' => 'Produk lama',
            'description' => 'Deskripsi lama produk.',
            'status' => 'published',
        ]);

        Storage::disk('public')->put('products/gallery/existing.jpg', 'gallery-image');
        Storage::disk('public')->put('products/attachments/existing.pdf', 'pdf-content');

        ProductFeature::query()->create([
            'product_id' => $product->id,
            'title' => 'Existing Feature',
            'description' => 'Deskripsi existing feature.',
            'sort_order' => 0,
        ]);

        ProductMedia::query()->create([
            'product_id' => $product->id,
            'path' => 'products/gallery/existing.jpg',
            'disk' => 'public',
            'alt_text' => 'Existing image',
            'sort_order' => 0,
        ]);

        ProductAttachment::query()->create([
            'product_id' => $product->id,
            'title' => 'Existing PDF',
            'path' => 'products/attachments/existing.pdf',
            'disk' => 'public',
            'mime_type' => 'application/pdf',
            'sort_order' => 0,
        ]);

        $response = $this->actingAs($admin)->put(route('admin.products.update', $product), [
            'product_category_id' => $category->id,
            'name' => 'Tendering Updated',
            'slug' => 'tendering',
            'excerpt' => 'Produk lama yang diperbarui',
            'description' => 'Deskripsi baru produk.',
            'status' => 'published',
            'seo_title' => 'Tendering Updated',
            'seo_description' => 'SEO baru',
            'sort_order' => 5,
            'feature_titles' => ['Existing Feature'],
            'feature_descriptions' => ['Deskripsi existing feature.'],
        ]);

        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Tendering Updated',
        ]);
        $this->assertDatabaseCount('product_media', 1);
        $this->assertDatabaseCount('product_attachments', 1);
        Storage::disk('public')->assertExists('products/gallery/existing.jpg');
        Storage::disk('public')->assertExists('products/attachments/existing.pdf');
    }

    public function test_uploaded_product_files_are_deleted_when_creation_fails(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $category = ProductCategory::factory()->create();
        Schema::drop('product_attachments');
        $this->withoutExceptionHandling();

        try {
            $this->actingAs($admin)->post(route('admin.products.store'), [
                'product_category_id' => $category->id,
                'name' => 'Procurement Planning',
                'slug' => 'procurement-planning',
                'excerpt' => 'Platform perencanaan pengadaan terintegrasi.',
                'description' => 'Modul untuk mengelola paket pekerjaan, anggaran, dan approval pengadaan secara menyeluruh.',
                'status' => 'published',
                'is_featured' => '1',
                'seo_title' => 'Procurement Planning',
                'seo_description' => 'Solusi perencanaan pengadaan untuk organisasi modern.',
                'sort_order' => 10,
                'cover_image' => UploadedFile::fake()->image('cover.jpg'),
                'feature_titles' => ['Planning Dashboard'],
                'feature_descriptions' => ['Dashboard perencanaan lintas unit.'],
                'gallery_images' => [
                    UploadedFile::fake()->image('gallery-1.jpg'),
                ],
                'attachment_titles' => ['Brosur Produk'],
                'attachment_files' => [
                    UploadedFile::fake()->create('brochure.pdf', 512, 'application/pdf'),
                ],
            ]);

            $this->fail('Expected product creation to fail.');
        } catch (QueryException) {
            $this->assertDatabaseCount('products', 0);
            $this->assertDatabaseCount('product_features', 0);
            $this->assertDatabaseCount('product_media', 0);
            $this->assertSame([], Storage::disk('public')->allFiles('products'));
        }
    }

    public function test_existing_cover_is_preserved_when_product_update_fails(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
            'name' => 'Tendering',
            'slug' => 'tendering',
            'excerpt' => 'Produk lama',
            'description' => 'Deskripsi lama produk.',
            'status' => 'published',
            'cover_image_path' => 'products/covers/existing-cover.jpg',
            'cover_image_disk' => 'public',
        ]);

        Storage::disk('public')->put('products/covers/existing-cover.jpg', 'old-cover');
        Schema::drop('product_features');
        $this->withoutExceptionHandling();

        try {
            $this->actingAs($admin)->put(route('admin.products.update', $product), [
                'product_category_id' => $category->id,
                'name' => 'Tendering Updated',
                'slug' => 'tendering',
                'excerpt' => 'Produk lama yang diperbarui',
                'description' => 'Deskripsi baru produk.',
                'status' => 'published',
                'seo_title' => 'Tendering Updated',
                'seo_description' => 'SEO baru',
                'sort_order' => 5,
                'cover_image' => UploadedFile::fake()->image('replacement-cover.jpg'),
                'feature_titles' => ['Existing Feature'],
                'feature_descriptions' => ['Deskripsi existing feature.'],
            ]);

            $this->fail('Expected product update to fail.');
        } catch (QueryException) {
            $this->assertDatabaseHas('products', [
                'id' => $product->id,
                'cover_image_path' => 'products/covers/existing-cover.jpg',
                'cover_image_disk' => 'public',
            ]);
            $this->assertSame(['products/covers/existing-cover.jpg'], Storage::disk('public')->allFiles('products/covers'));
        }
    }

    public function test_product_index_is_paginated(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $category = ProductCategory::factory()->create();

        foreach (range(1, 16) as $index) {
            $label = str_pad((string) $index, 2, '0', STR_PAD_LEFT);

            Product::factory()->create([
                'product_category_id' => $category->id,
                'name' => 'Produk '.$label,
                'slug' => 'produk-'.$label,
                'status' => 'published',
                'sort_order' => $index,
            ]);
        }

        $firstPageResponse = $this->actingAs($admin)->get(route('admin.products.index'));
        $secondPageResponse = $this->actingAs($admin)->get(route('admin.products.index', ['page' => 2]));

        $firstPageResponse->assertOk();
        $firstPageResponse->assertSeeText('Produk 01');
        $firstPageResponse->assertDontSeeText('Produk 16');
        $firstPageResponse->assertSee('?page=2', false);

        $secondPageResponse->assertOk();
        $secondPageResponse->assertSeeText('Produk 16');
    }

    public function test_edit_product_form_lists_all_existing_attachment_titles(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
        ]);

        ProductAttachment::query()->create([
            'product_id' => $product->id,
            'title' => 'Brosur Produk',
            'path' => 'products/attachments/brosur.pdf',
            'disk' => 'public',
            'mime_type' => 'application/pdf',
            'sort_order' => 0,
        ]);

        ProductAttachment::query()->create([
            'product_id' => $product->id,
            'title' => 'Studi Kasus',
            'path' => 'products/attachments/studi-kasus.pdf',
            'disk' => 'public',
            'mime_type' => 'application/pdf',
            'sort_order' => 1,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.products.edit', $product));

        $response->assertOk();
        $response->assertSee('value="Brosur Produk"', false);
        $response->assertSee('value="Studi Kasus"', false);
        $response->assertSeeText('Lampiran saat ini');
    }
}
