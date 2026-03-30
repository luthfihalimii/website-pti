@extends('layouts.admin')

@section('title', 'Logo Management')

@section('content')
<div class="space-y-10">

  {{-- SUCCESS MESSAGE --}}
  @if(session('success'))
    <div class="rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
      {{ session('success') }}
    </div>
  @endif

  {{-- Logo Navbar PTI --}}
  <div class="bg-white p-6 rounded-2xl border shadow-sm">
    <h2 class="font-semibold text-lg mb-3">Logo Navbar (PTI)</h2>

    @if($pti)
      <div class="flex items-center gap-2 flex-wrap">
        <img src="{{ asset('storage/'.$pti->path) }}" alt="Logo PTI" class="h-16 object-contain">

        {{-- Form Ganti --}}
        <form action="{{ route('admin.logos.update', $pti) }}" method="POST" enctype="multipart/form-data" class="flex gap-2 items-center ml-auto">
          @csrf
          @method('PUT')
          <input type="file" name="logo" accept="image/*" class="text-sm border rounded px-2 py-1">
          <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Ganti</button>
        </form>

        {{-- Tombol Hapus --}}
        <form action="{{ route('admin.logos.destroy', $pti) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus logo ini?');" class="flex-shrink-0">
          @csrf
          @method('DELETE')
          <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Hapus</button>
        </form>
      </div>
    @else
      <a href="{{ route('admin.logos.create') }}" class="text-blue-600 hover:underline">+ Tambah Logo Navbar</a>
    @endif
  </div>

  {{-- Logo Client --}}
  <div class="bg-white p-6 rounded-2xl border shadow-sm">
    <h2 class="font-semibold text-lg mb-3">Logo Client</h2>

    @forelse($clients as $client)
      <div class="flex items-center gap-2 mb-3 flex-wrap">
        <img src="{{ asset('storage/'.$client->path) }}" alt="{{ $client->name }}" class="h-16 object-contain">

        {{-- Form Ganti --}}
        <form action="{{ route('admin.logos.update', $client) }}" method="POST" enctype="multipart/form-data" class="flex gap-2 items-center ml-auto">
          @csrf
          @method('PUT')
          <input type="text" name="name" value="{{ $client->name }}" placeholder="Nama Client" class="border rounded px-2 py-1 text-sm">
          <input type="file" name="logo" accept="image/*" class="text-sm border rounded px-2 py-1">
          <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Ganti</button>
        </form>

        {{-- Tombol Hapus --}}
        <form action="{{ route('admin.logos.destroy', $client) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus logo client ini?');" class="flex-shrink-0">
          @csrf
          @method('DELETE')
          <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Hapus</button>
        </form>
      </div>
    @empty
      <p class="text-sm text-slate-500">Belum ada logo client.</p>
    @endforelse

    <a href="{{ route('admin.logos.create') }}" class="text-blue-600 hover:underline mt-2 block">+ Tambah Client Baru</a>
  </div>

  {{-- Logo Footer --}}
  <div class="bg-white p-6 rounded-2xl border shadow-sm">
    <h2 class="font-semibold text-lg mb-3">Logo Footer</h2>

    @forelse($footers as $footer)
      <div class="flex items-center gap-2 mb-3 flex-wrap">
        <img src="{{ asset('storage/'.$footer->path) }}" alt="Logo Footer" class="h-16 object-contain">

        {{-- Form Ganti --}}
        <form action="{{ route('admin.logos.update', $footer) }}" method="POST" enctype="multipart/form-data" class="flex gap-2 items-center ml-auto">
          @csrf
          @method('PUT')
          <input type="file" name="logo" accept="image/*" class="text-sm border rounded px-2 py-1">
          <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Ganti</button>
        </form>

        {{-- Tombol Hapus --}}
        <form action="{{ route('admin.logos.destroy', $footer) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus logo footer ini?');" class="flex-shrink-0">
          @csrf
          @method('DELETE')
          <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Hapus</button>
        </form>
      </div>
    @empty
      <p class="text-sm text-slate-500">Belum ada logo footer.</p>
    @endforelse

    <a href="{{ route('admin.logos.create') }}" class="text-blue-600 hover:underline mt-2 block">+ Tambah Footer Baru</a>
  </div>

</div>
@endsection