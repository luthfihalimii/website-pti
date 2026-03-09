@extends('layouts.app')

@section('title', __('Layanan') . ' - Piramidasoft')
@section('meta_description', __('Layanan Piramidasoft mencakup e-procurement, IT consultant, business system, serta e-government dan smart city untuk kebutuhan transformasi digital organisasi.'))

@section('content')
{{-- Hero Section --}}
<section class="relative w-full h-[253px] absolute inset-0 bg-blue-600/55">
  <img 
    src="{{ asset('assets/images/hero-pages.png') }}" 
    alt="{{ __('Hero Background') }}" 
    class="absolute inset-0 w-full h-full object-cover -z-10"
  >
  
  <div class="relative max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
    <h1 class="text-4xl sm:text-5xl lg:text-[68px] font-bold text-shadow-lg mb-4">
      {{ __('Layanan') }}
    </h1>
    
    <div class="flex items-center gap-2 text-base sm:text-lg lg:text-[21px] font-semibold">
      <span>{{ __('Home') }}</span>
      <div class="w-3 h-[3px] bg-white"></div>
      <span>{{ __('Layanan') }}</span>
    </div>
  </div>
</section>

{{-- Tab Navigation --}}
<div class="bg-white border-b border-[#DBDBDB] z-40" data-services-tabs>
  <div class="max-w-6xl mx-auto px-6">
    <div class="flex gap-8 overflow-x-auto">
      <button 
        id="tab-eprocurement"
        type="button"
        data-services-tab="eprocurement"
        aria-controls="content-eprocurement"
        aria-selected="false"
        class="services-tab-button py-4 px-2 text-sm md:text-base font-medium border-b-2 border-transparent hover:text-blue-600 transition-colors whitespace-nowrap"
      >
        {{ __('E-Procurement') }}
      </button>
      <button 
        id="tab-itconsultant"
        type="button"
        data-services-tab="itconsultant"
        aria-controls="content-itconsultant"
        aria-selected="false"
        class="services-tab-button py-4 px-2 text-sm md:text-base font-medium border-b-2 border-transparent hover:text-blue-600 transition-colors whitespace-nowrap"
      >
        {{ __('IT Consultant') }}
      </button>
      <button 
        id="tab-business"
        type="button"
        data-services-tab="business"
        aria-controls="content-business"
        aria-selected="false"
        class="services-tab-button py-4 px-2 text-sm md:text-base font-medium border-b-2 border-transparent hover:text-blue-600 transition-colors whitespace-nowrap"
      >
        {{ __('Business System') }}
      </button>
      <button 
        id="tab-egovernment"
        type="button"
        data-services-tab="egovernment"
        aria-controls="content-egovernment"
        aria-selected="false"
        class="services-tab-button py-4 px-2 text-sm md:text-base font-medium border-b-2 border-transparent hover:text-blue-600 transition-colors whitespace-nowrap"
      >
        {{ __('E-Government & Smart City') }}
      </button>
    </div>
  </div>
</div>

