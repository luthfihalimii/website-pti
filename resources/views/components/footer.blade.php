
<style>
  .business-hours-card,
  .business-hours-card * {
    color: #2563EB !important;
  }
</style>

<footer class="text-white">
  <div
    class="px-6 py-10"
    style="background: linear-gradient(90deg, #2563EB 0%, #60A5FA 100%);"
  >
    <div class="max-w-6xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

        <!-- KIRI -->
        <div>
          <div class="inline-flex items-center gap-3 bg-white/95 text-gray-800 rounded-lg px-4 py-3">
            <img src="{{ asset('assets/logo/logo.svg') }}" class="h-9 w-auto" alt="">
            <span class="font-semibold tracking-wide">PIRAMIDA TEKNOLOGI INFORMASI</span>
          </div>

          <p class="mt-5 text-sm leading-relaxed text-white/90 max-w-md">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
          </p>

          <ul class="mt-8 space-y-3 text-sm text-white/95">
            <li class="flex items-center gap-3">
              <img src="{{ asset('assets/icons/place.svg') }}" class="w-5 h-5" alt="">
              <span>Jl. Gayung Kebonsari Timur 29, Ketintang, Kec. Gayungan, Surabaya, Indonesia</span>
            </li>
            <li class="flex items-center gap-3">
              <img src="{{ asset('assets/icons/mail.svg') }}" class="w-5 h-5" alt="">
              <span>marketing@piramidati.com</span>
            </li>
            <li class="flex items-center gap-3">
              <img src="{{ asset('assets/icons/telp.svg') }}" class="w-5 h-5" alt="">
              <span>031 - 5828 3512</span>
            </li>
            <li class="flex items-center gap-3">
              <img src="{{ asset('assets/icons/whatsapp.svg') }}" class="w-5 h-5" alt="">
              <span>085954320729</span>
            </li>
            <li class="flex items-center gap-3">
              <img src="{{ asset('assets/icons/linkedin.svg') }}" class="w-5 h-5" alt="">
              <span>Piramida Teknologi Informasi</span>
            </li>
          </ul>
        </div>

        <!-- TENGAH -->
        <div>
          <h4 class="font-semibold text-lg">Layanan</h4>
          <ul class="mt-4 space-y-2 text-sm text-white/95 list-disc list-inside">
            <li>E-Procurement</li>
            <li>IT Consultant</li>
            <li>Business System</li>
            <li>E-Government &amp; Smart City</li>
          </ul>
        </div>

        <!-- KANAN -->
        <div class="flex flex-col">
          <div>
            <h4 class="font-semibold text-lg">Perusahaan</h4>
            <ul class="mt-4 space-y-2 text-sm text-white/95 list-disc list-inside">
              <li>Tentang kami</li>
              <li>Produk</li>
              <li>Karir</li>
              <li>Kontak</li>
            </ul>
          </div>

          <div class="flex-1"></div>

          <!-- BUSINESS HOURS -->
          <div class="mt-8 md:mt-0 md:flex md:justify-end">
            <div class="business-hours-card bg-white rounded-lg shadow-md overflow-hidden w-full md:w-[380px]">
              <div class="flex items-center text-sm">

                <!-- LEFT -->
                <div class="flex items-center gap-2 px-4 py-3 border-r border-gray-200">
                  <img src="{{ asset('assets/icons/jam.svg') }}" class="w-4 h-4" alt="">
                  <div class="leading-tight font-semibold text-[14px]">
                    <div>Business</div>
                    <div>Hours</div>
                  </div>
                </div>

                <!-- MIDDLE -->
                <div class="px-4 py-3 border-r border-gray-200 text-[12px] leading-tight">
                  <div>Weekday - Open</div>
                  <div class="mt-1">Weekend - Close</div>
                </div>

                <!-- RIGHT -->
                <div class="px-4 py-3 font-semibold text-[14px] text-center leading-tight">
                  <div>8 AM –</div>
                  <div>9 PM</div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="mt-10 border-t border-white/30"></div>

      <div class="mt-6 text-sm text-white/95">
        © Copyright 2026 Piramida Teknologi Informasi, All Rights Reserved
      </div>

    </div>
  </div>
</footer>
