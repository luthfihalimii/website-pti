@extends('layouts.app')

@section('title', 'Detail Lowongan - UI/UX Designer - Piramidasoft')

@section('content')
{{-- Hero Section --}}
<section class="relative w-full h-[253px] bg-gradient-to-r from-blue-700/95 via-blue-600/80 to-blue-500/70 overflow-hidden">
    <img
      src="{{ asset('assets/images/hero-pages.png') }}"
      alt="Hero Background"
      class="absolute inset-0 w-full h-full object-cover"
    />
    
    <div class="absolute inset-0 bg-gradient-to-r from-blue-700/95 via-blue-600/80 to-blue-500/70"></div>
    
    <div class="relative z-10 max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
      <h1 class="font-extrabold leading-none drop-shadow text-[54px] md:text-[68px]">
        Detail Kerja
      </h1>
      
      <p class="mt-3 text-[14px] md:text-[15px] font-semibold text-white/95">
        Home &nbsp;–&nbsp; Lowongan pekerjaan
      </p>
    </div>
</section>

{{-- Content Section --}}
<section class="bg-white py-12">
  <div class="max-w-6xl mx-auto px-6">
    
    {{-- Breadcrumb --}}
    <div class="mb-6">
      <a href="/lowongan" class="text-blue-600 hover:text-blue-700 text-[14px] font-medium">
        ← Lowongan pekerjaan
      </a>
    </div>

    {{-- Job Title --}}
    <h2 class="text-[28px] md:text-[32px] font-bold text-slate-950 mb-4">
        We Are Hiring Fullstack Developer - Full Time
    </h2>

    {{-- Job Description --}}
    <p class="text-[14px] text-slate-600 leading-relaxed mb-8">
      Kami mencari Fullstack Developer yang tidak hanya mampu membangun sistem yang stabil dan scalable, tetapi juga memahami kebutuhan bisnis serta mampu menerjemahkannya menjadi solusi digital yang efisien, terintegrasi, dan berdampak nyata bagi pengguna.
    </p>

    {{-- Kualifikasi Utama --}}
    <div class="mb-8">
      <h3 class="text-[20px] font-bold text-slate-950 mb-4">Kualifikasi Utama</h3>
      <ul class="space-y-2 text-[14px] text-slate-600">
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Minimal D3/S1 Teknik Informatika, Sistem Informasi, Ilmu Komputer, atau jurusan relevan.</span>
        </li>
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Minimal 3–5 tahun pengalaman sebagai Fullstack Developer</span>
        </li>
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Wajib melampirkan portofolio (website, aplikasi, sistem backend/API, atau project GitHub)</span>
        </li>
      </ul>
    </div>

    {{-- Skill yang Dibutuhkan --}}
    <div class="mb-8">
      <h3 class="text-[20px] font-bold text-slate-950 mb-4">Skill yang Dibutuhkan</h3>
      <ul class="space-y-2 text-[14px] text-slate-600">
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Mahir menggunakan teknologi frontend & backend modern (misalnya JavaScript/TypeScript, React/Vue/Next.js, Node.js, Laravel, atau sejenisnya).</span>
        </li>
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Mampu membangun RESTful API, mengelola database (MySQL/PostgreSQL/MongoDB), serta mengintegrasikan layanan pihak ketiga.</span>
        </li>
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Memahami arsitektur aplikasi, clean code, dan best practice pengembangan software.</span>
        </li>
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Terbiasa menggunakan Git dan workflow kolaboratif (GitHub/GitLab).</span>
        </li>
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Memahami konsep responsive web dan mampu mengimplementasikan UI yang optimal di berbagai device.</span>
        </li>
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Terbiasa bekerja dalam tim lintas divisi (UI/UX, QA, Product) dengan dokumentasi dan struktur kode yang rapi.</span>
        </li>
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Memahami dasar DevOps (deployment, CI/CD, server management) menjadi nilai tambah.</span>
        </li>
      </ul>
    </div>

    {{-- Range Gaji --}}
    <div class="mb-8">
      <h3 class="text-[20px] font-bold text-slate-950 mb-4">Range Gaji</h3>
      <p class="text-[14px] text-slate-600 mb-1">
        <span class="font-semibold">Rp10.000.00 - Rp15.000.000</span>
      </p>
      <p class="text-[13px] text-slate-500 italic">
        (disesuaikan dengan pengalaman dan skill)
      </p>
      <p class="text-[13px] text-slate-500 mt-2">
        Jika kandidat memiliki pengalaman lebih dari 5 tahun dengan portofolio kompleks, range dapat disesuaikan.
    </div>

    {{-- Benefit --}}
    <div class="mb-10">
      <h3 class="text-[20px] font-bold text-slate-950 mb-4">Benefit yang didapatkan</h3>
      <ul class="space-y-2 text-[14px] text-slate-600">
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Lingkungan kerja kreatif dan supportif</span>
        </li>
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Terlibat dalam project skala pemerintahan & enterprise</span>
        </li>
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Kesempatan pengembangan karir & skill improvement</span>
        </li>
        <li class="flex items-start gap-2">
          <span class="text-blue-600 mt-1">•</span>
          <span>Bonus performa (berdasarkan evaluasi kinerja)</span>
        </li>
      </ul>
    </div>

    {{-- Call to Action --}}
    <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded-r-lg mb-8">
      <h3 class="text-[18px] font-bold text-blue-600 mb-2">
        Segera daftarkan diri anda, dan Bergabunglah bersama kami dan raih karier impian Anda
      </h3>
      <p class="text-[14px] text-slate-600">
        Segera kirimkan CV terlengkapmu bersama portofolio dan satu cover letter yang 
        menjelaskan mengapa kamu cocok untuk posisi ini!
      </p>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-wrap gap-4">
      <a href="/lowongan/form" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-medium text-[14px] transition-colors inline-flex items-center gap-2">
        Lamar →
      </a>
      <a href="{{ asset('assets/images/poster-lowongan.png') }}" 
        target="_blank"
        class="bg-white hover:bg-slate-50 text-blue-600 border-2 border-blue-600 px-8 py-3 rounded-md font-medium text-[14px] transition-colors">
        Lihat Poster
      </a>
    </div>

  </div>
</section>

@endsection
