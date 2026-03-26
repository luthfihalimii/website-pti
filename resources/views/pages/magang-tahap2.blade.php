@extends('layouts.app')

@section('title', 'Magang Tahap 2 - Piramidasoft')

@section('content')
@php
  $divisions = $divisions ?? config('site.internships.divisions', []);
@endphp

<style>
  input[type="radio"] {
    accent-color:#2563EB;
  }

  .magang-date-input::-webkit-calendar-picker-indicator {
    opacity: 0;
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
  }
</style>

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

{{-- CONTENT --}}
<div style="max-width:1200px; margin:0 auto; padding:40px 20px; background:#fff;">

  {{-- STEPPER --}}
  <div style="display:flex;align-items:center;gap:18px;margin-bottom:26px;flex-wrap:nowrap;white-space:nowrap;">

    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#2563EB;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="#fff">
          <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-4.41 0-8 2-8 4.5V21h16v-2.5C20 16 16.41 14 12 14Z"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#2563EB;">Tahap 1</span>
    </div>

    <span style="font-size:28px;font-weight:600;color:#2563EB;line-height:1;">&rsaquo;</span>

    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#2563EB;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
          <path d="M9 6V5a3 3 0 0 1 6 0v1h3a2 2 0 0 1 2 2v3H4V8a2 2 0 0 1 2-2h3Zm2 0h2V5a1 1 0 0 0-2 0v1Zm-7 6h16v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6Z"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#2563EB;">Tahap 2</span>
    </div>

    <span style="font-size:28px;font-weight:600;color:#2563EB;line-height:1;">&rsaquo;</span>

    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#93C5FD;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
          <circle cx="12" cy="12" r="10"/>
          <path d="M8 12l3 3 5-5" stroke="#2563EB" stroke-width="2" fill="none"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#9CA3AF;">Selesai</span>
    </div>
  </div>

  @if ($errors->any())
    <div style="margin-bottom:20px; border:1px solid #fecaca; background:#fef2f2; color:#991b1b; padding:12px 14px; border-radius:10px;">
      <strong>Periksa kembali data tahap 2 sebelum dikirim.</strong>
    </div>
  @endif

  {{-- FORM --}}
  <form method="POST" action="{{ route('internships.steps.two.store') }}" enctype="multipart/form-data">
    @csrf

    {{-- GRID ATAS --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:22px 40px;align-items:start;">

      {{-- Divisi --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Divisi</div>
        <select id="divisiSelect"
          name="divisi_pilihan"
          required
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; color:#9CA3AF;"
          onchange="ubahWarnaDivisi()">
          <option value="" disabled {{ old('divisi_pilihan') ? '' : 'selected' }}>Pilih Divisi</option>
          @foreach ($divisions as $division)
            <option value="{{ $division['title'] }}" @selected(old('divisi_pilihan') === $division['title'])>{{ $division['title'] }}</option>
          @endforeach
        </select>
        @error('divisi_pilihan') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <script>
      function ubahWarnaDivisi() {
        const select = document.getElementById("divisiSelect");
        if (select.value !== "") {
          select.style.color = "#111827";
        } else {
          select.style.color = "#9CA3AF";
        }
      }
      document.addEventListener("DOMContentLoaded", function () {
        ubahWarnaDivisi();
      });
      </script>

      {{-- Pernyataan --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Pernyataan</div>
        <input
          type="text"
          name="motivasi"
          value="{{ old('motivasi') }}"
          minlength="20"
          required
          placeholder="Alasan mengapa anda memilih divisi tersebut"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
        @error('motivasi') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      {{-- Mulai Magang --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Tanggal Mulai Magang</div>
        <div style="position:relative;">
          <input
            type="date"
            name="mulai_magang"
            value="{{ old('mulai_magang') }}"
            required
            class="magang-date-input"
            style="
            width:100%;
            height:48px;
            border:1px solid #9CA3AF;
            border-radius:10px;
            padding:0 46px 0 18px;
            outline:none;
            ">
          <span style="
              position:absolute;
              right:14px;
              top:50%;
              transform:translateY(-50%);
              color:#111827;
              pointer-events:none;
              ">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M7 2a1 1 0 0 1 1 1v1h8V3a1 1 0 1 1 2 0v1h1a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h1V3a1 1 0 0 1 1-1Zm12 8H5v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V10ZM6 6a1 1 0 0 0-1 1v1h14V7a1 1 0 0 0-1-1H6Z"/>
            </svg>
          </span>
        </div>
        @error('mulai_magang') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      {{-- Selesai Magang --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Tanggal Selesai Magang</div>
        <div style="position:relative;">
          <input
            type="date"
            name="selesai_magang"
            value="{{ old('selesai_magang') }}"
            required
            class="magang-date-input"
            style="
            width:100%;
            height:48px;
            border:1px solid #9CA3AF;
            border-radius:10px;
            padding:0 46px 0 18px;
            outline:none;
            ">
          <span style="
              position:absolute;
              right:14px;
              top:50%;
              transform:translateY(-50%);
              color:#111827;
              pointer-events:none;
              ">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M7 2a1 1 0 0 1 1 1v1h8V3a1 1 0 1 1 2 0v1h1a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h1V3a1 1 0 0 1 1-1Zm12 8H5v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V10ZM6 6a1 1 0 0 0-1 1v1h14V7a1 1 0 0 0-1-1H6Z"/>
            </svg>
          </span>
        </div>
        @error('selesai_magang') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      {{-- CV Terbaru --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">
          CV Terbaru <span style="color:red;">*</span>
        </div>

        <div style="
          width:100%;
          height:48px;
          border:1px solid #9CA3AF;
          border-radius:10px;
          padding:6px 12px;
          display:flex;
          align-items:center;
          background:#fff;
        ">
          <input type="file" id="cvFile" name="cv" accept=".pdf,application/pdf" required style="display:none;">
          <label for="cvFile"
            style="
            background:#E5E7EB;
            padding:6px 12px;
            border-radius:6px;
            cursor:pointer;
            font-size:14px;
            ">
            Choose File
          </label>
          <span id="fileName" style="font-size:14px; color:#6B7280; margin-left:10px;">
            No file chosen
          </span>
        </div>
        <div style="font-size:12px; margin-top:6px; color:#6B7280;">
          (Format File PDF, Maksimum 2 MB)
        </div>
        @error('cv') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <script>
      document.getElementById("cvFile").addEventListener("change", function(){
        const file = this.files[0];

        if (file) {
          if (file.size > 2 * 1024 * 1024) {
            alert("Ukuran file maksimal 2 MB");
            this.value = "";
            document.getElementById("fileName").textContent = "No file chosen";
            return;
          }

          document.getElementById("fileName").textContent = file.name;
        }
      });
      </script>

      {{-- Portofolio --}}
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Portofolio (Optional)</div>
        <input
          type="text"
          name="portofolio"
          value="{{ old('portofolio') }}"
          required
          placeholder="Masukkan link portfolio anda (GitHub, dll)"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;">
        @error('portofolio') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>
    </div>

    {{-- PERTANYAAN --}}
    <div style="margin-top:18px; color:#111827;">
      <div style="margin-top:16px; font-size:15px;">
        Apakah Anda bersedia mematuhi peraturan perusahaan, termasuk etika kerja dan kebijakan kerahasiaan data?
        <div style="display:flex; align-items:center; gap:70px; margin-top:10px;">
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="pernyataan" value="1" {{ old('pernyataan') == '1' ? 'checked' : '' }} style="width:18px;height:18px;" required> Ya</label>
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="pernyataan" value="0" {{ old('pernyataan') == '0' ? 'checked' : '' }} style="width:18px;height:18px;" required> Tidak</label>
        </div>
        @error('pernyataan') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div style="margin-top:16px; font-size:15px;">
        Apakah Anda sedang terikat kontrak kerja, magang, atau program lain yang dapat mengganggu komitmen Anda selama periode magang ini?
        <div style="display:flex; align-items:center; gap:70px; margin-top:10px;">
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q2" value="ya" {{ old('q2') === 'ya' ? 'checked' : '' }} style="width:18px;height:18px;"> Ya</label>
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q2" value="tidak" {{ old('q2') === 'tidak' ? 'checked' : '' }} style="width:18px;height:18px;"> Tidak</label>
        </div>
      </div>

      <div style="margin-top:16px; font-size:15px;">
        Apakah Anda memiliki perangkat pribadi (laptop/PC) yang mendukung kebutuhan pekerjaan selama magang?
        <div style="display:flex; align-items:center; gap:70px; margin-top:10px;">
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q3" value="ya" {{ old('q3') === 'ya' ? 'checked' : '' }} style="width:18px;height:18px;"> Ya</label>
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q3" value="tidak" {{ old('q3') === 'tidak' ? 'checked' : '' }} style="width:18px;height:18px;"> Tidak</label>
        </div>
      </div>

      <div style="margin-top:16px; font-size:15px;">
        Apakah Anda bersedia menerima evaluasi dan feedback secara berkala selama program magang berlangsung?
        <div style="display:flex; align-items:center; gap:70px; margin-top:10px;">
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q4" value="ya" {{ old('q4') === 'ya' ? 'checked' : '' }} style="width:18px;height:18px;"> Ya</label>
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q4" value="tidak" {{ old('q4') === 'tidak' ? 'checked' : '' }} style="width:18px;height:18px;"> Tidak</label>
        </div>
      </div>

      <div style="margin-top:16px; font-size:15px;">
        Apakah Anda siap bekerja secara individu maupun dalam tim sesuai arahan pembimbing?
        <div style="display:flex; align-items:center; gap:70px; margin-top:10px;">
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q5" value="ya" {{ old('q5') === 'ya' ? 'checked' : '' }} style="width:18px;height:18px;"> Ya</label>
          <label style="display:flex; align-items:center; gap:10px;"><input type="radio" name="q5" value="tidak" {{ old('q5') === 'tidak' ? 'checked' : '' }} style="width:18px;height:18px;"> Tidak</label>
        </div>
      </div>
    </div>

    {{-- BUTTON SELESAI --}}
    <button
      type="submit"
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
        border:none;
        transition:0.2s;
        "
      onmouseover="this.style.background='#1D4ED8'"
      onmouseout="this.style.background='#2563EB'">
      Selesai

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
    </button>
  </form>
</div>

@endsection
