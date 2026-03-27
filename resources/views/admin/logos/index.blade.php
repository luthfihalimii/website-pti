@extends('layouts.admin')

@section('title', 'Logo')

@section('content')
<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

  {{-- HEADER --}}
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-xl font-semibold text-slate-900">Daftar Logo</h1>
      <p class="text-sm text-slate-500 mt-1">Kelola logo navbar & footer website</p>
    </div>

    <a href="{{ route('admin.logos.create') }}"
       class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
      + Tambah Logo
    </a>
  </div>

  {{-- ALERT --}}
  @if(session('success'))
    <div class="mt-4 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
      {{ session('success') }}
    </div>
  @endif

  {{-- TABLE --}}
  <div class="mt-6 overflow-x-auto">
    <table class="w-full text-sm text-left border border-slate-200 rounded-xl overflow-hidden">
      <thead class="bg-slate-100 text-slate-600 uppercase text-xs">
        <tr>
          <th class="px-4 py-3">Type</th>
          <th class="px-4 py-3">Preview</th>
          <th class="px-4 py-3 text-center">Aksi</th>
        </tr>
      </thead>

      <tbody class="divide-y">
        @forelse ($logos as $logo)
          <tr class="hover:bg-slate-50 transition">
            <td class="px-4 py-3 font-medium text-slate-800">
              {{ strtoupper($logo->type) }}
            </td>

            <td class="px-4 py-3">
              <img src="{{ asset('storage/' . $logo->path) }}"
                   class="h-12 object-contain bg-white border rounded-lg p-2">
            </td>

            <td class="px-4 py-3 text-center">
              <form action="#" method="POST">
                @csrf
                @method('DELETE')
                <button
                  onclick="return confirm('Yakin hapus logo ini?')"
                  class="text-red-600 hover:text-red-800 text-sm font-semibold">
                  Hapus
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="text-center py-10 text-slate-500">
              Belum ada logo
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>
@endsection