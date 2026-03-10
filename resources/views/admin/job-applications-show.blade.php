@extends('layouts.admin')

@section('title', 'Detail Lamaran Kerja')

@section('content')
  <section class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
      <div>
        <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-sky-700">{{ __('Profil Kandidat Singkat') }}</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-950">{{ $application->nama_lengkap }}</h1>
        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $application->posisi }} · {{ $application->email }} · {{ $application->nomor_telepon }}</p>
      </div>
      <span class="inline-flex rounded-full px-4 py-2 text-sm font-semibold {{ $application->statusClasses() }}">
        {{ $application->statusLabel() }}
      </span>
    </div>
  </section>

  <div class="mt-6 grid gap-6 xl:grid-cols-[1.2fr_0.8fr]">
    <section class="space-y-6">
      <article class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-semibold text-slate-950">Profil Kandidat</h2>
        <div class="mt-5 grid gap-4 md:grid-cols-2">
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Tempat, Tanggal Lahir</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->tempat_lahir }}, {{ $application->tanggal_lahir?->format('d M Y') }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Pendidikan</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->pendidikan_terakhir }} · {{ $application->jurusan }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">IPK</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->ipk }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Alamat</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->alamat }}</p>
          </div>
        </div>
      </article>

      <article class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-semibold text-slate-950">Ringkasan Profesional</h2>
        <div class="mt-5 space-y-4">
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Keahlian Khusus</p>
            <p class="mt-2 text-sm leading-7 text-slate-700">{{ $application->keahlian_khusus }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Pengalaman Kerja</p>
            <p class="mt-2 text-sm leading-7 text-slate-700">{{ $application->pengalaman_kerja }}</p>
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
        <a href="{{ route('admin.job-applications.download', $application) }}" class="mt-5 inline-flex w-full items-center justify-center rounded-2xl bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-900">
          {{ __('Unduh CV') }}
        </a>

        <form action="{{ route('admin.job-applications.status.update', $application) }}" method="POST" class="mt-4 space-y-3">
          @csrf
          @method('PATCH')
          <label class="block">
            <span class="mb-2 block text-sm font-medium text-slate-700">Status Kandidat</span>
            <select name="status" class="h-12 w-full rounded-2xl border border-slate-300 px-4 text-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100">
              @foreach ($statusOptions as $value => $label)
                <option value="{{ $value }}" @selected($application->status === $value)>{{ $label }}</option>
              @endforeach
            </select>
          </label>
          <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-sky-50 px-4 py-3 text-sm font-semibold text-sky-800 ring-1 ring-sky-200 transition hover:bg-sky-100">
            Simpan Status
          </button>
        </form>

        <form action="{{ route('admin.job-applications.destroy', $application) }}" method="POST" class="mt-4" onsubmit="return confirm('Hapus lamaran kerja ini?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-red-50 px-4 py-3 text-sm font-semibold text-red-700 ring-1 ring-red-200 transition hover:bg-red-100">
            Hapus Lamaran
          </button>
        </form>
      </article>

      <article class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-semibold text-slate-950">Preferensi Kerja</h2>
        <div class="mt-5 space-y-3 text-sm text-slate-600">
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Mulai Bekerja</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->mulai_bekerja?->format('d M Y') }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Gaji Diharapkan</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->gaji_diharapkan }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 px-4 py-4">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Sumber Informasi</p>
            <p class="mt-2 font-medium text-slate-950">{{ $application->sumber_informasi }}</p>
          </div>
        </div>
      </article>
    </aside>
  </div>
@endsection
