<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicAccessibilityMarkupTest extends TestCase
{
    use RefreshDatabase;

    public function test_services_page_uses_accessible_tab_markup(): void
    {
        $response = $this->get(route('services'));

        $response->assertOk();
        $response->assertSee('role="tablist"', false);
        $response->assertSee('role="tab"', false);
        $response->assertSee('role="tabpanel"', false);
        $response->assertSee('aria-labelledby="tab-eprocurement"', false);
    }

    public function test_admin_login_form_uses_explicit_labels_and_autocomplete(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertOk();
        $response->assertSee('for="email"', false);
        $response->assertSee('for="password"', false);
        $response->assertSee('autocomplete="email"', false);
        $response->assertSee('autocomplete="current-password"', false);
    }

    public function test_product_inquiry_form_uses_explicit_labels(): void
    {
        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
            'status' => Product::STATUS_PUBLISHED,
        ]);

        $response = $this->get(route('products.show', $product->slug));

        $response->assertOk();
        $response->assertSee('for="product-inquiry-name"', false);
        $response->assertSee('for="product-inquiry-email"', false);
        $response->assertSee('for="product-inquiry-message"', false);
    }
}
