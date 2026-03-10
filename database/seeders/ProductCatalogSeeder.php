<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductFeature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect(config('site.products.categories'))
            ->mapWithKeys(function (array $category): array {
                $model = ProductCategory::query()->updateOrCreate(
                    ['slug' => $category['key']],
                    [
                        'name' => $category['label'],
                        'description' => $category['label'].' solutions by Piramidasoft.',
                        'sort_order' => 0,
                        'is_active' => true,
                    ]
                );

                return [$category['key'] => $model];
            });

        $featuredSummaries = collect(config('site.home.featured_products'))
            ->mapWithKeys(function (array $product): array {
                return [Str::slug($product['title']) => $product['summary']];
            });

        collect(config('site.products.items'))->each(function (array $item, int $index) use ($categories, $featuredSummaries): void {
            $slug = Str::slug($item['name']);
            $category = $categories->get($item['category_key']);

            if (! $category) {
                return;
            }

            $coverPath = $this->copyLegacyAssetToPublicDisk($item['image'], $slug);

            $product = Product::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'product_category_id' => $category->id,
                    'name' => $item['name'],
                    'excerpt' => $item['description'],
                    'description' => $item['description'],
                    'status' => Product::STATUS_PUBLISHED,
                    'is_featured' => $featuredSummaries->has($slug),
                    'cover_image_path' => $coverPath,
                    'cover_image_disk' => $coverPath ? 'public' : null,
                    'seo_title' => $item['name'].' - Piramidasoft',
                    'seo_description' => $item['description'],
                    'sort_order' => $index,
                ]
            );

            $product->features()->delete();

            foreach (($featuredSummaries->get($slug) ?? [$item['description']]) as $featureIndex => $paragraph) {
                ProductFeature::create([
                    'product_id' => $product->id,
                    'title' => 'Highlight '.($featureIndex + 1),
                    'description' => $paragraph,
                    'sort_order' => $featureIndex,
                ]);
            }
        });
    }

    private function copyLegacyAssetToPublicDisk(string $relativePath, string $slug): ?string
    {
        $sourcePath = public_path($relativePath);

        if (! is_file($sourcePath)) {
            return null;
        }

        $extension = pathinfo($sourcePath, PATHINFO_EXTENSION) ?: 'png';
        $targetPath = 'products/covers/'.$slug.'.'.$extension;

        Storage::disk('public')->put($targetPath, file_get_contents($sourcePath));

        return $targetPath;
    }
}
