@extends('layouts.app')

@section('title', 'Tentang Kami - Piramidasoft')

@section('content')
{{-- Hero Section --}}
<section class="relative w-full h-[420px] md:h-[560px] bg-gradient-to-r from-black/80 to-black/60 overflow-hidden">
    {{-- BG IMAGE --}}
    <img
      src="{{ asset('assets/images/tentang-kami.png') }}"
      alt="Hero Background"
      class="absolute inset-0 w-full h-full object-cover"
    />

    {{-- BLACK OVERLAY --}}
    <div class="absolute inset-0 bg-black/55"></div>

    {{-- FIX: kasih z-10 biar text pasti di atas overlay --}}
    <div class="relative z-10 max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
      <h1 class="font-extrabold leading-none drop-shadow text-[54px] md:text-[68px]">
        Tentang kami
      </h1>

      <p class="mt-3 text-[14px] md:text-[15px] font-semibold text-white/95">
        Home &nbsp;–&nbsp; Tentang kami
      </p>
    </div>
  </section>

{{-- CONTENT (dibuat mirip layout screenshot) --}}
<section class="bg-white">
  <div class="max-w-6xl mx-auto px-6 pt-10 pb-0">

    {{-- garis + subtitle --}}
    <div class="flex items-center gap-5 mb-7">
      <div class="w-[55px] h-[3px] bg-blue-500"></div>
      <p class="text-[20px] font-medium text-slate-300">
        Professional Solution for Your Business
      </p>
    </div>

    {{-- 2 kolom seperti screenshot --}}
    <div class="flex flex-col lg:flex-row gap-14 items-start">

      {{-- LEFT --}}
      <div class="w-full lg:flex-1">
        <h2 class="text-[28px] font-extrabold text-slate-950 mb-3">
          DESKRIPSI
        </h2>

        <div class="text-[13px] leading-[1.8] text-[#5e5b5b] space-y-3 w-full">
          <p>
            Piramidasoft adalah perusahaan teknologi informasi yang berfokus pada pengembangan
            solusi digital yang inovatif, efisien, dan sesuai kebutuhan bisnis modern. Kami membantu
            perusahaan dalam membangun sistem, mengembangkan aplikasi, serta mengoptimalkan proses
            bisnis melalui teknologi yang tepat guna. Dengan tim profesional yang berpengalaman,
            kami berkomitmen memberikan layanan terbaik untuk mendukung pertumbuhan dan transformasi
            digital klien.
          </p>

          <p>
            Kami memahami bahwa setiap bisnis memiliki kebutuhan dan tantangan yang berbeda dalam
            penerapan teknologi. Oleh karena itu, Piramidasoft berusaha menghadirkan solusi digital
            yang praktis, relevan, dan dapat digunakan secara efektif sesuai kebutuhan klien. Dengan
            pendekatan yang komunikatif dan berorientasi pada solusi, kami berkomitmen memberikan
            layanan yang membantu perusahaan beradaptasi dan berkembang di tengah perubahan teknologi
            yang terus berlangsung.
          </p>
        </div>

        <h2 class="text-[28px] font-extrabold text-slate-950 mt-8 mb-3">
          VISI KAMI
        </h2>

        <p class="text-[13px] leading-[1.8] text-[#5e5b5b] w-full">
          Menjadi perusahaan teknologi informasi terpercaya yang menghadirkan solusi digital inovatif,
          berkualitas tinggi, dan berkelanjutan untuk membantu bisnis berkembang serta beradaptasi di era
          transformasi digital.
        </p>
      </div>

    </div>
  </div>

  {{-- garis biru tebal atas footer --}}
  <div class="mt-10 h-[10px] bg-blue-500"></div>
</section>

@endsection