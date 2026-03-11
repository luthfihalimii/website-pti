@extends('layouts.admin')

@section('title', 'Tambah Lowongan')

@section('content')
  <div class="rounded-3xl bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-bold text-slate-950">Tambah Lowongan Pekerjaan</h1>

    <form action="{{ route('admin.vacancies.store') }}" method="POST" class="mt-8">
      @php($method = 'POST')
      @php($submitLabel = 'Simpan Lowongan')
      @include('admin.vacancies-form')
    </form>
  </div>
@endsection
