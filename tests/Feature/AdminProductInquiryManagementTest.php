<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductInquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductInquiryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admins_can_view_and_delete_product_inquiries(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
            'status' => Product::STATUS_PUBLISHED,
        ]);

        $inquiry = ProductInquiry::query()->create([
            'product_id' => $product->id,
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
            'company' => 'PT Contoh Sukses',
            'message' => 'Saya ingin menjadwalkan demo produk ini.',
        ]);

        $indexResponse = $this->actingAs($admin)->get(route('admin.product-inquiries.index'));
        $deleteResponse = $this->actingAs($admin)->delete(route('admin.product-inquiries.destroy', $inquiry));

        $indexResponse->assertOk();
        $indexResponse->assertSeeText('Budi Santoso');
        $indexResponse->assertSeeText($product->name);

        $deleteResponse->assertRedirect(route('admin.product-inquiries.index'));
        $this->assertDatabaseMissing('product_inquiries', [
            'id' => $inquiry->id,
        ]);
    }

    public function test_product_inquiry_inbox_is_paginated(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
            'status' => Product::STATUS_PUBLISHED,
        ]);

        foreach (range(1, 16) as $index) {
            $label = str_pad((string) $index, 2, '0', STR_PAD_LEFT);

            ProductInquiry::query()->create([
                'product_id' => $product->id,
                'name' => 'Lead '.$label,
                'email' => 'lead'.$label.'@example.com',
                'phone' => '081234567890',
                'company' => 'Company '.$label,
                'message' => 'Pesan lead '.$label,
            ]);
        }

        $firstPageResponse = $this->actingAs($admin)->get(route('admin.product-inquiries.index'));
        $secondPageResponse = $this->actingAs($admin)->get(route('admin.product-inquiries.index', ['page' => 2]));

        $firstPageResponse->assertOk();
        $firstPageResponse->assertSeeText('Lead 16');
        $firstPageResponse->assertDontSeeText('Lead 01');
        $firstPageResponse->assertSee('?page=2', false);

        $secondPageResponse->assertOk();
        $secondPageResponse->assertSeeText('Lead 01');
    }
}
