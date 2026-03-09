@extends('layouts.app')

@section('title', __('Formulir Lamaran Kerja') . ' - Piramidasoft')
@section('meta_description', __('Formulir lamaran kerja Piramidasoft untuk posisi :title. Lengkapi data, unggah CV PDF, dan kirimkan lamaran Anda.', ['title' => $vacancy['title']]))

@section('content')
@php
  $selectOptions = [
      'jenis_kelamin' => ['Laki-laki', 'Perempuan'],
      'agama' => ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'],
      'status_pernikahan' => ['Belum Menikah', 'Menikah', 'Cerai'],
      'golongan_darah' => ['A', 'B', 'AB', 'O'],
      'pendidikan_terakhir' => ['SMA/SMK', 'D3', 'S1', 'S2', 'S3'],
      'sumber_informasi' => ['Website Perusahaan', 'Media Sosial', 'Teman/Keluarga', 'Job Portal', 'Lainnya'],
  ];
@endphp

<section class="relative w-full h-[253px] bg-gradient-to-r from-blue-700/95 via-blue-600/80 to-blue-500/70 overflow-hidden">
    <img
      src="{{ asset('assets/images/hero-pages.png') }}"
      alt="{{ __('Hero Background') }}"
      class="absolute inset-0 w-full h-full object-cover"
    />

    <div class="absolute inset-0 bg-gradient-to-r from-blue-700/95 via-blue-600/80 to-blue-500/70"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
      <h1 class="font-extrabold leading-none drop-shadow text-4xl sm:text-5xl lg:text-[68px]">
        {{ __('Karir') }}
      </h1>

      <p class="mt-3 text-[14px] md:text-[15px] font-semibold text-white/95">
        {{ __('Home') }} &nbsp;–&nbsp; {{ __('Lowongan pekerjaan') }} &nbsp;–&nbsp; {{ __('Form') }}
      </p>
    </div>
</section>

