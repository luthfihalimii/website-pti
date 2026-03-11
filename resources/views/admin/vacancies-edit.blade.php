@extends('layouts.admin')

@section('title', 'Edit Lowongan')

@section('content')
  <div class="rounded-3xl bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-bold text-slate-950">Edit Lowongan Pekerjaan</h1>

    <form action="{{ route('admin.vacancies.update', $vacancy) }}" method="POST" class="mt-8">
      @php($method = 'PUT')
      @php($submitLabel = 'Update Lowongan')
      @include('admin.vacancies-form')
    </form>

    <form action="{{ route('admin.vacancies.destroy', $vacancy) }}" method="POST" class="mt-4" onsubmit="return confirm('Hapus lowongan ini?');">
      @csrf
      @method('DELETE')
      <button type="submit" class="inline-flex h-11 items-center justify-center rounded-xl border border-red-200 bg-red-50 px-4 text-sm font-semibold text-red-700 transition hover:bg-red-100">
        Hapus Lowongan
      </button>
    </form>
  </div>
@endsection
