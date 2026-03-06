@extends('layouts.app')

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
    <h1 class="text-5xl md:text-[68px] font-bold text-shadow-lg mb-4">
      {{ __('Karir') }}
    </h1>

    <div class="flex items-center gap-2 text-lg md:text-[21px] font-semibold">
      <span>{{ __('Home') }}</span>
      <div class="w-3 h-[3px] bg-white"></div>
      <span>{{ __('Magang') }}</span>
    </div>
  </div>
</section>

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
