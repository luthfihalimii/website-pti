@php
$isActive = fn($route) => request()->routeIs($route)
    ? 'text-blue-600 font-semibold'
    : 'text-slate-500';

$isKarir = request()->routeIs('internships.*') || request()->routeIs('careers.*');

$currentLocale = app()->getLocale();

$localeButtonClass = fn($locale) => $currentLocale === $locale
    ? 'rounded-md bg-white/20 px-2 py-1 text-white'
    : 'rounded-md px-2 py-1 text-white/75 hover:bg-white/10 hover:text-white';

/* ambil logo navbar dari admin */
$logoPti = \App\Models\Logo::where('type','pti')->latest()->first();
@endphp

<header class="sticky top-0 z-50">

  {{-- TOPBAR --}}
  <div class="hidden bg-blue-600/70 text-white text-[13px] sm:block">
    <div class="mx-auto flex w-[92%] max-w-[1200px] items-center justify-between gap-3 py-2">
      <div class="flex flex-wrap items-center gap-5">
        <a class="flex items-center gap-2 hover:underline" href="tel:03158283512">
          <img class="h-4 w-4" src="{{ asset('assets/icons/telp.svg') }}">
          <span>{{ config('site.company.phone') }}</span>
        </a>
        <a class="flex items-center gap-2 hover:underline" href="mailto:marketing@piramidati.com">
          <img class="h-4 w-4" src="{{ asset('assets/icons/mail.svg') }}">
          <span>{{ config('site.company.primary_email') }}</span>
        </a>
      </div>
      <div class="flex items-center gap-2 font-medium">
        <img class="h-4 w-4" src="{{ asset('assets/icons/language.svg') }}">
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

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2 text-slate-950">
          @if ($logoPti && $logoPti->path)
            <img class="h-8 w-auto"
                src="{{ asset('storage/'.$logoPti->path) }}"
                alt="Piramidasoft">
          @endif

          <span class="font-bold tracking-wide text-[16px]">
            PIRAMIDASOFT
          </span>
        </a>

        {{-- MOBILE BUTTON --}}
        <button type="button" data-mobile-nav-toggle
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 lg:hidden">
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 7h16M4 12h16M4 17h16"></path>
          </svg>
        </button>

        {{-- DESKTOP MENU --}}
        <nav class="hidden items-center gap-5 text-[14px] lg:flex">
          <a class="hover:text-slate-950 {{ $isActive('home') }}" href="{{ route('home') }}">
            {{ __('messages.nav.home') }}
          </a>
          <a class="hover:text-slate-950 {{ $isActive('services.index') }}" href="{{ route('services.index') }}">
            {{ __('messages.nav.services') }}
          </a>
          <a class="hover:text-slate-950 {{ $isActive('products.index') }}" href="{{ route('products.index') }}">
            {{ __('messages.nav.products') }}
          </a>
          <a class="hover:text-slate-950 {{ $isActive('publications.index') }}" href="{{ route('publications.index') }}">
            {{ __('messages.nav.publications') }}
          </a>
          <a class="hover:text-slate-950 {{ $isActive('about') }}" href="{{ route('about') }}">
            {{ __('messages.nav.about') }}
          </a>
          <a class="hover:text-slate-950 {{ $isActive('contact') }}" href="{{ route('contact') }}">
            {{ __('messages.nav.contact') }}
          </a>
        </nav>

      </div>
    </div>
  </div>

</header>