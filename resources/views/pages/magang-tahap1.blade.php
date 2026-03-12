@extends('layouts.app')

@section('title', 'Magang Tahap 1 - Piramidasoft')

@section('content')
@php($stepOneData = $stepOneData ?? [])

<style>
  input[type="radio"] {
    accent-color:#2563EB;
  }
</style>

<section style="position:relative; width:100%; height:253px; overflow:hidden;">
  <img
    src="{{ asset('assets/images/hero-pages.png') }}"
    alt="Hero"
    style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; z-index:0;"
  >
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

<div style="max-width:1200px; margin:0 auto; padding:40px 20px; background:#fff;">
  <div style="display:flex;align-items:center;gap:18px;margin-bottom:26px;flex-wrap:nowrap;white-space:nowrap;">
    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#2563EB;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="#fff">
          <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-4.41 0-8 2-8 4.5V21h16v-2.5C20 16 16.41 14 12 14Z"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#2563EB;">Tahap 1</span>
    </div>

    <span style="font-size:28px;font-weight:600;color:#C5C5C5;line-height:1;">&rsaquo;</span>

    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:46px;height:46px;border-radius:10px;background:#93C5FD;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
          <path d="M9 6V5a3 3 0 0 1 6 0v1h3a2 2 0 0 1 2 2v3H4V8a2 2 0 0 1 2-2h3Zm2 0h2V5a1 1 0 0 0-2 0v1Zm-7 6h16v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6Z"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#9CA3AF;">Tahap 2</span>
    </div>

    <span style="font-size:28px;font-weight:600;color:#C5C5C5;line-height:1;">&rsaquo;</span>

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

  @if (session('internship_error'))
    <div style="margin-bottom:20px; border:1px solid #fecaca; background:#fef2f2; color:#991b1b; padding:12px 14px; border-radius:10px;">
      {{ session('internship_error') }}
    </div>
  @endif

  @if (session('internship_status'))
    <div style="margin-bottom:20px; border:1px solid #bbf7d0; background:#f0fdf4; color:#166534; padding:12px 14px; border-radius:10px;">
      {{ session('internship_status') }}
    </div>
  @endif

  @if ($errors->any())
    <div style="margin-bottom:20px; border:1px solid #fecaca; background:#fef2f2; color:#991b1b; padding:12px 14px; border-radius:10px;">
      <strong>Periksa kembali data yang diisi.</strong>
    </div>
  @endif

  <form method="POST" action="{{ route('internships.steps.one.store') }}">
    @csrf

    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:22px 40px;">
      <div>
        <div style="font-weight:700; margin-bottom:10px;">Nama Lengkap</div>
        <input
          type="text"
          name="nama"
          value="{{ old('nama', $stepOneData['nama'] ?? '') }}"
          required
          placeholder="Nama Lengkap"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;"
        >
        @error('nama') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div>
        <div style="font-weight:700; margin-bottom:10px;">NISN/NIM</div>
        <input
          type="text"
          name="nisn"
          value="{{ old('nisn', $stepOneData['nisn'] ?? '') }}"
          required
          placeholder="NISN/NIM"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;"
        >
        @error('nisn') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div>
        <div style="font-weight:700; margin-bottom:10px;">Tempat Lahir</div>
        <input
          type="text"
          name="tempat_lahir"
          value="{{ old('tempat_lahir', $stepOneData['tempat_lahir'] ?? '') }}"
          required
          placeholder="Tempat Lahir"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;"
        >
        @error('tempat_lahir') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div>
        <div style="font-weight:700; margin-bottom:10px;">Tanggal Lahir</div>
        <input
          type="date"
          name="tanggal_lahir"
          value="{{ old('tanggal_lahir', $stepOneData['tanggal_lahir'] ?? '') }}"
          required
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;"
        >
        @error('tanggal_lahir') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div>
        <div style="font-weight:700; margin-bottom:10px;">Jenis Kelamin</div>
        <div style="display:flex; align-items:center; gap:26px; min-height:48px; color:#111827;">
          <label style="display:flex; align-items:center; gap:8px;">
            <input type="radio" name="jk" value="Laki-laki" {{ old('jk', $stepOneData['jk'] ?? '') === 'Laki-laki' ? 'checked' : '' }} required>
            Laki-laki
          </label>
          <label style="display:flex; align-items:center; gap:8px;">
            <input type="radio" name="jk" value="Perempuan" {{ old('jk', $stepOneData['jk'] ?? '') === 'Perempuan' ? 'checked' : '' }} required>
            Perempuan
          </label>
        </div>
        @error('jk') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div></div>

      <div>
        <div style="font-weight:700; margin-bottom:10px;">Alamat</div>
        <textarea
          name="alamat"
          rows="4"
          required
          style="width:100%; border:1px solid #9CA3AF; border-radius:10px; padding:14px 18px; outline:none; resize:none;"
        >{{ old('alamat', $stepOneData['alamat'] ?? '') }}</textarea>
        @error('alamat') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div>
        <div style="font-weight:700; margin-bottom:10px;">No. Telp</div>
        <input
          type="text"
          name="telp"
          value="{{ old('telp', $stepOneData['telp'] ?? '') }}"
          required
          placeholder="0812345678"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;"
        >
        @error('telp') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div>
        <div style="font-weight:700; margin-bottom:10px;">Kelas</div>
        <select
          name="kelas"
          required
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px;"
        >
          <option value="" disabled {{ old('kelas', $stepOneData['kelas'] ?? '') ? '' : 'selected' }}>Pilih Kelas</option>
          @foreach (['X', 'XI', 'XII', 'D3', 'S1'] as $kelas)
            <option value="{{ $kelas }}" {{ old('kelas', $stepOneData['kelas'] ?? '') === $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
          @endforeach
        </select>
        @error('kelas') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div>
        <div style="font-weight:700; margin-bottom:10px;">Sekolah/Universitas</div>
        <input
          type="text"
          name="sekolah"
          value="{{ old('sekolah', $stepOneData['sekolah'] ?? '') }}"
          required
          placeholder="Sekolah/Universitas"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;"
        >
        @error('sekolah') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div>
        <div style="font-weight:700; margin-bottom:10px;">Alamat Sekolah/Universitas</div>
        <textarea
          name="alamat_sekolah"
          rows="4"
          required
          style="width:100%; border:1px solid #9CA3AF; border-radius:10px; padding:14px 18px; outline:none; resize:none;"
        >{{ old('alamat_sekolah', $stepOneData['alamat_sekolah'] ?? '') }}</textarea>
        @error('alamat_sekolah') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div>
        <div style="font-weight:700; margin-bottom:10px;">No. Telp. Sekolah/Universitas</div>
        <input
          type="text"
          name="telp_sekolah"
          value="{{ old('telp_sekolah', $stepOneData['telp_sekolah'] ?? '') }}"
          required
          placeholder="0311234567"
          style="width:100%; height:48px; border:1px solid #9CA3AF; border-radius:10px; padding:0 18px; outline:none;"
        >
        @error('telp_sekolah') <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div> @enderror
      </div>
    </div>

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
        font-weight:600;
        border:none;
        cursor:pointer;
      "
    >
      Selanjutnya
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M5 12H19" stroke="white" stroke-width="3" stroke-linecap="round"/>
        <path d="M13 6L19 12L13 18" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
  </form>
</div>
@endsection
