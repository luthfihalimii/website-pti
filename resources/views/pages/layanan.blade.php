@extends('layouts.app')

@section('title', 'Layanan - Piramidasoft')

@section('content')
{{-- Hero Section --}}
<section class="relative w-full h-[253px] bg-gradient-to-r from-blue-600/80 to-blue-400/80 overflow-hidden">
  <img 
    src="{{ asset('assets/images/hero-pages.png') }}" 
    alt="Hero Background" 
    class="absolute inset-0 w-full h-full object-cover -z-10"
  >
  
  <div class="relative max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
    <h1 class="text-5xl md:text-[68px] font-bold text-shadow-lg mb-4">
      Layanan
    </h1>
    
    <div class="flex items-center gap-2 text-lg md:text-[21px] font-semibold">
      <span>Home</span>
      <div class="w-3 h-[3px] bg-white"></div>
      <span>Layanan</span>
    </div>
  </div>
</section>

{{-- Tab Navigation --}}
<div class="bg-white border-b border-[#DBDBDB] sticky top-0 z-40">
  <div class="max-w-6xl mx-auto px-6">
    <div class="flex gap-8 overflow-x-auto">
      <button 
        onclick="switchTab('eprocurement')" 
        id="tab-eprocurement"
        class="tab-button py-4 px-2 text-sm md:text-base font-medium border-b-2 border-transparent hover:text-blue-600 transition-colors whitespace-nowrap"
      >
        E-Procurement
      </button>
      <button 
        onclick="switchTab('itconsultant')" 
        id="tab-itconsultant"
        class="tab-button py-4 px-2 text-sm md:text-base font-medium border-b-2 border-transparent hover:text-blue-600 transition-colors whitespace-nowrap"
      >
        IT Consultant
      </button>
      <button 
        onclick="switchTab('business')" 
        id="tab-business"
        class="tab-button py-4 px-2 text-sm md:text-base font-medium border-b-2 border-transparent hover:text-blue-600 transition-colors whitespace-nowrap"
      >
        Business System
      </button>
      <button 
        onclick="switchTab('egovernment')" 
        id="tab-egovernment"
        class="tab-button py-4 px-2 text-sm md:text-base font-medium border-b-2 border-transparent hover:text-blue-600 transition-colors whitespace-nowrap"
      >
        E-Government & Smart City
      </button>
    </div>
  </div>
</div>

