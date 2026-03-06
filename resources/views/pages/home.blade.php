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

      <div class="product-tabs mt-7">
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
    </div>
  </section>

  <section class="home-section bg-[#ECEFF4] pb-16 md:pb-20">
    <div class="mx-auto w-[92%] max-w-[1200px]">
      <header class="text-center">
        <h2 class="home-heading">{{ __('Klien Kami') }}</h2>
        <p class="home-subheading">{{ __('Berikut adalah perusahaan maupun instansi yang pernah bekerjasama dengan kami') }}</p>
      </header>

      <div class="client-board mt-8">
        <button type="button" aria-label="{{ __('Sebelumnya') }}" class="client-arrow">&lt;</button>
        <div class="client-grid">
          @foreach ($clients as $client)
            <figure class="client-badge">
              <div class="client-badge-shape">{{ $client['abbr'] }}</div>
              <figcaption>{{ $client['name'] }}</figcaption>
            </figure>
          @endforeach
        </div>
        <button type="button" aria-label="{{ __('Berikutnya') }}" class="client-arrow">&gt;</button>
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

      if (!tabs.length || !image || !title || !summary || !link) return;

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

        summary.innerHTML = nextSummary
          .map((paragraph) => `<p>${paragraph}</p>`)
          .join('');
      }

      tabs.forEach((tab) => {
        tab.addEventListener('click', function () {
          renderFromTab(this);
        });
      });
    })();
  </script>
@endsection
