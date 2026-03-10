@extends('layouts.app')

@section('title', 'Publikasi - Piramidasoft')

@section('content')
  {{-- HERO --}}
  <section class="relative w-full h-[260px] bg-blue-600/55">
    <img
      src="{{ asset('assets/images/hero-pages.png') }}"
      alt="Hero"
      class="absolute inset-0 w-full h-full object-cover -z-10"
    >

    <div class="max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white text-center">
      <h1 class="text-5xl md:text-[64px] font-extrabold drop-shadow-lg leading-none">
        Publikasi
      </h1>
      <div class="mt-3 flex items-center gap-2 text-base md:text-[18px] font-semibold text-white/95">
      <a href="/" class="hover:underline">Home</a>
      <span class="opacity-70">–</span>
      <span class="opacity-90">Publikasi</span>
    </div>
    </div>
  </section>

  @php
    $items = [
      [
        'img' => 'assets/images/pub-egov.png',
        'title' => 'Product Profile',
        'subtitle' => 'E-Government Service Software',
        'desc' => 'Berikut adalah Product Profile (E-Government service software) PT Piramida Teknologi Informasi',
        'pdf' => 'assets/pdf/e-government-service-software.pdf',
        'type' => 'product', // Dokumen + Flipbook
      ],
      [
        'img' => 'assets/images/pub-soft.png',
        'title' => 'Product Profile',
        'subtitle' => 'Software Solution',
        'desc' => 'Berikut adalah Product Profile (Software solution) PT Piramida Teknologi Informasi',
        'pdf' => 'assets/pdf/software-solution.pdf',
        'type' => 'product',
      ],
      [
        'img' => 'assets/images/pub-company.png',
        'title' => 'Company Profile',
        'subtitle' => 'Booklet Piramida Teknologi Indonesia',
        'desc' => 'Berikut adalah dokumen company profile PT Piramida Teknologi Informasi.',
        'pdf' => 'assets/pdf/company-profile.pdf',
        'type' => 'download', // Unduh + Lihat
      ],
      [
        'img' => 'assets/images/pub-brosur.png',
        'title' => 'Brosur Insight GOV',
        'subtitle' => null,
        'desc' => 'Silahkan unduh brosur berikut untuk mengetahui informasi mengenai insight GOV lebih detail.',
        'pdf' => 'assets/pdf/brosur.pdf',
        'type' => 'download',
      ],
    ];
  @endphp

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
                src="{{ asset($item['img']) }}"
                alt="{{ $item['title'] }}"
                class="w-[92px] h-[122px] object-cover rounded-xl border border-[#EFEFEF] shrink-0"
              >

              <div class="flex-1">
                <h3 class="text-[22px] font-extrabold text-slate-950 leading-tight">
                  {{ $item['title'] }}
                </h3>

                @if (!empty($item['subtitle']))
                  <p class="text-[13px] font-semibold text-slate-700 mt-1">
                    {{ $item['subtitle'] }}
                  </p>
                @endif

                <p class="text-[13px] text-[#6b6b6b] leading-relaxed mt-3">
                  {{ $item['desc'] }}
                </p>

                {{-- Buttons (pill, sama semua) --}}
                <div class="mt-4 flex gap-3 flex-wrap">
                  @if ($item['type'] === 'product')
                    <a
                      href="{{ asset($item['pdf']) }}"
                      target="_blank"
                      rel="noopener"
                      class="btn-pill btn-primary"
                    >Dokumen</a>

                    <a
                      href="{{ route('publikasi.flipbook', ['file' => $item['pdf'], 'title' => $item['subtitle'] ?? $item['title']]) }}"
                      class="btn-pill btn-secondary"
                    >Flipbook</a>
                  @else
                    <a
                      href="{{ asset($item['pdf']) }}"
                      download
                      class="btn-pill btn-primary"
                    >Unduh</a>

                    <a
                      href="{{ asset($item['pdf']) }}"
                      target="_blank"
                      rel="noopener"
                      class="btn-pill btn-secondary"
                    >Lihat</a>
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
  <style>
    .btn-pill{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      padding: 7px 18px;
      border-radius: 9999px;
      font-size: 13px;
      font-weight: 700;
      line-height: 1;
      transition: .2s ease;
      color: #fff;
    }
    .btn-primary{ background:#2563eb; }
    .btn-primary:hover{ background:#1d4ed8; }

    .btn-secondary{ background:#3b82f6; }
    .btn-secondary:hover{ background:#2563eb; }
  </style>
@endsection