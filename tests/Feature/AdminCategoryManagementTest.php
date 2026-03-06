<?php

namespace Tests\Feature;

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
}
