@extends('layouts.app')

@section('title', 'Magang')

@section('content')
  {{-- HERO / BREADCRUMB --}}
  <section class="relative">
    <div class="absolute inset-0">
      <img
        src="{{ asset('assets/images/hero-pages.png') }}"
        alt="Hero Karir"
        class="h-full w-full object-cover"
      />
      <div class="absolute inset-0 bg-blue-700/60"></div>
    </div>

    <div class="relative mx-auto max-w-6xl px-4 py-16 md:py-20 text-center text-white">
      <h1 class="text-4xl md:text-5xl font-bold tracking-tight">Karir</h1>
      <p class="mt-3 text-sm md:text-base opacity-90">Home &nbsp;–&nbsp; Magang</p>
    </div>
  </section>

  {{-- INTRO --}}
  <section class="mx-auto max-w-6xl px-4 py-14 md:py-16">
    <div class="text-center">
      <div class="flex items-center justify-center gap-3">
        <span class="h-px w-12 bg-slate-300"></span>
        <p class="text-blue-600 font-semibold tracking-wide">MAGANG</p>
        <span class="h-px w-12 bg-slate-300"></span>
      </div>

      <h2 class="mt-4 text-3xl md:text-4xl font-extrabold tracking-tight">#DariMagangJadiJago</h2>

      <p class="mx-auto mt-5 max-w-3xl text-slate-600 leading-relaxed">
        Di PT. Piramida Teknologi Informasi, kalian nggak cuma magang — kalian bertumbuh.
        Terlibat di project nyata, dibimbing mentor berpengalaman, dan diasah jadi lebih siap
        masuk dunia profesional. Datang belajar, pulang jadi lebih jago.
      </p>
    </div>
  </section>

  {{-- DIVISI (BACKGROUND IMAGE) --}}
  <section class="relative">
    <div class="absolute inset-0">
      <img
        src="{{ asset('assets/images/hero-pages.png') }}"
        alt="Background"
        class="h-full w-full object-cover"
      />
      <div class="absolute inset-0 bg-blue-800/70"></div>
    </div>

    <div class="relative mx-auto max-w-6xl px-4 py-14 md:py-16">
      <h3 class="text-center text-2xl md:text-3xl font-bold text-white">
        Kami mempunyai berbagai divisi <span class="font-extrabold">untuk mengasah skill anda</span>
      </h3>

      @php
        $divisi = [
          [
            'title' => 'Web Development',
            'desc'  => 'Siswa magang belajar membangun dan mengelola website secara langsung sesuai standar industri.',
            'img'   => 'WEB.png',
          ],
          [
            'title' => 'Mobile Development',
            'desc'  => 'Siswa magang belajar mengembangkan aplikasi mobile yang fungsional dan siap digunakan.',
            'img'   => 'MOBILE.png',
          ],
          [
            'title' => 'UI/UX Designer',
            'desc'  => 'Siswa magang belajar merancang tampilan dan pengalaman pengguna yang intuitif serta menarik.',
            'img'   => 'UIUX.png',
          ],
          [
            'title' => 'IT Support',
            'desc'  => 'Siswa magang belajar menangani instalasi, troubleshooting, dan pemeliharaan sistem IT.',
            'img'   => 'IT.png',
          ],
        ];
      @endphp

      <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($divisi as $d)
          <div class="rounded-2xl bg-white/95 p-6 shadow-lg ring-1 ring-black/5">
            <div class="flex items-center justify-center">
              <div class="grid h-14 w-14 place-items-center rounded-xl bg-blue-50">
                <img
                  src="{{ asset('assets/images/' . $d['img']) }}"
                  alt="{{ $d['title'] }}"
                  class="h-10 w-10 object-contain"
                />
              </div>
            </div>

            <h4 class="mt-4 text-center font-bold text-slate-900">{{ $d['title'] }}</h4>
            <p class="mt-2 text-center text-sm text-slate-600 leading-relaxed">
              {{ $d['desc'] }}
            </p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- BENEFIT --}}
  <section class="mx-auto max-w-6xl px-4 py-14 md:py-16">
    <div class="text-center">
      <h3 class="text-3xl md:text-4xl font-extrabold tracking-tight">Benefit Program Magang</h3>
      <p class="mx-auto mt-4 max-w-3xl text-slate-600 leading-relaxed">
        Bersama kami, bangun fondasi karier yang kuat dan ciptakan perjalanan profesional yang penuh
        tantangan, pembelajaran, serta peluang berkembang.
      </p>
    </div>

    @php
      $benefit = [
        ['no'=>1,'title'=>'Terlibat dalam real proyek','desc'=>'Berkesempatan bekerja langsung pada proyek nyata yang berdampak.'],
        ['no'=>2,'title'=>'Lingkungan kerja yang profesional','desc'=>'Suasana kerja yang mendukung pengembangan dan pertumbuhan kemampuan anda.'],
        ['no'=>3,'title'=>'Mentor berpengalaman','desc'=>'Bimbingan langsung dari profesional yang ahli di bidangnya.'],
        ['no'=>4,'title'=>'Sertifikat magang','desc'=>'Sertifikat resmi sebagai bukti pengalaman magang anda.'],
      ];
    @endphp

    <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-2">
      @foreach ($benefit as $b)
        <div class="rounded-2xl bg-white p-7 shadow-lg ring-1 ring-black/5">
          <div class="flex items-start gap-5">
            <div class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-blue-600 text-white font-bold">
              {{ $b['no'] }}
            </div>
            <div>
              <h4 class="text-lg font-bold text-slate-900">{{ $b['title'] }}</h4>
              <p class="mt-2 text-slate-600">{{ $b['desc'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  {{-- CTA --}}
  <section class="mx-auto max-w-6xl px-4 pb-16">
    <p class="text-blue-600 font-extrabold tracking-wide">SUDAH SIAP MAGANG DI PTI?</p>

    <div class="mt-6 grid grid-cols-1 items-center gap-10 md:grid-cols-2">
      <div>
        <h3 class="text-4xl md:text-5xl font-extrabold leading-tight">
          MEMBENTUK MASA DEPAN <br />
          <span class="text-blue-600">MAGANG DI PTI</span>
        </h3>

        <p class="mt-4 text-slate-600 leading-relaxed">
          Dengan fokus pada peningkatan kualitas, pengembangan keterampilan, dan pemberdayaan, PTI berupaya
          menciptakan lingkungan yang kondusif bagi peserta magang untuk tumbuh dan berkembang.
        </p>

        <a
          href="{{ url('/kontak') }}"
          class="mt-6 inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white shadow hover:bg-blue-700"
        >
          Daftar <span aria-hidden="true">→</span>
        </a>
      </div>

      <div class="flex justify-center md:justify-end">
        <img
          src="{{ asset('assets/images/Magang.png') }}"
          alt="Ilustrasi Magang"
          class="max-w-md w-full"
        />
      </div>
    </div>
  </section>
@endsection