@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
  <div class="rounded-3xl bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-bold text-slate-950">Tambah Layanan</h1>
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="mt-8">
      @csrf

      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-slate-700">Nama Layanan</label>
        <input type="text" id="name" name="name" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
      </div>

      <div class="mb-4">
        <label for="category_id" class="block text-sm font-medium text-slate-700">Kategori</label>
        <select id="category_id" name="category_id" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-slate-700">Deskripsi</label>
        <textarea id="description" name="description" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" rows="4" required></textarea>
      </div>

      <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-slate-700">Gambar Layanan</label>
        <input type="file" id="image" name="image" class="h-12 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
      </div>

      <div class="mb-4">
        <label for="sort_order" class="block text-sm font-medium text-slate-700">Urutan</label>
        <input type="number" id="sort_order" name="sort_order" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700">Status</label>
        <select name="status" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm">
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
</div>

      <button type="submit" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
        Simpan Layanan
      </button>
    </form>
  </div>
@endsection