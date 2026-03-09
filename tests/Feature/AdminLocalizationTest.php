<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLocalizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pages_render_indonesian_copy_by_default(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertSeeText('Pusat Operasional');
        $response->assertSeeText('Ikhtisar');
        $response->assertSeeText('Ruang Kerja Admin');
        $response->assertSeeText('Sesi');
    }

    public function test_admin_pages_render_english_copy_when_locale_is_en(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)
            ->withSession(['locale' => 'en'])
            ->get(route('admin.products.create'));

        $response->assertOk();
        $response->assertSeeText('Operations Hub');
        $response->assertSeeText('Catalog');
        $response->assertSeeText('Public catalog');
        $response->assertSeeText('SEO Title');
        $response->assertSeeText('Featured');
        $response->assertSeeText('Gallery Images');
        $response->assertSeeText('Attachment');
    }
}
