<?php

namespace Tests\Feature;

use Database\Seeders\ProductCatalogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_page_shows_product_catalog_sections(): void
    {
        $this->seed(ProductCatalogSeeder::class);

        $response = $this->get('/produk');

        $response->assertOk();
        $response->assertSeeText('Katalog Produk');
        $response->assertSeeText('Semua Produk');
        $response->assertSeeText('Cari Produk');
        $response->assertSeeText('Semua kategori');
        $response->assertSeeText('HRIS/HRMS');
        $response->assertSeeText('Tendering');
        $response->assertSeeText('Insight GOV');
    }
}
