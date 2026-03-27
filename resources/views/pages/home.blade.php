@extends('layouts.app')

@section('title', __('Beranda'))
@section('meta_description', __('Piramidasoft membantu organisasi membangun solusi IT untuk e-procurement, business system, e-government, dan transformasi digital.'))

@section('content')
  @include('components.hero')

  <section class="home-section home-about bg-[#ECEFF4] pt-14 md:pt-16 pb-14 md:pb-16">
    <div class="mx-auto w-[92%] max-w-[1200px]">
      <div class="grid items-center gap-10 lg:grid-cols-[1.1fr_1fr]">
        <div class="relative mx-auto w-full max-w-[520px]">
          <div class="about-image-blob">
            <img
              src="{{ asset('assets/images/tentang-kami.png') }}"
              alt="{{ __('Tim Piramida Teknologi Informasi') }}"
              class="about-image"
            >
          </div>
          <div class="about-pti-badge">PTI</div>
          <div class="about-left-accent"></div>
        </div>

        <div class="space-y-9">
          <article class="pti-item">
            <div class="pti-letter">P</div>
            <div>
              <h3>{{ __('Profesional') }}</h3>
              <p>{{ __('Pekerjaan dilakukan sesuai dengan standar demi penyediaan kualitas produk yang kompetitif.') }}</p>
            </div>
          </article>

          <article class="pti-item">
            <div class="pti-letter">T</div>
            <div>
              <h3>{{ __('Tim') }}</h3>
              <p>{{ __('Bekerja secara tim demi pelayanan yang terbaik bagi pelanggan dengan penuh semangat dan komitmen.') }}</p>
            </div>
          </article>

          <article class="pti-item">
            <div class="pti-letter">I</div>
            <div>
              <h3>{{ __('Inovatif') }}</h3>
              <p>{{ __('Kemampuan dan pengetahuan saja tidak cukup, melainkan inovasi juga dibutuhkan untuk menyediakan solusi digital yang terbaik.') }}</p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section class="home-section bg-[#ECEFF4] pb-16 md:pb-20">
    <div class="mx-auto w-[92%] max-w-[1200px]">
      <header class="text-center">
        <h2 class="home-heading">{{ __('Layanan') }}</h2>
        <p class="home-subheading">{{ __('Kami memberikan rangkaian layanan terbaik untuk mengatasi semua tantangan transformasi digital') }}</p>
      </header>

      <div class="mt-9 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($services as $service)
          <article class="service-card">
            <div class="service-image-wrap">
              <img src="{{ $service['image'] }}" alt="{{ __($service['title']) }}">
            </div>
            <div class="service-icon">{{ $service['icon'] }}</div>
            <div class="service-body">
              <h3>{{ __($service['title']) }}</h3>
              <p>{{ __($service['description']) }}</p>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </section>

  <section class="home-section bg-[#ECEFF4] pb-16 md:pb-20">
    <div class="mx-auto w-[92%] max-w-[1200px]" id="homeProductShowcase" data-product-count="{{ count($products) }}">
      <header class="text-center">
        <h2 class="home-heading">{{ __('Produk Unggulan Kami') }}</h2>
        <p class="home-subheading">{{ __('Kami menawarkan beberapa produk untuk bisnis anda dengan berbagai pilihan') }}</p>
      </header>

      <article class="product-featured-card mt-9">
        <div class="product-featured-image-wrap">
          <img
            src="{{ $products[0]['image'] }}"
            alt="{{ __($products[0]['title']) }}"
            data-product-image
          >
        </div>
        <div class="product-featured-content">
          <div class="product-featured-title-bar">
            <h3 data-product-title>{{ __($products[0]['title']) }}</h3>
          </div>

          <div class="space-y-3 text-[14px] leading-relaxed text-[#525B6C]" data-product-summary>
            @foreach ($products[0]['summary'] as $paragraph)
              <p>{{ __($paragraph) }}</p>
            @endforeach
          </div>

          <a href="{{ $products[0]['link'] }}" class="product-detail-link" data-product-link>{{ __('Lihat Detail') }}</a>
        </div>
      </article>

      <div class="product-tabs-board mt-7">
        <button type="button" aria-label="{{ __('Sebelumnya') }}" aria-controls="homeProductTabsTrack" class="product-arrow" data-product-arrow="prev">&lt;</button>
        <div class="product-tabs" id="homeProductTabsTrack" data-product-track>
          @foreach ($products as $index => $product)
            <button
              type="button"
              class="product-tab {{ $index === 0 ? 'is-active' : '' }}"
              data-product-tab="{{ $index }}"
              data-product-title="{{ __($product['title']) }}"
              data-product-image="{{ $product['image'] }}"
              data-product-link="{{ $product['link'] }}"
              data-product-summary='@json(array_map(static fn ($paragraph) => __($paragraph), $product['summary']))'
            >
              <img src="{{ $product['image'] }}" alt="{{ __($product['tab']) }}">
              <span>{!! nl2br(e(__($product['tab_mobile']))) !!}</span>
            </button>
          @endforeach
        </div>
        <button type="button" aria-label="{{ __('Berikutnya') }}" aria-controls="homeProductTabsTrack" class="product-arrow" data-product-arrow="next">&gt;</button>
      </div>
    </div>
  </section>
@php
  $clientLogos = \App\Models\Logo::where('type', 'client')->latest()->get();
