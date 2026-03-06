@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
  <section class="rounded-3xl border border-slate-200 bg-white px-6 py-7 lg:px-8">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
      <div class="max-w-3xl">
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-sky-700">Dashboard</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900 sm:text-[2.2rem]">Ringkasan Operasional Harian</h1>
        <p class="mt-3 text-sm leading-7 text-slate-600 sm:text-base">Monitor lead, kandidat, dan pipeline produk dengan tampilan yang ringkas dan mudah dibaca.</p>
      </div>
      <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
        Terakhir diperbarui: {{ now()->format('d M Y, H:i') }}
      </div>
    </div>
  </section>

  <section class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
      <p class="text-xs font-medium tracking-wide text-slate-500">Kategori</p>
      <p class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">{{ $stats['categories'] }}</p>
    </article>
    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
      <p class="text-xs font-medium tracking-wide text-slate-500">Semua Produk</p>
      <p class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">{{ $stats['products'] }}</p>
    </article>
    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
      <p class="text-xs font-medium tracking-wide text-slate-500">Inquiry Produk</p>
      <p class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">{{ $stats['product_inquiries'] }}</p>
    </article>
    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
      <p class="text-xs font-medium tracking-wide text-slate-500">Lamaran Kerja</p>
      <p class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">{{ $stats['job_applications'] }}</p>
    </article>
    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
      <p class="text-xs font-medium tracking-wide text-slate-500">Pendaftaran Magang</p>
      <p class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">{{ $stats['internship_applications'] }}</p>
    </article>
  </section>

  <section class="mt-6 grid gap-5 xl:grid-cols-3">
    <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
      <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold tracking-tight text-slate-900">Lamaran Kerja Terbaru</h2>
        <a href="{{ route('admin.job-applications.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">Lihat semua</a>
      </div>
      <div class="mt-5 space-y-3">
        @forelse ($recentJobApplications as $application)
          <a href="{{ route('admin.job-applications.show', $application) }}" class="block rounded-xl border border-slate-200 p-4 transition hover:bg-slate-50">
            <div class="flex items-start justify-between gap-3">
              <div>
                <p class="font-semibold text-slate-900">{{ $application->nama_lengkap }}</p>
                <p class="mt-1 text-sm text-slate-500">{{ $application->posisi }}</p>
              </div>
              <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $application->statusClasses() }}">{{ $application->statusLabel() }}</span>
            </div>
            <p class="mt-3 text-xs uppercase tracking-[0.18em] text-slate-400">{{ $application->created_at?->format('d M Y H:i') }}</p>
          </a>
        @empty
          <div class="rounded-xl border border-dashed border-slate-300 px-4 py-8 text-center text-sm text-slate-500">Belum ada lamaran kerja.</div>
        @endforelse
      </div>
    </article>

    <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
      <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold tracking-tight text-slate-900">Pendaftaran Magang</h2>
        <a href="{{ route('admin.internship-applications.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">Lihat semua</a>
      </div>
      <div class="mt-5 space-y-3">
        @forelse ($recentInternshipApplications as $application)
          <a href="{{ route('admin.internship-applications.show', $application) }}" class="block rounded-xl border border-slate-200 p-4 transition hover:bg-slate-50">
            <div class="flex items-start justify-between gap-3">
              <div>
                <p class="font-semibold text-slate-900">{{ $application->nama }}</p>
                <p class="mt-1 text-sm text-slate-500">{{ $application->divisi_pilihan }}</p>
              </div>
              <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $application->statusClasses() }}">{{ $application->statusLabel() }}</span>
            </div>
            <p class="mt-3 text-xs uppercase tracking-[0.18em] text-slate-400">{{ $application->sekolah }}</p>
          </a>
        @empty
          <div class="rounded-xl border border-dashed border-slate-300 px-4 py-8 text-center text-sm text-slate-500">Belum ada pendaftaran magang.</div>
        @endforelse
      </div>
    </article>

    <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
      <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold tracking-tight text-slate-900">Inquiry Produk</h2>
        <a href="{{ route('admin.product-inquiries.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">Lihat semua</a>
      </div>
      <div class="mt-5 space-y-3">
        @forelse ($recentProductInquiries as $inquiry)
          <div class="rounded-xl border border-slate-200 p-4">
            <p class="font-semibold text-slate-900">{{ $inquiry->name }}</p>
            <p class="mt-1 text-sm text-slate-500">{{ $inquiry->product->name }}</p>
            <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">{{ $inquiry->message }}</p>
          </div>
        @empty
          <div class="rounded-xl border border-dashed border-slate-300 px-4 py-8 text-center text-sm text-slate-500">Belum ada inquiry produk.</div>
        @endforelse
      </div>
    </article>
  </section>
@endsection
