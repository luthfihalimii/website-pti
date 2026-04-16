@csrf
@if ($method === 'PUT')
  @method('PUT')
@endif

<div class="grid gap-5 md:grid-cols-2">
  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Nama Kategori</span>
    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
  </label>

  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Slug</span>
    <input type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
  </label>
</div>

<label class="mt-5 block">
  <span class="mb-2 block text-sm font-medium text-slate-700">Deskripsi</span>
  <textarea name="description" rows="4" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('description', $category->description ?? '') }}</textarea>
</label>

<div class="mt-5 grid gap-5 md:grid-cols-2">
  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Urutan</span>
    <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" min="0" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
  </label>

  <label class="inline-flex items-center gap-3 pt-8 text-sm font-medium text-slate-700">
    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true)) class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-200">
    <span>Aktif</span>
  </label>
</div>

<div class="mt-8 flex gap-3">
  <button type="submit" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
    Simpan Kategori
  </button>
  <a href="{{ route('admin.categories.index') }}" class="inline-flex h-12 items-center justify-center rounded-xl border border-slate-300 px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
    Kembali
  </a>
</div>