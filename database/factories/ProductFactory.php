<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = Str::title(fake()->unique()->words(3, true));

        return [
            'product_category_id' => ProductCategory::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'excerpt' => fake()->sentence(),
            'description' => fake()->paragraphs(3, true),
            'status' => Product::STATUS_PUBLISHED,
            'is_featured' => false,
            'cover_image_path' => null,
            'cover_image_disk' => null,
            'seo_title' => $name,
            'seo_description' => fake()->sentence(),
            'sort_order' => fake()->numberBetween(0, 50),
        ];
    }
}
