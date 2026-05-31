<section class="works" id="works">
  <div class="container">
    <div class="works-header reveal">
      <div class="works-badge">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
        أعمالنا
      </div>
      <h2 class="section-title">نصمم تجارب <span class="accent">تصنع الفرق</span></h2>
      <p class="section-desc">مجموعة من المشاريع التي نفخر بتنفيذها لعملائنا — من المتاجر الإلكترونية إلى الهويات البصرية وأنظمة التحكم.</p>
    </div>

    <div class="works-filters-wrap reveal">
      <div class="works-filters" id="worksFilters" role="tablist" aria-label="تصنيف الأعمال"></div>
    </div>

    <div class="works-stage reveal">
      <button type="button" class="works-nav works-prev" id="worksPrev" aria-label="المشروع السابق">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
      </button>
      <div class="works-viewport" id="worksViewport">
        <div class="works-track" id="worksTrack"></div>
      </div>
      <button type="button" class="works-nav works-next" id="worksNext" aria-label="المشروع التالي">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
      </button>
    </div>

    <div class="works-dots reveal" id="worksDots" role="tablist" aria-label="تنقل المشاريع"></div>
  </div>
</section>

<div class="works-modal" id="worksModal" role="dialog" aria-modal="true" aria-labelledby="worksModalTitle" hidden>
  <div class="works-modal-card">
    <button class="modal-close" type="button" id="worksModalClose" aria-label="إغلاق">×</button>
    <div class="works-modal-layout">
      <div class="works-modal-media">
        <img id="worksModalImg" src="" alt="">
      </div>
      <div class="works-modal-body">
        <p class="works-modal-eyebrow" id="worksModalEyebrow"></p>
        <h3 class="works-modal-title" id="worksModalTitle"></h3>
        <div class="works-modal-desc" id="worksModalDesc"></div>
        <div class="works-modal-features" id="worksModalFeatures"></div>
      </div>
    </div>
  </div>
</div>
