@extends('layouts.admin')

@section('title', 'Tambah Logo')

@section('content')
<div class="max-w-2xl mx-auto">

  <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

    <div class="mb-6">
      <h1 class="text-xl font-semibold text-slate-900">Tambah Logo</h1>
      <p class="text-sm text-slate-500 mt-1">Upload logo untuk navbar, footer, atau client</p>
    </div>

    @if ($errors->any())
      <div class="mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
      @csrf

      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Tipe Logo</label>
        <select name="type" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
          <option value="pti">Logo Navbar</option>
          <option value="client" selected>Logo Client</option>
          <option value="footer">Logo Footer</option>
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Client (jika tipe Client)</label>
        <input type="text" name="name" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200" placeholder="Nama Client">
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Upload Logo</label>
        <input type="file" name="logo" accept="image/*" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm bg-white">
        <p class="text-xs text-slate-500 mt-1">Format: PNG, JPG, JPEG, SVG (max 2MB)</p>
      </div>

      <div class="flex items-center justify-between">
        <a href="{{ route('admin.logos.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Kembali</a>
        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">Upload Logo</button>
      </div>

    </form>
  </div>

</div>
@endsection