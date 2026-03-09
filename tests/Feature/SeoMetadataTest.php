<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoMetadataTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_exposes_canonical_open_graph_and_twitter_metadata(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('<link rel="canonical"', false);
        $response->assertSee('property="og:url"', false);
        $response->assertSee('property="og:type"', false);
        $response->assertSee('name="twitter:card"', false);
        $response->assertSee('name="twitter:title"', false);
    }

    public function test_product_detail_page_exposes_its_canonical_url(): void
    {
        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
            'status' => Product::STATUS_PUBLISHED,
            'slug' => 'security-suite',
        ]);

        $response = $this->get(route('products.show', $product->slug));

        $response->assertOk();
        $response->assertSee('href="'.route('products.show', $product->slug).'"', false);
        $response->assertSee('property="og:url"', false);
    }
}
