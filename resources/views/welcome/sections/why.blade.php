<section class="why" id="why">
  <div class="container">
    <div class="why-header reveal">
      <div class="section-tag">ليه ثمرة؟</div>
      <h2 class="section-title">رحلة نجاحك معانا في <span class="accent">6 محطات</span></h2>
      <p class="section-desc">من أول لحظة نشتغل فيها سوا، إحنا بنرسم معاك خريطة طريق واضحة. كل محطة لها هدف، وكل خطوة بتقربك من نتيجة حقيقية تشوفها بعينك.</p>
    </div>

    <div class="roadmap">
      <!-- Curved animated path -->
      <svg class="roadmap-svg" viewBox="0 0 1200 1800" preserveAspectRatio="none">
        <defs>
          <linearGradient id="pathGradient" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" stop-color="#C5E847"/>
            <stop offset="33%" stop-color="#4DB6D6"/>
            <stop offset="66%" stop-color="#C5E847"/>
            <stop offset="100%" stop-color="#4DB6D6"/>
          </linearGradient>
        </defs>
        <!--
          Smooth S-curve through all 6 stations + destination.
          Each station dot sits exactly on the path at its midpoint.
          S1 right  y≈150  x=870  →  S2 left  y≈410  x=330
          S3 right  y≈670  x=870  →  S4 left  y≈930  x=330
          S5 right  y≈1190 x=870  →  S6 left  y≈1450 x=330
          Dest center y≈1700 x=600
        -->
        <path class="path-bg"
          d="M 870,150
             C 870,280  330,280  330,410
             C 330,540  870,540  870,670
             C 870,800  330,800  330,930
             C 330,1060 870,1060 870,1190
             C 870,1320 330,1320 330,1450
             C 330,1580 600,1580 600,1700"/>
        <path class="path-glow" id="mainPath"
          d="M 870,150
             C 870,280  330,280  330,410
             C 330,540  870,540  870,670
             C 870,800  330,800  330,930
             C 330,1060 870,1060 870,1190
             C 870,1320 330,1320 330,1450
             C 330,1580 600,1580 600,1700"/>
      </svg>

      <!-- Travelling arrow head -->
      <div class="path-arrow" id="pathArrow">
        <svg viewBox="0 0 24 24" fill="none" stroke="#C5E847" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 12h14M13 6l6 6-6 6"/>
        </svg>
      </div>

      <!-- Station 1 -->
      <div class="station station-1">
        <div class="station-bignum">01</div>
        <div class="station-dot">
          <div class="dot-ring-outer"></div>
          <div class="dot-pulse"></div>
          <div class="dot-core">01</div>
        </div>
        <div class="station-card">
          <div class="station-label">المحطة الأولى · نقطة البداية</div>
          <h4>نفهمك قبل ما نشتغل معاك</h4>
          <p>أول حاجة بنعملها مش تنفيذ، إحنا بنقعد معاك ونفهم تجارتك، عملاءك، منافسينك، وأهدافك الحقيقية. لأن أي شغل من غير فهم بيبقى تخمين.</p>
          <div class="station-features">
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> تحليل عميق لسوقك</div>
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> دراسة المنافسين</div>
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> فهم جمهورك</div>
          </div>
        </div>
      </div>

      <!-- Station 2 -->
      <div class="station station-2">
        <div class="station-bignum">02</div>
        <div class="station-dot">
          <div class="dot-ring-outer"></div>
          <div class="dot-pulse"></div>
          <div class="dot-core">02</div>
        </div>
        <div class="station-card">
          <div class="station-label">المحطة الثانية · التخطيط</div>
          <h4>خطة واضحة... مفيش ارتجال</h4>
          <p>بنحوّل الفهم لخطة عمل تفصيلية: إيه اللي هيتعمل، إمتى، ومين مسؤول. كل مرحلة لها هدف وجدول زمني، فأنت دايماً عارف إنت فين في الرحلة.</p>
          <div class="station-features">
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> خطة تنفيذ كاملة</div>
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> جدول زمني واضح</div>
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> KPIs محددة</div>
          </div>
        </div>
      </div>

      <!-- Station 3 -->
      <div class="station station-3">
        <div class="station-bignum">03</div>
        <div class="station-dot">
          <div class="dot-ring-outer"></div>
          <div class="dot-pulse"></div>
          <div class="dot-core">03</div>
        </div>
        <div class="station-card">
          <div class="station-label">المحطة الثالثة · التنفيذ</div>
          <h4>شغل بيركز على النتيجة مش الشكل</h4>
          <p>إحنا مش هنبهرك بتقارير ملونة وأرقام بلا معنى. كل خطوة بننفذها بتجاوب على سؤال واحد: هل ده بيقربنا من المبيعات والعملاء الحقيقيين؟</p>
          <div class="station-features">
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> تركيز على المبيعات</div>
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> ROI واضح</div>
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> تقارير عملية</div>
          </div>
        </div>
      </div>

      <!-- Station 4 -->
      <div class="station station-4">
        <div class="station-bignum">04</div>
        <div class="station-dot">
          <div class="dot-ring-outer"></div>
          <div class="dot-pulse"></div>
          <div class="dot-core">04</div>
        </div>
        <div class="station-card">
          <div class="station-label">المحطة الرابعة · البيانات</div>
          <h4>قرارات بأرقام... مش بإحساس</h4>
          <p>كل قرار بناخده معاك مدعوم ببيانات حقيقية: سلوك العميل، أداء الحملات، معدلات التحويل. إحنا بنقرا الأرقام عشان نشوف الفرص ونبعد عن الأخطاء.</p>
          <div class="station-features">
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> تحليلات لحظية</div>
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> A/B Testing</div>
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> تتبع كامل</div>
          </div>
        </div>
      </div>

      <!-- Station 5 -->
      <div class="station station-5">
        <div class="station-bignum">05</div>
        <div class="station-dot">
          <div class="dot-ring-outer"></div>
          <div class="dot-pulse"></div>
          <div class="dot-core">05</div>
        </div>
        <div class="station-card">
          <div class="station-label">المحطة الخامسة · التطوير</div>
          <h4>ما نوقفش عند نقطة... دايماً بنطوّر</h4>
          <p>كل أسبوع بنقيس، نتعلّم من اللي اشتغل واللي ما اشتغلش، ونحسّن. السوق بيتغير كل يوم، وإحنا بنغير معاه عشان تجارتك تفضل في القمة.</p>
          <div class="station-features">
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> تحسين أسبوعي</div>
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> مراجعات دورية</div>
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> تطوير مستمر</div>
          </div>
        </div>
      </div>

      <!-- Station 6 -->
      <div class="station station-6">
        <div class="station-bignum">06</div>
        <div class="station-dot">
          <div class="dot-ring-outer"></div>
          <div class="dot-pulse"></div>
          <div class="dot-core">06</div>
        </div>
        <div class="station-card">
          <div class="station-label">المحطة الأخيرة · الشراكة</div>
          <h4>شريك نمو... مش مجرد مزوّد خدمة</h4>
          <p>هدفنا مش حملة وتنتهي. إحنا بنبني معاك علاقة طويلة المدى، تكبر فيها تجارتك سنة ورا سنة. نجاحك هو نجاحنا، وثمرة شغلنا تفضل معاك للأبد.</p>
          <div class="station-features">
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> علاقة طويلة المدى</div>
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> دعم مستمر</div>
            <div class="feature-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> نمو مستدام</div>
          </div>
        </div>
      </div>

      <!-- Final destination -->
      <div class="roadmap-destination reveal">
        <div class="destination-glow"></div>
        <div class="destination-arrow">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#C5E847" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="filter:drop-shadow(0 0 8px rgba(197,232,71,.8))">
            <path d="M12 5v14M5 12l7 7 7-7"/>
          </svg>
        </div>
        <div class="destination-badge">
          🎯 ثمرة نجاح تجارتك
        </div>
      </div>
    </div>
  </div>
</section>

