@extends('layouts.admin')

@section('title', 'Detail Pendaftaran Magang')

@section('content')
  <section class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
      <div>
        <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-violet-700">Internship Profile</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-950">{{ $application->nama }}</h1>
        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $application->sekolah }} · {{ $application->divisi_pilihan }} · {{ $application->telp }}</p>
      </div>
      <span class="inline-flex rounded-full px-4 py-2 text-sm font-semibold {{ $application->statusClasses() }}">
        {{ $application->statusLabel() }}
      </span>
    </div>
  </section>

  <div class="mt-6 grid gap-6 xl:grid-cols-[1.2fr_0.8fr]">
    <section class="space-y-6">
      <article class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-semibold text-slate-950">Profil Pendaftar</h2>
        <div class="mt-5 grid gap-4 md:grid-cols-2">
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Tempat, Tanggal Lahir</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->tempat_lahir }}, {{ $application->tanggal_lahir?->format('d M Y') }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Kelas</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->kelas }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Alamat</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->alamat }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Sekolah</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->sekolah }}</p>
          </div>
        </div>
      </article>

      <article class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-semibold text-slate-950">Motivasi & Portofolio</h2>
        <div class="mt-5 space-y-4">
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Motivasi</p>
            <p class="mt-2 text-sm leading-7 text-slate-700">{{ $application->motivasi }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Portofolio</p>
            <p class="mt-2 text-sm leading-7 text-slate-700">{{ $application->portofolio }}</p>
          </div>
        </div>
      </article>
    </section>

    <aside class="space-y-6">
      <article class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-semibold text-slate-950">Aksi Cepat</h2>
        <a href="{{ route('admin.internship-applications.download', $application) }}" class="mt-5 inline-flex w-full items-center justify-center rounded-2xl bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-900">
          Download CV
        </a>

        <form action="{{ route('admin.internship-applications.status.update', $application) }}" method="POST" class="mt-4 space-y-3">
          @csrf
          @method('PATCH')
          <label class="block">
            <span class="mb-2 block text-sm font-medium text-slate-700">Status Pendaftar</span>
            <select name="status" class="h-12 w-full rounded-2xl border border-slate-300 px-4 text-sm focus:border-violet-500 focus:outline-none focus:ring-2 focus:ring-violet-100">
              @foreach ($statusOptions as $value => $label)
                <option value="{{ $value }}" @selected($application->status === $value)>{{ $label }}</option>
              @endforeach
            </select>
          </label>
          <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-violet-50 px-4 py-3 text-sm font-semibold text-violet-800 ring-1 ring-violet-200 transition hover:bg-violet-100">
            Simpan Status
          </button>
        </form>

        <form action="{{ route('admin.internship-applications.destroy', $application) }}" method="POST" class="mt-4" onsubmit="return confirm('Hapus pendaftaran magang ini?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-red-50 px-4 py-3 text-sm font-semibold text-red-700 ring-1 ring-red-200 transition hover:bg-red-100">
            Hapus Pendaftaran
          </button>
        </form>
      </article>

      <article class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-semibold text-slate-950">Jadwal Magang</h2>
        <div class="mt-5 space-y-3 text-sm text-slate-600">
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Mulai</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->mulai_magang?->format('d M Y') }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Selesai</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->selesai_magang?->format('d M Y') }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Telepon Sekolah</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->telp_sekolah }}</p>
          </div>
        </div>
      </article>
    </aside>
  </div>
@endsection
