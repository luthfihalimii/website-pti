<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin') - Piramidasoft</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 font-sans text-slate-900">
  <div class="min-h-screen lg:grid lg:grid-cols-[290px_1fr]">
    <div data-admin-sidebar-backdrop class="fixed inset-0 z-40 hidden bg-slate-950/45 lg:hidden"></div>

    <aside data-admin-sidebar class="fixed inset-y-0 left-0 z-50 hidden w-[290px] overflow-y-auto border-r border-slate-800 bg-slate-950 px-6 py-8 text-white lg:static lg:block lg:w-auto lg:border-b-0">
      <a href="{{ route('admin.dashboard') }}" class="block rounded-3xl border border-white/10 bg-slate-900 px-5 py-5">
        <p class="text-[11px] font-semibold uppercase tracking-[0.34em] text-sky-300">{{ __('Pusat Operasional') }}</p>
        <h1 class="mt-3 text-2xl font-semibold tracking-tight text-white">Piramidasoft Admin</h1>
        <p class="mt-2 text-sm leading-6 text-slate-300">Kontrol operasional produk, lead, dan pipeline rekrutmen.</p>
      </a>

        <nav class="mt-8 space-y-6 text-sm">
          <div class="space-y-2">
            <p class="px-3 text-[11px] font-semibold uppercase tracking-[0.28em] text-slate-400">{{ __('Ikhtisar') }}</p>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-white text-slate-950 shadow-lg shadow-sky-500/10' : 'text-slate-300 hover:bg-white/8 hover:text-white' }} block rounded-2xl px-4 py-3 font-medium transition">
              Dashboard
            </a>
          </div>

          <div class="space-y-2">
            <p class="px-3 text-[11px] font-semibold uppercase tracking-[0.28em] text-slate-400">{{ __('Rekrutmen') }}</p>
            <a href="{{ route('admin.job-applications.index') }}" class="{{ request()->routeIs('admin.job-applications.*') ? 'bg-white text-slate-950 shadow-lg shadow-sky-500/10' : 'text-slate-300 hover:bg-white/8 hover:text-white' }} block rounded-2xl px-4 py-3 font-medium transition">
              Lamaran Kerja
            </a>
            <a href="{{ route('admin.internship-applications.index') }}" class="{{ request()->routeIs('admin.internship-applications.*') ? 'bg-white text-slate-950 shadow-lg shadow-sky-500/10' : 'text-slate-300 hover:bg-white/8 hover:text-white' }} block rounded-2xl px-4 py-3 font-medium transition">
              Pendaftaran Magang
            </a>
            <a href="{{ route('admin.vacancies.index') }}" class="{{ request()->routeIs('admin.vacancies.*') ? 'bg-white text-slate-950 shadow-lg shadow-sky-500/10' : 'text-slate-300 hover:bg-white/8 hover:text-white' }} block rounded-2xl px-4 py-3 font-medium transition">
              Lowongan Pekerjaan
            </a>
          </div>

          <div class="space-y-2">
            <p class="px-3 text-[11px] font-semibold uppercase tracking-[0.28em] text-slate-400">{{ __('Katalog') }}</p>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'bg-white text-slate-950 shadow-lg shadow-sky-500/10' : 'text-slate-300 hover:bg-white/8 hover:text-white' }} block rounded-2xl px-4 py-3 font-medium transition">
              Kategori Produk
            </a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'bg-white text-slate-950 shadow-lg shadow-sky-500/10' : 'text-slate-300 hover:bg-white/8 hover:text-white' }} block rounded-2xl px-4 py-3 font-medium transition">
              Produk
            </a>
            <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'bg-white text-slate-950 shadow-lg shadow-sky-500/10' : 'text-slate-300 hover:bg-white/8 hover:text-white' }} block rounded-2xl px-4 py-3 font-medium transition">
              Layanan
            </a>
            <a href="{{ route('admin.product-inquiries.index') }}" class="{{ request()->routeIs('admin.product-inquiries.*') ? 'bg-white text-slate-950 shadow-lg shadow-sky-500/10' : 'text-slate-300 hover:bg-white/8 hover:text-white' }} block rounded-2xl px-4 py-3 font-medium transition">
              Inquiry Produk
            </a>
          </div>
          <div class="space-y-2">
            <p class="px-3 text-[11px] font-semibold uppercase tracking-[0.28em] text-slate-400">Pengaturan</p>
            
            <a href="{{ route('admin.logos.index') }}"
              class="{{ request()->routeIs('admin.logos.*') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-white/8 hover:text-white' }}
              block rounded-2xl px-4 py-3 font-medium transition">
              Logo Website
            </a>
          </div>
          <div class="space-y-2">
            <p class="px-3 text-[11px] font-semibold uppercase tracking-[0.28em] text-slate-400">{{ __('Kontak') }}</p>
            <a href="{{ route('admin.contact-inquiries.index') }}" class="{{ request()->routeIs('admin.contact-inquiries.*') ? 'bg-white text-slate-950 shadow-lg shadow-sky-500/10' : 'text-slate-300 hover:bg-white/8 hover:text-white' }} block rounded-2xl px-4 py-3 font-medium transition">
              Pesan Kontak
            </a>
          </div>
        </nav>

        <div class="mt-8 rounded-3xl border border-white/10 bg-slate-900 px-5 py-5">
          <p class="text-sm font-semibold text-white">{{ __('Katalog publik') }}</p>
          <p class="mt-2 text-sm leading-6 text-slate-300">Lihat bagaimana produk tampil di sisi publik sebelum publish perubahan.</p>
          <a href="{{ route('products.index') }}" class="mt-4 inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-slate-100">
            Buka Website
            <span aria-hidden="true">&rarr;</span>
          </a>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST" class="mt-6">
          @csrf
          <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl border border-white/10 px-4 py-3 text-sm font-semibold text-slate-200 transition hover:bg-white/8 hover:text-white">
            Logout
          </button>
        </form>
    </aside>

    <main class="px-5 py-6 sm:px-6 lg:px-10 lg:py-8">
      <div class="mx-auto max-w-7xl">
        <div class="mb-4 flex items-center justify-between gap-3 lg:hidden">
          <button
            type="button"
            data-admin-sidebar-toggle
            aria-expanded="false"
            class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
          >
            <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16"></path>
            </svg>
            Menu
          </button>
          <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Admin</p>
        </div>

        <div class="mb-6 flex flex-col gap-4 rounded-3xl border border-slate-200 bg-white px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <p class="text-[11px] font-semibold uppercase tracking-[0.34em] text-sky-700">{{ __('Ruang Kerja Admin') }}</p>
            <p class="mt-2 text-sm leading-6 text-slate-600">Pantau lead masuk, review kandidat, dan kelola katalog produk dari satu dashboard.</p>
          </div>
          <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
            <p class="text-[11px] uppercase tracking-[0.28em] text-slate-500">{{ __('Sesi') }}</p>
            <p class="mt-1 font-semibold text-slate-900">{{ auth()->user()->email ?? 'admin' }}</p>
          </div>
        </div>

        @if (session('status'))
          <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700">
            {{ session('status') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            <p class="font-semibold">Periksa kembali data berikut:</p>
            <ul class="mt-2 list-inside list-disc space-y-1">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @yield('content')
      </div>
    </main>
  </div>
</body>
</html>
