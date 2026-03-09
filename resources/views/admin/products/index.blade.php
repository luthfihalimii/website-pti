@extends('layouts.admin')

@section('title', 'Produk')

@section('content')
  <div class="flex items-end justify-between gap-4">
    <div>
      <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">Products</p>
      <h1 class="mt-2 text-3xl font-bold text-slate-950">Produk</h1>
    </div>
    <a href="{{ route('admin.products.create') }}" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
      Tambah Produk
    </a>
  </div>

  <div class="mt-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
      <thead class="bg-slate-50 text-left text-slate-600">
        <tr>
          <th class="px-5 py-4 font-semibold">Nama</th>
          <th class="px-5 py-4 font-semibold">Kategori</th>
          <th class="px-5 py-4 font-semibold">Status</th>
          <th class="px-5 py-4 font-semibold">Featured</th>
          <th class="px-5 py-4 font-semibold"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200">
        @forelse ($products as $product)
          <tr>
            <td class="px-5 py-4 font-medium text-slate-950">{{ $product->name }}</td>
            <td class="px-5 py-4 text-slate-600">{{ $product->category->name }}</td>
            <td class="px-5 py-4 text-slate-600">{{ ucfirst($product->status) }}</td>
            <td class="px-5 py-4 text-slate-600">{{ $product->is_featured ? 'Ya' : 'Tidak' }}</td>
            <td class="px-5 py-4 text-right">
              <div class="inline-flex items-center gap-4">
                <a href="{{ route('admin.products.edit', $product) }}" class="font-semibold text-blue-600 hover:text-blue-700">Edit</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="font-semibold text-red-600 hover:text-red-700">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-5 py-12 text-center text-slate-500">Belum ada produk.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
