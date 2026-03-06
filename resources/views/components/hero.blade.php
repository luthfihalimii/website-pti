@php
$slides = collect(config('site.hero_slides'))
    ->map(fn ($slide) => [
        ...$slide,
        'tag' => __($slide['tag']),
        'title' => __($slide['title']),
        'subtitle' => __($slide['subtitle']),
        'image' => asset($slide['image']),
        'primary' => [
            'text' => __($slide['primary']['text']),
            'href' => route($slide['primary']['route']),
        ],
        'secondary' => [
            'text' => __($slide['secondary']['text']),
            'href' => route($slide['secondary']['route']),
        ],
    ])
    ->values()
    ->all();

$heroId = 'hero_' . uniqid();
@endphp

<section class="w-full">
  <div id="{{ $heroId }}" class="hero-wrap relative w-full overflow-hidden">

    <img data-hero-image
      src="{{ $slides[0]['image'] }}"
      alt="{{ __('Hero') }}"
      class="w-full h-[420px] md:h-[560px] object-cover">

    <div class="absolute inset-0 z-10 bg-gradient-to-r from-[#2563EB]/95 via-[#2563EB]/85 to-transparent"></div>

    <div class="absolute inset-0 z-20 flex items-center">
      <div class="mx-auto w-full max-w-[1200px] px-6">
        <div class="hero-content-grid">

          <div class="hero-bullet-wrap">
            <div data-hero-bullets class="hero-bullet-column">
              @foreach($slides as $i => $s)
                <button type="button"
                  aria-label="{{ __('Slide :number', ['number' => $i + 1]) }}"
                  data-hero-dot="{{ $i }}"
                  class="hero-bullet">
                </button>
              @endforeach
            </div>
          </div>

          <div class="hero-copy text-white w-full md:w-[55%]">

            <div class="hero-tag-wrap">
              <span class="hero-tag-line"></span>
              <span data-hero-tag class="hero-tag-text">
                {{ $slides[0]['tag'] }}
              </span>
            </div>

            <h1 data-hero-title class="hero-title">
              {{ $slides[0]['title'] }}
            </h1>

            <p data-hero-subtitle class="hero-subtitle">
              {{ $slides[0]['subtitle'] }}
            </p>

            <div class="mt-7 flex flex-wrap gap-5">
              <a data-hero-primary
                 href="{{ $slides[0]['primary']['href'] }}"
                 class="hero-btn hero-btn--primary">
                <span data-hero-primary-text>
                  {{ $slides[0]['primary']['text'] }}
                </span>
                <span class="hero-arrow">→</span>
              </a>

              <a data-hero-secondary
                 href="{{ $slides[0]['secondary']['href'] }}"
                 class="hero-btn hero-btn--secondary">
                <span data-hero-secondary-text>
                  {{ $slides[0]['secondary']['text'] }}
                </span>
                <span class="hero-arrow">→</span>
              </a>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full z-30">
      <svg viewBox="0 0 1440 140" class="w-full h-16 md:h-20" preserveAspectRatio="none">
        <path fill="#ffffff"
          d="M0,90 C240,140 480,40 720,80 C960,120 1200,30 1440,80 L1440,140 L0,140 Z"></path>
      </svg>
    </div>

  </div>
</section>

<script>
(function () {
  const root = document.getElementById(@json($heroId));
  if (!root) return;

  const slides = @json($slides);
  const dots = Array.from(root.querySelectorAll('[data-hero-dot]'));

  const elImage = root.querySelector('[data-hero-image]');
  const elTag = root.querySelector('[data-hero-tag]');
  const elTitle = root.querySelector('[data-hero-title]');
  const elSubtitle = root.querySelector('[data-hero-subtitle]');
  const elPrimary = root.querySelector('[data-hero-primary]');
  const elSecondary = root.querySelector('[data-hero-secondary]');
  const elPrimaryText = root.querySelector('[data-hero-primary-text]');
  const elSecondaryText = root.querySelector('[data-hero-secondary-text]');

  let index = 0;
  let timer = null;
  const intervalMs = 5000;

function setActive(){
  dots.forEach((d,i)=>{
    if(i === index){
      d.classList.add('is-active');
    }else{
      d.classList.remove('is-active');
    }
  });
}

  function render(i) {
    index = i;
    const s = slides[index];

    elImage.src = s.image;
    elTag.textContent = s.tag;
    elTitle.textContent = s.title;
    elSubtitle.textContent = s.subtitle;

    elPrimary.href = s.primary?.href || '#';
    elSecondary.href = s.secondary?.href || '#';
    elPrimaryText.textContent = s.primary?.text || @json(__('Baca selengkapnya'));
    elSecondaryText.textContent = s.secondary?.text || @json(__('Hubungi kami'));

    setActive();
  }

  function start() {
    stop();
    timer = setInterval(() => render((index + 1) % slides.length), intervalMs);
  }

  function stop() {
    if (timer) clearInterval(timer);
    timer = null;
  }

  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
      render(i);
      start();
    });
  });

  render(0);
  start();
})();
</script>
