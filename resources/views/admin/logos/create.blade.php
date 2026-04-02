@extends('layouts.admin')

@section('title','Tambah Logo')

@section('content')
<div class="max-w-xl mx-auto p-6">

<div class="bg-white p-6 rounded-2xl shadow border">

<h2 class="font-semibold mb-4 text-slate-800">Tambah Logo</h2>

<form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data">
@csrf

{{-- TYPE --}}
<select name="type" id="type"
    class="w-full border border-slate-300 px-3 py-2 rounded-xl mb-3 text-slate-700">
    <option value="pti">Navbar</option>
    <option value="client">Client</option>
</select>

{{-- NAME --}}
<div id="nameField">
<input type="text" name="name" placeholder="Nama Client"
    class="w-full border border-slate-300 px-3 py-2 rounded-xl mb-3 text-slate-700">
</div>

{{-- FILE --}}
<label class="flex items-center justify-center gap-3 cursor-pointer
    bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-xl font-medium transition">
    
    📁 Pilih File
    <input type="file" name="logo" hidden onchange="preview(event)">
</label>

<p id="fileName" class="text-sm text-slate-600 mt-2 text-center">
    Belum ada file dipilih
</p>

<img id="preview" class="h-24 mx-auto mt-3 hidden rounded-xl border p-2 bg-slate-50">

<button class="bg-blue-600 hover:bg-blue-700 text-white w-full py-2 rounded-xl mt-4 font-medium transition">
    Simpan
</button>

</form>

</div>
</div>

<script>
const type = document.getElementById('type');
const nameField = document.getElementById('nameField');

// default hide kalau navbar
if(type.value === 'pti'){
    nameField.style.display = 'none';
}

type.addEventListener('change', () => {
    if(type.value === 'client'){
        nameField.style.display = 'block';
    } else {
        nameField.style.display = 'none';
    }
});

function preview(e){
    const file = e.target.files[0];
    if (!file) return;

    // tampilkan nama file
    document.getElementById('fileName').innerText = file.name;

    const reader = new FileReader();
    reader.onload = function(e){
        const img = document.getElementById('preview');
        img.src = e.target.result;
        img.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}
</script>
@endsection