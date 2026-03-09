@extends('layouts.app')

@section('title', __('Magang Tahap 1') . ' - Piramidasoft')
@section('meta_description', __('Tahap 1 pendaftaran magang Piramidasoft. Lengkapi data pribadi dan data sekolah atau universitas untuk melanjutkan proses pendaftaran.'))

@section('content')
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
                
                <span class="text-blue-600 font-semibold text-lg">{{ __('Tahap 1') }}</span>
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
        </div>
    </div>

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

      {{-- GRID 2 KOLOM --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

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
