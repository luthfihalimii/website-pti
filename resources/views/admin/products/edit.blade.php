@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
  <div class="rounded-3xl bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-bold text-slate-950">Edit Produk</h1>
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="mt-8">
      @php($method = 'PUT')
      @include('admin.products._form')
    </form>
  </div>
@endsection
