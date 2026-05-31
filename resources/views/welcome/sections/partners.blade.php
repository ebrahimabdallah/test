@if(($partners ?? collect())->isNotEmpty())
<section class="partners" id="partners">
  <div class="container">
    <div class="partners-header reveal">
      <div class="section-tag">شركاء نجاحنا</div>
      <h2 class="section-title">عملاء بنوا <span class="accent">ثمرتهم</span> معانا</h2>
      <p class="section-desc">أكثر من 50 براند سعودي وخليجي وثقوا فينا وحققنا معاهم نتائج فعلية. كل لوجو هنا قصة نمو حقيقية.</p>
    </div>

    <div class="partners-swiper-rows reveal">
      @foreach($partnerRows as $row)
        @if($row['partners']->isNotEmpty())
          <div
            class="swiper partners-swiper partners-swiper--row-{{ $row['rowIndex'] + 1 }}{{ $row['reverse'] ? ' partners-swiper--reverse' : '' }}"
            data-reverse="{{ $row['reverse'] ? '1' : '0' }}"
            aria-label="صف الشركاء {{ $row['rowIndex'] + 1 }}"
          >
            <div class="swiper-wrapper">
              @foreach($row['partners'] as $partner)
                <div class="swiper-slide">
                  <div class="partner">
                    <div class="partner-inner partner-inner-logo">
                      <img
                        src="{{ $partner->imageUrl() }}"
                        alt="شريك"
                        class="partner-logo-img"
                        loading="lazy"
                        decoding="async"
                      >
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endif
      @endforeach
    </div>

    <div class="partners-cta reveal">
      <p>
        أكثر من <strong>+{{ $partnersCount }} براند</strong> يبنون نجاحهم معانا
      </p>
    </div>
  </div>
</section>
@endif