@endphp

<section class="home-section bg-[#ECEFF4] pb-16 md:pb-20">
  <div class="mx-auto w-[92%] max-w-[1200px]">
    
    <header class="text-center">
      <h2 class="home-heading">{{ __('Klien Kami') }}</h2>
      <p class="home-subheading">
        {{ __('Berikut adalah perusahaan maupun instansi yang pernah bekerjasama dengan kami') }}
      </p>
    </header>

    <div class="client-board mt-8">
      <button type="button" class="client-arrow" data-client-arrow="prev">&lt;</button>

      <div class="client-grid" data-client-track>
        @forelse ($clientLogos as $client)
          <figure class="client-badge">
            <div class="client-badge-shape">
              <img 
                src="{{ asset('storage/' . $client->path) }}" 
                alt="Client Logo"
                class="h-12 object-contain"
              >
            </div>
            <figcaption class="text-sm mt-2 text-center text-slate-600">
              Client
            </figcaption>
          </figure>
        @empty
          <p class="text-center text-slate-500 col-span-full">
            Belum ada logo client
          </p>
        @endforelse
      </div>

      <button type="button" class="client-arrow" data-client-arrow="next">&gt;</button>
    </div>

  </div>
</section>

  <script>
    (function () {
      const root = document.getElementById('homeProductShowcase');
      if (!root) return;

      const tabs = Array.from(root.querySelectorAll('[data-product-tab]'));
      const image = root.querySelector('[data-product-image]');
      const title = root.querySelector('[data-product-title]');
      const summary = root.querySelector('[data-product-summary]');
      const link = root.querySelector('[data-product-link]');
      const productTrack = root.querySelector('[data-product-track]');
      const productPrev = root.querySelector('[data-product-arrow="prev"]');
      const productNext = root.querySelector('[data-product-arrow="next"]');
      const clientTrack = document.querySelector('[data-client-track]');
      const clientPrev = document.querySelector('[data-client-arrow="prev"]');
      const clientNext = document.querySelector('[data-client-arrow="next"]');

      if (!tabs.length || !image || !title || !summary || !link) return;

      function renderSummary(paragraphs) {
        summary.replaceChildren(
          ...paragraphs.map((paragraph) => {
            const paragraphElement = document.createElement('p');
            paragraphElement.textContent = paragraph;

            return paragraphElement;
          })
        );
      }

      function renderFromTab(tabButton) {
        tabs.forEach((tab) => tab.classList.remove('is-active'));
        tabButton.classList.add('is-active');

        const nextTitle = tabButton.dataset.productTitle || '';
        const nextImage = tabButton.dataset.productImage || '';
        const nextLink = tabButton.dataset.productLink || '#';
        const nextSummary = JSON.parse(tabButton.dataset.productSummary || '[]');

        title.textContent = nextTitle;
        image.src = nextImage;
        image.alt = nextTitle;
        link.href = nextLink;
        renderSummary(Array.isArray(nextSummary) ? nextSummary : []);

        tabButton.scrollIntoView({
          behavior: 'smooth',
          inline: 'nearest',
          block: 'nearest',
        });
      }

      tabs.forEach((tab) => {
        tab.addEventListener('click', function () {
          renderFromTab(this);
        });
      });

      if (productTrack && productPrev && productNext) {
        const updateProductControls = () => {
          const isOverflowing = productTrack.scrollWidth > productTrack.clientWidth + 1;
          const atStart = productTrack.scrollLeft <= 1;
          const atEnd = productTrack.scrollLeft + productTrack.clientWidth >= productTrack.scrollWidth - 1;

          productPrev.disabled = !isOverflowing || atStart;
          productNext.disabled = !isOverflowing || atEnd;
        };

        productPrev.addEventListener('click', () => {
          productTrack.scrollBy({
            left: -Math.max(220, Math.round(productTrack.clientWidth * 0.75)),
            behavior: 'smooth',
          });
        });

        productNext.addEventListener('click', () => {
          productTrack.scrollBy({
            left: Math.max(220, Math.round(productTrack.clientWidth * 0.75)),
            behavior: 'smooth',
          });
        });

        productTrack.addEventListener('scroll', updateProductControls, { passive: true });
        window.addEventListener('resize', updateProductControls);
        updateProductControls();
      }

      if (clientTrack && clientPrev && clientNext) {
        const updateClientControls = () => {
          const isOverflowing = clientTrack.scrollWidth > clientTrack.clientWidth + 1;
          const atStart = clientTrack.scrollLeft <= 1;
          const atEnd = clientTrack.scrollLeft + clientTrack.clientWidth >= clientTrack.scrollWidth - 1;

          clientPrev.disabled = !isOverflowing || atStart;
          clientNext.disabled = !isOverflowing || atEnd;
        };

        clientPrev.addEventListener('click', () => {
          clientTrack.scrollBy({
            left: -Math.max(220, Math.round(clientTrack.clientWidth * 0.8)),
            behavior: 'smooth',
          });
        });

        clientNext.addEventListener('click', () => {
          clientTrack.scrollBy({
            left: Math.max(220, Math.round(clientTrack.clientWidth * 0.8)),
            behavior: 'smooth',
          });
        });

        clientTrack.addEventListener('scroll', updateClientControls, { passive: true });
        window.addEventListener('resize', updateClientControls);
        updateClientControls();
      }
    })();
  </script>
@endsection
