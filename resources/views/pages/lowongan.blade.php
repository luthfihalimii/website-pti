@extends('layouts.app')

@section('title', __('Karir') . ' - Piramidasoft')
@section('meta_description', __('Lowongan kerja terbaru di Piramidasoft untuk kandidat yang ingin membangun solusi digital berdampak bersama tim kami.'))

@section('content')
<section class="relative w-full h-[253px] bg-blue-600/55 overflow-hidden">
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
        {{ __('Home') }} &nbsp;–&nbsp; {{ __('Lowongan pekerjaan') }}
      </p>
    </div>
</section>

<section class="bg-white py-16">
  <div class="max-w-6xl mx-auto px-6">
    <div class="text-center mb-12">
      <div class="flex items-center justify-center gap-3 mb-4">
        <div class="w-12 h-[2px] bg-blue-600"></div>
        <h2 class="text-[24px] md:text-[28px] font-bold text-blue-600">
          {{ __('LOWONGAN PEKERJAAN') }}
        </h2>
        <div class="w-12 h-[2px] bg-blue-600"></div>
      </div>

      <p class="text-[14px] md:text-[15px] text-slate-600 max-w-3xl mx-auto leading-relaxed">
        {{ __('Bergabunglah bersama kami dan raih karier impian Anda. Bersama kami, setiap langkah adalah peluang untuk tumbuh dan menciptakan dampak nyata.') }}
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($vacancies as $vacancy)
        <article class="bg-white rounded-lg shadow-md overflow-hidden border border-slate-200 hover:shadow-xl transition-shadow">
          <div class="h-[200px] overflow-hidden">
            <img
              src="{{ $vacancy['poster_url'] }}"
              alt="{{ $vacancy['title'] }}"
              class="w-full h-full object-cover"
            />
          </div>

          <div class="p-6">
            <div class="mb-4">
              <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h4 class="font-bold text-blue-600 text-[16px]">{{ __('KUALIFIKASI') }}</h4>
              </div>
            </div>

            <h5 class="font-semibold text-slate-950 mb-2 text-[14px]">{{ $vacancy['title'] }}</h5>
            <p class="text-[13px] text-slate-600 mb-6 leading-relaxed">
              {{ __($vacancy['summary']) }}
            </p>

            <a href="{{ route('careers.show') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-md font-medium text-[14px] transition-colors">
              {{ __('Detail pekerjaan') }} →
            </a>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endsection
