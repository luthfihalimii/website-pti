<?php

namespace Tests\Feature;

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
}
