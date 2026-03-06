@csrf
@if ($method === 'PUT')
  @method('PUT')
@endif

@php
  $firstAttachment = isset($product) ? $product->attachments->first() : null;
@endphp

<div class="grid gap-5 md:grid-cols-2">
  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Kategori</span>
    <select name="product_category_id" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
      @foreach ($categories as $categoryOption)
        <option value="{{ $categoryOption->id }}" @selected((string) old('product_category_id', $product->product_category_id ?? '') === (string) $categoryOption->id)>{{ $categoryOption->name }}</option>
      @endforeach
    </select>
  </label>

  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Nama Produk</span>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
  </label>
</div>

<div class="mt-5 grid gap-5 md:grid-cols-2">
  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Slug</span>
    <input type="text" name="slug" value="{{ old('slug', $product->slug ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
  </label>

  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Status</span>
    <select name="status" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
      <option value="draft" @selected(old('status', $product->status ?? 'draft') === 'draft')>Draft</option>
      <option value="published" @selected(old('status', $product->status ?? 'draft') === 'published')>Published</option>
    </select>
  </label>
</div>

<label class="mt-5 block">
  <span class="mb-2 block text-sm font-medium text-slate-700">Excerpt</span>
  <textarea name="excerpt" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('excerpt', $product->excerpt ?? '') }}</textarea>
</label>

<label class="mt-5 block">
  <span class="mb-2 block text-sm font-medium text-slate-700">Deskripsi</span>
  <textarea name="description" rows="8" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>{{ old('description', $product->description ?? '') }}</textarea>
</label>

<div class="mt-5 grid gap-5 md:grid-cols-2">
  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">SEO Title</span>
    <input type="text" name="seo_title" value="{{ old('seo_title', $product->seo_title ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
  </label>

  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">SEO Description</span>
    <input type="text" name="seo_description" value="{{ old('seo_description', $product->seo_description ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
  </label>
</div>

<div class="mt-5 grid gap-5 md:grid-cols-3">
  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Urutan</span>
    <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $product->sort_order ?? 0) }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
  </label>

  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Cover Image</span>
    <input type="file" name="cover_image" accept="image/*" class="block h-12 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
  </label>

  <label class="inline-flex items-center gap-3 pt-8 text-sm font-medium text-slate-700">
    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured ?? false)) class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-200">
    <span>Featured</span>
  </label>
</div>

<div class="mt-8 rounded-2xl border border-slate-200 p-5">
  <h2 class="text-lg font-semibold text-slate-950">Feature Produk</h2>
  <div class="mt-4 space-y-4">
    @php
      $existingFeatureTitles = old('feature_titles', isset($product) ? $product->features->pluck('title')->all() : ['', '']);
      $existingFeatureDescriptions = old('feature_descriptions', isset($product) ? $product->features->pluck('description')->all() : ['', '']);
      $featureRows = max(count($existingFeatureTitles), 2);
    @endphp

    @for ($i = 0; $i < $featureRows; $i++)
      <div class="grid gap-4 md:grid-cols-2">
        <input type="text" name="feature_titles[]" value="{{ $existingFeatureTitles[$i] ?? '' }}" placeholder="Judul feature" class="h-12 rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
        <input type="text" name="feature_descriptions[]" value="{{ $existingFeatureDescriptions[$i] ?? '' }}" placeholder="Deskripsi feature" class="h-12 rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
      </div>
    @endfor
  </div>
</div>

<div class="mt-8 grid gap-5 md:grid-cols-2">
  <label class="block rounded-2xl border border-slate-200 p-5">
    <span class="mb-2 block text-sm font-medium text-slate-700">Gallery Images</span>
    <input type="file" name="gallery_images[]" accept="image/*" multiple class="block w-full text-sm">
  </label>

  <div class="rounded-2xl border border-slate-200 p-5">
    <span class="mb-2 block text-sm font-medium text-slate-700">Attachment</span>
    <div class="space-y-3">
      <input type="text" name="attachment_titles[]" value="{{ old('attachment_titles.0', $firstAttachment?->title ?? '') }}" placeholder="Judul attachment" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
      <input type="file" name="attachment_files[]" accept=".pdf,application/pdf" class="block w-full text-sm">
    </div>
  </div>
</div>

<div class="mt-8 flex gap-3">
  <button type="submit" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
    Simpan Produk
  </button>
  <a href="{{ route('admin.products.index') }}" class="inline-flex h-12 items-center justify-center rounded-xl border border-slate-300 px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
    Kembali
  </a>
</div>
