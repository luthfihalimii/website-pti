<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductCategoryRequest;
use App\Http\Requests\Admin\UpdateProductCategoryRequest;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => ProductCategory::query()
                ->orderBy('sort_order')
                ->orderBy('name')
                ->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreProductCategoryRequest $request)
    {
        ProductCategory::create([
            ...$request->validated(),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.categories.index')->with('status', 'Kategori produk berhasil dibuat.');
    }

    public function edit(ProductCategory $category)
    {
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $category)
    {
        $category->update([
            ...$request->validated(),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.categories.index')->with('status', 'Kategori produk berhasil diperbarui.');
    }

    public function destroy(ProductCategory $category)
    {
        $deletedCount = ProductCategory::query()
            ->whereKey($category->id)
            ->doesntHave('products')
            ->delete();

        if ($deletedCount === 0) {
            return redirect()
                ->route('admin.categories.index')
                ->withErrors([
                    'category' => 'Kategori ini masih digunakan oleh produk aktif di katalog.',
                ]);
        }

        return redirect()->route('admin.categories.index')->with('status', 'Kategori produk berhasil dihapus.');
    }
}
