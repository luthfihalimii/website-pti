@php
  $isActive = fn($path) => request()->is($path) ? 'text-blue-600 font-semibold' : 'text-slate-500';
  $isHome = request()->is('/') ? 'text-blue-600 font-semibold' : 'text-slate-500';
  $isKarir = request()->is('magang*') || request()->is('lowongan');
@endphp

<header class="sticky top-0 z-50">
  {{-- TOPBAR --}}
  <div class="bg-blue-600/70 text-white text-[13px]">
    <div class="mx-auto w-[92%] max-w-[1200px] flex items-center justify-between py-2 gap-3">
      <div class="flex flex-wrap items-center gap-5">
        <a class="flex items-center gap-2 hover:underline" href="tel:03158283512">
          <img class="w-4 h-4" src="{{ asset('assets/icons/telp.svg') }}" alt="">
          <span>031 - 5828 3512</span>
        </a>

        <a class="flex items-center gap-2 hover:underline" href="mailto:marketing@piramidati.com">
          <img class="w-4 h-4" src="{{ asset('assets/icons/mail.svg') }}" alt="">
          <span>marketing@piramidati.com</span>
        </a>
      </div>

      <div class="flex items-center gap-2 font-medium">
        <img class="w-4 h-4" src="{{ asset('assets/icons/language.svg') }}" alt="">
        <span>Indonesia</span>
      </div>
    </div>
  </div>

  {{-- MAIN NAV --}}
  <div class="bg-white/70 border-b border-[#DBDBDB]/30">
    <div class="mx-auto w-[92%] max-w-[1200px] flex items-center justify-between py-3 gap-4">
      <a href="{{ url('/') }}" class="flex items-center gap-2 text-slate-950">
        <img class="h-8 w-auto" src="{{ asset('assets/logo/logo.svg') }}" alt="Piramidasoft">
        <span class="font-bold tracking-wide text-[16px]">PIRAMIDASOFT</span>
      </a>

      <nav class="flex items-center gap-5 flex-wrap text-[14px]">
        <a class="hover:text-slate-950 {{ $isHome }}" href="{{ url('/') }}">Beranda</a>
        <a class="hover:text-slate-950 {{ $isActive('layanan') }}" href="{{ url('/layanan') }}">Layanan</a>
        <a class="hover:text-slate-950 {{ $isActive('produk') }}" href="{{ url('/produk') }}">Produk</a>
        <a class="hover:text-slate-950 {{ $isActive('publikasi') }}" href="{{ url('/publikasi') }}">Publikasi</a>

        {{-- DROPDOWN KARIR --}}
        <div class="relative group">
          <button type="button"
            class="flex items-center gap-1 hover:text-slate-950 {{ $isKarir ? 'text-blue-600 font-semibold' : 'text-slate-500' }}">
            Karir <span class="text-xs">▾</span>
          </button>

          <div
            class="absolute left-0 top-[120%] hidden group-hover:block min-w-[210px] bg-white/85 backdrop-blur-md border border-[#DBDBDB] rounded-xl shadow-lg py-2">
            <a class="block px-4 py-2 hover:bg-slate-50/50 hover:text-blue-600 {{ $isActive('magang') }}"
               href="{{ url('/magang') }}">Magang</a>
            <a class="block px-4 py-2 hover:bg-slate-50/50 hover:text-blue-600 {{ $isActive('lowongan') }}"
               href="{{ url('/lowongan') }}">Lowongan Pekerjaan</a>
          </div>
        </div>

        <a class="hover:text-slate-950 {{ $isActive('tentang') }}" href="{{ url('/tentang') }}">Tentang Kami</a>
        <a class="hover:text-slate-950 {{ $isActive('kontak') }}" href="{{ url('/kontak') }}">Kontak</a>
      </nav>
    </div>
  </div>
</header>