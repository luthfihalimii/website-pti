<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductAttachment;
use App\Models\ProductCategory;
use App\Models\ProductMedia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCatalogPublicTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_products_are_listed_in_public_catalog(): void
    {
        $category = ProductCategory::factory()->create([
            'name' => 'Business System',
            'slug' => 'business-system',
        ]);

        Product::factory()->create([
            'product_category_id' => $category->id,
            'name' => 'HRIS Enterprise',
            'slug' => 'hris-enterprise',
            'status' => 'published',
        ]);

        $response = $this->get(route('products.index'));

        $response->assertOk();
        $response->assertSee('HRIS Enterprise');
    }

    public function test_published_product_can_be_viewed_by_slug(): void
    {
        $category = ProductCategory::factory()->create();

        $product = Product::factory()->create([
            'product_category_id' => $category->id,
            'name' => 'Insight GOV',
            'slug' => 'insight-gov',
            'status' => 'published',
        ]);

        $response = $this->get(route('products.show', $product->slug));

        $response->assertOk();
        $response->assertSee('Insight GOV');
    }

    public function test_draft_products_are_hidden_from_public_catalog_and_detail(): void
    {
        $category = ProductCategory::factory()->create();

        $product = Product::factory()->create([
            'product_category_id' => $category->id,
            'name' => 'Draft Product',
            'slug' => 'draft-product',
            'status' => 'draft',
        ]);

        $catalogResponse = $this->get(route('products.index'));
        $detailResponse = $this->get(route('products.show', $product->slug));

        $catalogResponse->assertOk();
        $catalogResponse->assertDontSee('Draft Product');
        $detailResponse->assertNotFound();
    }

    public function test_catalog_can_be_filtered_by_category(): void
    {
        $businessCategory = ProductCategory::factory()->create([
            'name' => 'Business System',
            'slug' => 'business-system',
        ]);

        $govCategory = ProductCategory::factory()->create([
            'name' => 'E-Government',
            'slug' => 'e-government',
        ]);

        Product::factory()->create([
            'product_category_id' => $businessCategory->id,
            'name' => 'Business Suite',
            'slug' => 'business-suite',
            'status' => 'published',
        ]);

        Product::factory()->create([
            'product_category_id' => $govCategory->id,
            'name' => 'Gov Portal',
            'slug' => 'gov-portal',
            'status' => 'published',
        ]);

        $response = $this->get(route('products.index', ['category' => 'business-system']));

        $response->assertOk();
        $response->assertSee('Business Suite');
        $response->assertDontSee('Gov Portal');
    }

    public function test_public_product_catalog_is_paginated(): void
    {
        $category = ProductCategory::factory()->create([
            'name' => 'Business System',
            'slug' => 'business-system',
        ]);

        foreach (range(1, 10) as $index) {
            $label = str_pad((string) $index, 2, '0', STR_PAD_LEFT);

            Product::factory()->create([
                'product_category_id' => $category->id,
                'name' => 'Product '.$label,
                'slug' => 'product-'.$label,
                'status' => 'published',
                'sort_order' => $index,
            ]);
        }

        $firstPageResponse = $this->get(route('products.index'));
        $secondPageResponse = $this->get(route('products.index', ['page' => 2]));

        $firstPageResponse->assertOk();
        $firstPageResponse->assertSeeText('Product 01');
        $firstPageResponse->assertDontSeeText('Product 10');
        $firstPageResponse->assertSee('?page=2', false);

        $secondPageResponse->assertOk();
        $secondPageResponse->assertSeeText('Product 10');
    }

    public function test_product_pages_use_current_host_storage_urls_for_public_files(): void
    {
        $category = ProductCategory::factory()->create();

        $product = Product::factory()->create([
            'product_category_id' => $category->id,
            'name' => 'Tendering Suite',
            'slug' => 'tendering-suite',
            'status' => 'published',
            'cover_image_path' => 'products/covers/tendering.png',
            'cover_image_disk' => 'public',
        ]);

        ProductMedia::query()->create([
            'product_id' => $product->id,
            'path' => 'products/gallery/tendering-gallery.png',
            'disk' => 'public',
            'alt_text' => 'Tendering gallery',
            'sort_order' => 0,
        ]);

        ProductAttachment::query()->create([
            'product_id' => $product->id,
            'title' => 'Tendering Brochure',
            'path' => 'products/attachments/tendering.pdf',
            'disk' => 'public',
            'mime_type' => 'application/pdf',
            'sort_order' => 0,
        ]);

        $catalogResponse = $this->get(route('products.index'));
        $detailResponse = $this->get(route('products.show', $product->slug));

        $catalogResponse->assertOk();
        $catalogResponse->assertSee('/storage/products/covers/tendering.png', false);
        $catalogResponse->assertDontSee('http://localhost/storage', false);

        $detailResponse->assertOk();
        $detailResponse->assertSee('/storage/products/covers/tendering.png', false);
        $detailResponse->assertSee('/storage/products/gallery/tendering-gallery.png', false);
        $detailResponse->assertSee('/storage/products/attachments/tendering.pdf', false);
        $detailResponse->assertDontSee('http://localhost/storage', false);
    }
}
