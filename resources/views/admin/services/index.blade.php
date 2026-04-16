@extends('layouts.admin')

@section('title', 'Layanan Produk')

@section('content')
  <section class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
      <div>
        <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-blue-700">{{ __('Struktur Layanan') }}</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-950">Layanan</h1>
        <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600">Kelola layanan produk yang akan ditampilkan dalam katalog.</p>
      </div>
      <div class="flex items-center gap-3">
        <div class="rounded-2xl bg-slate-950 px-5 py-4 text-white shadow-lg shadow-slate-950/10">
          <p class="text-[11px] uppercase tracking-[0.28em] text-blue-300">Total Layanan</p>
          <p class="mt-2 text-3xl font-semibold">{{ $services->total() }}</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
          Tambah Layanan
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
          <th class="px-5 py-4 font-semibold">Kategori</th>
          <th class="px-5 py-4 font-semibold">Status</th>
          <th class="px-5 py-4 font-semibold">Urutan</th>
          <th class="px-5 py-4 font-semibold"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200">
        @forelse ($services as $service)
          <tr>
            <td class="px-5 py-4 font-medium text-slate-950">{{ $service->name }}</td>
            <td class="px-5 py-4 text-slate-600">{{ $service->category->name }}</td>
            <td class="px-5 py-4 text-slate-600">{{ $service->status }}</td>
            <td class="px-5 py-4 text-slate-600">{{ $service->sort_order }}</td>
            <td class="px-5 py-4 text-right">
              <div class="admin-table-actions inline-flex items-center gap-4 whitespace-nowrap">
                <a href="{{ route('admin.services.edit', $service) }}" class="font-semibold text-blue-600 hover:text-blue-700">Edit</a>
                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="font-semibold text-red-600 hover:text-red-700">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-5 py-12 text-center text-slate-500">Belum ada layanan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    </div>
  </div>

  @if ($services->hasPages())
    <div class="mt-6">
      {{ $services->links() }}
    </div>
  @endif
@endsection