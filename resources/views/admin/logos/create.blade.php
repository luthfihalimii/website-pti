@extends('layouts.admin')

@section('title', 'Tambah Logo')

@section('content')
<div class="max-w-2xl mx-auto">

  <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

    {{-- HEADER --}}
    <div class="mb-6">
      <h1 class="text-xl font-semibold text-slate-900">Tambah Logo</h1>
      <p class="text-sm text-slate-500 mt-1">Upload logo untuk navbar, footer, atau client</p>
    </div>

    {{-- ERROR --}}
    @if ($errors->any())
      <div class="mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- FORM TAMBAH LOGO --}}
    <form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
      @csrf

      {{-- TIPE LOGO --}}
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Tipe Logo</label>
        <select name="type" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
          <option value="pti">Logo Navbar (PTI)</option>
          <option value="client" selected>Logo Client</option>
        </select>
      </div>

      {{-- NAMA CLIENT --}}
      <div id="client-name-field">
        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Client</label>
        <input type="text" name="name" placeholder="Nama Client" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm">
        <p class="text-xs text-slate-500 mt-1">Hanya untuk logo client</p>
      </div>

      {{-- UPLOAD FILE --}}
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Upload Logo</label>
        <input type="file" name="logo" accept="image/*"
               class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm bg-white" required>
        <p class="text-xs text-slate-500 mt-1">Format: PNG, JPG, JPEG, SVG (max 2MB)</p>
      </div>

      {{-- BUTTON --}}
      <div class="flex items-center justify-between">
        <a href="{{ route('admin.logos.index') }}"
           class="text-sm text-slate-500 hover:text-slate-700">
          ← Kembali
        </a>

        <button type="submit"
          class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
          Upload Logo
        </button>
      </div>

    </form>
  </div>

</div>

{{-- SCRIPT: Hanya tampilkan field Nama Client kalau type = client --}}
<script>
  const typeSelect = document.querySelector('select[name="type"]');
  const clientNameField = document.getElementById('client-name-field');

  function toggleClientName() {
    if (typeSelect.value === 'client') {
      clientNameField.style.display = 'block';
    } else {
      clientNameField.style.display = 'none';
    }
  }

  typeSelect.addEventListener('change', toggleClientName);
  toggleClientName(); // inisialisasi saat halaman load
</script>
@endsection