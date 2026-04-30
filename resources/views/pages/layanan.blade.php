@extends('layouts.app')

@section('title', __('Layanan') . ' - Piramidasoft')
@section('meta_description', __('Layanan Piramidasoft mencakup e-procurement, IT consultant, business system, serta e-government dan smart city untuk kebutuhan transformasi digital organisasi.'))

@section('content')
<section class="relative w-full h-[253px] absolute inset-0 bg-blue-600/55">
  <img src="{{ asset('assets/images/hero-pages.png') }}" alt="{{ __('Hero Background') }}" class="absolute inset-0 w-full h-full object-cover -z-10">

  <div class="relative max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
    <h1 class="text-4xl sm:text-5xl lg:text-[68px] font-bold text-shadow-lg mb-4">{{ __('Layanan') }}</h1>

    <div class="flex items-center gap-2 text-base sm:text-lg lg:text-[21px] font-semibold">
      <span>{{ __('Home') }}</span>
      <div class="w-3 h-[3px] bg-white"></div>
      <span>{{ __('Layanan') }}</span>
    </div>
  </div>
</section>

<div class="bg-white border-b border-[#DBDBDB] z-40">
  <div class="max-w-6xl mx-auto px-6">
    <div class="flex gap-8 overflow-x-auto" role="tablist">
      @foreach ($categories as $category)
        <button
          type="button"
          data-tab="{{ $category->slug }}"
          class="service-tab py-4 px-2 text-sm md:text-base font-medium border-b-2 whitespace-nowrap {{ $loop->first ? 'text-blue-600 border-blue-600' : 'border-transparent' }}"
        >
          {{ __($category->name) }}
        </button>
      @endforeach
    </div>
  </div>
</div>

<div class="max-w-6xl mx-auto px-6 py-12">
  @foreach ($categories as $category)
    <div id="panel-{{ $category->slug }}" class="service-panel {{ $loop->first ? '' : 'hidden' }}">
      @foreach ($category->services as $service)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center mb-16">
          <div class="space-y-6">
            <div class="flex items-center gap-3">
              <div class="w-12 h-1 bg-blue-600"></div>
              <span class="text-blue-600 font-semibold">{{ __($category->name) }}</span>
            </div>

            <h2 class="text-3xl md:text-4xl font-bold text-slate-950">
              {{ __($service->name) }}
            </h2>

            <div class="text-[15px] text-[#5e5b5b] leading-relaxed">
              {!! nl2br(e($service->description)) !!}
            </div>
          </div>

          <div class="flex justify-center">
            @if (!empty($service->image))
              <img src="{{ asset('storage/' . $service->image) }}" alt="{{ __($service->name) }}" class="w-full max-w-md rounded-xl shadow-lg">
            @else
              <img src="{{ asset('assets/images/hero-pages.png') }}" alt="{{ __($service->name) }}" class="w-full max-w-md rounded-xl shadow-lg">
            @endif
          </div>
        </div>
      @endforeach
    </div>
  @endforeach
</div>

<script>
  document.querySelectorAll('.service-tab').forEach((tab) => {
    tab.addEventListener('click', () => {
      const slug = tab.dataset.tab;

      document.querySelectorAll('.service-panel').forEach((panel) => {
        panel.classList.add('hidden');
      });

      document.querySelector('#panel-' + slug).classList.remove('hidden');

      document.querySelectorAll('.service-tab').forEach((button) => {
        button.classList.remove('text-blue-600', 'border-blue-600');
        button.classList.add('border-transparent');
      });

      tab.classList.add('text-blue-600', 'border-blue-600');
      tab.classList.remove('border-transparent');
    });
  });
</script>
@endsection