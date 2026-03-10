@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
  <div class="rounded-3xl bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-bold text-slate-950">Tambah Kategori Produk</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST" class="mt-8">
      @php($method = 'POST')
      @include('admin.categories._form')
    </form>
  </div>
@endsection
