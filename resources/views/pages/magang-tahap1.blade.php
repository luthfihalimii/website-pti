@extends('layouts.app')

@section('title', __('Magang Tahap 1') . ' - Piramidasoft')
@section('meta_description', __('Tahap 1 pendaftaran magang Piramidasoft. Lengkapi data pribadi dan data sekolah atau universitas untuk melanjutkan proses pendaftaran.'))

@section('content')
<<<<<<< HEAD

{{-- HERO --}}
<section style="position:relative; width:100%; height:253px; overflow:hidden;">
  <img src="{{ asset('assets/images/hero-pages.png') }}"
       alt="Hero"
       style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; z-index:0;">
  <div style="position:absolute; inset:0; background:rgba(37,99,235,.55); z-index:1;"></div>

  <div style="position:relative; z-index:2; height:253px; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#fff;">
    <div style="font-size:68px; font-weight:800; line-height:1; margin-bottom:12px;">Karir</div>
    <div style="display:flex; align-items:center; gap:10px; font-size:21px; font-weight:700;">
      <span>Home</span>
      <span style="display:inline-block; width:12px; height:3px; background:#fff;"></span>
      <span>Magang</span>
=======
{{-- Hero Section (samakan dengan halaman lain) --}}
<section class="relative w-full h-[253px] bg-gradient-to-r from-blue-600/80 to-blue-400/80 overflow-hidden">
  <img
    src="{{ asset('assets/images/hero-pages.png') }}"
    alt="{{ __('Hero Background') }}"
    class="absolute inset-0 w-full h-full object-cover -z-10"
  >

  <div class="relative max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
    <h1 class="text-4xl sm:text-5xl lg:text-[68px] font-bold text-shadow-lg mb-4">
      {{ __('Karir') }}
    </h1>

    <div class="flex items-center gap-2 text-base sm:text-lg lg:text-[21px] font-semibold">
      <span>{{ __('Home') }}</span>
      <div class="w-3 h-[3px] bg-white"></div>
      <span>{{ __('Magang') }}</span>
>>>>>>> 07ac7de0454cf7b18502aca1ab1a400169064860
    </div>
  </div>
</section>

{{-- CONTENT WRAP --}}
<div style="max-width:1200px; margin:0 auto; padding:40px 20px; background:#fff;">

  {{-- STEPPER --}}
  <div style="display:flex;align-items:center;gap:18px;margin-bottom:26px;flex-wrap:nowrap;white-space:nowrap;">
    
    <!-- Tahap 1 (aktif) -->
    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#2563EB;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="#fff">
          <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-4.41 0-8 2-8 4.5V21h16v-2.5C20 16 16.41 14 12 14Z"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#2563EB;">Tahap 1</span>
    </div>
    <!-- Arrow 1 (biru) -->
    <span style="font-size:28px;font-weight:600;color:#2563EB;line-height:1;">›</span>
    
    <!-- Tahap 2 -->
    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#93C5FD;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
          <path d="M9 6V5a3 3 0 0 1 6 0v1h3a2 2 0 0 1 2 2v3H4V8a2 2 0 0 1 2-2h3Zm2 0h2V5a1 1 0 0 0-2 0v1Zm-7 6h16v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6Z"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#9CA3AF;">Tahap 2</span>
    </div>
    <!-- Arrow 2 (abu) -->
     <span style="font-size:28px;font-weight:600;color:#C5C5C5;line-height:1;">›</span>
    
    <!-- Selesai -->
    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#93C5FD;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
          <circle cx="12" cy="12" r="10"/>
          <path d="M8 12l3 3 5-5" stroke="#2563EB" stroke-width="2" fill="none"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#9CA3AF;">Selesai</span>
    </div>
    <!-- Arrow 3 (abu) -->
    <span style="font-size:28px;font-weight:600;color:#C5C5C5;">›</span>
  </div>

  {{-- FORM GRID --}}
  <form method="GET" action="/magang/tahap-2">
    @csrf

<<<<<<< HEAD
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:22px 40px;">
=======
                    {{-- USER ICON --}}
                    <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4zm0 2c-4.42 0-8 2-8 4.5V21h16v-2.5C20 16 16.42 14 12 14z"/>
                    </svg>
                </div>
                
                <span class="text-blue-600 font-semibold text-lg">{{ __('Tahap 1') }}</span>
                <span class="text-4xl font-sm leading-none text-blue-600 -mt-1">›</span>
            </div>
