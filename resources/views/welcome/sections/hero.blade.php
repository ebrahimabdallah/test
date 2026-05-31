<section class="hero">
  <div class="hero-grid">

    {{-- النص على اليمين (أول عمود في RTL) --}}
    <div class="hero-content">
      <div class="hero-tag">متاحون لاستقبال 3 مشاريع جديدة هذا الشهر</div>
      <h1>نخلي متجرك <span class="accent">الإلكتروني</span><br>يحقق نمو <span class="underline">حقيقي</span></h1>
      <p>حلول تسويقية مبنية على <strong>فهم</strong> عميق، تخطيط ذكي، وتنفيذ دقيق،<br>ونقيس كل خطوة لتحقيق نتائج <span style="color:var(--lime);">تتجاوز توقعاتك.</span></p>

      <div class="cta-group">
        <a href="{{ $siteSettings->whatsappUrl() }}" class="btn-gradient" style="text-decoration:none;" target="_blank" rel="noopener noreferrer">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          احصل على استشارة مجانية
        </a>
        <a href="#works" class="btn-outline" style="text-decoration:none;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          شوف اعمالنا
        </a>
      </div>
    </div>

    {{-- لوحة الأداء على اليسار --}}
    <div class="hero-visual">
      <div class="dash-main dash-main--mockup">
        <div class="dash-analytics-card">
          <div class="dash-analytics-head">
            <div>
              <p class="dash-analytics-title">أداء الحملات</p>
              <p class="dash-analytics-sub">مقارنة المبيعات والعائد</p>
            </div>
            <span class="dash-analytics-period">أيار ٢٠٢٦</span>
          </div>
          <div class="dash-chart" aria-hidden="true">
            <svg viewBox="0 0 420 200" role="presentation">
              <defs>
                <linearGradient id="heroChartArea" x1="0" y1="0" x2="0" y2="1">
                  <stop offset="0%" stop-color="#C5E847" stop-opacity="0.35"/>
                  <stop offset="100%" stop-color="#C5E847" stop-opacity="0"/>
                </linearGradient>
              </defs>
              {{-- شبكة خفيفة --}}
              @foreach([40, 80, 120, 160] as $y)
                <line x1="52" y1="{{ $y }}" x2="400" y2="{{ $y }}" stroke="rgba(13,27,42,.08)" stroke-width="1"/>
              @endforeach
              {{-- محور القيم (يمين في RTL) --}}
              @foreach([['٤٬٠٠٠ ر.س', 40], ['٣٬٠٠٠ ر.س', 80], ['٢٬٠٠٠ ر.س', 120], ['١٬٠٠٠ ر.س', 160]] as [$label, $y])
                <text x="48" y="{{ $y + 4 }}" text-anchor="end" class="dash-chart-label">{{ $label }}</text>
              @endforeach
              {{-- محور التواريخ --}}
              <text x="70" y="188" text-anchor="middle" class="dash-chart-label">١ أيار</text>
              <text x="150" y="188" text-anchor="middle" class="dash-chart-label">٥ أيار</text>
              <text x="230" y="188" text-anchor="middle" class="dash-chart-label">٩ أيار</text>
              <text x="310" y="188" text-anchor="middle" class="dash-chart-label">١٣ أيار</text>
              <text x="390" y="188" text-anchor="middle" class="dash-chart-label">١٦ أيار</text>
              {{-- خط المبيعات --}}
              <path class="chart-area" d="M70 145 L120 128 L170 118 L220 95 L270 88 L320 72 L370 58 L400 50 L400 170 L70 170 Z"/>
              <path class="chart-line chart-line--sales" d="M70 145 L120 128 L170 118 L220 95 L270 88 L320 72 L370 58 L400 50"/>
              <path class="chart-line chart-line--return" d="M70 155 L120 140 L170 132 L220 112 L270 102 L320 90 L370 78 L400 68"/>
              <circle cx="400" cy="50" r="4" fill="#C5E847"/>
              <circle cx="400" cy="68" r="4" fill="#4DB6D6"/>
            </svg>
          </div>
          <div class="dash-analytics-legend">
            <span><i class="dash-legend-dot dash-legend-dot--lime"></i> المبيعات</span>
            <span><i class="dash-legend-dot dash-legend-dot--blue"></i> العائد</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if(! empty($platformLogos))
    <div class="hero-partners-strip">
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
