@extends('layouts.admin')

@section('title', 'Lamaran Kerja')

@section('content')
  <section class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
      <div>
        <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-sky-700">Recruitment Inbox</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-950">Lamaran Kerja</h1>
        <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600">Review kandidat masuk, cek preferensi kerja, dan buka detail kandidat dari satu inbox yang rapi.</p>
      </div>
      <div class="rounded-2xl bg-slate-950 px-5 py-4 text-white shadow-lg shadow-slate-950/10">
        <p class="text-[11px] uppercase tracking-[0.28em] text-sky-300">Total Kandidat</p>
        <p class="mt-2 text-3xl font-semibold">{{ $applications->count() }}</p>
      </div>
    </div>
  </section>

  <section class="mt-6 overflow-hidden rounded-[30px] border border-slate-200/80 bg-white shadow-sm">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-slate-500">
          <tr>
            <th class="px-5 py-4 font-semibold">Kandidat</th>
            <th class="px-5 py-4 font-semibold">Posisi</th>
            <th class="px-5 py-4 font-semibold">Mulai Kerja</th>
            <th class="px-5 py-4 font-semibold">Status</th>
            <th class="px-5 py-4 font-semibold text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse ($applications as $application)
            <tr class="align-top">
              <td class="px-5 py-4">
                <p class="font-semibold text-slate-950">{{ $application->nama_lengkap }}</p>
                <p class="mt-1 text-slate-500">{{ $application->email }}</p>
              </td>
              <td class="px-5 py-4 text-slate-600">{{ $application->posisi }}</td>
              <td class="px-5 py-4 text-slate-600">{{ $application->mulai_bekerja?->format('d M Y') }}</td>
              <td class="px-5 py-4">
                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $application->statusClasses() }}">
                  {{ $application->statusLabel() }}
                </span>
              </td>
              <td class="px-5 py-4">
                <div class="flex justify-end gap-2">
                  <a href="{{ route('admin.job-applications.show', $application) }}" class="inline-flex rounded-xl bg-slate-950 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-900">
                    Detail
                  </a>
                  <a href="{{ route('admin.job-applications.download', $application) }}" class="inline-flex rounded-xl bg-sky-50 px-4 py-2 text-xs font-semibold text-sky-800 ring-1 ring-sky-200 transition hover:bg-sky-100">
                    Download CV
                  </a>
                  <form action="{{ route('admin.job-applications.destroy', $application) }}" method="POST" onsubmit="return confirm('Hapus lamaran kerja ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex rounded-xl bg-red-50 px-4 py-2 text-xs font-semibold text-red-700 ring-1 ring-red-200 transition hover:bg-red-100">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-5 py-14 text-center text-sm text-slate-500">Belum ada lamaran kerja yang masuk.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>
@endsection
