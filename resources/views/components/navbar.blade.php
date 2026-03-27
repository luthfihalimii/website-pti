@php
  $isActive = fn($route) => request()->routeIs($route) ? 'text-blue-600 font-semibold' : 'text-slate-500';
  $isKarir = request()->routeIs('internships.*') || request()->routeIs('careers.*');
  $currentLocale = app()->getLocale();
  $localeButtonClass = fn($locale) => $currentLocale === $locale
      ? 'rounded-md bg-white/20 px-2 py-1 text-white'
      : 'rounded-md px-2 py-1 text-white/75 hover:bg-white/10 hover:text-white';

  $logoPti = \App\Models\Logo::where('type', 'pti')->latest()->first();
@endphp

<header class="sticky top-0 z-50">

  {{-- TOPBAR --}}
  <div class="hidden bg-blue-600/70 text-white text-[13px] sm:block">
    <div class="mx-auto flex w-[92%] max-w-[1200px] items-center justify-between gap-3 py-2">
      <div class="flex flex-wrap items-center gap-5">
        <a class="flex items-center gap-2 hover:underline" href="tel:03158283512">
          <img class="h-4 w-4" src="{{ asset('assets/icons/telp.svg') }}" alt="">
          <span>{{ config('site.company.phone') }}</span>
        </a>

        <a class="flex items-center gap-2 hover:underline" href="mailto:marketing@piramidati.com">
          <img class="h-4 w-4" src="{{ asset('assets/icons/mail.svg') }}" alt="">
          <span>{{ config('site.company.primary_email') }}</span>
        </a>
      </div>

      <div class="flex items-center gap-2 font-medium">
        <img class="h-4 w-4" src="{{ asset('assets/icons/language.svg') }}" alt="">
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
  <div class="border-b border-[#DBDBDB]/40 bg-white/80 backdrop-blur">
    <div class="mx-auto w-[92%] max-w-[1200px] py-3">
      <div class="flex items-center justify-between gap-4">

        <a href="{{ route('home') }}" class="flex items-center gap-2 text-slate-950">
          <img class="h-8 w-auto"
               src="{{ $logoPti ? asset('storage/' . $logoPti->path) : asset('assets/logo/logo.svg') }}"
               alt="Piramidasoft">
          <span class="font-bold tracking-wide text-[16px]">PIRAMIDASOFT</span>
        </a>

        <button
          type="button"
          data-mobile-nav-toggle
          aria-controls="mobile-main-menu"
          aria-expanded="false"
          class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-300 text-slate-700 transition hover:bg-slate-100 lg:hidden"
        >
          <span class="sr-only">{{ __('Toggle menu') }}</span>
          <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16"></path>
          </svg>
        </button>

        <nav class="hidden items-center gap-5 text-[14px] lg:flex">
          <a class="hover:text-slate-950 {{ $isActive('home') }}" href="{{ route('home') }}">{{ __('messages.nav.home') }}</a>
          <a class="hover:text-slate-950 {{ $isActive('services') }}" href="{{ route('services') }}">{{ __('messages.nav.services') }}</a>
          <a class="hover:text-slate-950 {{ $isActive('products.index') }}" href="{{ route('products.index') }}">{{ __('messages.nav.products') }}</a>
          <a class="hover:text-slate-950 {{ $isActive('publications.*') }}" href="{{ route('publications.index') }}">{{ __('messages.nav.publications') }}</a>

          <div class="relative" data-nav-careers>
            <button
              type="button"
              data-nav-careers-toggle
              aria-haspopup="menu"
              aria-expanded="{{ $isKarir ? 'true' : 'false' }}"
              aria-controls="career-menu"
              class="flex items-center gap-1 hover:text-slate-950 {{ $isKarir ? 'text-blue-600 font-semibold' : 'text-slate-500' }}"
            >
              {{ __('messages.nav.careers') }} <span class="text-xs">&#9662;</span>
            </button>

            <div
              id="career-menu"
              data-nav-careers-menu
              class="absolute left-0 top-full z-50 hidden min-w-[210px] rounded-xl border border-[#DBDBDB] bg-white/95 py-2 shadow-lg backdrop-blur-md"
            >
              <a class="block px-4 py-2 hover:bg-slate-50/50 hover:text-blue-600 {{ $isActive('internships.*') }}" href="{{ route('internships.index') }}">{{ __('messages.nav.internships') }}</a>
              <a class="block px-4 py-2 hover:bg-slate-50/50 hover:text-blue-600 {{ $isActive('careers.*') }}" href="{{ route('careers.index') }}">{{ __('messages.nav.vacancies') }}</a>
            </div>
          </div>

          <a class="hover:text-slate-950 {{ $isActive('about') }}" href="{{ route('about') }}">{{ __('messages.nav.about') }}</a>
          <a class="hover:text-slate-950 {{ $isActive('contact') }}" href="{{ route('contact') }}">{{ __('messages.nav.contact') }}</a>
        </nav>
      </div>

      <div id="mobile-main-menu" data-mobile-nav-menu class="hidden border-t border-slate-200 pt-3 lg:hidden">
        <nav class="flex flex-col text-[14px]">
          <a class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ $isActive('home') }}" href="{{ route('home') }}">{{ __('messages.nav.home') }}</a>
          <a class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ $isActive('services') }}" href="{{ route('services') }}">{{ __('messages.nav.services') }}</a>
          <a class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ $isActive('products.index') }}" href="{{ route('products.index') }}">{{ __('messages.nav.products') }}</a>
          <a class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ $isActive('publications.*') }}" href="{{ route('publications.index') }}">{{ __('messages.nav.publications') }}</a>

          <button
            type="button"
            data-mobile-careers-toggle
            aria-expanded="{{ $isKarir ? 'true' : 'false' }}"
            aria-controls="mobile-career-menu"
            class="flex items-center justify-between rounded-lg px-3 py-2 text-left {{ $isKarir ? 'text-blue-600 font-semibold' : 'text-slate-500' }} hover:bg-slate-100"
          >
            <span>{{ __('messages.nav.careers') }}</span>
            <span class="text-xs">&#9662;</span>
          </button>
          <div id="mobile-career-menu" data-mobile-careers-menu class="{{ $isKarir ? '' : 'hidden' }} space-y-1 pl-5">
            <a class="block rounded-lg px-3 py-2 hover:bg-slate-100 {{ $isActive('internships.*') }}" href="{{ route('internships.index') }}">{{ __('messages.nav.internships') }}</a>
            <a class="block rounded-lg px-3 py-2 hover:bg-slate-100 {{ $isActive('careers.*') }}" href="{{ route('careers.index') }}">{{ __('messages.nav.vacancies') }}</a>
          </div>

          <a class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ $isActive('about') }}" href="{{ route('about') }}">{{ __('messages.nav.about') }}</a>
          <a class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ $isActive('contact') }}" href="{{ route('contact') }}">{{ __('messages.nav.contact') }}</a>
        </nav>

        <div class="mt-3 grid gap-2 border-t border-slate-200 pt-3 text-[13px] text-slate-600">
          <a class="inline-flex items-center gap-2 rounded-lg px-3 py-2 hover:bg-slate-100" href="tel:03158283512">
            <img class="h-4 w-4" src="{{ asset('assets/icons/telp.svg') }}" alt="">
            <span>{{ config('site.company.phone') }}</span>
          </a>
          <a class="inline-flex items-center gap-2 rounded-lg px-3 py-2 hover:bg-slate-100" href="mailto:marketing@piramidati.com">
            <img class="h-4 w-4" src="{{ asset('assets/icons/mail.svg') }}" alt="">
            <span class="break-all">{{ config('site.company.primary_email') }}</span>
          </a>
          <form method="POST" action="{{ route('locale.switch') }}" class="flex items-center gap-2 px-3 py-2">
            @csrf
            <img class="h-4 w-4" src="{{ asset('assets/icons/language.svg') }}" alt="">
            <button type="submit" name="locale" value="id" class="{{ $localeButtonClass('id') }} !bg-slate-100 !text-slate-700">
              {{ __('messages.language.id') }}
            </button>
            <button type="submit" name="locale" value="en" class="{{ $localeButtonClass('en') }} !bg-slate-100 !text-slate-700">
              {{ __('messages.language.en') }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>
