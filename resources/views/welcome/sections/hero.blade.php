<section class="hero">
  <div class="hero-grid">

    {{-- ══ LEFT: Dashboard Visual ══ --}}
    <div class="hero-visual">

      {{-- Main analytics card --}}
      <div class="dash-main">
        <img src="{{ asset('images/WhatsApp Image 2026-05-16 at 1.15.01 AM.jpeg') }}" alt="">
        <img src="{{ asset('images/WhatsApp Image 2026-05-16 at 2.09.16 AM.jpeg') }}" alt="">
        <img src="{{ asset('images/WhatsApp Image 2026-05-16 at 2.24.49 AM.jpeg') }}" alt="">
      </div>

    </div>

    {{-- ══ RIGHT: Text Content ══ --}}
    <div class="hero-content">
      <div class="hero-tag">متاحون لاستقبال 3 مشاريع جديدة هذا الشهر</div>
      <h1>نخلي متجرك <span class="accent">الإلكتروني</span><br>يحقق نمو <span class="underline">حقيقي</span></h1>
      <p>حلول تسويقية مبنية على <strong>فهم</strong> عميق، تخطيط ذكي، وتنفيذ دقيق،<br>ونقيس كل خطوة لتحقيق نتائج <span style="color:var(--lime);">تتجاوز توقعاتك.</span></p>

      <div class="cta-group">
        <a href="{{ $siteSettings->whatsappUrl() }}" class="btn-gradient" style="text-decoration:none;" target="_blank" rel="noopener noreferrer">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
          احصل على استشارة مجانية
        </a>
        <a href="#works" class="btn-outline" style="text-decoration:none;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
          شوف اعمالنا
        </a>
      </div>

    </div>
  </div>

  @if(! empty($platformLogos))
    <div class="hero-partners-strip">
      {{-- <span class="hero-partners-label">PARTNER</span> --}}
      <div class="hero-partners-swiper-wrap">
        <div class="swiper hero-partners-swiper" aria-label="منصات التسويق">
          <div class="swiper-wrapper">
            @foreach(range(1, 3) as $copy)
              @foreach($platformLogos as $platform)
                <div class="swiper-slide">
                  <div class="hero-partner-chip">
                    <img
                      src="{{ $platform['url'] }}"
                      alt="{{ $copy === 1 ? $platform['name'] : '' }}"
                      class="hero-partner-logo"
                      loading="lazy"
                      decoding="async"
                      @if($copy > 1) aria-hidden="true" @endif
                    >
                  </div>
                </div>
              @endforeach
            @endforeach
          </div>
        </div>
      </div>
    </div>
  @endif
</section>
