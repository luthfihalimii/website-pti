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
use Throwable;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::query()
                ->with('category')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->paginate(15),
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
        $storedFiles = [];

        try {
            DB::transaction(function () use ($request, &$storedFiles): void {
                $validated = $request->validated();
                $coverImagePath = $request->hasFile('cover_image')
                    ? $this->storeUploadedFile($request->file('cover_image'), 'products/covers', 'public', $storedFiles)
                    : null;

                $product = Product::create([
                    ...collect($validated)->except([
                        'cover_image',
                        'feature_titles',
                        'feature_descriptions',
                        'gallery_images',
                        'attachment_titles',
                        'attachment_files',
                    ])->toArray(),
                    'cover_image_path' => $coverImagePath,
                    'cover_image_disk' => $coverImagePath ? 'public' : null,
                    'is_featured' => $request->boolean('is_featured'),
                ]);

                $this->syncFeatures($product, $request->input('feature_titles', []), $request->input('feature_descriptions', []));
                $this->storeGalleryImages($product, $request->file('gallery_images', []), $storedFiles);
                $this->storeAttachments($product, $request->input('attachment_titles', []), $request->file('attachment_files', []), $storedFiles);
            });
        } catch (Throwable $exception) {
            $this->deleteStoredFiles($storedFiles);

            throw $exception;
        }

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
        $storedFiles = [];
        $obsoleteFiles = [];

        try {
            DB::transaction(function () use ($request, $product, &$storedFiles, &$obsoleteFiles): void {
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
                    $data['cover_image_path'] = $this->storeUploadedFile($request->file('cover_image'), 'products/covers', 'public', $storedFiles);
                    $data['cover_image_disk'] = 'public';

                    if ($product->cover_image_path && $product->cover_image_disk) {
                        $obsoleteFiles[] = $this->fileReference($product->cover_image_disk, $product->cover_image_path);
                    }
                }

                $product->update($data);

                if ($request->exists('feature_titles') || $request->exists('feature_descriptions')) {
                    $product->features()->delete();
                    $this->syncFeatures($product, $request->input('feature_titles', []), $request->input('feature_descriptions', []));
                }

                if ($request->hasFile('gallery_images')) {
                    $existingMedia = $product->media()->get(['id', 'path', 'disk']);

                    $this->storeGalleryImages($product, $request->file('gallery_images', []), $storedFiles);
                    ProductMedia::query()->whereKey($existingMedia->modelKeys())->delete();

                    foreach ($existingMedia as $media) {
                        $obsoleteFiles[] = $this->fileReference($media->disk, $media->path);
                    }
                }

                if ($request->hasFile('attachment_files')) {
                    $existingAttachments = $product->attachments()->get(['id', 'path', 'disk']);

                    $this->storeAttachments($product, $request->input('attachment_titles', []), $request->file('attachment_files', []), $storedFiles);
                    ProductAttachment::query()->whereKey($existingAttachments->modelKeys())->delete();

                    foreach ($existingAttachments as $attachment) {
                        $obsoleteFiles[] = $this->fileReference($attachment->disk, $attachment->path);
                    }
                }
            });
        } catch (Throwable $exception) {
            $this->deleteStoredFiles($storedFiles);

            throw $exception;
        }

        $this->deleteStoredFiles($obsoleteFiles);

        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->load(['media:id,product_id,path,disk', 'attachments:id,product_id,path,disk']);

        $filesToDelete = [];

        if ($product->cover_image_path && $product->cover_image_disk) {
            $filesToDelete[] = $this->fileReference($product->cover_image_disk, $product->cover_image_path);
        }

        foreach ($product->media as $media) {
            $filesToDelete[] = $this->fileReference($media->disk, $media->path);
        }

        foreach ($product->attachments as $attachment) {
            $filesToDelete[] = $this->fileReference($attachment->disk, $attachment->path);
        }

        DB::transaction(function () use ($product): void {
            $product->delete();
        });

        $this->deleteStoredFiles($filesToDelete);

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
    private function storeGalleryImages(Product $product, array $images, array &$storedFiles): void
    {
        foreach ($images as $index => $image) {
            ProductMedia::create([
                'product_id' => $product->id,
                'path' => $this->storeUploadedFile($image, 'products/gallery', 'public', $storedFiles),
                'disk' => 'public',
                'alt_text' => $product->name.' gallery '.($index + 1),
                'sort_order' => $index,
            ]);
        }
    }

    /**
     * @param  array<int, UploadedFile>  $files
     */
    private function storeAttachments(Product $product, array $titles, array $files, array &$storedFiles): void
    {
        foreach ($files as $index => $file) {
            ProductAttachment::create([
                'product_id' => $product->id,
                'title' => $titles[$index] ?? ('Attachment '.($index + 1)),
                'path' => $this->storeUploadedFile($file, 'products/attachments', 'public', $storedFiles),
                'disk' => 'public',
                'mime_type' => $file->getClientMimeType(),
                'sort_order' => $index,
            ]);
        }
    }

    private function storeUploadedFile(UploadedFile $file, string $directory, string $disk, array &$storedFiles): string
    {
        $path = $file->store($directory, $disk);
        $storedFiles[] = $this->fileReference($disk, $path);

        return $path;
    }

    private function deleteStoredFiles(array $storedFiles): void
    {
        foreach ($storedFiles as $file) {
            Storage::disk($file['disk'])->delete($file['path']);
        }
    }

    /**
     * @return array{disk: string, path: string}
     */
    private function fileReference(string $disk, string $path): array
    {
        return [
            'disk' => $disk,
            'path' => $path,
        ];
    }
}
