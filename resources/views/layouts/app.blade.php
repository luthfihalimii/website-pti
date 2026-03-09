<!doctype html>
<html lang="{{ app()->getLocale() }}">
@php
  $defaultTitle = config('site.company.short_name');
  $defaultDescription = __('Piramidasoft menyediakan solusi IT untuk e-procurement, business system, e-government, smart city, dan konsultasi teknologi informasi.');
  $pageTitle = trim($__env->yieldContent('title', $defaultTitle));
  $metaDescription = trim($__env->yieldContent('meta_description', $defaultDescription));
  $metaImage = trim($__env->yieldContent('meta_image')) ?: asset(config('site.seo.default_og_image'));
  $canonicalUrl = trim($__env->yieldContent('canonical_url')) ?: url()->current();
  $metaRobots = trim($__env->yieldContent('meta_robots')) ?: 'index,follow';
  $ogType = trim($__env->yieldContent('og_type')) ?: 'website';
@endphp
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $pageTitle }}</title>
  <meta name="description" content="{{ $metaDescription }}">
  <meta name="robots" content="{{ $metaRobots }}">
  <link rel="canonical" href="{{ $canonicalUrl }}">
  <meta property="og:title" content="{{ $pageTitle }}">
  <meta property="og:description" content="{{ $metaDescription }}">
  <meta property="og:image" content="{{ $metaImage }}">
  <meta property="og:url" content="{{ $canonicalUrl }}">
  <meta property="og:type" content="{{ $ogType }}">
  <meta property="og:site_name" content="{{ config('site.company.short_name') }}">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $pageTitle }}">
  <meta name="twitter:description" content="{{ $metaDescription }}">
  <meta name="twitter:image" content="{{ $metaImage }}">
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
