@extends('layouts.app')

@section('title', __('Magang'))
@section('meta_description', __('Program magang Piramidasoft untuk peserta yang ingin belajar langsung lewat project nyata, mentoring, dan lingkungan kerja profesional.'))

@section('content')
{{-- ================= HERO ================= --}}
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
    
<<div class="flex items-center gap-2 text-base sm:text-lg lg:text-[21px] font-semibold">
  <a href="/" class="hover:underline">{{ __('Home') }}</a>
  <div class="w-3 h-[3px] bg-white"></div>
  <span>{{ __('Magang') }}</span>
</div>
  </div>
</section>


{{-- ================= INTRO ================= --}}
<section class="max-w-6xl mx-auto px-4 py-16 text-center">
    <div class="flex items-center justify-center gap-6">
        <div class="w-14 h-[2px] bg-gray-400"></div>
        <span class="text-blue-600 text-lg md:text-xl font-semibold tracking-[3px]">
            {{ __('MAGANG') }}
        </span>
        <div class="w-14 h-[2px] bg-gray-400"></div>
    </div>
    <h2 class="text-4xl font-extrabold mt-3">
      {{ __('#DariMagangJadiJago') }}
    </h2>
    <p class="mt-6 text-slate-700 text-lg leading-relaxed max-w-3xl mx-auto">
        {{ __('Di PT. Piramida Teknologi Informasi, kalian nggak cuma magang — kalian bertumbuh. Terlibat di project nyata, dibimbing mentor berpengalaman, dan diasah jadi lebih siap masuk dunia profesional. Datang belajar, pulang jadi lebih jago.') }}
    </p>
</section>

{{-- ================= DIVISI ================= --}}
<section class="relative overflow-hidden">

  {{-- Background image --}}
  <img
    src="{{ asset('assets/images/Latar Belakang Divisi.png') }}"
    alt="{{ __('Latar belakang divisi') }}"
    class="absolute inset-0 w-full h-full object-cover"
  >

  {{-- Overlay --}}
  <div class="absolute inset-0 bg-sky-500/20 backdrop-blur-[1px]"></div>

  <div class="relative max-w-6xl mx-auto px-6 py-16">

    <h3 class="text-center text-white text-3xl md:text-4xl leading-tight">
      {{ __('Kami mempunyai berbagai divisi') }}<br>
      <span class="font-bold">{{ __('untuk mengasah skill Anda') }}</span>
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-12">
      @foreach($divisions as $division)
        <div class="bg-white rounded-2xl shadow-lg
                    w-full max-w-[260px] h-[260px]
                    mx-auto px-6 py-7
                    text-center flex flex-col items-center">

          {{-- icon --}}
          <img
            src="{{ asset('assets/images/' . rawurlencode($division['img'])) }}"
            alt="{{ __($division['title']) }}"
            class="w-20 h-20 object-contain mt-1"
          >

          <h4 class="font-bold text-base mt-5">
            {{ __($division['title']) }}
          </h4>

          <p class="text-slate-600 text-xs mt-3 leading-relaxed">
            {{ __($division['desc']) }}
          </p>

        </div>
      @endforeach
    </div>

  </div>
</section>

{{-- ================= BENEFIT ================= --}}
<section class="bg-white py-20">
  <div class="max-w-6xl mx-auto px-6">

    {{-- Title --}}
    <h2 class="text-center text-4xl font-bold text-black">
      {{ __('Benefit Program Magang') }}
    </h2>

    <p class="text-center text-black mt-4 max-w-3xl mx-auto">
      {{ __('Bersama kami, bangun fondasi karier yang kuat dan ciptakan perjalanan profesional yang penuh tantangan, pembelajaran, serta peluang berkembang.') }}
    </p>

    {{-- Grid --}}
    <div class="grid md:grid-cols-2 gap-10 mt-16">
      @foreach($benefits as $title => $description)
        <div class="bg-white rounded-2xl p-10 shadow-2xl border border-gray-300 min-h-[190px]">
          <div class="flex items-start gap-6">
            <div class="w-12 h-12 rounded-full bg-blue-500 text-white flex items-center justify-center font-semibold text-lg flex-shrink-0">
              {{ $loop->iteration }}
            </div>

            <div>
              <h4 class="font-semibold text-xl text-black">
                {{ __($title) }}
              </h4>
              <p class="text-black mt-3">
                {{ __($description) }}
              </p>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>
</section>


{{-- ================= CTA ================= --}}
<section class="max-w-6xl mx-auto px-4 pb-20">
    <div class="grid md:grid-cols-2 gap-10 items-center">
        <div>
            <p class="text-blue-600 text-2xl md:text-3xl font-semibold tracking-widest">
              {{ __('SUDAH SIAP MAGANG DI PTI?') }}
            </p>
            <h3 class="text-4xl font-extrabold mt-4">
                {{ __('MEMBENTUK MASA DEPAN') }} <span class="text-blue-600">{{ __('MAGANG DI PTI') }}</span>
            </h3>
            <p class="text-gray-600 mt-4">
                {{ __('Dengan fokus pada peningkatan kualitas, pengembangan keterampilan, dan pemberdayaan. PTI berupaya menciptakan lingkungan yang kondusif bagi peserta magang untuk tumbuh dan berkembang.') }}
            </p>

            {{-- Tombol ke Tahap 1 --}}
            <a href="{{ route('internships.steps.one') }}"
               class="inline-block mt-6 bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700">
                {{ __('Daftar') }} →
            </a>
        </div>

         {{-- RIGHT IMAGE --}}
        <div class="flex justify-center">
            <img src="{{ asset('assets/images/Magang.png') }}"
                 alt="{{ __('Magang') }}"
                 class="max-w-md w-full">
        </div>
    </div>
</section>

@endsection
