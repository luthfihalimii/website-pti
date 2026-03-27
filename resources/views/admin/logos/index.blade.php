@extends('layouts.admin')

@section('title', 'Logo')

@section('content')

<div class="space-y-8">

  {{-- SUCCESS --}}
  @if(session('success'))
    <div class="rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
      {{ session('success') }}
    </div>
  @endif

  {{-- LOGO PTI --}}
  <div class="bg-white p-6 rounded-2xl border shadow-sm">
    <h2 class="font-semibold text-lg mb-3">Logo Navbar (PTI)</h2>

    @if($pti)
      <img src="{{ asset('storage/'.$pti->path) }}" class="h-16 mb-3">

      <form action="{{ route('admin.logos.update', $pti) }}" method="POST" enctype="multipart/form-data" class="flex gap-2">
        @csrf
        @method('PUT')
        <input type="file" name="logo" required class="text-sm">
        <button class="bg-blue-600 text-white px-3 py-1 rounded">Ganti</button>
      </form>
    @else
      <a href="{{ route('admin.logos.create') }}" class="text-blue-600">+ Tambah Logo</a>
    @endif
  </div>

  {{-- LOGO FOOTER --}}
  <div class="bg-white p-6 rounded-2xl border shadow-sm">
    <h2 class="font-semibold text-lg mb-3">Logo Footer</h2>

    @if($footer)
      <img src="{{ asset('storage/'.$footer->path) }}" class="h-16 mb-3">

      <form action="{{ route('admin.logos.update', $footer) }}" method="POST" enctype="multipart/form-data" class="flex gap-2">
        @csrf
        @method('PUT')
        <input type="file" name="logo" required class="text-sm">
        <button class="bg-blue-600 text-white px-3 py-1 rounded">Ganti</button>
      </form>
    @else
      <a href="{{ route('admin.logos.create') }}" class="text-blue-600">+ Tambah Logo</a>
    @endif
  </div>

  {{-- LOGO CLIENT --}}
  <div class="bg-white p-6 rounded-2xl border shadow-sm">
    <div class="flex justify-between items-center mb-4">
      <h2 class="font-semibold text-lg">Logo Client</h2>

      <a href="{{ route('admin.logos.create') }}"
         class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
        + Tambah
      </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      @forelse($clients as $logo)
        <div class="border rounded-xl p-3 text-center bg-white shadow-sm">

          <img src="{{ asset('storage/'.$logo->path) }}"
               class="h-12 mx-auto object-contain mb-3">

          <form action="{{ route('admin.logos.destroy', $logo) }}" method="POST">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Hapus logo ini?')"
              class="text-red-500 text-sm">
              Hapus
            </button>
          </form>

        </div>
      @empty
        <p class="text-slate-500">Belum ada logo client</p>
      @endforelse
    </div>

  </div>

</div>

@endsection