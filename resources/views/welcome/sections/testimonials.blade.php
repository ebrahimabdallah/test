@if($testimonialImages->isNotEmpty())
<section class="testimonials" id="testimonials">
  <div class="container">
    <div class="reveal" style="text-align:center;max-width:700px;margin:0 auto">
      <div class="section-tag">آراء العملاء</div>
      <h2 class="section-title">قصص نجاح <span class="accent">حقيقية</span></h2>
    </div>

    <div class="testimonials-stage reveal">
      <button type="button" class="testimonials-nav testimonials-prev" aria-label="السابق">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
      </button>

      <div class="swiper testimonials-swiper">
        <div class="swiper-wrapper">
          @foreach($testimonialImages as $imageUrl)
            <div class="swiper-slide">
              <figure class="testimonial testimonial-image">
                <div class="testimonial-slide-media">
                  <img
                    src="{{ $imageUrl }}"
                    alt="رأي عميل"
                    loading="lazy"
                    decoding="async"
                  >
                </div>
              </figure>
            </div>
          @endforeach
        </div>
        <div class="testimonials-pagination swiper-pagination"></div>
      </div>

      <button type="button" class="testimonials-nav testimonials-next" aria-label="التالي">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
      </button>
    </div>
  </div>
</section>
@endif
