@extends('layouts.app')

@section('title', 'Magang Tahap 1 - Piramidasoft')

@section('content')
{{-- Hero Section (samakan dengan halaman lain) --}}
<section class="relative w-full h-[253px] bg-gradient-to-r from-blue-600/80 to-blue-400/80 overflow-hidden">
  <img
    src="{{ asset('assets/images/hero-pages.png') }}"
    alt="Hero Background"
    class="absolute inset-0 w-full h-full object-cover -z-10"
  >

  <div class="relative max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
    <h1 class="text-5xl md:text-[68px] font-bold text-shadow-lg mb-4">
      Karir
    </h1>

    <div class="flex items-center gap-2 text-lg md:text-[21px] font-semibold">
      <span>Home</span>
      <div class="w-3 h-[3px] bg-white"></div>
      <span>Magang</span>
    </div>
  </div>
</section>

{{-- Content --}}
<section class="bg-white">
    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- STEPPER --}}
        <div class="flex items-center gap-6 mb-10">

            {{-- Tahap 1 --}}
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 bg-blue-600 rounded-xl flex items-center justify-center">

                    {{-- USER ICON --}}
                    <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4zm0 2c-4.42 0-8 2-8 4.5V21h16v-2.5C20 16 16.42 14 12 14z"/>
                    </svg>
                </div>
                
                <span class="text-blue-600 font-semibold text-lg">Tahap 1</span>
                <span class="text-4xl font-sm leading-none text-blue-600 -mt-1">›</span>
            </div>

            {{-- Tahap 2 --}}
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 bg-blue-300 rounded-xl flex items-center justify-center">

                    {{-- BRIEFCASE ICON --}}
                    <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 2h4a2 2 0 0 1 2 2v2h4a2 2 0 0 1 2 2v3H2V8a2 2 0 0 1 2-2h4V4a2 2 0 0 1 2-2zm0 4h4V4h-4v2z"/>
                        <path d="M2 13h20v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7z"/>
                    </svg>
                </div>
                
                <span class="text-gray-400 font-medium text-lg">Tahap 2</span>
                <span class="text-4xl font-sm leading-none text-gray-400 -mt-1">›</span>
            </div>
            
            {{-- Selesai --}}
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 bg-blue-300 rounded-xl flex items-center justify-center">

                    {{-- CHECK ICON --}}
                    <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M9 16.2l-3.5-3.5L4 14.2l5 5 11-11-1.5-1.5L9 16.2z"/>
                    </svg>
                </div>
                
                <span class="text-gray-400 font-medium text-lg">Selesai</span>
            </div>
        </div>
    </div>

    {{-- FORM CARD --}}
  <div class="bg-white rounded-2xl border border-slate-200 shadow-[0_10px_30px_rgba(0,0,0,0.08)] p-8">
    <form action="#" method="POST" class="space-y-6">
      @csrf

      {{-- GRID 2 KOLOM --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

        {{-- Nama Lengkap --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">Nama Lengkap</label>
          <input type="text" name="nama" placeholder="Nama Lengkap"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

        {{-- NISN/NIM --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">NISN/NIM</label>
          <input type="text" name="nisn" placeholder="NISN/NIM"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

        {{-- Tempat Lahir --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">Tempat Lahir</label>
          <input type="text" name="tempat_lahir" placeholder="Tempat Lahir"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

        {{-- Tanggal Lahir --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

        {{-- Jenis Kelamin --}}
        <div class="md:col-span-2">
          <label class="block text-slate-900 font-medium mb-3">Jenis Kelamin</label>
          <div class="flex items-center gap-8">
            <label class="inline-flex items-center gap-2 text-slate-600">
              <input type="radio" name="jk" value="L" class="w-4 h-4 accent-blue-600" />
              Laki-laki
            </label>
            <label class="inline-flex items-center gap-2 text-slate-600">
              <input type="radio" name="jk" value="P" class="w-4 h-4 accent-blue-600" />
              Perempuan
            </label>
          </div>
        </div>

        {{-- Alamat --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">Alamat</label>
          <textarea name="alamat" rows="4"
            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40"></textarea>
        </div>

        {{-- No. Telp --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">No. Telp</label>
          <input type="text" name="telp" placeholder="0812345678"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

        {{-- Kelas --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">Kelas</label>
          <select name="kelas"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40">
            <option value="" selected disabled>Pilih Kelas</option>
            <option>X</option>
            <option>XI</option>
            <option>XII</option>
            <option>D3</option>
            <option>S1</option>
          </select>
        </div>

        {{-- Sekolah/Universitas --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">Sekolah/Universitas</label>
          <input type="text" name="sekolah" placeholder="Sekolah/Universitas"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

        {{-- Alamat Sekolah/Universitas --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">Alamat Sekolah/Universitas</label>
          <textarea name="alamat_sekolah" rows="4"
            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40"></textarea>
        </div>

        {{-- No. Telp Sekolah/Universitas --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">No. Telp. Sekolah/Universitas</label>
          <input type="text" name="telp_sekolah" placeholder="0812345"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

      </div>

      {{-- BUTTON --}}
      <div class="pt-2">
        <a href="{{ url('/magang/tahap-2') }}"
           class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-medium shadow hover:bg-blue-700 transition">
          Selanjutnya
          <span class="text-xl font-bold leading-none">›</span>
        </a>
      </div>

    </form>
  </div>
</section>
@endsection