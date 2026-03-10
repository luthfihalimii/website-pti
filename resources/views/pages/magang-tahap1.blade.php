@extends('layouts.app')

@section('title', 'Magang Tahap 1 - Piramidasoft')

@section('content')

{{-- HERO --}}
<section style="position:relative; width:100%; height:253px; overflow:hidden;">
  <img src="{{ asset('assets/images/hero-pages.png') }}"
       alt="Hero"
       style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; z-index:0;">
  <div style="position:absolute; inset:0; background:rgba(37,99,235,.55); z-index:1;"></div>

  <div style="position:relative; z-index:2; height:253px; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#fff;">
    <div style="font-size:68px; font-weight:800; line-height:1; margin-bottom:12px;">Karir</div>
    <div style="display:flex; align-items:center; gap:10px; font-size:21px; font-weight:700;">
      <span>Home</span>
      <span style="display:inline-block; width:12px; height:3px; background:#fff;"></span>
      <span>Magang</span>
    </div>
  </div>
</section>

{{-- CONTENT WRAP --}}
<div style="max-width:1200px; margin:0 auto; padding:40px 20px; background:#fff;">

  {{-- STEPPER --}}
  <div style="display:flex;align-items:center;gap:18px;margin-bottom:26px;flex-wrap:nowrap;white-space:nowrap;">
    
    <!-- Tahap 1 (aktif) -->
    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#2563EB;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="#fff">
          <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-4.41 0-8 2-8 4.5V21h16v-2.5C20 16 16.41 14 12 14Z"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#2563EB;">Tahap 1</span>
    </div>
    <!-- Arrow 1 (biru) -->
    <span style="font-size:28px;font-weight:600;color:#2563EB;line-height:1;">›</span>
    
    <!-- Tahap 2 -->
    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#93C5FD;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
          <path d="M9 6V5a3 3 0 0 1 6 0v1h3a2 2 0 0 1 2 2v3H4V8a2 2 0 0 1 2-2h3Zm2 0h2V5a1 1 0 0 0-2 0v1Zm-7 6h16v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6Z"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#9CA3AF;">Tahap 2</span>
    </div>
    <!-- Arrow 2 (abu) -->
     <span style="font-size:28px;font-weight:600;color:#C5C5C5;line-height:1;">›</span>
    
    <!-- Selesai -->
    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#93C5FD;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
          <circle cx="12" cy="12" r="10"/>
          <path d="M8 12l3 3 5-5" stroke="#2563EB" stroke-width="2" fill="none"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#9CA3AF;">Selesai</span>
    </div>
    <!-- Arrow 3 (abu) -->
    <span style="font-size:28px;font-weight:600;color:#C5C5C5;">›</span>
  </div>

  {{-- FORM GRID --}}
  <form method="GET" action="/magang/tahap-2">
    @csrf

    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:22px 40px;">

      {{-- Nama Lengkap --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Nama Lengkap</div>
        <input type="text" placeholder="Nama Lengkap"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>

      {{-- NISN/NIM --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">NISN/NIM</div>
        <input type="text" placeholder="NISN/NIM"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>

      {{-- Tempat Lahir --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Tempat Lahir</div>
        <input type="text" placeholder="Tempat Lahir"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>

      {{-- Tanggal Lahir --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Tanggal Lahir</div>
        <div style="position:relative;">
          <input type="text" placeholder="hh/bb/tttt"
          onfocus="this.type='date'"
          onblur="if(!this.value)this.type='text'"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 46px 0 18px; outline:none;">
          <span style="position:absolute; right:14px; top:50%; transform:translateY(-50%); color:#111827;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M7 2a1 1 0 0 1 1 1v1h8V3a1 1 0 1 1 2 0v1h1a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h1V3a1 1 0 0 1 1-1Zm12 8H5v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V10ZM6 6a1 1 0 0 0-1 1v1h14V7a1 1 0 0 0-1-1H6Z"/>
            </svg>
          </span>
        </div>
      </div>

      {{-- Text (radio) --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Text</div>
        <div style="display:flex; align-items:center; gap:26px; height:48px; color:#6B7280;">
          <label style="display:flex; align-items:center; gap:8px;">
            <input type="radio" name="jk" style="width:18px; height:18px;"> Laki-laki
          </label>
          <label style="display:flex; align-items:center; gap:8px;">
            <input type="radio" name="jk" style="width:18px; height:18px;"> Perempuan
          </label>
        </div>
      </div>

      <div></div>

      {{-- Alamat --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Alamat</div>
        <textarea rows="4"
        style="width:100%; border:1px solid #9CA3AF; border-radius:10px; padding:14px 18px; outline:none; resize:none;"></textarea>
      </div>

      {{-- No. Telp --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">No. Telp</div>
        <input type="text" placeholder="0812345678"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>

      {{-- Kelas --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Kelas</div>
        <select id="kelasSelect"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; color:#9CA3AF;"
          onchange="ubahWarnaKelas()">
        
          <option value="" disabled selected>Kelas</option>
          <option>X</option>
          <option>XI</option>
          <option>XII</option>
          <option>D3</option>
          <option>S1</option>
          <option>S2</option>
        </select>
      </div>

      <script>
      function ubahWarnaKelas(){
        var select = document.getElementById("kelasSelect");
        if(select.value !== ""){
          select.style.color = "#111827"; // jadi hitam setelah dipilih
          }
        }
      </script>

      {{-- Sekolah/Universitas --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Sekolah/Universitas</div>
        <input type="text" placeholder="Sekolah/Universitas"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>

      {{-- Alamat Sekolah/Universitas --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Alamat Sekolah/Universitas</div>
        <textarea rows="4"
        style="width:100%; border:1px solid #9CA3AF; border-radius:10px; padding:14px 18px; outline:none; resize:none;"></textarea>
      </div>

      {{-- No. Telp. Sekolah/Universitas --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">No. Telp. Sekolah/Universitas</div>
        <input type="text" placeholder="0812345678"
        style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
      </div>
    </div>

      {{-- BUTTON SELANJUTNYA --}}
      <a href="{{ url('/magang/tahap-2') }}"
      style="
        display:inline-flex;
        align-items:center;
        gap:10px;
        margin-top:24px;
        background:#2563EB;
        color:white;
        padding:12px 32px;
        border-radius:10px;
        text-decoration:none;
        font-weight:600;
        cursor:pointer;
        transition:0.2s;
        "
        onmouseover="this.style.background='#1D4ED8'"
        onmouseout="this.style.background='#2563EB'">

        Selanjutnya
      
        <svg xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none">

        <path d="M5 12H19"
          stroke="white"
          stroke-width="3"
          stroke-linecap="round"/>

        <path d="M13 6L19 12L13 18"
          stroke="white"
          stroke-width="3"
          stroke-linecap="round"
          stroke-linejoin="round"/>
        </svg>
      </a>
    </div>
  </form>
</div>

@endsection