>>>>>>> 07ac7de0454cf7b18502aca1ab1a400169064860

      {{-- Nama Lengkap --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Nama Lengkap</div>
        <input type="text" placeholder="Nama Lengkap"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>

<<<<<<< HEAD
      {{-- NISN/NIM --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">NISN/NIM</div>
        <input type="text" placeholder="NISN/NIM"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>

      {{-- Tempat Lahir --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Tempat Lahir</div>
        <input type="text" placeholder="Tempat Lahir"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>

      {{-- Tanggal Lahir --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Tanggal Lahir</div>
        <div style="position:relative;">
          <input type="text" placeholder="hh/bb/tttt"
          onfocus="this.type='date'"
          onblur="if(!this.value)this.type='text'"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 46px 0 18px; outline:none;">
          <span style="position:absolute; right:14px; top:50%; transform:translateY(-50%); color:#111827;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M7 2a1 1 0 0 1 1 1v1h8V3a1 1 0 1 1 2 0v1h1a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h1V3a1 1 0 0 1 1-1Zm12 8H5v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V10ZM6 6a1 1 0 0 0-1 1v1h14V7a1 1 0 0 0-1-1H6Z"/>
            </svg>
          </span>
=======
                    {{-- BRIEFCASE ICON --}}
                    <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 2h4a2 2 0 0 1 2 2v2h4a2 2 0 0 1 2 2v3H2V8a2 2 0 0 1 2-2h4V4a2 2 0 0 1 2-2zm0 4h4V4h-4v2z"/>
                        <path d="M2 13h20v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7z"/>
                    </svg>
                </div>
                
                <span class="text-gray-400 font-medium text-lg">{{ __('Tahap 2') }}</span>
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
                
                <span class="text-gray-400 font-medium text-lg">{{ __('Selesai') }}</span>
            </div>
>>>>>>> 07ac7de0454cf7b18502aca1ab1a400169064860
        </div>
      </div>

      {{-- Text (radio) --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Text</div>
        <div style="display:flex; align-items:center; gap:26px; height:48px; color:#6B7280;">
          <label style="display:flex; align-items:center; gap:8px;">
            <input type="radio" name="jk" style="width:18px; height:18px;"> Laki-laki
          </label>
          <label style="display:flex; align-items:center; gap:8px;">
            <input type="radio" name="jk" style="width:18px; height:18px;"> Perempuan
          </label>
        </div>
      </div>

      <div></div>

      {{-- Alamat --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Alamat</div>
        <textarea rows="4"
        style="width:100%; border:1px solid #9CA3AF; border-radius:10px; padding:14px 18px; outline:none; resize:none;"></textarea>
      </div>

      {{-- No. Telp --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">No. Telp</div>
        <input type="text" placeholder="0812345678"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>

      {{-- Kelas --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Kelas</div>
        <select id="kelasSelect"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; color:#9CA3AF;"
          onchange="ubahWarnaKelas()">
        
          <option value="" disabled selected>Kelas</option>
          <option>X</option>
          <option>XI</option>
          <option>XII</option>
          <option>D3</option>
          <option>S1</option>
          <option>S2</option>
        </select>
      </div>

      <script>
      function ubahWarnaKelas(){
        var select = document.getElementById("kelasSelect");
        if(select.value !== ""){
          select.style.color = "#111827"; // jadi hitam setelah dipilih
          }
        }
      </script>

      {{-- Sekolah/Universitas --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Sekolah/Universitas</div>
        <input type="text" placeholder="Sekolah/Universitas"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>

      {{-- Alamat Sekolah/Universitas --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Alamat Sekolah/Universitas</div>
        <textarea rows="4"
        style="width:100%; border:1px solid #9CA3AF; border-radius:10px; padding:14px 18px; outline:none; resize:none;"></textarea>
      </div>

      {{-- No. Telp. Sekolah/Universitas --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">No. Telp. Sekolah/Universitas</div>
        <input type="text" placeholder="0812345678"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>
    </div>

<<<<<<< HEAD
      {{-- BUTTON SELANJUTNYA --}}
      <a href="{{ url('/magang/tahap-2') }}"
      style="
        display:inline-flex;
        align-items:center;
        gap:10px;
        margin-top:24px;
        background:#2563EB;
        color:white;
        padding:12px 32px;
        border-radius:10px;
        text-decoration:none;
        font-weight:600;
        cursor:pointer;
        transition:0.2s;
        "
        onmouseover="this.style.background='#1D4ED8'"
        onmouseout="this.style.background='#2563EB'">
=======
    {{-- FORM CARD --}}
  <div class="bg-white rounded-2xl border border-slate-200 shadow-[0_10px_30px_rgba(0,0,0,0.08)] p-8">
    @if (session('internship_status'))
      <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('internship_status') }}
      </div>
    @endif

    @if (session('internship_error'))
      <div class="mb-6 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
        {{ session('internship_error') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <p class="font-semibold">{{ __('Periksa kembali data berikut:') }}</p>
        <ul class="mt-2 list-disc list-inside space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('internships.steps.one.store') }}" method="POST" class="space-y-6">
      @csrf
>>>>>>> 07ac7de0454cf7b18502aca1ab1a400169064860

        Selanjutnya
      
        <svg xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none">

<<<<<<< HEAD
        <path d="M5 12H19"
          stroke="white"
          stroke-width="3"
          stroke-linecap="round"/>

        <path d="M13 6L19 12L13 18"
          stroke="white"
          stroke-width="3"
          stroke-linecap="round"
          stroke-linejoin="round"/>
        </svg>
      </a>
    </div>
  </form>
</div>

@endsection
=======
        {{-- Nama Lengkap --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">{{ __('Nama Lengkap') }}</label>
          <input type="text" name="nama" value="{{ old('nama', $stepOneData['nama'] ?? '') }}" placeholder="{{ __('Nama Lengkap') }}"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

        {{-- NISN/NIM --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">{{ __('NISN/NIM') }}</label>
          <input type="text" name="nisn" value="{{ old('nisn', $stepOneData['nisn'] ?? '') }}" placeholder="{{ __('NISN/NIM') }}"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

        {{-- Tempat Lahir --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">{{ __('Tempat Lahir') }}</label>
          <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $stepOneData['tempat_lahir'] ?? '') }}" placeholder="{{ __('Tempat Lahir') }}"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

        {{-- Tanggal Lahir --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">{{ __('Tanggal Lahir') }}</label>
          <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $stepOneData['tanggal_lahir'] ?? '') }}"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

        {{-- Jenis Kelamin --}}
        <div class="md:col-span-2">
          <label class="block text-slate-900 font-medium mb-3">{{ __('Jenis Kelamin') }}</label>
          <div class="flex items-center gap-8">
            <label class="inline-flex items-center gap-2 text-slate-600">
              <input type="radio" name="jk" value="Laki-laki" @checked(old('jk', $stepOneData['jk'] ?? '') === 'Laki-laki') class="w-4 h-4 accent-blue-600" />
              {{ __('Laki-laki') }}
            </label>
            <label class="inline-flex items-center gap-2 text-slate-600">
              <input type="radio" name="jk" value="Perempuan" @checked(old('jk', $stepOneData['jk'] ?? '') === 'Perempuan') class="w-4 h-4 accent-blue-600" />
              {{ __('Perempuan') }}
            </label>
          </div>
        </div>

        {{-- Alamat --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">{{ __('Alamat') }}</label>
          <textarea name="alamat" rows="4"
            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40">{{ old('alamat', $stepOneData['alamat'] ?? '') }}</textarea>
        </div>

        {{-- No. Telp --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">{{ __('No. Telp') }}</label>
          <input type="text" name="telp" value="{{ old('telp', $stepOneData['telp'] ?? '') }}" placeholder="0812345678"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

        {{-- Kelas --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">{{ __('Kelas') }}</label>
          <select name="kelas"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40">
            <option value="" selected disabled>{{ __('Pilih Kelas') }}</option>
            @foreach (['X', 'XI', 'XII', 'D3', 'S1'] as $kelas)
              <option value="{{ $kelas }}" @selected(old('kelas', $stepOneData['kelas'] ?? '') === $kelas)>{{ $kelas }}</option>
            @endforeach
          </select>
        </div>

        {{-- Sekolah/Universitas --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">{{ __('Sekolah/Universitas') }}</label>
          <input type="text" name="sekolah" value="{{ old('sekolah', $stepOneData['sekolah'] ?? '') }}" placeholder="{{ __('Sekolah/Universitas') }}"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

        {{-- Alamat Sekolah/Universitas --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">{{ __('Alamat Sekolah/Universitas') }}</label>
          <textarea name="alamat_sekolah" rows="4"
            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40">{{ old('alamat_sekolah', $stepOneData['alamat_sekolah'] ?? '') }}</textarea>
        </div>

        {{-- No. Telp Sekolah/Universitas --}}
        <div>
          <label class="block text-slate-900 font-medium mb-2">{{ __('No. Telp. Sekolah/Universitas') }}</label>
          <input type="text" name="telp_sekolah" value="{{ old('telp_sekolah', $stepOneData['telp_sekolah'] ?? '') }}" placeholder="0812345"
            class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" />
        </div>

      </div>

      {{-- BUTTON --}}
      <div class="pt-2">
        <button type="submit"
           class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-medium shadow hover:bg-blue-700 transition">
          {{ __('Selanjutnya') }}
          <span class="text-xl font-bold leading-none">›</span>
        </button>
      </div>

    </form>
  </div>
</section>
@endsection
>>>>>>> 07ac7de0454cf7b18502aca1ab1a400169064860
