@extends('layouts.admin')

@section('title','Footer Management')

@section('content')
<div class="p-6 space-y-6">

    <h1 class="text-xl font-semibold text-slate-800 mb-4">Footer Logo</h1>

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

    <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5">
        @foreach($footerTypes as $type => $label)
            @php
                $logo = $footers->firstWhere('type', $type);
            @endphp

            <div class="border rounded-xl p-4 bg-slate-50 space-y-3">
                <p class="text-sm font-semibold text-slate-800">{{ $label }}</p>

                <div class="flex justify-center items-center mb-2 h-16">
                    @if($logo && $logo->path)
                        <img
                            id="preview-{{ $type }}"
                            src="{{ asset('storage/' . $logo->path) }}"
                            alt="{{ $label }}"
                            class="h-14 object-contain"
                        >
                    @else
                        <img
                            id="preview-{{ $type }}"
                            src=""
                            alt="{{ $label }}"
                            class="h-14 object-contain hidden"
                        >
                        <span id="empty-{{ $type }}" class="text-xs text-slate-500">
                            Belum ada icon
                        </span>
                    @endif
                </div>

                <form action="{{ route('admin.footer.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                    @csrf
                    <input type="hidden" name="type" value="{{ $type }}">

                    <label class="flex items-center justify-between cursor-pointer">
                        <span class="bg-blue-600 text-white px-3 py-2 rounded-lg text-xs">
                            Pilih File
                        </span>
                        <span id="file-{{ $type }}" class="text-xs text-slate-600"></span>

                        <input
                            type="file"
                            name="logo"
                            hidden
                            accept=".png,.jpg,.jpeg,.svg"
                            onchange="handleFile(this,'preview-{{ $type }}','file-{{ $type }}','empty-{{ $type }}')"
                        >
                    </label>

                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg text-sm">
                        Upload
                    </button>
                </form>

                @if($logo)
                    <form action="{{ route('admin.footer.destroy', $logo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            onclick="return confirm('Yakin hapus icon ini?')"
                            class="w-full bg-red-500 text-white py-2 rounded-lg text-sm"
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
function handleFile(input, previewId, textId, emptyId) {
    const file = input.files[0];
    if (!file) return;

    const fileText = document.getElementById(textId);
    if (fileText) {
        fileText.innerText = file.name;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById(previewId);
        const emptyText = document.getElementById(emptyId);

        if (preview) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }

        if (emptyText) {
            emptyText.classList.add('hidden');
        }
    };

    reader.readAsDataURL(file);
}
</script>
@endsection