@extends('layouts.app')

@section('title', 'Magang')

@section('content')

@php
    $img = fn ($file) => asset('assets/images/' . rawurlencode($file));

    $divisi = [
        [
            'title' => 'Web Development',
            'desc'  => 'Siswa magang belajar membangun dan mengelola website secara langsung sesuai standar industri.',
            'img'   => 'Web Development.png',
        ],
        [
            'title' => 'Mobile Development',
            'desc'  => 'Siswa magang belajar mengembangkan aplikasi mobile yang fungsional dan siap digunakan.',
            'img'   => 'Mobile Development.png',
        ],
        [
            'title' => 'UI/UX Designer',
            'desc'  => 'Siswa magang belajar merancang tampilan dan pengalaman pengguna yang intuitif serta menarik.',
            'img'   => 'UI_UX Designer.png',
        ],
        [
            'title' => 'IT Support',
            'desc'  => 'Siswa magang belajar menangani instalasi, troubleshooting, dan pemeliharaan sistem IT.',
            'img'   => 'IT Support.png',
        ],
    ];
@endphp


{{-- ================= HERO ================= --}}
<section class="relative w-full h-[253px] bg-gradient-to-r from-blue-600/80 to-blue-400/80 overflow-hidden">
  <img 
    src="{{ asset('assets/images/hero-pages.png') }}" 
    alt="Hero Background" 
    class="absolute inset-0 w-full h-full object-cover -z-10"
  >
  
  <div class="relative max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
    <h1 class="text-5xl md:text-[68px] font-bold text-shadow-lg mb-4">
      Karir
    </h1>
    
    <div class="flex items-center gap-2 text-lg md:text-[21px] font-semibold">
      <span>Home</span>
      <div class="w-3 h-[3px] bg-white"></div>
      <span>Magang</span>
    </div>
  </div>
</section>


{{-- ================= INTRO ================= --}}
<section class="max-w-6xl mx-auto px-4 py-16 text-center">
    <div class="flex items-center justify-center gap-6">
        <div class="w-14 h-[2px] bg-gray-400"></div>
        <span class="text-blue-600 text-lg md:text-xl font-semibold tracking-[3px]">
            MAGANG
        </span>
        <div class="w-14 h-[2px] bg-gray-400"></div>
    </div>
    <h2 class="text-4xl font-extrabold mt-3">
      #DariMagangJadiJago
    </h2>
    <p class="mt-6 text-slate-700 text-lg leading-relaxed max-w-3xl mx-auto">
        Di PT. Piramida Teknologi Informasi, kalian nggak cuma magang — kalian bertumbuh.
        Terlibat di project nyata, dibimbing mentor berpengalaman, dan diasah jadi lebih siap
        masuk dunia profesional. Datang belajar, pulang jadi lebih jago.
    </p>
</section>

