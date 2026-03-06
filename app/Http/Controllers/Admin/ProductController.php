<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductAttachment;
use App\Models\ProductCategory;
use App\Models\ProductFeature;
use App\Models\ProductMedia;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::query()->with('category')->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => ProductCategory::query()->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        DB::transaction(function () use ($request): void {
            $validated = $request->validated();

            $product = Product::create([
                ...collect($validated)->except([
                    'cover_image',
                    'feature_titles',
                    'feature_descriptions',
                    'gallery_images',
                    'attachment_titles',
                    'attachment_files',
                ])->toArray(),
                'cover_image_path' => $request->hasFile('cover_image')
                    ? $request->file('cover_image')->store('products/covers', 'public')
                    : null,
                'cover_image_disk' => $request->hasFile('cover_image') ? 'public' : null,
                'is_featured' => $request->boolean('is_featured'),
            ]);

            $this->syncFeatures($product, $request->input('feature_titles', []), $request->input('feature_descriptions', []));
            $this->storeGalleryImages($product, $request->file('gallery_images', []));
            $this->storeAttachments($product, $request->input('attachment_titles', []), $request->file('attachment_files', []));
        });

        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil dibuat.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product->load(['features', 'media', 'attachments']),
            'categories' => ProductCategory::query()->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        DB::transaction(function () use ($request, $product): void {
            $validated = $request->validated();

            $data = [
                ...collect($validated)->except([
                    'cover_image',
                    'feature_titles',
                    'feature_descriptions',
                    'gallery_images',
                    'attachment_titles',
                    'attachment_files',
                ])->toArray(),
                'is_featured' => $request->boolean('is_featured'),
            ];

            if ($request->hasFile('cover_image')) {
                if ($product->cover_image_path && $product->cover_image_disk) {
                    Storage::disk($product->cover_image_disk)->delete($product->cover_image_path);
                }

                $data['cover_image_path'] = $request->file('cover_image')->store('products/covers', 'public');
                $data['cover_image_disk'] = 'public';
            }

            $product->update($data);

            $this->deleteExistingMedia($product);
            $this->deleteExistingAttachments($product);
            $product->features()->delete();

            $this->syncFeatures($product, $request->input('feature_titles', []), $request->input('feature_descriptions', []));
            $this->storeGalleryImages($product, $request->file('gallery_images', []));
            $this->storeAttachments($product, $request->input('attachment_titles', []), $request->file('attachment_files', []));
        });

        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->cover_image_path && $product->cover_image_disk) {
            Storage::disk($product->cover_image_disk)->delete($product->cover_image_path);
        }

        $this->deleteExistingMedia($product);
        $this->deleteExistingAttachments($product);
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil dihapus.');
    }

    private function syncFeatures(Product $product, array $titles, array $descriptions): void
    {
        foreach ($titles as $index => $title) {
            $title = trim((string) $title);

            if ($title === '') {
                continue;
            }

            ProductFeature::create([
                'product_id' => $product->id,
                'title' => $title,
                'description' => $descriptions[$index] ?? null,
                'sort_order' => $index,
            ]);
        }
    }

    /**
     * @param  array<int, UploadedFile>  $images
     */
    private function storeGalleryImages(Product $product, array $images): void
    {
        foreach ($images as $index => $image) {
            ProductMedia::create([
                'product_id' => $product->id,
                'path' => $image->store('products/gallery', 'public'),
                'disk' => 'public',
                'alt_text' => $product->name.' gallery '.($index + 1),
                'sort_order' => $index,
            ]);
        }
    }

    /**
     * @param  array<int, UploadedFile>  $files
     */
    private function storeAttachments(Product $product, array $titles, array $files): void
    {
        foreach ($files as $index => $file) {
            ProductAttachment::create([
                'product_id' => $product->id,
                'title' => $titles[$index] ?? ('Attachment '.($index + 1)),
                'path' => $file->store('products/attachments', 'public'),
                'disk' => 'public',
                'mime_type' => $file->getClientMimeType(),
                'sort_order' => $index,
            ]);
        }
    }

    private function deleteExistingMedia(Product $product): void
    {
        foreach ($product->media as $media) {
            Storage::disk($media->disk)->delete($media->path);
        }

        $product->media()->delete();
    }

    private function deleteExistingAttachments(Product $product): void
    {
        foreach ($product->attachments as $attachment) {
            Storage::disk($attachment->disk)->delete($attachment->path);
        }

        $product->attachments()->delete();
    }
}
