@extends('layouts.admin')

@section('title', 'Logo Management')

@section('content')
<div class="space-y-10">

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

    {{-- LOGO NAVBAR --}}
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-5 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-900">Logo Navbar (PTI)</h2>
                <p class="mt-1 text-sm text-slate-500">Logo utama yang tampil di navbar website</p>
            </div>
        </div>

        @if($pti)
            <div class="flex flex-col gap-5 lg:flex-row lg:items-center">
                
                <div class="flex h-24 w-24 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 overflow-hidden">
                    <img
                        id="preview-pti"
                        src="{{ asset('storage/' . $pti->path) }}"
                        alt="Logo PTI"
                        class="max-h-20 max-w-20 object-contain"
                    >
                </div>

                <form
                    action="{{ route('admin.logos.update', $pti) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="flex-1 flex flex-col gap-3 sm:flex-row sm:items-center"
                >
                    @csrf
                    @method('PUT')

                    <input
                        type="file"
                        name="logo"
                        accept=".png,.jpg,.jpeg,.svg"
                        onchange="previewLogo(this, 'preview-pti')"
                        class="block w-full text-sm text-slate-600
                               file:mr-3 file:rounded-xl file:border-0
                               file:bg-slate-100 file:px-4 file:py-2
                               file:text-sm file:font-medium file:text-slate-700
                               hover:file:bg-slate-200"
                    >

                    <button
                        type="submit"
                        class="rounded-xl bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition"
                    >
                        Ganti Logo
                    </button>
                </form>

                <form
                    action="{{ route('admin.logos.destroy', $pti) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus logo navbar?')"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="rounded-xl bg-red-600 px-5 py-2 text-sm font-semibold text-white hover:bg-red-700 transition"
                    >
                        Hapus
                    </button>
                </form>
            </div>
        @else
            <a
                href="{{ route('admin.logos.create') }}"
                class="inline-flex rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition"
            >
                + Tambah Logo Navbar
            </a>
        @endif
    </div>

    {{-- LOGO CLIENT --}}
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-5 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-900">Logo Client</h2>
                <p class="mt-1 text-sm text-slate-500">Daftar logo client yang tampil di website</p>
            </div>

            <a
                href="{{ route('admin.logos.create') }}"
                class="rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition"
            >
                + Tambah Client
            </a>
        </div>

        @if($clients->count())
            <div class="space-y-4">
                @foreach($clients as $client)
                    <div class="rounded-2xl border border-slate-200 p-4 flex flex-col gap-4 lg:flex-row lg:items-center">
                        
                        <div class="flex h-24 w-24 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 overflow-hidden">
                            <img
                                id="preview-client-{{ $client->id }}"
                                src="{{ asset('storage/' . $client->path) }}"
                                alt="{{ $client->name }}"
                                class="max-h-20 max-w-20 object-contain"
                            >
                        </div>

                        <form
                            action="{{ route('admin.logos.update', $client) }}"
                            method="POST"
                            enctype="multipart/form-data"
                            class="flex-1 grid grid-cols-1 gap-3 lg:grid-cols-[1fr_1fr_auto]"
                        >
                            @csrf
                            @method('PUT')

                            <input
                                type="text"
                                name="name"
                                value="{{ $client->name }}"
                                placeholder="Nama Client"
                                class="rounded-xl border border-slate-300 px-4 py-2 text-sm focus:border-blue-500 focus:outline-none"
                            >

                            <input
                                type="file"
                                name="logo"
                                accept=".png,.jpg,.jpeg,.svg"
                                onchange="previewLogo(this, 'preview-client-{{ $client->id }}')"
                                class="block w-full text-sm text-slate-600
                                       file:mr-3 file:rounded-xl file:border-0
                                       file:bg-slate-100 file:px-4 file:py-2
                                       file:text-sm file:font-medium file:text-slate-700
                                       hover:file:bg-slate-200"
                            >

                            <button
                                type="submit"
                                class="rounded-xl bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition"
                            >
                                Ganti
                            </button>
                        </form>

                        <form
                            action="{{ route('admin.logos.destroy', $client) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus logo client ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="rounded-xl bg-red-600 px-5 py-2 text-sm font-semibold text-white hover:bg-red-700 transition"
                            >
                                Hapus
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-2xl border border-dashed border-slate-300 py-10 text-center text-sm text-slate-500">
                Belum ada logo client.
            </div>
        @endif
    </div>

    {{-- FOOTER ICON --}}
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-5">
            <h2 class="text-xl font-semibold text-slate-900">Logo Footer</h2>
            <p class="mt-1 text-sm text-slate-500">Kelola icon dan logo yang tampil di footer website</p>
        </div>

        @php
            $footerTypes = [
                'footer_logo_pti'      => 'Logo PTI',
                'footer_map_icon'      => 'Icon Map',
                'footer_email_icon'    => 'Icon Email',
                'footer_phone_icon'    => 'Icon Phone',
                'footer_whatsapp_icon' => 'Icon WhatsApp',
                'footer_linkedin_icon' => 'Icon LinkedIn',
                'footer_clock_icon'    => 'Icon Clock',
            ];
        @endphp

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            @foreach($footerTypes as $type => $label)
                @php
                    $logo = $footers->firstWhere('type', $type);
                @endphp

                <div class="rounded-2xl border border-slate-200 p-5 flex flex-col">
                    <div class="mb-4">
                        <h3 class="text-sm font-semibold text-slate-800">{{ $label }}</h3>
                        <p class="mt-1 break-all text-xs text-slate-500">{{ $type }}</p>
                    </div>

                    <div class="mb-4 flex justify-center">
                        <div class="flex h-24 w-24 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 overflow-hidden">
                            
                            @if($logo && $logo->path)
                                <img
                                    id="preview-{{ $type }}"
                                    src="{{ asset('storage/' . $logo->path) }}"
                                    alt="{{ $type }}"
                                    class="max-h-16 max-w-16 object-contain"
                                >
                            @else
                                <img
                                    id="preview-{{ $type }}"
                                    src=""
                                    alt="{{ $type }}"
                                    class="hidden max-h-16 max-w-16 object-contain"
                                >

                                <span
                                    id="placeholder-{{ $type }}"
                                    class="text-center text-xs text-slate-400"
                                >
                                    No Icon
                                </span>
                            @endif
                        </div>
                    </div>

                    <form
                        action="{{ route('admin.footer.upload') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="mt-auto space-y-3"
                    >
                        @csrf

                        <input type="hidden" name="type" value="{{ $type }}">

                        <input
                            type="file"
                            name="logo"
                            accept=".png,.jpg,.jpeg,.svg"
                            onchange="previewLogo(this, '{{ $type }}')"
                            class="block w-full text-xs text-slate-600
                                   file:mr-2 file:rounded-xl file:border-0
                                   file:bg-slate-100 file:px-3 file:py-2
                                   file:text-xs file:font-medium file:text-slate-700
                                   hover:file:bg-slate-200"
                        >

                        <button
                            type="submit"
                            class="w-full rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition"
                        >
                            Upload / Ganti
                        </button>
                    </form>

                    @if($logo)
                        <form
                            action="{{ route('admin.footer.destroy', $logo->id) }}"
                            method="POST"
                            class="mt-2"
                            onsubmit="return confirm('Yakin ingin menghapus icon ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition"
                            >
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
function previewLogo(input, targetId) {
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();

    reader.onload = function(e) {
        const target = document.getElementById(targetId);

        if (target) {
            target.src = e.target.result;
            target.classList.remove('hidden');
        }

        const placeholder = document.getElementById('placeholder-' + targetId);
        if (placeholder) {
            placeholder.classList.add('hidden');
        }
    };

    reader.readAsDataURL(file);
}
</script>
@endsection