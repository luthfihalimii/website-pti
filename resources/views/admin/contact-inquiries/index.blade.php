@extends('layouts.admin')

@section('title', 'Pesan Kontak')

@section('content')
  <section class="rounded-[30px] border border-slate-200/80 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
      <div>
        <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-emerald-700">{{ __('Inbox Kontak') }}</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-950">Pesan Kontak</h1>
        <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600">Tinjau pesan yang masuk dari website dan tindak lanjuti percakapan dari satu inbox yang rapi.</p>
      </div>
      <div class="rounded-2xl bg-slate-950 px-5 py-4 text-white shadow-lg shadow-slate-950/10">
        <p class="text-[11px] uppercase tracking-[0.28em] text-emerald-300">Total Pesan</p>
        <p class="mt-2 text-3xl font-semibold">{{ $inquiries->total() }}</p>
      </div>
    </div>
  </section>

  <section class="mt-6 overflow-hidden rounded-[30px] border border-slate-200/80 bg-white shadow-sm">
    <div class="overflow-x-auto">
      <table class="min-w-[920px] divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-slate-500">
          <tr>
            <th class="px-5 py-4 font-semibold">Pengirim</th>
            <th class="px-5 py-4 font-semibold">Email</th>
            <th class="px-5 py-4 font-semibold">Pesan</th>
            <th class="px-5 py-4 font-semibold">Masuk</th>
            <th class="px-5 py-4 font-semibold text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse ($inquiries as $inquiry)
            <tr class="align-top">
              <td class="px-5 py-4 font-semibold text-slate-950">{{ $inquiry->name }}</td>
              <td class="px-5 py-4 text-slate-600">
                <a href="mailto:{{ $inquiry->email }}" class="break-all hover:text-slate-900">{{ $inquiry->email }}</a>
              </td>
              <td class="px-5 py-4 text-slate-600">
                <p class="max-w-[360px] break-words">{{ $inquiry->message }}</p>
              </td>
              <td class="px-5 py-4 text-slate-600">{{ $inquiry->created_at?->format('d M Y H:i') }}</td>
              <td class="px-5 py-4">
                <div class="admin-table-actions flex justify-end gap-2 whitespace-nowrap">
                  <form action="{{ route('admin.contact-inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Hapus pesan kontak ini?');">
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
              <td colspan="5" class="px-5 py-14 text-center text-sm text-slate-500">Belum ada pesan kontak yang masuk.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>

  @if ($inquiries->hasPages())
    <div class="mt-6">
      {{ $inquiries->links() }}
    </div>
  @endif
@endsection
