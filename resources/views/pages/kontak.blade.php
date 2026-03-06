@extends('layouts.app')

@section('title', __('Kontak') . ' - Piramidasoft')
@section('meta_description', __('Hubungi Piramidasoft untuk kebutuhan e-procurement, business system, e-government, smart city, dan konsultasi teknologi informasi.'))

@section('content')
{{-- Google Maps Section --}}
<section class="w-full h-[400px] bg-gray-200">
  <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.238078924867!2d112.7261522798404!3d-7.327135018557494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa452325be33%3A0xd403e0de89bd0a89!2sPT.%20Piramida%20Teknologi%20Informasi!5e0!3m2!1sid!2sid!4v1772420063463!5m2!1sid!2sid" 
    width="100%" 
    height="100%" 
    class="contact-map-frame"
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade"
    title="{{ __('Lokasi Piramida Teknologi Informasi') }}"
  ></iframe>
</section>

{{-- Contact Form & Info Section --}}
<section class="max-w-6xl mx-auto px-6 py-12">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
    
    {{-- Left: Contact Form --}}
    <div>
      <h2 class="text-2xl md:text-3xl font-bold text-slate-950 mb-4">
        {{ __('Bagaimana Kami Dapat Membantu Anda?') }}
      </h2>
      
      <p class="text-[15px] text-[#5e5b5b] mb-8 leading-relaxed">
        {{ __('Kami adalah Penyedia Solusi IT yang berfokus pada E-Procurement, Integrasi ERP, E-Government & Smart City, Konsultan IT. Menciptakan produk yang berkualitas dan sederhana untuk solusi Anda.') }}
      </p>
      
      @if (session('contact_status'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
          {{ session('contact_status') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
          <p class="font-semibold">{{ __('Periksa kembali data berikut:') }}</p>
          <ul class="mt-2 list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label for="name" class="block text-sm font-medium text-slate-950 mb-2">{{ __('Nama') }}</label>
            <input 
              type="text" 
              id="name" 
              name="name" 
              value="{{ old('name') }}"
              required
              class="w-full px-4 py-3 border border-[#DBDBDB] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
              placeholder="{{ __('Nama Anda') }}"
            >
          </div>
          
          <div>
            <label for="email" class="block text-sm font-medium text-slate-950 mb-2">{{ __('Email') }}</label>
            <input 
              type="email" 
              id="email" 
              name="email" 
              value="{{ old('email') }}"
              required
              class="w-full px-4 py-3 border border-[#DBDBDB] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
              placeholder="email@example.com"
            >
          </div>
        </div>
        
        <div>
          <label for="message" class="block text-sm font-medium text-slate-950 mb-2">{{ __('Pesan') }}</label>
          <textarea 
            id="message" 
            name="message" 
            rows="6" 
            required
            class="w-full px-4 py-3 border border-[#DBDBDB] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent resize-none"
            placeholder="{{ __('Tulis pesan Anda di sini...') }}"
          >{{ old('message') }}</textarea>
        </div>
        
        <button 
          type="submit"
          class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3 rounded-md font-medium hover:bg-blue-700 transition-colors"
        >
          {{ __('Kirim') }}
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
          </svg>
        </button>
      </form>
    </div>
    
    {{-- Right: Contact Info --}}
    <div class="space-y-8">
      
      {{-- Alamat --}}
      <div>
        <h3 class="text-xl font-bold text-blue-600 mb-4">{{ __('Alamat') }}</h3>
        <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
          {{ config('site.company.address') }}
        </p>
      </div>
      
      {{-- No. Telepon & Email --}}
      <div>
        <h3 class="text-xl font-bold text-blue-600 mb-4">{{ __('No. Telepon & Email') }}</h3>
        <div class="space-y-3 text-[15px] text-[#5e5b5b]">
          <div class="flex items-center gap-3">
            <span class="font-semibold">{{ __('Email 1:') }}</span>
            <a href="mailto:{{ config('site.company.primary_email') }}" class="hover:text-blue-600">{{ config('site.company.primary_email') }}</a>
          </div>
          <div class="flex items-center gap-3">
            <span class="font-semibold">{{ __('Email 2:') }}</span>
            <a href="mailto:{{ config('site.company.secondary_email') }}" class="hover:text-blue-600">{{ config('site.company.secondary_email') }}</a>
          </div>
          <div class="flex items-center gap-3">
            <span class="font-semibold">{{ __('Telepon:') }}</span>
            <a href="tel:03158283512" class="hover:text-blue-600">{{ config('site.company.phone') }}</a>
          </div>
          <div class="flex items-center gap-3">
            <span class="font-semibold">{{ __('Whatsapp:') }}</span>
            <a href="https://wa.me/6285954320729" class="hover:text-blue-600">{{ config('site.company.whatsapp') }}</a>
          </div>
          <div class="flex items-center gap-3">
            <span class="font-semibold">{{ __('LinkedIn:') }}</span>
            <span>{{ config('site.company.linkedin') }}</span>
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
</section>
@endsection
