@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
  <div class="rounded-3xl bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-bold text-slate-950">Edit Kategori Produk</h1>
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="mt-8">
      @php($method = 'PUT')
      @include('admin.categories._form')
    </form>
  </div>
@endsection
