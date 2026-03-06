@extends('layouts.app')

@section('title', __('Produk') . ' - Piramidasoft')
@section('meta_description', __('Katalog produk Piramidasoft yang mencakup business system, e-procurement, e-government, dan smart city.'))

@section('content')
  <section class="relative overflow-hidden bg-blue-950 text-white">
    <img src="{{ asset('assets/images/hero-pages.png') }}" alt="{{ __('Hero Produk') }}" class="absolute inset-0 h-full w-full object-cover opacity-20">
    <div class="relative mx-auto max-w-6xl px-6 py-20">
      <p class="text-sm font-semibold uppercase tracking-[0.24em] text-blue-200">Product Module</p>
      <h1 class="mt-4 text-4xl font-bold md:text-6xl">{{ __('Katalog Produk') }}</h1>
      <p class="mt-4 max-w-3xl text-base leading-7 text-blue-50/90 md:text-lg">
        {{ __('Jelajahi solusi Piramidasoft untuk e-procurement, business system, e-government, dan transformasi digital organisasi.') }}
      </p>
    </div>
  </section>

  <section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-6xl px-6">
      <form method="GET" action="{{ route('products.index') }}" class="grid gap-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm md:grid-cols-[1fr_220px_auto]">
        <label class="block">
          <span class="mb-2 block text-sm font-medium text-slate-700">{{ __('Cari Produk') }}</span>
          <input
            type="text"
            name="q"
            value="{{ $search }}"
            placeholder="{{ __('Cari nama produk atau solusi') }}"
            class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
          >
        </label>

        <label class="block">
          <span class="mb-2 block text-sm font-medium text-slate-700">{{ __('Kategori') }}</span>
          <select
            name="category"
            class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
          >
            <option value="">{{ __('Semua kategori') }}</option>
            @foreach ($categories as $category)
              <option value="{{ $category->slug }}" @selected($selectedCategory === $category->slug)>{{ __($category->name) }}</option>
            @endforeach
          </select>
        </label>

        <div class="flex items-end gap-3">
          <button type="submit" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
            {{ __('Terapkan') }}
          </button>
          <a href="{{ route('products.index') }}" class="inline-flex h-12 items-center justify-center rounded-xl border border-slate-300 px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
            {{ __('Reset') }}
          </a>
        </div>
      </form>
    </div>
  </section>

  <section class="bg-white py-12">
    <div class="mx-auto max-w-6xl px-6">
      <div class="mb-8 flex items-center justify-between gap-4">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">Published Products</p>
          <h2 class="mt-2 text-3xl font-bold text-slate-950">{{ __('Semua Produk') }}</h2>
        </div>
        <p class="text-sm text-slate-500">{{ __(':count produk ditemukan', ['count' => $products->count()]) }}</p>
      </div>

      @if ($products->isEmpty())
        <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-6 py-12 text-center text-slate-600">
          {{ __('Belum ada produk yang cocok dengan filter ini.') }}
        </div>
      @else
        <div class="flex flex-wrap gap-6">
          @foreach ($products as $product)
            <article class="flex w-full flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg md:w-[calc(50%-0.75rem)] xl:w-[calc(33.333%-1rem)]">
              <div class="relative h-56 overflow-hidden bg-slate-100">
                <img
                  src="{{ $product->cover_image_url ?? asset('assets/images/hero-pages.png') }}"
                  alt="{{ $product->name }}"
                  class="h-full w-full object-cover"
                >
                @if ($product->is_featured)
                  <span class="absolute left-4 top-4 rounded-full bg-blue-600 px-3 py-1 text-xs font-semibold text-white">{{ __('Featured') }}</span>
                @endif
              </div>

              <div class="flex flex-1 flex-col space-y-4 p-6">
                <div class="space-y-2">
                  <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-600">{{ __($product->category->name) }}</p>
                  <h3 class="text-2xl font-bold text-slate-950">{{ $product->name }}</h3>
                  <p class="text-sm leading-7 text-slate-600">
                    {{ $product->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($product->description), 140) }}
                  </p>
                </div>

                <a href="{{ route('products.show', $product->slug) }}" class="mt-auto inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700">
                  <span>{{ __('Lihat Detail') }}</span>
                  <span aria-hidden="true">&rarr;</span>
                </a>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>
  </section>
@endsection
