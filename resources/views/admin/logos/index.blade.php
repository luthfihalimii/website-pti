@extends('layouts.admin')

@section('title', 'Logo Management')

@section('content')
<div class="space-y-8 p-6">

    {{-- ALERT --}}
    @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ================= NAVBAR ================= --}}
    <div class="bg-white border rounded-2xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Logo Navbar</h2>

        <div class="flex flex-col md:flex-row items-center gap-6">

            <div class="flex justify-center items-center h-24 w-24 border rounded-xl bg-slate-50 p-2">
                @if($pti)
                    <img src="{{ asset('storage/'.$pti->path) }}" class="h-20 w-20 object-contain">
                @else
                    <span class="text-sm text-slate-400">Belum ada logo</span>
                @endif
            </div>

            @if($pti)
            <form action="{{ route('admin.logos.update',$pti) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf @method('PUT')

                <label class="flex items-center gap-3 cursor-pointer">
                    <span class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                        Pilih File
                    </span>
                    <span id="file-pti" class="text-sm text-slate-600">Belum ada file</span>

                    <input type="file" name="logo" hidden
                        onchange="handleFile(this,'preview-pti','file-pti')">
                </label>

                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                    Update Logo
                </button>
            </form>
            @endif

        </div>
    </div>


    {{-- ================= CLIENT ================= --}}
    <div class="bg-white border rounded-2xl p-6 shadow-sm">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-slate-800">Logo Client</h2>

            <a href="{{ route('admin.logos.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                + Tambah
            </a>
        </div>

        <div class="grid md:grid-cols-2 gap-5">
        @foreach($clients as $c)
            <div class="border rounded-xl p-4 bg-slate-50 space-y-3">

                {{-- PREVIEW --}}
                <img id="preview-{{ $c->id }}"
                    src="{{ asset('storage/'.$c->path) }}"
                    class="h-20 mx-auto object-contain">

                {{-- FORM --}}
                <form action="{{ route('admin.logos.update',$c) }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                    @csrf @method('PUT')

                    <input type="text" name="name" value="{{ $c->name }}"
                        class="w-full border px-3 py-2 rounded-lg text-sm">

                    <label class="flex items-center gap-2 cursor-pointer">
                        <span class="bg-blue-600 text-white px-3 py-2 rounded-lg text-xs">
                            Pilih File
                        </span>
                        <span id="file-{{ $c->id }}" class="text-xs text-slate-600"></span>

                        <input type="file" name="logo" hidden
                            onchange="handleFile(this,'preview-{{ $c->id }}','file-{{ $c->id }}')">
                    </label>

                    {{-- BUTTON SEJAJAR --}}
                    <div class="flex gap-2">

                        <button type="submit"
                            class="w-1/2 bg-blue-600 text-white py-2 rounded-lg text-sm">
                            Update
                        </button>

                </form>

                        <form action="{{ route('admin.logos.destroy',$c) }}" method="POST" class="w-1/2">
                            @csrf @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Yakin hapus logo ini?')"
                                class="w-full bg-blue-500 text-white py-2 rounded-lg text-sm">
                                Hapus
                            </button>
                        </form>

                    </div>

            </div>
        @endforeach
        </div>
    </div>


    {{-- ================= FOOTER ================= --}}
    <div class="bg-white border rounded-2xl p-6 shadow-sm">

        <h2 class="text-lg font-semibold text-slate-800 mb-4">Logo Footer</h2>

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

        <div class="border rounded-xl p-4 bg-slate-50 space-y-3">

            <p class="text-sm font-semibold text-slate-800">{{ $label }}</p>

            <div class="flex justify-center">
                <img id="preview-{{ $type }}"
                    src="{{ $logo ? asset('storage/'.$logo->path) : '' }}"
                    class="h-14 object-contain {{ !$logo ? 'hidden':'' }}">
            </div>

            <span id="placeholder-{{ $type }}"
                class="text-xs text-center text-slate-500 {{ $logo ? 'hidden':'' }}">
                Belum ada icon
            </span>

            <form action="{{ route('admin.footer.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">

                <label class="flex items-center justify-between cursor-pointer">
                    <span class="bg-blue-600 text-white px-3 py-2 rounded-lg text-xs">
                        Pilih File
                    </span>
                    <span id="file-{{ $type }}" class="text-xs text-slate-600"></span>

                    <input type="file" name="logo" hidden
                        onchange="handleFile(this,'preview-{{ $type }}','file-{{ $type }}')">
                </label>

                <button class="w-full bg-blue-600 text-white py-2 rounded-lg text-sm">
                    Upload
                </button>
            </form>

            @if($logo)
            <form action="{{ route('admin.footer.destroy',$logo->id) }}" method="POST">
                @csrf @method('DELETE')
                <button onclick="return confirm('Yakin hapus icon ini?')"
                    class="w-full bg-blue-500 text-white py-2 rounded-lg text-sm">
                    Hapus
                </button>
            </form>
            @endif

        </div>
        @endforeach

        </div>
    </div>

</div>

<script>
function handleFile(input, previewId, textId) {
    const file = input.files[0];
    if (!file) return;

    document.getElementById(textId).innerText = file.name;

    const reader = new FileReader();
    reader.onload = function(e){
        const preview = document.getElementById(previewId);
        if(preview){
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
    };
    reader.readAsDataURL(file);
}
</script>

@endsection