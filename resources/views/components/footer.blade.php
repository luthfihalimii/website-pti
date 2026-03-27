<footer class="text-white">
  <div
    class="footer-gradient px-6 py-10"
  >
    <div class="max-w-6xl mx-auto">
      <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">

    <!-- KIRI -->
    <div>
      @php
      $logoFooter = \App\Models\Logo::where('type', 'footer')->latest()->first();
      @endphp

      <div class="inline-flex items-center gap-3 bg-white/95 text-gray-800 rounded-lg px-4 py-3">
        <img class="h-9 w-auto"
            src="{{ $logoFooter ? asset('storage/' . $logoFooter->path) : asset('assets/logo/logo.svg') }}"
            alt="Piramidasoft">
        <span class="font-semibold tracking-wide">
          {{ strtoupper(config('site.company.name')) }}
        </span>
      </div>

      <p class="mt-5 text-sm leading-relaxed text-white/90 max-w-md">
        {{ __(config('site.company.description')) }}
      </p>

      <ul class="mt-8 space-y-3 text-sm text-white/95">
        <li class="flex items-center gap-3">
          <img src="{{ asset('assets/icons/place.svg') }}" class="w-5 h-5" alt="">
          <span>{{ config('site.company.address') }}</span>
        </li>
        <li class="flex items-center gap-3">
          <img src="{{ asset('assets/icons/mail.svg') }}" class="w-5 h-5" alt="">
          <span>{{ config('site.company.primary_email') }}</span>
        </li>
        <li class="flex items-center gap-3">
          <img src="{{ asset('assets/icons/telp.svg') }}" class="w-5 h-5" alt="">
          <span>{{ config('site.company.phone') }}</span>
        </li>
        <li class="flex items-center gap-3">
          <img src="{{ asset('assets/icons/whatsapp.svg') }}" class="w-5 h-5" alt="">
          <span>{{ config('site.company.whatsapp') }}</span>
        </li>
        <li class="flex items-center gap-3">
          <img src="{{ asset('assets/icons/linkedin.svg') }}" class="w-5 h-5" alt="">
          <span>{{ config('site.company.linkedin') }}</span>
        </li>
      </ul>
    </div>

        <!-- TENGAH -->
        <div>
          <h4 class="font-semibold text-lg">{{ __('Layanan') }}</h4>
          <ul class="mt-4 space-y-2 text-sm text-white/95 list-disc list-inside">
            <li><a href="{{ route('services') }}#eprocurement" class="hover:underline">{{ __('E-Procurement') }}</a></li>
            <li><a href="{{ route('services') }}#itconsultant" class="hover:underline">{{ __('IT Consultant') }}</a></li>
            <li><a href="{{ route('services') }}#business" class="hover:underline">{{ __('Business System') }}</a></li>
            <li><a href="{{ route('services') }}#egovernment" class="hover:underline">{{ __('E-Government & Smart City') }}</a></li>
          </ul>
        </div>

        <!-- KANAN -->
        <div class="flex flex-col">
          <div>
            <h4 class="font-semibold text-lg">{{ __('Perusahaan') }}</h4>
            <ul class="mt-4 space-y-2 text-sm text-white/95 list-disc list-inside">
              <li><a href="{{ route('about') }}" class="hover:underline">{{ __('Tentang kami') }}</a></li>
              <li><a href="{{ route('products.index') }}" class="hover:underline">{{ __('Produk') }}</a></li>
              <li><a href="{{ route('careers.index') }}" class="hover:underline">{{ __('Karir') }}</a></li>
              <li><a href="{{ route('contact') }}" class="hover:underline">{{ __('Kontak') }}</a></li>
            </ul>
          </div>

          <div class="flex-1"></div>

          <!-- BUSINESS HOURS -->
          <div class="mt-8 lg:mt-0 lg:flex lg:justify-end">
            <div class="business-hours-card w-full overflow-hidden rounded-lg bg-white shadow-md lg:w-[380px]">
              <div class="flex items-center text-sm">

                <!-- LEFT -->
                <div class="flex items-center gap-2 px-4 py-3 border-r border-gray-200">
                  <img src="{{ asset('assets/icons/jam.svg') }}" class="w-4 h-4" alt="">
                  <div class="leading-tight font-semibold text-[14px]">
                    <div>{{ __('Jam') }}</div>
                    <div>{{ __('Operasional') }}</div>
                  </div>
                </div>

                <!-- MIDDLE -->
                <div class="px-4 py-3 border-r border-gray-200 text-[12px] leading-tight">
                  <div>{{ __(config('site.company.business_hours.weekday')) }}</div>
                  <div class="mt-1">{{ __(config('site.company.business_hours.weekend')) }}</div>
                </div>

                <!-- RIGHT -->
                <div class="px-4 py-3 font-semibold text-[14px] text-center leading-tight">
                  <div>{{ config('site.company.business_hours.time') }}</div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="mt-10 border-t border-white/30"></div>

      <div class="mt-6 text-sm text-white/95">
        © {{ __('Copyright') }} {{ now()->year }} {{ config('site.company.name') }}, {{ __('All Rights Reserved') }}
      </div>

    </div>
  </div>
</footer>
