@extends('layouts.admin')

@section('title', 'Inquiry Produk')

@section('content')
  <div>
    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">Lead Inbox</p>
    <h1 class="mt-2 text-3xl font-bold text-slate-950">Inquiry Produk</h1>
  </div>

  <div class="mt-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
      <thead class="bg-slate-50 text-left text-slate-600">
        <tr>
          <th class="px-5 py-4 font-semibold">Produk</th>
          <th class="px-5 py-4 font-semibold">Nama</th>
          <th class="px-5 py-4 font-semibold">Email</th>
          <th class="px-5 py-4 font-semibold">Perusahaan</th>
          <th class="px-5 py-4 font-semibold">Pesan</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200">
        @forelse ($inquiries as $inquiry)
          <tr>
            <td class="px-5 py-4 font-medium text-slate-950">{{ $inquiry->product->name }}</td>
            <td class="px-5 py-4 text-slate-600">{{ $inquiry->name }}</td>
            <td class="px-5 py-4 text-slate-600">{{ $inquiry->email }}</td>
            <td class="px-5 py-4 text-slate-600">{{ $inquiry->company ?: '-' }}</td>
            <td class="px-5 py-4 text-slate-600">{{ $inquiry->message }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-5 py-12 text-center text-slate-500">Belum ada inquiry produk.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
