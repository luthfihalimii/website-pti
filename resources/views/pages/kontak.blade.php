@extends('layouts.app')

@section('title', 'Kontak - Piramidasoft')

@section('content')
{{-- Google Maps Section --}}
<section class="w-full h-[400px] bg-gray-200">
  <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.238078924867!2d112.7261522798404!3d-7.327135018557494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa452325be33%3A0xd403e0de89bd0a89!2sPT.%20Piramida%20Teknologi%20Informasi!5e0!3m2!1sid!2sid!4v1772420063463!5m2!1sid!2sid" 
    width="100%" 
    height="100%" 
    style="border:0;" 
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade"
    title="Lokasi Piramida Teknologi Informasi"
  ></iframe>
</section>

{{-- Contact Form & Info Section --}}
<section class="max-w-6xl mx-auto px-6 py-12">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
    
    {{-- Left: Contact Form --}}
    <div>
      <h2 class="text-2xl md:text-3xl font-bold text-slate-950 mb-4">
        Bagaimana Kami Dapat Membantu Anda?
      </h2>
      
      <p class="text-[15px] text-[#5e5b5b] mb-8 leading-relaxed">
        Kami adalah Penyedia Solusi IT yang berfokus pada E-Procurement, Integrasi ERP, E-Government & Smart City, Konsultan IT. Menciptakan produk yang berkualitas dan sederhana untuk solusi Anda.
      </p>
      
      <form action="#" method="POST" class="space-y-5">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label for="name" class="block text-sm font-medium text-slate-950 mb-2">Nama</label>
            <input 
              type="text" 
              id="name" 
              name="name" 
              required
              class="w-full px-4 py-3 border border-[#DBDBDB] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
              placeholder="Nama Anda"
            >
          </div>
          
          <div>
            <label for="email" class="block text-sm font-medium text-slate-950 mb-2">Email</label>
            <input 
              type="email" 
              id="email" 
              name="email" 
              required
              class="w-full px-4 py-3 border border-[#DBDBDB] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
              placeholder="email@example.com"
            >
          </div>
        </div>
        
        <div>
          <label for="message" class="block text-sm font-medium text-slate-950 mb-2">Pesan</label>
          <textarea 
            id="message" 
            name="message" 
            rows="6" 
            required
            class="w-full px-4 py-3 border border-[#DBDBDB] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent resize-none"
            placeholder="Tulis pesan Anda di sini..."
          ></textarea>
        </div>
        
        <button 
          type="submit"
          class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3 rounded-md font-medium hover:bg-blue-700 transition-colors"
        >
          Kirim
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
        <h3 class="text-xl font-bold text-blue-600 mb-4">Alamat</h3>
        <p class="text-[15px] text-[#5e5b5b] leading-relaxed">
          Jl. Gayung Kebonsari Timur 29, Ketintang, Kec. Gayungan, Surabaya, Indonesia
        </p>
      </div>
      
      {{-- No. Telepon & Email --}}
      <div>
        <h3 class="text-xl font-bold text-blue-600 mb-4">No. Telepon & Email</h3>
        <div class="space-y-3 text-[15px] text-[#5e5b5b]">
          <div class="flex items-center gap-3">
            <span class="font-semibold">Email 1:</span>
            <a href="mailto:marketing@piramidati.com" class="hover:text-blue-600">marketing@piramidati.com</a>
          </div>
          <div class="flex items-center gap-3">
            <span class="font-semibold">Email 2:</span>
            <a href="mailto:pti@piramidati.com" class="hover:text-blue-600">pti@piramidati.com</a>
          </div>
          <div class="flex items-center gap-3">
            <span class="font-semibold">Telepon:</span>
            <a href="tel:03158283512" class="hover:text-blue-600">031 - 5828 3512</a>
          </div>
          <div class="flex items-center gap-3">
            <span class="font-semibold">Whatsapp 1:</span>
            <a href="https://wa.me/6285649704683" class="hover:text-blue-600">085 649 704 683</a>
          </div>
          <div class="flex items-center gap-3">
            <span class="font-semibold">Whatsapp 2:</span>
            <a href="https://wa.me/6285748584663" class="hover:text-blue-600">085 748 584 663</a>
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
</section>

{{-- Footer --}}
@include('components.footer')
@endsection
