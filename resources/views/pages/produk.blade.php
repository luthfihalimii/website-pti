@extends('layouts.app')

@section('title', 'Produk - Piramidasoft')

@section('content')
  @php
    $products = [
        [
            'name' => 'HRIS/HRMS',
            'description' => 'Aplikasi perusahaan yang dibuat untuk mengelola informasi sumber daya manusia perusahaan.',
            'image' => asset('assets/images/latar-belakang-divisi.png'),
            'category' => 'Business System',
            'category_key' => 'business-system',
            'url' => '#',
        ],
        [
            'name' => 'Presensi / Time Attendance',
            'description' => 'Aplikasi presensi yang mudah, cepat, dan akurat untuk berbagai perusahaan serta instansi pemerintah.',
            'image' => asset('assets/images/E-Procurement.png'),
            'category' => 'Business System',
            'category_key' => 'business-system',
            'url' => '#',
        ],
        [
            'name' => 'Virtual Tour',
            'description' => 'Aplikasi interaktif berbasis 360° untuk menampilkan simulasi lokasi secara nyata guna mendukung penyampaian informasi dan promosi tanpa kunjungan langsung.',
            'image' => asset('assets/images/hero-pages.png'),
            'category' => 'E-Government & Smart City',
            'category_key' => 'e-government-smart-city',
            'url' => '#',
        ],
        [
            'name' => 'Aplikasi Potensi dan Peluang Investasi',
            'description' => 'Aplikasi penyedia informasi potensi dan peluang investasi yang menyajikan prospektus secara lengkap dan terbaru serta mendukung komunikasi antara investor dan pemangku kepentingan.',
            'image' => asset('assets/images/e-government.png'),
            'category' => 'E-Government & Smart City',
            'category_key' => 'e-government-smart-city',
            'url' => '#',
        ],
        [
            'name' => 'Aplikasi Pengadaan Unit Pelayanan',
            'description' => 'Aplikasi sistem informasi pengadaan yang mempermudah proses lelang dan administrasi barang maupun jasa secara efisien dan terdokumentasi.',
            'image' => asset('assets/images/it-support.png'),
            'category' => 'E-Procurement',
            'category_key' => 'e-procurement',
            'url' => '#',
        ],
        [
            'name' => 'Contractor Safety Management System (CSMS)',
            'description' => 'Aplikasi pengelolaan keselamatan kerja kontraktor untuk memastikan kepatuhan terhadap standar K3 perusahaan dan mendukung lingkungan kerja yang aman.',
            'image' => asset('assets/images/erp-business-system.png'),
            'category' => 'Business System',
            'category_key' => 'business-system',
            'url' => '#',
        ],
        [
            'name' => 'Rusunawa - Billing',
            'description' => 'Aplikasi pengelolaan penghuni dan penagihan sewa Rusunawa yang terintegrasi untuk mendukung proses administrasi dan pelaporan secara efektif.',
            'image' => asset('assets/images/about-me.png'),
            'category' => 'E-Government & Smart City',
            'category_key' => 'e-government-smart-city',
            'url' => '#',
        ],
        [
            'name' => 'Aplikasi Geographical Information System (APGIS)',
            'description' => 'Aplikasi sistem informasi geografis yang mengelola dan menyajikan data spasial secara terintegrasi guna mendukung perencanaan dan pengambilan keputusan.',
            'image' => asset('assets/images/e-government.png'),
            'category' => 'E-Government & Smart City',
            'category_key' => 'e-government-smart-city',
            'url' => '#',
        ],
        [
            'name' => 'Business Intelligence (BI)',
            'description' => 'Aplikasi pengolahan dan penyajian data terintegrasi yang membantu perusahaan memonitor kinerja, menganalisis informasi strategis, dan mendukung pengambilan keputusan secara lebih efektif.',
            'image' => asset('assets/images/pti.png'),
            'category' => 'Business System',
            'category_key' => 'business-system',
            'url' => '#',
        ],
        [
            'name' => 'Data Management and Dashboard (e-Government)',
            'description' => 'Aplikasi pengelolaan dan integrasi data terstruktur yang dilengkapi dashboard visual untuk mendukung monitoring kinerja, pelaporan, dan pengambilan keputusan di lingkungan pemerintahan.',
            'image' => asset('assets/images/e-government.png'),
            'category' => 'E-Government & Smart City',
            'category_key' => 'e-government-smart-city',
            'url' => '#',
        ],
        [
            'name' => 'Tendering',
            'description' => 'Aplikasi pengelolaan proses pengadaan melalui tender maupun penunjukan langsung yang mendukung seluruh tahapan seleksi vendor secara online, aman, dan terdokumentasi.',
            'image' => asset('assets/images/E-Procurement.png'),
            'category' => 'E-Procurement',
            'category_key' => 'e-procurement',
            'url' => '#',
        ],
        [
            'name' => 'Purchasing',
            'description' => 'Aplikasi pengelolaan pembelian melalui katalog produk yang memudahkan proses pemesanan, negosiasi, hingga penerbitan draft Purchase Order secara terintegrasi.',
            'image' => asset('assets/images/E-Procurement.png'),
            'category' => 'E-Procurement',
            'category_key' => 'e-procurement',
            'url' => '#',
        ],
        [
            'name' => 'Procurement Planning',
            'description' => 'Aplikasi perencanaan pengadaan yang mengelola penyusunan paket pekerjaan, rincian anggaran, jadwal pelaksanaan, dan proses persetujuan secara terstruktur dan terintegrasi.',
            'image' => asset('assets/images/E-Procurement.png'),
            'category' => 'E-Procurement',
            'category_key' => 'e-procurement',
            'url' => '#',
        ],
        [
            'name' => 'PostgreSQL Premium Maintenance Support',
            'description' => 'Aplikasi layanan pemeliharaan dan dukungan PostgreSQL yang mencakup instalasi, optimalisasi, keamanan, backup, serta pemulihan guna memastikan ketersediaan dan performa database tetap optimal.',
            'image' => asset('assets/images/it-consultant.png'),
            'category' => 'IT Consultant',
            'category_key' => 'it-consultant',
            'url' => '#',
        ],
        [
            'name' => 'Insight GOV',
            'description' => 'Aplikasi pengelolaan data terintegrasi yang menggabungkan data warehouse, business intelligence, dan open data untuk mendukung analisis, visualisasi, serta publikasi informasi secara akurat dan terkini.',
            'image' => asset('assets/images/e-government.png'),
            'category' => 'E-Government & Smart City',
            'category_key' => 'e-government-smart-city',
            'url' => '#',
        ],
    ];

    $categories = [
        ['label' => 'Business System', 'key' => 'business-system'],
        ['label' => 'E-Procurement', 'key' => 'e-procurement'],
        ['label' => 'E-Government & Smart City', 'key' => 'e-government-smart-city'],
        ['label' => 'IT Consultant', 'key' => 'it-consultant'],
    ];
  @endphp

  <section class="product-page-hero">
    <img
      src="{{ asset('assets/images/hero-pages.png') }}"
      alt="Hero Produk"
      class="product-page-hero-image"
    >
    <div class="product-page-hero-overlay"></div>
    <div class="product-page-hero-content">
      <h1>Produk</h1>
      <p>Home <span>-</span> Produk</p>
    </div>
  </section>

  <section class="product-page-catalog">
    <div class="mx-auto w-[92%] max-w-[1240px]">
      <div class="product-toolbar">
        <h2>Semua Produk</h2>

        <label for="productCategoryFilter" class="product-filter-wrap">
          <select id="productCategoryFilter" name="category">
            <option value="all">Kategori Produk</option>
            @foreach ($categories as $category)
              <option value="{{ $category['key'] }}">{{ $category['label'] }}</option>
            @endforeach
          </select>
        </label>
      </div>

      <div class="product-list" id="productList">
        @foreach ($products as $product)
          <article class="product-row-card" data-product-category="{{ $product['category_key'] }}">
            <figure class="product-row-image">
              <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
            </figure>

            <div class="product-row-content">
              <h3>{{ $product['name'] }}</h3>
              <p>{{ $product['description'] }}</p>
            </div>

            <div class="product-row-cta">
              <a href="{{ $product['url'] }}">
                <span>Detail</span>
                <span aria-hidden="true">&rarr;</span>
              </a>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </section>

  <style>
    .product-page-hero {
      position: relative;
      height: 198px;
      overflow: hidden;
      border-top: 1px solid rgba(255, 255, 255, 0.35);
    }

    .product-page-hero-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .product-page-hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, rgba(37, 99, 235, 0.52), rgba(96, 165, 250, 0.58));
      z-index: 1;
    }

    .product-page-hero-content {
      position: absolute;
      inset: 0;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #fff;
      text-align: center;
    }

    .product-page-hero-content h1 {
      margin: 0;
      font-size: clamp(2.4rem, 3.5vw, 4.25rem);
      line-height: 1;
      letter-spacing: -0.02em;
      font-weight: 700;
      text-shadow: 0 10px 28px rgba(18, 42, 107, 0.18);
    }

    .product-page-hero-content p {
      margin: 0.8rem 0 0;
      font-size: clamp(1rem, 1.2vw, 1.34rem);
      line-height: 1;
      font-weight: 500;
      text-shadow: 0 8px 18px rgba(13, 33, 88, 0.18);
    }

    .product-page-hero-content span {
      margin: 0 0.4rem;
    }

    .product-page-catalog {
      background: #ececec;
      padding: 2.5rem 0 4rem;
    }

    .product-toolbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .product-toolbar h2 {
      margin: 0;
      color: #2563eb;
      font-size: clamp(2.15rem, 2.7vw, 2.9rem);
      line-height: 1.15;
      font-weight: 700;
      letter-spacing: -0.01em;
    }

    .product-filter-wrap {
      position: relative;
      width: min(440px, 45%);
      min-width: 250px;
    }

    .product-filter-wrap::after {
      content: '▼';
      position: absolute;
      right: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      color: #111827;
      font-size: 0.9rem;
      pointer-events: none;
    }

    .product-filter-wrap select {
      width: 100%;
      height: 42px;
      border: 1px solid #bfc5d2;
      border-radius: 6px;
      background: #fff;
      font-size: 1.05rem;
      color: #111827;
      padding: 0 2.2rem 0 0.85rem;
      box-shadow: 0 4px 10px rgba(17, 24, 39, 0.08);
      appearance: none;
      -webkit-appearance: none;
    }

    .product-list {
      display: flex;
      flex-direction: column;
      gap: 1.12rem;
    }

    .product-row-card {
      display: grid;
      grid-template-columns: 162px minmax(0, 1fr) 132px;
      align-items: center;
      gap: 1.4rem;
      border: 1px solid rgba(0, 0, 0, 0.38);
      border-radius: 7px;
      background: #fff;
      padding: 0.78rem 0.82rem;
      box-shadow: 0 1px 2px rgba(15, 23, 42, 0.12);
    }

    .product-row-image {
      margin: 0;
      width: 100%;
      height: 86px;
      border-radius: 4px;
      overflow: hidden;
      background: #f3f4f6;
      border: 1px solid #dde2ed;
    }

    .product-row-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .product-row-content h3 {
      margin: 0;
      color: #111827;
      font-size: clamp(1.34rem, 1.52vw, 1.72rem);
      line-height: 1.2;
      font-weight: 600;
      letter-spacing: -0.005em;
    }

    .product-row-content p {
      margin: 0.4rem 0 0;
      color: #111827;
      font-size: clamp(0.95rem, 1.03vw, 1.12rem);
      line-height: 1.35;
      max-width: 1000px;
    }

    .product-row-cta {
      display: flex;
      justify-content: flex-end;
    }

    .product-row-cta a {
      min-width: 108px;
      height: 42px;
      border-radius: 12px;
      background: #2f6ee7;
      color: #fff;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      font-size: 1.12rem;
      font-weight: 500;
      box-shadow: 0 8px 18px rgba(47, 110, 231, 0.28);
    }

    .product-row-cta a:hover {
      background: #215fd7;
    }

    .product-row-card.is-hidden {
      display: none;
    }

    @media (max-width: 1024px) {
      .product-page-hero {
        height: 165px;
      }

      .product-page-hero-content p {
        font-size: 1.18rem;
      }

      .product-toolbar {
        flex-direction: column;
        align-items: stretch;
        gap: 0.85rem;
      }

      .product-filter-wrap {
        width: 100%;
        min-width: 0;
      }

      .product-row-card {
        grid-template-columns: 142px minmax(0, 1fr) 114px;
        gap: 1rem;
        padding: 0.66rem 0.7rem;
      }

      .product-row-content h3 {
        font-size: clamp(1.22rem, 2.45vw, 1.42rem);
      }

      .product-row-content p {
        font-size: clamp(0.88rem, 1.45vw, 1.02rem);
      }

      .product-row-cta a {
        min-width: 98px;
        height: 38px;
        font-size: 1rem;
      }
    }

    @media (max-width: 700px) {
      .product-page-catalog {
        padding-top: 1.35rem;
      }

      .product-row-card {
        grid-template-columns: 1fr;
        gap: 0.8rem;
        padding: 0.62rem;
      }

      .product-row-image {
        height: 150px;
      }

      .product-row-cta {
        justify-content: flex-start;
      }
    }
  </style>

  <script>
    (function () {
      const select = document.getElementById('productCategoryFilter');
      const cards = Array.from(document.querySelectorAll('.product-row-card'));
      if (!select || !cards.length) return;

      select.addEventListener('change', function () {
        const selected = this.value;

        cards.forEach((card) => {
          const category = card.dataset.productCategory;
          const shouldShow = selected === 'all' || category === selected;
          card.classList.toggle('is-hidden', !shouldShow);
        });
      });
    })();
  </script>
@endsection
