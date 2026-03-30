@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-6">
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">Footer Management</h1>
        <p class="text-sm text-slate-500 mt-1">
            Upload dan ganti icon footer website
        </p>
    </div>

    @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach([
            'footer_logo_pti'      => 'Logo PTI',
            'footer_map_icon'      => 'Icon Map',
            'footer_email_icon'    => 'Icon Email',
            'footer_phone_icon'    => 'Icon Phone',
            'footer_whatsapp_icon' => 'Icon WhatsApp',
            'footer_linkedin_icon' => 'Icon LinkedIn',
            'footer_clock_icon'    => 'Icon Clock'
        ] as $type => $label)

            @php
                $logo = $logos->firstWhere('type', $type);
            @endphp

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm flex flex-col">
                
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-slate-800">
                        {{ $label }}
                    </h3>
                    <p class="text-xs text-slate-500 mt-1 break-all">
                        {{ $type }}
                    </p>
                </div>

                <div class="mb-4 flex justify-center">
                    <div class="w-24 h-24 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-center overflow-hidden">
                        
                        @if($logo && $logo->path)
                            <img
                                id="preview-{{ $type }}"
                                src="{{ asset('storage/' . $logo->path) }}"
                                alt="{{ $type }}"
                                class="max-w-[72px] max-h-[72px] object-contain"
                            >
                        @else
                            <img
                                id="preview-{{ $type }}"
                                src=""
                                alt="{{ $type }}"
                                class="hidden max-w-[72px] max-h-[72px] object-contain"
                            >

                            <span
                                id="placeholder-{{ $type }}"
                                class="text-[11px] text-slate-400 text-center px-2"
                            >
                                Belum ada logo
                            </span>
                        @endif
                    </div>
                </div>

                <form
                    action="{{ route('admin.footer.upload') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-3 mt-auto"
                >
                    @csrf

                    <input type="hidden" name="type" value="{{ $type }}">

                    <input
                        type="file"
                        name="logo"
                        accept=".png,.jpg,.jpeg,.svg"
                        class="block w-full text-xs text-slate-600
                               file:mr-3 file:rounded-lg file:border-0
                               file:bg-slate-100 file:px-3 file:py-2
                               file:text-xs file:font-medium
                               file:text-slate-700 hover:file:bg-slate-200"
                        onchange="previewLogo(this, '{{ $type }}')"
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
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('Yakin ingin menghapus logo ini?')"
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

<script>
function previewLogo(input, type) {
    const file = input.files[0];

    if (!file) return;

    const preview = document.getElementById('preview-' + type);
    const placeholder = document.getElementById('placeholder-' + type);

    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.classList.remove('hidden');

        if (placeholder) {
            placeholder.classList.add('hidden');
        }
    };

    reader.readAsDataURL(file);
}
</script>
@endsection