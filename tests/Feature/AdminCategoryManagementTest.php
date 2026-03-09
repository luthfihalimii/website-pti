<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admins_can_create_product_categories(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->post(route('admin.categories.store'), [
            'name' => 'E-Procurement',
            'slug' => 'e-procurement',
            'description' => 'Solusi digital untuk pengadaan barang dan jasa.',
            'sort_order' => 1,
            'is_active' => '1',
        ]);

        $response->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('product_categories', [
            'name' => 'E-Procurement',
            'slug' => 'e-procurement',
        ]);
    }

    public function test_admins_cannot_delete_categories_that_still_have_products(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $category = ProductCategory::factory()->create();
        Product::factory()->create([
            'product_category_id' => $category->id,
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.categories.destroy', $category));

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHasErrors([
            'category' => 'Kategori ini masih digunakan oleh produk aktif di katalog.',
        ]);
        $this->assertDatabaseHas('product_categories', [
            'id' => $category->id,
        ]);
    }

    public function test_category_index_is_paginated(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        foreach (range(1, 16) as $index) {
            $label = str_pad((string) $index, 2, '0', STR_PAD_LEFT);

            ProductCategory::factory()->create([
                'name' => 'Kategori '.$label,
                'slug' => 'kategori-'.$label,
                'sort_order' => $index,
            ]);
        }

        $firstPageResponse = $this->actingAs($admin)->get(route('admin.categories.index'));
        $secondPageResponse = $this->actingAs($admin)->get(route('admin.categories.index', ['page' => 2]));

        $firstPageResponse->assertOk();
        $firstPageResponse->assertSeeText('Kategori 01');
        $firstPageResponse->assertDontSeeText('Kategori 16');
        $firstPageResponse->assertSee('?page=2', false);

        $secondPageResponse->assertOk();
        $secondPageResponse->assertSeeText('Kategori 16');
    }
}
