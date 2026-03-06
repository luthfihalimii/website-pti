@extends('layouts.admin')

@section('title', 'Kategori Produk')

@section('content')
  <div class="flex items-end justify-between gap-4">
    <div>
      <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">Product Categories</p>
      <h1 class="mt-2 text-3xl font-bold text-slate-950">Kategori Produk</h1>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
      Tambah Kategori
    </a>
  </div>

  <div class="mt-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
      <thead class="bg-slate-50 text-left text-slate-600">
        <tr>
          <th class="px-5 py-4 font-semibold">Nama</th>
          <th class="px-5 py-4 font-semibold">Slug</th>
          <th class="px-5 py-4 font-semibold">Urutan</th>
          <th class="px-5 py-4 font-semibold">Status</th>
          <th class="px-5 py-4 font-semibold"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200">
        @forelse ($categories as $category)
          <tr>
            <td class="px-5 py-4 font-medium text-slate-950">{{ $category->name }}</td>
            <td class="px-5 py-4 text-slate-600">{{ $category->slug }}</td>
            <td class="px-5 py-4 text-slate-600">{{ $category->sort_order }}</td>
            <td class="px-5 py-4 text-slate-600">{{ $category->is_active ? 'Aktif' : 'Nonaktif' }}</td>
            <td class="px-5 py-4 text-right">
              <a href="{{ route('admin.categories.edit', $category) }}" class="font-semibold text-blue-600 hover:text-blue-700">Edit</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-5 py-12 text-center text-slate-500">Belum ada kategori produk.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
