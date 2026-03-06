@extends('layouts.app')

@section('title', 'Formulir Lamaran Kerja - Piramidasoft')

@section('content')
{{-- Hero Section --}}
<section class="relative w-full h-[253px] bg-gradient-to-r from-blue-700/95 via-blue-600/80 to-blue-500/70 overflow-hidden">
    <img
      src="{{ asset('assets/images/hero-pages.png') }}"
      alt="Hero Background"
      class="absolute inset-0 w-full h-full object-cover"
    />
    
    <div class="absolute inset-0 bg-gradient-to-r from-blue-700/95 via-blue-600/80 to-blue-500/70"></div>
    
    <div class="relative z-10 max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
      <h1 class="font-extrabold leading-none drop-shadow text-[54px] md:text-[68px]">
        Karir
      </h1>
      
      <p class="mt-3 text-[14px] md:text-[15px] font-semibold text-white/95">
        Home &nbsp;–&nbsp; Lowongan pekerjaan &nbsp;–&nbsp; Form
      </p>
    </div>
</section>

{{-- Form Section --}}
<section class="bg-white py-12">
  <div class="max-w-4xl mx-auto px-6">
    
    {{-- Header with Illustration --}}
    <div class="flex flex-col md:flex-row items-center justify-between mb-10 gap-6">
      <div class="flex-1">
        <h2 class="text-[28px] md:text-[32px] font-bold text-blue-600 mb-2">
          Formulir Lamaran Kerja
        </h2>
      </div>
      <div class="w-48 h-48">
        <img 
          src="{{ asset('assets/images/magang.png') }}" 
          alt="Form Illustration" 
          class="w-full h-full object-contain"
        />
      </div>
    </div>

    {{-- Form --}}
    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      {{-- Row 1: Nama Lengkap & Panggilan --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-[14px] font-medium text-slate-700 mb-2">
            Nama Lengkap (Sesuai KTP) <span class="text-red-500">*</span>
          </label>
          <input 
            type="text" 
            name="nama_lengkap" 
            placeholder="Ex: Aletha Leatomu"
            required
            class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
          />
        </div>
        <div>
          <label class="block text-[14px] font-medium text-slate-700 mb-2">
            Panggilan <span class="text-red-500">*</span>
          </label>
          <input 
            type="text" 
            name="panggilan" 
            placeholder="Nama Panggilan"
            required
            class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
          />
        </div>
      </div>

      {{-- Row 2: Email & Nomor Telepon --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-[14px] font-medium text-slate-700 mb-2">
            Email <span class="text-red-500">*</span>
          </label>
          <input 
            type="email" 
            name="email" 
            placeholder="e.g., user@mail.com"
            required
            class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
          />
        </div>
        <div>
          <label class="block text-[14px] font-medium text-slate-700 mb-2">
            Nomor Telepon <span class="text-red-500">*</span>
          </label>
          <input 
            type="tel" 
            name="nomor_telepon" 
            placeholder="e.g., 08123456789"
            required
            class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
          />
        </div>
      </div>

      {{-- Alamat Sekarang --}}
      <div>
        <label class="block text-[14px] font-medium text-slate-700 mb-2">
          Alamat Sekarang (Sesuai KTP) <span class="text-red-500">*</span>
        </label>
        <input 
          type="text" 
          name="alamat" 
          placeholder="e.g., Jl. Kebon Jeruk No. 5 Kota Semarang"
          required
          class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
        />
      </div>

      {{-- Row 3: Tempat Lahir & Tanggal Lahir --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-[14px] font-medium text-slate-700 mb-2">
            Tempat Lahir <span class="text-red-500">*</span>
          </label>
          <input 
            type="text" 
            name="tempat_lahir" 
            placeholder="Tempat Lahir"
            required
            class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
          />
        </div>
        <div>
          <label class="block text-[14px] font-medium text-slate-700 mb-2">
            Tanggal Lahir <span class="text-red-500">*</span>
          </label>
          <input 
            type="date" 
            name="tanggal_lahir" 
            required
            class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
          />
        </div>
      </div>

      {{-- Row 4: Jenis Kelamin & Agama --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-[14px] font-medium text-slate-700 mb-2">
            Jenis Kelamin <span class="text-red-500">*</span>
          </label>
          <select 
            name="jenis_kelamin" 
            required
            class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
          >
            <option value="">Pilih</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div>
          <label class="block text-[14px] font-medium text-slate-700 mb-2">
            Agama <span class="text-red-500">*</span>
          </label>
          <select 
            name="agama" 
            required
            class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
          >
            <option value="">Pilih</option>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Katolik">Katolik</option>
            <option value="Hindu">Hindu</option>
            <option value="Buddha">Buddha</option>
            <option value="Konghucu">Konghucu</option>
          </select>
        </div>
      </div>

      {{-- Row 5: Status Pernikahan & Golongan Darah --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-[14px] font-medium text-slate-700 mb-2">
            Status Pernikahan <span class="text-red-500">*</span>
          </label>
          <select 
            name="status_pernikahan" 
            required
            class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
          >
            <option value="">Pilih</option>
            <option value="Belum Menikah">Belum Menikah</option>
            <option value="Menikah">Menikah</option>
            <option value="Cerai">Cerai</option>
          </select>
        </div>
        <div>
          <label class="block text-[14px] font-medium text-slate-700 mb-2">
            Golongan Darah <span class="text-red-500">*</span>
          </label>
          <select 
            name="golongan_darah" 
            required
            class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
          >
            <option value="">Pilih</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">AB</option>
            <option value="O">O</option>
          </select>
        </div>
      </div>

      {{-- Pendidikan Terakhir --}}
      <div>
        <label class="block text-[14px] font-medium text-slate-700 mb-2">
          Pendidikan Terakhir <span class="text-red-500">*</span>
        </label>
        <select 
          name="pendidikan_terakhir" 
          required
          class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
        >
          <option value="">Pilih</option>
          <option value="SMA/SMK">SMA/SMK</option>
          <option value="D3">D3</option>
          <option value="S1">S1</option>
          <option value="S2">S2</option>
          <option value="S3">S3</option>
        </select>
      </div>

      {{-- Jurusan --}}
      <div>
        <label class="block text-[14px] font-medium text-slate-700 mb-2">
          Jurusan <span class="text-red-500">*</span>
        </label>
        <input 
          type="text" 
          name="jurusan" 
          placeholder="Jurusan"
          required
          class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
        />
      </div>

      {{-- IPK / Rata-rata --}}
      <div>
        <label class="block text-[14px] font-medium text-slate-700 mb-2">
          IPK / Rata-rata <span class="text-red-500">*</span>
        </label>
        <input 
          type="text" 
          name="ipk" 
          placeholder="e.g., 3.50"
          required
          class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
        />
      </div>

      {{-- Posisi yang Dilamar --}}
      <div>
        <label class="block text-[14px] font-medium text-slate-700 mb-2">
          Posisi yang Dilamar <span class="text-red-500">*</span>
        </label>
        <input 
          type="text" 
          name="posisi" 
          placeholder="e.g., UI/UX Designer, Programmer, Desainer Grafis"
          required
          class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
        />
      </div>

      {{-- Pengalaman Kerja --}}
      <div>
        <label class="block text-[14px] font-medium text-slate-700 mb-2">
          Pengalaman Kerja <span class="text-red-500">*</span>
        </label>
        <textarea 
          name="pengalaman_kerja" 
          rows="4"
          placeholder="Tuliskan pengalaman kerja Anda (jika ada)"
          required
          class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
        ></textarea>
      </div>

      {{-- Keahlian Khusus --}}
      <div>
        <label class="block text-[14px] font-medium text-slate-700 mb-2">
          Keahlian Khusus <span class="text-red-500">*</span>
        </label>
        <textarea 
          name="keahlian_khusus" 
          rows="3"
          placeholder="Tuliskan keahlian khusus yang Anda miliki"
          required
          class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
        ></textarea>
      </div>

      {{-- Upload CV --}}
      <div>
        <label class="block text-[14px] font-medium text-slate-700 mb-2">
          Upload CV (PDF) <span class="text-red-500">*</span>
        </label>
        <input 
          type="file" 
          name="cv" 
          accept=".pdf"
          required
          class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
        />
        <p class="text-[12px] text-slate-500 mt-1">Format: PDF, Max: 2MB</p>
      </div>

      {{-- Upload Portofolio --}}
      <div>
        <label class="block text-[14px] font-medium text-slate-700 mb-2">
          Upload Portofolio atau Link Portofolio <span class="text-red-500">*</span>
        </label>
        <input 
          type="text" 
          name="portofolio" 
          placeholder="e.g., https://behance.net/username atau upload file"
          required
          class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
        />
      </div>

      {{-- Sumber Informasi Lowongan --}}
      <div>
        <label class="block text-[14px] font-medium text-slate-700 mb-2">
          Dari mana Anda mengetahui lowongan ini? <span class="text-red-500">*</span>
        </label>
        <select 
          name="sumber_informasi" 
          required
          class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
        >
          <option value="">Pilih</option>
          <option value="Website Perusahaan">Website Perusahaan</option>
          <option value="Media Sosial">Media Sosial</option>
          <option value="Teman/Keluarga">Teman/Keluarga</option>
          <option value="Job Portal">Job Portal</option>
          <option value="Lainnya">Lainnya</option>
        </select>
      </div>

      {{-- Gaji yang Diharapkan --}}
      <div>
        <label class="block text-[14px] font-medium text-slate-700 mb-2">
          Gaji yang Diharapkan <span class="text-red-500">*</span>
        </label>
        <input 
          type="text" 
          name="gaji_diharapkan" 
          placeholder="e.g., Rp 5.000.000"
          required
          class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
        />
      </div>

      {{-- Kapan Bisa Mulai Bekerja --}}
      <div>
        <label class="block text-[14px] font-medium text-slate-700 mb-2">
          Kapan Anda bisa mulai bekerja? <span class="text-red-500">*</span>
        </label>
        <input 
          type="date" 
          name="mulai_bekerja" 
          required
          class="w-full px-4 py-3 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-transparent text-[14px]"
        />
      </div>

      {{-- Pernyataan --}}
      <div class="bg-slate-50 p-6 rounded-lg space-y-4">
        <div class="flex items-start gap-3">
          <input 
            type="checkbox" 
            name="pernyataan_1" 
            id="pernyataan_1"
            required
            class="mt-1 w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-600"
          />
          <label for="pernyataan_1" class="text-[13px] text-slate-700">
            Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan. <span class="text-red-500">*</span>
          </label>
        </div>
        
        <div class="flex items-start gap-3">
          <input 
            type="checkbox" 
            name="pernyataan_2" 
            id="pernyataan_2"
            required
            class="mt-1 w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-600"
          />
          <label for="pernyataan_2" class="text-[13px] text-slate-700">
            Saya bersedia mengikuti seluruh tahapan seleksi yang ditetapkan oleh perusahaan. <span class="text-red-500">*</span>
          </label>
        </div>
        
        <div class="flex items-start gap-3">
          <input 
            type="checkbox" 
            name="pernyataan_3" 
            id="pernyataan_3"
            required
            class="mt-1 w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-600"
          />
          <label for="pernyataan_3" class="text-[13px] text-slate-700">
            Apabila di kemudian hari terbukti bahwa data yang saya berikan tidak benar, saya bersedia menerima sanksi sesuai ketentuan yang berlaku (termasuk pembatalan penerimaan atau pemutusan hubungan kerja). <span class="text-red-500">*</span>
          </label>
        </div>
      </div>

      {{-- Submit Button --}}
      <div class="pt-4">
        <button 
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-md font-medium text-[14px] transition-colors inline-flex items-center gap-2"
        >
          Kirim →
        </button>
      </div>

    </form>

  </div>
</section>

@endsection