{{-- ================= DIVISI ================= --}}
<section class="relative overflow-hidden">

  {{-- Background image --}}
  <img
    src="{{ asset('assets/images/Latar Belakang Divisi.png') }}"
    alt="Latar belakang divisi"
    class="absolute inset-0 w-full h-full object-cover"
  >

  {{-- Overlay --}}
  <div class="absolute inset-0 bg-sky-500/20 backdrop-blur-[1px]"></div>

  <div class="relative max-w-6xl mx-auto px-6 py-16">

    <h3 class="text-center text-white text-3xl md:text-4xl leading-tight">
      Kami mempunyai berbagai divisi<br>
      <span class="font-bold">untuk mengasah skill Anda</span>
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-12">
      @foreach($divisi as $d)
        <div class="bg-white rounded-2xl shadow-lg
                    w-full max-w-[260px] h-[260px]
                    mx-auto px-6 py-7
                    text-center flex flex-col items-center">

          {{-- icon --}}
          <img
            src="{{ asset('assets/images/' . rawurlencode($d['img'])) }}"
            alt="{{ $d['title'] }}"
            class="w-20 h-20 object-contain mt-1"
          >

          <h4 class="font-bold text-base mt-5">
            {{ $d['title'] }}
          </h4>

          <p class="text-slate-600 text-xs mt-3 leading-relaxed">
            {{ $d['desc'] }}
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
      Benefit Program Magang
    </h2>

    <p class="text-center text-black mt-4 max-w-3xl mx-auto">
      Bersama kami, bangun fondasi karier yang kuat dan ciptakan perjalanan profesional 
      yang penuh tantangan, pembelajaran, serta peluang berkembang.
    </p>

    {{-- Grid --}}
    <div class="grid md:grid-cols-2 gap-10 mt-16">

      {{-- 1 --}}
      <div class="bg-white rounded-2xl p-10
                  shadow-2xl border border-gray-300 bg-white
                  min-h-[190px]">

        <div class="flex items-start gap-6">

          <div class="w-12 h-12 rounded-full
                      bg-blue-500 text-white
                      flex items-center justify-center
                      font-semibold text-lg flex-shrink-0">
            1
          </div>

          <div>
            <h4 class="font-semibold text-xl text-black">
              Terlibat dalam real proyek
            </h4>
            <p class="text-black mt-3">
              Berkesempatan bekerja langsung pada proyek nyata yang berdampak.
            </p>
          </div>

        </div>
      </div>

      {{-- 2 --}}
      <div class="bg-white rounded-2xl p-10
                  shadow-2xl border border-gray-300 bg-white
                  min-h-[190px]">

        <div class="flex items-start gap-6">

          <div class="w-12 h-12 rounded-full
                      bg-blue-500 text-white
                      flex items-center justify-center
                      font-semibold text-lg flex-shrink-0">
            2
          </div>

          <div>
            <h4 class="font-semibold text-xl text-black">
              Lingkungan kerja yang profesional
            </h4>
            <p class="text-black mt-3">
              Suasana kerja yang mendukung pengembangan dan pertumbuhan kemampuan Anda.
            </p>
          </div>

        </div>
      </div>

      {{-- 3 --}}
      <div class="bg-white rounded-2xl p-10
                  shadow-2xl border border-gray-300 bg-white
                  min-h-[190px]">

        <div class="flex items-start gap-6">

          <div class="w-12 h-12 rounded-full
                      bg-blue-500 text-white
                      flex items-center justify-center
                      font-semibold text-lg flex-shrink-0">
            3
          </div>

          <div>
            <h4 class="font-semibold text-xl text-black">
              Mentor berpengalaman
            </h4>
            <p class="text-black mt-3">
              Bimbingan langsung dari profesional yang ahli di bidangnya.
            </p>
          </div>

        </div>
      </div>

      {{-- 4 --}}
      <div class="bg-white rounded-2xl p-10
                  shadow-2xl border border-gray-300 bg-white
                  min-h-[190px]">

        <div class="flex items-start gap-6">

          <div class="w-12 h-12 rounded-full
                      bg-blue-500 text-white
                      flex items-center justify-center
                      font-semibold text-lg flex-shrink-0">
            4
          </div>

          <div>
            <h4 class="font-semibold text-xl text-black">
              Sertifikat magang
            </h4>
            <p class="text-black mt-3">
              Sertifikat resmi sebagai bukti pengalaman magang Anda.
            </p>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>


{{-- ================= CTA ================= --}}
<section class="max-w-6xl mx-auto px-4 pb-20">
    <div class="grid md:grid-cols-2 gap-10 items-center">
        <div>
            <p class="text-blue-600 text-2xl md:text-3xl font-semibold tracking-widest">
              SUDAH SIAP MAGANG DI PTI?
            </p>
            <h3 class="text-4xl font-extrabold mt-4">
                MEMBENTUK MASA DEPAN <span class="text-blue-600">MAGANG DI PTI</span>
            </h3>
            <p class="text-gray-600 mt-4">
                Dengan fokus pada peningkatan kualitas, pengembangan keterampilan, dan pemberdayaan.
                PTI berupaya menciptakan lingkungan yang kondusif bagi peserta magang untuk tumbuh dan berkembang.
            </p>

            {{-- Tombol ke Tahap 1 --}}
            <a href="{{ url('/magang/tahap-1') }}"
               class="inline-block mt-6 bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700">
                Daftar →
            </a>
        </div>

         {{-- RIGHT IMAGE --}}
        <div class="flex justify-center">
            <img src="{{ asset('assets/images/Magang.png') }}"
                 alt="Magang"
                 class="max-w-md w-full">
        </div>
    </div>
</section>

@endsection