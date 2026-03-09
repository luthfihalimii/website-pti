@extends('layouts.app')

@section('title', __('Detail Lowongan') . ' - ' . $vacancy['title'] . ' - Piramidasoft')
@section('meta_description', __('Detail lowongan :title di Piramidasoft, lengkap dengan kualifikasi, skill, benefit, dan cara melamar.', ['title' => $vacancy['title']]))

@section('content')
<section class="relative w-full h-[253px] bg-gradient-to-r from-blue-700/95 via-blue-600/80 to-blue-500/70 overflow-hidden">
    <img
      src="{{ asset('assets/images/hero-pages.png') }}"
      alt="{{ __('Hero Background') }}"
      class="absolute inset-0 w-full h-full object-cover"
    />

    <div class="absolute inset-0 bg-gradient-to-r from-blue-700/95 via-blue-600/80 to-blue-500/70"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
      <h1 class="font-extrabold leading-none drop-shadow text-4xl sm:text-5xl lg:text-[68px]">
        {{ __('Detail Kerja') }}
      </h1>

      <p class="mt-3 text-[14px] md:text-[15px] font-semibold text-white/95">
        {{ __('Home') }} &nbsp;–&nbsp; {{ __('Lowongan pekerjaan') }}
      </p>
    </div>
</section>

<section class="bg-white py-12">
  <div class="max-w-6xl mx-auto px-6">
    <div class="mb-6">
      <a href="{{ route('careers.index') }}" class="text-blue-600 hover:text-blue-700 text-[14px] font-medium">
        ← {{ __('Lowongan pekerjaan') }}
      </a>
    </div>

    <h2 class="text-[28px] md:text-[32px] font-bold text-slate-950 mb-4">
      {{ $vacancy['headline'] }}
    </h2>

    <p class="text-[14px] text-slate-600 leading-relaxed mb-8">
      {{ __($vacancy['description']) }}
    </p>

    <div class="mb-8">
      <h3 class="text-[20px] font-bold text-slate-950 mb-4">{{ __('Kualifikasi Utama') }}</h3>
      <ul class="space-y-2 text-[14px] text-slate-600">
        @foreach ($vacancy['qualifications'] as $qualification)
          <li class="flex items-start gap-2">
            <span class="text-blue-600 mt-1">•</span>
            <span>{{ __($qualification) }}</span>
          </li>
        @endforeach
      </ul>
    </div>

    <div class="mb-8">
      <h3 class="text-[20px] font-bold text-slate-950 mb-4">{{ __('Skill yang Dibutuhkan') }}</h3>
      <ul class="space-y-2 text-[14px] text-slate-600">
        @foreach ($vacancy['skills'] as $skill)
          <li class="flex items-start gap-2">
            <span class="text-blue-600 mt-1">•</span>
            <span>{{ __($skill) }}</span>
          </li>
        @endforeach
      </ul>
    </div>

    <div class="mb-8">
      <h3 class="text-[20px] font-bold text-slate-950 mb-4">{{ __('Range Gaji') }}</h3>
      <p class="text-[14px] text-slate-600 mb-1">
        <span class="font-semibold">{{ $vacancy['salary_range'] }}</span>
      </p>
      <p class="text-[13px] text-slate-500 italic">
        {{ __($vacancy['salary_note']) }}
      </p>
      <p class="text-[13px] text-slate-500 mt-2">
        {{ __($vacancy['salary_context']) }}
      </p>
    </div>

    <div class="mb-10">
      <h3 class="text-[20px] font-bold text-slate-950 mb-4">{{ __('Benefit yang didapatkan') }}</h3>
      <ul class="space-y-2 text-[14px] text-slate-600">
        @foreach ($vacancy['benefits'] as $benefit)
          <li class="flex items-start gap-2">
            <span class="text-blue-600 mt-1">•</span>
            <span>{{ __($benefit) }}</span>
          </li>
        @endforeach
      </ul>
    </div>

    <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded-r-lg mb-8">
      <h3 class="text-[18px] font-bold text-blue-600 mb-2">
        {{ __('Segera daftarkan diri Anda dan bergabunglah bersama kami untuk meraih karier impian.') }}
      </h3>
      <p class="text-[14px] text-slate-600">
        {{ __('Kirimkan CV terlengkap bersama portofolio dan cover letter singkat yang menjelaskan mengapa Anda cocok untuk posisi ini.') }}
      </p>
    </div>

    <div class="flex flex-wrap gap-4">
      <a href="{{ route('careers.applications.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-medium text-[14px] transition-colors inline-flex items-center gap-2">
        {{ __('Lamar') }} →
      </a>
      <a href="{{ $vacancy['poster_url'] }}"
        target="_blank"
        rel="noopener"
        class="bg-white hover:bg-slate-50 text-blue-600 border-2 border-blue-600 px-8 py-3 rounded-md font-medium text-[14px] transition-colors">
        {{ __('Lihat Poster') }}
      </a>
    </div>
  </div>
</section>
@endsection
