@extends('layouts.admin')

@section('title', 'Lowongan Pekerjaan')

@section('content')
  <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
      <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">Recruitment</p>
      <h1 class="mt-2 text-3xl font-bold text-slate-950">Lowongan Pekerjaan</h1>
    </div>
    <a href="{{ route('admin.vacancies.create') }}" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
      Tambah Lowongan
    </a>
  </div>

  <div class="mt-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
      <table class="min-w-[760px] divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-slate-600">
          <tr>
            <th class="px-5 py-4 font-semibold">Judul</th>
            <th class="px-5 py-4 font-semibold">Slug</th>
            <th class="px-5 py-4 font-semibold">Tipe</th>
            <th class="px-5 py-4 font-semibold">Status</th>
            <th class="px-5 py-4 font-semibold">Urutan</th>
            <th class="px-5 py-4 font-semibold"></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
          @forelse ($vacancies as $vacancy)
            <tr>
              <td class="px-5 py-4 font-medium text-slate-950">{{ $vacancy->title }}</td>
              <td class="px-5 py-4 text-slate-600">{{ $vacancy->slug }}</td>
              <td class="px-5 py-4 text-slate-600">{{ $vacancy->employment_type ?: '-' }}</td>
              <td class="px-5 py-4 text-slate-600">{{ $vacancy->is_active ? 'Aktif' : 'Nonaktif' }}</td>
              <td class="px-5 py-4 text-slate-600">{{ $vacancy->sort_order }}</td>
              <td class="px-5 py-4 text-right">
                <div class="admin-table-actions inline-flex items-center gap-4 whitespace-nowrap">
                  <a href="{{ route('admin.vacancies.edit', $vacancy) }}" class="font-semibold text-blue-600 hover:text-blue-700">Edit</a>
                  <form action="{{ route('admin.vacancies.destroy', $vacancy) }}" method="POST" onsubmit="return confirm('Hapus lowongan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="font-semibold text-red-600 hover:text-red-700">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-5 py-12 text-center text-slate-500">Belum ada lowongan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
