@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
  @include('components.hero')

  @php
    $services = [
        [
            'title' => 'E-PROCUREMENT',
            'description' => 'Aplikasi untuk pengelolaan manajemen & administrasi pengadaan barang/jasa secara elektronik di perusahaan.',
            'image' => asset('assets/images/E-Procurement.png'),
            'icon' => 'PC',
        ],
        [
            'title' => 'ERP BUSINESS SYSTEM',
            'description' => 'Aplikasi untuk membantu perusahaan mengelola manajemen keuangan, gudang, dan inventaris, pembelian penjualan, dan manufaktur.',
            'image' => asset('assets/images/erp-business-system.png'),
            'icon' => 'BS',
        ],
        [
            'title' => 'IT CONSULTANT',
            'description' => 'Kami menawarkan solusi terintegrasi lengkap untuk konsultasi, perancangan, penerapan dan pemeliharaan produk untuk perusahaan.',
            'image' => asset('assets/images/it-consultant.png'),
            'icon' => 'IT',
        ],
        [
            'title' => 'E-GOVERMENT & SMART CITY',
            'description' => 'Penerapan pemanfaatan teknologi informasi yang mengikat hubungan antara pemerintah dengan pihak lain.',
            'image' => asset('assets/images/e-government.png'),
            'icon' => 'EG',
        ],
    ];

    $products = [
        [
            'tab' => 'Tendering',
            'tab_mobile' => 'Tendering',
            'title' => 'TENDERING',
            'image' => asset('assets/images/E-Procurement.png'),
            'summary' => [
                'Modul untuk menjalankan proses pengadaan dengan tender maupun penunjukan langsung. Paket pekerjaan berasal dari modul procurement planning.',
                'Proses meliputi persiapan tender (menentukan metode tender, petugas yang terlibat, jadwal, dan mengundang vendor), tender dijalankan meliputi pengumuman, aanwijzing, pemasukan penawaran, pembukaan dan evaluasi hingga penetapan pemenang dan penunjukan vendor.',
                'Dilengkapi dengan sistem penyandian atau enkripsi dokumen penawaran untuk keamanan informasi.',
            ],
            'link' => '#',
        ],
        [
            'tab' => 'HRIS/HRMS',
            'tab_mobile' => 'HRIS/HRMS',
            'title' => 'HRIS / HRMS',
            'image' => asset('assets/images/latar-belakang-divisi.png'),
            'summary' => [
                'Sistem manajemen SDM terintegrasi untuk administrasi personalia, absensi, cuti, payroll, hingga evaluasi kinerja.',
                'Mempermudah departemen HR menjalankan workflow berbasis data dan menyiapkan laporan operasional secara real-time.',
            ],
            'link' => '#',
        ],
        [
            'tab' => 'Procurement Planning',
            'tab_mobile' => "Procurement\nPlanning",
            'title' => 'PROCUREMENT PLANNING',
            'image' => asset('assets/images/E-Procurement.png'),
            'summary' => [
                'Modul perencanaan kebutuhan pengadaan untuk menyusun daftar paket pekerjaan, anggaran, serta target waktu pelaksanaan.',
                'Seluruh data perencanaan menjadi sumber utama sebelum proses tender maupun pembelian langsung dijalankan.',
            ],
            'link' => '#',
        ],
        [
            'tab' => 'eGovernment',
            'tab_mobile' => 'eGovernment',
            'title' => 'E-GOVERNMENT',
            'image' => asset('assets/images/e-government.png'),
            'summary' => [
                'Solusi digital pemerintahan untuk mempercepat pelayanan publik dan meningkatkan transparansi pengelolaan data.',
                'Dapat mencakup layanan perizinan, pengaduan, dashboard kinerja, hingga integrasi lintas perangkat daerah.',
            ],
            'link' => '#',
        ],
        [
            'tab' => 'Insight Gov',
            'tab_mobile' => 'Insight Gov',
            'title' => 'INSIGHT GOV',
            'image' => asset('assets/images/e-government.png'),
            'summary' => [
                'Dashboard analitik pemerintahan untuk membantu pimpinan memantau KPI, tren pelayanan, dan performa organisasi.',
                'Visualisasi data disusun agar mudah dipahami untuk mendukung pengambilan keputusan yang cepat dan tepat.',
            ],
            'link' => '#',
        ],
    ];

    $clients = [
        ['name' => 'Kab. Blitar', 'abbr' => 'BL'],
        ['name' => 'Prov. Sulut', 'abbr' => 'SL'],
        ['name' => 'Polda', 'abbr' => 'PD'],
        ['name' => 'TNI AL', 'abbr' => 'AL'],
        ['name' => 'Surabaya', 'abbr' => 'SB'],
        ['name' => 'Sulsel', 'abbr' => 'SS'],
        ['name' => 'Jatim', 'abbr' => 'JT'],
        ['name' => 'Lumajang', 'abbr' => 'LM'],
        ['name' => 'Sidoarjo', 'abbr' => 'SD'],
        ['name' => 'Madura', 'abbr' => 'MD'],
        ['name' => 'Bali', 'abbr' => 'BLI'],
        ['name' => 'Banyuwangi', 'abbr' => 'BW'],
        ['name' => 'Jember', 'abbr' => 'JB'],
        ['name' => 'Bondowoso', 'abbr' => 'BD'],
    ];
  @endphp

  <section class="home-section home-about bg-[#ECEFF4] pt-14 md:pt-16 pb-14 md:pb-16">
    <div class="mx-auto w-[92%] max-w-[1200px]">
      <div class="grid items-center gap-10 lg:grid-cols-[1.1fr_1fr]">
        <div class="relative mx-auto w-full max-w-[520px]">
          <div class="about-image-blob">
            <img
              src="{{ asset('assets/images/tentang-kami.png') }}"
              alt="Tim Piramida Teknologi Informasi"
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
              <h3>Profesional</h3>
              <p>Pekerjaan dilakukan sesuai dengan standar demi penyediaan kualitas produk yang kompetitif.</p>
            </div>
          </article>

          <article class="pti-item">
            <div class="pti-letter">T</div>
            <div>
              <h3>Tim</h3>
              <p>Bekerja secara tim demi pelayanan yang terbaik bagi pelanggan dengan penuh semangat dan komitmen.</p>
            </div>
          </article>

          <article class="pti-item">
            <div class="pti-letter">I</div>
            <div>
              <h3>Inovatif</h3>
              <p>Kemampuan dan pengetahuan saja tidak cukup, melainkan inovasi juga dibutuhkan untuk menyediakan solusi digital yang terbaik.</p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section class="home-section bg-[#ECEFF4] pb-16 md:pb-20">
    <div class="mx-auto w-[92%] max-w-[1200px]">
      <header class="text-center">
        <h2 class="home-heading">Layanan</h2>
        <p class="home-subheading">Kami memberikan rangkaian layanan terbaik untuk mengatasi semua tantangan transformasi digital</p>
      </header>

      <div class="mt-9 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($services as $service)
          <article class="service-card">
            <div class="service-image-wrap">
              <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}">
            </div>
            <div class="service-icon">{{ $service['icon'] }}</div>
            <div class="service-body">
              <h3>{{ $service['title'] }}</h3>
              <p>{{ $service['description'] }}</p>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </section>

  <section class="home-section bg-[#ECEFF4] pb-16 md:pb-20">
    <div class="mx-auto w-[92%] max-w-[1200px]" id="homeProductShowcase" data-product-count="{{ count($products) }}">
      <header class="text-center">
        <h2 class="home-heading">Produk Unggulan Kami</h2>
        <p class="home-subheading">Kami menawarkan beberapa produk untuk bisnis anda dengan berbagai pilihan</p>
      </header>

      <article class="product-featured-card mt-9">
        <div class="product-featured-image-wrap">
          <img
            src="{{ $products[0]['image'] }}"
            alt="{{ $products[0]['title'] }}"
            data-product-image
          >
        </div>
        <div class="product-featured-content">
          <div class="product-featured-title-bar">
            <h3 data-product-title>{{ $products[0]['title'] }}</h3>
          </div>

          <div class="space-y-3 text-[14px] leading-relaxed text-[#525B6C]" data-product-summary>
            @foreach ($products[0]['summary'] as $paragraph)
              <p>{{ $paragraph }}</p>
            @endforeach
          </div>

          <a href="{{ $products[0]['link'] }}" class="product-detail-link" data-product-link>Lihat Detail</a>
        </div>
      </article>

      <div class="product-tabs mt-7">
        @foreach ($products as $index => $product)
          <button
            type="button"
            class="product-tab {{ $index === 0 ? 'is-active' : '' }}"
            data-product-tab="{{ $index }}"
            data-product-title="{{ $product['title'] }}"
            data-product-image="{{ $product['image'] }}"
            data-product-link="{{ $product['link'] }}"
            data-product-summary='@json($product['summary'])'
          >
            <img src="{{ $product['image'] }}" alt="{{ $product['tab'] }}">
            <span>{!! nl2br(e($product['tab_mobile'])) !!}</span>
          </button>
        @endforeach
      </div>
    </div>
  </section>

  <section class="home-section bg-[#ECEFF4] pb-16 md:pb-20">
    <div class="mx-auto w-[92%] max-w-[1200px]">
      <header class="text-center">
        <h2 class="home-heading">Klien Kami</h2>
        <p class="home-subheading">Berikut adalah perusahaan maupun instansi yang pernah bekerjasama dengan kami</p>
      </header>

      <div class="client-board mt-8">
        <button type="button" aria-label="Sebelumnya" class="client-arrow">&lt;</button>
        <div class="client-grid">
          @foreach ($clients as $client)
            <figure class="client-badge">
              <div class="client-badge-shape">{{ $client['abbr'] }}</div>
              <figcaption>{{ $client['name'] }}</figcaption>
            </figure>
          @endforeach
        </div>
        <button type="button" aria-label="Berikutnya" class="client-arrow">&gt;</button>
      </div>
    </div>
  </section>

  <style>
    .home-section .home-heading {
      margin: 0;
      color: #2563eb;
      font-size: clamp(2rem, 2.6vw, 2.9rem);
      font-weight: 700;
      line-height: 1.1;
      letter-spacing: -0.02em;
    }

    .home-section .home-subheading {
      margin: 0.65rem auto 0;
      max-width: 780px;
      color: #677083;
      font-size: clamp(0.98rem, 1.32vw, 1.25rem);
      line-height: 1.65;
    }

    .home-about .about-image-blob {
      position: relative;
      border: 2px solid #2d6df0;
      border-radius: 42% 58% 52% 48% / 48% 38% 62% 52%;
      background: #d9e5ff;
      padding: 18px;
      overflow: hidden;
      box-shadow: 0 20px 45px rgba(13, 45, 120, 0.14);
    }

    .home-about .about-image {
      width: 100%;
      height: 100%;
      min-height: 365px;
      object-fit: cover;
      border-radius: 36% 64% 48% 52% / 46% 34% 66% 54%;
      display: block;
    }

    .home-about .about-left-accent {
      position: absolute;
      left: -16px;
      bottom: 28px;
      width: 52px;
      height: 110px;
      background: #2d6df0;
      border-radius: 78% 22% 56% 44% / 54% 54% 46% 46%;
      transform: rotate(-12deg);
      box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
    }

    .home-about .about-pti-badge {
      position: absolute;
      right: 26px;
      top: 56px;
      width: 108px;
      height: 108px;
      border-radius: 999px;
      border: 10px solid #5f9cf6;
      background: #e8f0ff;
      color: #2c63df;
      display: grid;
      place-items: center;
      font-size: 3rem;
      font-weight: 700;
      letter-spacing: 0.02em;
      box-shadow: 0 10px 24px rgba(22, 86, 212, 0.2);
    }

    .home-about .pti-item {
      display: grid;
      grid-template-columns: 70px minmax(0, 1fr);
      gap: 16px;
      align-items: flex-start;
    }

    .home-about .pti-letter {
      width: 56px;
      height: 56px;
      border-radius: 999px;
      border: 6px solid #5f9cf6;
      background: #e8f0ff;
      color: #2d65e2;
      display: grid;
      place-items: center;
      font-size: 2rem;
      font-weight: 700;
    }

    .home-about .pti-item h3 {
      margin: 0 0 0.35rem;
      font-size: clamp(1.35rem, 1.8vw, 2rem);
      line-height: 1.2;
      font-weight: 700;
      color: #0f172a;
    }

    .home-about .pti-item p {
      margin: 0;
      font-size: clamp(1rem, 1.16vw, 1.16rem);
      line-height: 1.75;
      color: #111827;
      max-width: 520px;
    }

    .service-card {
      position: relative;
      border-radius: 14px;
      border: 1px solid #d8deea;
      background: #fff;
      box-shadow: 0 8px 20px rgba(37, 52, 87, 0.08);
      overflow: hidden;
      min-height: 384px;
      display: flex;
      flex-direction: column;
    }

    .service-card .service-image-wrap {
      height: 164px;
      overflow: hidden;
    }

    .service-card .service-image-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .service-card .service-icon {
      position: absolute;
      top: 142px;
      left: 14px;
      width: 44px;
      height: 44px;
      border-radius: 8px;
      background: #2563eb;
      color: #fff;
      display: grid;
      place-items: center;
      font-size: 1.15rem;
      box-shadow: 0 6px 14px rgba(37, 99, 235, 0.35);
    }

    .service-card .service-body {
      padding: 2rem 1rem 1.05rem;
    }

    .service-card h3 {
      margin: 0;
      color: #111827;
      font-size: 1.06rem;
      font-weight: 700;
      line-height: 1.35;
      letter-spacing: 0.01em;
    }

    .service-card p {
      margin: 0.75rem 0 0;
      color: #4b5563;
      font-size: 0.91rem;
      line-height: 1.56;
    }

    .product-featured-card {
      display: grid;
      grid-template-columns: 1fr;
      border-radius: 14px;
      background: #fff;
      border: 1px solid #d6dceb;
      overflow: hidden;
      box-shadow: 0 10px 24px rgba(24, 38, 73, 0.12);
    }

    .product-featured-image-wrap {
      border-bottom: 1px solid #dae0ed;
      background: #f8fafe;
    }

    .product-featured-image-wrap img {
      width: 100%;
      height: 100%;
      min-height: 286px;
      max-height: 360px;
      object-fit: cover;
      display: block;
    }

    .product-featured-content {
      padding: 0 1.25rem 1.35rem;
    }

    .product-featured-title-bar {
      background: #2563eb;
      margin: 0 -1.25rem 1rem;
      padding: 0.65rem 1.25rem;
    }

    .product-featured-title-bar h3 {
      margin: 0;
      color: #fff;
      font-size: clamp(1.8rem, 2.1vw, 2.3rem);
      line-height: 1.15;
      font-weight: 700;
      letter-spacing: 0.02em;
    }

    .product-detail-link {
      margin-top: 0.8rem;
      display: inline-block;
      color: #2563eb;
      font-size: 0.94rem;
      text-decoration: none;
    }

    .product-detail-link:hover {
      text-decoration: underline;
    }

    .product-tabs {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 0.7rem;
    }

    .product-tab {
      border: 1px solid #d4dcea;
      border-radius: 12px;
      background: #fff;
      color: #2563eb;
      min-height: 124px;
      padding: 0.7rem 0.7rem 0.9rem;
      transition: all 220ms ease;
      box-shadow: 0 6px 15px rgba(33, 45, 74, 0.06);
    }

    .product-tab img {
      width: 100%;
      height: 66px;
      object-fit: cover;
      border-radius: 8px;
      display: block;
    }

    .product-tab span {
      display: block;
      margin-top: 0.65rem;
      font-size: 1.08rem;
      line-height: 1.06;
      font-weight: 500;
      white-space: pre-line;
    }

    .product-tab.is-active {
      background: #2563eb;
      color: #fff;
      box-shadow: 0 10px 22px rgba(37, 99, 235, 0.35);
    }

    .product-tab.is-active img {
      border: 1px solid rgba(255, 255, 255, 0.35);
    }

    .client-board {
      display: grid;
      grid-template-columns: 38px minmax(0, 1fr) 38px;
      align-items: center;
      gap: 0.25rem;
      background: #fff;
      border-radius: 12px;
      border: 1px solid #d7deed;
      padding: 0.7rem;
      box-shadow: 0 8px 22px rgba(25, 40, 73, 0.08);
    }

    .client-arrow {
      border: 0;
      background: transparent;
      color: #2563eb;
      font-size: 1.7rem;
      line-height: 1;
      cursor: default;
      opacity: 0.95;
    }

    .client-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 0.7rem 0.75rem;
      justify-items: center;
    }

    .client-badge {
      margin: 0;
      text-align: center;
      width: 100%;
      max-width: 90px;
    }

    .client-badge-shape {
      width: 70px;
      height: 74px;
      margin: 0 auto;
      clip-path: polygon(50% 0%, 91% 20%, 91% 69%, 50% 100%, 9% 69%, 9% 20%);
      border: 3px solid rgba(255, 255, 255, 0.85);
      box-shadow: inset 0 0 0 2px rgba(22, 27, 45, 0.18);
      display: grid;
      place-items: center;
      color: #fff;
      font-size: 0.85rem;
      font-weight: 700;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.35);
      background: linear-gradient(150deg, #1554d4, #57a5ff 55%, #23c6f1);
    }

    .client-badge:nth-child(3n) .client-badge-shape {
      background: linear-gradient(150deg, #0f8f4a, #66cf5b 60%, #d4e553);
    }

    .client-badge:nth-child(4n) .client-badge-shape {
      background: linear-gradient(150deg, #d93c2f, #f17d45 58%, #f2d95d);
    }

    .client-badge:nth-child(5n) .client-badge-shape {
      background: linear-gradient(150deg, #8b2ee5, #4f7eff 60%, #31d7ff);
    }

    .client-badge figcaption {
      margin-top: 0.35rem;
      font-size: 0.63rem;
      line-height: 1.2;
      color: #475569;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    @media (min-width: 760px) {
      .product-featured-card {
        grid-template-columns: minmax(0, 48%) minmax(0, 52%);
      }

      .product-featured-image-wrap {
        border-right: 1px solid #dae0ed;
        border-bottom: 0;
      }

      .product-featured-image-wrap img {
        min-height: 332px;
        max-height: 405px;
      }

      .product-tabs {
        grid-template-columns: repeat(5, minmax(0, 1fr));
      }

      .client-grid {
        grid-template-columns: repeat(7, minmax(0, 1fr));
      }
    }

    @media (max-width: 1024px) {
      .home-about .about-image {
        min-height: 320px;
      }

      .home-about .about-pti-badge {
        width: 88px;
        height: 88px;
        font-size: 2.3rem;
        border-width: 8px;
      }
    }

    @media (max-width: 600px) {
      .home-about .pti-item {
        grid-template-columns: 56px minmax(0, 1fr);
      }

      .home-about .pti-letter {
        width: 48px;
        height: 48px;
        border-width: 5px;
        font-size: 1.55rem;
      }

      .client-board {
        grid-template-columns: 24px minmax(0, 1fr) 24px;
        padding: 0.55rem 0.45rem;
      }

      .client-arrow {
        font-size: 1.25rem;
      }
    }
  </style>

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
