<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;  // Pastikan Log facade ditambahkan

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();
            $product = Product::create([
                ...$validated,
                'is_featured' => $request->boolean('is_featured', false),
            ]);

            if ($request->hasFile('cover_image')) {
                $path = $request->file('cover_image')->store('products', 'public');
                $product->cover_image_path = $path;
                $product->cover_image_disk = 'public';
                $product->save();
            }

            $product->features()->sync($request->input('features', []));
            DB::commit();

            return redirect()->route('admin.products.index')->with('status', 'Produk berhasil ditambahkan!');
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error
            Log::error("Error storing product: " . $th->getMessage(), [
                'request_data' => $request->all(),  // Menambahkan data request yang dikirim untuk membantu debugging
                'exception' => $th
            ]);

            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            return redirect()->route('admin.products.index')->withErrors('Terjadi kesalahan saat menyimpan produk.');
        }
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();
            $product->update([
                ...$validated,
                'is_featured' => $request->boolean('is_featured', false),
            ]);

            if ($request->hasFile('cover_image')) {
                if ($product->cover_image_path) {
                    Storage::disk('public')->delete($product->cover_image_path);  // Menghapus gambar lama
                }
                $path = $request->file('cover_image')->store('products', 'public');
                $product->cover_image_path = $path;
                $product->cover_image_disk = 'public';
                $product->save();
            }

            $product->features()->sync($request->input('features', []));
            DB::commit();

            return redirect()->route('admin.products.index')->with('status', 'Produk berhasil diperbarui!');
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error
            Log::error("Error updating product: " . $th->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $th
            ]);

            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            return redirect()->route('admin.products.index')->withErrors('Terjadi kesalahan saat memperbarui produk.');
        }
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();

        try {
            if ($product->cover_image_path) {
                Storage::disk('public')->delete($product->cover_image_path);
            }

            $product->features()->delete();
            $product->delete();

            DB::commit();

            return redirect()->route('admin.products.index')->with('status', 'Produk berhasil dihapus!');
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error
            Log::error("Error deleting product: " . $th->getMessage(), [
                'product_id' => $product->id,
                'exception' => $th
            ]);

            return redirect()->route('admin.products.index')->withErrors('Terjadi kesalahan saat menghapus produk.');
        }
    }
}