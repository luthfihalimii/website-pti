@extends('layouts.app')

<<<<<<< HEAD
@section('title', 'Magang Tahap 2 - Piramidasoft')

@section('content')

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
@section('title', __('Magang Tahap 2') . ' - Piramidasoft')
@section('meta_description', __('Tahap 2 pendaftaran magang Piramidasoft. Pilih divisi, isi motivasi, dan unggah CV untuk menyelesaikan proses pendaftaran.'))

@section('content')
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

<<<<<<< HEAD
{{-- CONTENT --}}
<div style="max-width:1200px; margin:0 auto; padding:40px 20px; background:#fff;">
  
  {{-- STEPPER --}}
  <div style="display:flex;align-items:center;gap:18px;margin-bottom:26px;flex-wrap:nowrap;white-space:nowrap;">
  
    <!-- Tahap 1 -->
    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#93C5FD;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="#fff">
          <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-4.41 0-8 2-8 4.5V21h16v-2.5C20 16 16.41 14 12 14Z"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#9CA3AF;">Tahap 1</span>
    </div>
    <!-- Arrow 1 (abu) -->
    <span style="font-size:28px;font-weight:600;color:#C5C5C5;line-height:1;">›</span>

    <!-- Tahap 2 (aktif) -->
    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#2563EB;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
          <path d="M9 6V5a3 3 0 0 1 6 0v1h3a2 2 0 0 1 2 2v3H4V8a2 2 0 0 1 2-2h3Zm2 0h2V5a1 1 0 0 0-2 0v1Zm-7 6h16v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6Z"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#2563EB;">Tahap 2</span>
    </div>
    <!-- Arrow 2 (biru) -->
    <span style="font-size:28px;font-weight:600;color:#2563EB;line-height:1;">›</span>

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
    <span style="font-size:28px;font-weight:600;color:#C5C5C5;line-height:1;">›</span>
  </div>

  {{-- FORM --}}
  <form method="POST" action="{{ route('magang.selesai') }}">
  @csrf

    {{-- GRID ATAS --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:22px 40px;align-items:start;">
      
      {{-- Divisi --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Divisi</div>
        <select id="divisiSelect"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; color:#9CA3AF;"
          onchange="ubahWarnaDivisi()">
          <option value="" disabled selected>Pilih Divisi</option>
          <option>Web Development</option>
          <option>Mobile Development</option>
          <option>UI/UX Designer</option>
          <option>IT Support</option>
        </select> 
      </div>
      
      <script>
      function ubahWarnaDivisi() {
        const select = document.getElementById("divisiSelect");

        if (select.value !== "") {
          select.style.color = "#111827";
        } else {
          select.style.color = "#9CA3AF";
        }
      }
      </script>
      
      {{-- Pernyataan --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Pernyataan</div>
        <input type="text"
        placeholder="Alasan mengapa anda memilih divisi tersebut"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>
      
      {{-- Mulai Magang --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Tanggal Mulai Magang</div>
        <div style="position:relative;">
          <input 
            type="text"
            placeholder="hh/bb/tttt"
            onfocus="this.type='date'"
            onblur="if(!this.value)this.type='text'"
            style="
            width:100%;
            height:48px;
            border:1px solid #9CA3AF;
            border-radius:10px;
            padding:0 46px 0 18px;
            outline:none;
            ">
            <span style="
              position:absolute;
              right:14px;
              top:50%;
              transform:translateY(-50%);
              color:#111827;
              pointer-events:none;
              ">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                <path d="M7 2a1 1 0 0 1 1 1v1h8V3a1 1 0 1 1 2 0v1h1a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h1V3a1 1 0 0 1 1-1Zm12 8H5v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V10ZM6 6a1 1 0 0 0-1 1v1h14V7a1 1 0 0 0-1-1H6Z"/>
              </svg>
            </span>
          </div>
        </div>
      
      {{-- Selesai Magang --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Tanggal Selesai Magang</div>
        <div style="position:relative;">
          <input 
            type="text"
            placeholder="hh/bb/tttt"
            onfocus="this.type='date'"
            onblur="if(!this.value)this.type='text'"
            style="
            width:100%;
            height:48px;
            border:1px solid #9CA3AF;
            border-radius:10px;
            padding:0 46px 0 18px;
            outline:none;
            ">
            <span style="
              position:absolute;
              right:14px;
              top:50%;
              transform:translateY(-50%);
              color:#111827;
              pointer-events:none;
              ">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                <path d="M7 2a1 1 0 0 1 1 1v1h8V3a1 1 0 1 1 2 0v1h1a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h1V3a1 1 0 0 1 1-1Zm12 8H5v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V10ZM6 6a1 1 0 0 0-1 1v1h14V7a1 1 0 0 0-1-1H6Z"/>
            </svg>
          </span>
        </div>
      </div>
      
      {{-- CV Terbaru --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">
          CV Terbaru <span style="color:red;">*</span>
        </div>
        
        <div style="
          width:100%;
          height:48px;
          border:1px solid #9CA3AF;
          border-radius:10px;
          padding:6px 12px;
          display:flex;
          align-items:center;
          background:#fff;
        ">
        <input type="file" id="cvFile" name="cv" accept=".pdf" required style="display:none;">
        <label for="cvFile"
        style="
          background:#E5E7EB;
          padding:6px 12px;
          border-radius:6px;
          cursor:pointer;
          font-size:14px;
          ">
          Choose File
          </label>
          <span id="fileName" style="font-size:14px; color:#6B7280; margin-left:10px;">
            No file chosen
          </span>
        </div>
        <div style="font-size:12px; margin-top:6px; color:#6B7280;">
          (Format File PDF)
        </div>
      </div>
      
      <script>
      document.getElementById("cvFile").addEventListener("change", function(){
        const fileName = this.files.length ? this.files[0].name : "No file chosen";
        document.getElementById("fileName").textContent = fileName;
      });
      </script>
    
      {{-- Portofolio --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Portofolio (Optional)</div>
        <input type="text"
        placeholder="Masukkan link portfolio anda (GitHub, dll)"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
        </div>
      </div>
    
    {{-- PERTANYAAN --}}
    <div style="margin-top:18px; color:#111827;">
      <div style="margin-top:16px; font-size:15px;">
        Apakah Anda bersedia mematuhi peraturan perusahaan, termasuk etika kerja dan kebijakan kerahasiaan data?
        <div style="display:flex; align-items:center; gap:70px; margin-top:10px;">
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q1" style="width:18px;height:18px;"> Ya</label>
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q1" style="width:18px;height:18px;"> Tidak</label>
        </div>
      </div>

      <div style="margin-top:16px; font-size:15px;">
        Apakah Anda sedang terikat kontrak kerja, magang, atau program lain yang dapat mengganggu komitmen Anda selama periode magang ini?
        <div style="display:flex; align-items:center; gap:70px; margin-top:10px;">
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q2" style="width:18px;height:18px;"> Ya</label>
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q2" style="width:18px;height:18px;"> Tidak</label>
        </div>
      </div>

      <div style="margin-top:16px; font-size:15px;">
        Apakah Anda memiliki perangkat pribadi (laptop/PC) yang mendukung kebutuhan pekerjaan selama magang?
        <div style="display:flex; align-items:center; gap:70px; margin-top:10px;">
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q3" style="width:18px;height:18px;"> Ya</label>
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q3" style="width:18px;height:18px;"> Tidak</label>
        </div>
      </div>

      <div style="margin-top:16px; font-size:15px;">
        Apakah Anda bersedia menerima evaluasi dan feedback secara berkala selama program magang berlangsung?
        <div style="display:flex; align-items:center; gap:70px; margin-top:10px;">
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q4" style="width:18px;height:18px;"> Ya</label>
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q4" style="width:18px;height:18px;"> Tidak</label>
        </div>
      </div>

      <div style="margin-top:16px; font-size:15px;">
        Apakah Anda siap bekerja secara individu maupun dalam tim sesuai arahan pembimbing?
        <div style="display:flex; align-items:center; gap:70px; margin-top:10px;">
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q5" style="width:18px;height:18px;"> Ya</label>
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q5" style="width:18px;height:18px;"> Tidak</label>
        </div>
      </div>
    </div>

    {{-- BUTTON --}}
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
        Selesai
      
        <svg xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none">

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
<section class="bg-white">
  <div class="max-w-6xl mx-auto px-6 py-10">
    <div class="flex items-center gap-6 mb-10">
      <div class="flex items-center gap-3">
        <div class="w-14 h-14 bg-blue-300 rounded-xl flex items-center justify-center">
          <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4zm0 2c-4.42 0-8 2-8 4.5V21h16v-2.5C20 16 16.42 14 12 14z"/>
          </svg>
        </div>
        <span class="text-gray-400 font-medium text-lg">{{ __('Tahap 1') }}</span>
        <span class="text-4xl font-sm leading-none text-gray-400 -mt-1">›</span>
      </div>

      <div class="flex items-center gap-3">
        <div class="w-14 h-14 bg-blue-600 rounded-xl flex items-center justify-center">
          <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M10 2h4a2 2 0 0 1 2 2v2h4a2 2 0 0 1 2 2v3H2V8a2 2 0 0 1 2-2h4V4a2 2 0 0 1 2-2zm0 4h4V4h-4v2z"/>
            <path d="M2 13h20v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7z"/>
          </svg>
        </div>
        <span class="text-blue-600 font-semibold text-lg">{{ __('Tahap 2') }}</span>
        <span class="text-4xl font-sm leading-none text-blue-600 -mt-1">›</span>
      </div>

      <div class="flex items-center gap-3">
        <div class="w-14 h-14 bg-blue-300 rounded-xl flex items-center justify-center">
          <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M9 16.2l-3.5-3.5L4 14.2l5 5 11-11-1.5-1.5L9 16.2z"/>
          </svg>
        </div>
        <span class="text-gray-400 font-medium text-lg">{{ __('Selesai') }}</span>
      </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr]">
      <aside class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
        <h2 class="text-xl font-bold text-slate-950">{{ __('Ringkasan Tahap 1') }}</h2>
        <dl class="mt-4 space-y-3 text-sm text-slate-600">
          <div>
            <dt class="font-semibold text-slate-900">{{ __('Nama') }}</dt>
            <dd>{{ $stepOneData['nama'] }}</dd>
          </div>
          <div>
            <dt class="font-semibold text-slate-900">{{ __('NISN/NIM') }}</dt>
            <dd>{{ $stepOneData['nisn'] }}</dd>
          </div>
          <div>
            <dt class="font-semibold text-slate-900">{{ __('Sekolah/Universitas') }}</dt>
            <dd>{{ $stepOneData['sekolah'] }}</dd>
          </div>
          <div>
            <dt class="font-semibold text-slate-900">{{ __('Kelas') }}</dt>
            <dd>{{ $stepOneData['kelas'] }}</dd>
          </div>
          <div>
            <dt class="font-semibold text-slate-900">{{ __('No. Telp') }}</dt>
            <dd>{{ $stepOneData['telp'] }}</dd>
          </div>
        </dl>
      </aside>

      <div class="rounded-2xl border border-slate-200 shadow-[0_10px_30px_rgba(0,0,0,0.08)] p-8">
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

        <form action="{{ route('internships.steps.two.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
          @csrf

          <div>
            <label for="divisi_pilihan" class="block text-slate-900 font-medium mb-2">{{ __('Divisi Pilihan') }}</label>
            <select id="divisi_pilihan" name="divisi_pilihan" class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" required>
              <option value="">{{ __('Pilih divisi') }}</option>
              @foreach ($divisions as $division)
                <option value="{{ $division['title'] }}" @selected(old('divisi_pilihan') === $division['title'])>{{ __($division['title']) }}</option>
              @endforeach
            </select>
          </div>

          <div class="grid gap-6 md:grid-cols-2">
            <div>
              <label for="mulai_magang" class="block text-slate-900 font-medium mb-2">{{ __('Mulai Magang') }}</label>
              <input id="mulai_magang" type="date" name="mulai_magang" value="{{ old('mulai_magang') }}" class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" required />
            </div>
            <div>
              <label for="selesai_magang" class="block text-slate-900 font-medium mb-2">{{ __('Selesai Magang') }}</label>
              <input id="selesai_magang" type="date" name="selesai_magang" value="{{ old('selesai_magang') }}" class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" required />
            </div>
          </div>

          <div>
            <label for="motivasi" class="block text-slate-900 font-medium mb-2">{{ __('Motivasi Mengikuti Magang') }}</label>
            <textarea id="motivasi" name="motivasi" rows="5" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" required>{{ old('motivasi') }}</textarea>
          </div>

          <div>
            <label for="portofolio" class="block text-slate-900 font-medium mb-2">{{ __('Link Portofolio / GitHub') }}</label>
            <input id="portofolio" type="text" name="portofolio" value="{{ old('portofolio') }}" placeholder="https://github.com/username" class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" required />
          </div>

          <div>
            <label for="cv" class="block text-slate-900 font-medium mb-2">{{ __('Upload CV (PDF)') }}</label>
            <input id="cv" type="file" name="cv" accept=".pdf,application/pdf" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/40" required />
            <p class="mt-2 text-xs text-slate-500">{{ __('Format PDF, maksimum 2MB.') }}</p>
          </div>

          <label class="flex items-start gap-3 rounded-xl bg-slate-50 p-4 text-sm text-slate-600">
            <input type="checkbox" name="pernyataan" value="1" @checked(old('pernyataan')) class="mt-1 w-4 h-4 accent-blue-600" required />
            <span>{{ __('Saya menyatakan bahwa seluruh data yang diisi benar dan saya bersedia mengikuti proses seleksi magang yang berlaku.') }}</span>
          </label>

          <div class="flex flex-wrap gap-3 pt-2">
            <a href="{{ route('internships.steps.one') }}" class="inline-flex items-center gap-2 border border-blue-600 text-blue-600 px-6 py-3 rounded-xl font-medium hover:bg-blue-50 transition">
              {{ __('Kembali') }}
            </a>
            <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-medium shadow hover:bg-blue-700 transition">
              {{ __('Kirim Pendaftaran') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
>>>>>>> 07ac7de0454cf7b18502aca1ab1a400169064860
