@extends('layouts.app')

@section('title', 'Magang Selesai - Piramidasoft')

@section('content')
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
      <div style="width:46px;height:46px;border-radius:10px;background:#2563EB;display:flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
          <circle cx="12" cy="12" r="10"/>
          <path d="M8 12l3 3 5-5" stroke="#2563EB" stroke-width="2" fill="none"/>
        </svg>
      </div>
      <span style="font-size:18px;font-weight:700;color:#2563EB;">Selesai</span>
    </div>
  </div>

  <div style="display:flex; justify-content:center; align-items:center; padding:40px 0;">
    <div style="width:100%; min-height:60vh; display:flex; align-items:center; justify-content:center;">
      <div style="width:420px; background:#ffffff; border-radius:16px; padding:40px 36px; text-align:center; box-shadow:0 14px 32px rgba(0,0,0,0.12);">
        <div style="width:70px; height:70px; margin:0 auto 20px; border-radius:50%; background:linear-gradient(90deg,#6EA8FE,#4F8AD9); display:flex; align-items:center; justify-content:center; box-shadow:0 0 18px rgba(79,138,217,0.55);">
          <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none">
            <path d="M6 12.5L10 16L18 8" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <h2 style="font-size:36px; font-weight:800; margin-bottom:10px; color:#111827;">Pendaftaran Berhasil!</h2>
        <p style="color:#6B7280; font-size:14px; line-height:1.6; margin-bottom:28px;">
          Terima kasih telah mengirimkan formulir magang.
          Tim kami akan melakukan proses seleksi dan hasil
          akan dikirim melalui email Anda.
        </p>

        <a
          href="{{ route('home') }}"
          style="display:inline-flex; align-items:center; gap:12px; background:linear-gradient(90deg,#6EA8FE,#4F8AD9); color:#fff; font-size:20px; font-weight:700; padding:14px 30px; border-radius:10px; text-decoration:none; box-shadow:0 8px 18px rgba(0,0,0,0.15);"
        >
          Pergi ke beranda
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none">
            <path d="M5 12H19" stroke="white" stroke-width="3" stroke-linecap="round"/>
            <path d="M13 6L19 12L13 18" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
