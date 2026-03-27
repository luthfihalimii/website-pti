@extends('layouts.admin')

@section('title', 'Logo & Icon')

@section('content')
<div class="space-y-8">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- PTI --}}
    <div class="bg-white p-6 rounded-2xl border shadow-sm">
        <h2 class="font-semibold text-lg mb-3">Logo PTI (Navbar/Header)</h2>
        @if($pti)
            <img src="{{ asset('storage/'.$pti->path) }}" alt="Logo PTI" class="h-16 mb-3 object-contain">
            <form action="{{ route('admin.logos.update', $pti) }}" method="POST" enctype="multipart/form-data" class="flex gap-2 items-center">
                @csrf
                @method('PUT')
                <input type="file" name="logo" accept="image/*" class="border rounded px-2 py-1 text-sm">
                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Ganti</button>
            </form>
        @else
            <form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data" class="flex gap-2 items-center">
                @csrf
                <input type="file" name="logo" accept="image/*" required class="border rounded px-2 py-1 text-sm">
                <input type="hidden" name="type" value="pti">
                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Upload</button>
            </form>
        @endif
    </div>

    {{-- CLIENT --}}
    <div class="bg-white p-6 rounded-2xl border shadow-sm">
        <h2 class="font-semibold text-lg mb-3">Logo Client</h2>
        <form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data" class="flex gap-2 mb-4 items-center">
            @csrf
            <input type="file" name="logo" accept="image/*" required class="border rounded px-2 py-1 text-sm">
            <input type="text" name="name" placeholder="Nama Client" class="border rounded px-2 py-1 text-sm">
            <input type="hidden" name="type" value="client">
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Tambah</button>
        </form>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @forelse($clients as $logo)
                <div class="border rounded-xl p-3 text-center bg-white shadow-sm flex flex-col items-center">
                    <img src="{{ asset('storage/'.$logo->path) }}" class="h-12 mb-3 object-contain w-full">
                    <form action="{{ route('admin.logos.update', $logo) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2 w-full">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" value="{{ $logo->name }}" placeholder="Nama Client" class="border rounded px-2 py-1 text-sm w-full">
                        <input type="file" name="logo" accept="image/*" class="text-sm w-full">
                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Simpan</button>
                    </form>
                    <form action="{{ route('admin.logos.destroy', $logo) }}" method="POST" class="mt-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus logo ini?')" class="text-red-500 text-sm hover:underline">Hapus</button>
                    </form>
                </div>
            @empty
                <p class="text-slate-500 col-span-full text-center">Belum ada logo client</p>
            @endforelse
        </div>
    </div>

    {{-- FOOTER ICON --}}
    <div class="bg-white p-6 rounded-2xl border shadow-sm">
        <h2 class="font-semibold text-lg mb-3">Footer Icon</h2>
        <form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data" class="flex gap-2 mb-4 items-center">
            @csrf
            <input type="file" name="logo" accept="image/*" required class="border rounded px-2 py-1 text-sm">
            <input type="text" name="name" placeholder="Nama Icon (optional)" class="border rounded px-2 py-1 text-sm">
            <input type="hidden" name="type" value="footer">
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Tambah</button>
        </form>

        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            @forelse($footers as $logo)
                <div class="border rounded-xl p-3 text-center bg-white shadow-sm flex flex-col items-center">
                    <img src="{{ asset('storage/'.$logo->path) }}" class="h-12 mb-3 object-contain w-full">
                    <form action="{{ route('admin.logos.update', $logo) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2 w-full">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" value="{{ $logo->name }}" placeholder="Nama Icon (optional)" class="border rounded px-2 py-1 text-sm w-full">
                        <input type="file" name="logo" accept="image/*" class="text-sm w-full">
                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Simpan</button>
                    </form>
                    <form action="{{ route('admin.logos.destroy', $logo) }}" method="POST" class="mt-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus icon ini?')" class="text-red-500 text-sm hover:underline">Hapus</button>
                    </form>
                </div>
            @empty
                <p class="text-slate-500 col-span-full text-center">Belum ada icon footer</p>
            @endforelse
        </div>
    </div>

</div>
@endsection