{{-- Content Container --}}
<div class="max-w-6xl mx-auto px-6 py-12">
  <div class="relative overflow-hidden">
    
    {{-- E-Procurement Content --}}
    <div id="content-eprocurement" data-services-panel="eprocurement" class="services-tab-panel">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <div class="space-y-6">
          <div class="flex items-center gap-3">
            <div class="w-12 h-1 bg-blue-600"></div>
            <span class="text-blue-600 font-semibold">{{ __('E-Procurement') }}</span>
          </div>
          
          <h2 class="text-3xl md:text-4xl font-bold text-slate-950">
            One Stop Solution for your E-Procurement Needs
          </h2>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            {{ __('Rangkaian aplikasi/software untuk membantu mengelola proses pengadaan barang/jasa perusahaan secara menyeluruh sehingga efektif, efisien, memudahkan, merapikan dan membantu mencapai target manajemen pengadaan.') }}
          </p>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            {{ __('Proses pengadaan mulai dari : persiapan, pelaksanaan pengadaan, PO, hingga serah terima barang. Sistem yang mendukung interaksi langsung supplier (Supplier Relationship Management System). Sistem yang dapat dikastemisasi secara penuh untuk memenuhi proses spesifik dalam perusahaan.') }}
          </p>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            {{ __('Sistem eProcurement biasanya diintegrasikan dengan system Enterprise Resource Planning (ERP) atau Enterprise Asset Management (EAM) perusahaan. Lingkup Eprocurement System adalah Vendor Management System, Tendering, Catalog & Purchase, Contract Management.') }}
          </p>
          
          <div class="space-y-3">
            <h3 class="font-semibold text-slate-950">{{ __('Kategori Produk Terkait:') }}</h3>
            <div class="flex flex-wrap gap-2">
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">{{ __('E-Procurement System/Supply Chain') }}</span>
            </div>
          </div>
        </div>
        
        <div class="flex justify-center">
          <img 
            src="{{ asset('assets/images/E-Procurement.png') }}" 
            alt="{{ __('E-Procurement') }}" 
            class="w-full max-w-md rounded-xl shadow-lg"
          >
        </div>
      </div>
    </div>

    {{-- IT Consultant Content --}}
    <div id="content-itconsultant" data-services-panel="itconsultant" class="services-tab-panel hidden">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <div class="space-y-6">
          <div class="flex items-center gap-3">
            <div class="w-12 h-1 bg-blue-600"></div>
            <span class="text-blue-600 font-semibold">{{ __('IT Consultant') }}</span>
          </div>
          
          <h2 class="text-3xl md:text-4xl font-bold text-slate-950">
            Professional IT Consulting Services
          </h2>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            {{ __('Kami menyediakan jasa konsultansi dalam Teknologi Informasi antara lain :') }}
          </p>
          
        <div class="text-[15px] text-[#5e5b5b] leading-relaxed">
            <ul class="list-disc pl-5">
                <li>{{ __('Information Security Management System - ISO 27001') }}</li>
                <li>{{ __('Analisa Kebutuhan dan Desain Data Center') }}</li>
                <li>{{ __('Master Plan / Grand Design Teknologi dan Sistem Informasi') }}</li>
                <li>{{ __('Desain Integrasi Data') }}</li>
                <li>{{ __('Security Penetration Testing') }}</li>
                <li>{{ __('PostgreSQL Premium Maintenance Support') }}</li>
            </ul>
        </div>  
        </div>
        
        <div class="flex justify-center">
          <img 
            src="{{ asset('assets/images/IT Consultant.png') }}" 
            alt="{{ __('IT Consultant') }}" 
            class="w-full max-w-md rounded-xl shadow-lg"
          >
        </div>
      </div>
    </div>

    {{-- Business System Content --}}
    <div id="content-business" data-services-panel="business" class="services-tab-panel hidden">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <div class="space-y-6">
          <div class="flex items-center gap-3">
            <div class="w-12 h-1 bg-blue-600"></div>
            <span class="text-blue-600 font-semibold">{{ __('Business System') }}</span>
          </div>
          
          <h2 class="text-3xl md:text-4xl font-bold text-slate-950">
            Integrated Business Management System
          </h2>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            {{ __('Sistem bisnis terintegrasi yang dirancang untuk mengoptimalkan operasional perusahaan Anda. Dari manajemen keuangan, inventory, hingga HR, semua dalam satu platform.') }}
          </p>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            {{ __('Dengan dashboard analytics yang powerful dan reporting yang komprehensif, Anda dapat membuat keputusan bisnis yang lebih baik berdasarkan data real-time.') }}
          </p>
          
            <div class="space-y-3">
                <h3 class="font-semibold text-slate-950">{{ __('Kategori Produk Terkait:') }}</h3>
                <div class="flex flex-wrap gap-2">
                <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">{{ __('Human Resource / Kepegawaian') }}</span>
                <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">{{ __('Safety Management') }}</span>
                <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">{{ __('Marketplace') }}</span>
                </div> 
          </div>
        </div>
        
        <div class="flex justify-center">
          <img 
            src="{{ asset('assets/images/ERP _ Bussines System.png') }}" 
            alt="{{ __('Business System') }}" 
            class="w-full max-w-md rounded-xl shadow-lg"
          >
        </div>
      </div>
    </div>

    {{-- E-Government Content --}}
    <div id="content-egovernment" data-services-panel="egovernment" class="services-tab-panel hidden">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <div class="space-y-6">
          <div class="flex items-center gap-3">
            <div class="w-12 h-1 bg-blue-600"></div>
            <span class="text-blue-600 font-semibold">{{ __('E-Government & Smart City') }}</span>
          </div>
          
          <h2 class="text-3xl md:text-4xl font-bold text-slate-950">
            Smart Solutions for Modern Government
          </h2>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            {{ __('Solusi e-Government dan Smart City yang membantu pemerintah daerah dalam memberikan pelayanan publik yang lebih baik, transparan, dan efisien kepada masyarakat.') }}
          </p>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            {{ __('Dari sistem perizinan online, manajemen aset daerah, hingga smart city dashboard, kami menyediakan platform terintegrasi untuk mendukung transformasi digital pemerintahan.') }}
          </p>
          
          <div class="space-y-3">
            <h3 class="font-semibold text-slate-950">{{ __('Kategori Produk Terkait:') }}</h3>
            <div class="flex flex-wrap gap-2">
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">{{ __('Virtual Tour 360 Degree') }}</span>
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">{{ __('Human Resource / Kepegawaian') }}</span>
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">{{ __('Pengadaan Barang Jasa (Gov)') }}</span>
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">{{ __('Penanaman Modal dan Perijinan (Gov)') }}</span>
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">{{ __('Pajak Daerah (Gov)') }}</span>
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">{{ __('Parkir (Gov)') }}</span>
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">{{ __('Insight (Gov)') }}</span>
            </div>
          </div>
        </div>
        
        <div class="flex justify-center">
          <img 
            src="{{ asset('assets/images/E-Government .png') }}" 
            alt="{{ __('E-Government') }}" 
            class="w-full max-w-md rounded-xl shadow-lg"
          >
        </div>
      </div>
    </div>

  </div>
</div>

@endsection
