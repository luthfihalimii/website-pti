@extends('layouts.admin')

@section('title', 'Tambah Logo')

@section('content')
<div class="max-w-3xl mx-auto">

    <div class="bg-white p-6 rounded-3xl shadow border">
        <h2 class="text-xl font-semibold mb-6">Tambah Logo</h2>

        <form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- TYPE --}}
            <div>
                <label class="text-sm font-medium">Jenis Logo</label>
                <select id="logoType" name="type" class="w-full border px-3 py-2 rounded-xl mt-1">
                    <option value="client">Logo Client</option>
                    <option value="pti">Logo PTI</option>
                </select>
            </div>

            {{-- FILE --}}
            <div>
                <label class="text-sm font-medium">Upload Logo</label>

                <input id="logoInput" type="file" name="logo[]" multiple
                    class="mt-2 block w-full text-sm text-slate-600
                    file:mr-3 file:rounded-xl file:border-0
                    file:bg-slate-800 file:px-4 file:py-2
                    file:text-sm file:font-medium file:text-white
                    hover:file:bg-slate-900 cursor-pointer">

                <span id="fileName" class="text-xs text-slate-500 mt-1 block">
                    Belum ada file
                </span>
            </div>

            {{-- PREVIEW --}}
            <div id="previewContainer" class="grid grid-cols-3 gap-3"></div>

            {{-- NAMA CLIENT --}}
            <div id="nameContainer">
                <label class="text-sm font-medium">Nama Client</label>

                <div id="nameInputs" class="space-y-2 mt-2">
                    {{-- DEFAULT INPUT BIAR GA KOSONG --}}
                    <input type="text" name="name[]"
                        placeholder="Masukkan nama client"
                        class="w-full border px-3 py-2 rounded-xl text-sm">
                </div>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded-xl">
                Simpan
            </button>
        </form>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const logoInput = document.getElementById('logoInput');
    const previewContainer = document.getElementById('previewContainer');
    const logoType = document.getElementById('logoType');
    const nameContainer = document.getElementById('nameContainer');
    const nameInputs = document.getElementById('nameInputs');
    const fileName = document.getElementById('fileName');

    function generateNameInputs(files) {
        nameInputs.innerHTML = '';

        files.forEach((file, index) => {
            nameInputs.innerHTML += `
                <input type="text" name="name[]"
                placeholder="Nama client ${index + 1}"
                class="w-full border px-3 py-2 rounded-xl text-sm">
            `;
        });
    }

    logoInput.addEventListener('change', function () {

        previewContainer.innerHTML = '';

        const files = Array.from(this.files);

        fileName.innerText = files.length
            ? files.map(f => f.name).join(', ')
            : 'Belum ada file';

        // generate input nama
        if (logoType.value === 'client') {
            generateNameInputs(files);
        }

        files.forEach((file) => {
            const reader = new FileReader();

            reader.onload = function (e) {
                previewContainer.innerHTML += `
                    <img src="${e.target.result}" class="h-24 w-24 object-contain border rounded bg-white p-2">
                `;
            };

            reader.readAsDataURL(file);
        });
    });

    logoType.addEventListener('change', function () {

        if (this.value === 'pti') {
            nameContainer.style.display = 'none';
            logoInput.multiple = false;

            // reset input
            nameInputs.innerHTML = `
                <input type="text" name="name[]"
                placeholder="Masukkan nama client"
                class="w-full border px-3 py-2 rounded-xl text-sm">
            `;

        } else {
            nameContainer.style.display = 'block';
            logoInput.multiple = true;
        }
    });

    // INIT STATE
    if (logoType.value === 'client') {
        nameContainer.style.display = 'block';
    } else {
        nameContainer.style.display = 'none';
    }

});
</script>

@endsection