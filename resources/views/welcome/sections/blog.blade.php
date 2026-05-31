<section class="blog" id="blog">
  <div class="container">
    <div class="reveal">
      <div class="section-tag">مدونة ثمرة</div>
      <h2 class="section-title">رؤى <span class="accent">وأفكار</span><br>للتجارة الإلكترونية</h2>
      <p class="section-desc">مقالات وتحليلات من فريقنا، مبنية على تجارب حقيقية من السوق السعودي والخليجي.</p>
    </div>
    <div class="blog-grid">
      @forelse($blogs as $index => $blog)
        <article class="blog-card blog-{{ ($index % 3) + 1 }} reveal">
          <div class="blog-image">
            @if($blog->featuredImageUrl())
              <img
                src="{{ $blog->featuredImageUrl() }}"
                alt="{{ $blog->title }}"
                loading="lazy"
                decoding="async"
              >
            @endif
          </div>
          <div class="blog-content">
            <div class="blog-date">
              @if($blog->formattedPublishedDate())
                {{ $blog->formattedPublishedDate() }} ·
              @endif
              {{ $blog->readingTimeMinutes() }} دقائق قراءة
            </div>
            <h4>{{ $blog->title }}</h4>
            <p>{{ $blog->excerpt }}</p>
            <a href="{{ route('blog.show', $blog->slug) }}" class="blog-link">
              اقرأ المزيد
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            </a>
          </div>
        </article>
      @empty
        <p class="section-desc" style="grid-column:1/-1;text-align:center;">لا توجد مقالات منشورة حالياً.</p>
      @endforelse
    </div>
  </div>
</section>
