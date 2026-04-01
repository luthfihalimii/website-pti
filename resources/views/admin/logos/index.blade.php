@extends('layouts.admin')

@section('title', 'Logo Management')

@section('content')
<div class="space-y-10">

    {{-- ALERT --}}
    @if(session('success'))
        <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ================= NAVBAR ================= --}}
    <div class="rounded-3xl border bg-white p-6 shadow-sm">
        <h2 class="text-xl font-semibold mb-4">Logo Navbar (PTI)</h2>

        <div class="flex flex-col lg:flex-row gap-5 items-center">

            <div class="flex justify-center items-center h-24 w-24 border rounded-xl bg-slate-50 p-2">
                @if($pti)
                    <img src="{{ asset($pti->path) }}" class="h-20 w-20 object-contain" alt="Logo PTI">
                @else
                    <span class="text-sm text-slate-400">Belum ada logo</span>
                @endif
            </div>

            <form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3 w-full">
                @csrf
                <input type="hidden" name="type" value="pti">

                <div class="flex items-center border rounded-xl px-3 py-2 bg-white">
                    <label for="logo-pti" class="bg-gray-200 px-3 py-1 rounded cursor-pointer text-sm">
                        Choose File
                    </label>

                    <input
                        id="logo-pti"
                        type="file"
                        name="logo"
                        style="position:absolute; left:-9999px;"
                        onchange="document.getElementById('file-name').innerText = this.files[0] ? this.files[0].name : 'No file chosen'">

                    <span id="file-name" class="ml-3 text-sm text-gray-500">
                        No file chosen
                    </span>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm">
                    + Tambah
                </button>
            </form>

        </div>
    </div>

    {{-- ================= CLIENT ================= --}}
    <div class="rounded-3xl border bg-white p-6 shadow-sm">

        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-semibold">Logo Client</h2>

            <a href="{{ route('admin.logos.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm">
                + Tambah
            </a>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
        @foreach($clients as $c)
            <div class="border p-4 rounded-xl hover:shadow transition">

                <img id="preview-{{ $c->id }}"
                    src="{{ asset('storage/'.$c->path) }}"
                    class="h-20 mx-auto object-contain mb-3">

                <form action="{{ route('admin.logos.update',$c) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <input type="text" name="name" value="{{ $c->name }}"
                        class="w-full border px-3 py-2 rounded-xl text-sm mb-2">

                    <input type="file"
                        onchange="handleFile(this,'preview-{{ $c->id }}','file-{{ $c->id }}')"
                        class="block w-full text-xs text-slate-600
                        file:mr-3 file:rounded-xl file:border-0
                        file:bg-slate-800 file:px-3 file:py-2
                        file:text-xs file:font-medium file:text-white
                        hover:file:bg-slate-900 cursor-pointer">

                    <span id="file-{{ $c->id }}" class="text-xs text-slate-500"></span>

                    <button class="bg-blue-600 text-white px-3 py-1 rounded mt-3 w-full text-sm">
                        Update
                    </button>
                </form>

                <form action="{{ route('admin.logos.destroy',$c) }}" method="POST" class="mt-2">
                    @csrf @method('DELETE')
                    <button class="bg-red-600 text-white px-3 py-1 rounded w-full text-sm">
                        Hapus
                    </button>
                </form>

            </div>
        @endforeach
        </div>
    </div>

    {{-- ================= FOOTER ================= --}}
    <div class="rounded-3xl border bg-white p-6 shadow-sm">

        <h2 class="text-xl font-semibold mb-5">Logo Footer</h2>

        @php
        $footerTypes = [
            'footer_logo_pti'=>'Logo PTI',
            'footer_map_icon'=>'Icon Map',
            'footer_email_icon'=>'Icon Email',
            'footer_phone_icon'=>'Icon Phone',
            'footer_whatsapp_icon'=>'Icon WhatsApp',
            'footer_linkedin_icon'=>'Icon LinkedIn',
            'footer_clock_icon'=>'Icon Clock',
        ];
        @endphp

        <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5">

        @foreach($footerTypes as $type=>$label)
        @php $logo = $footers->firstWhere('type',$type); @endphp

        <div class="border rounded-2xl p-4 flex flex-col hover:shadow transition">

            <p class="text-sm font-semibold">{{ $label }}</p>
            <p class="text-xs text-slate-400 mb-3">{{ $type }}</p>

            <div class="flex justify-center mb-3">
                <img id="preview-{{ $type }}"
                    src="{{ $logo ? asset('storage/'.$logo->path) : '' }}"
                    class="h-16 object-contain {{ !$logo ? 'hidden':'' }}">
            </div>

            <span id="placeholder-{{ $type }}"
                class="text-xs text-center text-slate-400 mb-3 {{ $logo ? 'hidden':'' }}">
                No Icon
            </span>

            <form action="{{ route('admin.footer.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-2 mt-auto">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">

                <input type="file"
                    onchange="handleFile(this,'preview-{{ $type }}','file-{{ $type }}')"
                    class="block w-full text-xs text-slate-600
                    file:mr-3 file:rounded-xl file:border-0
                    file:bg-slate-800 file:px-3 file:py-2
                    file:text-xs file:font-medium file:text-white
                    hover:file:bg-slate-900 cursor-pointer">

                <span id="file-{{ $type }}" class="text-xs text-slate-500 text-center"></span>

                <button class="bg-blue-600 text-white w-full py-2 rounded text-sm">
                    Upload
                </button>
            </form>

            @if($logo)
            <form action="{{ route('admin.footer.destroy',$logo->id) }}" method="POST" class="mt-2">
                @csrf @method('DELETE')
                <button class="bg-red-600 text-white w-full py-2 rounded text-sm">
                    Hapus
                </button>
            </form>
            @endif

        </div>
        @endforeach

        </div>
    </div>

</div>

{{-- JS --}}
<script>
function handleFile(input, previewId, textId) {
    const file = input.files[0];
    if (!file) return;

    document.getElementById(textId).innerText = file.name;

    const reader = new FileReader();
    reader.onload = function(e){
        const preview = document.getElementById(previewId);
        preview.src = e.target.result;
        preview.classList.remove('hidden');

        const placeholder = document.getElementById('placeholder-' + previewId.replace('preview-',''));
        if (placeholder) placeholder.classList.add('hidden');
    };
    reader.readAsDataURL(file);
}
</script>

@endsection