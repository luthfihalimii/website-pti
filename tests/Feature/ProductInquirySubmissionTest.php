<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductInquirySubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitors_can_submit_product_inquiries(): void
    {
        $category = ProductCategory::factory()->create();

        $product = Product::factory()->create([
            'product_category_id' => $category->id,
            'status' => 'published',
            'slug' => 'smart-procurement-suite',
        ]);

        $response = $this->post(route('products.inquiries.store', $product->slug), [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
            'company' => 'PT Contoh Sukses',
            'message' => 'Saya ingin menjadwalkan demo produk ini untuk tim procurement.',
        ]);

        $response->assertRedirect(route('products.show', $product->slug));
        $response->assertSessionHas('product_inquiry_status');

        $this->assertDatabaseHas('product_inquiries', [
            'product_id' => $product->id,
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
        ]);
    }
}
