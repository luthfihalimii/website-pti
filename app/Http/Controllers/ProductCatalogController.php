<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ProductCatalogController extends Controller
{
    public function index()
    {
        $selectedCategory = request('category');
        $search = trim((string) request('q'));

        $products = Product::query()
            ->with('category')
            ->where('status', Product::STATUS_PUBLISHED)
            ->when($selectedCategory, function (Builder $query) use ($selectedCategory): void {
                $query->whereHas('category', fn (Builder $categoryQuery) => $categoryQuery->where('slug', $selectedCategory));
            })
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $innerQuery) use ($search): void {
                    $innerQuery
                        ->where('name', 'like', '%'.$search.'%')
                        ->orWhere('excerpt', 'like', '%'.$search.'%')
                        ->orWhere('description', 'like', '%'.$search.'%');
                });
            })
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(9)
            ->withQueryString();

        return view('pages.produk', [
            'products' => $products,
            'categories' => ProductCategory::query()->where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'selectedCategory' => $selectedCategory,
            'search' => $search,
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::query()
            ->with(['category', 'features', 'media', 'attachments'])
            ->where('status', Product::STATUS_PUBLISHED)
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = Product::query()
            ->with('category')
            ->where('status', Product::STATUS_PUBLISHED)
            ->where('product_category_id', $product->product_category_id)
            ->whereKeyNot($product->id)
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('pages.produk-detail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