<section class="bg-white py-12">
  <div class="max-w-4xl mx-auto px-6">
    <div class="flex flex-col md:flex-row items-center justify-between mb-10 gap-6">
      <div class="flex-1">
        <h2 class="text-[28px] md:text-[32px] font-bold text-blue-600 mb-2">
          {{ __('Formulir Lamaran Kerja') }}
        </h2>
        <p class="text-slate-600 text-sm leading-relaxed">
          {{ __('Posisi yang dibuka saat ini:') }} <span class="font-semibold text-slate-950">{{ $vacancy['title'] }}</span>
        </p>
      </div>
      <div class="w-48 h-48">
        <img
          src="{{ asset('assets/images/Magang.png') }}"
          alt="{{ __('Form Illustration') }}"
          class="w-full h-full object-contain"
        />
      </div>
    </div>

    @if (session('status'))
      <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('status') }}
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

    <form action="{{ route('careers.applications.store', $vacancy['slug']) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="nama_lengkap" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Nama Lengkap (Sesuai KTP)') }} <span class="text-red-500">*</span></label>
          <input id="nama_lengkap" type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="{{ __('Ex: Aletha Leatomu') }}" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
        </div>
        <div>
          <label for="panggilan" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Panggilan') }} <span class="text-red-500">*</span></label>
          <input id="panggilan" type="text" name="panggilan" value="{{ old('panggilan') }}" placeholder="{{ __('Nama Panggilan') }}" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="email" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Email') }} <span class="text-red-500">*</span></label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="e.g., user@mail.com" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
        </div>
        <div>
          <label for="nomor_telepon" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Nomor Telepon') }} <span class="text-red-500">*</span></label>
          <input id="nomor_telepon" type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="e.g., 08123456789" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
        </div>
      </div>

      <div>
        <label for="alamat" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Alamat Sekarang (Sesuai KTP)') }} <span class="text-red-500">*</span></label>
        <input id="alamat" type="text" name="alamat" value="{{ old('alamat') }}" placeholder="e.g., Jl. Kebon Jeruk No. 5 Kota Semarang" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="tempat_lahir" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Tempat Lahir') }} <span class="text-red-500">*</span></label>
          <input id="tempat_lahir" type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="{{ __('Tempat Lahir') }}" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
        </div>
        <div>
          <label for="tanggal_lahir" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Tanggal Lahir') }} <span class="text-red-500">*</span></label>
          <input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach (['jenis_kelamin', 'agama'] as $field)
          <div>
            <label for="{{ $field }}" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __(ucwords(str_replace('_', ' ', $field))) }} <span class="text-red-500">*</span></label>
            <select id="{{ $field }}" name="{{ $field }}" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]">
              <option value="">{{ __('Pilih') }}</option>
              @foreach ($selectOptions[$field] as $option)
                <option value="{{ $option }}" @selected(old($field) === $option)>{{ __($option) }}</option>
              @endforeach
            </select>
          </div>
        @endforeach
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach (['status_pernikahan', 'golongan_darah'] as $field)
          <div>
            <label for="{{ $field }}" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __(ucwords(str_replace('_', ' ', $field))) }} <span class="text-red-500">*</span></label>
            <select id="{{ $field }}" name="{{ $field }}" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]">
              <option value="">{{ __('Pilih') }}</option>
              @foreach ($selectOptions[$field] as $option)
                <option value="{{ $option }}" @selected(old($field) === $option)>{{ __($option) }}</option>
              @endforeach
            </select>
          </div>
        @endforeach
      </div>

      <div>
        <label for="pendidikan_terakhir" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Pendidikan Terakhir') }} <span class="text-red-500">*</span></label>
        <select id="pendidikan_terakhir" name="pendidikan_terakhir" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]">
          <option value="">{{ __('Pilih') }}</option>
          @foreach ($selectOptions['pendidikan_terakhir'] as $option)
            <option value="{{ $option }}" @selected(old('pendidikan_terakhir') === $option)>{{ __($option) }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="jurusan" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Jurusan') }} <span class="text-red-500">*</span></label>
        <input id="jurusan" type="text" name="jurusan" value="{{ old('jurusan') }}" placeholder="{{ __('Jurusan') }}" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
      </div>

      <div>
        <label for="ipk" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('IPK / Rata-rata') }} <span class="text-red-500">*</span></label>
        <input id="ipk" type="text" name="ipk" value="{{ old('ipk') }}" placeholder="e.g., 3.50" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
      </div>

      <div>
        <label for="posisi" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Posisi yang Dilamar') }} <span class="text-red-500">*</span></label>
        <input id="posisi" type="text" name="posisi" value="{{ old('posisi', $vacancy['title']) }}" readonly required class="w-full px-4 py-3 border border-slate-300 rounded-md bg-slate-50 text-[14px] text-slate-700 focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
      </div>

      <div>
        <label for="pengalaman_kerja" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Pengalaman Kerja') }} <span class="text-red-500">*</span></label>
        <textarea id="pengalaman_kerja" name="pengalaman_kerja" rows="4" placeholder="{{ __('Tuliskan pengalaman kerja Anda (jika ada)') }}" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]">{{ old('pengalaman_kerja') }}</textarea>
      </div>

      <div>
        <label for="keahlian_khusus" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Keahlian Khusus') }} <span class="text-red-500">*</span></label>
        <textarea id="keahlian_khusus" name="keahlian_khusus" rows="3" placeholder="{{ __('Tuliskan keahlian khusus yang Anda miliki') }}" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]">{{ old('keahlian_khusus') }}</textarea>
      </div>

      <div>
        <label for="cv" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Upload CV (PDF)') }} <span class="text-red-500">*</span></label>
        <input id="cv" type="file" name="cv" accept=".pdf,application/pdf" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
        <p class="text-[12px] text-slate-500 mt-1">{{ __('Format: PDF, Max: 2MB') }}</p>
      </div>

      <div>
        <label for="portofolio" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Upload Portofolio atau Link Portofolio') }} <span class="text-red-500">*</span></label>
        <input id="portofolio" type="text" name="portofolio" value="{{ old('portofolio') }}" placeholder="e.g., https://github.com/username" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
      </div>

      <div>
        <label for="sumber_informasi" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Dari mana Anda mengetahui lowongan ini?') }} <span class="text-red-500">*</span></label>
        <select id="sumber_informasi" name="sumber_informasi" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]">
          <option value="">{{ __('Pilih') }}</option>
          @foreach ($selectOptions['sumber_informasi'] as $option)
            <option value="{{ $option }}" @selected(old('sumber_informasi') === $option)>{{ __($option) }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="gaji_diharapkan" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Gaji yang Diharapkan') }} <span class="text-red-500">*</span></label>
        <input id="gaji_diharapkan" type="text" name="gaji_diharapkan" value="{{ old('gaji_diharapkan') }}" placeholder="e.g., Rp 5.000.000" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
      </div>

      <div>
        <label for="mulai_bekerja" class="block text-[14px] font-medium text-slate-700 mb-2">{{ __('Kapan Anda bisa mulai bekerja?') }} <span class="text-red-500">*</span></label>
        <input id="mulai_bekerja" type="date" name="mulai_bekerja" value="{{ old('mulai_bekerja') }}" required class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]" />
      </div>

      <div class="bg-slate-50 p-6 rounded-lg space-y-4">
        @foreach ([1, 2, 3] as $index)
          <div class="flex items-start gap-3">
            <input
              type="checkbox"
              name="pernyataan_{{ $index }}"
              id="pernyataan_{{ $index }}"
              value="1"
              @checked(old('pernyataan_' . $index))
              required
              class="mt-1 w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-600"
            />
            <label for="pernyataan_{{ $index }}" class="text-[13px] text-slate-700">
              @if ($index === 1)
                {{ __('Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan.') }}
              @elseif ($index === 2)
                {{ __('Saya bersedia mengikuti seluruh tahapan seleksi yang ditetapkan oleh perusahaan.') }}
              @else
                {{ __('Apabila di kemudian hari terbukti bahwa data yang saya berikan tidak benar, saya bersedia menerima sanksi sesuai ketentuan yang berlaku.') }}
              @endif
              <span class="text-red-500">*</span>
            </label>
          </div>
        @endforeach
      </div>

      <div class="pt-4">
        <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-md font-medium text-[14px] transition-colors inline-flex items-center gap-2"
        >
          {{ __('Kirim') }} →
        </button>
      </div>
    </form>
  </div>
</section>
@endsection