{{-- Content Container --}}
<div class="max-w-6xl mx-auto px-6 py-12">
  <div class="relative overflow-hidden">
    
    {{-- E-Procurement Content --}}
    <div id="content-eprocurement" class="tab-content">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <div class="space-y-6">
          <div class="flex items-center gap-3">
            <div class="w-12 h-1 bg-blue-600"></div>
            <span class="text-blue-600 font-semibold">E-Procurement</span>
          </div>
          
          <h2 class="text-3xl md:text-4xl font-bold text-slate-950">
            One Stop Solution for your E-Procurement Needs
          </h2>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            Rangkaian aplikasi/software untuk membantu mengelola proses pengadaan barang/jasa perusahaan secara menyeluruh sehingga efektif, efisien, memudahkan, merapikan dan membantu mencapai target manajemen pengadaan.
          </p>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            Proses pengadaan mulai dari : persiapan, pelaksanaan pengadaan, PO, hingga serah terima barang. Sistem yang mendukung interaksi langsung supplier (Supplier Relationship Management System). Sistem yang dapat dikastemisasi secara penuh untuk memenuhi proses spesifik dalam perusahaan.
          </p>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            Sistem eProcurement biasanya diintegrasikan dengan system Enterprise Resource Planning (ERP) atau Enterprise Asset Management (EAM) perusahaan. Lingkup Eprocurement System adalah Vendor Management System, Tendering, Catalog & Purchase, Contract Management.
          </p>
          
          <div class="space-y-3">
            <h3 class="font-semibold text-slate-950">Kategori Produk Terkait:</h3>
            <div class="flex flex-wrap gap-2">
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">E-Procurement System/Supply Chain</span>
            </div>
          </div>
        </div>
        
        <div class="flex justify-center">
          <img 
            src="{{ asset('assets/images/E-Procurement.png') }}" 
            alt="E-Procurement" 
            class="w-full max-w-md rounded-xl shadow-lg"
          >
        </div>
      </div>
    </div>

    {{-- IT Consultant Content --}}
    <div id="content-itconsultant" class="tab-content hidden">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <div class="space-y-6">
          <div class="flex items-center gap-3">
            <div class="w-12 h-1 bg-blue-600"></div>
            <span class="text-blue-600 font-semibold">IT Consultant</span>
          </div>
          
          <h2 class="text-3xl md:text-4xl font-bold text-slate-950">
            Professional IT Consulting Services
          </h2>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            Kami menyediakan jasa konsultansi dalam Teknologi Informasi antara lain :
          </p>
          
        <div class="text-[15px] text-[#5e5b5b] leading-relaxed">
            <ul class="list-disc pl-5">
                <li>Information Security Management System - ISO 27001</li>
                <li>Analisa Kebutuhan dan Desain Data Center</li>
                <li>Master Plan / Grand Design Teknologi dan Sistem Informasi</li>
                <li>Desain Integrasi Data</li>
                <li>Security Penetration Testing</li>
                <li>PostgreSQL Premium Maintenance Support</li>
            </ul>
        </div>  
        </div>
        
        <div class="flex justify-center">
          <img 
            src="{{ asset('assets/images/IT Consultant.png') }}" 
            alt="IT Consultant" 
            class="w-full max-w-md rounded-xl shadow-lg"
          >
        </div>
      </div>
    </div>

    {{-- Business System Content --}}
    <div id="content-business" class="tab-content hidden">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <div class="space-y-6">
          <div class="flex items-center gap-3">
            <div class="w-12 h-1 bg-blue-600"></div>
            <span class="text-blue-600 font-semibold">Business System</span>
          </div>
          
          <h2 class="text-3xl md:text-4xl font-bold text-slate-950">
            Integrated Business Management System
          </h2>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            Sistem bisnis terintegrasi yang dirancang untuk mengoptimalkan operasional perusahaan Anda. Dari manajemen keuangan, inventory, hingga HR, semua dalam satu platform.
          </p>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            Dengan dashboard analytics yang powerful dan reporting yang komprehensif, Anda dapat membuat keputusan bisnis yang lebih baik berdasarkan data real-time.
          </p>
          
            <div class="space-y-3">
                <h3 class="font-semibold text-slate-950">Kategori Produk Terkait:</h3>
                <div class="flex flex-wrap gap-2">
                <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">Human Resource / Kepegawaian</span>
                <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">Safety Management</span>
                <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">Marketplace</span>
                </div> 
          </div>
        </div>
        
        <div class="flex justify-center">
          <img 
            src="{{ asset('assets/images/ERP _ Bussines System.png') }}" 
            alt="Business System" 
            class="w-full max-w-md rounded-xl shadow-lg"
          >
        </div>
      </div>
    </div>

    {{-- E-Government Content --}}
    <div id="content-egovernment" class="tab-content hidden">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <div class="space-y-6">
          <div class="flex items-center gap-3">
            <div class="w-12 h-1 bg-blue-600"></div>
            <span class="text-blue-600 font-semibold">E-Government & Smart City</span>
          </div>
          
          <h2 class="text-3xl md:text-4xl font-bold text-slate-950">
            Smart Solutions for Modern Government
          </h2>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            Solusi e-Government dan Smart City yang membantu pemerintah daerah dalam memberikan pelayanan publik yang lebih baik, transparan, dan efisien kepada masyarakat.
          </p>
          
          <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
            Dari sistem perizinan online, manajemen aset daerah, hingga smart city dashboard, kami menyediakan platform terintegrasi untuk mendukung transformasi digital pemerintahan.
          </p>
          
          <div class="space-y-3">
            <h3 class="font-semibold text-slate-950">Kategori Produk Terkait:</h3>
            <div class="flex flex-wrap gap-2">
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">Virtual Tour 360 Degree</span>
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">Human Resource / Kepegawaian</span>
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">Pengadaan Barang Jasa (Gov)</span>
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">Penanaman Modal dan Perijinan (Gov)</span>
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">Pajak Daerah (Gov)</span>
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">Parkir (Gov)</span>
              <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-md text-sm">Insight (Gov)</span>
            </div>
          </div>
        </div>
        
        <div class="flex justify-center">
          <img 
            src="{{ asset('assets/images/E-Government .png') }}" 
            alt="E-Government" 
            class="w-full max-w-md rounded-xl shadow-lg"
          >
        </div>
      </div>
    </div>

  </div>
</div>


<style>
  .tab-button.active {
    color: #2563eb;
    border-bottom-color: #2563eb;
  }
  
  .tab-content {
    animation: slideIn 0.4s ease-out;
  }
  
  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateX(30px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }
</style>

<script>
  function switchTab(tabName) {
    // Hide all content
    document.querySelectorAll('.tab-content').forEach(content => {
      content.classList.add('hidden');
    });
    
    // Remove active class from all tabs
    document.querySelectorAll('.tab-button').forEach(button => {
      button.classList.remove('active');
    });
    
    // Show selected content
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    // Add active class to selected tab
    document.getElementById('tab-' + tabName).classList.add('active');
    
    // Update URL hash without scrolling
    history.replaceState(null, null, '#' + tabName);
  }
  
  function loadTabFromHash() {
    // Check if there's a hash in URL
    const hash = window.location.hash.substring(1); // Remove the #
    const validTabs = ['eprocurement', 'itconsultant', 'business', 'egovernment'];
    
    if (hash && validTabs.includes(hash)) {
      switchTab(hash);
    } else {
      switchTab('eprocurement');
    }
  }
  
  // Set default tab on page load
  document.addEventListener('DOMContentLoaded', function() {
    loadTabFromHash();
  });
  
  // Listen for hash changes (when clicking links with #)
  window.addEventListener('hashchange', function() {
    loadTabFromHash();
  });
</script>
@endsection
