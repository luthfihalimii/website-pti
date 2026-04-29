<footer class="text-white">
  <div class="footer-gradient px-6 py-10">
    <div class="max-w-6xl mx-auto">
      @php
        $footerLogos = \App\Models\Logo::where('type', 'like', 'footer_%')->get()->keyBy('type');

        $logoPti = $footerLogos->get('footer_logo_pti');
        $mapIcon = $footerLogos->get('footer_map_icon');
        $emailIcon = $footerLogos->get('footer_email_icon');
        $phoneIcon = $footerLogos->get('footer_phone_icon');
        $whatsappIcon = $footerLogos->get('footer_whatsapp_icon');
        $linkedinIcon = $footerLogos->get('footer_linkedin_icon');
        $clockIcon = $footerLogos->get('footer_clock_icon');
      @endphp

      <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">

        <!-- KIRI -->
        <div>
          <div class="inline-flex items-center gap-3 bg-white/95 text-gray-800 rounded-lg px-4 py-3">
            <img class="h-9 w-auto"
              src="{{ $logoPti && $logoPti->path
                    ? asset('storage/' . $logoPti->path)
                    : asset('assets/logo/logo.svg') }}"
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
              <img
                src="{{ $mapIcon && $mapIcon->path
                      ? asset('storage/' . $mapIcon->path)
                      : asset('assets/icons/place.svg') }}"
                class="w-5 h-5"
                alt="Map Icon">
              <span>{{ config('site.company.address') }}</span>
            </li>

            <li class="flex items-center gap-3">
              <img
                src="{{ $emailIcon && $emailIcon->path
                      ? asset('storage/' . $emailIcon->path)
                      : asset('assets/icons/mail.svg') }}"
                class="w-5 h-5"
                alt="Email Icon">
              <span>{{ config('site.company.primary_email') }}</span>
            </li>

            <li class="flex items-center gap-3">
              <img
                src="{{ $phoneIcon && $phoneIcon->path
                      ? asset('storage/' . $phoneIcon->path)
                      : asset('assets/icons/telp.svg') }}"
                class="w-5 h-5"
                alt="Phone Icon">
              <span>{{ config('site.company.phone') }}</span>
            </li>

            <li class="flex items-center gap-3">
              <img
                src="{{ $whatsappIcon && $whatsappIcon->path
                      ? asset('storage/' . $whatsappIcon->path)
                      : asset('assets/icons/whatsapp.svg') }}"
                class="w-5 h-5"
                alt="WhatsApp Icon">
              <span>{{ config('site.company.whatsapp') }}</span>
            </li>

            <li class="flex items-center gap-3">
              <img
                src="{{ $linkedinIcon && $linkedinIcon->path
                      ? asset('storage/' . $linkedinIcon->path)
                      : asset('assets/icons/linkedin.svg') }}"
                class="w-5 h-5"
                alt="LinkedIn Icon">
              <span>{{ config('site.company.linkedin') }}</span>
            </li>

          </ul>
        </div>

        <!-- TENGAH -->
        <div>
          <h4 class="font-semibold text-lg">{{ __('Layanan') }}</h4>
          <ul class="mt-4 space-y-2 text-sm text-white/95 list-disc list-inside">
            <li><a href="{{ route('services.index') }}#eprocurement" class="hover:underline">E-Procurement</a></li>
            <li><a href="{{ route('services.index') }}#itconsultant" class="hover:underline">IT Consultant</a></li>
            <li><a href="{{ route('services.index') }}#business" class="hover:underline">Business System</a></li>
            <li><a href="{{ route('services.index') }}#egovernment" class="hover:underline">E-Government & Smart City</a></li>
          </ul>
        </div>

        <!-- KANAN -->
        <div class="flex flex-col">

          <div>
            <h4 class="font-semibold text-lg">Perusahaan</h4>
            <ul class="mt-4 space-y-2 text-sm text-white/95 list-disc list-inside">
              <li><a href="{{ route('about') }}" class="hover:underline">Tentang kami</a></li>
              <li><a href="{{ route('products.index') }}" class="hover:underline">Produk</a></li>
              <li><a href="{{ route('careers.index') }}" class="hover:underline">Karir</a></li>
              <li><a href="{{ route('contact') }}" class="hover:underline">Kontak</a></li>
            </ul>
          </div>

          <div class="flex-1"></div>

          <div class="mt-8 lg:mt-0 lg:flex lg:justify-end">
            <div class="business-hours-card w-full overflow-hidden rounded-lg bg-white shadow-md lg:w-[380px]">
              <div class="flex items-center text-sm">

                <div class="flex items-center gap-2 px-4 py-3 border-r border-gray-200">
                  <img
                    src="{{ $clockIcon && $clockIcon->path
                          ? asset('storage/' . $clockIcon->path)
                          : asset('assets/icons/jam.svg') }}"
                    class="w-4 h-4"
                    alt="Clock Icon">

                  <div class="leading-tight font-semibold text-[14px]">
                    <div>Jam</div>
                    <div>Operasional</div>
                  </div>
                </div>

                <div class="px-4 py-3 border-r border-gray-200 text-[12px] leading-tight">
                  <div>{{ config('site.company.business_hours.weekday') }}</div>
                  <div class="mt-1">{{ config('site.company.business_hours.weekend') }}</div>
                </div>

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
        © {{ now()->year }} {{ config('site.company.name') }}, All Rights Reserved
      </div>

    </div>
  </div>
</footer>