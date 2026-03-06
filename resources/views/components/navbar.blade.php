@php
  $isActive = fn($route) => request()->routeIs($route) ? 'text-blue-600 font-semibold' : 'text-slate-500';
  $isKarir = request()->routeIs('internships.*') || request()->routeIs('careers.*');
  $currentLocale = app()->getLocale();
  $localeButtonClass = fn($locale) => $currentLocale === $locale
      ? 'rounded-md bg-white/20 px-2 py-1 text-white'
      : 'rounded-md px-2 py-1 text-white/75 hover:bg-white/10 hover:text-white';
@endphp

<header class="sticky top-0 z-50">
  {{-- TOPBAR --}}
  <div class="bg-blue-600/70 text-white text-[13px]">
    <div class="mx-auto w-[92%] max-w-[1200px] flex items-center justify-between py-2 gap-3">
      <div class="flex flex-wrap items-center gap-5">
        <a class="flex items-center gap-2 hover:underline" href="tel:03158283512">
          <img class="w-4 h-4" src="{{ asset('assets/icons/telp.svg') }}" alt="">
          <span>{{ config('site.company.phone') }}</span>
        </a>

        <a class="flex items-center gap-2 hover:underline" href="mailto:marketing@piramidati.com">
          <img class="w-4 h-4" src="{{ asset('assets/icons/mail.svg') }}" alt="">
          <span>{{ config('site.company.primary_email') }}</span>
        </a>
      </div>

      <div class="flex items-center gap-2 font-medium">
        <img class="w-4 h-4" src="{{ asset('assets/icons/language.svg') }}" alt="">
        <span>{{ __('messages.language.label') }}</span>
        <form method="POST" action="{{ route('locale.switch') }}" class="flex items-center gap-1">
          @csrf
          <button type="submit" name="locale" value="id" class="{{ $localeButtonClass('id') }}">
            {{ __('messages.language.id') }}
          </button>
          <button type="submit" name="locale" value="en" class="{{ $localeButtonClass('en') }}">
            {{ __('messages.language.en') }}
          </button>
        </form>
      </div>
    </div>
  </div>

  {{-- MAIN NAV --}}
  <div class="bg-white/70 border-b border-[#DBDBDB]/30">
    <div class="mx-auto w-[92%] max-w-[1200px] flex items-center justify-between py-3 gap-4">
      <a href="{{ route('home') }}" class="flex items-center gap-2 text-slate-950">
        <img class="h-8 w-auto" src="{{ asset('assets/logo/logo.svg') }}" alt="Piramidasoft">
        <span class="font-bold tracking-wide text-[16px]">PIRAMIDASOFT</span>
      </a>

      <nav class="flex items-center gap-5 flex-wrap text-[14px]">
        <a class="hover:text-slate-950 {{ $isActive('home') }}" href="{{ route('home') }}">{{ __('messages.nav.home') }}</a>
        <a class="hover:text-slate-950 {{ $isActive('services') }}" href="{{ route('services') }}">{{ __('messages.nav.services') }}</a>
        <a class="hover:text-slate-950 {{ $isActive('products.index') }}" href="{{ route('products.index') }}">{{ __('messages.nav.products') }}</a>
        <a class="hover:text-slate-950 {{ $isActive('publications.*') }}" href="{{ route('publications.index') }}">{{ __('messages.nav.publications') }}</a>

        {{-- DROPDOWN KARIR --}}
        <div class="relative" data-nav-careers>
          <button type="button"
            data-nav-careers-toggle
            aria-haspopup="menu"
            aria-expanded="{{ $isKarir ? 'true' : 'false' }}"
            aria-controls="career-menu"
            class="flex items-center gap-1 hover:text-slate-950 {{ $isKarir ? 'text-blue-600 font-semibold' : 'text-slate-500' }}">
            {{ __('messages.nav.careers') }} <span class="text-xs">▾</span>
          </button>

          <div
            id="career-menu"
            data-nav-careers-menu
            class="absolute left-0 top-[120%] hidden min-w-[210px] bg-white/85 backdrop-blur-md border border-[#DBDBDB] rounded-xl shadow-lg py-2">
            <a class="block px-4 py-2 hover:bg-slate-50/50 hover:text-blue-600 {{ $isActive('internships.*') }}"
               href="{{ route('internships.index') }}">{{ __('messages.nav.internships') }}</a>
            <a class="block px-4 py-2 hover:bg-slate-50/50 hover:text-blue-600 {{ $isActive('careers.*') }}"
               href="{{ route('careers.index') }}">{{ __('messages.nav.vacancies') }}</a>
          </div>
        </div>

        <a class="hover:text-slate-950 {{ $isActive('about') }}" href="{{ route('about') }}">{{ __('messages.nav.about') }}</a>
        <a class="hover:text-slate-950 {{ $isActive('contact') }}" href="{{ route('contact') }}">{{ __('messages.nav.contact') }}</a>
      </nav>
    </div>
  </div>
</header>
