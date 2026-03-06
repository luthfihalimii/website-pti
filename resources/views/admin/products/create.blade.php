@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
  <div class="rounded-3xl bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-bold text-slate-950">Tambah Produk</h1>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="mt-8">
      @php($method = 'POST')
      @include('admin.products._form')
    </form>
  </div>
@endsection
