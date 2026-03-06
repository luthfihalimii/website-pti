<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('Admin Login') }} - Piramidasoft</title>
  @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-slate-950 font-sans text-slate-950">
  <div class="flex min-h-screen items-center justify-center px-6">
    <div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-2xl">
      <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">Admin Access</p>
      <h1 class="mt-3 text-3xl font-bold text-slate-950">{{ __('Login Admin') }}</h1>
      <p class="mt-2 text-sm leading-7 text-slate-600">{{ __('Gunakan akun admin untuk mengelola katalog produk dan inquiry.') }}</p>

      @if ($errors->any())
        <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('admin.login.store') }}" method="POST" class="mt-6 space-y-4">
        @csrf
        <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Email admin') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
        <input type="password" name="password" placeholder="{{ __('Password') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
        <button type="submit" class="inline-flex h-12 w-full items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
          {{ __('Masuk ke Admin') }}
        </button>
      </form>

      <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-xs leading-6 text-slate-600">
        {{ __('Default local seed:') }} <strong>admin@piramidasoft.local</strong> / <strong>password</strong>
      </div>
    </div>
  </div>
</body>
</html>
