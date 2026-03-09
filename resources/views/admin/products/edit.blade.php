@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
  <div class="rounded-3xl bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-bold text-slate-950">Edit Produk</h1>
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="mt-8">
      @php($method = 'PUT')
      @include('admin.products._form')
    </form>

    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="mt-4" onsubmit="return confirm('Hapus produk ini?');">
      @csrf
      @method('DELETE')
      <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 ring-1 ring-red-200 transition hover:bg-red-100">
        Hapus Produk
      </button>
    </form>
  </div>
@endsection
