@extends('layouts.admin')

@section('title','Footer Management')

@section('content')
<div class="p-6 space-y-6">

    <h1 class="text-xl font-semibold text-slate-800">Footer Logo</h1>

    {{-- KALAU DATA KOSONG --}}
    @if($logos->isEmpty())
        <div class="text-center text-slate-500 text-sm py-10 border rounded-xl bg-white">
            Belum ada logo footer
        </div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

        @foreach($logos as $logo)
        <div class="border rounded-xl p-4 bg-white shadow-sm hover:shadow-md transition">

            {{-- TYPE --}}
            <p class="text-sm font-medium text-slate-700 mb-2 text-center">
                {{ $logo->type }}
            </p>

            {{-- IMAGE --}}
            <div class="flex justify-center mb-3">
                <img 
                    src="{{ asset('storage/'.$logo->path) }}"
                    class="h-16 object-contain"
                    onerror="this.onerror=null;this.src='/no-image.png';"
                >
            </div>

            {{-- DELETE --}}
            <form action="{{ route('admin.footer.destroy',$logo->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus logo ini?')">
                @csrf 
                @method('DELETE')

                <button
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg text-sm transition">
                    Hapus
                </button>
            </form>

        </div>
        @endforeach

    </div>

</div>
@endsection