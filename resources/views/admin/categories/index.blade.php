@extends('layouts.admin')

@section('title', 'Kategori Produk')

@section('content')
  <section class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
      <div>
        <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-blue-700">{{ __('Struktur Katalog') }}</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-950">Kategori Produk</h1>
        <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600">Kelola struktur kategori agar katalog publik tetap rapi dan mudah difilter oleh pengunjung.</p>
      </div>
      <div class="flex items-center gap-3">
        <div class="rounded-2xl bg-slate-950 px-5 py-4 text-white shadow-lg shadow-slate-950/10">
          <p class="text-[11px] uppercase tracking-[0.28em] text-blue-300">Total Kategori</p>
          <p class="mt-2 text-3xl font-semibold">{{ $categories->total() }}</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
          Tambah Kategori
        </a>
      </div>
    </div>
  </section>

  <div class="mt-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
      <table class="min-w-[760px] divide-y divide-slate-200 text-sm">
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
              <div class="admin-table-actions inline-flex items-center gap-4 whitespace-nowrap">
                <a href="{{ route('admin.categories.edit', $category) }}" class="font-semibold text-blue-600 hover:text-blue-700">Edit</a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="font-semibold text-red-600 hover:text-red-700">Hapus</button>
                </form>
              </div>
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
  </div>

  @if ($categories->hasPages())
    <div class="mt-6">
      {{ $categories->links() }}
    </div>
  @endif
@endsection