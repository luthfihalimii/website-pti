@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
  <div class="rounded-3xl bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-bold text-slate-950">Edit Kategori Produk</h1>
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="mt-8">
      @php($method = 'PUT')
      @include('admin.categories._form')
    </form>

    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="mt-4" onsubmit="return confirm('Hapus kategori ini?');">
      @csrf
      @method('DELETE')
      <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 ring-1 ring-red-200 transition hover:bg-red-100">
        Hapus Kategori
      </button>
    </form>
  </div>
@endsection
