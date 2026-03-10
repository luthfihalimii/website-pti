@extends('layouts.app')

@section('title', 'Karir - Piramidasoft')

@section('content')
{{-- Hero Section --}}
<section class="relative w-full h-[253px] absolute inset-0 bg-blue-600/55">
    {{-- BG IMAGE --}}
    <img
      src="{{ asset('assets/images/hero-pages.png') }}"
      alt="Hero Background"
      class="absolute inset-0 w-full h-full object-cover"
    />

    {{-- BLUE OVERLAY --}}
    <div class="absolute inset-0 bg-gradient-to-r from-blue-700/95 via-blue-600/80 to-blue-500/70"></div>

    {{-- CONTENT --}}
    <div class="relative z-10 max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
      <h1 class="font-extrabold leading-none drop-shadow text-[54px] md:text-[68px]">
        Karir
      </h1>

      <p class="mt-3 text-[14px] md:text-[15px] font-semibold text-white/95">
      <a href="/" class="hover:underline">Home</a>
      &nbsp;–&nbsp;
      Lowongan pekerjaan
    </p>
    </div>
</section>

{{-- LOWONGAN PEKERJAAN SECTION --}}
<section class="bg-white py-16">
  <div class="max-w-6xl mx-auto px-6">
    
    {{-- Header --}}
    <div class="text-center mb-12">
      <div class="flex items-center justify-center gap-3 mb-4">
        <div class="w-12 h-[2px] bg-blue-600"></div>
        <h2 class="text-[24px] md:text-[28px] font-bold text-blue-600">
          LOWONGAN PEKERJAAN
        </h2>
        <div class="w-12 h-[2px] bg-blue-600"></div>
      </div>
      
      <p class="text-[14px] md:text-[15px] text-slate-600 max-w-3xl mx-auto leading-relaxed">
        Bergabunglah bersama kami dan raih karier impian Anda. Bersama kami,<br>
        setiap langkah adalah peluang untuk tumbuh dan mencipatakan dampak nyata.
      </p>
    </div>

    {{-- Job Cards Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

      {{-- Job Card 1 --}}
      <div class="bg-white rounded-lg shadow-md overflow-hidden border border-slate-200 hover:shadow-xl transition-shadow">
        {{-- Card Image --}}
        <div class="h-[200px] overflow-hidden">
          <img 
            src="{{ asset('assets/images/poster lowongan.png') }}" 
            alt="UI/UX Designer" 
            class="w-full h-full object-cover"
          />
        </div>
        
        {{-- Card Body --}}
        <div class="p-6">
          <div class="mb-4">
            <div class="flex items-center gap-2 mb-2">
              <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <h4 class="font-bold text-blue-600 text-[16px]">KUALIFIKASI</h4>
            </div>
          </div>
          
          <h5 class="font-semibold text-slate-950 mb-2 text-[14px]">Fullstack Developer</h5>
          <p class="text-[13px] text-slate-600 mb-6 leading-relaxed">
            Dibutuhkan Fullstack Developer untuk bergabung dengan tim kami.
          </p>
          
          <a href="/lowongan/detail" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-md font-medium text-[14px] transition-colors">
            Detail pekerjaan →
          </a>
        </div>
      </div>

      
    </div>
  </div>
</section>

@endsection
