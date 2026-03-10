@extends('layouts.app')

@section('title', __('Publikasi') . ' - Piramidasoft')
@section('meta_description', __('Publikasi resmi Piramidasoft berupa product profile, company profile, dan materi pendukung lain yang dapat dilihat maupun diunduh.'))

@section('content')
  {{-- HERO --}}
  <section class="relative w-full h-[260px] bg-blue-600/55">
    <img
      src="{{ asset('assets/images/hero-pages.png') }}"
      alt="{{ __('Hero') }}"
      class="absolute inset-0 w-full h-full object-cover -z-10"
    >

    <div class="max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white text-center">
      <h1 class="text-4xl sm:text-5xl lg:text-[64px] font-extrabold drop-shadow-lg leading-none">
        {{ __('Publikasi') }}
      </h1>
<div class="mt-3 flex items-center gap-2 text-base md:text-[18px] font-semibold text-white/95">
  <a href="/" class="hover:underline">{{ __('Home') }}</a>
  <span class="opacity-70">–</span>
  <span class="opacity-90">{{ __('Publikasi') }}</span>
</div>
  </section>

  {{-- CARD AREA --}}
  <section class="bg-[#F6F8FB]">
    <div class="max-w-6xl mx-auto px-6 py-12">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach ($items as $item)
          <div
            class="bg-white rounded-2xl border border-[#EDEDED] shadow-[0_10px_28px_rgba(15,23,42,0.08)]
                   hover:shadow-[0_14px_38px_rgba(15,23,42,0.12)] transition duration-300"
          >
            <div class="p-6 flex gap-5">
              <img
                src="{{ $item['img_url'] }}"
                alt="{{ $item['title'] }}"
                class="w-[92px] h-[122px] object-cover rounded-xl border border-[#EFEFEF] shrink-0"
              >

              <div class="flex-1">
                <h3 class="text-[22px] font-extrabold text-slate-950 leading-tight">
                  {{ __($item['title']) }}
                </h3>

                @if (!empty($item['subtitle']))
                  <p class="text-[13px] font-semibold text-slate-700 mt-1">
                    {{ __($item['subtitle']) }}
                  </p>
                @endif

                <p class="text-[13px] text-[#6b6b6b] leading-relaxed mt-3">
                  {{ __($item['desc']) }}
                </p>

                {{-- Buttons (pill, sama semua) --}}
                <div class="mt-4 flex gap-3 flex-wrap">
                  @if ($item['type'] === 'product')
                    <a
                      href="{{ $item['pdf_url'] }}"
                      target="_blank"
                      rel="noopener"
                      class="btn-pill btn-primary"
                    >{{ __('Dokumen') }}</a>

                    <a
                      href="{{ route('publications.flipbook', ['file' => $item['pdf'], 'title' => $item['subtitle'] ?? $item['title']]) }}"
                      class="btn-pill btn-secondary"
                    >{{ __('Flipbook') }}</a>
                  @else
                    <a
                      href="{{ $item['pdf_url'] }}"
                      download
                      class="btn-pill btn-primary"
                    >{{ __('Unduh') }}</a>

                    <a
                      href="{{ $item['pdf_url'] }}"
                      target="_blank"
                      rel="noopener"
                      class="btn-pill btn-secondary"
                    >{{ __('Lihat') }}</a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- Small helper class biar tombol konsisten --}}
@endsection
