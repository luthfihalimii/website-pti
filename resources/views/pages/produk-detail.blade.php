@extends('layouts.app')

@section('title', $product->seo_title ?: $product->name.' - Piramidasoft')
@section('meta_description', $product->seo_description ?: ($product->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($product->description), 150)))

@section('content')
  <section class="relative overflow-hidden bg-slate-950 text-white">
    <img src="{{ $product->cover_image_url ?? asset('assets/images/hero-pages.png') }}" alt="{{ $product->name }}" class="absolute inset-0 h-full w-full object-cover opacity-20">
    <div class="relative mx-auto max-w-6xl px-6 py-20">
      <p class="text-sm font-semibold uppercase tracking-[0.24em] text-blue-200">{{ __($product->category->name) }}</p>
      <h1 class="mt-4 max-w-4xl text-4xl font-bold md:text-6xl">{{ $product->name }}</h1>
      <p class="mt-4 max-w-3xl text-base leading-7 text-blue-50/90 md:text-lg">
        {{ $product->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($product->description), 180) }}
      </p>
    </div>
  </section>

  <section class="bg-white py-12">
    <div class="mx-auto grid max-w-6xl gap-10 px-6 lg:grid-cols-[1.1fr_0.9fr]">
      <div class="space-y-10">
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
          <h2 class="text-2xl font-bold text-slate-950">{{ __('Deskripsi Produk') }}</h2>
          <div class="prose mt-4 max-w-none text-slate-700">
            {!! nl2br(e($product->description)) !!}
          </div>
        </div>

        @if ($product->features->isNotEmpty())
          <div class="rounded-3xl border border-slate-200 bg-slate-50 p-8">
            <h2 class="text-2xl font-bold text-slate-950">{{ __('Fitur Utama') }}</h2>
            <div class="mt-6 grid gap-4">
              @foreach ($product->features as $feature)
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                  <h3 class="text-lg font-semibold text-slate-950">{{ $feature->title }}</h3>
                  @if ($feature->description)
                    <p class="mt-2 text-sm leading-7 text-slate-600">{{ $feature->description }}</p>
                  @endif
                </div>
              @endforeach
            </div>
          </div>
        @endif

        @if ($product->media->isNotEmpty())
          <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <h2 class="text-2xl font-bold text-slate-950">{{ __('Galeri') }}</h2>
            <div class="mt-6 grid gap-4 md:grid-cols-2">
              @foreach ($product->media as $media)
                <img src="{{ $media->url }}" alt="{{ $media->alt_text ?: $product->name }}" class="h-56 w-full rounded-2xl object-cover">
              @endforeach
            </div>
          </div>
        @endif

        @if ($product->attachments->isNotEmpty())
          <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <h2 class="text-2xl font-bold text-slate-950">{{ __('Attachment') }}</h2>
            <div class="mt-6 grid gap-3">
              @foreach ($product->attachments as $attachment)
                <a href="{{ $attachment->url }}" target="_blank" rel="noreferrer" class="inline-flex items-center justify-between rounded-2xl border border-slate-200 px-5 py-4 text-sm font-semibold text-slate-700 transition hover:border-blue-300 hover:text-blue-600">
                  <span>{{ $attachment->title }}</span>
                  <span aria-hidden="true">&rarr;</span>
                </a>
              @endforeach
            </div>
          </div>
        @endif
      </div>

      <aside class="space-y-8">
        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-8">
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">Product Inquiry</p>
          <h2 class="mt-3 text-2xl font-bold text-slate-950">{{ __('Minta Demo Produk') }}</h2>
          <p class="mt-3 text-sm leading-7 text-slate-600">
            {{ __('Tinggalkan detail singkat kebutuhan Anda. Tim kami akan menghubungi Anda untuk demo atau diskusi lanjutan.') }}
          </p>

          @if (session('product_inquiry_status'))
            <div class="mt-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
              {{ session('product_inquiry_status') }}
            </div>
          @endif

          @if ($errors->any())
            <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
              <p class="font-semibold">{{ __('Periksa kembali data berikut:') }}</p>
              <ul class="mt-2 list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('products.inquiries.store', $product->slug) }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('Nama Lengkap') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="{{ __('Nomor Telepon') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
            <input type="text" name="company" value="{{ old('company') }}" placeholder="{{ __('Perusahaan / Instansi') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
            <textarea name="message" rows="5" placeholder="{{ __('Ceritakan kebutuhan Anda') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>{{ old('message') }}</textarea>
            <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
              {{ __('Kirim Permintaan Demo') }}
            </button>
          </form>
        </div>

        @if ($relatedProducts->isNotEmpty())
          <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <h2 class="text-2xl font-bold text-slate-950">{{ __('Produk Terkait') }}</h2>
            <div class="mt-6 space-y-4">
              @foreach ($relatedProducts as $relatedProduct)
                <a href="{{ route('products.show', $relatedProduct->slug) }}" class="block rounded-2xl border border-slate-200 px-5 py-4 transition hover:border-blue-300 hover:bg-blue-50">
                  <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-600">{{ __($relatedProduct->category->name) }}</p>
                  <h3 class="mt-2 text-lg font-semibold text-slate-950">{{ $relatedProduct->name }}</h3>
                </a>
              @endforeach
            </div>
          </div>
        @endif
      </aside>
    </div>
  </section>
@endsection
