<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeLandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_shows_primary_landing_sections(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSeeText('Business Intelligence');
        $response->assertSeeText('Layanan');
        $response->assertSeeText('Produk Unggulan Kami');
        $response->assertSeeText('Klien Kami');
    }

    public function test_home_hero_uses_stable_alignment_layout(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('hero-content-grid', false);
    }

    public function test_home_product_summary_script_renders_paragraphs_without_inner_html(): void
    {
        $category = ProductCategory::factory()->create();

        Product::factory()->create([
            'product_category_id' => $category->id,
            'name' => 'Security Suite',
            'slug' => 'security-suite',
            'excerpt' => '<img src=x onerror="alert(1)">',
            'description' => 'Deskripsi produk keamanan digital.',
            'status' => Product::STATUS_PUBLISHED,
            'is_featured' => true,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertDontSee('summary.innerHTML', false);
        $response->assertSee('summary.replaceChildren(', false);
        $response->assertSee('paragraphElement.textContent = paragraph;', false);
        $response->assertDontSee('<img src=x onerror="alert(1)">', false);
    }

    public function test_home_client_section_exposes_scroll_controls(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('data-client-track', false);
        $response->assertSee('data-client-arrow="prev"', false);
        $response->assertSee('data-client-arrow="next"', false);
        $response->assertSee('clientTrack.scrollBy({', false);
    }
}
