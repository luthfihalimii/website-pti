<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="@yield('meta_description', config('site.seo.default_description'))">
  <meta property="og:title" content="@yield('title', config('site.company.short_name'))">
  <meta property="og:description" content="@yield('meta_description', config('site.seo.default_description'))">
  <meta property="og:image" content="{{ asset(config('site.seo.default_og_image')) }}">
  <title>@yield('title', 'Piramidasoft')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col font-sans text-slate-950 bg-white">
  @include('components.navbar')

  <main class="flex-1">
    @yield('content')
  </main>

  @include('components.footer')
</body>
</html>
