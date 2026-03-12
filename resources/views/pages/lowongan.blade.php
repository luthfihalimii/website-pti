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
        {{ __('Home') }} &nbsp;&ndash;&nbsp; {{ __('Lowongan pekerjaan') }}
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

    @if (count($vacancies) > 0)
      <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
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

              <a href="{{ route('careers.show', $vacancy['slug']) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-md font-medium text-[14px] transition-colors">
                {{ __('Detail pekerjaan') }} &rarr;
              </a>
            </div>
          </article>
        @endforeach
      </div>
    @else
      <div class="flex justify-center">
        <article class="w-full max-w-4xl rounded-2xl border border-blue-100 bg-blue-50/70 p-8 text-center">
          <div class="mx-auto mb-4 inline-flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 text-blue-600">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 9.75h4.5m-4.5 3h4.5M5.25 6.75A2.25 2.25 0 017.5 4.5h6.19a2.25 2.25 0 011.59.66l2.56 2.56a2.25 2.25 0 01.66 1.59v6.19a2.25 2.25 0 01-2.25 2.25H7.5a2.25 2.25 0 01-2.25-2.25V6.75z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold text-blue-700">{{ __('Belum ada lowongan tersedia') }}</h3>
          <p class="mx-auto mt-2 max-w-2xl text-sm text-slate-600">
            {{ __('Saat ini belum ada lowongan yang tersedia.') }}
            {{ __('Silakan cek kembali dalam waktu dekat atau hubungi kami untuk informasi rekrutmen terbaru.') }}
          </p>
          <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('internships.index') }}" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700">
              {{ __('Lihat Program Magang') }}
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-md border border-blue-200 bg-white px-5 py-2.5 text-sm font-medium text-blue-700 transition-colors hover:bg-blue-50">
              {{ __('Hubungi Kami') }}
            </a>
          </div>
        </article>
      </div>
    @endif
  </div>
</section>
@endsection
