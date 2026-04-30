@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')
  <div class="rounded-3xl bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-bold text-slate-950">Edit Layanan</h1>
    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="mt-8">
      @csrf
      @method('PUT')

      <!-- Nama Layanan -->
      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-slate-700">Nama Layanan</label>
        <input type="text" id="name" name="name" value="{{ old('name', $service->name ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
      </div>

      <!-- Kategori Layanan -->
      <div class="mb-4">
        <label for="category_id" class="block text-sm font-medium text-slate-700">Kategori</label>
        <select id="category_id" name="category_id" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if($category->id == $service->category_id) selected @endif>{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Deskripsi Layanan -->
      <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-slate-700">Deskripsi</label>
        <textarea id="description" name="description" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" rows="4" required>{{ old('description', $service->description) }}</textarea>
      </div>

      <!-- Gambar Layanan -->
      <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-slate-700">Gambar Layanan</label>
        <input type="file" id="image" name="image" class="h-12 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
        @if ($service->image)
          <img src="{{ asset('storage/' . $service->image) }}" alt="Image" class="mt-2" width="100">
        @endif
      </div>

      <!-- Urutan Layanan -->
      <div class="mb-4">
        <label for="sort_order" class="block text-sm font-medium text-slate-700">Urutan</label>
        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
      </div>

      <!-- Status Layanan -->
      <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
        <select id="status" name="status" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
          <option value="active" {{ old('status', $service->status) == 'active' ? 'selected' : '' }}>Active</option>
          <option value="inactive" {{ old('status', $service->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
      </div>

      <!-- Tombol Simpan -->
      <button type="submit" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
        Simpan Layanan
      </button>
    </form>
  </div>
@endsection