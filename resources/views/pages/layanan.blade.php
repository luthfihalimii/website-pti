@extends('layouts.app')

@section('title', __('Layanan') . ' - Piramidasoft')
@section('meta_description', __('Layanan Piramidasoft mencakup e-procurement, IT consultant, business system, serta e-government dan smart city untuk kebutuhan transformasi digital organisasi.'))

@section('content')
{{-- Hero Section --}}
<section class="relative w-full h-[253px] absolute inset-0 bg-blue-600/55">
  <img 
    src="{{ asset('assets/images/hero-pages.png') }}" 
    alt="{{ __('Hero Background') }}" 
    class="absolute inset-0 w-full h-full object-cover -z-10"
  >
  
  <div class="relative max-w-6xl mx-auto px-6 h-full flex flex-col items-center justify-center text-white">
    <h1 class="text-4xl sm:text-5xl lg:text-[68px] font-bold text-shadow-lg mb-4">
      {{ __('Layanan') }}
    </h1>
    
    <div class="flex items-center gap-2 text-base sm:text-lg lg:text-[21px] font-semibold">
      <span>{{ __('Home') }}</span>
      <div class="w-3 h-[3px] bg-white"></div>
      <span>{{ __('Layanan') }}</span>
    </div>
  </div>
</section>

{{-- Tab Navigation --}}
<div class="bg-white border-b border-[#DBDBDB] z-40" data-services-tabs>
  <div class="max-w-6xl mx-auto px-6">
    <div class="flex gap-8 overflow-x-auto" role="tablist" aria-label="{{ __('Layanan') }}">
      @foreach ($categories as $category)
        <button 
          id="tab-{{ $category->slug }}"
          type="button"
          data-services-tab="{{ $category->slug }}"
          role="tab"
          aria-controls="content-{{ $category->slug }}"
          aria-selected="false"
          tabindex="-1"
          class="services-tab-button py-4 px-2 text-sm md:text-base font-medium border-b-2 border-transparent hover:text-blue-600 transition-colors whitespace-nowrap"
        >
          {{ __($category->name) }}
        </button>
      @endforeach
    </div>
  </div>
</div>

{{-- Content Container --}}
<div class="max-w-6xl mx-auto px-6 py-12">
  <div class="relative overflow-hidden">
    @foreach ($categories as $category)
      <div id="content-{{ $category->slug }}" data-services-panel="{{ $category->slug }}" role="tabpanel" aria-labelledby="tab-{{ $category->slug }}" tabindex="-1" class="services-tab-panel hidden" hidden>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
          <div class="space-y-6">
            <div class="flex items-center gap-3">
              <div class="w-12 h-1 bg-blue-600"></div>
              <span class="text-blue-600 font-semibold">{{ __($category->name) }}</span>
            </div>

            <h2 class="text-3xl md:text-4xl font-bold text-slate-950">
              {{ __($category->description) }}
            </h2>
            
            @foreach ($category->services as $service)
              <div class="text-[15px] text-[#5e5b5b] leading-relaxed">
                <h3>{{ __($service->name) }}</h3>
                <p>{{ __($service->description) }}</p>
              </div>
            @endforeach
          </div>
          
          <div class="flex justify-center">
            <img 
              src="{{ asset('assets/images/' . $category->image) }}" 
              alt="{{ __($category->name) }}" 
              class="w-full max-w-md rounded-xl shadow-lg"
            >
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection