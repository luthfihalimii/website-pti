<?php

namespace Tests\Feature;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
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
}
